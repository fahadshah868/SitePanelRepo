<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventOffer;
use App\Event;
use App\Offer;
use App\Store;
use App\Category;
use App\StoreCategory;
use Session;
use Carbon\Carbon;
use Auth;

class EventOfferController extends Controller
{
    public function getTodayAllOffers(Request $request){
        Session::put('url',$request->getRequestUri());
        $data['eventoffers'] = EventOffer::select('id','offer_id','event_id')->orderBy('id','DESC')
        ->whereDate('created_at',config('constants.TODAY_DATE'))
        ->with(['event' => function($q){
            $q->select('id','title');
        }, 'offer' => function($q){
            $q->select('id','title','starting_date','expiry_date','is_active','store_id','category_id')
            ->with(['store' => function($sq){
                $sq->select('id','title');
            }, 'category' => function($sq){
                $sq->select('id','title');
            }]);
        }])->paginate(200);
        $data['mainheading'] = "Today's Event Offers";
        $data['filtereddaterange'] = "";
        return view('pages.eventoffer.viewoffers',$data);
    }
    public function getAllOffers(Request $request){
        Session::put('url',$request->getRequestUri());
        $data['eventoffers'] = EventOffer::select('id','offer_id','event_id')->orderBy('id','DESC')
        ->with(['event' => function($q){
            $q->select('id','title');
        }, 'offer' => function($q){
            $q->select('id','title','starting_date','expiry_date','is_active','store_id','category_id')
            ->with(['store' => function($sq){
                $sq->select('id','title');
            }, 'category' => function($sq){
                $sq->select('id','title');
            }]);
        }])->paginate(200);
        $data['mainheading'] = "All Event Offers";
        $data['filtereddaterange'] = "";
        return view('pages.eventoffer.viewoffers',$data);
    }
    public function getFilteredOffers(Request $request, $dateremark, $datefrom, $dateto){
        Session::put('url',$request->getRequestUri());
        if(strcasecmp($dateremark,"both") == 0 ){
            $data['eventoffers'] = EventOffer::select('id','offer_id','event_id')->orderBy('id','DESC')
            ->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->with(['event' => function($q){
                $q->select('id','title');
            }, 'offer' => function($q){
                $q->select('id','title','starting_date','expiry_date','is_active','store_id','category_id')
                ->with(['store' => function($sq){
                    $sq->select('id','title');
                }, 'category' => function($sq){
                    $sq->select('id','title');
                }]);
            }])->paginate(200);
            $data['mainheading'] = "Created & Updated Offers";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.eventoffer.viewoffers',$data);
        }
        else if(strcasecmp($dateremark,"created") == 0){
            $data['eventoffers'] = EventOffer::select('id','offer_id','event_id')->orderBy('id','DESC')
            ->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->with(['event' => function($q){
                $q->select('id','title');
            }, 'offer' => function($q){
                $q->select('id','title','starting_date','expiry_date','is_active','store_id','category_id')
                ->with(['store' => function($sq){
                    $sq->select('id','title');
                }, 'category' => function($sq){
                    $sq->select('id','title');
                }]);
            }])->paginate(200);
            $data['mainheading'] = "Created Offers";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.eventoffer.viewoffers',$data);
        }
        else if(strcasecmp($dateremark,"updated") == 0){
            $data['eventoffers'] = EventOffer::select('id','offer_id','event_id')->orderBy('id','DESC')
            ->whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->with(['event' => function($q){
                $q->select('id','title');
            }, 'offer' => function($q){
                $q->select('id','title','starting_date','expiry_date','is_active','store_id','category_id')
                ->with(['store' => function($sq){
                    $sq->select('id','title');
                }, 'category' => function($sq){
                    $sq->select('id','title');
                }]);
            }])->paginate(200);
            $data['mainheading'] = "Updated Offers";
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.eventoffer.viewoffers',$data);
        }
    }
    public function getViewOffer($id){
        $data['eventoffer'] = EventOffer::with(['event' => function($q){
            $q->select('id','title');
        }, 'offer' => function($q){
            $q->with(['store' => function($sq){
                $sq->select('id','title');
            }, 'category' => function($sq){
                $sq->select('id','title');
            }]);
        }])->find($id);
        return view('pages.eventoffer.viewoffer',$data);
    }
    public function getUpdateOffer($id){
        $data['eventoffer'] = EventOffer::select('id','offer_id')
        ->with(['offer' => function($q){
            $q->with(['store' => function($sq){
                $sq->select('id','title');
            }, 'category' => function($sq){
                $sq->select('id','title');
            }]);
        }])->find($id);
        $data['allstores'] = Store::select('id','title')->where('is_active','y')->get();
        $data['allstorecategories'] = StoreCategory::select('category_id')->where('store_id',$data['eventoffer']->offer->store_id)->with(['category' => function($q){
            $q->select('id','title')->where('is_active','y');
        }])->get();
        return view('pages.eventoffer.updateoffer',$data);
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
        Session::flash("updateoffer_successmessage","Offer Updated Successfully");
        $response = [
            "status" => "true",
            "eventoffer_id" => $request->eventofferid,
            "success_message" => "Offer Updated Successfully"
        ];
        return response()->json($response);
    }
    public function deleteOffer($id){
        $eventoffer = EventOffer::find($id);
        try{
            $eventoffer->delete();
            $response = [
                "status" => "true",
                "url" => Session::get('url'),
                "success_message" => "Event Offer Deleted Successfully"
            ];
            return response()->json($response);
        }
        catch(\Illuminate\Database\QueryException $ex){
            $response = [
                "status" => "false",
                "error_message" => "Sorry, You Cannot Delete This Event Offer Until You Delete Its Child Entries Exists In Other Tables."
            ];
            return response()->json($response);
        }
    }
}
