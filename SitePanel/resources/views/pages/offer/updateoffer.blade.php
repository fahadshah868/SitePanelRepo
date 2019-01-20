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
                        <div class="form-field-heading">Offer Title</div>
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
            @if($offer->code != null)
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
                            @foreach($alloffertypes as $offertype)
                                @if($offer->offer_type_id == $offertype->id)
                                <option value="{{$offertype->id}}" selected>{{$offertype->title}}</option>
                                @else
                                <option value="{{$offertype->id}}">{{$offertype->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Code</div>
                        <input type="text" class="form-control form-field-text" id="offercode" name="offercode" value="{{$offer->code}}" placeholder="code">
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
                        <select class="form-control form-field-text" id="offertype_bystore" name="offertype_bystore">
                            @foreach($alloffertypes as $offertype)
                                @if($offer->offer_type_id == $offertype->id)
                                <option value="{{$offertype->id}}" selected>{{$offertype->title}}</option>
                                @else
                                <option value="{{$offertype->id}}">{{$offertype->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Code</div>
                        <input type="text" class="form-control form-field-text" id="offercode" name="offercode" placeholder="code" disabled>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Details</div>
                        <textarea class="form-control form-field-textarea" id="offerdetails" name="offerdetails" placeholder="description">{{$offer->details}}</textarea>
                    </div>
                </div>
            </div>
            @if($offer->expiry_date != null)
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
                        <input type="date" id="offer_startingdate" name="offer_startingdate" class="form-control form-field-text" value="{{$offer->starting_date}}"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Expiry Date</div>
                        <input type="date" id="offer_expirydate" name="offer_expirydate" class="form-control form-field-text" value="{{$offer->expiry_date}}"/>
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
                        <input type="date" id="offer_startingdate" name="offer_startingdate" class="form-control form-field-text" value="{{$offer->starting_date}}"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Expiry Date</div>
                        <input type="date" id="offer_expirydate" name="offer_expirydate" class="form-control form-field-text" disabled/>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Remarks</div>
                        <div class="form-field-inline-remarks">
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    @if($offer->is_popular == "yes")
                                    <input type="checkbox" id="offer-is-popular" name="offer-is-popular" value="yes" checked>Popular Offer
                                    @else
                                    <input type="checkbox" id="offer-is-popular" name="offer-is-popular" value="yes">Popular Offer
                                    @endif
                                </label>
                            </div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    @if($offer->display_at_home == "yes")
                                    <input type="checkbox" id="offer-display-at-home" name="offer-display-at-home" value="yes" checked>Display At Home
                                    @else
                                    <input type="checkbox" id="offer-display-at-home" name="offer-display-at-home" value="yes">Display At Home
                                    @endif
                                </label>
                            </div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    @if($offer->is_verified == "yes")
                                    <input type="checkbox" id="offer-is-verified" name="offer-is-verified" value="yes" checked>Is Verified
                                    @else
                                    <input type="checkbox" id="offer-is-verified" name="offer-is-verified" value="yes">Is Verified 
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
                            @if($offer->status == "active")
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
                    <a href="/alloffers" id="backtooffers" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Offers</a>
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
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#resetupdateofferform").click(function(){
            event.preventDefault();
            $("#updateofferform").trigger("reset");
            if($("#offercode-checkbox").prop("checked")){
                $("#offercode").prop('disabled', true);
            }
            else{
                $("#offercode").prop('disabled', false);
            }
            if($("#expiry-date-checkbox").prop("checked")){
                $("#offer_expirydate").prop('disabled', true);
            }
            else{
                $("#offer_expirydate").prop('disabled', false);
            }
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
        $("#backtooffers").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load("/alloffers");
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
        //validation rules
        $("#updateofferform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                offer_store: "required",
                offer_category: "required",
                offertitle: "required",
                offeranchor: "required",
                offertype_bystore: "required",
                offercode: "required",
                offerdetails: "required",
                offer_startingdate: "required",
                offer_expirydate: "required",
                offertype: "required",
                offerstatus: "required"
            },
            messages: {
                offer_store: "please select store",
                offer_category: "please select category",
                offertitle: "please enter offer title",
                offeranchor: "please enter offer anchor",
                offertype_bystore: "please select offer type",
                offercode: "please enter offer code",
                offerdetails: "please enter offer details",
                offer_startingdate: "please select starting date",
                offer_expirydate: "please select expiry date",
                offertype: "please select offer type",
                offerstatus: "please select offer status"
            },
            submitHandler: function(form) {
                var _offercode = null;
                var _offer_expirydate = null;
                var _offer_is_popular = "no";
                var _offer_display_at_home = "no";
                var _offer_is_verified = "no";
                var _offer_store = $("#offer_store").val();
                var _offer_category = $("#offer_category").val();
                var _offerid = $("#offerid").val();
                var _offertitle = $("#offertitle").val();
                var _offeranchor = $("#offeranchor").val();
                var _offertype_bystore = $("#offertype_bystore").val();
                var _offerdetails = $("#offerdetails").val();
                var _offer_startingdate = $("#offer_startingdate").val();
                var _offer_expirydate = $("#offer_expirydate").val();
                var _offertype = $("#offertype").val();
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
                var _jsondata = JSON.stringify({offerid: _offerid, offer_store: _offer_store, offer_category: _offer_category, offertitle: _offertitle, offeranchor: _offeranchor, offertype_bystore: _offertype_bystore, offercode: _offercode, offerdetails: _offerdetails, offer_startingdate: _offer_startingdate, offer_expirydate: _offer_expirydate, offer_is_popular: _offer_is_popular, offer_display_at_home: _offer_display_at_home, offer_is_verified: _offer_is_verified, offerstatus: _offerstatus, _token: '{{ csrf_token() }}' });
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
                            $("#panel-body-container").load("/alloffers");
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