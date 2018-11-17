<div class="form-main-container">
    <div class="form-main-heading">Add Category</div>
    <hr>
    <form id="addcategoryform">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Category Title</div>
                        <input type="text" class="form-control" name="categorytitle" placeholder="xyz"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Category Type</div>
                        <select class="form-control" name="categorytype">
                            <option value="">Select Type</option>
                            <option value="Normal">Normal</option>
                            <option value="Popular">Popular</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Category Status</div>
                        <select class="form-control" name="categorystatus">
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Category Logo</div>
                        <img src="#" id="imgpath" />
                        <input type="file" name="categorylogo" id="imgfilepath"/>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Category" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        //custom validation method to check image dimensions
        $.validator.addMethod('validateimage', function(value, element) {
        return ($(element).data('imagewidth') || 0) == $(element).data('imageheight');
        }, "please select the correct image");
        //validation rules
        var validator = $("#addcategoryform").validate({
            rules: {
                categorytitle: "required",
                categorytype: "required",
                categorystatus: "required",
                categorylogo: { required: true, validateimage: true }
            },
            messages: {
                categorytitle: "please enter category title",
                categorytype: "please select category type",
                categorystatus: "please select category status",
                categorylogo: {required: "please select category image logo", validateimage: "image width and height must be same e.g 100 x 100 etc"}
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