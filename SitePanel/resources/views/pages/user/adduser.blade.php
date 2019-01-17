<div class="form-main-container">
    <div class="form-main-heading">Add User</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="adduserform" action="#" method="#">
        @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">User Name</div>
                        <input type="text" class="form-control form-field-text" id="username" name="username" placeholder="john"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Password</div>
                        <input type="text" class="form-control form-field-text" id="password" name="password" placeholder="password"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">User Role</div>
                        <select class="form-control form-field-text" id="userrole" name="userrole">
                            <option value="">Select Role</option>
                            <option value="employee">Employee</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">User Status</div>
                        <select class="form-control form-field-text" id="userstatus" name="userstatus">
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="deactive">Deactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add User" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#adduserform").submit(function(event){
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
                var _username = $("#username").val();
                var _password = $("#password").val();
                var _userrole = $("#userrole").val();
                var _userstatus = $("#userstatus").val();
                var _jsondata = JSON.stringify({username: _username, password: _password, userrole: _userrole, userstatus: _userstatus, _token: '{{ csrf_token() }}'});
                $("#adduserform").trigger("reset");
                $(".alert").css('display','none');
                $.ajax({
                    method: 'POST',
                    url: "/adduser",
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