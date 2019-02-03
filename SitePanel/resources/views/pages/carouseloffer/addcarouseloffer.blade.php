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
                        <select class="form-control" data-live-search="true" id="offer_store" name="offer_store" style="font-size: 14px !important;">
                            <option value="">Select Store</option>
                            @foreach($allstores as $store)
                            <option value="{{$store->id}}" data-tokens="{{$store->title}}">{{$store->title}}</option>
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
                        <div class="form-field-heading">Offer Type</div>
                        <select class="form-control form-field-text" id="offertype" name="offertype">
                            <option value="">Select Offer Type</option>
                            <option value="Code">Code</option>
                            <option value="Sale">Sale</option>
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
                        <input type="text" id="offer_startingdate" name="offer_startingdate" class="form-control form-field-text readonly-bg-color" readonly placeholder="select starting date" autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Expiry Date</div>
                        <input type="text" id="offer_expirydate" name="offer_expirydate" class="form-control form-field-text readonly-bg-color" readonly placeholder="select expiry date" autocomplete="off"/>
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
        var dateToday = new Date();
        $('#offer_store').selectpicker();
        var dates = $("#offer_startingdate, #offer_expirydate").datepicker({
            changeYear: true,
            changeMonth: true,
            showButtonPanel: true,
            numberOfMonths: 2,
            minDate: dateToday,
            dateFormat: 'dd-mm-yy',
            onSelect: function(selectedDate) {
                var option = this.id == "offer_startingdate" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            },
            beforeShow: function( input ) {
                setTimeout(function() {
                    var buttonPane = $( input )
                        .datepicker( "widget" )
                        .find( ".ui-datepicker-buttonpane" );

                    $( "<button>", {
                        text: "Clear",
                        click: function() {
                        //Code to clear your date field (text box, read only field etc.) I had to remove the line below and add custom code here
                            $.datepicker._clearDate( input );
                        }
                    }).appendTo( buttonPane ).addClass("ui-datepicker-clear ui-state-default ui-priority-primary ui-corner-all");
                }, 1 );
            },
            onChangeMonthYear: function( year, month, instance ) {
                setTimeout(function() {
                    var buttonPane = $( instance )
                        .datepicker( "widget" )
                        .find( ".ui-datepicker-buttonpane" );

                    $( "<button>", {
                        text: "Clear",
                        click: function() {
                        //Code to clear your date field (text box, read only field etc.) I had to remove the line below and add custom code here
                            $.datepicker._clearDate( instance.input );
                        }
                    }).appendTo( buttonPane ).addClass("ui-datepicker-clear ui-state-default ui-priority-primary ui-corner-all");
                }, 1 );
            }
        });
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
                $("#offer_expirydate").removeClass("readonly-bg-color");
                $("#offer_expirydate").prop('disabled', true);
                $("#offer_expirydate").datepicker('setDate', null);
                $("#offer_startingdate").datepicker("option" , {maxDate: null});
            }
            else{
                $("#offer_expirydate").addClass("readonly-bg-color");
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
                offertype: "required",
                offercode: "required",
                offer_startingdate: "required",
                offer_expirydate: "required",
                carouselofferimage: { required: true, validateimage: true },
                offerstatus: "required"
            },
            messages: {
                offer_store: "please select store",
                offertitle: "please enter offer title",
                offertype: "please select offer type",
                offercode: "please enter offer code",
                offer_startingdate: "please select starting date",
                offer_expirydate: "please select expiry date",
                carouselofferimage: {required: "please select carousel offer image", validateimage: "image dimaensions must be 1050 x 400"},
                offerstatus: "please select offer status"
            },
            submitHandler: function(form) {
                var _offercode = null;
                var _offer_expirydate = null;
                var _offer_store = $("#offer_store").val();
                var _storetitle = $("#storetitle").val();
                var _offertitle = $("#offertitle").val();
                var _offertype = $("#offertype").val();
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
                var _jsondata = JSON.stringify({offer_store: _offer_store, storetitle: _storetitle, offertitle: _offertitle, offertype: _offertype, offercode: _offercode, offer_startingdate: _offer_startingdate, offer_expirydate: _offer_expirydate, offerstatus: _offerstatus});
                formdata.append("carouselofferimage", _carouselofferimage);
                formdata.append("formdata", _jsondata);
                formdata.append("_token", "{{ csrf_token() }}");
                $("#addcarouselofferform").trigger("reset");
                $("#offercode").prop('disabled', false);
                $("#offer_expirydate").addClass("readonly-bg-color");
                $("#offer_expirydate").prop('disabled', false);
                $("#offer_startingdate , #offer_expirydate").datepicker("option" , {minDate: null,maxDate: null});
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