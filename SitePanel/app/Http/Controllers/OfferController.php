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
        $offer->expiry_date = Carbon::parse($request->offer_expirydate)->format('Y-m-d');
        $offer->is_popular = $request->offer_is_popular;
        $offer->display_at_home = $request->offer_display_at_home;
        $offer->is_verified = $request->offer_is_verified;
        $offer->status = $request->offerstatus;
        $offer->user_id = Auth::User()->id;
        $offer->save();
        $response = [
            "status" => "true",
            "success_message" => "Offer Added Successfully"
        ];
        return response()->json($response);
    }
    public function getAllOffers(){
        $data['alloffers'] = Offer::orderBy('id', 'DESC')->get();
        $data['offerscount'] = count($data['alloffers']);
        return view('pages.offer.alloffers',$data);
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
        $offer->expiry_date = Carbon::parse($request->offer_expirydate)->format('Y-m-d');
        $offer->is_popular = $request->offer_is_popular;
        $offer->display_at_home = $request->offer_display_at_home;
        $offer->is_verified = $request->offer_is_verified;
        $offer->status = $request->offerstatus;
        $offer->user_id = Auth::User()->id;
        $offer->save();
        Session::flash("offerupdated_successmessage","Offer Updated Successfully");
        $response = [
            "status" => "true",
            "success_message" => "Offer Updated Successfully"
        ];
        return response()->json($response);
    }
    public function deleteOffer($id){
        $offer = Offer::find($id);
        try{
            $is_offer_deleted = $offer->delete();
            $response = [
                "status" => "true",
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
