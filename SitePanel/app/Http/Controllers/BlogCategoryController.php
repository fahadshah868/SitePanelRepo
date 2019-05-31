<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogCategory;
use Auth;
use Session;
use Carbon\Carbon;

class BlogCategoryController extends Controller
{
    public function getAddBlogCategory(){
        return view('pages.blogcategory.addblogcategory');
    }
    public function postAddBlogCategory(Request $request){
        $blogcategory_exists = BlogCategory::where('title',$request->blogcategorytitle)->exists();
        if(!$blogcategory_exists){
            $blogcategory = new BlogCategory;
            $blogcategory->title = $request->blogcategorytitle;
            $url = strtolower(str_replace(' ', '-', $request->blogcategorytitle));
            $blogcategory->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
            $blogcategory->is_active = $request->blogcategorystatus;
            $blogcategory->user_id = Auth::User()->id;
            $blogcategory->updated_at = null;
            $blogcategory->save();
            $response = [
                'status' => 'true',
                'success_message' => 'Blog Category Added Successfully'
            ];
            return response()->json($response);
        }
        else{
            $response = [
                'status' => 'false',
                'error_message' => $request->blogcategorytitle.'! This Blog Category Title Is Already Added'
            ];
            return response()->json($response);
        }
    }
    public function getAllBlogCategories(){
        $data['allblogcategories'] = BlogCategory::select('id','title','is_active','user_id')
        ->with(['user' => function($q){
            $q->select('id','username');
        }])->get();
        $data['mainheading'] = "All Blog Categories";
        $data['blogcategoriescount'] = count($data['allblogcategories']);
        $data['filtereddaterange'] = "";
        Session::put(['url'=>'/allblogcategories','flag'=>1]);
        return view('pages.blogcategory.viewblogcategories',$data);
    }
    public function getFilteredBlogCategories($dateremark, $datefrom, $dateto){
        Session::put('url','/filteredblogcategories/'.$dateremark.'/'.Carbon::parse($datefrom)->format('Y-m-d').'/'.Carbon::parse($dateto)->format('Y-m-d'));
        if(Session::get('flag') == 1){
            if(strcasecmp($dateremark,"both") == 0 ){
                $response['filteredblogcategories'] = BlogCategory::select('id','title','is_active','user_id')
                ->with(['user' => function($q){
                    $q->select('id','username');
                }])
                ->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->get();
                $response['mainheading'] = 'Created & Updated Blog Categories<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredblogcategories']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
            else if(strcasecmp($dateremark,"created") == 0){
                $response['filteredblogcategories'] = BlogCategory::select('id','title','is_active','user_id')
                ->with(['user' => function($q){
                    $q->select('id','username');
                }])
                ->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->get();
                $response['mainheading'] = 'Created Blog Categories<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredblogcategories']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
            else if(strcasecmp($dateremark,"updated") == 0){
                $response['filteredblogcategories'] = BlogCategory::select('id','title','is_active','user_id')->whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with(['user' => function($q){
                    $q->select('id','username');
                }])->get();
                $response['mainheading'] = 'Updated Blog Categories<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredblogcategories']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
        }
        else{
            Session::put('flag',1);
            if(strcasecmp($dateremark,"both") == 0 ){
                $data['allblogcategories'] = BlogCategory::select('id','title','is_active','user_id')
                ->with(['user' => function($q){
                    $q->select('id','username');
                }])
                ->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->get();
                $data['mainheading'] = "Created & Updated Blog Categories";
                $data['blogcategoriescount'] = count($data['allblogcategories']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.blogcategory.viewblogcategories',$data);
            }
            else if(strcasecmp($dateremark,"created") == 0){
                $data['allblogcategories'] = BlogCategory::select('id','title','is_active','user_id')
                ->with(['user' => function($q){
                    $q->select('id','username');
                }])
                ->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->get();
                $data['mainheading'] = "Created Blog Categories";
                $data['blogcategoriescount'] = count($data['allblogcategories']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.blogcategory.viewblogcategories',$data);
            }
            else if(strcasecmp($dateremark,"updated") == 0){
                $data['allblogcategories'] = BlogCategory::select('id','title','is_active','user_id')
                ->with(['user' => function($q){
                    $q->select('id','username');
                }])
                ->whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->get();
                $data['mainheading'] = "Updated Blog Categories";
                $data['blogcategoriescount'] = count($data['allblogcategories']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.blogcategory.viewblogcategories',$data);
            }
        }
    }
    public function getViewblogcategory($id){
        Session::put('flag',-1);
        $data['blogcategory'] = BlogCategory::with(['user' => function($q){
            $q->select('id','username');
        }])->find($id);
        return view('pages.blogcategory.viewblogcategory',$data);
    }
    public function getupdateBlogCategory($id){
        $data['blogcategory'] = BlogCategory::select('id','title','is_active')->find($id);
        return view('pages.blogcategory.updateblogcategory', $data);
    }
    public function postupdateBlogCategory(Request $request){
        $blogcategory = BlogCategory::find($request->blogcategoryid);
        if(strcasecmp($blogcategory->title, $request->blogcategorytitle) == 0){
            $blogcategory->title = $request->blogcategorytitle;
            $url = strtolower(str_replace(' ', '-', $request->blogcategorytitle));
            $blogcategory->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
            $blogcategory->is_active = $request->blogcategorystatus;
            $blogcategory->user_id = Auth::User()->id;
            $blogcategory->save();
            Session::flash('updateblogcategory_successmessage','Blog Category Updated Successfully');
            $response = [
                'status' => 'true',
                'blogcategory_id' => $request->blogcategoryid,
                'success_message' => 'Blog Category Updated Successfully'
            ];
            return response()->json($response);
        }
        else{
            $blogcategory_exists = BlogCategory::where('title',$request->blogcategorytitle)->exists();
            if(!$blogcategory_exists){
                $blogcategory->title = $request->blogcategorytitle;
                $url = strtolower(str_replace(' ', '-', $request->blogcategorytitle));
                $blogcategory->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
                $blogcategory->is_active = $request->blogcategorystatus;
                $blogcategory->user_id = Auth::User()->id;
                $blogcategory->save();
                Session::flash('updateblogcategory_successmessage','Blog Category Updated Successfully');
                $response = [
                    'status' => 'true',
                    'blogcategory_id' => $request->blogcategoryid,
                    'success_message' => 'Blog Category Updated Successfully'
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    'status' => 'false',
                    'error_message' => $request->blogcategorytitle.'! This Blog Category Is Already Added'
                ];
                return response()->json($response);
            }
        }
    }
    public function deleteBlogCategory($id){
        Session::put('flag',-1);
        $blogcategory = BlogCategory::find($id);
        try{
            $blogcategory->delete();
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
