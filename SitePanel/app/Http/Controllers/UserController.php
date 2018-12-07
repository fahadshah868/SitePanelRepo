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
        $is_user_exist = User::where('username',$request->username)->first();
        if(!$is_user_exist){
            $user = new User;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->type = $request->usertype;
            $user->status = $request->userstatus;
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
                    "error_message" => "Error! User Is Not Registered Successfully"
                ];
                return response()->json($response);
            }
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => $request->username."! This User is Already Registered"
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
    public function postUpdateUser(Request $request){
        $user = User::find($request->id);
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->type = $request->usertype;
        $user->status = $request->userstatus;
        $is_update = $user->save();
        if($is_update){
            $response = [
                "status" => "true",
                "success_message" => "Update User Successfully"
            ];
            Session::flash('updateuser_successmessage','User Updated Successfully');
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Error! User Not Updated Successfully"
            ];
            return response()->json($response);
        }
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