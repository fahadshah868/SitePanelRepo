<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Category;
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
    public function getStoreCategories($id){
        $data['allstorecategories'] = StoreCategoryGroup::where('store_id',$id)->with('category')->get();
        return response()->json($data);
    }
    public function postAddOffer(Request $request){
        $is_offer_saved = false;
        for($store=0; $store< count($request->offer_stores); $store++){
            for($category=0; $category< count($request->offer_categories); $category++){
                $offer = new Offer;
                $offer->title = $request->offertitle;
                $offer->offer_type_id = $request->offertype_bystore;
                $offer->code = $request->offercode;
                $offer->details = $request->offerdetails;
                $offer->store_id = $request->offer_stores[$store];
                $offer->category_id = $request->offer_categories[$category];
                $offer->starting_date = $request->offer_startingdate;
                $offer->expiry_date = $request->offer_expirydate;
                $offer->type = $request->offertype;
                $offer->status = $request->offerstatus;
                $is_offer_saved = $offer->save();
            }
        }
        if($is_offer_saved){
            $response = [
                "status" => "true",
                "success_message" => "Offer Added Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Offer Is Not Added Successfully"
            ];
            return response()->json($response);
        }
    }
    public function getAllOffers(){
        $data['alloffers'] = Offer::all();
        $data['offerscount'] = count($data['alloffers']);
        return view('pages.offer.alloffers',$data);
    }
    public function getUpdateOffer($id){
        $data['offer'] = Offer::find($id);
        $data['alloffertypes'] = OfferType::all();
        $data['allstores'] = Store::all();
        $data['allcategories'] = Category::all();
        return view('pages.offer.updateoffer',$data);
    }
    public function postUpdateOffer(Request $request){
        $offer = Offer::find($request->offerid);
        $offer->title = $request->offertitle;
        $offer->offer_type_id = $request->offertype_bystore;
        $offer->code = $request->offercode;
        $offer->details = $request->offerdetails;
        $offer->store_id = $request->offer_store;
        $offer->category_id = $request->offer_category;
        $offer->starting_date = $request->offer_startingdate;
        $offer->expiry_date = $request->offer_expirydate;
        $offer->type = $request->offertype;
        $offer->status = $request->offerstatus;
        $is_offer_updated = $offer->save();
        if($is_offer_updated){
            Session::flash("offerupdated_successmessage","Offer Updated Successfully");
            $response = [
                "status" => "true",
                "success_message" => "Offer Updated Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Offer Is Not Updated Successfully"
            ];
            return response()->json($response);
        }
    }
    public function deleteOffer($id){
        $offer = Offer::find($id);
        $is_offer_deleted = $offer->delete();
        if($is_offer_deleted){
            $response = [
                "status" => "true",
                "success_message" => "Offer Deleted Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Offer Is Not Deleted Successfully"
            ];
            return response()->json($response);
        }
    }
}
