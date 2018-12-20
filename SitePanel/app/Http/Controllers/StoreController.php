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
                $domain = str_replace("www.","",$domain['host']);
                $store->id = $domain;
                $store->title = ucwords($formdata->storetitle);
                $store->site_url = $formdata->storesiteurl;
                $store->type = $formdata->storetype;
                $store->status = $formdata->storestatus;
                //upload file and save path into db
                if($request->hasFile('storelogo')){
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
                    "error_message" => ucwords($formdata->storesiteurl)."! This Store Site Url is Already Added"
                ];
                return response()->json($response);
            }
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => ucwords($formdata->storetitle)."! This Store Title is Already Added"
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
            $store->title = ucwords($request->storetitle);
            $store->site_url = $request->storesiteurl;
            $store->type = $request->storetype;
            $store->status = $request->storestatus;
            $is_store_updated = $store->save();
            if($is_store_updated){
                Session::flash("updatestore_successmessage","Store Updated Successfully");
                $response = [
                    "status" => "true",
                    "id" => $request->id,
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
                $store->title = ucwords($request->storetitle);
                $store->site_url = $request->storesiteurl;
                $store->type = $request->storetype;
                $store->status = $request->storestatus;
                $is_store_updated = $store->save();
                if($is_store_updated){
                    Session::flash("updatestore_successmessage","Store Updated Successfully");
                    $response = [
                        "status" => "true",
                        "id" => $request->id,
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
                    "error_message" => ucwords($request->storetitle)."! This Store Title Is Already Added"
                ];
                return response()->json($response);
            }
        }
        else if($store->title == $request->storetitle && $store->site_url != $request->storesiteurl){
            $is_storesiteurl_exists = Store::where('site_url',$request->storesiteurl)->exists();
            if(!$is_storesiteurl_exists){
                $domain = parse_url($request->storesiteurl);
                $domain = str_replace("www.","",$domain['host']);
                $store->id = $domain;
                $store->title = ucwords($request->storetitle);
                $store->site_url = $request->storesiteurl;
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
                            "id" => $domain,
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
                    "error_message" => ucwords($request->storesiteurl)."! This Store Site Url Is Already Added"
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
                    $domain = str_replace("www.","",$domain['host']);
                    $store->id = $domain;
                    $store->title = ucwords($request->storetitle);
                    $store->site_url = $request->storesiteurl;
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
                                "id" => $domain,
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
                        "error_message" => ucwords($request->storesiteurl)."! This Store Site Url is Already Added"
                    ];
                    return response()->json($response);
                }
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => ucwords($request->storetitle)."! This Store Title is Already Added"
                ];
                return response()->json($response);
        }
        }
    }
    public function postUpdateStoreImage(Request $request){
        $formdata = json_decode($request->formdata);
        $store = Store::find($formdata->storeid);
        if($request->hasFile('storelogo')){
            $storelogo = $request->file('storelogo');
            $store_logo_name = ucwords($store->title).".".$storelogo->getClientOriginalExtension();
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