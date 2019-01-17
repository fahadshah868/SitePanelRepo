<div class="form-main-container">
        <div class="form-main-heading">Update Network</div>
        <hr>
        <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
            <a href="#" class="close" aria-label="close">&times;</a>
            <strong id="alert-danger-message-area"></strong>
        </div>
        <form id="updatenetworkform" action="#" method="POST">
            @csrf
            <div class="form-container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-field">
                            <input type="text" id="networkid" value="{{$network->id}}" hidden >
                            <div class="form-field-heading">Network Title</div>
                            <input type="text" class="form-control form-field-text" id="networktitle" name="networktitle" value="{{$network->title}}" placeholder="cj, shareasale, clickbank"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">Network Status</div>
                            <select class="form-control form-field-text" id="networkstatus" name="networkstatus">
                                @if($network->status == "active")
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
                <a href="/allnetworks" id="backtonetworks" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Networks</a>
                <input type="submit" value="Update Network" class="btn btn-primary form-button"/>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $(".close").click(function(){
                $(".alert").slideUp();
            });
            $("#backtonetworks").click(function(event){
                event.preventDefault();
                $("#panel-body-container").load($(this).attr("href"));
            });
            $("#updatenetworkform").submit(function(event){
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
                    var _networkid = $("#networkid").val();
                    var _networktitle = $("#networktitle").val();
                    var _networkstatus = $("#networkstatus").val();
                    var _jsondata = JSON.stringify({ networkid: _networkid, networktitle: _networktitle, networkstatus: _networkstatus, _token: '{{ csrf_token() }}'});
                    $(".alert").css("display","none");
                    $.ajax({
                        method: 'POST',
                        url: '/updatenetwork',
                        dataType: "json",
                        data: _jsondata,
                        dataType: "json",
                        contentType: "application/json",
                        cache: false,
                        success: function(data){
                            if(data.status == "true"){
                                $("#panel-body-container").load("/allnetworks");
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