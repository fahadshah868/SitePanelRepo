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
                            <input type="text" id="userid" value="{{$user->id}}" hidden >
                            <div class="form-field-heading">User Name</div>
                            <input type="text" class="form-control" id="username" value="{{$user->username}}" name="username" placeholder="john"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">Password</div>
                            <input type="text" class="form-control" id="password" value="{{$user->password}}" name="password" placeholder="password"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">User Type</div>
                            <select class="form-control" id="userrole" name="userrole">
                                @if($user->role == "employee")
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
                                @if($user->status == "active")
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
                <a href="/allusers" id="backtousers" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Users</a>
                <input type="submit" value="Update User" class="btn btn-primary form-button"/>
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
                var _userid = $("#userid").val();
                var _username = $("#username").val();
                var _password = $("#password").val();
                var _userrole = $("#userrole").val();
                var _userstatus = $("#userstatus").val();
                var _jsondata = JSON.stringify({userid: _userid, username: _username, password: _password, userrole: _userrole, userstatus: _userstatus, _token: '{{ csrf_token() }}'});
                $.ajax({
                    method: 'POST',
                    url: '/updateuser',
                    dataType: "json",
                    data: _jsondata,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
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