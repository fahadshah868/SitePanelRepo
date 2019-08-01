<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogComment;
use Session;
use Carbon\Carbon;

class BlogCommentController extends Controller
{
    public function getAllBlogComments(Request $request){
        Session::put('url',$request->getRequestUri());
        $data['allblogcomments'] = BlogComment::select('id','author','email','body','status','blog_id')
        ->with(['blog' => function($q){
            $q->select('id','title');
        }])
        ->orderBy('id','DESC')->paginate(200);
        $data['mainheading'] = "All Blog Comments";
        $data['filtereddaterange'] = "";
        return view('pages.blogcomment.viewblogcomments',$data);
    }
    public function getFilteredBlogComments(Request $request, $dateremark, $datefrom, $dateto){
        Session::put('url',$request->getRequestUri());
        if(strcasecmp($dateremark,"both") == 0 ){
            $data['allblogcomments'] = BlogComment::select('id','author','email','body','status','blog_id')
            ->with(['blog' => function($q){
                $q->select('id','title');
            }])
            ->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->paginate(200);
            $data['mainheading'] = "Created & Updated Blog Comments";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.blogcomment.viewblogcomments',$data);
        }
        else if(strcasecmp($dateremark,"created") == 0){
            $data['allblogcomments'] = BlogComment::select('id','author','email','body','status','blog_id')
            ->with(['blog' => function($q){
                $q->select('id','title');
            }])
            ->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->paginate(200);
            $data['mainheading'] = "Created Blog Comments";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.blogcomment.viewblogcomments',$data);
        }
        else if(strcasecmp($dateremark,"updated") == 0){
            $data['allblogcomments'] = BlogComment::select('id','author','email','body','status','blog_id')
            ->with(['blog' => function($q){
                $q->select('id','title');
            }])
            ->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->paginate(200);
            $data['mainheading'] = "Updated Blog Comments";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.blogcomment.viewblogcomments',$data);
        }
    }
    public function getViewBlogComment($id){
        Session::put('flag',-1);
        $data['blogcomment'] = BlogComment::with(['blog' => function($q){
            $q->select('id','title');
        }])->find($id);
        return view('pages.blogcomment.viewblogcomment',$data);
    }
    public function getUpdateBlogComment($id){
        $data['blogcomment'] = BlogComment::select('id','status')->find($id);
        return view('pages.blogcomment.updateblogcomment',$data);
    }
    public function postUpdateBlogComment(Request $request){
        $blogcomment = BlogComment::find($request->blogcomment_id);
        $blogcomment->status = $request->blogcomment_status;
        $blogcomment->save();
        Session::flash('updateblogcomment_successmessage','Blog Comment Updated Successfully');
        $response = [
            'status' => 'true',
            'blogcomment_id' => $request->blogcomment_id
        ];
        return response()->json($response);
    }
    public function deleteBlogComment($id){
        Session::put('flag',-1);
        $blogcomment = BlogComment::find($id);
        try{
            $blogcomment->delete();
            $response = [
                "status" => "true",
                "url" => Session::get('url'),
                "success_message" => "Blog Category Deleted Successfully"
            ];
            return response()->json($response);
        }
        catch(\Illuminate\Database\QueryException $ex){
            $response = [
                "status" => "false",
                "error_message" => $blogcategory->title."! Sorry, You Cannot Delete This Blog Category Until You Delete Its Child Entries Exists In Other Tables."
            ];
            return response()->json($response);
        }
    }
}
