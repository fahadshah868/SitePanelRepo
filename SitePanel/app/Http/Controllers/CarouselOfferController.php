<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Store;
use App\OfferType;
use App\CarouselOffer;
use File;
use Session;

class CarouselOfferController extends Controller
{
    public function getAddCarouselOffer(){
        $data['allstores'] = Store::all();
        $data['alloffertypes'] = OfferType::all();
        return view('pages.carouseloffer.addcarouseloffer',$data);
    }
    public function postAddCarouselOffer(Request $request){
        $formdata = json_decode($request->formdata);
        $carouseloffer = new CarouselOffer;
        $carouseloffer->store_id = $formdata->offer_store;
        $carouseloffer->title = $formdata->offertitle;
        $carouseloffer->offer_type_id = $formdata->offertype_bystore;
        $carouseloffer->code = $formdata->offercode;
        $carouseloffer->starting_date = $formdata->offer_startingdate;
        $carouseloffer->expiry_date = $formdata->offer_expirydate;
        $carouseloffer->status = $formdata->offerstatus;
        if($request->hasFile('carouselofferimage')){
            if(!File::exists(public_path("images/carousel"))){
                File::makeDirectory(public_path("images/carousel", 0777, true, true));
            }
            $carousel_image = $request->file('carouselofferimage');
            $resized_carousel_image = Image::make($carousel_image);
            $resized_carousel_image->resize(1050, 400);
            $carousel_image_name = strtolower($formdata->storetitle)."-carousel.".$carousel_image->getClientOriginalExtension();
            $resized_carousel_image->save(public_path('images/carousel/'.$carousel_image_name));
            $carousel_image_path = 'images/carousel/'.$carousel_image_name;
            $carouseloffer->image_url = $carousel_image_path;
            $carouseloffer->save();
        }
        $response = [
            "status" => "true",
            "success_message" => "Carousel Offer Added Successfully"
        ];
        return response()->json($response);
    }
}
