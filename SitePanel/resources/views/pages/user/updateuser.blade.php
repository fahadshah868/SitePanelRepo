<div class="form-main-container">
        <div class="form-main-heading">Update User</div>
        <hr>
        <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
            <a href="#" class="close" aria-label="close">&times;</a>
            <strong id="alert-danger-message-area"></strong>
        </div>
        <form id="updateuserform" action="#" method="#">
            @csrf
            <div class="form-container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-field">
                            <input type="text" id="userid" value="{{$user->id}}" hidden >
                            <div class="form-field-heading">User Name</div>
                            <input type="text" class="form-control form-field-text" id="username" value="{{$user->username}}" name="username" placeholder="john"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">Password</div>
                            <input type="text" class="form-control form-field-text" id="userpassword" value="{{$user->password}}" name="userpassword" placeholder="password"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">User Role</div>
                            @if(strcasecmp($user->role,"deo") == 0)
                            <div class="form-field-inline-remarks">
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="deo" checked>Data Entry Operator
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="cwriter">Content Writer
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="seo">SEO
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="admin">Admin
                                    </label>
                                </div>
                            </div>
                            @elseif(strcasecmp($user->role,"seo") == 0)
                            <div class="form-field-inline-remarks">
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="deo">Data Entry Operator
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="cwriter">Content Writer
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="seo" checked>SEO
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="admin">Admin
                                    </label>
                                </div>
                            </div>
                            @elseif(strcasecmp($user->role,"cwriter") == 0)
                            <div class="form-field-inline-remarks">
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="deo">Data Entry Operator
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="cwriter" checked>Content Writer
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="seo">SEO
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="admin">Admin
                                    </label>
                                </div>
                            </div>
                            @elseif(strcasecmp($user->role,"admin") == 0)
                            <div class="form-field-inline-remarks">
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="deo">Data Entry Operator
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="cwriter">Content Writer
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="seo">SEO
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userrole" name="userrole" value="admin" checked>Admin
                                    </label>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">User Status</div>
                            @if(strcasecmp($user->is_active,"y") == 0)
                            <div class="form-field-inline-remarks">
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userstatus" name="userstatus" value="y" checked>Active
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userstatus" name="userstatus" value="n">Deactive
                                    </label>
                                </div>
                            </div>
                            @else
                            <div class="form-field-inline-remarks">
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userstatus" name="userstatus" value="y">Active
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="userstatus" name="userstatus" value="n" checked>Deactive
                                    </label>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-buttons-container">
                    <div>
                        <a href="/viewuser/{{$user->id}}" id="backtouser" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To User</a>
                        <input type="submit" value="Update User" class="btn btn-primary form-button"/>
                    </div>
                    <div>
                        <a href="#" id="resetupdateuserform" class="btn btn-info form-button"><i class="fa fa-undo"></i>Reset Form</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $(".close").click(function(){
                $(".alert").slideUp();
            });
            $("#backtouser").click(function(event){
                event.preventDefault();
                $("#panel-body-container").load($(this).attr("href"));
            });
            $("#resetupdateuserform").click(function(){
                event.preventDefault();
                $("#updateuserform").trigger("reset");
            });
            $("#updateuserform").submit(function(event){
                event.preventDefault();
            }).validate({
                rules: {
                    username: "required",
                    userpassword: "required",
                    userrole: "required",
                    userstatus: "required"
                },
                messages: {
                    username: "please enter user name",
                    userpassword: "please enter user password",
                    userrole: "Please select user type",
                    userstatus: "Please select user status"
                },
                submitHandler: function(form) {
                    var _userid = $("#userid").val();
                    var _username = $("#username").val();
                    var _userpassword = $("#userpassword").val();
                    var _userrole = $("input[name='userrole']:checked").val();
                    var _userstatus = $("input[name='userstatus']:checked").val();
                    var _jsondata = JSON.stringify({userid: _userid, username: _username, userpassword: _userpassword, userrole: _userrole, userstatus: _userstatus, _token: '{{ csrf_token() }}'});
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
                                $("#panel-body-container").load("/viewuser/"+data.user_id);
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