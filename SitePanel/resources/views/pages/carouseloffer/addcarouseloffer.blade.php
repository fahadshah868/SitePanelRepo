<div class="form-main-container">
    <div class="form-main-heading">Add Carousel Offer</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="addcarouselofferform" action="#" method="#">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Select Store</div>
                        <input type="text" id="storetitle" hidden/>
                        <select class="form-control form-field-text" id="offer_store" name="offer_store">
                            <option value="">Select Store</option>
                            @foreach($allstores as $store)
                            <option value="{{$store->id}}">{{$store->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Title</div>
                        <input type="text" class="form-control form-field-text" id="offertitle" name="offertitle" placeholder="20% Off on your online order"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <div class="form-field-checkbox">
                        <label class="form-field-checkbox-label">
                            <input type="checkbox" id="offercode-checkbox">Code Not Required
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type By Store</div>
                        <select class="form-control form-field-text" id="offertype_bystore" name="offertype_bystore">
                            <option value="">Select Offer Type</option>
                            @foreach($alloffertypes as $offertype)
                            <option value="{{$offertype->id}}">{{$offertype->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Code</div>
                        <input type="text" class="form-control form-field-text" id="offercode" name="offercode" placeholder="code" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <div class="form-field-checkbox">
                        <label class="form-field-checkbox-label">
                            <input type="checkbox" id="expiry-date-checkbox" name="expiry-date-checkbox">Expiry Date Not Required
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Starting Date</div>
                        <input type="date" id="offer_startingdate" name="offer_startingdate" class="form-control form-field-text"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Expiry Date</div>
                        <input type="date" id="offer_expirydate" name="offer_expirydate" class="form-control form-field-text"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Carousel Offer Image</div>
                        <img src="#" id="imgpath" class="carouselofferimage"/>
                        <input type="file" id="carouselofferimage" name="carouselofferimage" class="form-field-file" accept=".jpg, .jpeg"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Status</div>
                        <div class="form-field-inline-remarks">
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="offerstatus" name="offerstatus" value="active" checked>Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="offerstatus" name="offerstatus" value="deactive">Deactive
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Carousel Offer" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#offer_store").change(function(){
            $("#storetitle").val($("#offer_store option:selected").text());
        });
        $("#offercode-checkbox").click(function(){
            if($("#offercode-checkbox").prop("checked")){
                $("#offercode").prop('disabled', true);
            }
            else{
                $("#offercode").prop('disabled', false);
            }
        });
        $("#expiry-date-checkbox").click(function(){
            if($("#expiry-date-checkbox").prop("checked")){
                $("#offer_expirydate").prop('disabled', true);
            }
            else{
                $("#offer_expirydate").prop('disabled', false);
            }
        });
        $.validator.addMethod('validateimage', function(value, element) {
        return ($(element).data('imagewidth') === 1050 && $(element).data('imageheight') === 400);
        }, "please select the correct image");
        //validation rules
        var validator = $("#addcarouselofferform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                offer_store: "required",
                offertitle: "required",
                offertype_bystore: "required",
                offercode: "required",
                offer_startingdate: "required",
                offer_expirydate: "required",
                carouselofferimage: { required: true, validateimage: true },
                offerstatus: "required"
            },
            messages: {
                offer_store: "please select store",
                offertitle: "please enter offer title",
                offertype_bystore: "please select offer type",
                offercode: "please enter offer code",
                offer_startingdate: "please select starting date",
                offer_expirydate: "please select expiry date",
                carouselofferimage: {required: "please select carousel offer image logo", validateimage: "image width must be 1050px and height must be 400 i.e. 1050 x 400 etc"},
                offerstatus: "please select offer status"
            },
            submitHandler: function(form) {
                var _offercode = null;
                var _offer_expirydate = null;
                var _offer_store = $("#offer_store").val();
                var _storetitle = $("#storetitle").val();
                var _offertitle = $("#offertitle").val();
                var _offertype_bystore = $("#offertype_bystore").val();
                var _offer_startingdate = $("#offer_startingdate").val();
                var _offerstatus = $("input[name='offerstatus']:checked").val();
                var _carouselofferimage = $("#carouselofferimage")[0].files[0];
                if(!$("#offercode-checkbox").prop("checked")){
                    _offercode = $("#offercode").val();
                }
                if(!$("#expiry-date-checkbox").prop("checked")){
                    _offer_expirydate = $("#offer_expirydate").val();
                }
                var formdata = new FormData();
                var _jsondata = JSON.stringify({offer_store: _offer_store, storetitle: _storetitle, offertitle: _offertitle, offertype_bystore: _offertype_bystore, offercode: _offercode, offer_startingdate: _offer_startingdate, offer_expirydate: _offer_expirydate, offerstatus: _offerstatus});
                alert(_jsondata);
                formdata.append("carouselofferimage", _carouselofferimage);
                formdata.append("formdata", _jsondata);
                formdata.append("_token", "{{ csrf_token() }}");
                $("#addofferform").trigger("reset");
                $(".alert").css('display','none');
                $.ajax({
                    method: "POST",
                    url: "/addcarouseloffer",
                    data: formdata,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(data){
                        alert(data);
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