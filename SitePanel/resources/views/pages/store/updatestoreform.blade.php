<div class="form-main-container">
    <div class="form-main-heading">Update Store</div>
    <hr>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="updatestoreform" action="/updatestoreform" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <input type="text" id="storeid" name="storeid" value="{{ $store->id }}" hidden>
                        <div class="form-field-heading">Store Title</div>
                        <input type="text" class="form-control" id="storetitle" name="storetitle" value="{{ $store->title}}" placeholder="Kohls"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Details</div>
                        <textarea class="form-control" id="storedetails" name="storedetails" placeholder="details">{{$store->details}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Primary Url</div>
                        <input type="text" class="form-control" id="storeprimaryurl" name="storeprimaryurl" value="{{ $store->primary_url }}" placeholder="http://www.kohls.com">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Secondary Url</div>
                        <input type="text" class="form-control" id="storesecondaryurl" name="storesecondaryurl" value="{{ $store->secondary_url }}" placeholder="kohls.com" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Network</div>
                        <select class="form-control" id="networkid" name="networkid">
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
                        <input type="text" class="form-control" id="storenetworkurl" name="storenetworkurl" value="{{ $store->network_url }}" placeholder="network url">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Type</div>
                        <select class="form-control" id="storetype" name="storetype">
                            @if($store->type == "regular")
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
                        <div class="form-field-heading">Store Status</div>
                        <select class="form-control" id="storestatus" name="storestatus">
                            @if($store->status == "active")
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
            <a href="/updatestore/{{$store->id}}" id="backtostore" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Store</a>
            <input type="submit" value="Update Store" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#backtostore").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#storeprimaryurl").bind('keyup input propertychange',function(){
            var value = $("#storeprimaryurl").val();
            if (value.indexOf("http://www.") >= 0){
                var value = value.replace("http://www.","");
                $("#storesecondaryurl").val(value);
            }
            else{
                $("#storesecondaryurl").val("");
            }
        });
        $("#updatestoreform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                storetitle: "required",
                storedetails: "required",
                storeprimaryurl: { required: true, url: true },
                storesecondaryurl: "required",
                networkid: "required",
                storenetworkurl: "required",
                storetype: "required",
                storestatus: "required",
            },
            messages: {
                storetitle: "please enter store title",
                storedetails: "please enter store details",
                storeprimaryurl: { required: "please enter store site url", url: "site url must be 'http://www.site.com' format"},
                storesecondaryurl: "please enter store secondary url",
                networkid: "please select network",
                storenetworkurl: "please enter netwrok url",
                storetype: "please select store type",
                storestatus: "please select store status",
            },
            submitHandler: function(form) {
                var _storeid = $("#storeid").val();
                var _storetitle = $("#storetitle").val();
                var _storedetails = $("#storedetails").val();
                var _storeprimaryurl = $("#storeprimaryurl").val();
                var _storesecondaryurl = $("#storesecondaryurl").val();
                var _networkid = $("#networkid").val();
                var _storenetworkurl = $("#storenetworkurl").val();
                var _storetype = $("#storetype").val();
                var _storestatus = $("#storestatus").val();
                var _jsondata = JSON.stringify({storeid: _storeid, storetitle: _storetitle, storedetails: _storedetails, storeprimaryurl: _storeprimaryurl, storesecondaryurl: _storesecondaryurl, networkid: _networkid, storenetworkurl: _storenetworkurl, storetype: _storetype, storestatus: _storestatus, _token: "{{ csrf_token() }}"});
                $("#addstoreform").trigger("reset");
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
                            $("#panel-body-container").load('/updatestore/'+data.id);
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