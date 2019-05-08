<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use App\Blog;
use App\BlogCategory;
use File;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class BlogController extends Controller
{
    public function getAddBlog(){
        $data['blogcategories'] = BlogCategory::select('id','title')->where('status',1)->get();
        return view('pages.blog.addblog',$data);
    }
    public function postAddBlog(Request $request){
        $formdata = json_decode($request->formdata);
        $blog_exists = Blog::where('title',$formdata->blog_title)->exists();
        if(!$blog_exists){
            $blog = new Blog;
            $blog->title = $formdata->blog_title;
            $url = strtolower(str_replace(' ', '-', $formdata->blog_title));
            $blog->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
            $blog->body = $formdata->blog_body;
            $blog->blog_category_id = $formdata->blog_category_id;
            $blog->author = $formdata->blog_author;
            $blog->status = $formdata->blogstatus;
            //upload file and save path into db
            if($request->hasFile('blog_image')){
                if(!File::exists(public_path("images/blog"))){
                    File::makeDirectory(public_path("images/blog", 0777, true, true));
                }
                $blog_image = $request->file('blog_image');
                $resized_blog_image = Image::make($blog_image);
                $resized_blog_image->resize(900, 500);
                $blog_image_name = "blog-".time().".".$blog_image->getClientOriginalExtension();
                $resized_blog_image->save(public_path('images/blog/'.$blog_image_name));
                $blog_image_path = 'images/blog/'.$blog_image_name;
                $blog->image_url = $blog_image_path;
                $blog->user_id = Auth::User()->id;
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
        else{
            $response = [
                "status" => "false",
                "error_message" => $formdata->blog_title."! This Blog Title Is Already Added"
            ];
            return response()->json($response);
        }
    }
    public function getTodayAllBlogs(){
        $data['allblogs'] = Blog::select('id','title','body','author','status','image_url','blog_category_id','user_id')->whereDate('created_at',config('constants.TODAY_DATE'))->orderBy('id', 'DESC')
        ->with(['user' => function($q){
            $q->select('id','username');
        }, 'blogcategory' => function($q){
            $q->select('id','title');
        }])->get();
        $data['mainheading'] = "Today's Blogs";
        $data['blogscount'] = count($data['allblogs']);
        $data['filtereddaterange'] = "";
        Session::put(['url'=>'/todayallblogs','flag'=>1]);
        return view('pages.blog.viewblogs',$data);
    }
    public function getAllBlogs(){
        $data['allblogs'] = Blog::select('id','title','body','author','status','image_url','blog_category_id','user_id')->orderBy('id', 'DESC')
        ->with(['user' => function($q){
            $q->select('id','username');
        }, 'blogcategory' => function($q){
            $q->select('id','title');
        }])->get();
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
                $response['filteredblogs'] = Blog::select('id','title','body','author','status','image_url','blog_category_id','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with(['user' => function($q){
                    $q->select('id','username');
                }, 'blogcategory' => function($q){
                    $q->select('id','title');
                }])->get();
                $response['mainheading'] = 'Created & Updated Blogs<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredblogs']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
            else if(strcasecmp($dateremark,"created") == 0){
                $response['filteredblogs'] = Blog::select('id','title','body','author','status','image_url','blog_category_id','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with(['user' => function($q){
                    $q->select('id','username');
                }, 'blogcategory' => function($q){
                    $q->select('id','title');
                }])->get();
                $response['mainheading'] = 'Created Blogs<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredblogs']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
            else if(strcasecmp($dateremark,"updated") == 0){
                $response['filteredblogs'] = Blog::select('id','title','body','author','status','image_url','blog_category_id','user_id')->whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with(['user' => function($q){
                    $q->select('id','username');
                }, 'blogcategory' => function($q){
                    $q->select('id','title');
                }])->get();
                $response['mainheading'] = 'Updated Blogs<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredblogs']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
        }
        else{
            Session::put('flag',1);
            if(strcasecmp($dateremark,"both") == 0 ){
                $data['allblogs'] = Blog::select('id','title','body','author','status','image_url','blog_category_id','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with(['user' => function($q){
                    $q->select('id','username');
                }, 'blogcategory' => function($q){
                    $q->select('id','title');
                }])->get();
                $data['mainheading'] = "Created & Updated Blogs";
                $data['blogscount'] = count($data['allblogs']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.blog.viewblogs',$data);
            }
            else if(strcasecmp($dateremark,"created") == 0){
                $data['allblogs'] = Blog::select('id','title','body','author','status','image_url','blog_category_id','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with(['user' => function($q){
                    $q->select('id','username');
                }, 'blogcategory' => function($q){
                    $q->select('id','title');
                }])->get();
                $data['mainheading'] = "Created Blogs";
                $data['blogscount'] = count($data['allblogs']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.blog.viewblogs',$data);
            }
            else if(strcasecmp($dateremark,"updated") == 0){
                $data['allblogs'] = Blog::select('id','title','body','author','status','image_url','blog_category_id','user_id')->whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with(['user' => function($q){
                    $q->select('id','username');
                }, 'blogcategory' => function($q){
                    $q->select('id','title');
                }])->get();
                $data['mainheading'] = "Updated Blogs";
                $data['blogscount'] = count($data['allblogs']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.blog.viewblogs',$data);
            }
        }
    }
    public function getViewBlog($id){
        Session::put('flag',-1);
        $data['blog'] = Blog::with(['user' => function($q){
            $q->select('id','username');
        }, 'blogcategory' => function($q){
            $q->select('id','title');
        }])->find($id);
        return view('pages.blog.viewblog', $data);
    }
    public function getUpdatedBlogForm($id){
        $data['blog'] = Blog::find($id);
        $data['blogcategories'] = BlogCategory::select('id','title')->where('status',1)->get();
        return view('pages.blog.updateblogform', $data);
    }
    public function postUpdatedBlogForm(Request $request){
        $blog = Blog::find($request->blogid);
        if(strcasecmp($blog->title, $request->blog_title) == 0){
            $blog->title = $request->blog_title;
            $url = strtolower(str_replace(' ', '-', $request->blog_title));
            $blog->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
            $blog->body = $request->blog_body;
            $blog->blog_category_id = $request->blog_category_id;
            $blog->author = $request->blog_author;
            $blog->status = $request->blogstatus;
            $blog->user_id = Auth::User()->id;
            $blog->save();
            Session::flash("updateblogform_successmessage","Blog Updated Successfully");
            $response = [
                "status" => "true",
                "success_message" => "Blog Updated Successfully",
                "blogid" => $request->blogid
            ];
            return response()->json($response);
        }
        else{
            $blog_exists = Blog::where('title',$request->blog_title)->exists();
            if(!$blog_exists){
                $blog->title = $request->blog_title;
                $url = strtolower(str_replace(' ', '-', $request->blog_title));
                $blog->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
                $blog->body = $request->blog_body;
                $blog->blog_category_id = $request->blog_category_id;
                $blog->author = $request->blog_author;
                $blog->status = $request->blogstatus;
                $blog->user_id = Auth::User()->id;
                $blog->save();
                Session::flash("updateblogform_successmessage","Blog Updated Successfully");
                $response = [
                    "status" => "true",
                    "success_message" => "Blog Updated Successfully",
                    "blogid" => $request->blogid
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => $request->blog_title."! This Blog Title Is Already Added"
                ];
                return response()->json($response);
            }
        }
    }
    public function postUpdatedBlogImage(Request $request){
        $formdata = json_decode($request->formdata);
        $blog = Blog::find($formdata->blogid);
        if($request->hasFile('blog_image')){
            if(!File::exists(public_path("images/blog"))){
                File::makeDirectory(public_path("images/blog", 0777, true, true));
            }
            if(File::exists($blog->image_url)){
                File::delete($blog->image_url);
            }
            $blog_image = $request->file('blog_image');
            $resized_blog_image = Image::make($blog_image);
            $resized_blog_image->resize(900, 500);
            $blog_image_name = "blog-".time().".".$blog_image->getClientOriginalExtension();
            $resized_blog_image->save(public_path('images/blog/'.$blog_image_name));
            $blog_image_path = 'images/blog/'.$blog_image_name;
            $blog->image_url = $blog_image_path;
            $blog->user_id = Auth::User()->id;
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
    public function postUploadBlogImage(Request $request){
        $CKEditor = $request->input('CKEditor');
	    $funcNum  = $request->input('CKEditorFuncNum');
        $message = $blog_image_location = "";
        if(Input::hasFile('upload')){
            $file = Input::file('upload');
            if($file->isValid()){
                if(!File::exists(public_path("images/blog_body"))){
                    File::makeDirectory(public_path("images/blog_body", 0777, true, true));
                }
                $blog_image = Image::make($file);
                $blog_image_name = "blog-".time().".".$file->getClientOriginalExtension();
                $blog_image_location = 'images/blog_body/'.$blog_image_name;
                $blog_image->save(public_path($blog_image_location));
            }
            else{
                $message = 'An error occurred while uploading the file.';
            }
        }
        else{
            $message = 'No file uploaded.';
        }
        return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.env('APP_URL').$blog_image_location.'", "'.$message.'")</script>';
    }
}
