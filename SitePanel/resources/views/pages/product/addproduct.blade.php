<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    .dropdown-menu.show{
        height: 300px;
        top: -339px !important;
        bottom: 0;
    }
    </style>
</head>
<body>
<div class="form-main-container">
    <div class="form-main-heading">Add Product</div>
    <hr>
    <form>
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Title</div>
                        <input type="text" class="form-control" placeholder="xyz"/>
                    </div>
                </div>
                <div class="col-sm-6">
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
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Description</div>
                        <textarea class="form-control" placeholder="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store</div>
                        <select class="multiselectdropdown" multiple data-live-search="true">
                            <option>Target</option>
                            <option>Kohl's</option>
                            <option>Papa John's</option>
                            <option>Macys</option>
                            <option>Amazon</option>
                            <option>Dominos</option>
                            <option>Pizza Hut</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Category</div>
                        <select class="multiselectdropdown" multiple data-live-search="true">
                            <option>Baby</option>
                            <option>Clothing</option>
                            <option>Jewelery</option>
                            <option>Assessories</option>
                            <option>Beauty</option>
                            <option>Electronics</option>
                            <option>Food</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Start Date</div>
                        <input type="date" class="form-control"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">End Date</div>
                        <input type="date" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Product Type</div>
                        <select class="form-control">
                            <option>Select Type</option>
                            <option>Normal</option>
                            <option>Popular</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Product Status</div>
                        <select class="form-control">
                            <option>Select Type</option>
                            <option>Active</option>
                            <option>Deactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Category Logo</div>
                        <img src="#" id="imgpath" />
                        <input type="file" id="imgfilepath"/>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Product" class="btn btn-primary form-button"/>
        </div>
    </form>
    <script type="text/javascript" src="{{asset('js/multiselectdropdown.js')}}"></script>
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
</div>    
</body>
</html>