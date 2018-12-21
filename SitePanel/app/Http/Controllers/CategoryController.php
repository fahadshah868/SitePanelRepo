<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class CategoryController extends Controller
{
    public function getAddCategory(){
        return view('pages.category.addcategory');
    }
    public function postAddCategory(Request $request){
        $formdata = json_decode($request->formdata);
        $is_category_exists = Category::find($formdata->categorytitle);
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
            $is_save = $category->save();
            if($is_save){
                $response = [
                    "status" => "true",
                    "success_message" => "Add Category Successfully"
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "success_message" => "Error! Category Is Not Added Successfully"
                ];
                return response()->json($response);
            }
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
        $data['allcategories'] = Category::all();
        $data['categoriescount'] = count($data['allcategories']);
        return view('pages.category.allcategories',$data);
    }
    public function deleteCategory($id){
        $category = Category::find($id);
        if(File::exists($category->logo_url)){
            File::delete($category->logo_url);
        }
        $is_delete = $category->delete();
        if($is_delete){
            $response = [
                "status" => "true",
                "success_message" => "Category Deleted Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Error! Category Not Deleted Successfully"
            ];
            return response()->json($response);
        }
    }
}
