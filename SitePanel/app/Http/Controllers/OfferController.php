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
    public function getAllOffers(){
        $data['alloffers'] = Offer::all();
        $data['offerscount'] = count($data['alloffers']);
        return view('pages.offer.alloffers',$data);
    }
}
