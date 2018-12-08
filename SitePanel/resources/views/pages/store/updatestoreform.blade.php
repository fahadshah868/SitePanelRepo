<div class="form-main-container">
    <div class="form-main-heading">Update Store</div>
    <hr>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="updatestoreform" action="/updatestoreform" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <input type="text" id="storeid" value="{{$store->id}}" hidden>
                        <div class="form-field-heading">Store Title</div>
                    <input type="text" class="form-control" value="{{ $store->title }}" id="storetitle" name="storetitle" placeholder="Kohls"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Site Url</div>
                        <input type="text" class="form-control" value="{{ $store->site_url }}" id="storesiteurl" name="storesiteurl" placeholder="www.Kohls.com"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Type</div>
                        <select class="form-control" id="storetype" name="storetype">
                            @if($store->type == "regular")
                                <option value="Regular" selected>Regular</option>
                                <option value="Popular">Popular</option>
                            @else
                                <option value="Regular">Regular</option>
                                <option value="Popular" selected>Popular</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Status</div>
                        <select class="form-control" id="storestatus" name="storestatus">
                            @if($store->status == "active")
                                <option value="Active" selected>Active</option>
                                <option value="Deactive">Deactive</option>
                            @else
                                <option value="Active">Active</option>
                                <option value="Deactive" selected>Deactive</option>
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
        $("#updatestoreform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                storetitle: "required",
                storesiteurl: { required: true, url: true },
                storetype: "required",
                storestatus: "required",
            },
            messages: {
                storetitle: "please enter store title",
                storesiteurl: { required: "please enter store site link", url: "site url must be 'http://www.site.com' format"},
                storetype: "please select store type",
                storestatus: "please select store status",
            },
            submitHandler: function(form) {
                var _storeid = $("#storeid").val();
                var _storetitle = $("#storetitle").val();
                var _storesiteurl = $("#storesiteurl").val();
                var _storetype = $("#storetype").val();
                var _storestatus = $("#storestatus").val();
                var _jsondata = JSON.stringify({storeid: _storeid, storetitle: _storetitle, storesiteurl: _storesiteurl, storetype: _storetype, storestatus: _storestatus, _token: '{{csrf_token()}}'});
                $("#addstoreform").trigger("reset");
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/updatestoreform",
                    dataType: "json",
                    data: _jsondata,
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#panel-body-container").load('/updatestore/'+_storeid);
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