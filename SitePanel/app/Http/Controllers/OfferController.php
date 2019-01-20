<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\OfferType;
use App\Offer;
use App\StoreCategoryGroup;
use Session;

class OfferController extends Controller
{
    public function getAddOffer(){
        $data['allstores'] = Store::all();
        $data['alloffertypes'] = OfferType::all();
        return view("pages.offer.addoffer",$data);
    }
    public function postAddOffer(Request $request){
        $offer = new Offer;
        $offer->title = ucwords($request->offertitle);
        $offer->anchor = strtoupper($request->offeranchor);
        $offer->offer_type_id = $request->offertype_bystore;
        $offer->code = $request->offercode;
        $offer->details = ucfirst($request->offerdetails);
        $offer->store_id = $request->offer_store;
        $offer->category_id = $request->offer_category;
        $offer->starting_date = $request->offer_startingdate;
        $offer->expiry_date = $request->offer_expirydate;
        $offer->is_popular = $request->offer_is_popular;
        $offer->display_at_home = $request->offer_display_at_home;
        $offer->is_verified = $request->offer_is_verified;
        $offer->status = $request->offerstatus;
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
        $data['alloffertypes'] = OfferType::all();
        $data['allstores'] = Store::all();
        $data['allstorecategories'] = StoreCategoryGroup::where('store_id',$data['offer']->store_id)->with('category')->get();
        return view('pages.offer.updateoffer',$data);
    }
    public function postUpdateOffer(Request $request){
        $offer = Offer::find($request->offerid);
        $offer->title = ucwords($request->offertitle);
        $offer->anchor = strtoupper($request->offeranchor);
        $offer->offer_type_id = $request->offertype_bystore;
        $offer->code = $request->offercode;
        $offer->details = $request->offerdetails;
        $offer->store_id = $request->offer_store;
        $offer->category_id = $request->offer_category;
        $offer->starting_date = $request->offer_startingdate;
        $offer->expiry_date = $request->offer_expirydate;
        $offer->is_popular = $request->offer_is_popular;
        $offer->display_at_home = $request->offer_display_at_home;
        $offer->is_verified = $request->offer_is_verified;
        $offer->status = $request->offerstatus;
        $is_offer_saved = $offer->save();
        Session::flash("offerupdated_successmessage","Offer Updated Successfully");
        $response = [
            "status" => "true",
            "success_message" => "Offer Updated Successfully"
        ];
        return response()->json($response);
    }
    public function deleteOffer($id){
        $offer = Offer::find($id);
        $is_offer_deleted = $offer->delete();
        $response = [
            "status" => "true",
            "success_message" => "Offer Deleted Successfully"
        ];
        return response()->json($response);
    }
    //retrieve store all categories
    public function getStoreCategories($id){
        $data['allstorecategories'] = StoreCategoryGroup::where('store_id',$id)->with('category')->get();
        return response()->json($data);
    }
}
