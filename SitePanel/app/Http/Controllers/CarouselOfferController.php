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
        $carouseloffer->location = $formdata->offerlocation;
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
            $carouseloffer->updated_at = null;
            $carouseloffer->save();
        }
        $response = [
            "status" => "true",
            "success_message" => "Carousel Offer Added Successfully"
        ];
        return response()->json($response);
    }
    public function getTodayAllCarouselOffers(){
        $data['allcarouseloffers'] = CarouselOffer::whereDate('created_at',config('constants.today_date'))->orwhereDate('updated_at',config('constants.today_date'))->orderBy('id', 'DESC')->get();
        $data['mainheading'] = "Today's Carousel Offers";
        $data['carouselofferscount'] = count($data['allcarouseloffers']);
        $data['filtereddaterange'] = "";
        Session::put(['url'=>'/todayallcarouseloffers','flag'=>1]);
        return view('pages.carouseloffer.allcarouseloffers',$data);
    }
    public function getAllCarouselOffers(){
        $data['allcarouseloffers'] = CarouselOffer::orderBy('id', 'DESC')->get();
        $data['mainheading'] = "All Carousel Offers";
        $data['carouselofferscount'] = count($data['allcarouseloffers']);
        $data['filtereddaterange'] = "";
        Session::put(['url'=>'/allcarouseloffers','flag'=>1]);
        return view('pages.carouseloffer.allcarouseloffers',$data);
    }
    public function getFilteredCarouselOffers($dateremark, $datefrom, $dateto){
        Session::put('url','/filteredcarouseloffers/'.$dateremark.'/'.Carbon::parse($datefrom)->format('Y-m-d').'/'.Carbon::parse($dateto)->format('Y-m-d'));
        if(Session::get('flag') == 1){
            if(strcasecmp($dateremark,"both") == 0 ){
                $response['filteredcarouseloffers'] = CarouselOffer::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('store','form_user','image_user')->get();
                $response['mainheading'] = 'Created & Updated Carousel Offers<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredcarouseloffers']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
            else if(strcasecmp($dateremark,"created") == 0){
                $response['filteredcarouseloffers'] = CarouselOffer::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('store','form_user','image_user')->get();
                $response['mainheading'] = 'Created Carousel Offers<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredcarouseloffers']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
            else if(strcasecmp($dateremark,"updated") == 0){
                $response['filteredcarouseloffers'] = CarouselOffer::whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('store','form_user','image_user')->get();
                $response['mainheading'] = 'Updated Carousel Offers<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredcarouseloffers']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
        }
        else{
            Session::put('flag',1);
            if(strcasecmp($dateremark,"both") == 0 ){
                $data['allcarouseloffers'] = CarouselOffer::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('store','form_user','image_user')->get();
                $data['mainheading'] = "Created & Updated Carousel Offers";
                $data['carouselofferscount'] = count($data['allcarouseloffers']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.carouseloffer.allcarouseloffers',$data);
            }
            else if(strcasecmp($dateremark,"created") == 0){
                $data['allcarouseloffers'] = CarouselOffer::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('store','form_user','image_user')->get();
                $data['mainheading'] = "Created Carousel Offers";
                $data['carouselofferscount'] = count($data['allcarouseloffers']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.carouseloffer.allcarouseloffers',$data);
            }
            else if(strcasecmp($dateremark,"updated") == 0){
                $data['allcarouseloffers'] = CarouselOffer::whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with('store','form_user','image_user')->get();
                $data['mainheading'] = "Updated Carousel Offers";
                $data['carouselofferscount'] = count($data['allcarouseloffers']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.carouseloffer.allcarouseloffers',$data);
            }
        }
    }
    public function getViewCarouselOffer($id){
        Session::put('flag',-1);
        $data['carouseloffer'] = CarouselOffer::find($id);
        return view('pages.carouseloffer.viewcarouseloffer',$data);
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
            $carouseloffer->delete();
            if(File::exists($carouseloffer->image_url)){
                File::delete($carouseloffer->image_url);
            }
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
