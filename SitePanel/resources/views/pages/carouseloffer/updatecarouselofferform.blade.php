<div class="form-main-container">
    <div class="form-main-heading">Update Carousel Offer</div>
    <hr>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="updatecarouselofferform" action="#" method="#">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <input type="text" id="carouselofferid" value="{{ $carouseloffer->id }}" hidden>
                        <input type="text" id="storetitle" hidden/>
                        <div class="form-field-heading">Select Store</div>
                        <select class="form-control form-field-text" id="offer_store" name="offer_store">
                            @foreach($allstores as $store)
                                @if($carouseloffer->store_id == $store->id)
                                <option value="{{$store->id}}" selected>{{$store->title}}</option>
                                @else
                                <option value="{{$store->id}}">{{$store->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Title</div>
                        <input type="text" class="form-control form-field-text" id="offertitle" name="offertitle" value="{{$carouseloffer->title}}" placeholder="20% Off on your online order"/>
                    </div>
                </div>
            </div>
            @if($carouseloffer->code != null)
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
                        <select class="form-control form-field-text" id="offertype" name="offertype">
                            @if($carouseloffer->type == "Code")
                            <option value="Code" selected>Code</option>
                            <option value="Sale">Sale</option>
                            @else
                            <option value="Code">Code</option>
                            <option value="Sale" selected>Sale</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Code</div>
                        <input type="text" class="form-control form-field-text" id="offercode" name="offercode" placeholder="code" value="{{$carouseloffer->code}}" autocomplete="off">
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <div class="form-field-checkbox">
                        <label class="form-field-checkbox-label">
                            <input type="checkbox" id="offercode-checkbox" checked>Code Not Required
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type By Store</div>
                        <select class="form-control form-field-text" id="offertype" name="offertype">
                                @if($carouseloffer->type == "Code")
                                <option value="Code" selected>Code</option>
                                <option value="Sale">Sale</option>
                                @else
                                <option value="Code">Code</option>
                                <option value="Sale" selected>Sale</option>
                                @endif
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Code</div>
                        <input type="text" class="form-control form-field-text" id="offercode" name="offercode" placeholder="code" autocomplete="off" disabled>
                    </div>
                </div>
            </div>
            @endif
            @if($carouseloffer->expiry_date != null)
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
                        <input type="text" id="offer_startingdate" name="offer_startingdate" class="form-control form-field-text  readonly-bg-color" readonly placeholder="select starting date" autocomplete="off" value="{{ \Carbon\Carbon::parse($carouseloffer->starting_date)->format('d-m-Y') }}"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Expiry Date</div>
                        <input type="text" id="offer_expirydate" name="offer_expirydate" class="form-control form-field-text readonly-bg-color" readonly placeholder="select expiry date" value="{{\Carbon\Carbon::parse($carouseloffer->expiry_date)->format('d-m-Y')}}"/>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <div class="form-field-checkbox">
                        <label class="form-field-checkbox-label">
                            <input type="checkbox" id="expiry-date-checkbox" name="expiry-date-checkbox" checked>Expiry Date Not Required
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Starting Date</div>
                        <input type="text" id="offer_startingdate" name="offer_startingdate" class="form-control form-field-text readonly-bg-color" readonly placeholder="select starting date" autocomplete="off" value="{{\Carbon\Carbon::parse($carouseloffer->starting_date)->format('d-m-Y')}}"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Expiry Date</div>
                        <input type="text" id="offer_expirydate" name="offer_expirydate" class="form-control form-field-text" readonly placeholder="select expiry date" disabled/>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Status</div>
                        <div class="form-field-inline-remarks">
                            @if($carouseloffer->status == "active")
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
                            @else
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="offerstatus" name="offerstatus" value="active">Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="offerstatus" name="offerstatus" value="deactive" checked>Deactive
                                </label>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-buttons-container">
                <div>
                    <a href="/updatecarouseloffer/{{$carouseloffer->id}}" id="backtocarouseloffer" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Carousel Offer</a>
                    <input type="submit" value="Update Carousel Offer" class="btn btn-primary form-button"/>
                </div>
                <div>
                    <a href="#" id="resetupdatecarouselofferform" class="btn btn-info form-button"><i class="fa fa-undo"></i>Reset Form</a>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        var dateToday = new Date();
        var _maxdate = null;
        function resetUpdateCarouselForm(){
            $("#updatecarouselofferform").trigger("reset");
            if($("#offercode-checkbox").prop("checked")){
                $("#offercode").prop('disabled', true);
            }
            else{
                $("#offercode").prop('disabled', false);
            }
            if($("#expiry-date-checkbox").prop("checked")){
                $("#offer_expirydate").removeClass("readonly-bg-color");
                $("#offer_expirydate").prop('disabled', true);
            }
            else{
                $("#offer_expirydate").addClass("readonly-bg-color");
                $("#offer_expirydate").prop('disabled', false);
            }
        }
        if("{{$carouseloffer->expiry_date}}" != ""){
            _maxdate = "{{\Carbon\Carbon::parse($carouseloffer->expiry_date)->format('d-m-Y')}}"
        }
        $("#offer_startingdate").datepicker({
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            changeMonth: true,
            showButtonPanel: true,
            numberOfMonths: 2,
            minDate: dateToday,
            maxDate: _maxdate,
            onSelect: function(selectedDate) {
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                $("#offer_expirydate").datepicker("option","minDate",date);
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
        $("#offer_expirydate").datepicker({
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            changeMonth: true,
            showButtonPanel: true,
            numberOfMonths: 2,
            minDate: "{{\Carbon\Carbon::parse($carouseloffer->starting_date)->format('d-m-Y')}}",
            onSelect: function(selectedDate) {
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                $("#offer_startingdate").datepicker("option","maxDate",date);
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
        $("#backtocarouseloffer").click(function(){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
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
            }
            else{
                $("#offer_expirydate").addClass("readonly-bg-color");
                $("#offer_expirydate").prop('disabled', false);
            }
        });
        $("#resetupdatecarouselofferform").click(function(){
            event.preventDefault();
            resetUpdateCarouselForm();
        });
        //validation rules
        $("#updatecarouselofferform").submit(function(event){
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
                var _carouselofferid = $("#carouselofferid").val();
                var _offer_store = $("#offer_store").val();
                var _storetitle = $("#storetitle").val();
                var _offertitle = $("#offertitle").val();
                var _offertype = $("#offertype").val();
                var _offer_startingdate = $("#offer_startingdate").val();
                var _offerstatus = $("input[name='offerstatus']:checked").val();
                if(!$("#offercode-checkbox").prop("checked")){
                    _offercode = $("#offercode").val();
                }
                if(!$("#expiry-date-checkbox").prop("checked")){
                    _offer_expirydate = $("#offer_expirydate").val();
                }
                var _jsondata = JSON.stringify({carouselofferid: _carouselofferid, offer_store: _offer_store, storetitle: _storetitle, offertitle: _offertitle, offertype: _offertype, offercode: _offercode, offer_startingdate: _offer_startingdate, offer_expirydate: _offer_expirydate, offerstatus: _offerstatus, _token: "{{ csrf_token() }}"});
                alert(_jsondata);
                resetUpdateCarouselForm();
                $(".alert").css('display','none');
                $.ajax({
                    method: "POST",
                    url: "/updatecarouselofferform",
                    data: _jsondata,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#panel-body-container").load("/updatecarouseloffer/"+data.carouselofferid);
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
    });
</script>