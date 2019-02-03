<div class="form-main-container">
    <div class="form-main-heading">Add Offer</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="addofferform" action="#" method="#">
        <div class="form-container">
        <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Select Store</div>
                        <select class="form-control form-field-text" id="offer_store" name="offer_store">
                            <option value="">Select Store</option>
                            @foreach($allstores as $store)
                            <option value="{{$store->id}}">{{$store->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Select Category</div>
                        <select class="form-control form-field-text" id="offer_category" name="offer_category">
                            <option value="">Select Category</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div style="display:flex; flex-direction:row; justify-content:space-between;">
                            <div class="form-field-heading">Offer Title</div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-label">
                                    <input type="checkbox" id="free-shipping" value="yes">Free Shipping
                                </label>
                            </div>
                        </div>                        
                        <input type="text" class="form-control form-field-text" id="offertitle" name="offertitle" placeholder="20% Off on your online order"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Anchor</div>
                        <input type="text" class="form-control form-field-text" id="offeranchor" name="offeranchor" placeholder="20% Off">
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
                        <div class="row">
                            <div class="col-sm-6">
                                <select class="form-control form-field-text" id="offerlocation" name="offerlocation">
                                    <option value="">Select Offer Location</option>
                                    <option value="Online">Online</option>
                                    <option value="In-Store">In-Store</option>
                                    <option value="Online & In-Store">Online & In-Store</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-control form-field-text" id="offertype" name="offertype">
                                    <option value="">Select Offer Type</option>
                                    <option value="Code">Code</option>
                                    <option value="Sale">Sale</option>
                                </select>
                            </div>
                        </div>
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
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Details</div>
                        <textarea class="form-control form-field-textarea" id="offerdetails" name="offerdetails" placeholder="details about offer"></textarea>
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
                        <input type="text" id="offer_startingdate" name="offer_startingdate" class="form-control form-field-text readonly-bg-color" readonly placeholder="select starting date" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Expiry Date</div>
                        <input type="text" id="offer_expirydate" name="offer_expirydate" class="form-control form-field-text readonly-bg-color" readonly placeholder="select Expiry date" autocomplete="off"/>
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
                                    <input type="checkbox" id="offer-is-popular" name="offer-is-popular" value="yes">Popular Offer
                                </label>
                            </div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    <input type="checkbox" id="offer-display-at-home" name="offer-display-at-home" value="yes">Display At Home
                                </label>
                            </div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    <input type="checkbox" id="offer-is-verified" name="offer-is-verified" value="yes">Is Verified
                                </label>
                            </div>
                        </div>
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
            <input type="submit" value="Add Offer" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('js/multiselectdropdown.js')}}"></script>
<script>
    $(document).ready(function(){
        var dateToday = new Date();
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
        //validation rules
        $("#addofferform").submit(function(event){
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
                var _offercode = null;
                var _offer_expirydate = null;
                var _offer_is_popular = "no";
                var _offer_display_at_home = "no";
                var _offer_is_verified = "no";
                var _free_shipping = "no";
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
                var _jsondata = JSON.stringify({offer_store: _offer_store, offer_category: _offer_category, offertitle: _offertitle, free_shipping: _free_shipping, offeranchor: _offeranchor, offerlocation: _offerlocation, offertype: _offertype, offercode: _offercode, offerdetails: _offerdetails, offer_startingdate: _offer_startingdate, offer_expirydate: _offer_expirydate, offer_is_popular: _offer_is_popular, offer_display_at_home: _offer_display_at_home, offer_is_verified: _offer_is_verified, offerstatus: _offerstatus, _token: '{{ csrf_token() }}' });
                $("#addofferform").trigger("reset");
                $("#offercode").prop('disabled', false);
                $("#offer_expirydate").addClass("readonly-bg-color");
                $("#offer_expirydate").prop('disabled', false);
                $("#offer_startingdate , #offer_expirydate").datepicker("option" , {minDate: null,maxDate: null});
                $(".alert").css('display','none');
                $.ajax({
                    method: "POST",
                    url: "/addoffer",
                    data: _jsondata,
                    dataType: "json",
                    contentType: "application/json",
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
    });
</script>