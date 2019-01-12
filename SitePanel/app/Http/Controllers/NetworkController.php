<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Network;
use Session;

class NetworkController extends Controller
{
    public function getAddNetwork(){
        return view('pages.network.addnetwork');
    }
    public function postAddNetwork(Request $request){
        $is_exists = Network::where('title',$request->networktitle)->exists();
        if(!$is_exists){
            $network = new Network;
            $network->title = $request->networktitle;
            $network->status = $request->networkstatus;
            $is_saved = $network->save();
            if($is_saved){
                $response = [
                    "status" => "true",
                    "success_message" => "Network Added Successfully"
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => "Error! Network Is Not Added Successfully"
                ];
                return response()->json($response);
            }
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
        $data['allnetworks'] = Network::all();
        $data['networkscount'] = count($data['allnetworks']);
        return view('pages.network.allnetworks',$data);
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
            $is_updated = $network->save();
            if($is_updated){
                Session::flash('updatenetwork_successmessage','Network Updated Successfully');
                $response = [
                    "status" => "true",
                    "success_message" => "Network Updated Successfully"
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => "Network Is Not Updated Successfully"
                ];
                return response()->json($response);
            }
        }
        else{
            $is_exists = Network::where('title', $request->networktitle)->exists();
            if(!$is_exists){
                $network->title = $request->networktitle;
                $network->status = $request->networkstatus;
                $is_updated = $network->save();
                if($is_updated){
                    Session::flash('updatenetwork_successmessage','Network Updated Successfully');
                    $response = [
                        "status" => "true",
                        "success_message" => "Network Updated Successfully"
                    ];
                    return response()->json($response);
                }
                else{
                    $response = [
                        "status" => "false",
                        "error_message" => "Network Is Not Updated Successfully"
                    ];
                    return response()->json($response);
                }
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
}
