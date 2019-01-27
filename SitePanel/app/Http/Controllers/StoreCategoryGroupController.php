<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreCategoryGroup;
use App\Store;
use App\Category;
use Session;
use Auth;

class StoreCategoryGroupController extends Controller
{
    public function getAllStoreCategories(){
        $data['allstores'] = Store::all();
        $data['storescount'] = count($data['allstores']);
        return view('pages.storecategorygroup.allstorecategories', $data);
    }
    public function getUpdateStoreCategories($id){
        $data['allcategories'] = Category::all();
        $data['store'] = Store::find($id);
        return view('pages.storecategorygroup.updatestorecategories',$data);
    }
    public function postUpdateStoreCategories(Request $request){
        $storecategorygroup = StoreCategoryGroup::where('store_id',$request->storeid);
        $storecategorygroup->delete();
        for($category=0; $category< count($request->storecategories); $category++){
            $storecategorygroup = new StoreCategoryGroup;
            $storecategorygroup->store_id = $request->storeid;
            $storecategorygroup->category_id = $request->storecategories[$category];
            $storecategorygroup->user_id = Auth::User()->id;
            $storecategorygroup->save();
        }
        Session::flash("updatestorecategories_successmessage","Store Categories Updated Successfully");
        $response = [
            "status" => "true",
            "success_message" => "Store Categories Updated Successfully"
        ];
        return response()->json($response);
    }
}
