<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;

class LoginController extends Controller
{
    public function login(){
        return view("pages.login");
    }
    public function authenticate(Request $request){
        $userdata = array(
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        );
        if(Auth::attempt($userdata)){
            return redirect('/dashboard');
        }
        else{
            Session::flash('errormessage' , "wrong credentials");
            return back();
        }
    }
}
