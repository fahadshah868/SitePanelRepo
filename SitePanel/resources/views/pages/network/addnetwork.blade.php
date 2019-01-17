<div class="form-main-container">
    <div class="form-main-heading">Add Network</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="addnetworkform" action="#" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Network Title</div>
                        <input type="text" class="form-control form-field-text" id="networktitle" name="networktitle" placeholder="cj, shareasale, clickbank"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Network Status</div>
                        <select class="form-control form-field-text" id="networkstatus" name="networkstatus">
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="deactive">Deactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Network" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('js/multiselectdropdown.js')}}"></script>
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        //validation rules
        $("#addnetworkform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                networktitle: "required",
                networkstatus: "required"
            },
            messages: {
                networktitle: "please enter netwrok title",
                networkstatus: "please select network status"
            },
            submitHandler: function(form) {
                var _networktitle = $("#networktitle").val();
                var _networkstatus = $("#networkstatus").val();
                var _jsondata = JSON.stringify({networktitle: _networktitle, networkstatus: _networkstatus, _token: '{{ csrf_token() }}'});
                $("#addnetworkform").trigger("reset");
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/addnetwork",
                    dataType: "json",
                    data: _jsondata,
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