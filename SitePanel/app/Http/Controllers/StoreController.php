<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
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
        $is_storetitle_exists = Store::where('title',$formdata->storetitle)->exists();
        if(!$is_storetitle_exists){
            $is_storesiteurl_exists = Store::where('site_url',$formdata->storesiteurl)->exists();
            if(!$is_storesiteurl_exists){
                $store = new Store;
                $domain = parse_url($formdata->storesiteurl);
                $domain = strtolower($domain['host']);
                $domain = str_replace("www.","",$domain);
                $store->store_url = $domain;
                $store->title = $formdata->storetitle; //set all characters to lowercase except first letter of all words
                $store->site_url = strtolower($formdata->storesiteurl);
                $store->type = $formdata->storetype;
                $store->status = $formdata->storestatus;
                //upload file and save path into db
                if($request->hasFile('storelogo')){
                    if(!File::exists(public_path("images/store"))){
                        File::makeDirectory(public_path("images/store", 0777, true, true));
                    }
                    $storelogo = $request->file('storelogo');
                    $resized_store_logo = Image::make($storelogo);
                    $resized_store_logo->resize(200, 200);
                    $store_logo_name = $domain."-coupons.".$storelogo->getClientOriginalExtension();
                    $resized_store_logo->save(public_path('images/store/'.$store_logo_name));
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
                            "error_message" => "Error! Store Is Not Added Successfully"
                        ];
                        return response()->json($response);
                    }
                }
                else{
                    $response = [
                        "status" => "false",
                        "error_message" => "Error! Store Logo Not Found"
                    ];
                    return response()->json($response);
                }
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => strtolower($formdata->storesiteurl)."! This Store Site Url is Already Added"
                ];
                return response()->json($response);
            }
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => $formdata->storetitle."! This Store Title is Already Added"
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
        if($store->title == $request->storetitle && $store->site_url == $request->storesiteurl){
            $store->title = $request->storetitle;
            $store->site_url = strtolower($request->storesiteurl);
            $store->type = $request->storetype;
            $store->status = $request->storestatus;
            $is_store_updated = $store->save();
            if($is_store_updated){
                Session::flash("updatestore_successmessage","Store Updated Successfully");
                $response = [
                    "status" => "true",
                    "id" => $request->storeid,
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
        else if($store->title != $request->storetitle && $store->site_url == $request->storesiteurl){
            $is_storetitle_exists = Store::where('title',$request->storetitle)->exists();
            if(!$is_storetitle_exists){
                $store->title = $request->storetitle;
                $store->site_url = strtolower($request->storesiteurl);
                $store->type = $request->storetype;
                $store->status = $request->storestatus;
                $is_store_updated = $store->save();
                if($is_store_updated){
                    Session::flash("updatestore_successmessage","Store Updated Successfully");
                    $response = [
                        "status" => "true",
                        "id" => $request->storeid,
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
            else{
                $response = [
                    "status" => "false",
                    "error_message" => $request->storetitle."! This Store Title Is Already Added"
                ];
                return response()->json($response);
            }
        }
        else if($store->title == $request->storetitle && $store->site_url != $request->storesiteurl){
            $is_storesiteurl_exists = Store::where('site_url',$request->storesiteurl)->exists();
            if(!$is_storesiteurl_exists){
                $domain = parse_url($request->storesiteurl);
                $domain = strtolower($domain['host']);
                $domain = str_replace("www.","",$domain);
                $store->store_url = $domain;
                $store->title = $request->storetitle;
                $store->site_url = strtolower($request->storesiteurl);
                $store->type = $request->storetype;
                $store->status = $request->storestatus;
                //if file exists on server
                if(File::exists($store->logo_url)){
                    $extension = File::extension($store->logo_url);
                    $store_logo_name = $domain."-coupons.".$extension;
                    File::move($store->logo_url,'images/store/'.$store_logo_name);
                    $store_logo_path = 'images/store/'.$store_logo_name;
                    $store->logo_url = $store_logo_path;
                    $is_store_updated = $store->save();
                    if($is_store_updated){
                        Session::flash("updatestore_successmessage","Store Updated Successfully");
                        $response = [
                            "status" => "true",
                            "id" => $request->storeid,
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
                else{
                    $response = [
                        "status" => "false",
                        "error_message" => "Error! Store Logo Does Not Exist On Server"
                    ];
                    return response()->json($response);
                }
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => strtolower($request->storesiteurl)."! This Store Site Url Is Already Added"
                ];
                return response()->json($response);
            }
        }
        else if($store->title != $request->storetitle && $store->site_url != $request->storesiteurl){
            $is_storetitle_exists = Store::where('title',$request->storetitle)->exists();
            if(!$is_storetitle_exists){
                $is_storesiteurl_exists = Store::where('site_url',$request->storesiteurl)->exists();
                if(!$is_storesiteurl_exists){
                    $domain = parse_url($request->storesiteurl);
                    $domain = strtolower($domain['host']);
                    $domain = str_replace("www.","",$domain);
                    $store->store_url = $domain;
                    $store->title = $request->storetitle;
                    $store->site_url = strtolower($request->storesiteurl);
                    $store->type = $request->storetype;
                    $store->status = $request->storestatus;
                    //if file exists on server
                    if(File::exists($store->logo_url)){
                        $extension = File::extension($store->logo_url);
                        $store_logo_name = $domain."-coupons.".$extension;
                        File::move($store->logo_url,'images/store/'.$store_logo_name);
                        $store_logo_path = 'images/store/'.$store_logo_name;
                        $store->logo_url = $store_logo_path;
                        $is_store_updated = $store->save();
                        if($is_store_updated){
                            Session::flash("updatestore_successmessage","Store Updated Successfully");
                            $response = [
                                "status" => "true",
                                "id" => $request->storeid,
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
                    else{
                        $response = [
                            "status" => "false",
                            "error_message" => "Error! Store Logo Does Not Exist On Server"
                        ];
                        return response()->json($response);
                    }
                }
                else{
                    $response = [
                        "status" => "false",
                        "error_message" => strtolower($request->storesiteurl)."! This Store Site Url is Already Added"
                    ];
                    return response()->json($response);
                }
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => $request->storetitle."! This Store Title is Already Added"
                ];
                return response()->json($response);
        }
        }
    }
    public function postUpdateStoreImage(Request $request){
        $formdata = json_decode($request->formdata);
        $store = Store::find($formdata->storeid);
        if($request->hasFile('storelogo')){
            if(File::exists($store->logo_url)){
                File::delete($store->logo_url);
            }
            $domain = parse_url($store->site_url);
            $domain = str_replace("www.","",$domain['host']);
            $domain = strtolower($domain);
            $storelogo = $request->file('storelogo');
            $resized_store_logo = Image::make($storelogo);
            $resized_store_logo->resize(200, 200);
            $store_logo_name = $domain."-coupons.".$storelogo->getClientOriginalExtension();
            $resized_store_logo->save(public_path('images/store/'.$store_logo_name));
            $store_logo_path = 'images/store/'.$store_logo_name;
            $store->logo_url = $store_logo_path;
            $is_save = $store->save();
            if($is_save){
                Session::flash("updatestorelogo_successmessage","Update Store Logo Successfully");
                $response = [
                    "status" => "true",
                    "id" => $formdata->storeid,
                    "success_message" => "Update Store Logo Successfully"
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
        else{
            $response = [
                "status" => "false",
                "error_message" => "Error! Store Logo Not Found"
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