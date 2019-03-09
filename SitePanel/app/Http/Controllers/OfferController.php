<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Offer;
use App\StoreCategoryGroup;
use Session;
use Auth;
use Carbon\Carbon;

class OfferController extends Controller
{
    public function getAddOffer(){
        $data['allstores'] = Store::where('status','active')->get();
        return view("pages.offer.addoffer",$data);
    }
    public function postAddOffer(Request $request){
        $offer = new Offer;
        $offer->store_id = $request->offer_store;
        $offer->category_id = $request->offer_category;
        $offer->title = ucwords($request->offertitle);
        $offer->free_shipping = $request->free_shipping;
        $offer->anchor = strtoupper($request->offeranchor);
        $offer->location = $request->offerlocation;
        $offer->type = $request->offertype;
        $offer->code = $request->offercode;
        $offer->details = ucfirst($request->offerdetails);
        $offer->starting_date = Carbon::parse($request->offer_startingdate)->format('Y-m-d');
        if($request->offer_expirydate != null){
            $offer->expiry_date = Carbon::parse($request->offer_expirydate)->format('Y-m-d');
        }
        else{
            $offer->expiry_date = $request->offer_expirydate;
        }
        $offer->is_popular = $request->offer_is_popular;
        $offer->display_at_home = $request->offer_display_at_home;
        $offer->is_verified = $request->offer_is_verified;
        $offer->status = $request->offerstatus;
        $offer->user_id = Auth::User()->id;
        $offer->updated_at = null;
        $offer->save();
        $response = [
            "status" => "true",
            "success_message" => "Offer Added Successfully"
        ];
        return response()->json($response);
    }
    public function getTodayAllOffers(){
        $data['alloffers'] = Offer::whereDate('created_at',config('constants.today_date'))->orwhereDate('updated_at',config('constants.today_date'))->orderBy('id', 'DESC')->get();
        $data['mainheading'] = "Today's Offers";
        $data['offerscount'] = count($data['alloffers']);
        $data['filtereddaterange'] = "";
        Session::put(['url'=>'/todayalloffers','flag'=>1]);
        return view('pages.offer.alloffers',$data);
    }
    public function getAllOffers(){
        $data['alloffers'] = Offer::orderBy('id', 'DESC')->get();
        $data['mainheading'] = "All Offers";
        $data['offerscount'] = count($data['alloffers']);
        $data['filtereddaterange'] = "";
        Session::put(['url'=>'/alloffers','flag'=>1]);
        return view('pages.offer.alloffers',$data);
    }
    public function getFilteredOffers($dateremark, $datefrom, $dateto){
        Session::put('url','/filteredoffers/'.$dateremark.'/'.Carbon::parse($datefrom)->format('Y-m-d').'/'.Carbon::parse($dateto)->format('Y-m-d'));
        if(Session::get('flag') == 1){
            if(strcasecmp($dateremark,"both") == 0 ){
                $response['filteredoffers'] = Offer::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('store','category','user')->get();
                $response['mainheading'] = 'Created & Updated Offers<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredoffers']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
            else if(strcasecmp($dateremark,"created") == 0){
                $response['filteredoffers'] = Offer::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('store','category','user')->get();
                $response['mainheading'] = 'Created Offers<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredoffers']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
            else if(strcasecmp($dateremark,"updated") == 0){
                $response['filteredoffers'] = Offer::whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('store','category','user')->get();
                $response['mainheading'] = 'Updated Offers<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredoffers']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
        }
        else{
            Session::put('flag',1);
            if(strcasecmp($dateremark,"both") == 0 ){
                $data['alloffers'] = Offer::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('store','category','user')->get();
                $data['mainheading'] = "Created & Updated Offers";
                $data['offerscount'] = count($data['alloffers']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.offer.alloffers',$data);
            }
            else if(strcasecmp($dateremark,"created") == 0){
                $data['alloffers'] = Offer::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('store','category','user')->get();
                $data['mainheading'] = "Created Offers";
                $data['offerscount'] = count($data['alloffers']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.offer.alloffers',$data);
            }
            else if(strcasecmp($dateremark,"updated") == 0){
                $data['alloffers'] = Offer::whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('store','category','user')->get();
                $data['mainheading'] = "Updated Offers";
                $data['offerscount'] = count($data['alloffers']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.offer.alloffers',$data);
            }
        }
    }
    public function getViewOffer($id){
        Session::put('flag',-1);
        $data['offer'] = Offer::find($id);
        return view('pages.offer.viewoffer',$data);
    }
    public function getUpdateOffer($id){
        $data['offer'] = Offer::find($id);
        $data['allstores'] = Store::all();
        $data['allstorecategories'] = StoreCategoryGroup::where('store_id',$data['offer']->store_id)->with('category')->get();
        return view('pages.offer.updateoffer',$data);
    }
    public function postUpdateOffer(Request $request){
        $offer = Offer::find($request->offerid);
        $offer->store_id = $request->offer_store;
        $offer->category_id = $request->offer_category;
        $offer->title = ucwords($request->offertitle);
        $offer->free_shipping = $request->free_shipping;
        $offer->anchor = strtoupper($request->offeranchor);
        $offer->location = $request->offerlocation;
        $offer->type = $request->offertype;
        $offer->code = $request->offercode;
        $offer->details = ucfirst($request->offerdetails);
        $offer->starting_date = Carbon::parse($request->offer_startingdate)->format('Y-m-d');
        if($request->offer_expirydate != null){
            $offer->expiry_date = Carbon::parse($request->offer_expirydate)->format('Y-m-d');
        }
        else{
            $offer->expiry_date = $request->offer_expirydate;
        }
        $offer->is_popular = $request->offer_is_popular;
        $offer->display_at_home = $request->offer_display_at_home;
        $offer->is_verified = $request->offer_is_verified;
        $offer->status = $request->offerstatus;
        $offer->user_id = Auth::User()->id;
        $offer->save();
        Session::flash("updateoffer_successmessage","Offer Updated Successfully");
        $response = [
            "status" => "true",
            "offer_id" => $request->offerid,
            "success_message" => "Offer Updated Successfully"
        ];
        return response()->json($response);
    }
    public function deleteOffer($id){
        Session::put('flag',-1);
        $offer = Offer::find($id);
        try{
            $offer->delete();
            $response = [
                "status" => "true",
                "url" => Session::get('url'),
                "success_message" => "Offer Deleted Successfully"
            ];
            return response()->json($response);
        }
        catch(\Illuminate\Database\QueryException $ex){
            $response = [
                "status" => "false",
                "error_message" => "Sorry, You Cannot Delete This Offer Until You Delete Its Child Entries Exists In Other Tables."
            ];
            return response()->json($response);
        }
    }
    //retrieve store all categories
    public function getStoreCategories($id){
        $data['allstorecategories'] = StoreCategoryGroup::where('store_id',$id)->with('category')->get();
        return response()->json($data);
    }
}
