<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreCategoryGroup;
use App\Store;
use App\Category;

class StoreCategoryGroupController extends Controller
{
    public function getAllStoreCategories(){
        $data['allstores'] = Store::all();
        $data['storescount'] = count($data['allstores']);
        return view('pages.store.allstorecategories', $data);
    }
    public function getUpdateStoreCategories($id){
        $data['allcategories'] = Category::all();
        $data['store'] = Store::find($id);
        return view('pages.store.updatestorecategories',$data);
    }
}
