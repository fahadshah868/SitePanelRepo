<div class="form-main-container">
    <div class="form-main-heading">Add Product</div>
    <hr>
    <form id="addproductform">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Title</div>
                        <input type="text" class="form-control" name="offertitle" placeholder="xyz"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type</div>
                        <select class="form-control" name="offertype">
                            <option value="">Select Offer Type</option>
                            <option value="Sale">Sale</option>
                            <option value="Code">Code</option>
                            <option value="Promocode">Promo Code</option>
                            <option value="InstoreCoupon">Instore Coupon</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Description</div>
                        <textarea class="form-control" name="offerdescription" placeholder="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Select Store</div>
                        <select class="multiselectdropdown" name="selectstore" multiple data-live-search="true">
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
                        <div class="form-field-heading">Select Category</div>
                        <select class="multiselectdropdown" name="selectcategory" multiple data-live-search="true">
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
                        <input type="date" name="startdate" class="form-control"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">End Date</div>
                        <input type="date" name="enddate" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Product Size</div>
                        <select class="multiselectdropdown" name="productsize" multiple data-live-search="true">
                            <option>Small</option>
                            <option>Medium</option>
                            <option>Large</option>
                            <option>XL</option>
                            <option>2XL</option>
                            <option>3XL</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Product Color</div>
                        <select class="form-control" name="productcolor">
                            <option value="">Select Colors</option>
                            <option>1 Color</option>
                            <option>2 Color</option>
                            <option>3 Color</option>
                            <option>4 Color</option>
                            <option>5 Color</option>
                            <option>6 Color</option>
                            <option>7 Color</option>
                            <option>8 Color</option>
                            <option>9 Color</option>
                            <option>10 Color</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Product Type</div>
                        <select class="form-control" name="producttype">
                            <option value="">Select Type</option>
                            <option value="Normal">Normal</option>
                            <option value="Popular">Popular</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Product Status</div>
                        <select class="form-control" name="productstatus">
                            <option value="">Select Type</option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Product Image</div>
                        <img src="#" id="imgpath" />
                        <input type="file" name="productimage" id="imgfilepath"/>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Product" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('js/multiselectdropdown.js')}}"></script>
<script>
    $(document).ready(function(){
        //custom validation method to check image dimensions
        $.validator.addMethod('validateimage', function(value, element) {
        return ($(element).data('imagewidth') || 0) == $(element).data('imageheight');
        }, "please select the correct image");
        //validation rules
        $("#addproductform").validate({
            rules: {
                offertitle: "required",
                offertype: "required",
                offerdescription: "required",
                selectstore: "required",
                selectcategory: "required",
                startdate: "required",
                enddate: "required",
                productsize: "required",
                productcolor: "required",
                producttype: "required",
                productstatus: "required",
                productimage: { required: true, validateimage: true}
            },
            messages: {
                offertitle: "please enter offer title",
                offertype: "please select offer type",
                offerdescription: "please enter offer description",
                selectstore: "please select store",
                selectcategory: "please select category",
                startdate: "please select starting date",
                enddate: "please select ending date",
                productsize: "please select product size",
                productcolor: "please select product color",
                producttype: "please select product type",
                productstatus: "please select product status",
                productimage: { required: "please select product image", validateimage: "image width and height must be same e.g 100 x 100 etc"}
            }
        });
        //set image to imagebox
        function readURL(input) {
            var photoinput = $("#imgfilepath");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    var image = new Image();
                    image.src= e.target.result;
                    image.onload = function() {
                        var imagewidth = image.width;
                        var imageheight = image.height;
                        photoinput.data('imagewidth', imagewidth);
                        photoinput.data('imageheight', imageheight);
                        if(imagewidth === imageheight){
                            $('#imgpath').attr('src', e.target.result);
                        }
                        validator.element(photoinput);
                    };
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        //when select any file
        $("#imgfilepath").change(function(){
            readURL(this);
        });
    });
</script>