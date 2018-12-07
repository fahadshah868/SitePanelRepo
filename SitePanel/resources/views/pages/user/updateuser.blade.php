<div class="form-main-container">
        <div class="form-main-heading">Update User</div>
        <hr>
        <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong id="alert-danger-message-area"></strong>
        </div>
        <form id="updateuserform" action="/updateuser" method="POST">
            @csrf
            <div class="form-container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">User Name</div>
                            <input type="text" id="id" value="{{$userdata->id}}" hidden >
                            <input type="text" class="form-control" id="username" value="{{$userdata->username}}" name="username" placeholder="john"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">Password</div>
                            <input type="text" class="form-control" id="password" value="{{$userdata->password}}" name="password" placeholder="password"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">User Type</div>
                            <select class="form-control" id="usertype" name="usertype">
                                @if($userdata->type == "employee")
                                <option value="Employee" selected>Employee</option>
                                <option value="Admin">Admin</option>
                                @else
                                <option value="Employee">Employee</option>
                                <option value="Admin" selected>Admin</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">User Status</div>
                            <select class="form-control" id="userstatus" name="userstatus">
                                @if($userdata->status == "active")
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
                <input type="submit" value="Update User" class="btn btn-primary form-button"/>
                <a href="/allusers" id="backtousers" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Users</a>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            //validation rules
            $("#updateuserform").validate({
                rules: {
                    username: "required",
                    password: "required",
                    usertype: "required",
                    userstatus: "required"
                },
                messages: {
                    username: "please enter user name",
                    password: "please enter user password",
                    usertype: "Please select user type",
                    userstatus: "Please select user status"
                }
            });
            $("#backtousers").click(function(event){
                event.preventDefault();
                $("#panel-body-container").load($(this).attr("href"));
            });
            $("#updateuserform").submit(function(event){
                event.preventDefault();
                var url = $(this).attr("action");
                var username = $("#username").val();
                var password = $("#password").val();
                var usertype = $("#usertype").val();
                var userstatus = $("#userstatus").val();
                var id = $("#id").val();
                var jsondata = JSON.stringify({id: id, username: username, password: password, usertype: usertype, userstatus: userstatus, _token: '{{ csrf_token() }}'});
                console.log(jsondata);
                $.ajax({
                    method: 'POST',
                    url: '/updateuser',
                    dataType: "json",
                    data: jsondata,
                    contentType: "application/json",
                    success: function(data){
                        if(data.status == "true"){
                            $("#panel-body-container").load("/allusers");
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
            });
        });
    </script>