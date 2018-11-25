<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Session;

class UserController extends Controller
{
    public function getAddUser(){
        return view('pages.user.adduser');
    }
    public function postAddUser(Request $request){
        $user = new User;
        $user->username = $request->get('username');
        $user->password = Hash::make($request->get('password'));
        $user->usertype = $request->get('usertype');
        $user->userstatus = $request->get('userstatus');
        $user->save();
        Session::flash('successmessage','add user successfully');
        return back();
    }
    public function getAllUsers(){
        $data['allusers'] = User::all();
        return view('pages.user.allusers', $data);
    }
    public function getUpdateUser($id){
        $data['userdata'] = User::find($id);
        return view('pages.user.updateuser',$data);
    }
    public function putUpdateUser(Request $request, $id){
        $data['userdata'] = User::find($id);
        return view('pages.user.updateuser',$data);
    }
}
