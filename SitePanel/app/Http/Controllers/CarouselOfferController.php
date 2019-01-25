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
        $carouseloffer_lastrow = CarouselOffer::orderBy('id', 'DESC')->first();
        $imagenumber = $carouseloffer_lastrow->id;
        $imagenumber = $imagenumber + 1;
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
            $carousel_image_name = strtolower($formdata->storetitle)."-".$imagenumber.".".$carousel_image->getClientOriginalExtension();
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
    public function getAllCarouselOffers(){
        $data['allcarouseloffers'] = CarouselOffer::orderBy('id', 'DESC')->get();
        $data['carouselofferscount'] = count($data['allcarouseloffers']);
        return view('pages.carouseloffer.allcarouseloffers',$data);
    }
    public function getUpdateCarouselOffer($id){
        $data['carouseloffer'] = CarouselOffer::find($id);
        return view('pages.carouseloffer.updatecarouseloffer',$data);
    }
    public function getUpdateCarouselOfferForm($id){
        $data['allstores'] = Store::all();
        $data['alloffertypes'] = OfferType::all();
        $data['carouseloffer'] = CarouselOffer::find($id);
        return view('pages.carouseloffer.updatecarouselofferform',$data);
    }
    public function postUpdateCarouselOfferForm(Request $request){
        $carouseloffer = CarouselOffer::find($request->carouselofferid);
        $carouseloffer->store_id = $request->offer_store;
        $carouseloffer->title = $request->offertitle;
        $carouseloffer->offer_type_id = $request->offertype_bystore;
        $carouseloffer->code = $request->offercode;
        $carouseloffer->starting_date = $request->offer_startingdate;
        $carouseloffer->expiry_date = $request->offer_expirydate;
        $carouseloffer->status = $request->offerstatus;
        $carouseloffer->save();
        Session::flash("updatecarouseloffer_successmessage","Carousel Offer Updated Successfully");
        $response = [
            "status" => "true",
            "carouselofferid" => $request->carouselofferid,
            "success_message" => "Carousel Offer Updated Successfully"
        ];
        return response()->json($response);
    }
    public function postUpdateCarouselOfferImage(Request $request){

    }
    public function deleteCarouselOffer($id){
        $carouseloffer = CarouselOffer::find($id);
        if(File::exists($carouseloffer->image_url)){
            File::delete($carouseloffer->image_url);
        }
        $carouseloffer->delete();
        $response = [
            "status" => "true",
            "success_message" => "Carousel Offer Deleted Successfully"
        ];
        return response()->json($response);
    }
}
