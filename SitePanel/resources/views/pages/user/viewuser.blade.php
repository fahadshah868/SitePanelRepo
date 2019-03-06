<div class="viewitems-main-container">
    <div class="viewitems-main-heading">View User</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">User Name</div>
                <input type="text" class="form-control form-field-text" value="{{ $user->username }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">User Role</div>
                <input type="text" class="form-control form-field-text" value="{{ $user->role }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">User Status</div>
                <input type="text" class="form-control form-field-text" value="{{ $user->status }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">User Created At</div>
                <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y  h:i:s A') }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">User Updated At</div>
                <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($user->updated_at)->format('d-m-Y  h:i:s A') }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field" id="form-field">
                <a href="/allusers" id="backtousers" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To users</a>
                <a href="/updateuser/{{$user->id}}" class="btn btn-primary form-button" id="updateuser">Update User<i class="fa fa-forward"></i></a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        if('{{Session::has("updateuser_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updateuser_successmessage")}}');
            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        $("#form-field a").click(function(event){
            event.preventDefault();
            if($(this).attr("id") == "backtousers"){
                $("#panel-body-container").load("/allusers");
            }
            else if($(this).attr("id") == "updateuser"){
                $("#panel-body-container").load($(this).attr("href"));
            }
        });
    });
</script>