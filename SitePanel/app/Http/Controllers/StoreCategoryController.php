<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreCategory;
use App\Store;
use App\Category;
use Session;
use Auth;

class StoreCategoryController extends Controller
{
    public function getAllStoreCategories(){
        $data['allstores'] = Store::orderBy('id', 'DESC')->get();
        $data['storescount'] = count($data['allstores']);
        return view('pages.storecategory.viewstorecategories', $data);
    }
    public function getUpdateStoreCategories($id){
        $data['allcategories'] = Category::all();
        $data['store'] = Store::find($id);
        return view('pages.storecategory.updatestorecategories',$data);
    }
    public function postUpdateStoreCategories(Request $request){
        $storecategories = StoreCategory::where('store_id',$request->storeid);
        $storecategories->delete();
        for($category=0; $category< count($request->storecategories); $category++){
            $storecategory = new StoreCategory;
            $storecategory->store_id = $request->storeid;
            $storecategory->store_title = $request->storeid->title;
            $storecategory->category_id = $request->storecategories[$category];
            $storecategory->category_title = $request->storecategories[$category]->title;
            $storecategory->user_id = Auth::User()->id;
            $storecategory->save();
        }
        Session::flash("updatestorecategories_successmessage","Store Categories Updated Successfully");
        $response = [
            "status" => "true",
            "success_message" => "Store Categories Updated Successfully"
        ];
        return response()->json($response);
    }
}
