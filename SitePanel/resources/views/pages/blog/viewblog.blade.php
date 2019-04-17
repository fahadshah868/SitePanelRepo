<div class="viewitems-main-container">
    <div class="viewitems-main-heading">View Blog</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <div class="row">
        <div class="col-xl-3" style="margin: 20px 0;">
            <div class="update-image-container blog_image_preview_container">
                <img src="{{asset($blog->image_url)}}" class="blog_image_preview">
                <button id="updateblogimagebutton" type="button" class="btn btn-primary update-image-button" data-toggle="modal" data-target="#updateblogimagemodal">Update Image<i class="fa fa-forward"></i></button>
            </div>
            {{--popup to update image--}}
            <div class="modal fade" id="updateblogimagemodal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form id="updateblogimageform" action="#" method="#">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Blog Logo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="text" value="{{ $blog->id }}" id="blogid" name="blogid" hidden>
                                <img src="#" id="imgpath" class="blog_image_preview" />
                                <input type="file" id="blogimage" name="blogimage" accept=".png, .jpg, .jpeg"/>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success form-button" data-dismiss="modal"><i class="fa fa-backward"></i>Cancel</button>
                                <input type="submit" class="btn btn-primary form-button" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Title</div>
                        <input type="text" class="form-control form-field-text" value="{{ $blog->title }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Body</div>
                        <textarea class="form-control form-field-textarea" id="blog_body" readonly>{!! $blog->body !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Author</div>
                        <input type="text" class="form-control form-field-text" value="{{ $blog->author }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Status</div>
                        @if(strcasecmp($blog->status,"active") == 0)
                        <input type="text" class="form-control form-field-text active-item" value="_{{ $blog->status }}" readonly/>
                        @else
                        <input type="text" class="form-control form-field-text deactive-item" value="{{ $blog->status }}" readonly/>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Form Added/Updated By</div>
                        <input type="text" class="form-control form-field-text" value="{{ $blog->user->username }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Created At</div>
                        <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($blog->created_at)->format('d-m-Y  h:i:s A') }}" readonly/>
                    </div>
                </div>
            </div>
            @if($blog->updated_at != null)
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Updated At</div>
                        <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($blog->updated_at)->format('d-m-Y  h:i:s A') }}" readonly/>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Updated At</div>
                        <input type="text" class="form-control form-field-text not-required-yet" value="Not Yet" readonly/>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field" id="viewblog-action-buttons">
                        <a href="{{Session::get('url')}}" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Blogs</a>
                        <a href="/updateblogform/{{$blog->id}}" class="btn btn-primary form-button">Update Form<i class="fa fa-forward"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
    $(document).ready(function(){
        $('#blog_body').ckeditor(); // if class is prefered.
        if('{{Session::has("updateblogform_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updateblogform_successmessage")}}');
            $("#alert-success").fadeTo(1000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        else if('{{Session::has("updateblogimage_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updateblogimage_successmessage")}}');
            $("#alert-success").fadeTo(1000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#updateblogimagebutton").click(function(){
            $("#updateblogimageform").trigger("reset");
            $('#imgpath').attr("src", "");
        });
        $("#viewblog-action-buttons a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $.validator.addMethod('validateimage', function(value, element) {
            return ($(element).data('imagewidth') == 900 && $(element).data('imageheight') == 500 || $(element).data('imagewidth')/$(element).data('imageheight') == 1.8 || 0);
        }, "please select the correct image");
        var validator = $("#updateblogimageform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                blogimage: { required: true, validateimage: true }
            },
            messages: {
                blogimage: {required: "please select blog image", validateimage: "image dimensions must be 900 x 500 OR image ratio must be 1.8"}
            },submitHandler: function(form) {
                var _blogid = $("#blogid").val()
                var _blogimage = $("#blogimage")[0].files[0];
                var _jsondata = JSON.stringify({blogid: _blogid});
                var formdata = new FormData();
                formdata.append("blog_image", _blogimage);
                formdata.append("formdata", _jsondata);
                formdata.append("_token", "{{ csrf_token() }}");
                $('#imgpath').attr("src", "");
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/updateblogimage",
                    dataType: "json",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#updateblogimagemodal").modal('toggle');
                            $("#panel-body-container").load("/viewblog/"+data.blogid);
                            $("#alert-success-message-area").html(data.success_message);
                            $("#alert-success").fadeTo(1000, 500).slideUp(500, function(){
                                $("#alert-success").slideUp(500);
                            });
                        }
                        else{
                            $("#updateblogimagemodal").modal('toggle');
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
            var photoinput = $("#blogimage");
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
        $("#blogimage").change(function(){
            readURL(this);
        });
    });
</script>