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
    <form id="addofferform">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Title</div>
                        <input type="text" class="form-control" id="offertitle" name="offertitle" placeholder="offer"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type By Store</div>
                        <select class="form-control" id="offertype_bystore" name="offertype_bystore">
                            <option value="">Select Offer Type</option>
                            @foreach($alloffertypes as $offertype)
                            <option value="{{$offertype->id}}">{{$offertype->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field-checkbox hide-offercode-field"  id="offercode-field">
                        <input type="checkbox" id="offercode-checkbox"><span class="form-field-heading">Code Not Required</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Code</div>
                        <input type="text" class="form-control" id="offercode" name="offercode" placeholder="code">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Details</div>
                        <textarea class="form-control" id="offerdetails" name="offerdetails" placeholder="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Select Store</div>
                        <select class="multiselectdropdown" id="offer_stores" name="offer_stores" multiple data-live-search="true">
                            @foreach($allstores as $store)
                            <option value="{{$store->id}}">{{$store->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Select Category</div>
                        <select class="multiselectdropdown" id="offer_categories" name="offer_categories" multiple data-live-search="true">
                            @foreach($allcategories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
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
                        <input type="date" id="offer_startingdate" name="offer_startingdate" class="form-control"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Expiry Date</div>
                        <input type="date" id="offer_expirydate" name="offer_expirydate" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type</div>
                        <select class="form-control" id="offertype" name="offertype">
                            <option value="">Select Type</option>
                            <option value="regular">Regular</option>
                            <option value="popular">Popular</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Status</div>
                        <select class="form-control" id="offerstatus" name="offerstatus">
                            <option value="">Select Type</option>
                            <option value="active">Active</option>
                            <option value="deactive">Deactive</option>
                        </select>
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
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#offertype_bystore").change(function(){
            $("#offercode").prop('disabled', false);
            $("#offercode-checkbox").prop("checked", false);
            var offertype_text = $("#offertype_bystore :selected").text();
            var offertype_value = $("#offertype_bystore :selected").val();
            if(offertype_value != ""){
                if(offertype_text.toUpperCase() == "CODE"){
                    $("#offercode-field").addClass("hide-offercode-field");
                }
                else{
                    $("#offercode-field").removeClass("hide-offercode-field");
                }
            }
            else{
                $("#offercode-field").addClass("hide-offercode-field");
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
                $("#offer_expirydate").prop('disabled', true);
            }
            else{
                $("#offer_expirydate").prop('disabled', false);
            }
        });
        //validation rules
        $("#addofferform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                offertitle: "required",
                offertype_bystore: "required",
                offercode: "required",
                offerdetails: "required",
                offer_stores: "required",
                offer_categories: "required",
                offer_startingdate: "required",
                offer_expirydate: "required",
                offertype: "required",
                offerstatus: "required"
            },
            messages: {
                offertitle: "please enter offer title",
                offertype_bystore: "please select offer type",
                offercode: "please enter offer code",
                offerdetails: "please enter offer details",
                offer_stores: "please select store",
                offer_categories: "please select category",
                offer_startingdate: "please select starting date",
                offer_expirydate: "please select expiry date",
                offertype: "please select offer type",
                offerstatus: "please select offer status"
            },
            submitHandler: function(form) {
                var _offercode = "";
                var _offer_expirydate = "";
                var _offertitle = $("#offertitle").val();
                var _offertype_bystore = $("#offertype_bystore").val();
                var _offerdetails = $("#offerdetails").val();
                var _offer_stores = $("#offer_stores").val();
                var _offer_categories = $("#offer_categories").val();
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
                var _jsondata = JSON.stringify({offertitle: _offertitle, offertype_bystore: _offertype_bystore, offercode: _offercode, offerdetails: _offerdetails, offer_stores: _offer_stores, offer_categories: _offer_categories, offer_startingdate: _offer_startingdate, offer_expirydate: _offer_expirydate, offertype: _offertype, offerstatus: _offerstatus, _token: '{{ csrf_token() }}' });
                $("#addofferform").trigger("reset");
                $(".alert").css('display','none');
                $.ajax({
                    method: "POST",
                    url: "/addoffer",
                    dataType: "json",
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