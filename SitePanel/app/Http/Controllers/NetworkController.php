<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Network;
use Session;
use Auth;

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
            $network->status = $request->networkstatus;
            $network->user_id = Auth::User()->id;
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
    public function getAllNetworks(){
        $data['allnetworks'] = Network::orderBy('id', 'DESC')->get();
        $data['networkscount'] = count($data['allnetworks']);
        return view('pages.network.allnetworks',$data);
    }
    public function getViewNetwork($id){
        $data['network'] = Network::find($id);
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
            $network->status = $request->networkstatus;
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
                $network->status = $request->networkstatus;
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
