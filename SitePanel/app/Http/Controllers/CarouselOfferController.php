<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Store;
use App\CarouselOffer;
use File;
use Session;
use Auth;
use Carbon\Carbon;

class CarouselOfferController extends Controller
{
    public function getAddCarouselOffer(){
        $data['allstores'] = Store::where('status','active')->get();
        return view('pages.carouseloffer.addcarouseloffer',$data);
    }
    public function postAddCarouselOffer(Request $request){
        $imageid = null;
        $formdata = json_decode($request->formdata);
        $carouseloffer = new CarouselOffer;
        $carouseloffer->store_id = $formdata->offer_store;
        $carouseloffer->title = $formdata->offertitle;
        $carouseloffer->type = $formdata->offertype;
        $carouseloffer->code = $formdata->offercode;
        $carouseloffer->starting_date = Carbon::parse($formdata->offer_startingdate)->format('Y-m-d');
        if($formdata->offer_expirydate != null){
            $carouseloffer->expiry_date = Carbon::parse($formdata->offer_expirydate)->format('Y-m-d');
        }
        else{
            $carouseloffer->expiry_date = $formdata->offer_expirydate;
        }
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
        $imageid = null;
        $carouseloffer = CarouselOffer::find($request->carouselofferid);
        // store == store
        if(strcasecmp($carouseloffer->store_id,$request->offer_store) == 0){
            $carouseloffer->store_id = $request->offer_store;
            $carouseloffer->title = $request->offertitle;
            $carouseloffer->type = $request->offertype;
            $carouseloffer->code = $request->offercode;
            $carouseloffer->starting_date = Carbon::parse($request->offer_startingdate)->format('Y-m-d');
            if($request->offer_expirydate != null){
                $carouseloffer->expiry_date = Carbon::parse($request->offer_expirydate)->format('Y-m-d');
            }
            else{
                $carouseloffer->expiry_date = $request->offer_expirydate;
            }
            $carouseloffer->status = $request->offerstatus;
            $carouseloffer->form_user_id = Auth::User()->id;
            $carouseloffer->save();
            Session::flash("updatecarouseloffer_successmessage","Carousel Offer Updated Successfully");
            $response = [
                "status" => "true",
                "carouselofferid" => $request->carouselofferid,
                "success_message" => "Carousel Offer Updated Successfully"
            ];
            return response()->json($response);
        }
        else{
            $carouseloffer->store_id = $request->offer_store;
            $carouseloffer->title = $request->offertitle;
            $carouseloffer->type = $request->offertype;
            $carouseloffer->code = $request->offercode;
            $carouseloffer->starting_date = Carbon::parse($request->offer_startingdate)->format('Y-m-d');
            if($request->offer_expirydate != null){
                $carouseloffer->expiry_date = Carbon::parse($request->offer_expirydate)->format('Y-m-d');
            }
            else{
                $carouseloffer->expiry_date = $request->offer_expirydate;
            }
            $carouseloffer->status = $request->offerstatus;
            if(File::exists($carouseloffer->image_url)){
                do{
                    $flag = true;
                    $imageid = uniqid();
                    $flag = CarouselOffer::where('image_url','LIKE','%'.strtolower($request->storetitle)."-".$imageid.'%')->exists();
                }while($flag);
                $extension = File::extension($carouseloffer->image_url);
                $carousel_image_name = strtolower($request->storetitle)."-".$imageid.".".$extension;
                File::move(public_path($carouseloffer->image_url),public_path('images/carousel/'.$carousel_image_name));
                $carousel_image_path = 'images/carousel/'.$carousel_image_name;
                $carouseloffer->image_url = $carousel_image_path;
            }
            $carouseloffer->form_user_id = Auth::User()->id;
            $carouseloffer->save();
            Session::flash("updatecarouseloffer_successmessage","Carousel Offer Updated Successfully");
            $response = [
                "status" => "true",
                "carouselofferid" => $request->carouselofferid,
                "success_message" => "Carousel Offer Updated Successfully"
            ];
            return response()->json($response);
        }
    }
    public function postUpdateCarouselOfferImage(Request $request){
        $formdata = json_decode($request->formdata);
        $carouseloffer = CarouselOffer::find($formdata->carouselofferid);
        if($request->hasFile('carouselofferimage')){
            if(File::exists($carouseloffer->image_url)){
                File::delete($carouseloffer->image_url);
            }
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
            $carouseloffer->image_user_id = Auth::User()->id;
            $carouseloffer->save();
            Session::flash('updatecarouselofferimage_successmessage','Carousel Offer Image Updated Successfully');
            $response = [
                "status" => "true",
                "carouselofferid" => $formdata->carouselofferid,
                "success_message" => "Carousel Offer Image Updated Successfully"
            ];
            return response()->json($response);
        }
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
