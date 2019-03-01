<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Session;
use Auth;

class CategoryController extends Controller
{
    public function getAddCategory(){
        return view('pages.category.addcategory');
    }
    public function postAddCategory(Request $request){
        $imageid = null;
        $formdata = json_decode($request->formdata);
        $is_category_exists = Category::where("title",$formdata->categorytitle)->exists();
        if(!$is_category_exists){
            $category = new Category;
            $category->title = $formdata->categorytitle;
            $category->description = $formdata->categorydescription;
            $category->is_topcategory = $formdata->is_topcategory;
            $category->is_popularcategory = $formdata->is_popularcategory;
            $category->status = $formdata->categorystatus;
            if($request->hasFile('categorylogo')){
                if(!File::exists(public_path("images/category"))){
                    File::makeDirectory(public_path("images/category", 0777, true, true));
                }
                do{
                    $flag = true;
                    $imageid = uniqid();
                    $flag = Category::where('logo_url','LIKE','%'.strtolower($formdata->categorytitle)."-".$imageid.'%')->exists();
                }while($flag);
                $categorylogo = $request->file('categorylogo');
                $resized_category_logo = Image::make($categorylogo);
                $resized_category_logo->resize(200, 200);
                $category_logo_name = strtolower($formdata->categorytitle)."-".$imageid.".".$categorylogo->getClientOriginalExtension();
                $resized_category_logo->save(public_path('images/category/'.$category_logo_name));
                $category_logo_path = 'images/category/'.$category_logo_name;
                $category->logo_url = $category_logo_path;
            }
            $category->form_user_id = Auth::User()->id;
            $category->image_user_id = Auth::User()->id;
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
    public function getAllCategories(){
        $data['allcategories'] = Category::orderBy('id', 'DESC')->get();
        $data['categoriescount'] = count($data['allcategories']);
        return view('pages.category.allcategories',$data);
    }
    public function getUpdateCategory($id){
        $data['category'] = Category::find($id);
        return view('pages.category.updatecategory',$data);
    }
    public function getUpdateCategoryForm($id){
        $data['category'] = Category::find($id);
        return view('pages.category.updatecategoryform',$data);
    }
    public function postUpdateCategoryForm(Request $request){
        $imageid = null;
        $category = Category::find($request->categoryid);
        //if(title == title && topcategory == topcategory)
        if(strcasecmp($category->title , $request->categorytitle) == 0 && strcasecmp($category->is_topcategory , $request->is_topcategory) == 0){
            $category->title = $request->categorytitle;
            $category->description = $request->categorydescription;
            $category->is_topcategory = $request->is_topcategory;
            $category->is_popularcategory = $request->is_popularcategory;
            $category->status = $request->categorystatus;
            $category->form_user_id = Auth::User()->id;
            $category->save();
            Session::flash("updatecategory_successmessage","Category Updated Successfully");
            $response = [
                "status" => "true",
                "id" => $request->categoryid,
                "success_message" => "Category Updated Successfully"
            ];
            return response()->json($response);
        }
        //if(title != title && topcategory == topcategory)
        if(strcasecmp($category->title , $request->categorytitle) != 0 && strcasecmp($category->is_topcategory , $request->is_topcategory) == 0){
            $is_category_exists = Category::where("title",$request->categorytitle)->exists();
            if(!$is_category_exists){
                $category->title = $request->categorytitle;
                $category->description = $request->categorydescription;
                $category->is_topcategory = $request->is_topcategory;
                $category->is_popularcategory = $request->is_popularcategory;
                $category->status = $request->categorystatus;
                //if file exists on server
                if(File::exists($category->logo_url)){
                    do{
                        $flag = true;
                        $imageid = uniqid();
                        $flag = Category::where('logo_url','LIKE','%'.strtolower($request->categorytitle)."-".$imageid.'%')->exists();
                    }while($flag);
                    $extension = File::extension($category->logo_url);
                    $category_logo_name = strtolower($request->categorytitle)."-".$imageid.".".$extension;
                    File::move(public_path($category->logo_url),public_path('images/category/'.$category_logo_name));
                    $category_logo_path = 'images/category/'.$category_logo_name;
                    $category->logo_url = $category_logo_path;
                }
                $category->form_user_id = Auth::User()->id;
                $category->save();
                Session::flash("updatecategory_successmessage","Category Updated Successfully");
                $response = [
                    "status" => "true",
                    "id" => $request->categoryid,
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
            $category->description = $request->categorydescription;
            $category->is_topcategory = $request->is_topcategory;
            $category->is_popularcategory = $request->is_popularcategory;
            $category->status = $request->categorystatus;
            if(strcasecmp($request->is_topcategory , "no") == 0){
                if(!empty($category->logo_url) && File::exists($category->logo_url)){
                    File::delete($category->logo_url);
                    $category->logo_url = null;
                }
            }
            $category->form_user_id = Auth::User()->id;
            $category->save();
            Session::flash("updatecategory_successmessage","Category Updated Successfully");
            $response = [
                "status" => "true",
                "id" => $request->categoryid,
                "success_message" => "Category Updated Successfully"
            ];
            return response()->json($response);
        }
       //if(title != title && topcategory != topcategory)
        if(strcasecmp($category->title , $request->categorytitle) != 0 && strcasecmp($category->is_topcategory , $request->is_topcategory) != 0){
            $is_category_exists = Category::where("title",$request->categorytitle)->exists();
            if(!$is_category_exists){
                $category->title = $request->categorytitle;
                $category->description = $request->categorydescription;
                $category->is_topcategory = $request->is_topcategory;
                $category->is_popularcategory = $request->is_popularcategory;
                $category->status = $request->categorystatus;
                //if file exists on server
                if(File::exists($category->logo_url)){
                    do{
                        $flag = true;
                        $imageid = uniqid();
                        $flag = Category::where('logo_url','LIKE','%'.strtolower($request->categorytitle)."-".$imageid.'%')->exists();
                    }while($flag);
                    $extension = File::extension($category->logo_url);
                    $category_logo_name = strtolower($request->categorytitle)."-".$imageid.".".$extension;
                    File::move(public_path($category->logo_url),public_path('images/category/'.$category_logo_name));
                    $category_logo_path = 'images/category/'.$category_logo_name;
                    $category->logo_url = $category_logo_path;
                }
                if(strcasecmp($request->is_topcategory , "no") == 0){
                    if(!empty($category->logo_url) && File::exists($category->logo_url)){
                        File::delete($category->logo_url);
                        $category->logo_url = null;
                    }
                }
                $category->form_user_id = Auth::User()->id;
                $category->save();
                Session::flash("updatecategory_successmessage","Category Updated Successfully");
                $response = [
                    "status" => "true",
                    "id" => $request->categoryid,
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
            if(!File::exists(public_path("images/category"))){
                File::makeDirectory(public_path("images/category", 0777, true, true));
            }
            if(empty($category->logo_url)){
                $categorylogo_message = "Added";
            }
            else{
                $categorylogo_message = "Updated";
            }
            do{
                $flag = true;
                $imageid = uniqid();
                $flag = Category::where('logo_url','LIKE','%'.strtolower($category->title)."-".$imageid.'%')->exists();
            }while($flag);
            $categorylogo = $request->file('categorylogo');
            $resized_category_logo = Image::make($categorylogo);
            $resized_category_logo->resize(200, 200);
            $category_logo_name = strtolower($category->title)."-".$imageid.".".$categorylogo->getClientOriginalExtension();
            $resized_category_logo->save(public_path('images/category/'.$category_logo_name));
            $category_logo_path = 'images/category/'.$category_logo_name;
            $category->logo_url = $category_logo_path;
            $category->image_user_id = Auth::User()->id;
            $category->save();
            Session::flash("updatecategorylogo_successmessage","Category Logo ".$categorylogo_message." Successfully");
            $response = [
                "status" => "true",
                "id" => $formdata->categoryid,
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
            if(File::exists($category->logo_url)){
                File::delete($category->logo_url);
            }
            $category->delete();
            $response = [
                "status" => "true",
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
