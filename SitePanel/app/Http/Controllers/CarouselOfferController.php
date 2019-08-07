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
        $data['allstores'] = Store::select('id','title')->where('is_active','y')->get();
        return view('pages.carouseloffer.addcarouseloffer',$data);
    }
    public function postAddCarouselOffer(Request $request){
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
        $carouseloffer->is_active = $formdata->offerstatus;
        if($request->hasFile('carouselofferimage')){
            if(!File::exists(public_path("/images/carousel"))){
                File::makeDirectory(public_path("/images/carousel", 0777, true, true));
            }
            $carousel_image = $request->file('carouselofferimage');
            $resized_carousel_image = Image::make($carousel_image);
            $resized_carousel_image->resize(400, 300);
            $carousel_image_name = "carousel-".time().".".$carousel_image->getClientOriginalExtension();
            $resized_carousel_image->save(public_path('/images/carousel/'.$carousel_image_name));
            $carousel_image_path = '/images/carousel/'.$carousel_image_name;
            $carouseloffer->image_url = $carousel_image_path;
            $carouseloffer->user_id = Auth::User()->id;
            $carouseloffer->updated_at = null;
            $carouseloffer->save();
        }
        $response = [
            "status" => "true",
            "success_message" => "Carousel Offer Added Successfully"
        ];
        return response()->json($response);
    }
    public function getTodayAllCarouselOffers(Request $request){
        Session::put('url',$request->getRequestUri());
        $data['allcarouseloffers'] = CarouselOffer::select('id','title','location','type','code','is_active','starting_date','expiry_date','image_url','store_id','user_id')->whereDate('created_at',config('constants.TODAY_DATE'))->orderBy('id', 'DESC')
        ->with(['store' => function($q){
            $q->select('id','title');
        }, 'user' => function($q){
            $q->select('id','username');
        }])
        ->paginate(200);
        $data['mainheading'] = "Today's Carousel Offers";
        $data['filtereddaterange'] = "";
        return view('pages.carouseloffer.viewcarouseloffers',$data);
    }
    public function getAllCarouselOffers(Request $request){
        Session::put('url',$request->getRequestUri());
        $data['allcarouseloffers'] = CarouselOffer::select('id','title','location','type','code','is_active','starting_date','expiry_date','image_url','store_id','user_id')->orderBy('id', 'DESC')
        ->with(['store' => function($q){
            $q->select('id','title');
        }, 'user' => function($q){
            $q->select('id','username');
        }])
        ->paginate(200);
        $data['mainheading'] = "All Carousel Offers";
        $data['filtereddaterange'] = "";
        return view('pages.carouseloffer.viewcarouseloffers',$data);
    }
    public function getFilteredCarouselOffers(Request $request, $dateremark, $datefrom, $dateto){
        Session::put('url',$request->getRequestUri());
        if(strcasecmp($dateremark,"both") == 0 ){
            $data['allcarouseloffers'] = CarouselOffer::select('id','title','location','type','code','is_active','starting_date','expiry_date','image_url','store_id','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['store' => function($q){
                $q->select('id','title');
            }, 'user' => function($q){
                $q->select('id','username');
            }])
            ->paginate(200);
            $data['mainheading'] = "Created & Updated Carousel Offers";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.carouseloffer.viewcarouseloffers',$data);
        }
        else if(strcasecmp($dateremark,"created") == 0){
            $data['allcarouseloffers'] = CarouselOffer::select('id','title','location','type','code','is_active','starting_date','expiry_date','image_url','store_id','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['store' => function($q){
                $q->select('id','title');
            }, 'user' => function($q){
                $q->select('id','username');
            }])
            ->paginate(200);
            $data['mainheading'] = "Created Carousel Offers";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.carouseloffer.viewcarouseloffers',$data);
        }
        else if(strcasecmp($dateremark,"updated") == 0){
            $data['allcarouseloffers'] = CarouselOffer::select('id','title','location','type','code','is_active','starting_date','expiry_date','image_url','store_id','user_id')->whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['store' => function($q){
                $q->select('id','title');
            }, 'user' => function($q){
                $q->select('id','username');
            }])
            ->paginate(200);
            $data['mainheading'] = "Updated Carousel Offers";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.carouseloffer.viewcarouseloffers',$data);
        }
    }
    public function getViewCarouselOffer($id){
        $data['carouseloffer'] = CarouselOffer::with(['store' => function($q){
            $q->select('id','title');
        }, 'user' => function($q){
            $q->select('id','username');
        }])->find($id);
        return view('pages.carouseloffer.viewcarouseloffer',$data);
    }
    public function getUpdateCarouselOfferForm($id){
        $data['allstores'] = Store::select('id','title')->where('is_active','y')->get();
        $data['carouseloffer'] = CarouselOffer::find($id);
        return view('pages.carouseloffer.updatecarouselofferform',$data);
    }
    public function postUpdateCarouselOfferForm(Request $request){
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
            $carouseloffer->is_active = $request->offerstatus;
            $carouseloffer->user_id = Auth::User()->id;
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
            $carouseloffer->is_active = $request->offerstatus;
            $carouseloffer->user_id = Auth::User()->id;
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
            if(!File::exists(public_path("/images/carousel"))){
                File::makeDirectory(public_path("/images/carousel", 0777, true, true));
            }
            if(File::exists($carouseloffer->image_url)){
                File::delete($carouseloffer->image_url);
            }
            $carousel_image = $request->file('carouselofferimage');
            $resized_carousel_image = Image::make($carousel_image);
            $resized_carousel_image->resize(400, 300);
            $carousel_image_name = "carousel-".time().".".$carousel_image->getClientOriginalExtension();
            $resized_carousel_image->save(public_path('/images/carousel/'.$carousel_image_name));
            $carousel_image_path = '/images/carousel/'.$carousel_image_name;
            $carouseloffer->image_url = $carousel_image_path;
            $carouseloffer->user_id = Auth::User()->id;
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
                "url" => Session::get('url'),
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
