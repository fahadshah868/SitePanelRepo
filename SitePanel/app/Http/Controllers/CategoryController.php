<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Session;

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
            $category->type = $formdata->categorytype;
            $category->status = $formdata->categorystatus;
            if($request->hasFile('categorylogo')){
                if(!File::exists(public_path("images/category"))){
                    File::makeDirectory(public_path("images/category", 0777, true, true));
                }
                $categorylogo = $request->file('categorylogo');
                $resized_category_logo = Image::make($categorylogo);
                $resized_category_logo->resize(200, 200);
                $category_logo_name = strtolower($formdata->categorytitle).".".$categorylogo->getClientOriginalExtension();
                $resized_category_logo->save(public_path('images/category/'.$category_logo_name));
                $category_logo_path = 'images/category/'.$category_logo_name;
                $category->logo_url = $category_logo_path;
            }
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
        $category = Category::find($request->categoryid);
        //if(title == title && type == type)
        if(strcasecmp($category->title , $request->categorytitle) == 0 && strcasecmp($category->type , $request->categorytype) == 0){
            $category->title = $request->categorytitle;
            $category->type = $request->categorytype;
            $category->status = $request->categorystatus;
            $category->save();
            Session::flash("updatecategory_successmessage","Category Updated Successfully");
            $response = [
                "status" => "true",
                "id" => $request->categoryid,
                "success_message" => "Category Updated Successfully"
            ];
            return response()->json($response);
        }
        //if(title != title && type == type)
        else if(strcasecmp($category->title , $request->categorytitle) != 0 && strcasecmp($category->type , $request->categorytype) == 0){
            $is_category_exists = Category::where("title",$request->categorytitle)->exists();
            if(!$is_category_exists){
                $category->title = $request->categorytitle;
                $category->type = $request->categorytype;
                $category->status = $request->categorystatus;
                //if file exists on server
                if(File::exists($category->logo_url)){
                    $extension = File::extension($category->logo_url);
                    $category_logo_name = strtolower($request->categorytitle).".".$extension;
                    File::move(public_path($category->logo_url),public_path('images/category/'.$category_logo_name));
                    $category_logo_path = 'images/category/'.$category_logo_name;
                    $category->logo_url = $category_logo_path;
                }
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
        //if(title == title && type != type)
        else if(strcasecmp($category->title , $request->categorytitle) == 0 && strcasecmp($category->type , $request->categorytype) != 0){
            $category->title = $request->categorytitle;
            $category->type = $request->categorytype;
            $category->status = $request->categorystatus;
            if(strcasecmp($request->categorytype , "regular") == 0){
                if(!empty($category->logo_url) && File::exists($category->logo_url)){
                    File::delete($category->logo_url);
                    $category->logo_url = null;
                }
            }
            $category->save();
            Session::flash("updatecategory_successmessage","Category Updated Successfully");
            $response = [
                "status" => "true",
                "id" => $request->categoryid,
                "success_message" => "Category Updated Successfully"
            ];
            return response()->json($response);
        }
        //if(title != title && type != type)
        else if(strcasecmp($category->title , $request->categorytitle) != 0 && strcasecmp($category->type , $request->categorytype) != 0){
            $is_category_exists = Category::where("title",$request->categorytitle)->exists();
            if(!$is_category_exists){
                $category->title = $request->categorytitle;
                $category->type = $request->categorytype;
                $category->status = $request->categorystatus;
                //if file exists on server
                if(File::exists($category->logo_url)){
                    $extension = File::extension($category->logo_url);
                    $category_logo_name = strtolower($request->categorytitle).".".$extension;
                    File::move(public_path($category->logo_url),public_path('images/category/'.$category_logo_name));
                    $category_logo_path = 'images/category/'.$category_logo_name;
                    $category->logo_url = $category_logo_path;
                }
                if(strcasecmp($category->type , "regular") == 0){
                    if(!empty($category->logo_url) && File::exists($category->logo_url)){
                        File::delete($category->logo_url);
                        $category->logo_url = null;
                    }
                }
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
            $categorylogo = $request->file('categorylogo');
            $resized_category_logo = Image::make($categorylogo);
            $resized_category_logo->resize(200, 200);
            $category_logo_name = strtolower($category->title).".".$categorylogo->getClientOriginalExtension();
            $resized_category_logo->save(public_path('images/category/'.$category_logo_name));
            $category_logo_path = 'images/category/'.$category_logo_name;
            $category->logo_url = $category_logo_path;
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
}
