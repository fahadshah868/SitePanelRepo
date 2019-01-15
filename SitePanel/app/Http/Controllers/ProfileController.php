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
        $user->save();
        $response = [
            'status' => 'true',
            'success_message' => 'Your Profile Updated Successfully'
        ];
        return response()->json($response);
    }
}
