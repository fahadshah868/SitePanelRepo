<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use User;
use Hash;

class ProfileController extends Controller
{
    public function getUpdateProfile(){
        return view('pages.updateprofile');
    }
    public function postUpdateProfile(Request $request){
        $user = User::find(Auth::User()->id);
        $user->username = $request->username;
        $user->password = $request->newpassword;
        $is_update = $user->save();
        if($is_update){
            $response = [
                'status' => 'true',
                'success_message' => 'Your Profile Updated Successfully'
            ];
            return response()->json($request);
        }
        else{
            $response = [
                'status' => 'false',
                'error_message' => 'Your Profile Is Not Updated Successfully'
            ];
            return response()->json($request);
        }
    }
    public function postComparePassword(Request $request){
        $is_match = Hash::check($request->password, Auth::User()->password);
        if($is_match){
            $response = [
                'status' => 'true',
                'success_message' => 'match*'
            ];
            return response()->json($response);
        }
        else{
            $response = [
                'status' => 'false',
                'success_message' => 'not match*'
            ];
            return response()->json($response);
        }
    }
}
