<div class="form-main-container">
    <div class="form-main-heading">Update Offer</div>
    <hr>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="updateofferform" method="#" method="#">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <input type="text" id="offerid" name="offerid" value="{{$offer->id}}" hidden>
                        <div class="form-field-heading">Select Store</div>
                        <select id="offer_store" name="offer_store" class="form-control form-field-text">
                            @foreach($allstores as $store)
                                @if($store->id == $offer->store_id)
                                <option value="{{$store->id}}" selected>{{$store->title}}</option>
                                @else
                                <option value="{{$store->id}}">{{$store->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Select Category</div>
                        <select id="offer_category" name="offer_category" class="form-control form-field-text">
                            @foreach($allstorecategories as $storecategory)
                                @if($storecategory->category_id == $offer->category_id)
                                <option value="{{$storecategory->category_id}}" selected>{{$storecategory->category->title}}</option>
                                @else
                                <option value="{{$storecategory->category_id}}">{{$storecategory->category->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="inline-form-fields">
                            <div class="form-field-heading">Offer Title</div>
                            @if(strcasecmp($offer->free_shipping,"y") == 0)
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-label">
                                    <input type="checkbox" id="free-shipping" value="y" checked>Free Shipping
                                </label>
                            </div>
                            @else
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-label">
                                    <input type="checkbox" id="free-shipping" value="y">Free Shipping
                                </label>
                            </div>
                            @endif
                        </div>
                        <input type="text" class="form-control form-field-text" id="offertitle" value="{{$offer->title}}" name="offertitle" placeholder="20% off on your online order"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Anchor</div>
                        <input type="text" class="form-control form-field-text" id="offeranchor" value="{{$offer->anchor}}" name="offeranchor" placeholder="20% off"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type</div>
                        <div class="row">
                            <div class="col-sm-6">
                                <select class="form-control form-field-text" id="offerlocation" name="offerlocation">
                                    @if(strcasecmp($offer->location,"Online") == 0)
                                    <option value="Online" selected>Online</option>
                                    <option value="In-Store">In-Store</option>
                                    <option value="Online & In-Store">Online & In-Store</option>
                                    @elseif(strcasecmp($offer->location,"In-Store") == 0)
                                    <option value="Online">Online</option>
                                    <option value="In-Store" selected>In-Store</option>
                                    <option value="Online & In-Store">Online & In-Store</option>
                                    @elseif(strcasecmp($offer->location,"Online & In-Store") == 0)
                                    <option value="Online">Online</option>
                                    <option value="In-Store">In-Store</option>
                                    <option value="Online & In-Store" selected>Online & In-Store</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-control form-field-text" id="offertype" name="offertype">
                                    @if(strcasecmp($offer->type,"Code") == 0)
                                    <option value="Code" selected>Code</option>
                                    <option value="Sale">Sale</option>
                                    @else
                                    <option value="Code">Code</option>
                                    <option value="Sale" selected>Sale</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        @if($offer->code != null)
                        <div class="inline-form-fields">
                            <div class="form-field-heading">Code</div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-label">
                                    <input type="checkbox" id="offercode-checkbox">Code Not Required
                                </label>
                            </div>
                        </div>
                        <input type="text" class="form-control form-field-text" id="offercode" name="offercode" value="{{$offer->code}}" placeholder="code" autocomplete="off">
                        @else
                        <div class="inline-form-fields">
                            <div class="form-field-heading">Code</div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-label">
                                    <input type="checkbox" id="offercode-checkbox" checked>Code Not Required
                                </label>
                            </div>
                        </div>
                        <input type="text" class="form-control form-field-text" id="offercode" name="offercode" placeholder="code" disabled autocomplete="off">
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Details</div>
                        <textarea class="form-control form-field-textarea" id="offerdetails" name="offerdetails" placeholder="description">{{$offer->details}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Starting Date</div>
                        <input type="text" id="offer_startingdate" name="offer_startingdate" class="form-control form-field-text readonly-bg-color" value="{{\Carbon\Carbon::parse($offer->starting_date)->format('d-m-Y')}}" readonly placeholder="select starting date" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        @if($offer->expiry_date != null)
                        <div class="inline-form-fields">
                            <div class="form-field-heading">Expiry Date</div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-label">
                                    <input type="checkbox" id="expiry-date-checkbox" name="expiry-date-checkbox">Expiry Date Not Required
                                </label>
                            </div>
                        </div>
                        <input type="text" id="offer_expirydate" name="offer_expirydate" class="form-control form-field-text readonly-bg-color" value="{{\Carbon\Carbon::parse($offer->expiry_date)->format('d-m-Y')}}" readonly placeholder="select Expiry date" autocomplete="off"/>
                        @else
                        <div class="inline-form-fields">
                            <div class="form-field-heading">Expiry Date</div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-label">
                                    <input type="checkbox" id="expiry-date-checkbox" name="expiry-date-checkbox" checked>Expiry Date Not Required
                                </label>
                            </div>
                        </div>
                        <input type="text" id="offer_expirydate" name="offer_expirydate" class="form-control form-field-text" readonly placeholder="select Expiry date" autocomplete="off" disabled/>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Remarks</div>
                        <div class="form-field-inline-remarks">
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    @if(strcasecmp($offer->is_popular,"y") == 0)
                                    <input type="checkbox" id="offer-is-popular" name="offer-is-popular" value="y" checked>Popular Offer
                                    @else
                                    <input type="checkbox" id="offer-is-popular" name="offer-is-popular" value="y">Popular Offer
                                    @endif
                                </label>
                            </div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    @if(strcasecmp($offer->display_at_home,"y") == 0)
                                    <input type="checkbox" id="offer-display-at-home" name="offer-display-at-home" value="y" checked>Display At Home
                                    @else
                                    <input type="checkbox" id="offer-display-at-home" name="offer-display-at-home" value="y">Display At Home
                                    @endif
                                </label>
                            </div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    @if(strcasecmp($offer->is_verified,"y") == 0)
                                    <input type="checkbox" id="offer-is-verified" name="offer-is-verified" value="y" checked>Is Verified
                                    @else
                                    <input type="checkbox" id="offer-is-verified" name="offer-is-verified" value="y">Is Verified 
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Status</div>
                        <div class="form-field-inline-remarks">
                            @if(strcasecmp($offer->is_active,"y") == 0)
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="offerstatus" name="offerstatus" value="y" checked>Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="offerstatus" name="offerstatus" value="n">Deactive
                                </label>
                            </div>
                            @else
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="offerstatus" name="offerstatus" value="y">Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="offerstatus" name="offerstatus" value="n" checked>Deactive
                                </label>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            
            @if(count($events) > 0)
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Events</div>
                        <div class="form-field-inline-remarks">
                            @foreach($events as $event)
                                @php
                                    $flag = 0
                                @endphp
                                @foreach($offer->eventoffers as $eventoffer)
                                    @if($eventoffer->event_id == $event->id)
                                        @php
                                            $flag = 1
                                        @endphp
                                        <div class="form-field-checkbox">
                                            <label class="form-field-checkbox-remarks-label">
                                                <input type="checkbox" class="js-event" id="offer-is-popular" name="offer-is-popular" value="{{$event->id}}" checked>{{$event->title}}
                                            </label>
                                        </div>
                                        @break
                                    @endif
                                @endforeach
                                @if($flag == 0)
                                    <div class="form-field-checkbox">
                                        <label class="form-field-checkbox-remarks-label">
                                            <input type="checkbox" class="js-event" id="offer-is-popular" name="offer-is-popular" value="{{$event->id}}">{{$event->title}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            
            
            <div class="form-buttons-container">
                <div>
                    <a href="/viewoffer/{{$offer->id}}" id="backtooffer" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Offer</a>
                    <input type="submit" value="Update Offer" class="btn btn-primary form-button"/>
                </div>
                <div>
                    <a href="#" id="resetupdateofferform" class="btn btn-info form-button"><i class="fa fa-undo"></i>Reset Form</a>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('js/multiselectdropdown.js')}}"></script>
<script>
    $(document).ready(function(){
        var dateToday = new Date();
        var _maxdate = null;
        if("{{$offer->expiry_date}}" != ""){
            _maxdate = "{{\Carbon\Carbon::parse($offer->expiry_date)->format('d-m-Y')}}"
        }
        $("#offer_startingdate").datepicker({
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            changeMonth: true,
            showButtonPanel: true,
            numberOfMonths: 2,
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
            minDate: "{{\Carbon\Carbon::parse($offer->starting_date)->format('d-m-Y')}}",
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
        $("#resetupdateofferform").click(function(){
            event.preventDefault();
            var offerid = $("#offerid").val();
            $("#panel-body-container").load("/updateoffer/"+offerid);
        });
        $("#offer_store").change(function(){
            if( $('#offer_category').has('option').val() != "" ) {
                $('#offer_category')
                .append($("<option></option>")
                .attr("value","")
                .text("Select Category"));
            }
            $("#offer_category option[value!='']").remove();
            var selectedstoreid = $("#offer_store :selected").val();
            if(selectedstoreid != ""){
                $.ajax({
                    method: "GET",
                    url: "/getstorecategories/"+selectedstoreid,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        $.each(data.allstorecategories, function (index, value) {
                            $('#offer_category')
                            .append($("<option></option>")
                            .attr("value",value.category_id)
                            .text(value.category.title));
                        });
                    },
                    error: function(){
                        alert("Ajax Error! something went wrong...");
                    }
                });
            }
        });
        $("#backtooffer").click(function(event){
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
                $("#offer_expirydate").prop('disabled', true);
                $("#offer_expirydate").removeClass("readonly-bg-color");
                $("#offer_expirydate").datepicker('setDate', null);
                $("#offer_startingdate").datepicker("option" , {maxDate: null});
            }
            else{
                $("#offer_expirydate").addClass("readonly-bg-color");
                $("#offer_expirydate").prop('disabled', false);
            }
        });
        //validation rules
        $("#updateofferform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                offer_store: "required",
                offer_category: "required",
                offertitle: "required",
                offeranchor: "required",
                offerlocation: "required",
                offertype: "required",
                offercode: "required",
                offerdetails: "required",
                offer_startingdate: "required",
                offer_expirydate: "required",
                offerstatus: "required"
            },
            messages: {
                offer_store: "please select store",
                offer_category: "please select category",
                offertitle: "please enter offer title",
                offeranchor: "please enter offer anchor",
                offerlocation: "please select offer location",
                offertype: "please select offer type",
                offercode: "please enter offer code",
                offerdetails: "please enter offer details",
                offer_startingdate: "please select starting date",
                offer_expirydate: "please select expiry date",
                offerstatus: "please select offer status"
            },
            submitHandler: function(form) {
                var _events_id = [];
                var _offercode = null;
                var _offer_expirydate = null;
                var _offer_is_popular = "n";
                var _offer_display_at_home = "n";
                var _offer_is_verified = "n";
                var _free_shipping = "n";
                var _offerid = $("#offerid").val();
                var _offer_store = $("#offer_store").val();
                var _offer_category = $("#offer_category").val();
                var _offertitle = $("#offertitle").val();
                var _offeranchor = $("#offeranchor").val();
                var _offerlocation = $("#offerlocation").val();
                var _offertype = $("#offertype").val();
                var _offerdetails = $("#offerdetails").val();
                var _offer_startingdate = $("#offer_startingdate").val();
                var _offerstatus = $("input[name='offerstatus']:checked").val();
                if(!$("#offercode-checkbox").prop("checked")){
                    _offercode = $("#offercode").val();
                }
                if(!$("#expiry-date-checkbox").prop("checked")){
                    _offer_expirydate = $("#offer_expirydate").val();
                }
                if($("#offer-is-popular").prop("checked")){
                    _offer_is_popular = $("#offer-is-popular").val();
                }
                if($("#offer-display-at-home").prop("checked")){
                    _offer_display_at_home = $("#offer-display-at-home").val();
                }
                if($("#offer-is-verified").prop("checked")){
                    _offer_is_verified = $("#offer-is-verified").val();
                }
                if($("#free-shipping").prop("checked")){
                    _free_shipping = $("#free-shipping").val();
                }
                $(`.js-event:checked`).each(function () {
                    _events_id.push($(this).val());
                });
                var _jsondata = JSON.stringify({offerid: _offerid, offer_store: _offer_store, offer_category: _offer_category, offertitle: _offertitle, free_shipping: _free_shipping, offeranchor: _offeranchor, offerlocation: _offerlocation, offertype: _offertype, offercode: _offercode, offerdetails: _offerdetails, offer_startingdate: _offer_startingdate, offer_expirydate: _offer_expirydate, offer_is_popular: _offer_is_popular, offer_display_at_home: _offer_display_at_home, offer_is_verified: _offer_is_verified, offerstatus: _offerstatus, events_id: _events_id, _token: '{{ csrf_token() }}' });
                $(".alert").css('display','none');
                $.ajax({
                    method: "POST",
                    url: "/updateoffer",
                    dataType: "json",
                    data: _jsondata,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#panel-body-container").load("/viewoffer/"+data.offer_id);
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