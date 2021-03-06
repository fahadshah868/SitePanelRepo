<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Session;
use Auth;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function getAddCategory(){
        return view('pages.category.addcategory');
    }
    public function postAddCategory(Request $request){
        $formdata = json_decode($request->formdata);
        $is_category_exists = Category::where("title",$formdata->categorytitle)->exists();
        if(!$is_category_exists){
            $category = new Category;
            $category->title = $formdata->categorytitle;
            $url = strtolower(str_replace(' ', '-', $formdata->categorytitle));
            $category->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
            $category->description = $formdata->categorydescription;
            $category->is_topcategory = $formdata->is_topcategory;
            $category->is_popularcategory = $formdata->is_popularcategory;
            $category->is_active = $formdata->categorystatus;
            if($request->hasFile('categorylogo')){
                if(!File::exists(public_path("/images/category"))){
                    File::makeDirectory(public_path("/images/category", 0777, true, true));
                }
                $categorylogo = $request->file('categorylogo');
                $resized_category_logo = Image::make($categorylogo);
                $resized_category_logo->resize(200, 200);
                $category_logo_name = "category-".time().".".$categorylogo->getClientOriginalExtension();
                $resized_category_logo->save(public_path('/images/category/'.$category_logo_name));
                $category_logo_path = '/images/category/'.$category_logo_name;
                $category->logo_url = $category_logo_path;
            }
            $category->user_id = Auth::User()->id;
            $category->updated_at = null;
            $category->save();
            $response = [
                "status" => "true",
                "success_message" => "Category Added Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => $formdata->categorytitle."! This Category Title is Already Added"
            ];
            return response()->json($response);
         }
    }
    public function getAllCategories(Request $request){
        Session::put('url',$request->getRequestUri());
        $data['allcategories'] = Category::select('id','title','is_topcategory','is_popularcategory','is_active','logo_url','user_id')->orderBy('id', 'DESC')->with(['user' => function($q){
            $q->select('id','username');
        }])->paginate(200);
        $data['mainheading'] = "All Categories";
        $data['filtereddaterange'] = "";
        return view('pages.category.viewcategories',$data);
    }
    public function getTodayAllCategories(Request $request){
        Session::put('url',$request->getRequestUri());
        $data['allcategories'] = Category::select('id','title','is_topcategory','is_popularcategory','is_active','logo_url','user_id')->whereDate('created_at',config('constants.TODAY_DATE'))->orderBy('id', 'DESC')->with(['user' => function($q){
            $q->select('id','username');
        }])->paginate(200);
        $data['mainheading'] = "Today's Categories";
        $data['filtereddaterange'] = "";
        return view('pages.category.viewcategories',$data);
    }
    public function getFilteredCategories(Request $request, $dateremark, $datefrom, $dateto){
        Session::put('url',$request->getRequestUri());
        if(strcasecmp($dateremark,"both") == 0 ){
            $data['allcategories'] = Category::select('id','title','is_topcategory','is_popularcategory','is_active','logo_url','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['user' => function($q){
                $q->select('id','username');
            }])->paginate(200);
            $data['mainheading'] = "Created & Updated Categories";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.category.viewcategories',$data);
        }
        else if(strcasecmp($dateremark,"created") == 0){
            $data['allcategories'] = Category::select('id','title','is_topcategory','is_popularcategory','is_active','logo_url','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['user' => function($q){
                $q->select('id','username');
            }])->paginate(200);
            $data['mainheading'] = "Created Categories";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.category.viewcategories',$data);
        }
        else if(strcasecmp($dateremark,"updated") == 0){
            $data['allcategories'] = Category::select('id','title','is_topcategory','is_popularcategory','is_active','logo_url','user_id')->whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['user' => function($q){
                $q->select('id','username');
            }])->paginate(200);
            $data['mainheading'] = "Updated Categories";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.category.viewcategories',$data);
        }
    }
    public function getViewCategory($id){
        $data['category'] = Category::find($id);
        return view('pages.category.viewcategory',$data);
    }
    public function getUpdateCategoryForm($id){
        $data['category'] = Category::find($id);
        return view('pages.category.updatecategoryform',$data);
    }
    public function postUpdateCategoryForm(Request $request){
        $category = Category::find($request->categoryid);
        //if(title == title && topcategory == topcategory)
        if(strcasecmp($category->title , $request->categorytitle) == 0 && strcasecmp($category->is_topcategory , $request->is_topcategory) == 0){
            $category->title = $request->categorytitle;
            $url = strtolower(str_replace(' ', '-', $request->categorytitle));
            $category->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
            $category->description = $request->categorydescription;
            $category->is_topcategory = $request->is_topcategory;
            $category->is_popularcategory = $request->is_popularcategory;
            $category->is_active = $request->categorystatus;
            $category->user_id = Auth::User()->id;
            $category->save();
            Session::flash("updatecategory_successmessage","Category Updated Successfully");
            $response = [
                "status" => "true",
                "categoryid" => $request->categoryid,
                "success_message" => "Category Updated Successfully"
            ];
            return response()->json($response);
        }
        //if(title != title && topcategory == topcategory)
        if(strcasecmp($category->title , $request->categorytitle) != 0 && strcasecmp($category->is_topcategory , $request->is_topcategory) == 0){
            $is_category_exists = Category::where("title",$request->categorytitle)->exists();
            if(!$is_category_exists){
                $category->title = $request->categorytitle;
                $url = strtolower(str_replace(' ', '-', $request->categorytitle));
                $category->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
                $category->description = $request->categorydescription;
                $category->is_topcategory = $request->is_topcategory;
                $category->is_popularcategory = $request->is_popularcategory;
                $category->is_active = $request->categorystatus;
                $category->user_id = Auth::User()->id;
                $category->save();
                Session::flash("updatecategory_successmessage","Category Updated Successfully");
                $response = [
                    "status" => "true",
                    "categoryid" => $request->categoryid,
                    "success_message" => "Category Updated Successfully"
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => $request->categorytitle."! This Category Title is Already Added"
                ];
                return response()->json($response);
            }
        }
       //if(title == title && topcategory != topcategory)
        if(strcasecmp($category->title , $request->categorytitle) == 0 && strcasecmp($category->is_topcategory , $request->is_topcategory) != 0){
            $category->title = $request->categorytitle;
            $url = strtolower(str_replace(' ', '-', $request->categorytitle));
            $category->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
            $category->description = $request->categorydescription;
            $category->is_topcategory = $request->is_topcategory;
            $category->is_popularcategory = $request->is_popularcategory;
            $category->is_active = $request->categorystatus;
            if(strcasecmp($request->is_topcategory , "no") == 0){
                if(!empty($category->logo_url) && File::exists($category->logo_url)){
                    File::delete($category->logo_url);
                    $category->logo_url = null;
                }
            }
            $category->user_id = Auth::User()->id;
            $category->save();
            Session::flash("updatecategory_successmessage","Category Updated Successfully");
            $response = [
                "status" => "true",
                "categoryid" => $request->categoryid,
                "success_message" => "Category Updated Successfully"
            ];
            return response()->json($response);
        }
       //if(title != title && topcategory != topcategory)
        if(strcasecmp($category->title , $request->categorytitle) != 0 && strcasecmp($category->is_topcategory , $request->is_topcategory) != 0){
            $is_category_exists = Category::where("title",$request->categorytitle)->exists();
            if(!$is_category_exists){
                $category->title = $request->categorytitle;
                $url = strtolower(str_replace(' ', '-', $request->categorytitle));
                $category->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
                $category->description = $request->categorydescription;
                $category->is_topcategory = $request->is_topcategory;
                $category->is_popularcategory = $request->is_popularcategory;
                $category->is_active = $request->categorystatus;
                if(strcasecmp($request->is_topcategory , "no") == 0){
                    if(!empty($category->logo_url) && File::exists($category->logo_url)){
                        File::delete($category->logo_url);
                        $category->logo_url = null;
                    }
                }
                $category->user_id = Auth::User()->id;
                $category->save();
                Session::flash("updatecategory_successmessage","Category Updated Successfully");
                $response = [
                    "status" => "true",
                    "categoryid" => $request->categoryid,
                    "success_message" => "Category Updated Successfully"
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => $request->categorytitle."! This Category Title is Already Added"
                ];
                return response()->json($response);
            }
        }
    }
    public function postUpdateCategoryImage(Request $request){
        $categorylogo_message = "";
        $formdata = json_decode($request->formdata);
        $category = Category::find($formdata->categoryid);
        if($request->hasFile("categorylogo")){
            if(!empty($category->logo_url) && File::exists($category->logo_url)){
                File::delete($category->logo_url);
            }
            if(!File::exists(public_path("/images/category"))){
                File::makeDirectory(public_path("/images/category", 0777, true, true));
            }
            if(empty($category->logo_url)){
                $categorylogo_message = "Added";
            }
            else{
                $categorylogo_message = "Updated";
            }
            $categorylogo = $request->file('categorylogo');
            $resized_category_logo = Image::make($categorylogo);
            $resized_category_logo->resize(200, 200);
            $category_logo_name = "category-".time().".".$categorylogo->getClientOriginalExtension();
            $resized_category_logo->save(public_path('/images/category/'.$category_logo_name));
            $category_logo_path = '/images/category/'.$category_logo_name;
            $category->logo_url = $category_logo_path;
            $category->user_id = Auth::User()->id;
            $category->save();
            Session::flash("updatecategorylogo_successmessage","Category Logo ".$categorylogo_message." Successfully");
            $response = [
                "status" => "true",
                "categoryid" => $formdata->categoryid,
                "success_message" => "Category Logo ".$categorylogo_message." Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Error! Category Logo Not Found"
            ];
            return response()->json($response);
        }
    }
    public function deleteCategory($id){
        $category = Category::find($id);
        try{
            $category->delete();
            if(File::exists($category->logo_url)){
                File::delete($category->logo_url);
            }
            $response = [
                "status" => "true",
                "url" => Session::get('url'),
                "success_message" => "Category Deleted Successfully"
            ];
            return response()->json($response);
        }
        catch(\Illuminate\Database\QueryException $ex){
            $response = [
                "status" => "false",
                "error_message" => $category->title."! Sorry, You Cannot Delete This Category Until You Delete Its Child Entries Exists In Other Tables."
            ];
            return response()->json($response);
        }
    }
}
