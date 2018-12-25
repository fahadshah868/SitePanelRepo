<div class="form-main-container">
    <div class="form-main-heading">Update Offer Type</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="updateOffertypeform" action="/updateoffertype" method="POST">
        @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <input type="text" value="{{ $offertype->id }}" id="offertypeid" hidden>
                        <div class="form-field-heading">Offer Type Title</div>
                        <input type="text" class="form-control" id="offertypetitle" value="{{ $offertype->title }}" name="offertypetitle" placeholder="code, sale, instore etc"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type Status</div>
                        <select class="form-control" id="offertypestatus" name="offertypestatus">
                            @if($offertype->status == "active")
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
            <a href="/alloffertypes" id="backtooffertypes" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Offer Types</a>
            <input type="submit" value="Update Offer Type" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $("#backtooffertypes").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#updateOffertypeform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                offertypetitle: "required",
                offertypestatus: "required"
            },
            messages: {
                offertypetitle: "please enter offer type",
                offertypestatus: "please enter offer type status"
            },
            submitHandler: function(form) {
                var _offertypeid = $("#offertypeid").val();
                var _offertypetitle = $("#offertypetitle").val();
                var _offertypestatus = $("#offertypestatus").val();
                var _jsondata = JSON.stringify({offertypeid: _offertypeid, offertypetitle: _offertypetitle, offertypestatus: _offertypestatus, _token: '{{ csrf_token() }}'});
                $("#updateOffertypeform").trigger("reset");
                $(".alert").css('display','none');
                $.ajax({
                    method: 'POST',
                    url: "/updateoffertype",
                    dataType: "json",
                    data: _jsondata,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#panel-body-container").load("/alloffertypes");
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