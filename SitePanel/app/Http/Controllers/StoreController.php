<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Store;
use App\Category;
use App\Network;
use App\StoreCategory;
use File;
use Session;
use Auth;
use Carbon\Carbon;

class StoreController extends Controller
{
    public function getAddStore(){
        $data['allcategories'] = Category::select('id','title')->where('is_active','y')->get();
        $data['allnetworks'] = Network::select('id','title')->where('is_active','y')->get();
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
            $secondary_url = strtolower($formdata->storeprimaryurl);
            $store->secondary_url = str_replace(['http://www.','https://www.'], '', $secondary_url);
            $store->network_id = $formdata->networkid;
            $store->network_url = $formdata->storenetworkurl;
            $store->is_topstore = $formdata->is_topstore;
            $store->is_popularstore = $formdata->is_popularstore;
            $store->is_active = $formdata->storestatus;
            //upload file and save path into db
            if($request->hasFile('storelogo')){
                if(!File::exists(public_path("/images/store"))){
                    File::makeDirectory(public_path("/images/store", 0777, true, true));
                }
                $storelogo = $request->file('storelogo');
                $resized_store_logo = Image::make($storelogo);
                $resized_store_logo->resize(200, 200);
                $store_logo_name = "merchant-".time().".".$storelogo->getClientOriginalExtension();
                $resized_store_logo->save(public_path('/images/store/'.$store_logo_name));
                $store_logo_path = '/images/store/'.$store_logo_name;
                $store->logo_url = $store_logo_path;
                $store->user_id = Auth::User()->id;
                $store->updated_at = null;
                $store->save();
                for($category=0; $category< count($formdata->storecategories); $category++){
                    $storecategories[] = [
                        'store_id' => $store->id,
                        'category_id' => $formdata->storecategories[$category],
                        'user_id' => Auth::User()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
                StoreCategory::insert($storecategories);
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
    public function getAllStores(Request $request){
        Session::put('url',$request->getRequestUri());
        $data['allstores'] = Store::select('id','title','primary_url','network_id','network_url','is_topstore','is_popularstore','is_active','logo_url','user_id')->with(['network' => function($q){
            $q->select('id','title');
        },'user' => function($q){
            $q->select('id','username');
        }])->orderBy('id', 'DESC')
        ->paginate(200);
        $data['mainheading'] = "All Stores";
        $data['filtereddaterange'] = "";
        return view('pages.store.viewstores', $data);
    }
    public function getTodayAllStores(Request $request){
        Session::put('url',$request->getRequestUri());
        $data['allstores'] = Store::select('id','title','primary_url','network_id','network_url','is_topstore','is_popularstore','is_active','logo_url','user_id')->whereDate('created_at',config('constants.TODAY_DATE'))->with(['network' => function($q){
            $q->select('id','title');
        },'user' => function($q){
            $q->select('id','username');
        }])->orderBy('id', 'DESC')
        ->paginate(200);
        $data['mainheading'] = "Today's Stores";
        $data['filtereddaterange'] = "";
        return view('pages.store.viewstores',$data);
    }
    public function getFilteredStores(Request $request, $dateremark, $datefrom, $dateto){
        Session::put('url',$request->getRequestUri());
        if(strcasecmp($dateremark,"both") == 0 ){
            $data['allstores'] = Store::select('id','title','primary_url','network_id','network_url','is_topstore','is_popularstore','is_active','logo_url','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['network' => function($q){
                $q->select('id','title');
            },'user' => function($q){
                $q->select('id','username');
            }])
            ->paginate(200);
            $data['mainheading'] = "Created & Updated Stores";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.store.viewstores', $data);
        }
        else if(strcasecmp($dateremark,"created") == 0){
            $data['allstores'] = Store::select('id','title','primary_url','network_id','network_url','is_topstore','is_popularstore','is_active','logo_url','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['network' => function($q){
                $q->select('id','title');
            },'user' => function($q){
                $q->select('id','username');
            }])
            ->paginate(200);
            $data['mainheading'] = "Created Stores";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.store.viewstores', $data);
        }
        else if(strcasecmp($dateremark,"updated") == 0){
            $data['allstores'] = Store::select('id','title','primary_url','network_id','network_url','is_topstore','is_popularstore','is_active','logo_url','user_id')->whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['network' => function($q){
                $q->select('id','title');
            },'user' => function($q){
                $q->select('id','username');
            }])
            ->paginate(200);
            $data['mainheading'] = "Updated Stores";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.store.viewstores', $data);
        }
    }
    public function getViewStore($id){
        $data['store'] = Store::with(['network' => function($q){
            $q->select('id','title');
        },'user' => function($q){
            $q->select('id','username');
        }])->find($id);
        return view('pages.store.viewstore',$data);
    }
    public function getUpdateStoreForm($id){
        $data['store'] = Store::with(['network' => function($q){
            $q->select('id','title');
        }])->find($id);
        $data['allnetworks'] = Network::select('id','title')->where('is_active','y')->get();
        return view('pages.store.updatestoreform',$data);
    }
    public function postUpdateStoreForm(Request $request){
        $store = Store::find($request->storeid);
        // title == title && primaryurl == primaryurl && networkurl == networkurl
        if((strcasecmp($store->title , $request->storetitle) == 0 && strcasecmp($store->primary_url , $request->storeprimaryurl) == 0) && strcasecmp($store->network_url, $request->storenetworkurl) == 0){
            $store->title = $request->storetitle;
            $store->description = $request->storedescription;
            $store->primary_url = strtolower($request->storeprimaryurl);
            $secondary_url = strtolower($request->storeprimaryurl);
            $store->secondary_url = str_replace(['http://www.','https://www.'], '', $secondary_url);
            $store->network_id = $request->networkid;
            $store->network_url = $request->storenetworkurl;
            $store->is_topstore = $request->is_topstore;
            $store->is_popularstore = $request->is_popularstore;
            $store->is_active = $request->storestatus;
            $store->user_id = Auth::User()->id;
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
                $secondary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = str_replace(['http://www.','https://www.'], '', $secondary_url);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_topstore = $request->is_topstore;
                $store->is_popularstore = $request->is_popularstore;
                $store->is_active = $request->storestatus;
                $store->user_id = Auth::User()->id;
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
                $secondary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = str_replace(['http://www.','https://www.'], '', $secondary_url);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_popularstore = $request->is_popularstore;
                $store->is_active = $request->storestatus;
                $store->is_active = $request->storestatus;
                $store->user_id = Auth::User()->id;
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
        // title == title && primaryurl == primaryurl && networkurl != networkurl
        else if((strcasecmp($store->title , $request->storetitle) == 0 && strcasecmp($store->primary_url , $request->storeprimaryurl) == 0) && strcasecmp($store->network_url, $request->storenetworkurl) != 0){
            $is_storenetworkurl_exists = Store::where('network_url',$request->storenetworkurl)->exists();
            if(!$is_storenetworkurl_exists){
                $store->title = $request->storetitle;
                $store->description = $request->storedescription;
                $store->primary_url = strtolower($request->storeprimaryurl);
                $secondary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = str_replace(['http://www.','https://www.'], '', $secondary_url);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_popularstore = $request->is_popularstore;
                $store->is_active = $request->storestatus;
                $store->is_active = $request->storestatus;
                $store->user_id = Auth::User()->id;
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
                $secondary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = str_replace(['http://www.','https://www.'], '', $secondary_url);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_popularstore = $request->is_popularstore;
                $store->is_active = $request->storestatus;
                $store->is_active = $request->storestatus;
                $store->user_id = Auth::User()->id;
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
        // title == title && primaryurl != primaryurl && networkurl != networkurl
        else if((strcasecmp($store->title , $request->storetitle) == 0 && strcasecmp($store->primary_url , $request->storeprimaryurl) != 0) && strcasecmp($store->network_url, $request->storenetworkurl) != 0){
            $are_storefields_exists = Store::where('primary_url',$request->storeprimaryurl)
                                    ->orwhere('network_url',$request->storenetworkurl)
                                    ->exists();
            if(!$are_storefields_exists){
                $store->title = $request->storetitle;
                $store->description = $request->storedescription;
                $store->primary_url = strtolower($request->storeprimaryurl);
                $secondary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = str_replace(['http://www.','https://www.'], '', $secondary_url);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_popularstore = $request->is_popularstore;
                $store->is_active = $request->storestatus;
                $store->is_active = $request->storestatus;
                $store->user_id = Auth::User()->id;
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
        // title != title && primaryurl = primaryurl && networkurl != networkurl
        else if((strcasecmp($store->title , $request->storetitle) != 0 && strcasecmp($store->primary_url , $request->storeprimaryurl) == 0) && strcasecmp($store->network_url, $request->storenetworkurl) != 0){
            $are_storefields_exists = Store::where('title',$request->storetitle)
                                    ->orwhere('network_url',$request->storenetworkurl)
                                    ->exists();
            if(!$are_storefields_exists){
                $store->title = $request->storetitle;
                $store->description = $request->storedescription;
                $store->primary_url = strtolower($request->storeprimaryurl);
                $secondary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = str_replace(['http://www.','https://www.'], '', $secondary_url);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_popularstore = $request->is_popularstore;
                $store->is_active = $request->storestatus;
                $store->is_active = $request->storestatus;
                $store->user_id = Auth::User()->id;
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
        // title != title && primaryurl != primaryurl && networkurl != networkurl
        else if((strcasecmp($store->title , $request->storetitle) != 0 && strcasecmp($store->primary_url , $request->storeprimaryurl) != 0) && strcasecmp($store->network_url, $request->storenetworkurl) != 0){
            $are_storefields_exists = Store::where('title',$request->storetitle)
                                ->orwhere('primary_url',$request->storeprimaryurl)
                                ->orwhere('network_url',$request->storenetworkurl)
                                ->exists();
            if(!$are_storefields_exists){
                $store->title = $request->storetitle;
                $store->description = $request->storedescription;
                $store->primary_url = strtolower($request->storeprimaryurl);
                $secondary_url = strtolower($request->storeprimaryurl);
                $store->secondary_url = str_replace(['http://www.','https://www.'], '', $secondary_url);
                $store->network_id = $request->networkid;
                $store->network_url = $request->storenetworkurl;
                $store->is_popularstore = $request->is_popularstore;
                $store->is_active = $request->storestatus;
                $store->is_active = $request->storestatus;
                $store->user_id = Auth::User()->id;
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
            if(!File::exists(public_path("/images/store"))){
                File::makeDirectory(public_path("/images/store", 0777, true, true));
            }
            if(File::exists($store->logo_url)){
                File::delete($store->logo_url);
            }
            $storelogo = $request->file('storelogo');
            $resized_store_logo = Image::make($storelogo);
            $resized_store_logo->resize(200, 200);
            $store_logo_name = "merchant-".time().".".$storelogo->getClientOriginalExtension();
            $resized_store_logo->save(public_path('/images/store/'.$store_logo_name));
            $store_logo_path = '/images/store/'.$store_logo_name;
            $store->logo_url = $store_logo_path;
            $store->user_id = Auth::User()->id;
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
            $store->delete();
            if(File::exists($store->logo_url)){
                File::delete($store->logo_url);
            }
            $response = [
                "status" => "true",
                "url" => Session::get('url'),
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