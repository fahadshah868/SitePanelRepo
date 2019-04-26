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
        $data['allstores'] = Store::select('id','title')->with(['storecategories' => function($q){
            $q->select('id','store_id','category_id','user_id')->with(['category' => function($cq){
                $cq->select('id','title');
            }, 'user' => function($uq){
                $uq->select('id','username');
            }]);
        }])->orderBy('id', 'DESC')->get();
        $data['storescount'] = count($data['allstores']);
        return view('pages.storecategory.viewstorecategories', $data);
    }
    public function getUpdateStoreCategories($id){
        $data['allcategories'] = Category::select('id','title')->where('status',1)->get();
        $data['store'] = Store::select('id','title')->with(['storecategories' => function($q){
            $q->select('store_id','category_id');
        }])->find($id);
        return view('pages.storecategory.updatestorecategories',$data);
    }
    public function postUpdateStoreCategories(Request $request){
        $storecategories = StoreCategory::where('store_id',$request->storeid);
        $storecategories->delete();
        for($category=0; $category< count($request->storecategories); $category++){
            $storecategorieslist[] = [
                'store_id' => $request->storeid,
                'category_id' => $request->storecategories[$category],
                'user_id' => Auth::User()->id
            ];
        }
        StoreCategory::insert($storecategorieslist);
        Session::flash("updatestorecategories_successmessage","Store Categories Updated Successfully");
        $response = [
            "status" => "true",
            "success_message" => "Store Categories Updated Successfully"
        ];
        return response()->json($response);
    }
}
