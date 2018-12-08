<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading">All Users<span class="viewitems-main-heading-count">({{ $userscount }})</span></div>
        <div class="viewitems-header-searchbar"><input type="text" placeholder="Search User" id="searchbar" class="form-control"/></div>
    </div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <div class="viewitems-tableview">
        <table class="table table-bordered" id="tableview">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Type</th>
                    <th>User Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @if(count($allusers) > 0)
                    @foreach($allusers as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->status }}</td>
                        <td>
                            @if($user->id != Auth::User()->id)
                            <a href="/updateuser/{{$user->id}}" id="updateuser" class="btn btn-primary"><i class="fa fa-edit"></i>Update</a>
                            <a href="/deleteuser/{{$user->id}}" data-username='{{$user->username}}' data-usertype='{{$user->role}}' id="deleteuser" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<script src="{{asset('js/bootbox.min.js')}}"></script>
<script src="{{asset('js/clientsidesearchbarfilter.js')}}"></script>
<script>
    $(document).ready(function(){
        if('{{ Session::has("updateuser_successmessage") }}'){
            $("#alert-success-message-area").html('{{ Session::get("updateuser_successmessage") }}');
            $("#alert-success").fadeTo(3000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        $("#tablebody tr td a").click(function(event){
            event.preventDefault();

            if($(this).attr("id") == "updateuser"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deleteuser"){
                var url = $(this).attr("href");
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>User:</b>  "+$(this).data("username")+"<br>"+
                    "<b>User Type:</b>  "+$(this).data("usertype"),
                    buttons: {
                        confirm: {
                            label: 'Delete',
                            className: 'btn-danger'
                        },
                        cancel: {
                            label: 'Cancel',
                            className: 'btn-primary'
                        }
                    },
                    callback: function (result) {
                        if(result){
                            $.ajax({
                                method: 'GET',
                                url: url,
                                dataType: "json",
                                contentType: "application/json",
                                success: function(data){
                                    if(data.status == "true"){
                                        $("#panel-body-container").load("/allusers");
                                    }
                                    else{
                                        $("#alert-danger-message-area").html(data.error_message);
                                        $("#alert-danger").css('display','block');
                                    }
                                },
                                error: function(){
                                    alert("Ajax Error! something went wrong...");
                                }
                            });
                        }
                    }
                });
            }
        });
    });
</script>