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
            $user->save();
            $response = [
                "status" => "true",
                "success_message" => "User Registered Successfully"
            ];
            return response()->json($response);
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
        $data['allusers'] = User::orderBy('id', 'DESC')->get();
        $data['userscount'] = count($data['allusers']);
        return view('pages.user.allusers', $data);
    }
    public function getViewUser($id){
        $data['user'] = User::find($id);
        return view('pages.user.viewuser', $data);
    }
    public function getUpdateUser($id){
        $data['user'] = User::find($id);
        return view('pages.user.updateuser',$data);
    }
    public function postUpdateUser(Request $request){
        $user = User::find($request->userid);
        //if username == username && pwd == pwd
        if(strcasecmp($user->username , $request->username) == 0 && strcasecmp($user->password , $request->userpassword) == 0){
            $user->username = strtolower($request->username);
            $user->role = $request->userrole;
            $user->status = $request->userstatus;
            $user->save();
            Session::flash("updateuser_successmessage","User Updated Successfully");
            $response = [
                "status" => "true",
                "user_id" => $request->userid,
                "success_message" => "User Updated Successfully"
            ];
            Session::flash('updateuser_successmessage','User Updated Successfully');
            return response()->json($response);
        }
        //if username != username && pwd == pwd
        else if(strcasecmp($user->username , $request->username) != 0 && strcasecmp($user->password , $request->userpassword) == 0){
            $is_user_exists = User::where('username',$request->username)->exists();
            if(!$is_user_exists){
                $user->username = strtolower($request->username);
                $user->role = $request->userrole;
                $user->status = $request->userstatus;
                $user->save();
                Session::flash("updateuser_successmessage","User Updated Successfully");
                $response = [
                    "status" => "true",
                    "user_id" => $request->userid,
                    "success_message" => "User Updated Successfully"
                ];
                Session::flash('updateuser_successmessage','User Updated Successfully');
                return response()->json($response);
            }
            else{
                $response = [
                    "status" => "false",
                    "error_message" => strtolower($request->username)."! This User is Already Registered"
                ];
                return response()->json($response);
            }
        }
        //if username == username && pwd != pwd
        else if(strcasecmp($user->username , $request->username) == 0 && strcasecmp($user->password , $request->userpassword) != 0){
            $user->username = strtolower($request->username);
            $user->password = Hash::make($request->userpassword);
            $user->role = $request->userrole;
            $user->status = $request->userstatus;
            $user->save();
            Session::flash("updateuser_successmessage","User Updated Successfully");
            $response = [
                "status" => "true",
                "user_id" => $request->userid,
                "success_message" => "User Updated Successfully"
            ];
            Session::flash('updateuser_successmessage','User Updated Successfully');
            return response()->json($response);
        }
        else if(strcasecmp($user->username , $request->username) != 0 && strcasecmp($user->password , $request->userpassword) != 0){
            $is_user_exists = User::where('username',$request->username)->exists();
            if(!$is_user_exists){
                $user->username = strtolower($request->username);
                $user->password = Hash::make($request->userpassword);
                $user->role = $request->userrole;
                $user->status = $request->userstatus;
                $user->save();
                Session::flash('updateuser_successmessage','User Updated Successfully');
                $response = [
                    "status" => "true",
                    "user_id" => $request->userid,
                    "success_message" => "User Updated Successfully"
                ];
                return response()->json($response);
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
        try{
            $user->delete();
            $response = [
                "status" => "true",
                "success_message" => "User Deleted Successfully"
            ];
            return response()->json($response);
        }
        catch(\Illuminate\Database\QueryException $ex){
            $response = [
                "status" => "false",
                "error_message" => $user->username."! Sorry, You Cannot Delete This User Until You Delete Its Child Entries Exists In Other Tables."
            ];
            return response()->json($response);
        }
    }
}