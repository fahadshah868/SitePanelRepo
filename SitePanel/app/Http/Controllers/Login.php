<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Login extends Controller
{
    public function login(){
        return view("pages.login");
    }
    public function authenticate(Request $request){
        return redirect('/dashboard');
    }
}
