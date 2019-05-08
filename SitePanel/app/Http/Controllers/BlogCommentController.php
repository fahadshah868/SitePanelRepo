<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogComment;
use Session;

class BlogCommentController extends Controller
{
    public function getAllBlogComments(){
        $data['allblogcomments'] = BlogComment::select('id','author','email','body','blog_id')
        ->with(['blog' => function($q){
            $q->select('id','title');
        }])
        ->orderBy('id','DESC')->get();
        $data['mainheading'] = "All Blog Comments";
        $data['blogcategoriescount'] = count($data['allblogcomments']);
        $data['filtereddaterange'] = "";
        Session::put(['url'=>'/allblogcomments','flag'=>1]);
        return view('pages.blogcomment.viewblogcomments',$data);
    }
    public function postchangestatus($id){
        // $data['']
    }
}
