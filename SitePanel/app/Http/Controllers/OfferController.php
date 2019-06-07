<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Offer;
use App\StoreCategory;
use App\Event;
use App\EventOffer;
use Session;
use Auth;
use Log;
use Carbon\Carbon;

class OfferController extends Controller
{
    public function getAddOffer(){
        $data['events'] = Event::select('id','title')->where('is_ready','y')->get();
        $data['allstores'] = Store::select('id','title')->where('is_active','y')->get();
        return view("pages.offer.addoffer",$data);
    }
    public function postAddOffer(Request $request){
        $offer = new Offer;
        $offer->store_id = $request->offer_store;
        $offer->category_id = $request->offer_category;
        $offer->title = ucwords($request->offertitle);
        $offer->free_shipping = $request->free_shipping;
        $offer->anchor = strtoupper($request->offeranchor);
        $offer->location = $request->offerlocation;
        $offer->type = $request->offertype;
        $offer->code = $request->offercode;
        $offer->details = ucfirst($request->offerdetails);
        $offer->starting_date = Carbon::parse($request->offer_startingdate)->format('Y-m-d');
        if($request->offer_expirydate != null){
            $offer->expiry_date = Carbon::parse($request->offer_expirydate)->format('Y-m-d');
        }
        else{
            $offer->expiry_date = $request->offer_expirydate;
        }
        $offer->is_popular = $request->offer_is_popular;
        $offer->display_at_home = $request->offer_display_at_home;
        $offer->is_verified = $request->offer_is_verified;
        $offer->is_active = $request->offerstatus;
        $offer->user_id = Auth::User()->id;
        $offer->updated_at = null;
        $offer->save();
        if(count($request->events_id) > 0){
            for($event = 0; $event < count($request->events_id); $event++){
                $eventoffers[] = [
                    'offer_id' => $offer->id,
                    'event_id' => $request->events_id[$event],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            EventOffer::insert($eventoffers);
        }
        $response = [
            "status" => "true",
            "success_message" => "Offer Added Successfully"
        ];
        return response()->json($response);
    }
    public function getTodayAllOffers(){
        $data['alloffers'] = Offer::select('id','title','anchor','location','type','code','free_shipping','is_popular','display_at_home','is_verified','is_active','starting_date','expiry_date','user_id','store_id','category_id')->whereDate('created_at',config('constants.TODAY_DATE'))->orderBy('id', 'DESC')
        ->with(['store' => function($q){
            $q->select('id','title');
        }, 'category' => function($q){
            $q->select('id','title');
        }, 'user' => function($q){
            $q->select('id','username');
        }])->get();
        $data['mainheading'] = "Today's Offers";
        $data['offerscount'] = count($data['alloffers']);
        $data['filtereddaterange'] = "";
        Session::put(['url'=>'/todayalloffers','flag'=>1]);
        return view('pages.offer.viewoffers',$data);
    }
    public function getAllOffers(){
        $data['alloffers'] = Offer::select('id','title','anchor','location','type','code','free_shipping','is_popular','display_at_home','is_verified','is_active','starting_date','expiry_date','user_id','store_id','category_id')->orderBy('id', 'DESC')
        ->with(['store' => function($q){
            $q->select('id','title');
        }, 'category' => function($q){
            $q->select('id','title');
        }, 'user' => function($q){
            $q->select('id','username');
        }])->get();
        $data['mainheading'] = "All Offers";
        $data['offerscount'] = count($data['alloffers']);
        $data['filtereddaterange'] = "";
        Session::put(['url'=>'/alloffers','flag'=>1]);
        return view('pages.offer.viewoffers',$data);
    }
    public function getFilteredOffers($dateremark, $datefrom, $dateto){
        Session::put('url','/filteredoffers/'.$dateremark.'/'.Carbon::parse($datefrom)->format('Y-m-d').'/'.Carbon::parse($dateto)->format('Y-m-d'));
        if(Session::get('flag') == 1){
            if(strcasecmp($dateremark,"both") == 0 ){
                $response['filteredoffers'] = Offer::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with(['store' => function($q){
                    $q->select('id','title');
                }, 'category' => function($q){
                    $q->select('id','title');
                }, 'user' => function($q){
                    $q->select('id','username');
                }])->get();
                $response['mainheading'] = 'Created & Updated Offers<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredoffers']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
            else if(strcasecmp($dateremark,"created") == 0){
                $response['filteredoffers'] = Offer::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with(['store' => function($q){
                    $q->select('id','title');
                }, 'category' => function($q){
                    $q->select('id','title');
                }, 'user' => function($q){
                    $q->select('id','username');
                }])->get();
                $response['mainheading'] = 'Created Offers<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredoffers']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
            else if(strcasecmp($dateremark,"updated") == 0){
                $response['filteredoffers'] = Offer::whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with(['store' => function($q){
                    $q->select('id','title');
                }, 'category' => function($q){
                    $q->select('id','title');
                }, 'user' => function($q){
                    $q->select('id','username');
                }])->get();
                $response['mainheading'] = 'Updated Offers<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">('.count($response['filteredoffers']).'<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">('.$datefrom.' To '.$dateto.')</span>';
                return response()->json($response);
            }
        }
        else{
            Session::put('flag',1);
            if(strcasecmp($dateremark,"both") == 0 ){
                $data['alloffers'] = Offer::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with(['store' => function($q){
                    $q->select('id','title');
                }, 'category' => function($q){
                    $q->select('id','title');
                }, 'user' => function($q){
                    $q->select('id','username');
                }])->get();
                $data['mainheading'] = "Created & Updated Offers";
                $data['offerscount'] = count($data['alloffers']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.offer.viewoffers',$data);
            }
            else if(strcasecmp($dateremark,"created") == 0){
                $data['alloffers'] = Offer::whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with(['store' => function($q){
                    $q->select('id','title');
                }, 'category' => function($q){
                    $q->select('id','title');
                }, 'user' => function($q){
                    $q->select('id','username');
                }])->get();
                $data['mainheading'] = "Created Offers";
                $data['offerscount'] = count($data['alloffers']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.offer.viewoffers',$data);
            }
            else if(strcasecmp($dateremark,"updated") == 0){
                $data['alloffers'] = Offer::whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
                ->orderBy('id','DESC')
                ->with(['store' => function($q){
                    $q->select('id','title');
                }, 'category' => function($q){
                    $q->select('id','title');
                }, 'user' => function($q){
                    $q->select('id','username');
                }])->get();
                $data['mainheading'] = "Updated Offers";
                $data['offerscount'] = count($data['alloffers']);
                $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
                return view('pages.offer.viewoffers',$data);
            }
        }
    }
    public function getViewOffer($id){
        Session::put('flag',-1);
        $data['offer'] = Offer::
        with(['store' => function($q){
            $q->select('id','title');
        }, 'category' => function($q){
            $q->select('id','title');
        }, 'eventoffers' => function($q){
            $q->select('id','event_id','offer_id')
            ->with(['event' => function($sq){
                $sq->select('id','title');
            }]);
        }])->find($id);
        return view('pages.offer.viewoffer',$data);
    }
    public function getUpdateOffer($id){
        $data['events'] = Event::select('id','title')->where('is_ready','y')->get();
        $data['offer'] = Offer::with(['store' => function($sq){
            $sq->select('id','title');
        }, 'category' => function($sq){
            $sq->select('id','title');
        }, 'eventoffers' => function($q){
            $q->select('id','offer_id','event_id');
        }])->find($id);
        $data['allstores'] = Store::select('id','title')->where('is_active','y')->get();
        $data['allstorecategories'] = StoreCategory::select('category_id')->where('store_id',$data['offer']->store_id)->with(['category' => function($q){
            $q->select('id','title')->where('is_active','y');
        }])->get();
        return view('pages.offer.updateoffer',$data);
    }
    public function postUpdateOffer(Request $request){
        $offer = Offer::find($request->offerid);
        $offer->store_id = $request->offer_store;
        $offer->category_id = $request->offer_category;
        $offer->title = ucwords($request->offertitle);
        $offer->free_shipping = $request->free_shipping;
        $offer->anchor = strtoupper($request->offeranchor);
        $offer->location = $request->offerlocation;
        $offer->type = $request->offertype;
        $offer->code = $request->offercode;
        $offer->details = ucfirst($request->offerdetails);
        $offer->starting_date = Carbon::parse($request->offer_startingdate)->format('Y-m-d');
        if($request->offer_expirydate != null){
            $offer->expiry_date = Carbon::parse($request->offer_expirydate)->format('Y-m-d');
        }
        else{
            $offer->expiry_date = $request->offer_expirydate;
        }
        $offer->is_popular = $request->offer_is_popular;
        $offer->display_at_home = $request->offer_display_at_home;
        $offer->is_verified = $request->offer_is_verified;
        $offer->is_active = $request->offerstatus;
        $offer->user_id = Auth::User()->id;
        $offer->save();
        $saved_eventoffers = $offer->eventoffers()->get();
        if(count($saved_eventoffers) == count($request->events_id)){
            for($savedevent = 0; $savedevent< count($saved_eventoffers); $savedevent++){
                $flag = false;
                for($requestedevent = 0; $requestedevent < count($request->events_id); $requestedevent++){
                    if($saved_eventoffers[$savedevent]->event_id == $request->events_id[$requestedevent]){
                        $flag = true;
                        break;
                    }
                }
                if($flag == false){
                    $offer->eventoffers()->delete();
                    if($request->events_id != 0){
                        for($event = 0; $event < count($request->events_id); $event++){
                            $eventoffers[] = [
                                'offer_id' => $offer->id,
                                'event_id' => $request->events_id[$event],
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ];
                        }
                        EventOffer::insert($eventoffers);
                    }
                    break;
                }
            }
        }
        else{
            $offer->eventoffers()->delete();
            if(count($request->events_id) > 0){
                for($event = 0; $event < count($request->events_id); $event++){
                    $eventoffers[] = [
                        'offer_id' => $offer->id,
                        'event_id' => $request->events_id[$event],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
                EventOffer::insert($eventoffers);
            }
        }
        Session::flash("updateoffer_successmessage","Offer Updated Successfully");
        $response = [
            "status" => "true",
            "offer_id" => $request->offerid,
            "success_message" => "Offer Updated Successfully"
        ];
        return response()->json($response);
    }
    public function deleteOffer($id){
        Session::put('flag',-1);
        $offer = Offer::find($id);
        try{
            $offer->delete();
            $response = [
                "status" => "true",
                "url" => Session::get('url'),
                "success_message" => "Offer Deleted Successfully"
            ];
            return response()->json($response);
        }
        catch(\Illuminate\Database\QueryException $ex){
            $response = [
                "status" => "false",
                "error_message" => "Sorry, You Cannot Delete This Offer Until You Delete Its Child Entries Exists In Other Tables."
            ];
            return response()->json($response);
        }
    }
}
