<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Network;
use Session;
use Auth;
use Carbon\Carbon;

class NetworkController extends Controller
{
    public function getAddNetwork(){
        return view('pages.network.addnetwork');
    }
    public function postAddNetwork(Request $request){
        $is_network_exists = Network::where('title',$request->networktitle)->exists();
        if(!$is_network_exists){
            $network = new Network;
            $network->title = $request->networktitle;
            $network->is_active = $request->networkstatus;
            $network->user_id = Auth::User()->id;
            $network->updated_at = null;
            $network->save();
            $response = [
                "status" => "true",
                "success_message" => "Network Added Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => $request->networktitle."! This Network Is Already Added"
            ];
            return response()->json($response);
        }
    }
    public function getAllNetworks(Request $request){
        Session::put('url',$request->getRequestUri());
        $data['allnetworks'] = Network::select('id','title','is_active','user_id')->orderBy('id', 'DESC')->with(['user' => function($q){
            $q->select('id','username');
        }])->get();
        $data['mainheading'] = "All Networks";
        $data['networkscount'] = count($data['allnetworks']);
        $data['filtereddaterange'] = "";
        return view('pages.network.viewnetworks',$data);
    }
    public function getFilteredNetworks(Request $request, $dateremark, $datefrom, $dateto){
        Session::put('url',$request->getRequestUri());
        if(strcasecmp($dateremark,"both") == 0 ){
            $data['allnetworks'] = Network::select('id','title','is_active','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orWhereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['user' => function($q){
                $q->select('id','username');
            }])->get();
            $data['mainheading'] = "Created & Updated Networks";
            $data['networkscount'] = count($data['allnetworks']);
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.network.viewnetworks',$data);
        }
        else if(strcasecmp($dateremark,"created") == 0){
            $data['allnetworks'] = Network::select('id','title','is_active','user_id')->whereBetween((\DB::raw('DATE(created_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['user' => function($q){
                $q->select('id','username');
            }])->get();
            $data['mainheading'] = "Created Networks";
            $data['networkscount'] = count($data['allnetworks']);
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.network.viewnetworks',$data);
        }
        else if(strcasecmp($dateremark,"updated") == 0){
            $data['allnetworks'] = Network::select('id','title','is_active','user_id')->whereBetween((\DB::raw('DATE(updated_at)')),[Carbon::parse($datefrom)->format('Y-m-d'),Carbon::parse($dateto)->format('Y-m-d')])
            ->orderBy('id','DESC')
            ->with(['user' => function($q){
                $q->select('id','username');
            }])->get();
            $data['mainheading'] = "Updated Networks";
            $data['networkscount'] = count($data['allnetworks']);
            $data['filtereddaterange'] = "(".Carbon::parse($datefrom)->format('d-m-Y')." To ".Carbon::parse($dateto)->format('d-m-Y').")";
            return view('pages.network.viewnetworks',$data);
        }
    }
    public function getViewNetwork($id){
        $data['network'] = Network::with(['user' => function($q){
            $q->select('id','username');
        }])->find($id);
        return view('pages.network.viewnetwork',$data);
    }
    public function getUpdateNetwork($id){
        $data['network'] = Network::find($id);
        return view('pages.network.updatenetwork',$data);
    }
    public function postUpdateNetwork(Request $request){
        $network = Network::find($request->networkid);
        if(strcasecmp($network->title, $request->networktitle) == 0){
            $network->title = $request->networktitle;
            $network->is_active = $request->networkstatus;
            $network->user_id = Auth::User()->id;
            $network->save();
            Session::flash('updatenetwork_successmessage','Network Updated Successfully');
            $response = [
                "status" => "true",
                "network_id" => $request->networkid,
                "success_message" => "Network Updated Successfully"
            ];
            return response()->json($response);
        }
        else{
            $is_network_exists = Network::where('title', $request->networktitle)->exists();
            if(!$is_network_exists){
                $network->title = $request->networktitle;
                $network->is_active = $request->networkstatus;
                $network->user_id = Auth::User()->id;
                $network->save();
                Session::flash('updatenetwork_successmessage','Network Updated Successfully');
                $response = [
                    "status" => "true",
                    "network_id" => $request->networkid,
                    "success_message" => "Network Updated Successfully"
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => $request->networktitle."! This Network Is Already Added"
                ];
                return response()->json($response);
            }
        }
    }
    public function deleteNetwork($id){
        $network = Network::find($id);
        try{
            $network->delete();
            $response = [
                "status" => "true",
                "url" => Session::get('url'),
                "success_message" => "Network Deleted Successfully"
            ];
            return response()->json($response);
        }
        catch(\Illuminate\Database\QueryException $ex){
            $response = [
                "status" => "false",
                "error_message" => $network->title."! Sorry, You Cannot Delete This Network Until You Delete Its Child Entries Exists In Other Tables."
            ];
            return response()->json($response);
        }
    }
}