<div class="viewitems-main-container">
    <div class="viewitems-main-heading">View Store</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div class="row">
        <div class="col-xl-3" style="margin: 20px 0;">
            <div class="update-image-container">
                <img src="{{asset($store->logo_url)}}" style="width: 200px; height: 200px; border: 1px solid #d1d1d1;">
                <button id="updatestorelogobutton" type="button" class="btn btn-primary update-image-button" data-toggle="modal" data-target="#updatestorelogomodal">Update Image<i class="fa fa-forward"></i></button>
            </div>
            {{--popup to update image--}}
            <div class="modal fade" id="updatestorelogomodal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form id="updatestoreimageform" action="#" method="#">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Store Logo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="text" value="{{ $store->id }}" id="storeid" name="storeid" hidden>
                                <img src="#" id="imgpath" class="updateimage" />
                                <input type="file" id="storelogo" name="storelogo" accept=".png, .jpg, .jpeg"/>
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
                        <div class="form-field-heading">Store Title</div>
                        <input type="text" class="form-control form-field-text" value="{{ $store->title }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store's Description</div>
                        <textarea class="form-control form-field-textarea" readonly>{{ $store->description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Primary Url</div>
                        <input type="text" class="form-control form-field-text" value="{{ $store->primary_url }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Secondary Url</div>
                        <input type="text" class="form-control form-field-text" value="{{ $store->secondary_url }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Network</div>
                        <input type="text" class="form-control form-field-text" value="{{ $store->network->title }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Network Url</div>
                        <input type="text" class="form-control form-field-text" value="{{ $store->network_url }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Is Top Store</div>
                        <input type="text" class="form-control form-field-text" value="{{ $store->is_topstore }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Is popular Store</div>
                        <input type="text" class="form-control form-field-text" value="{{ $store->is_popularstore }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Status</div>
                        <input type="text" class="form-control form-field-text" value="{{ $store->status }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Form Add/Update By</div>
                        <input type="text" class="form-control form-field-text" value="{{ $store->form_user->username }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Image Add/Update By</div>
                        <input type="text" class="form-control form-field-text" value="{{ $store->image_user->username }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Created At</div>
                        <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($store->created_at)->format('d-m-Y  h:i:s A') }}" readonly/>
                    </div>
                </div>
            </div>
            @if($store->updated_at != null)
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Updated At</div>
                        <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($store->updated_at)->format('d-m-Y  h:i:s A') }}" readonly/>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Updated At</div>
                        <input type="text" class="form-control form-field-text" value="Not Yet" style="color: #FF0000; font-weight: 600;" readonly/>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field" id="viewstore-action-buttons">
                        <a href="{{Session::get('url')}}" id="backtostores" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Stores</a>
                        <a href="/updatestoreform/{{$store->id}}" class="btn btn-primary form-button">Update Form<i class="fa fa-forward"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        if('{{Session::has("updatestore_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updatestore_successmessage")}}');
            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        else if('{{Session::has("updatestorelogo_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updatestorelogo_successmessage")}}');
            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#updatestorelogobutton").click(function(){
            $("#updatestoreimageform").trigger("reset");
            $('#imgpath').attr("src", "");
        });
        $("#viewstore-action-buttons a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $.validator.addMethod('validateimage', function(value, element) {
        return ($(element).data('imagewidth') || 0) == $(element).data('imageheight');
        }, "please select the correct image");
        var validator = $("#updatestoreimageform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                storelogo: { required: true, validateimage: true }
            },
            messages: {
                storelogo: {required: "please select store image logo", validateimage: "image width and height must be same and must be 200 or greater e.g 200 x 200 etc"}
            },submitHandler: function(form) {
                var _storeid = $("#storeid").val()
                var _storelogo = $("#storelogo")[0].files[0];
                var _jsondata = JSON.stringify({storeid: _storeid});
                var formdata = new FormData();
                formdata.append("storelogo", _storelogo);
                formdata.append("formdata", _jsondata);
                formdata.append("_token", "{{ csrf_token() }}");
                $('#imgpath').attr("src", "");
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/updatestoreimage",
                    dataType: "json",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#updatestorelogomodal").modal('toggle');
                            $("#panel-body-container").load("/viewstore/"+data.storeid);
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
            var photoinput = $("#storelogo");
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
        $("#storelogo").change(function(){
            readURL(this);
        });
    });
</script>