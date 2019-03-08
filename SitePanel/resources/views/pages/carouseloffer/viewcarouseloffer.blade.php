<div class="form-main-container">
    <div class="form-main-heading">View Carousel Offer</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div class="row">
        <div class="col-xl-3" style="margin: 20px 0;">
            <div class="update-image-container">
                <img src="{{asset($carouseloffer->image_url)}}" style="width: 210px; height: 80px; border: 1px solid #d1d1d1;">
                <button id="updatecarouselofferimagebutton" type="button" class="btn btn-primary update-image-button" data-toggle="modal" data-target="#updatecarouselofferimagemodal">Update Image<i class="fa fa-forward"></i></button>
            </div>            
            {{--popup to update image--}}
            <div class="modal fade" id="updatecarouselofferimagemodal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form id="updatecarouselofferimageform" action="#" method="#">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Carousel Offer Image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="text" value="{{ $carouseloffer->id }}" id="carouselofferid" name="carouselofferid" hidden>
                                <input type="text" value="{{ $carouseloffer->store->title }}" id="storetitle" hidden>
                                <img src="#" id="imgpath" class="carouselofferimage" />
                                <input type="file" id="carouselofferimage" name="carouselofferimage" accept=".jpg, .jpeg"/>
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
                        <input type="text" class="form-control form-field-text" value="{{ $carouseloffer->store->title }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Title</div>
                        <input type="text" class="form-control form-field-text" value="{{ $carouseloffer->title }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Location</div>
                        <input type="text" class="form-control form-field-text" value="{{ $carouseloffer->location }}" readonly/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type</div>
                        <input type="text" class="form-control form-field-text" value="{{ $carouseloffer->type }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Code</div>
                        @if($carouseloffer->code != null)
                        <input type="text" class="form-control form-field-text" value="{{ $carouseloffer->code }}" readonly/>
                        @else
                        <input type="text" class="form-control form-field-text" value="Not Required" style="color: #FF0000; font-weight: 600;" readonly/>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Starting Date</div>
                        <input type="text" class="form-control form-field-text" value="{{ \Carbon\Carbon::parse($carouseloffer->starting_date)->format('d-m-Y') }}" readonly/>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Expiry Date</div>
                        @if($carouseloffer->expiry_date != null)
                        <input type="text" class="form-control form-field-text" value="{{ \Carbon\Carbon::parse($carouseloffer->expiry_date)->format('d-m-Y') }}" readonly/>
                        @else
                        <input type="text" class="form-control form-field-text" value="Soon" style="color: #FF0000; font-weight: 600;" readonly/>
                        @endif
                    </div>
                </div>
                @if($carouseloffer->starting_date <= config('constants.today_date') && ($carouseloffer->expiry_date >= config('constants.today_date') || $carouseloffer->expiry_date == null))
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer life Remark</div>
                        <input type="text" class="form-control form-field-text available-offer" value="Available" readonly>
                    </div>
                </div>
                @elseif($carouseloffer->starting_date > config('constants.today_date'))
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer life Remark</div>
                        <input type="text" class="form-control form-field-text pending-offer" value="Pending" readonly>
                    </div>
                </div>
                @elseif($carouseloffer->expiry_date < config('constants.today_date'))
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer life Remark</div>
                        <input type="text" class="form-control form-field-text expired-offer" value="Expired" readonly>
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Status</div>
                        <input type="text" class="form-control form-field-text" value="{{ $carouseloffer->status }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Form Add/Update By</div>
                        <input type="text" class="form-control form-field-text" value="{{ $carouseloffer->form_user->username }}" readonly/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Image Add/Update By</div>
                        <input type="text" class="form-control form-field-text" value="{{ $carouseloffer->image_user->username }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Created At</div>
                        <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($carouseloffer->created_at)->format('d-m-Y  h:i:s A') }}" readonly/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Updated At</div>
                        @if($carouseloffer->updated_at != null)
                        <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($carouseloffer->updated_at)->format('d-m-Y  h:i:s A') }}" readonly/>
                        @else
                        <input type="text" class="form-control form-field-text" value="Not Yet" style="color: #FF0000; font-weight: 600;" readonly/>
                        @endif                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field" id="viewcarouseloffer-action-buttons">
                        <a href="{{Session::get('url')}}" id="backtocarouseloffers" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Carousel Offers</a>
                        <a href="/updatecarouselofferform/{{$carouseloffer->id}}" class="btn btn-primary form-button">Update Form<i class="fa fa-forward"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        if('{{Session::has("updatecarouseloffer_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updatecarouseloffer_successmessage")}}');
            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        else if('{{Session::has("updatecarouselofferimage_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updatecarouselofferimage_successmessage")}}');
            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#updatecarouselofferimagebutton").click(function(){
            $("#updatecarouselofferimageform").trigger("reset");
            $('#imgpath').attr("src", "");
        });
        $("#viewcarouseloffer-action-buttons a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $.validator.addMethod('validateimage', function(value, element) {
        return ($(element).data('imagewidth') === 1050 && $(element).data('imageheight') === 400);
        }, "please select the correct image");
        var validator = $("#updatecarouselofferimageform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                carouselofferimage: { required: true, validateimage: true }
            },
            messages: {
                carouselofferimage: {required: "please select carousel offer image", validateimage: "image dimaensions must be 1050 x 400"}
            },submitHandler: function(form) {
                var _carouselofferid = $("#carouselofferid").val();
                var _storetitle = $("#storetitle").val();
                var _carouselofferimage = $("#carouselofferimage")[0].files[0];
                var _jsondata = JSON.stringify({carouselofferid: _carouselofferid, storetitle: _storetitle});
                var formdata = new FormData();
                formdata.append("carouselofferimage", _carouselofferimage);
                formdata.append("formdata", _jsondata);
                formdata.append("_token", "{{ csrf_token() }}");
                $('#imgpath').attr("src", "");
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/updatecarouselofferimage",
                    dataType: "json",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#updatecarouselofferimagemodal").modal('toggle');
                            $("#panel-body-container").load("/updatecarouseloffer/"+data.carouselofferid);
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
            var photoinput = $("#carouselofferimage");
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
                        if(imagewidth == 1050 && imageheight == 400){
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
        $("#carouselofferimage").change(function(){
            readURL(this);
        });
    });
</script>