<div class="form-main-container">
    <div class="form-main-heading">Update Offer</div>
    <hr>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="updateofferform">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <input type="text" id="offerid" name="offerid" value="{{$offer->id}}" hidden>
                        <div class="form-field-heading">Select Store</div>
                        <select id="offer_store" name="offer_store" class="form-control">
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
                        <select id="offer_category" name="offer_category" class="form-control">
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
                        <input type="text" class="form-control" id="offertitle" value="{{$offer->title}}" name="offertitle" placeholder="20% off on your online order"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Anchor</div>
                        <input type="text" class="form-control" id="offeranchor" value="{{$offer->anchor}}" name="offeranchor" placeholder="20% off"/>
                    </div>
                </div>
            </div>
            @if($offer->code != null)
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <div class="form-field-checkbox">
                        <input type="checkbox" id="offercode-checkbox"><span class="form-field-heading">Code Not Required</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type By Store</div>
                        <select class="form-control" id="offertype_bystore" name="offertype_bystore">
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
                        <input type="text" class="form-control" id="offercode" name="offercode" value="{{$offer->code}}" placeholder="code">
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <div class="form-field-checkbox">
                        <input type="checkbox" id="offercode-checkbox" checked><span class="form-field-heading">Code Not Required</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type By Store</div>
                        <select class="form-control" id="offertype_bystore" name="offertype_bystore">
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
                        <input type="text" class="form-control" id="offercode" name="offercode" placeholder="code" disabled>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Details</div>
                        <textarea class="form-control" id="offerdetails" name="offerdetails" placeholder="description">{{$offer->details}}</textarea>
                    </div>
                </div>
            </div>
            @if($offer->expiry_date != null)
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <div class="form-field-checkbox">
                        <input type="checkbox" name="expiry-date-checkbox" id="expiry-date-checkbox"><span class="form-field-heading">Expiry Date Not Required</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Starting Date</div>
                        <input type="date" id="offer_startingdate" name="offer_startingdate" class="form-control" value="{{$offer->starting_date}}"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Expiry Date</div>
                        <input type="date" id="offer_expirydate" name="offer_expirydate" class="form-control" value="{{$offer->expiry_date}}"/>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <div class="form-field-checkbox">
                        <input type="checkbox" name="expiry-date-checkbox" id="expiry-date-checkbox" checked><span class="form-field-heading">Expiry Date Not Required</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Starting Date</div>
                        <input type="date" id="offer_startingdate" name="offer_startingdate" class="form-control" value="{{$offer->starting_date}}"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Expiry Date</div>
                        <input type="date" id="offer_expirydate" name="offer_expirydate" class="form-control" disabled/>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type</div>
                        <select class="form-control" id="offertype" name="offertype">
                            @if($offer->type == "regular")
                            <option value="regular" selected>Regular</option>
                            <option value="popular">Popular</option>
                            @else
                            <option value="regular">Regular</option>
                            <option value="popular" selected>Popular</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Status</div>
                        <select class="form-control" id="offerstatus" name="offerstatus">
                            @if($offer->status == "active")
                            <option value="active" selected>Active</option>
                            <option value="deactive">Deactive</option>
                            @else
                            <option value="active">Active</option>
                            <option value="deactive" selected>Deactive</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <a href="/alloffers" id="backtooffers" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Offers</a>
            <input type="submit" value="Update Offer" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('js/multiselectdropdown.js')}}"></script>
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $(".alert").slideUp();
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
                var _offercode = "";
                var _offer_expirydate = "";
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
                var _offerstatus = $("#offerstatus").val();
                if($("#offercode-checkbox").prop("checked")){
                    _offercode = null;
                }
                else{
                    _offercode = $("#offercode").val();
                }
                if($("#expiry-date-checkbox").prop("checked")){
                    _offer_expirydate = null;
                }
                else{
                    _offer_expirydate = $("#offer_expirydate").val();
                }
                var _jsondata = JSON.stringify({offerid: _offerid, offer_store: _offer_store, offer_category: _offer_category, offertitle: _offertitle, offeranchor: _offeranchor, offertype_bystore: _offertype_bystore, offercode: _offercode, offerdetails: _offerdetails, offer_startingdate: _offer_startingdate, offer_expirydate: _offer_expirydate, offertype: _offertype, offerstatus: _offerstatus, _token: '{{ csrf_token() }}' });
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