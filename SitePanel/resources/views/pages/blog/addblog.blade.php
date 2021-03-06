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
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-field">
                                <div class="form-field-heading">Blog Category</div>
                                <select class="form-control form-field-text" name="blog_category_id" id="blog_category_id">
                                    <option value="">Select Category</option>
                                    @foreach($blogcategories as $blogcategory)
                                        <option value="{{$blogcategory->id}}">{{$blogcategory->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-field">
                                <div class="form-field-heading">Blog Author</div>
                                <input type="text" class="form-control form-field-text" id="blog_author" name="blog_author" placeholder="Author">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Image</div>
                        <img src="#" id="imgpath" class="blog_image_preview"/>
                        <input type="file" class="form-field-file" name="blog_image" id="blog_image"  accept=".png, .jpg, .jpeg"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Body</div>
                        <textarea id="blog_body" name="blog_body" placeholder="Body"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <input type="submit" value="Add Blog" class="btn btn-primary form-button"/>
                </div>
                <div class="col-sm-6">
                    <div class="form-field-heading">Blog Status</div>
                        <div class="form-field-inline-remarks">
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="blogstatus" name="blogstatus" value="y" checked>Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="blogstatus" name="blogstatus" value="n">Deactive
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
$(document).ready(function(){
    CKEDITOR.replace('blog_body',{
        height: 300,
        filebrowserBrowseUrl: '{{ route('upload',['_token' => csrf_token() ]) }}',
        filebrowserImageBrowseUrl: '{{ route('upload',['_token' => csrf_token() ]) }}',
        filebrowserFlashBrowseUrl: '{{ route('upload',['_token' => csrf_token() ]) }}',
        filebrowserUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}',
    });
    $(".close").click(function(){
        $(".alert").slideUp();
    });
    //custom validation method to check image dimensions
    $.validator.addMethod('validateimage', function(value, element) {
    return ($(element).data('imagewidth') == 900 && $(element).data('imageheight') == 500 || $(element).data('imagewidth')/$(element).data('imageheight') == 1.8 || 0);
    }, "please select the correct image");
    //validation rules
    var validator = $("#addblogform").submit(function(event){
        event.preventDefault();
    }).validate({
        ignore: [],
        debug: false,
        rules: {
            blog_title: "required",
            blog_body:  { 
                            required: function(){
                                CKEDITOR.instances.blog_body.updateElement();
                            },
                            minlength: 1,
                        },
            blog_category_id: "required",
            blog_author: "required",
            blogstatus: "required",
            blog_image: { required: true, validateimage: true }
        },
        messages: {
            blog_title: "please enter blog title",
            blog_body: {
                            required: "please fill blog body",
                            minlength:"please fill blog body",
                        },
            blog_category_id: "please select blog category",
            blog_author: "please enter blog author",
            blogstatus: "please select blog status",
            blog_image: {required: "please select blog image", validateimage: "image dimensions must be 900 x 500 OR image ratio must be 1.8"}
        },
        submitHandler: function(form) {
            var _blog_title = $("#blog_title").val();
            var _blog_body = $("#blog_body").val();
            var _blog_category_id = $("#blog_category_id").val();
            var _blog_author = $("#blog_author").val();
            var _blogstatus = $("input[name='blogstatus']:checked").val();
            var _blog_image = $("#blog_image")[0].files[0];
            var formdata = new FormData();
            var _jsondata = JSON.stringify({blog_title: _blog_title, blog_body: _blog_body, blog_category_id: _blog_category_id, blog_author: _blog_author, blogstatus: _blogstatus});
            formdata.append("formdata", _jsondata);
            formdata.append("_token", "{{ csrf_token() }}");
            formdata.append("blog_image", _blog_image);
            $("#addblogform").trigger("reset");
            CKEDITOR.instances['blog_body'].setData('');
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
                    if(data.status == "true"){
                        $("#alert-success-message-area").html(data.success_message);
                        $("#alert-success").fadeTo(1000, 500).slideUp(500, function(){
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
        var photoinput = $("#blog_image");
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
                    if((imagewidth == 900 && imageheight == 500) || (imagewidth/imageheight == 1.8)){
                        $('#imgpath').attr('src', e.target.result);
                    }
                    else{
                        $('#imgpath').attr('src', '');
                    }
                    validator.element(photoinput);
                };
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    //when select any file
    $("#blog_image").change(function(){
        readURL(this);
    });
});
</script>