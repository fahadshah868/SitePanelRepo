<div class="form-main-container">
    <div class="form-main-heading">Add Offer Type</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="addOffertypeform" action="/addoffertype" method="POST">
        @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type Title</div>
                        <input type="text" class="form-control" id="offertypetitle" name="offertypetitle" placeholder="code, sale, instore etc"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type Status</div>
                        <select class="form-control" id="offertypestatus" name="offertypestatus">
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="deactive">Deactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Offer Type" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#addOffertypeform").submit(function(event){
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
                var _offertypetitle = $("#offertypetitle").val();
                var _offertypestatus = $("#offertypestatus").val();
                var _jsondata = JSON.stringify({offertypetitle: _offertypetitle, offertypestatus: _offertypestatus, _token: '{{ csrf_token() }}'});
                $("#addOffertypeform").trigger("reset");
                $(".alert").css('display','none');
                $.ajax({
                    method: 'POST',
                    url: "/addoffertype",
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