<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogComment;

class BlogCommentController extends Controller
{
    public function getAllBlogComments(){
        $data['allblogcomments'] = BlogComment::select('id','author','email','body','blog_id')
        ->orderBy('id','DESC')->get();
        return view('pages.blogcomment.viewblogcomments',$data);
    }
}
