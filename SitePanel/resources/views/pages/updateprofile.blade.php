<div class="form-main-container">
    <div class="form-main-heading">Update Profile</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="updateprofileform" action="/comparepassword" method="POST">
        @csrf
        <div class="update-profile-form">
            <div class="updateprofile-fields-heading">User Name:</div>
            <input type="text" class="form-control" value="{{Auth::User()->username}}" name="username" id="username" placeholder="user name"/>
            <div class="updateprofile-fields-heading">Old Password:</div>
            <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="old password"/>
            <div id="oldpassword-comparison-message" style="font-weight:500;"></div>
            <div class="updateprofile-fields-heading">New Password:</div>
            <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="new password"/>
            <div class="updateprofile-fields-heading">Confirm Password:</div>
            <input type="password" class="form-control" name="confirmpassword" placeholder="confirm password"/>
            <input type="submit" value="Update Profile" id="loginbutton"/>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $("#oldpassword").keyup(function(){
            var _password = $("#oldpassword").val();
            var _jsondata = JSON.stringify({password: _password, _token: '{{ csrf_token() }}'});
            $.ajax({
                method: 'POST',
                url: "/comparepassword",
                dataType: "json",
                data: _jsondata,
                dataType: "json",
                contentType: "application/json",
                cache: false,
                success: function(data){
                    if(data.status == "true"){
                        $("#oldpassword-comparison-message").css("color","green");
                        $("#oldpassword-comparison-message").html(data.success_message);
                    }
                    else{
                        $("#oldpassword-comparison-message").css("color","red");
                        $("#oldpassword-comparison-message").html(data.success_message);
                    }
                },
                error: function(){
                    alert("Ajax Error! something went wrong...");
                }
            });
        });
        $("#updateprofileform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                username: "required",
                oldpassword: "required",
                newpassword: {required: true, maxlength: 8},
                confirmpassword: {required: true, equalTo: "#newpassword"}
            },
            messages: {
                username: "please enter user name",
                oldpassword: "please enter your old password",
                newpassword: {required: "please enter your new password", maxlength: "your password must have 8 characters"},
                confirmpassword: {required: "please enter confirm password", equalTo: "password is not match"}
            },
            submitHandler: function(form) {
                if($("#oldpassword-comparison-message").html() == "match*"){
                    var _username = $("#username").val();
                    var _newpassword = $("#newpassword").val();
                    var _jsondata = JSON.stringify({username: _username, newpassword: _newpassword, _token: '{{csrf_token()}}'});
                    $("#updateprofileform").trigger("reset");
                    $(".alert").css("display","none");
                    $.ajax({
                        method: "POST",
                        url: "/updateprofile",
                        dataType: "json",
                        data: _jsondata,
                        dataType: "json",
                        contentType: "application/json",
                        cache: false,
                        success: function(data){
                            if(data.status == "true"){
                                $("#alert-success-message-area").html(data.success_message);
                                $("#alert-success").fadeTo(3000, 500).slideUp(500, function(){
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
                }
                return false;
            }
        });
    });
</script>