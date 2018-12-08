<div class="form-main-container">
    <div class="form-main-heading">Update Store</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div class="row" id="updatestore">
        <div class="col-xl-3" style="margin: 20px 0;">
            <img src="{{asset('images/store/amazon.png')}}" style="width: 200px; height: 200px; border: 1px solid #d1d1d1;">
            <a href="" class="btn btn-primary update-image-button">Update Image<i class="fa fa-forward"></i></a>
        </div>
        <div class="col-xl-9">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Title</div>
                        <input type="text" class="form-control" value="{{ $store->title }}" readonly/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Site Url</div>
                        <input type="text" class="form-control" value="{{ $store->site_url }}" readonly/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Type</div>
                        <input type="text" class="form-control" value="{{ $store->type }}" readonly/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store Status</div>
                        <input type="text" class="form-control" value="{{ $store->status }}" readonly/>
                    </div>
                </div>
                <div class="col-sm-12">
                    <a href="/allstores" id="backtostores" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Stores</a>
                    <a href="/updatestoreform/{{$store->id}}" class="btn btn-primary form-button">Update Form<i class="fa fa-forward"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        if('{{Session::has("updatestore_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updatestore_successmessage")}}');
            $("#alert-success").fadeTo(3000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#updatestore a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
    });
</script>