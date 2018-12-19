<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Hash;

class ProfileController extends Controller
{
    public function getUpdateProfile(){
        return view('pages.updateprofile');
    }
    public function postUpdateProfile(Request $request){
        $user = User::find(Auth::User()->id);
        $user->password = Hash::make($request->newpassword);
        $is_update = $user->save();
        if($is_update){
            $response = [
                'status' => 'true',
                'success_message' => 'Your Profile Updated Successfully'
            ];
            return response()->json($response);
        }
        else{
            $response = [
                'status' => 'false',
                'error_message' => 'Your Profile Is Not Updated Successfully'
            ];
            return response()->json($response);
        }
    }
}
