<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getAddBlog(){
        return view('pages.blog.addblog');
    }
    public function postAddBlog(Request $request){
        return response()->json($request->blog_body);
    }
    public function getAllBlogs(){
        return view('pages.blog.viewblogs');
    }
}
