<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Store;
use App\Category;
use App\Network;
use App\StoreCategoryGroup;
use File;
use Session;
use Auth;

class StoreController extends Controller
{
    public function getAddStore(){
        $data['allcategories'] = Category::where('status','active')->get();
        $data['allnetworks'] = Network::where('status','active')->get();
        return View('pages.store.addstore',$data);
    }
    public function postAddStore(Request $request){
        $formdata = json_decode($request->formdata);
        $are_storefields_exists = Store::where('title',$formdata->storetitle)
                                ->orwhere('primary_url',$formdata->storeprimaryurl)
                                ->orwhere('network_url',$formdata->storenetworkurl)
                                ->exists();
        if(!$are_storefields_exists){
            $store = new Store;
            $store->title = $formdata->storetitle;
            $store->description = $formdata->storedescription;
            $store->primary_url = strtolower($formdata->storeprimaryurl);
            $store->secondary_url = strtolower($formdata->storesecondaryurl);
            $store->network_id = $formdata->networkid;
            $store->network_url = $formdata->storenetworkurl;
            $store->is_topstore = $formdata->is_topstore;
            $store->is_popularstore = $formdata->is_popularstore;
            $store->status = $formdata->storestatus;
            //upload file and save path into db
            if($request->hasFile('storelogo')){
                if(!File::exists(public_path("images/store"))){
                    File::makeDirectory(public_path("images/store", 0777, true, true));
                }
                $storelogo = $request->file('storelogo');
                $resized_store_logo = Image::make($storelogo);
                $resized_store_logo->resize(200, 200);
                $store_logo_name = strtolower($formdata->storesecondaryurl)."-coupons.".$storelogo->getClientOriginalExtension();
                $resized_store_logo->save(public_path('images/store/'.$store_logo_name));
                $store_logo_path = 'images/store/'.$store_logo_name;
                $store->logo_url = $store_logo_path;
                $store->form_user_id = Auth::User()->id;
                $store->image_user_id = Auth::User()->id;
                $store->save();
                for($category=0; $category< count($formdata->storecategories); $category++){
                    $storecategorygroup = new StoreCategoryGroup;
                    $storecategorygroup->store_id = $store->id;
                    $storecategorygroup->category_id = $formdata->storecategories[$category];
                    $storecategorygroup->user_id = Auth::User()->id;
                    $storecategorygroup->save();
                }
                $response = [
                    "status" => "true",
                    "success_message" => "Store Added Successfully"
                ];
                return response()->json($response);
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
                "error_message" => nl2br("Store Title:  ".$formdata->storetitle."\nStore Primary Url:  ".$formdata->storeprimaryurl."\nStore Network Url:  ".$formdata->storenetworkurl."\nSome Of Above Fields Are Already Added. Above Fields must Be Unique. Try Again With Different Values.")
            ];
            return response()->json($response);
        }
    }
    public function getAllStores(){
        $data['allstores'] = Store::orderBy('id', 'DESC')->get();
        $data['storescount'] = count($data['allstores']);
        return view('pages.store.allstores', $data);
    }
    public function getUpdateStore($id){
        $data['store'] = Store::find($id);
        return view('pages.store.updatestore',$data);
    }
    public function getUpdateStoreForm($id){
        $data['store'] = Store::find($id);
        $data['allnetworks'] = Network::all();
        return view('pages.store.updatestoreform',$data);
    }
    public function postUpdateStoreForm(Request $request){
        $store = Store::find($request->storeid);
        // title == title && primaryurl == primaryurl && networkurl == networkurl
        if((strcasecmp($store->title , $request->storetitle) == 0 && strcasecmp($store->primary_url , $request->storeprimaryurl) == 0) && strcasecmp($store->network_url, $request->storenetworkurl) == 0){
            $store->title = $request->storetitle;
            $store->description = $request->storedescription;
            $store->primary_url = strtolower($request->storeprimaryurl);
            $store->secondary_url = strtolower($request->storesecondaryurl);
            $store->network_id = $request->networkid;
            $store->network_url = $request->storenetworkurl;
            $store->is_topstore = $request->is_topstore;
            $store->is_popularstore = $request->is_popularstore;
            $store->status = $request->storestatus;
            $store->form_user_id = Auth::User()->id;
            $store->save();
            Session::flash("updatestore_successmessage","Store Updated Successfully");
            $response = [
                "status" => "true",
                "success_message" => "Store Updated Successfully",
                "storeid" => $request->storeid
            ];
            return response()->json($response);
        }
        // title != title && primaryurl == primaryurl && networkurl == networkurl
        else if((strcasecmp($store->title , $request->storetitle) != 0 && strcasecmp($store->primary_url , $request->storeprimaryurl) == 0) && strcasecmp($store->network_url, $request->storenetworkurl) == 0){
            $is_storetitle_exists = Store::where('title',$request->storetitle)->exists();
            if(!$is_storetitle_exists){
                $store->title = $request->storetitle;
                $store->description = $request->storedescription;
                $store->primary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = strtolower($request->storesecondaryurl);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_topstore = $request->is_topstore;
                $store->is_popularstore = $request->is_popularstore;
                $store->status = $request->storestatus;
                $store->form_user_id = Auth::User()->id;
                $store->save();
                Session::flash("updatestore_successmessage","Store Updated Successfully");
                $response = [
                    "status" => "true",
                    "success_message" => "Store Updated Successfully",
                    "storeid" => $request->storeid
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => $request->storetitle."! This Store Title is Already Added"
                ];
                return response()->json($response);
            }
        }
        // title == title && primaryurl != primaryurl && networkurl == networkurl
        else if((strcasecmp($store->title , $request->storetitle) == 0 && strcasecmp($store->primary_url , $request->storeprimaryurl) != 0) && strcasecmp($store->network_url, $request->storenetworkurl) == 0){
            $is_storeprimaryurl_exists = Store::where('primary_url',$request->storeprimaryurl)->exists();
            if(!$is_storeprimaryurl_exists){
                $store->title = $request->storetitle;
                $store->description = $request->storedescription;
                $store->primary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = strtolower($request->storesecondaryurl);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_popularstore = $request->is_popularstore;
                $store->status = $request->storestatus;
                $store->status = $request->storestatus;
                if(File::exists($store->logo_url)){
                    $extension = File::extension($store->logo_url);
                    $store_logo_name = strtolower($request->storesecondaryurl)."-coupons.".$extension;
                    File::move(public_path($store->logo_url),public_path('images/store/'.$store_logo_name));
                    $store_logo_path = 'images/store/'.$store_logo_name;
                    $store->logo_url = $store_logo_path;
                }
                $store->form_user_id = Auth::User()->id;
                $store->save();
                Session::flash("updatestore_successmessage","Store Updated Successfully");
                $response = [
                    "status" => "true",
                    "success_message" => "Store Updated Successfully",
                    "storeid" => $request->storeid
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => $request->storeprimaryurl."! This Store Primary Url is Already Added"
                ];
                return response()->json($response);
            }
        }
        // title == title && primaryurl == primaryurl && networkurl == networkurl
        else if((strcasecmp($store->title , $request->storetitle) == 0 && strcasecmp($store->primary_url , $request->storeprimaryurl) == 0) && strcasecmp($store->network_url, $request->storenetworkurl) != 0){
            $is_storenetworkurl_exists = Store::where('network_url',$request->storenetworkurl)->exists();
            if(!$is_storenetworkurl_exists){
                $store->title = $request->storetitle;
                $store->description = $request->storedescription;
                $store->primary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = strtolower($request->storesecondaryurl);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_popularstore = $request->is_popularstore;
                $store->status = $request->storestatus;
                $store->status = $request->storestatus;
                $store->form_user_id = Auth::User()->id;
                $store->save();
                Session::flash("updatestore_successmessage","Store Updated Successfully");
                $response = [
                    "status" => "true",
                    "success_message" => "Store Updated Successfully",
                    "storeid" => $request->storeid
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => $request->storenetworkurl."! This Store Network Url is Already Added"
                ];
                return response()->json($response);
            }
        }
        // title != title && primaryurl != primaryurl && networkurl == networkurl
        else if((strcasecmp($store->title , $request->storetitle) != 0 && strcasecmp($store->primary_url , $request->storeprimaryurl) != 0) && strcasecmp($store->network_url, $request->storenetworkurl) == 0){
            $are_storefields_exists = Store::where('title',$request->storetitle)
                                    ->orwhere('primary_url',$request->storeprimaryurl)
                                    ->exists();
            if(!$are_storefields_exists){
                $store->title = $request->storetitle;
                $store->description = $request->storedescription;
                $store->primary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = strtolower($request->storesecondaryurl);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_popularstore = $request->is_popularstore;
                $store->status = $request->storestatus;
                $store->status = $request->storestatus;
                if(File::exists($store->logo_url)){
                    $extension = File::extension($store->logo_url);
                    $store_logo_name = strtolower($request->storesecondaryurl)."-coupons.".$extension;
                    File::move(public_path($store->logo_url),public_path('images/store/'.$store_logo_name));
                    $store_logo_path = 'images/store/'.$store_logo_name;
                    $store->logo_url = $store_logo_path;
                }
                $store->form_user_id = Auth::User()->id;
                $store->save();
                Session::flash("updatestore_successmessage","Store Updated Successfully");
                $response = [
                    "status" => "true",
                    "success_message" => "Store Updated Successfully",
                    "storeid" => $request->storeid
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => nl2br("Store Title:  ".$request->storetitle."\nStore Primary Url:  ".$request->storeprimaryurl."\nSome Of Above Fields Are Already Added. Above Fields must Be Unique. Try Again With Different Values.")
                ];
                return response()->json($response);
            }
        }
        // title == title && primaryurl != primaryurl && networkurl == networkurl
        else if((strcasecmp($store->title , $request->storetitle) == 0 && strcasecmp($store->primary_url , $request->storeprimaryurl) != 0) && strcasecmp($store->network_url, $request->storenetworkurl) != 0){
            $are_storefields_exists = Store::where('primary_url',$request->storeprimaryurl)
                                    ->orwhere('network_url',$request->storenetworkurl)
                                    ->exists();
            if(!$are_storefields_exists){
                $store->title = $request->storetitle;
                $store->description = $request->storedescription;
                $store->primary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = strtolower($request->storesecondaryurl);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_popularstore = $request->is_popularstore;
                $store->status = $request->storestatus;
                $store->status = $request->storestatus;
                if(File::exists($store->logo_url)){
                    $extension = File::extension($store->logo_url);
                    $store_logo_name = strtolower($request->storesecondaryurl)."-coupons.".$extension;
                    File::move(public_path($store->logo_url),public_path('images/store/'.$store_logo_name));
                    $store_logo_path = 'images/store/'.$store_logo_name;
                    $store->logo_url = $store_logo_path;
                }
                $store->form_user_id = Auth::User()->id;
                $store->save();
                Session::flash("updatestore_successmessage","Store Updated Successfully");
                $response = [
                    "status" => "true",
                    "success_message" => "Store Updated Successfully",
                    "storeid" => $request->storeid
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => nl2br("Store Primary Url:  ".$request->storeprimaryurl."\nStore Network Url:  ".$request->storenetworkurl."\nSome Of Above Fields Are Already Added. Above Fields must Be Unique. Try Again With Different Values.")
                ];
                return response()->json($response);
            }
        }
        // title != title && primaryurl = primaryurl && networkurl == networkurl
        else if((strcasecmp($store->title , $request->storetitle) != 0 && strcasecmp($store->primary_url , $request->storeprimaryurl) == 0) && strcasecmp($store->network_url, $request->storenetworkurl) != 0){
            $are_storefields_exists = Store::where('title',$request->storetitle)
                                    ->orwhere('network_url',$request->storenetworkurl)
                                    ->exists();
            if(!$are_storefields_exists){
                $store->title = $request->storetitle;
                $store->description = $request->storedescription;
                $store->primary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = strtolower($request->storesecondaryurl);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_popularstore = $request->is_popularstore;
                $store->status = $request->storestatus;
                $store->status = $request->storestatus;
                $store->form_user_id = Auth::User()->id;
                $store->save();
                Session::flash("updatestore_successmessage","Store Updated Successfully");
                $response = [
                    "status" => "true",
                    "success_message" => "Store Updated Successfully",
                    "storeid" => $request->storeid
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => nl2br("Store Title:  ".$request->storetitle."\nStore Network Url:  ".$request->storenetworkurl."\nSome Of Above Fields Are Already Added. Above Fields must Be Unique. Try Again With Different Values.")
                ];
                return response()->json($response);
            }
        }
        // title != title && primaryurl != primaryurl && networkurl == networkurl
        else if((strcasecmp($store->title , $request->storetitle) != 0 && strcasecmp($store->primary_url , $request->storeprimaryurl) != 0) && strcasecmp($store->network_url, $request->storenetworkurl) != 0){
            $are_storefields_exists = Store::where('title',$request->storetitle)
                                ->orwhere('primary_url',$request->storeprimaryurl)
                                ->orwhere('network_url',$request->storenetworkurl)
                                ->exists();
            if(!$are_storefields_exists){
                $store->title = $request->storetitle;
                $store->description = $request->storedescription;
                $store->primary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = strtolower($request->storesecondaryurl);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_popularstore = $request->is_popularstore;
                $store->status = $request->storestatus;
                $store->status = $request->storestatus;
                if(File::exists($store->logo_url)){
                    $extension = File::extension($store->logo_url);
                    $store_logo_name = strtolower($request->storesecondaryurl)."-coupons.".$extension;
                    File::move(public_path($store->logo_url),public_path('images/store/'.$store_logo_name));
                    $store_logo_path = 'images/store/'.$store_logo_name;
                    $store->logo_url = $store_logo_path;
                }
                $store->form_user_id = Auth::User()->id;
                $store->save();
                Session::flash("updatestore_successmessage","Store Updated Successfully");
                $response = [
                    "status" => "true",
                    "success_message" => "Store Updated Successfully",
                    "storeid" => $request->storeid
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => nl2br("Store Title:  ".$request->storetitle."\nStore Primary Url:  ".$request->storeprimaryurl."\nStore Network Url:  ".$request->storenetworkurl."\nSome Of Above Fields Are Already Added. Above Fields must Be Unique. Try Again With Different Values.")
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
            $storelogo = $request->file('storelogo');
            $resized_store_logo = Image::make($storelogo);
            $resized_store_logo->resize(200, 200);
            $store_logo_name = $store->secondary_url."-coupons.".$storelogo->getClientOriginalExtension();
            $resized_store_logo->save(public_path('images/store/'.$store_logo_name));
            $store_logo_path = 'images/store/'.$store_logo_name;
            $store->logo_url = $store_logo_path;
            $store->image_user_id = Auth::User()->id;
            $store->save();
            Session::flash("updatestorelogo_successmessage","Store Logo Updated Successfully");
            $response = [
                "status" => "true",
                "success_message" => "Store Logo Updated Successfully",
                "storeid" => $formdata->storeid
            ];
            return response()->json($response);
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
        try{
            if(File::exists($store->logo_url)){
                File::delete($store->logo_url);
            }
            $store->delete();
            $response = [
                "status" => "true",
                "success_message" => "Store Deleted Successfully"
            ];
            return response()->json($response);
        }
        catch(\Illuminate\Database\QueryException $ex){
            $response = [
                "status" => "false",
                "error_message" => $store->title."! Sorry, You Cannot Delete This Store Until You Delete Its Child Entries Exists In Other Tables."
            ];
            return response()->json($response);
        }
        
    }
}