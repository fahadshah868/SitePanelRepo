<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use App\Blog;
use File;
use Session;

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
        $data['allblogs'] = Blog::whereDate('created_at',config('constants.today_date'))->orwhereDate('updated_at',config('constants.today_date'))->orderBy('id', 'DESC')->get();
        $data['mainheading'] = "Today's Blogs";
        $data['blogscount'] = count($data['allblogs']);
        $data['filtereddaterange'] = "";
        Session::put(['url'=>'/todayallblogs','flag'=>1]);
        return view('pages.blog.viewblogs',$data);
    }
    public function getAllBlogs(){
        return view('pages.blog.viewblogs');
    }
    public function getFilteredBlogs($dateremark, $datefrom, $dateto){
        return view('pages.blog.viewblogs');
    }
}
