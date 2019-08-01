<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Auth;
use Session;
use Carbon\Carbon;

class EventController extends Controller
{
    public function getAddEvent(){
        return view('pages.event.addevent');
    }
    public function postAddEvent(Request $request){
        $isevent_exists = Event::where('title',$request->eventtitle)->exists();
        if(!$isevent_exists){
            $event = new Event;
            $event->title = $request->eventtitle;
            $url = strtolower(str_replace(' ', '-', $request->eventtitle));
            $event->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
            $event->display_in_footer = $request->displayinfooter;
            $event->description = $request->eventdescription;
            $event->is_ready = $request->iseventready;
            $event->is_active = $request->eventstatus;
            $event->user_id = Auth::User()->id;
            $event->updated_at = null;
            $event->save();
            $response = [
                "status" => "true",
                "success_message" => "Event Added Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => $request->eventtitle."! This Event Is Already Added"
            ];
            return response()->json($response);
        }
    }
    public function getAllEvents(Request $request){
        Session::put('url',$request->getRequestUri());
        $data['allevents'] = Event::select('id','title','display_in_footer','is_ready','is_active','user_id')->orderBy('id', 'DESC')->with(['user' => function($q){
            $q->select('id','username');
        }])->get();
        $data['mainheading'] = "All Events";
        $data['eventscount'] = count($data['allevents']);
        $data['filtereddaterange'] = "";
        return view('pages.event.viewevents',$data);
    }
    public function getFilteredEvents(Request $request, $dateremark, $datefrom, $dateto){
        Session::put('url',$request->getRequestUri());
        if(strcasecmp($dateremark,"both") == 0 ){
            $data['allevents'] = Event::select('id','title','display_in_footer','is_ready','is_active','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['user' => function($q){
                $q->select('id','username');
            }])->get();
            $data['mainheading'] = "Created & Updated Events";
            $data['eventscount'] = count($data['allevents']);
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.event.viewevents',$data);
        }
        else if(strcasecmp($dateremark,"created") == 0){
            $data['allevents'] = Event::select('id','title','display_in_footer','is_ready','is_active','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['user' => function($q){
                $q->select('id','username');
            }])->get();
            $data['mainheading'] = "Created Events";
            $data['eventscount'] = count($data['allevents']);
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.event.viewevents',$data);
        }
        else if(strcasecmp($dateremark,"updated") == 0){
            $data['allevents'] = Event::select('id','title','display_in_footer','is_ready','is_active','user_id')->whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['user' => function($q){
                $q->select('id','username');
            }])->get();
            $data['mainheading'] = "Updated Events";
            $data['eventscount'] = count($data['allevents']);
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.event.viewevents',$data);
        }
    }
    public function getViewEvent($id){
        Session::put('flag',-1);
        $data['event'] = Event::with(['user' => function($q){
            $q->select('id','username');
        }])->find($id);
        return view('pages.event.viewevent',$data);
    }
    public function getUpdateEvent($id){
        $data['event'] = Event::find($id);
        return view('pages.event.updateevent',$data);
    }
    public function postUpdateEvent(Request $request){
        $event = Event::find($request->eventid);
        if(strcasecmp($event->title, $request->eventtitle) == 0){
            $event->title = $request->eventtitle;
            $url = strtolower(str_replace(' ', '-', $request->eventtitle));
            $event->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
            $event->display_in_footer = $request->displayinfooter;
            $event->description = $request->eventdescription;
            $event->is_ready = $request->iseventready;
            $event->is_active = $request->eventstatus;
            $event->user_id = Auth::User()->id;
            $event->save();
            Session::flash('updateevent_successmessage','Event Updated Successfully');
            $response = [
                "status" => "true",
                "event_id" => $request->eventid,
                "success_message" => "Event Updated Successfully"
            ];
            return response()->json($response);
        }
        else{
            $is_event_exists = Event::where('title', $request->eventtitle)->exists();
            if(!$is_event_exists){
                $event->title = $request->eventtitle;
                $url = strtolower(str_replace(' ', '-', $request->eventtitle));
                $event->url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);
                $event->display_in_footer = $request->displayinfooter;
                $event->description = $request->eventdescription;
                $event->is_ready = $request->iseventready;
                $event->is_active = $request->eventstatus;
                $event->user_id = Auth::User()->id;
                $event->save();
                Session::flash('updateevent_successmessage','Event Updated Successfully');
                $response = [
                    "status" => "true",
                    "event_id" => $request->eventid,
                    "success_message" => "Event Updated Successfully"
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => $request->eventtitle."! This Event Is Already Added"
                ];
                return response()->json($response);
            }
        }
    }
    public function deleteEvent($id){
        Session::put('flag',-1);
        $event = Event::find($id);
        try{
            $event->delete();
            $response = [
                "status" => "true",
                "url" => Session::get('url'),
                "success_message" => "Event Deleted Successfully"
            ];
            return response()->json($response);
        }
        catch(\Illuminate\Database\QueryException $ex){
            $response = [
                "status" => "false",
                "error_message" => $event->title."! Sorry, You Cannot Delete This Event Until You Delete Its Child Entries Exists In Other Tables."
            ];
            return response()->json($response);
        }
    }
}
