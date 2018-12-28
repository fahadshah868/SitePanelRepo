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
        $is_user_exists = User::where('username',$request->username)->exists();
        if(!$is_user_exists){
            $user = new User;
            $user->username = strtolower($request->username);
            $user->password = Hash::make($request->password);
            $user->role = $request->userrole;
            $user->status = $request->userstatus;
            $is_user_save = $user->save();
            if($is_user_save){
                $response = [
                    "status" => "true",
                    "success_message" => "User Registered Successfully"
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
                "error_message" => strtolower($request->username)."! This User is Already Registered"
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
        $data['user'] = User::find($id);
        return view('pages.user.updateuser',$data);
    }
    public function postUpdateUser(Request $request){
        $user = User::find($request->userid);
        //if username == username
        if(strcasecmp($user->username , $request->username) == 0){
            $user->username = strtolower($request->username);
            $user->password = Hash::make($request->password);
            $user->role = $request->userrole;
            $user->status = $request->userstatus;
            $is_update = $user->save();
            if($is_update){
                $response = [
                    "status" => "true",
                    "success_message" => "User Updated Successfully"
                ];
                Session::flash('updateuser_successmessage','User Updated Successfully');
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => "Error! User Is Not Updated Successfully"
                ];
                return response()->json($response);
            }
        }
        else{
            $is_user_exists = User::where('username',$request->username)->exists();
            if(!$is_user_exists){
                $user->username = strtolower($request->username);
                $user->password = Hash::make($request->password);
                $user->role = $request->userrole;
                $user->status = $request->userstatus;
                $is_update = $user->save();
                if($is_update){
                    Session::flash('updateuser_successmessage','User Updated Successfully');
                    $response = [
                        "status" => "true",
                        "success_message" => "User Updated Successfully"
                    ];
                    return response()->json($response);
                }
                else{
                    $response = [
                        "status" => "false",
                        "error_message" => "Error! User Is Not Updated Successfully"
                    ];
                    return response()->json($response);
                }
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => strtolower($request->username)."! This User is Already Registered"
                ];
                return response()->json($response);
            }
        }
    }
    public function deleteUser($id){
        $user = User::find($id);
        $is_user_deleted = $user->delete();
        if($is_user_deleted){
            $response = [
                "status" => "true",
                "success_message" => "User Deleted Successfully"
            ];
            return response()->json($response);
        }
        else{
            $response = [
                "status" => "false",
                "error_message" => "Error! User Is Not Deleted Successfully"
            ];
            return response()->json($response);
        }
    }
}