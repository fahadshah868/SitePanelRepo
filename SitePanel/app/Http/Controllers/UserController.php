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
        $is_save = $user->save();
        if($is_save){
            $response = [
                "status" => "true",
                "success_message" => "Add User Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Error! User Not Registered Successfully"
            ];
            return response()->json($response);
        }
    }
    public function getAllUsers(){
        $data['allusers'] = User::all();
        $data['userscount'] = count($data['allusers']);
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
    public function deleteUser($id){
        $user = User::find($id);
        $is_delete = $user->delete();
        if($is_delete){
            $response = [
                "status" => "true",
                "success_message" => "User Deleted Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Error! User Not Deleted Successfully"
            ];
            return response()->json($response);
        }
    }
}
