<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    public function addUser(){
        return view('pages.user.adduser');
    }
    public function viewAllUsers(){
        return view('pages.user.allusers');
    }
}
