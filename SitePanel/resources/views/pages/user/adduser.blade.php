<div class="form-main-container">
    <div class="form-main-heading">Add User</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="adduserform" action="/adduser" method="POST">
        @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">User Name</div>
                        <input type="text" class="form-control" id="username" name="username" placeholder="john"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Password</div>
                        <input type="text" class="form-control" id="password" name="password" placeholder="password"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">User Type</div>
                        <select class="form-control" id="usertype" name="usertype">
                            <option value="">Select Type</option>
                            <option value="Employee">Employee</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">User Status</div>
                        <select class="form-control" id="userstatus" name="userstatus">
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
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
        //validation rules
        $("#adduserform").validate({
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
        $("#adduserform").submit(function(event){
            event.preventDefault();
            var username = $("#username").val();
            var password = $("#password").val();
            var usertype = $("#usertype").val();
            var userstatus = $("#userstatus").val();
            var jsondata = JSON.stringify({username: username, password: password, usertype: usertype, userstatus: userstatus, _token: '{{ csrf_token() }}'});
            $.ajax({
                method: 'POST',
                url: '/adduser',
                dataType: "json",
                data: jsondata,
                contentType: "application/json",
                success: function(data){
                    if(data.status == "true"){
                        $("#alert-success-message-area").html(data.success_message);
                        $("#alert-success").fadeTo(3000, 500).slideUp(500, function(){
                            $("#alert-success").slideUp(500);
                        });
                    }
                    else{
                        $("#alert-danger-message-area").html(data.error_message);
                        $("#alert-danger").fadeTo(3000, 500).slideUp(500, function(){
                            $("#alert-danger").slideUp(500);
                        });
                    }
                },
                error: function(){
                    alert("Ajax Error! something went wrong...");
                }
            });
        });
    });
</script>