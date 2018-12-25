<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OfferType;
use Session;

class OfferTypeController extends Controller
{
    public function getAddOfferType(){
        return view('pages.offertype.addoffertype');
    }
    public function postAddOfferType(Request $request){
        $is_offertypetitle_exists = OfferType::where('title',$request->offertypetitle)->exists();
        if(!$is_offertypetitle_exists){
            $offertype = new OfferType;
            $offertype->title = $request->offertypetitle;
            $offertype->status = $request->offertypestatus;
            $is_offertype_save = $offertype->save();
            if($is_offertype_save){
                $response = [
                    "status" => "true",
                    "success_message" => "Add Offer Type Successfully"
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => "Error! Offer Type Is Not added Successfully"
                ];
                return response()->json($response);
            }
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => $request->offertypetitle."! This Offer Type is Already Registered"
            ];
            return response()->json($response);
        }
    }
    public function getAllOfferTypes(){
        $data["alloffertypes"] = OfferType::all();
        $data["offertypescount"] = count($data["alloffertypes"]);
        return view('pages.offertype.alloffertypes',$data);
    }
    public function getUpdateOfferType($id){
        $data['offertype'] = OfferType::find($id);
        return view('pages.offertype.updateoffertype',$data);
    }
    public function postUpdateOfferType(Request $request){
        $offertype = OfferType::find($request->offertypeid);
        if(strcasecmp($offertype->title , $request->offertypetitle) == 0){
            $offertype->title = $request->offertypetitle;
            $offertype->status = $request->offertypestatus;
            $is_offertype_updated = $offertype->save();
            if($is_offertype_updated){
                Session::flash("updateoffertype_successmessage","Update Offer Type Successfully");
                $response = [
                    "status" => "true",
                    "success_message" => "Update Offer Type Successfully"
                ];
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => "Error! Offer Type Is Not Updated Successfully"
                ];
                return response()->json($response);
            }
        }
        else{
            $is_offertype_exists = OfferType::where('title',$request->offertypetitle)->exists();
            if(!$is_offertype_exists){
                $offertype->title = $request->offertypetitle;
                $offertype->status = $request->offertypestatus;
                $is_offertype_updated = $offertype->save();
                if($is_offertype_updated){
                    Session::flash("updateoffertype_successmessage","Update Offer Type Successfully");
                    $response = [
                        "status" => "true",
                        "success_message" => "Update Offer Type Successfully"
                    ];
                    return response()->json($response);
                }
                else{
                    $response = [
                        "status" => "false",
                        "error_message" => "Error! Offer Type Is Not Updated Successfully"
                    ];
                    return response()->json($response);
                }
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => $request->offertypetitle."! This Offer Type is Already Registered"
                ];
                return response()->json($response);
            }
        }
    }
    public function deleteOfferType($id){
        $offertype = OfferType::find($id);
        $is_offertype_deleted = $offertype->delete();
        if($is_offertype_deleted){
            $response = [
                "status" => "true",
                "success_message" => "Offer Type Deleted Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Error! Offer Type Is Not Deleted Successfully"
            ];
            return response()->json($response);
        }
    }
}
