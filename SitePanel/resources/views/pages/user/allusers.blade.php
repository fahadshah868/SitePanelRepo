<div class="viewitems-main-container">
    <div class="viewitems-main-heading">All Users<span class="viewitems-main-heading-count">({{ $userscount }}<span id="filtered_row_count"></span>)</span></div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <div class="viewitems-tableview">
        <table class="table table-bordered" id="tableview">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Role</th>
                    <th>User Status</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="username" placeholder="Search User Name" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="username_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="userrole" placeholder="Search User Role" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="userrole_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="userstatus" placeholder="Search User Status" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="userstatus_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th><button class="header-searchbar-clear-filters-button" id="clear_all_filters" title="Clear All Applied Filters"><i class="fas fa-times-circle"></i>Clear All Filters</button></th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @if(count($allusers) > 0)
                    @foreach($allusers as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if($user->status == "active")
                            <span class="active-item">{{ $user->status }}</span>
                            @else
                            <span class="deactive-item">{{ $user->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if($user->id != Auth::User()->id)
                            <a href="/updateuser/{{$user->id}}" id="updateuser" class="btn btn-primary"><i class="fa fa-edit"></i>Update</a>
                            <a href="/deleteuser/{{$user->id}}" data-username='{{$user->username}}' data-userrole='{{$user->role}}' data-userstatus='{{$user->status}}' id="deleteuser" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
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
<script src="{{asset('js/hightlighttablecolumn.js')}}"></script>
<script>
    $(document).ready(function(){
        function clientSideFilter(){
            var $rows = $('#tablebody tr');
            var username_val = $.trim($("#username").val()).replace(/ +/g, ' ').toLowerCase();
            var userrole_val = $.trim($("#userrole").val()).replace(/ +/g, ' ').toLowerCase();
            var userstatus_val = $.trim($("#userstatus").val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var username_col = $(this).find('td:nth-child(1)').text().replace(/\s+/g, ' ').toLowerCase();
                var userrole_col = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
                var userstatus_col = $(this).find('td:nth-child(3)').text().replace(/\s+/g, ' ').toLowerCase();
                return !~username_col.indexOf(username_val) || !~userrole_col.indexOf(userrole_val) || !~userstatus_col.indexOf(userstatus_val);
            }).hide();
            if($("#username").val() != "" || $("#userrole").val() != "" || $("#userstatus").val() != ""){
                $("#filtered_row_count").html("/"+$("#tablebody tr:visible").length);
            }
            else{
                $("#filtered_row_count").html("");
            }
            
        }
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        if('{{ Session::has("updateuser_successmessage") }}'){
            $("#alert-success-message-area").html('{{ Session::get("updateuser_successmessage") }}');
            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        //client side filter
        $(".header-searchbar-filter").bind('keyup input propertychange',function(){
            clientSideFilter();
        });
        $("#clear_all_filters").click(function(){
            $("#username").val("");
            $("#userrole").val("");
            $("#userstatus").val("");
            clientSideFilter();
        });
        $(".header-searchbar-filter-button").click(function(){
            if($(this).attr("id") == "username_clr_btn"){
                $("#username").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "userrole_clr_btn"){
                $("#userrole").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "userstatus_clr_btn"){
                $("#userstatus").val("");
                clientSideFilter();
            }
        });
        //navigation buttons actions
        $("#tablebody tr td a").click(function(event){
            event.preventDefault();
            if($(this).attr("id") == "updateuser"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deleteuser"){
                var url = $(this).attr("href");
                var status = null;
                if($(this).data("userstatus") == "active"){
                    status = "<span style='color: #117C00; font-weight: 600'>"+$(this).data("userstatus")+"</span><br>";
                }
                else if($(this).data("userstatus") == "deactive"){
                    status = "<span style='color: #FF0000; font-weight: 600'>"+$(this).data("userstatus")+"</span><br>";
                }
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>User:</b>  "+$(this).data("username")+"<br>"+
                    "<b>User Role:</b>  "+$(this).data("userrole")+"<br>"+
                    "<b>User Status:</b>  "+status,
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