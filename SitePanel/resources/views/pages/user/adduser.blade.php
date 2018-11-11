@extends('layouts.app_layout')

@section('title','Add User')

@section('content')

<div class="form-main-container">
    <div class="form-main-heading">Add User</div>
    <hr>
    <form>
        <div class="form-container">
            <!---------------------------------------------------------------------------------
                COLUMN 1            
            ---------------------------------------------------------------------------------->
            <div class="column">
                <div class="form-field">
                <div class="form-field-heading">User Name</div>
                    <input type="text" class="form-control" placeholder="xyz"/>
                </div>
                <div class="form-field">
                    <div class="form-field-heading">User Type</div>
                    <select class="form-control">
                        <option>Select Type</option>
                        <option>Employee</option>
                        <option>Admin</option>
                    </select>
                </div>
            </div>
            <!---------------------------------------------------------------------------------
                COLUMN 2           
            ---------------------------------------------------------------------------------->
            <div class="column">
                <div class="form-field">
                    <div class="form-field-heading">Password</div>
                    <input type="text" class="form-control" placeholder="www.xyz.com"/>
                </div>
                <div class="form-field">
                    <div class="form-field-heading">User Status</div>
                    <select class="form-control">
                        <option>Select Status</option>
                        <option>Active</option>
                        <option>Deactive</option>
                    </select>
                </div>
            </div>
            <input type="submit" value="Add User" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgpath').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgfilepath").change(function(){
        readURL(this);
    });
</script>
@endsection