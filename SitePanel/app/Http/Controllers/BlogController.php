<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use App\Blog;
use File;
use Session;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function getAddBlog(){
        return view('pages.blog.addblog');
    }
    public function postAddBlog(Request $request){
        $imageid = null;
        $formdata = json_decode($request->formdata);
        $blog = new Blog;
        $blog->title = $formdata->blog_title;
        $blog->body = $formdata->blog_body;
        $blog->author = $formdata->blog_author;
        $blog->status = $formdata->blogstatus;
        //upload file and save path into db
        if($request->hasFile('blog_image')){
            if(!File::exists(public_path("images/blog"))){
                File::makeDirectory(public_path("images/blog", 0777, true, true));
            }
            do{
                $flag = true;
                $imageid = uniqid();
                $flag = Blog::where('image_url','LIKE','%'."blog-".$imageid.'%')->exists();
            }while($flag);
            $blog_image = $request->file('blog_image');
            $resized_blog_image = Image::make($blog_image);
            $resized_blog_image->resize(900, 500);
            $blog_image_name = "blog-".$imageid.".".$blog_image->getClientOriginalExtension();
            $resized_blog_image->save(public_path('images/blog/'.$blog_image_name));
            $blog_image_path = 'images/blog/'.$blog_image_name;
            $blog->image_url = $blog_image_path;
            $blog->form_user_id = Auth::User()->id;
            $blog->image_user_id = Auth::User()->id;
            $blog->updated_at = null;
            $blog->save();
            $response = [
                "status" => "true",
                "success_message" => "Blog Added Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Error! Blog Image Not Found"
            ];
            return response()->json($response);
        }
    }
    public function getTodayAllBlogs(){
        $data['allblogs'] = Blog::whereDate('created_at',config('constants.TODAY_DATE'))->orderBy('id', 'DESC')->get();
        $data['mainheading'] = "Today's Blogs";
        $data['blogscount'] = count($data['allblogs']);
        $data['filtereddaterange'] = "";
        Session::put(['url'=>'/todayallblogs','flag'=>1]);
        return view('pages.blog.viewblogs',$data);
    }
    public function getAllBlogs(){
        $data['allblogs'] = Blog::orderBy('id', 'DESC')->get();
        $data['mainheading'] = "All Blogs";
        $data['blogscount'] = count($data['allblogs']);
        $data['filtereddaterange'] = "";
        Session::put(['url'=>'/allblogs','flag'=>1]);
        return view('pages.blog.viewblogs',$data);
    }
    public function getFilteredBlogs($dateremark, $datefrom, $dateto){
        Session::put('url','/filteredblogs/'.$dateremark.'/'.Carbon::parse($datefrom)->format('Y-m-d').'/'.Carbon::parse($dateto)->format('Y-m-d'));
        if(Session::get('flag') == 1){
            if(strcasecmp($dateremark,"both") == 0 ){
                $response['filteredblogs'] = Blog::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('form_user','image_user')->get();
                $response['mainheading'] = 'Created & Updated Blogs<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredblogs']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
            else if(strcasecmp($dateremark,"created") == 0){
                $response['filteredblogs'] = Blog::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('form_user','image_user')->get();
                $response['mainheading'] = 'Created Blogs<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredblogs']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
            else if(strcasecmp($dateremark,"updated") == 0){
                $response['filteredblogs'] = Blog::whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('form_user','image_user')->get();
                $response['mainheading'] = 'Updated Blogs<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredblogs']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
        }
        else{
            Session::put('flag',1);
            if(strcasecmp($dateremark,"both") == 0 ){
                $data['allblogs'] = Blog::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('form_user','image_user')->get();
                $data['mainheading'] = "Created & Updated Blogs";
                $data['blogscount'] = count($data['allblogs']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.blog.viewblogs',$data);
            }
            else if(strcasecmp($dateremark,"created") == 0){
                $data['allblogs'] = Blog::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('form_user','image_user')->get();
                $data['mainheading'] = "Created Blogs";
                $data['blogscount'] = count($data['allblogs']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.blog.viewblogs',$data);
            }
            else if(strcasecmp($dateremark,"updated") == 0){
                $data['allblogs'] = Blog::whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('form_user','image_user')->get();
                $data['mainheading'] = "Updated Blogs";
                $data['blogscount'] = count($data['allblogs']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.blog.viewblogs',$data);
            }
        }
    }
    public function getViewBlog($id){
        Session::put('flag',-1);
        $data['blog'] = Blog::find($id);
        return view('pages.blog.viewblog', $data);
    }
    public function getUpdatedBlogForm($id){
        $data['blog'] = Blog::find($id);
        return view('pages.blog.updateblogform', $data);
    }
    public function postUpdatedBlogForm(Request $request){
        $blog = Blog::find($request->blogid);
        $blog->title = $request->blog_title;
        $blog->body = $request->blog_body;
        $blog->author = $request->blog_author;
        $blog->status = $request->blogstatus;
        $blog->form_user_id = Auth::User()->id;
        $blog->save();
        Session::flash("updateblogform_successmessage","Blog Updated Successfully");
        $response = [
            "status" => "true",
            "success_message" => "Blog Updated Successfully",
            "blogid" => $request->blogid
        ];
        return response()->json($response);
    }
    public function postUpdatedBlogImage(Request $request){
        $imageid = null;
        $formdata = json_decode($request->formdata);
        $blog = Blog::find($formdata->blogid);
        if($request->hasFile('blog_image')){
            if(!File::exists(public_path("images/blog"))){
                File::makeDirectory(public_path("images/blog", 0777, true, true));
            }
            if(File::exists($blog->image_url)){
                File::delete($blog->image_url);
            }
            do{
                $flag = true;
                $imageid = uniqid();
                $flag = Blog::where('image_url','LIKE','%'."blog-".$imageid.'%')->exists();
            }while($flag);
            $blog_image = $request->file('blog_image');
            $resized_blog_image = Image::make($blog_image);
            $resized_blog_image->resize(900, 500);
            $blog_image_name = "blog-".$imageid.".".$blog_image->getClientOriginalExtension();
            $resized_blog_image->save(public_path('images/blog/'.$blog_image_name));
            $blog_image_path = 'images/blog/'.$blog_image_name;
            $blog->image_url = $blog_image_path;
            $blog->image_user_id = Auth::User()->id;
            $blog->save();
            Session::flash("updateblogimage_successmessage","Blog Image Updated Successfully");
            $response = [
                "status" => "true",
                "success_message" => "Blog Image Updated Successfully",
                "blogid" => $formdata->blogid
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Error! Blog Image Not Found"
            ];
            return response()->json($response);
        }
    }
    public function deleteBlog($id){
        Session::put('flag',-1);
        $blog = Blog::find($id);
        try{
            $blog->delete();
            if(File::exists($blog->image_url)){
                File::delete($blog->image_url);
            }
            $response = [
                "status" => "true",
                "url" => Session::get('url'),
                "success_message" => "Blog Deleted Successfully"
            ];
            return response()->json($response);
        }
        catch(\Illuminate\Database\QueryException $ex){
            $response = [
                "status" => "false",
                "error_message" => $blog->title."! Sorry, You Cannot Delete This Blog Until You Delete Its Child Entries Exists In Other Tables."
            ];
            return response()->json($response);
        }
    }
}
