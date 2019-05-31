<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;

class LoginController extends Controller
{
    public function getLogin(){
        return view("pages.login");
    }
    public function postLogin(Request $request){
        $userdata = array(
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'is_active' => 'y',
        );
        if(Auth::attempt($userdata)){
            return redirect('/dashboard');
        }
        else{
            Session::flash('login_errormessage' , "Wrong Login Details");
            return back();
        }
    }
}
