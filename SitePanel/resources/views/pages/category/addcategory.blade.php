<div class="form-main-container">
    <div class="form-main-heading">Add Category</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="addcategoryform">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Category Title</div>
                        <input type="text" class="form-control" name="categorytitle" id="categorytitle" placeholder="xyz"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Category Type</div>
                        <select class="form-control" name="categorytype" id="categorytype">
                            <option value="">Select Type</option>
                            <option value="Regular">Regular</option>
                            <option value="Popular">Popular</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Category Status</div>
                        <select class="form-control" name="categorystatus" id="categorystatus">
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 category-logo-container" id="category-logo-container">
                    <div class="form-field">
                        <div class="form-field-heading">Category Logo</div>
                        <img src="#" id="imgpath" />
                        <input type="file" class="hide" name="categorylogo" id="categorylogo"  accept=".png, .jpg, .jpeg"/>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Category" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#categorytype").change(function(){
            var categorytype = $("#categorytype").val();
            if(categorytype.toLowerCase() == "popular"){
                $("#category-logo-container").css("display","block");
                $("#categorylogo").attr("class","show");
            }
            else{
                $("#category-logo-container").css("display","none");
                $("#categorylogo").attr("class","hide");
            }
        });
        //custom validation method to check image dimensions
        $.validator.addMethod('validateimage', function(value, element) {
        return ($(element).data('imagewidth') || 0) == $(element).data('imageheight');
        }, "please select the correct image");
        //validation rules
        var validator = $("#addcategoryform").submit(function(event){
            event.preventDefault();
        }).validate({
            ignore: ".hide",
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
            },
            submitHandler: function(form) {
                var _categorytitle = $("#categorytitle").val();
                var _categorytype = $("#categorytype").val();
                var _categorystatus = $("#categorystatus").val();
                var formdata = new FormData();
                var _jsondata = JSON.stringify({categorytitle: _categorytitle, categorytype: _categorytype, categorystatus: _categorystatus});
                formdata.append("formdata", _jsondata);
                formdata.append("_token", "{{ csrf_token() }}");
                if($("#categorylogo").hasClass("show")){
                    var _categorylogo = $("#categorylogo")[0].files[0];
                    formdata.append("categorylogo", _categorylogo);
                }
                $("#addcategoryform").trigger("reset");
                $('#imgpath').attr("src", "");
                $(".alert").css("display","none");
                $("#category-logo-container").css("display","none");
                $("#categorylogo").attr("class","hide");
                $.ajax({
                    method: "POST",
                    url: "/addcategory",
                    dataType: "json",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#alert-success-message-area").html(data.success_message);
                            $("#alert-success").fadeTo(3000, 500).slideUp(500, function(){
                                $("#alert-success").slideUp(500);
                            });
                        }
                        else{
                            $("#alert-danger-message-area").html(data.error_message);
                            $("#alert-danger").css("display","block");
                        }
                    },
                    error: function(){
                        alert("Ajax Error! something went wrong...");
                    }
                });
                return false;
            }
        });
        //set image to imagebox
        function readURL(input) {
            var photoinput = $("#categorylogo");
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
        $("#categorylogo").change(function(){
            readURL(this);
        });
    });
</script>