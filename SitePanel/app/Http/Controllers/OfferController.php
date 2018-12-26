<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Category;
use App\OfferType;
use App\Offer;

class OfferController extends Controller
{
    public function getAddOffer(){
        $data['allstores'] = Store::all();
        $data['allcategories'] = Category::all();
        $data['alloffertypes'] = OfferType::all();
        return view("pages.offer.addoffer",$data);
    }
    public function postAddOffer(Request $request){
        $is_offer_save = false;
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
                $is_offer_save = $offer->save();                
            }
        }
        if($is_offer_save){
            $response = [
                "status" => "true",
                "success_message" => "Add Offer Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "success_message" => "Offer Is Not Added Successfully"
            ];
            return response()->json($response);
        }
    }
    public function getAllOffers(){
        $data['alloffers'] = Offer::all();
        $data['offerscount'] = count($data['alloffers']);
        return view('pages.offer.alloffers',$data);
    }
}
