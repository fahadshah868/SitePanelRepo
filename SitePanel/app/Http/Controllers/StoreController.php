<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{
    public function getAddStore(){
        return View('pages.store.addstore');
    }
    public function postAddStore(Request $request){
        $formdata = json_decode($request->formdata);
        $is_store_exist = Store::where('title',$formdata->storetitle)->first();
        if(!$is_store_exist){
            $store = new Store;
            $store->title = $formdata->storetitle;
            $store->site_url = $formdata->storesiteurl;
            $store->type = $formdata->storetype;
            $store->status = $formdata->storestatus;
            //upload file and save path into db
            if($request->hasFile('storelogo')){
                $storelogo = $request->file('storelogo');
                $store_logo_name = $formdata->storetitle.".".$storelogo->getClientOriginalExtension();
                $storelogo->move('images/store/',$store_logo_name);
                $store_logo_path = 'images/store/'.$store_logo_name;
                $store->logo_url = $store_logo_path;
                $store->save();
                $response = [
                    "status" => "true",
                    "success_message" => "Add Store Successfully"
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "success_message" => "Error! Store Is Not Added Successfully"
                ];
                return response()->json($response);
            }
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => $formdata->storetitle."! This Store is Already Added"
            ];
            return response()->json($response);
        }
    }
    public function getAllStores(){
        $data['allstores'] = Store::all();
        $data['storescount'] = count($data['allstores']);
        return view('pages.store.allstores', $data);
    }
}