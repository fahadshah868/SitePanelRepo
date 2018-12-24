<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OfferType;

class OfferTypeController extends Controller
{
    public function getAddOfferType(){
        return view('pages.offertype.addoffertype');
    }
    public function postAddOfferType(Request $request){
        $is_offertypetitle_exists = OfferType::where('title',$request->offertypetitle)->exists();
        if(!$is_offertypetitle_exists){
            $offertype = new OfferType;
            $offertype->type = $request->offertypetitle;
            $offertype->status = $request->offertypestatus;
            $is_offertype_save = $offertype->save();
        }
    }
}
