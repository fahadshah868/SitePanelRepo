<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{
    public function getaddStore(){
        return View('pages.store.addstore');
    }
    public function postAddStore(Request $request){
        $store = new Store;
        $store->title = $request->get('storetitle');
        $store->site_url = $request->get('storesiteurl');
        $store->type = $request->get('storetype');
        $store->status = $request->get('storestatus');
        if($request->hasFile('storelogo')){

        }
        return response()->json();
    }
    public function getAllStores(){
        return view('pages.store.allstores');
    }
}
