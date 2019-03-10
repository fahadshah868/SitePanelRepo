<div class="form-main-container">
    <div class="form-main-heading">Add Blog</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="addblogform" action="#" method="#">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Title</div>
                        <input type="text" class="form-control form-field-text" id="blog_title" name="blog_title" placeholder="Title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Body</div>
                        <textarea placeholder="Body" id="blog_body" name="blog_body"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6" id="category-logo-container">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Image</div>
                        <img src="#" id="imgpath" />
                        <input type="file" class="form-field-file hide" name="blog_image" id="blog_image"  accept=".png, .jpg, .jpeg"/>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Blog" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>



<div id="sample"></div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
$(document).ready(function(){
    $('textarea').ckeditor();
    // $('.textarea').ckeditor(); // if class is prefered.

    $(".close").click(function(){
        $(".alert").slideUp();
    });

    //custom validation method to check image dimensions
    $.validator.addMethod('validateimage', function(value, element) {
    return ($(element).data('imagewidth') >= 200 && $(element).data('imagewidth') || 0) == $(element).data('imageheight');
    }, "please select the correct image");
    //validation rules
    var validator = $("#addblogform").submit(function(event){
        event.preventDefault();
    }).validate({
        ignore: ".hide",
        rules: {
            blog_title: "required",
            blog_body: "required",
            // blog_image: { required: true, validateimage: true }
        },
        messages: {
            blog_title: "please enter blog title",
            blog_body: "please fill blog body",
            // blog_image: {required: "please select category image logo", validateimage: "image width and height must be same and must be 200 or greater e.g 200 x 200 etc"}
        },
        submitHandler: function(form) {
            var _blog_title = $("#blog_title").val();
            var _blog_body = $("#blog_body").val();
            var formdata = new FormData();
            var _jsondata = JSON.stringify({blog_title: _blog_title, blog_body: _blog_body});
            alert(_jsondata);
            formdata.append("formdata", _jsondata);
            formdata.append("_token", "{{ csrf_token() }}");
            if($("#categorylogo").hasClass("show")){
                var _categorylogo = $("#categorylogo")[0].files[0];
                formdata.append("categorylogo", _categorylogo);
            }
            $("#addblogform").trigger("reset");
            $('#imgpath').attr("src", "");
            $(".alert").css("display","none");
            $.ajax({
                method: "POST",
                url: "/addblog",
                dataType: "json",
                data: formdata,
                contentType: false,
                processData: false,
                cache: false,
                success: function(data){
                    alert(data);
                    $("#sample").html("hello"+data);

                    // if(data.status == "true"){
                    //     $("#alert-success-message-area").html(data.success_message);
                    //     $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
                    //         $("#alert-success").slideUp(500);
                    //     });
                    // }
                    // else{
                    //     $("#alert-danger-message-area").html(data.error_message);
                    //     $("#alert-danger").css("display","block");
                    // }
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