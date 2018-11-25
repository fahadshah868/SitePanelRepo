<div class="form-main-container">
        <div class="form-main-heading">Add User</div>
        <hr>
        @if(Session::has('successmessage'))
        <div class="alert alert-success alert-dismissible fade show">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{Session::get('errormessage')}}</strong>
        </div>
        @endif
        <form id="adduserform" action="/updateuser/{{$userdata->id}}" method="POST">
            @csrf
            <div class="form-container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">User Name</div>
                        <input type="text" class="form-control" value="{{$userdata->username}}" name="username" placeholder="john"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">Password</div>
                            <input type="text" class="form-control" value="{{$userdata->password}}" name="password" placeholder="password"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">User Type</div>
                            <select class="form-control" name="usertype">
                                <option value="">Select Type</option>
                                <option value="Employee">Employee</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">User Status</div>
                            <select class="form-control" name="userstatus">
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
        });
    </script>