@extends('layouts.app_layout')

@section('title','Add Product')

@section('content')

<div class="form-main-container">
    <div class="form-main-heading">Add Product</div>
    <hr>
    <form>
        <div class="form-container">
            <!---------------------------------------------------------------------------------
                COLUMN 1            
            ---------------------------------------------------------------------------------->
            <div class="column">
                <div class="form-field">
                <div class="form-field-heading">Offer Title</div>
                    <input type="text" class="form-control" placeholder="xyz"/>
                </div>
                <div class="form-field">
                    <div class="form-field-heading">Description</div>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="form-field">
                    <div class="form-field-heading">Start Date</div>
                    <input type="date" class="form-control"/>
                </div>
                <div class="form-field">
                    <div class="form-field-heading">Coupon Status</div>
                    <select class="form-control">
                        <option>Select Status</option>
                        <option>Active</option>
                        <option>Deactive</option>
                    </select>
                </div>
                <div class="form-field">
                    <div class="form-field-heading">Store Logo</div>
                    <img src="#" id="imgpath" />
                    <input type="file" id="imgfilepath"/>
                </div>
            </div>
            <!----------------------------------------------------------------------------------
                COLUMN 2
            ------------------------------------------------------------------------------------>
            <div class="column">
                <div class="form-field">
                    <div class="form-field-heading">Offer Type</div>
                    <select class="form-control">
                        <option>Select Offer Type</option>
                        <option>Sale</option>
                        <option>Code</option>
                        <option>Promo Code</option>
                        <option>Instore Coupon</option>
                    </select>
                </div>
                <div class="form-field">
                    <div class="form-field-heading">Store</div>
                    <select class="form-control">
                        <option>Select Store</option>
                        <option>Target</option>
                        <option>Kohl's</option>
                        <option>Papa John's</option>
                        <option>Macys</option>
                        <option>Amazon</option>
                        <option>Dominos</option>
                        <option>Pizza Hut</option>
                    </select>
                </div>
                <div class="form-field" style="margin-top: 43px;">
                    <div class="form-field-heading">Category</div>
                    <select class="form-control">
                        <option>Select Category</option>
                        <option>Baby</option>
                        <option>Clothing</option>
                        <option>Jewelery</option>
                        <option>Assessories</option>
                        <option>Beauty</option>
                        <option>Electronics</option>
                        <option>Food</option>
                    </select>
                </div>
                <div class="form-field">
                    <div class="form-field-heading">End Date</div>
                    <input type="date" class="form-control"/>
                </div>
            </div>
            <input type="submit" value="Add Product" class="btn btn-primary form-button"/>
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