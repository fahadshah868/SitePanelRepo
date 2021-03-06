<div class="form-main-container">
    <div class="form-main-heading">Update Store</div>
    <hr>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="updatestoreform" action="#" method="#">
    @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <input type="text" id="storeid" name="storeid" value="{{ $store->id }}" hidden>
                        <div class="form-field-heading">Store Title</div>
                        <input type="text" class="form-control form-field-text" id="storetitle" name="storetitle" value="{{ $store->title}}" placeholder="Kohls"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store's Description</div>
                        <textarea id="storedescription" name="storedescription" placeholder="description">{!! $store->description !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Primary Url</div>
                        <input type="text" class="form-control form-field-text" id="storeprimaryurl" name="storeprimaryurl" value="{{ $store->primary_url }}" placeholder="http://www.kohls.com">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Network</div>
                        <select class="form-control form-field-text" id="networkid" name="networkid">
                            @foreach($allnetworks as $network)
                                @if($store->network_id == $network->id)
                                <option value="{{$network->id}}" selected>{{$network->title}}</option>
                                @else
                                <option value="{{$network->id}}">{{$network->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Network Url</div>
                        <input type="text" class="form-control form-field-text" id="storenetworkurl" name="storenetworkurl" value="{{ $store->network_url }}" placeholder="network url">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store remarks</div>
                        <div class="form-field-inline-remarks">
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    @if(strcasecmp($store->is_topstore,"y") == 0)
                                    <input type="checkbox" id="is_topstore" name="is_topstore" value="y" checked>Top Store
                                    @else
                                    <input type="checkbox" id="is_topstore" name="is_topstore" value="y">Top Store
                                    @endif
                                </label>
                            </div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    @if(strcasecmp($store->is_popularstore,"y") == 0)
                                    <input type="checkbox" id="is_popularstore" name="is_popularstore" value="y" checked>Popular Store
                                    @else
                                    <input type="checkbox" id="is_popularstore" name="is_popularstore" value="y">Popular Store
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Status</div>
                        @if(strcasecmp($store->is_active,"y") == 0)
                        <div class="form-field-inline-remarks">
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="storestatus" name="storestatus" value="y" checked>Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="storestatus" name="storestatus" value="n">Deactive
                                </label>
                            </div>
                        </div>
                        @else
                        <div class="form-field-inline-remarks">
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="storestatus" name="storestatus" value="y">Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="storestatus" name="storestatus" value="n" checked>Deactive
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-buttons-container">
                <div>
                    <a href="/viewstore/{{$store->id}}" id="backtostore" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Store</a>
                    <input type="submit" value="Update Store" class="btn btn-primary form-button"/>
                </div>
                <div>
                    <a href="#" id="resetupdatestoreform" class="btn btn-info form-button"><i class="fa fa-undo"></i>Reset Form</a>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
    $(document).ready(function(){
        $('#storedescription').ckeditor(); // if class is prefered.
        var store_description_val = $("#storedescription").val();
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#backtostore").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        
        $("#is_topstore").change(function(){
            if($("#is_topstore").prop("checked")){
                $("#is_popularstore").prop("checked", true);
            }
        });
        $("#is_popularstore").change(function(){
            if($("#is_popularstore").prop("checked") == false){
                $("#is_topstore").prop("checked", false);
            }
        });
        $("#resetupdatestoreform").click(function(){
            event.preventDefault();
            $("#updatestoreform").trigger("reset");
            $("#storedescription").val(store_description_val);
        });
        //define custom validation method to check image dimensions
        $.validator.addMethod("siteurl", function(value, element, param) {
            return value.match(/^((ftp|http|https):\/\/)?www\.([A-z0-9]+)\.([A-z]{2,})/);
        },'please enter a valid url');
        $("#updatestoreform").submit(function(event){
            event.preventDefault();
        }).validate({
            ignore: ".hide",
            rules: {
                storetitle: "required",
                storedescription: { 
                                        required: function(){
                                            CKEDITOR.instances.storedescription.updateElement();
                                        },
                                        minlength: 1,
                                    },
                storeprimaryurl: { required: true, url: true, siteurl: true },
                networkid: "required",
                storenetworkurl: "required",
                storetype: "required",
                storestatus: "required",
            },
            messages: {
                storetitle: "please enter store title",
                storedescription: {
                                        required: "please fill store description",
                                        minlength:"please fill store description",
                                    },
                storeprimaryurl: { required: "please enter store site url", url: "please enter a valid url", siteurl: "please enter a valid url"},
                networkid: "please select network",
                storenetworkurl: "please enter netwrok url",
                storetype: "please select store type",
                storestatus: "please select store status",
            },
            submitHandler: function(form) {
                var _is_topstore = "n";
                var _is_popularstore = "n";
                var _storeid = $("#storeid").val();
                var _storetitle = $("#storetitle").val();
                var _storedescription = $("#storedescription").val();
                var _storeprimaryurl = $("#storeprimaryurl").val();
                var _networkid = $("#networkid").val();
                var _storenetworkurl = $("#storenetworkurl").val();
                var _storetype = $("#storetype").val();
                var _storestatus = $("input[name='storestatus']:checked").val();
                if($("#is_topstore").prop("checked")){
                    _is_topstore = $("#is_topstore").val();
                }
                if($("#is_popularstore").prop("checked")){
                    _is_popularstore = $("#is_popularstore").val();
                }
                var _jsondata = JSON.stringify({storeid: _storeid, storetitle: _storetitle, storedescription: _storedescription, storeprimaryurl: _storeprimaryurl, networkid: _networkid, storenetworkurl: _storenetworkurl, is_topstore: _is_topstore, is_popularstore: _is_popularstore, storestatus: _storestatus, _token: "{{ csrf_token() }}"});
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/updatestoreform",
                    dataType: "json",
                    data: _jsondata,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#panel-body-container").load('/viewstore/'+data.storeid);
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