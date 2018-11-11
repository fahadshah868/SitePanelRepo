@extends('layouts.app_layout')

@section('title','Home Page')

@section('content')

<div class="form-main-container">
    <div class="form-main-heading">Add Category</div>
    <hr>
    <form>
        <div class="form-container">
            <!---------------------------------------------------------------------------------
                COLUMN 1            
            ---------------------------------------------------------------------------------->
            <div class="column">
                <div class="form-field">
                <div class="form-field-heading">Category Title</div>
                    <input type="text" class="form-control" placeholder="xyz"/>
                </div>
                <div class="form-field">
                    <div class="form-field-heading">Category Type</div>
                    <select class="form-control">
                        <option>Select Type</option>
                        <option>Normal</option>
                        <option>Popular</option>
                    </select>
                </div>
                <div class="form-field">
                    <div class="form-field-heading">Category Logo</div>
                    <img src="#" id="imgpath" />
                    <input type="file" id="imgfilepath"/>
                </div>
            </div>
            <!---------------------------------------------------------------------------------
                COLUMN 2
            ---------------------------------------------------------------------------------->
            <div class="column">
                <div class="form-field">
                    <div class="form-field-heading">Category Status</div>
                    <select class="form-control">
                        <option>Select Status</option>
                        <option>Active</option>
                        <option>Deactive</option>
                    </select>
                </div>
            </div>
            <input type="submit" value="Add Category" class="btn btn-primary form-button"/>
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