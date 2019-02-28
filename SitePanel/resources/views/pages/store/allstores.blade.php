<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading">All Stores<span class="viewitems-main-heading-count">({{ $storescount }}<span id="filtered-row-count"></span>)</span></div>
        <div class="viewitems-header-searchbar-container">
            <div class="viewitems-header-searchbar-filter">
                <select class="form-control form-field-text" id="columnsfilter">
                    <option value="" selected>Select Column For Search</option>
                    <option value="0">Store Title</option>
                    <option value="1">coupons Available</option>
                    <option value="2">Store Primary Url</option>
                    <option value="3">Store Secondary Url</option>
                    <option value="4">Network</option>
                    <option value="5">Network Url</option>
                    <option value="6">Is TopStore</option>
                    <option value="7">Is PopularStore</option>
                    <option value="8">Store Status</option>
                    @if(Auth::User()->role == "admin")
                    <option value="10">Add/Update Form By</option>
                    <option value="11">Add/Update Image By</option>
                    @endif
                </select>
            </div>
            <div class="viewitems-header-searchbar" id="viewitems-header-searchbar">
                <input type="text" id="searchbar" class="form-control"/>
            </div>
        </div>
    </div>
    <hr>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <div class="viewitems-tableview">
        <table class="table table-bordered" id="tableview">
            <thead>
                <tr>
                    <th>Store Title</th>
                    <th>Coupons Available</th>
                    <th>Store Primary Url</th>
                    <th>Store Secondary Url</th>
                    <th>Network</th>
                    <th>Network Url</th>
                    <th>Is TopStore</th>
                    <th>Is PopularStore</th>
                    <th>Store Status</th>
                    <th>Store Logo</th>
                    @if(Auth::User()->role == "admin")
                    <th>Add/Update Form By</th>
                    <th>Add/Update Image By</th>
                    @endif
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @if(count($allstores) > 0)
                    @foreach($allstores as $store)
                        <tr>
                            <td>{{ $store->title }}</td>
                            <td>{{ count($store->offer) }}</td>
                            <td>{{ $store->primary_url }}</td>
                            <td>{{ $store->secondary_url }}</td>
                            <td>{{ $store->network->title }}</td>
                            <td>{{ $store->network_url }}</td>
                            <td>{{ $store->is_topstore }}</td>
                            <td>{{ $store->is_popularstore }}</td>
                            <td>
                                @if($store->status == "active")
                                <span class="active-item">{{ $store->status }}</span>
                                @else
                                <span class="deactive-item">{{ $store->status }}</span>
                                @endif
                            </td>
                            <td><img src="{{ asset($store->logo_url) }}"/></td>
                            @if(Auth::User()->role == "admin")
                            <td>{{ $store->form_user->username }}</td>
                            <td>{{ $store->image_user->username }}</td>
                            @endif
                            <td>
                                <a href="/updatestore/{{$store->id}}" id="updatestore" class="btn btn-primary"><i class="fa fa-edit"></i>Update</a>
                                <a href="/deletestore/{{$store->id}}" data-storetitle="{{$store->title}}" data-storedescription="{{$store->description}}" data-storeprimaryurl="{{$store->primary_url}}" data-storesecondaryurl="{{$store->secondary_url}}" data-storenetwork="{{$store->network->title}}" data-storenetworkurl="{{$store->network_url}}" data-istopstore="{{$store->is_topstore}}" data-ispopularstore="{{$store->is_popularstore}}" data-storestatus="{{$store->status}}" id="deletestore" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
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
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        //select column for search
        $("#columnsfilter").change(function(){
            var column = $("#columnsfilter").val();
            var index = parseInt(column)+1;
            $("#tablebody td, #tablebody th").removeClass("highlight-column");
            $("#searchbar").val("");
            if(column != ""){
                if(column == 0){
                    $("#searchbar").attr('placeholder','Search Store Title');
                }
                else if(column == 1){
                    $("#searchbar").attr('placeholder','Search Coupons Available');
                }
                else if(column == 2){
                    $("#searchbar").attr('placeholder','Search Store Primary Url');
                }
                else if(column == 3){
                    $("#searchbar").attr('placeholder','Search Store Secondary Url');
                }
                else if(column == 4){
                    $("#searchbar").attr('placeholder','Search Store Network');
                }
                else if(column == 5){
                    $("#searchbar").attr('placeholder','Search Store Network Url');
                }
                else if(column == 6){
                    $("#searchbar").attr('placeholder','Search Top Stores');
                }
                else if(column == 7){
                    $("#searchbar").attr('placeholder','Search Popular Stores');
                }
                else if(column == 8){
                    $("#searchbar").attr('placeholder','Search Store Status');
                }
                else if(column == 10){
                    $("#searchbar").attr('placeholder','Search User');
                }
                else if(column == 11){
                    $("#searchbar").attr('placeholder','Search User');
                }
                $("#viewitems-header-searchbar").css("display","block");
                $("#tablebody td:nth-child("+index+"), #tablebody th:nth-child("+index+")").addClass("highlight-column");
                $("#filtered-row-count").html("/"+$('#tablebody tr:visible').length);
            }
            else{
                $("#viewitems-header-searchbar").css("display","none");
                $("#tableview").find("tr").css("display","");
                $("#filtered-row-count").html("");
            }
        });
        //client side search filter
        $("#searchbar").bind('keyup input propertychange',function(){
            filterTable();
            $("#filtered-row-count").html("/"+$('#tablebody tr:visible').length);
        });
        //search/filter table
        function filterTable(){
            var filter, table, tr, td, i, column;
            column = $("#columnsfilter").val();
            filter = $("#searchbar").val().toUpperCase();
            table = $("#tableview");
            tr = table.find("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[column];
                $(td).filter(function() {
                    $(tr[i]).toggle($(this).text().toUpperCase().indexOf(filter) > -1)
                });
            }
        }
        //navigation buttons actions
        $("#tablebody tr td a").click(function(event){
            event.preventDefault();
            if($(this).attr("id") == "updatestore"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deletestore"){
                var url = $(this).attr("href");
                var status = null;
                if($(this).data("storestatus") == "active"){
                    status = "<span style='color: #117C00; font-weight: 600'>"+$(this).data("storestatus")+"</span><br>";
                }
                else if($(this).data("storestatus") == "deactive"){
                    status = "<span style='color: #FF0000; font-weight: 600'>"+$(this).data("storestatus")+"</span><br>";
                }
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Store Title:</b>  "+$(this).data("storetitle")+"<br>"+
                    "<b>Store Description:</b>  "+$(this).data("storedescription")+"<br>"+
                    "<b>Store Primary Url:</b>  "+$(this).data("storeprimaryurl")+"<br>"+
                    "<b>Store Secondary Url:</b>  "+$(this).data("storesecondaryurl")+"<br>"+
                    "<b>Store Network:</b>  "+$(this).data("storenetwork")+"<br>"+
                    "<b>Store Network Url:</b>  "+$(this).data("storenetworkurl")+"<br>"+
                    "<b>Is TopStore:</b>  "+$(this).data("istopstore")+"<br>"+
                    "<b>Is PopularStore:</b>  "+$(this).data("ispopularstore")+"<br>"+
                    "<b>Store Status:</b>  "+status,
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
                                cache: false,
                                success: function(data){
                                    if(data.status == "true"){
                                        $("#panel-body-container").load("/allstores");
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