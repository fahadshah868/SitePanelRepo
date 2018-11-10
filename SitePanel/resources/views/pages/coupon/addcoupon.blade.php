@extends('layouts.app_layout')

@section('title','Home Page')

@section('content')

<div class="form-main-container">
    <div class="form-main-heading">Add Coupon</div>
    <hr>
    <form>
        <div class="form-container">
            <div class="column">
                <div class="form-field">
                <div class="form-field-heading">Offer Title</div>
                    <input type="text" class="form-control" placeholder="xyz"/>
                </div>
                <div class="form-field">
                    <div class="form-field-heading">Coupon Status</div>
                    <select class="form-control">
                        <option>Select Status</option>
                        <option>Active</option>
                        <option>Deactive</option>
                    </select>
                </div>
            </div>
            <div class="column">
                <div class="form-field">
                    <div class="form-field-heading">Offer Type</div>
                    <select class="form-control">
                        <option>Select Offer Type</option>
                        <option>Sale</option>
                        <option>Code</option>
                        <option>Instore Coupon</option>
                    </select>
                    </div>
                <div class="form-field">
                    <div class="form-field-heading">Coupon Type</div>
                    <select class="form-control">
                        <option>Select Type</option>
                        <option>Normal</option>
                        <option>Popular</option>
                    </select>
                </div>
            </div>
            <div class="column">
                <input type="submit" value="Add Store" class="btn btn-primary form-button"/>
            </div>
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