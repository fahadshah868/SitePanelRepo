<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading">All Stores</div>
        <div class="viewitems-header-searchbar"><input type="text" placeholder="Search Store" id="searchbar" class="form-control"/></div>
    </div>
    <hr>
    <div class="viewitems-tableview">
        <table class="table table-bordered" id="tableview">
            <thead>
                <tr>
                    <th>Store Title</th>
                    <th>Store Site Link</th>
                    <th>Store Type</th>
                    <th>Store Status</th>
                    <th>Store Logo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @if(count($allstores) > 0)
                    @foreach($allstores as $store)
                        <tr>
                            <td>{{ $store->title }}</td>
                            <td>{{ $store->site_url }}</td>
                            <td>{{ $store->type }}</td>
                            <td>{{ $store->status }}</td>
                            <td><img src="{{ asset($store->logo_url) }}"/></td>
                            <td>
                                <a href="/updatestore/{{$store->id}}" id="updatestore" class="btn btn-primary"><i class="fa fa-edit"></i>Update</a>
                                <a href="/deletestore/{{$store->id}}" data-storetitle='{{$store->title}}' data-storetype='{{$store->type}}' id="deletestore" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
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
            if($(this).attr("id") == "updatestore"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deletestoreaaaa"){
                /********************************************
                TODO***************************************/
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