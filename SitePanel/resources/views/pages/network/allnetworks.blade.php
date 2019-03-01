<div class="viewitems-main-container">
    <div class="viewitems-main-heading">All Networks<span class="viewitems-main-heading-count">({{ $networkscount }}<span id="filtered_row_count"></span>)</span></div>
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
                    <th>Network Title</th>
                    <th>Network Status</th>
                    @if(Auth::User()->role == "admin")
                    <th>Add/Update By</th>
                    @endif
                    <th>Actions</th>
                </tr>
                <tr>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="networktitle" placeholder="Search Network Title" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="networktitle_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="networkstatus" placeholder="Search Network Status" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="networkstatus_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    @if(Auth::User()->role == "admin")
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="network_add_update_by" placeholder="Search User" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="network_add_update_by_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    @endif
                    <th><button class="header-searchbar-clear-filters-button" id="clear_all_filters" title="Clear All Applied Filters"><i class="fas fa-times-circle"></i>Clear All Filters</button></th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @if(count($allnetworks) > 0)
                    @foreach($allnetworks as $network)
                    <tr>
                        <td>{{ $network->title }}</td>
                        <td>
                            @if($network->status == "active")
                            <span class="active-item">{{ $network->status }}</span>
                            @else
                            <span class="deactive-item">{{ $network->status }}</span>
                            @endif
                        </td>
                        @if(Auth::User()->role == "admin")
                        <td>{{ $network->user->username}}</td>
                        @endif
                        <td>
                            <a href="/updatenetwork/{{$network->id}}" id="updatenetwork" class="btn btn-primary"><i class="fa fa-edit"></i>Update</a>
                            <a href="/deletenetwork/{{$network->id}}" data-networktitle='{{$network->title}}' data-networkstatus='{{$network->status}}' id="deletenetwork" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
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
            var networktitle_val = $.trim($("#networktitle").val()).replace(/ +/g, ' ').toLowerCase();
            var networkstatus_val = $.trim($("#networkstatus").val()).replace(/ +/g, ' ').toLowerCase();
            var network_add_update_by_val = $.trim($("#network_add_update_by").val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var networktitle_col = $(this).find('td:nth-child(1)').text().replace(/\s+/g, ' ').toLowerCase();
                var networkstatus_col = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
                var network_add_update_by_col = $(this).find('td:nth-child(3)').text().replace(/\s+/g, ' ').toLowerCase();
                return !~networktitle_col.indexOf(networktitle_val) || !~networkstatus_col.indexOf(networkstatus_val) || !~network_add_update_by_col.indexOf(network_add_update_by_val);
            }).hide();
            if($("#networktitle").val() != "" || $("#networkstatus").val() != "" || $("#network_add_update_by").val() != ""){
                $("#filtered_row_count").html("/"+$("#tablebody tr:visible").length);
            }
            else{
                $("#filtered_row_count").html("");
            }
            
        }
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        if('{{ Session::has("updatenetwork_successmessage") }}'){
            $("#alert-success-message-area").html('{{ Session::get("updatenetwork_successmessage") }}');
            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        //client side filter
        $(".header-searchbar-filter").bind('keyup input propertychange',function(){
            clientSideFilter();
        });
        $("#clear_all_filters").click(function(){
            $("#networktitle").val("");
            $("#networkstatus").val("");
            $("#network_add_update_by").val("");
            clientSideFilter();
        });
        $(".header-searchbar-filter-button").click(function(){
            if($(this).attr("id") == "networktitle_clr_btn"){
                $("#networktitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "networkstatus_clr_btn"){
                $("#networkstatus").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "network_add_update_by_clr_btn"){
                $("#network_add_update_by").val("");
                clientSideFilter();
            }
        });
        //navigation buttons actions
        $("#tablebody tr td a").click(function(event){
            event.preventDefault();
            if($(this).attr("id") == "updatenetwork"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deletenetwork"){
                var url = $(this).attr("href");
                var status = null;
                if($(this).data("networkstatus") == "active"){
                    status = "<span style='color: #117C00; font-weight: 600'>"+$(this).data("networkstatus")+"</span><br>";
                }
                else if($(this).data("networkstatus") == "deactive"){
                    status = "<span style='color: #FF0000; font-weight: 600'>"+$(this).data("networkstatus")+"</span><br>";
                }
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Network Title:</b>  "+$(this).data("networktitle")+"<br>"+
                    "<b>Network Status:</b>  "+status,
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
                                        $("#panel-body-container").load("/allnetworks");
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