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
    <form id="addcategoryform" action="#" method="#">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Category Title</div>
                        <input type="text" class="form-control form-field-text" name="categorytitle" id="categorytitle" placeholder="Baby"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Category Description</div>
                        <textarea class="form-control form-field-textarea" id="categorydescription" name="categorydescription" placeholder="description about category"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Category remarks</div>
                        <div class="form-field-inline-remarks">
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    <input type="checkbox" id="is_topcategory" name="is_topcategory" value="yes">Top Category
                                </label>
                            </div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    <input type="checkbox" id="is_popularcategory" name="is_popularcategory" value="yes">Popular Category
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Category Status</div>
                        <div class="form-field-inline-remarks">
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="categorystatus" name="categorystatus" value="active" checked>Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="categorystatus" name="categorystatus" value="deactive">Deactive
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 category-logo-container" id="category-logo-container">
                    <div class="form-field">
                        <div class="form-field-heading">Category Logo</div>
                        <img src="#" id="imgpath" />
                        <input type="file" class="form-field-file hide" name="categorylogo" id="categorylogo"  accept=".png, .jpg, .jpeg"/>
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
        $("#is_topcategory").change(function(){
            if($("#is_topcategory").prop("checked")){
                $("#is_popularcategory").prop("checked", true);
                $("#category-logo-container").css("display","block");
                $("#categorylogo").removeClass("hide");
                $("#categorylogo").addClass("show");
            }
            else{
                $("#category-logo-container").css("display","none");
                $("#categorylogo").removeClass("show");
                $("#categorylogo").addClass("hide");
            }
        });
        $("#is_popularcategory").change(function(){
            if($("#is_popularcategory").prop("checked") == false){
                $("#is_topcategory").prop("checked", false);
                $("#category-logo-container").css("display","none");
                $("#categorylogo").removeClass("show");
                $("#categorylogo").addClass("hide");
            }
        });
        //custom validation method to check image dimensions
        $.validator.addMethod('validateimage', function(value, element) {
        return ($(element).data('imagewidth') >= 200 && $(element).data('imagewidth') || 0) == $(element).data('imageheight');
        }, "please select the correct image");
        //validation rules
        var validator = $("#addcategoryform").submit(function(event){
            event.preventDefault();
        }).validate({
            ignore: ".hide",
            rules: {
                categorytitle: "required",
                categorydescription: "required",
                categorystatus: "required",
                categorylogo: { required: true, validateimage: true }
            },
            messages: {
                categorytitle: "please enter category title",
                categorydescription: "please enter category description",
                categorystatus: "please select category status",
                categorylogo: {required: "please select category image logo", validateimage: "image width and height must be same and must be 200 or greater e.g 200 x 200 etc"}
            },
            submitHandler: function(form) {
                var _is_topcategory = "no";
                var _is_popularcategory = "no";
                var _categorytitle = $("#categorytitle").val();
                var _categorydescription = $("#categorydescription").val();
                var _categorystatus = $("input[name='categorystatus']:checked").val();
                if($("#is_topcategory").prop("checked")){
                    _is_topcategory = $("#is_topcategory").val();
                }
                if($("#is_popularcategory").prop("checked")){
                    _is_popularcategory = $("#is_popularcategory").val();
                }
                var formdata = new FormData();
                var _jsondata = JSON.stringify({categorytitle: _categorytitle, categorydescription: _categorydescription, is_topcategory: _is_topcategory, is_popularcategory: _is_popularcategory, categorystatus: _categorystatus});
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
                            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
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
                        if(imagewidth >= 200 && imagewidth === imageheight){
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