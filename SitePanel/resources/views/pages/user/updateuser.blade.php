<div class="form-main-container">
        <div class="form-main-heading">Update User</div>
        <hr>
        <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
            <a href="#" class="close" aria-label="close">&times;</a>
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
                            <div class="form-field-heading">User Role</div>
                            <select class="form-control" id="userrole" name="userrole">
                                @if($user->role == "employee")
                                <option value="employee" selected>Employee</option>
                                <option value="admin">Admin</option>
                                @else
                                <option value="employee">Employee</option>
                                <option value="admin" selected>Admin</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">User Status</div>
                            <select class="form-control" id="userstatus" name="userstatus">
                                @if($user->status == "active")
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
                <a href="/allusers" id="backtousers" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Users</a>
                <input type="submit" value="Update User" class="btn btn-primary form-button"/>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $(".close").click(function(){
                $(".alert").slideUp();
            });
            $("#backtousers").click(function(event){
                event.preventDefault();
                $("#panel-body-container").load($(this).attr("href"));
            });
            $("#updateuserform").submit(function(event){
                event.preventDefault();
            }).validate({
                rules: {
                    username: "required",
                    password: "required",
                    userrole: "required",
                    userstatus: "required"
                },
                messages: {
                    username: "please enter user name",
                    password: "please enter user password",
                    userrole: "Please select user type",
                    userstatus: "Please select user status"
                },
                submitHandler: function(form) {
                    var _userid = $("#userid").val();
                    var _username = $("#username").val();
                    var _password = $("#password").val();
                    var _userrole = $("#userrole").val();
                    var _userstatus = $("#userstatus").val();
                    var _jsondata = JSON.stringify({userid: _userid, username: _username, password: _password, userrole: _userrole, userstatus: _userstatus, _token: '{{ csrf_token() }}'});
                    $(".alert").css("display","none");
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
                    return false;
                }
            });
        });
    </script>