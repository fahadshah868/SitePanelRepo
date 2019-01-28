<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Store;
use App\CarouselOffer;
use File;
use Session;
use Auth;

class CarouselOfferController extends Controller
{
    public function getAddCarouselOffer(){
        $data['allstores'] = Store::where('status','active')->get();
        return view('pages.carouseloffer.addcarouseloffer',$data);
    }
    public function postAddCarouselOffer(Request $request){
        $imageid = "";
        $formdata = json_decode($request->formdata);
        $carouseloffer = new CarouselOffer;
        $carouseloffer->store_id = $formdata->offer_store;
        $carouseloffer->title = $formdata->offertitle;
        $carouseloffer->code = $formdata->offercode;
        $carouseloffer->starting_date = $formdata->offer_startingdate;
        $carouseloffer->expiry_date = $formdata->offer_expirydate;
        $carouseloffer->status = $formdata->offerstatus;
        if($request->hasFile('carouselofferimage')){
            if(!File::exists(public_path("images/carousel"))){
                File::makeDirectory(public_path("images/carousel", 0777, true, true));
            }
            do{
                $flag = true;
                $imageid = uniqid();
                $flag = CarouselOffer::where('image_url','LIKE','%'.strtolower($formdata->storetitle)."-".$imageid.'%')->exists();
            }while($flag);
            $carousel_image = $request->file('carouselofferimage');
            $resized_carousel_image = Image::make($carousel_image);
            $resized_carousel_image->resize(1050, 400);
            $carousel_image_name = strtolower($formdata->storetitle)."-".$imageid.".".$carousel_image->getClientOriginalExtension();
            $resized_carousel_image->save(public_path('images/carousel/'.$carousel_image_name));
            $carousel_image_path = 'images/carousel/'.$carousel_image_name;
            $carouseloffer->image_url = $carousel_image_path;
            $carouseloffer->form_user_id = Auth::User()->id;
            $carouseloffer->image_user_id = Auth::User()->id;
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
        $data['carouseloffer'] = CarouselOffer::find($id);
        return view('pages.carouseloffer.updatecarouselofferform',$data);
    }
    public function postUpdateCarouselOfferForm(Request $request){
        $carouseloffer = CarouselOffer::find($request->carouselofferid);
        $carouseloffer->store_id = $request->offer_store;
        $carouseloffer->title = $request->offertitle;
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
        try{
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
        catch(\Illuminate\Database\QueryException $ex){
            $response = [
                "status" => "false",
                "error_message" => "Sorry, You Cannot Delete This Carousel Offer Until You Delete Its Child Entries Exists In Other Tables."
            ];
            return response()->json($response);
        }
    }
}
