<div class="viewitems-main-container">
    <div class="viewitems-main-heading">View Category</div>
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
            @if(strcasecmp($category->is_topcategory,"yes") == 0)
            <div class="update-image-container category_image_preview_container">
                <img src="{{asset($category->logo_url)}}" class="category_image_preview">
                @if($category->logo_url == null)
                <button id="updatecategorylogobutton" type="button" class="btn btn-primary update-image-button" data-toggle="modal" data-target="#updatecategorylogomodal">Add Image<i class="fa fa-forward"></i></button>
                @else
                <button id="updatecategorylogobutton" type="button" class="btn btn-primary update-image-button" data-toggle="modal" data-target="#updatecategorylogomodal">Update Image<i class="fa fa-forward"></i></button>
                @endif
            </div>
            @else
            <div style="width: 200px; height: 200px; font-size: 25px; font-weight: 800; border: 1px solid #d1d1d1; display: flex; align-items: center; justify-content: center;">
                N/A
            </div>
            @endif
            {{--popup to update image--}}
            <div class="modal fade" id="updatecategorylogomodal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form id="updatecategoryimageform" action="#" method="#">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Category Logo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="text" value="{{ $category->id }}" id="categoryid" name="categoryid" hidden>
                                <img src="#" id="imgpath" class="category_image_preview" />
                                <input type="file" id="categorylogo" name="categorylogo" accept=".png, .jpg, .jpeg"/>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success form-button" data-dismiss="modal"><i class="fa fa-backward"></i>Cancel</button>
                                @if($category->logo_url == null)
                                <input type="submit" class="btn btn-primary form-button" value="Add">
                                @else
                                <input type="submit" class="btn btn-primary form-button" value="Update">
                                @endif
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
                        <div class="form-field-heading">Category Title</div>
                        <input type="text" class="form-control form-field-text" value="{{ $category->title }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Category Url</div>
                        <input type="text" class="form-control form-field-text" value="{{ $category->url }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Category Description</div>
                        <textarea id="categorydescription" readonly>{!! $category->description !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Is TopCategory</div>
                        <input type="text" class="form-control form-field-text" value="{{ $category->is_topcategory }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Is PopularCategory</div>
                        <input type="text" class="form-control form-field-text" value="{{ $category->is_popularcategory }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Category Status</div>
                        @if(strcasecmp($category->status,"active") == 0)
                        <input type="text" class="form-control form-field-text active-item" value="_{{ $category->status }}" readonly/>
                        @else
                        <input type="text" class="form-control form-field-text deactive-item" value="{{ $category->status }}" readonly/>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Category Added/Updated By</div>
                        <input type="text" class="form-control form-field-text" value="{{ $category->user->username }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Category Created At</div>
                        <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($category->created_at)->format('d-m-Y  h:i:s A') }}" readonly/>
                    </div>
                </div>
            </div>
            @if($category->updated_at != null)
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Category Updated At</div>
                        <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($category->updated_at)->format('d-m-Y  h:i:s A') }}" readonly/>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Category Updated At</div>
                        <input type="text" class="form-control form-field-text not-required-yet" value="Not Yet" readonly/>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field" id="viewcategory-action-buttons">
                        <a href="{{Session::get('url')}}" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Categories</a>
                        <a href="/updatecategoryform/{{$category->id}}" class="btn btn-primary form-button">Update Form<i class="fa fa-forward"></i></a>
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
        $('#categorydescription').ckeditor(); // if class is prefered.
        if('{{Session::has("updatecategory_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updatecategory_successmessage")}}');
            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        else if('{{Session::has("updatecategorylogo_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updatecategorylogo_successmessage")}}');
            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#updatecategorylogobutton").click(function(){
            $("#updatecategoryimageform").trigger("reset");
            $('#imgpath').attr("src", "");
        });
        $("#viewcategory-action-buttons a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $.validator.addMethod('validateimage', function(value, element) {
        return ($(element).data('imagewidth') || 0) == $(element).data('imageheight');
        }, "please select the correct image");
        var validator = $("#updatecategoryimageform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                categorylogo: { required: true, validateimage: true }
            },
            messages: {
                categorylogo: {required: "please select category image logo", validateimage: "image width and height must be same and must be 200 or greater e.g 200 x 200 etc"}
            },submitHandler: function(form) {
                var _categoryid = $("#categoryid").val()
                var _categorylogo = $("#categorylogo")[0].files[0];
                var _jsondata = JSON.stringify({categoryid: _categoryid});
                var formdata = new FormData();
                formdata.append("categorylogo", _categorylogo);
                formdata.append("formdata", _jsondata);
                formdata.append("_token", "{{ csrf_token() }}");
                $('#imgpath').attr("src", "");
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/updatecategoryimage",
                    dataType: "json",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#updatecategorylogomodal").modal('toggle');
                            $("#panel-body-container").load("/viewcategory/"+data.categoryid);
                            $("#alert-success-message-area").html(data.success_message);
                            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
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
        $("#categorylogo").change(function(){
            readURL(this);
        });
    });
</script>