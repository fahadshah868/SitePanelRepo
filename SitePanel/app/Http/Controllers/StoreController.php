<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use File;
use Session;

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
            $store->title = ucwords($formdata->storetitle);
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
                $is_save = $store->save();
                if($is_save){
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
                    "success_message" => "Error! Store Logo Not Found"
                ];
                return response()->json($response);
            }
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => ucwords($formdata->storetitle)."! This Store is Already Added"
            ];
            return response()->json($response);
        }
    }
    public function getAllStores(){
        $data['allstores'] = Store::all();
        $data['storescount'] = count($data['allstores']);
        return view('pages.store.allstores', $data);
    }
    public function getUpdateStore($id){
        $data['store'] = Store::find($id);
        return view('pages.store.updatestore',$data);
    }
    public function getUpdateStoreForm($id){
        $data['store'] = Store::find($id);
        return view('pages.store.updatestoreform',$data);
    }
    public function postUpdateStoreForm(Request $request){
        $store = Store::find($request->storeid);
        $store->title = $request->storetitle;
        $store->site_url = $request->storesiteurl;
        $store->type = $request->storetype;
        $store->status = $request->storestatus;
        $is_update = $store->save();
        if($is_update){
            Session::flash("updatestore_successmessage","Store Updated Successfully");
            $response = [
                "status" => "true",
                "success_message" => "Store Updated Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Error! Store Is Not Updated Successfully"
            ];
            return response()->json($response);
        }
    }
    public function deleteStore($id){
        $store = Store::find($id);
        if(File::exists($store->logo_url)){
            File::delete($store->logo_url);
        }
        $is_delete = $store->delete();
        if($is_delete){
            $response = [
                "status" => "true",
                "success_message" => "Store Deleted Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Error! Store Not Deleted Successfully"
            ];
            return response()->json($response);
        }
    }
}