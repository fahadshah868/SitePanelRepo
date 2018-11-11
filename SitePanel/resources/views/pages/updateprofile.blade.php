@extends('layouts.app_layout')

@section('title','Update Profile')

@section('content')

<div class="form-main-container">
    <div class="form-main-heading">Update Profile</div>
    <hr>
    <form>
        @csrf
        <div class="update-profile-form">
            <div class="updateprofile-fields-heading">User Name:</div>
            <input type="text" class="form-control" placeholder="user name"/>
            <div class="updateprofile-fields-heading">Old Password:</div>
            <input type="password" class="form-control" placeholder="old password"/>
            <div class="updateprofile-fields-heading">New Password:</div>
            <input type="password" class="form-control" placeholder="new password"/>
            <div class="updateprofile-fields-heading">Re-Enter Password:</div>
            <input type="password" class="form-control" placeholder="re-enter password"/>
            <input type="submit" value="Update Profile" id="loginbutton"/>
        </div>
    </form>
</div>

@endsection