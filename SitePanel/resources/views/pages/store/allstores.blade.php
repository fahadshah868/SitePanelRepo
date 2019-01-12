<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading">All Stores<span class="viewitems-main-heading-count">({{ $storescount }})</span></div>
        <div class="viewitems-header-searchbar-container">
            <div class="viewitems-header-searchbar-filter">
                <select class="form-control" id="columnsfilter">
                    <option value="" selected>Select Column For Search</option>
                    <option value="0">Store Title</option>
                    <option value="1">Store Details</option>
                    <option value="2">Store Primary Url</option>
                    <option value="3">Store Secondary Url</option>
                    <option value="4">Network</option>
                    <option value="5">Network Url</option>
                    <option value="6">Store Type</option>
                    <option value="7">Store Status</option>
                </select>
            </div>
            <div class="viewitems-header-searchbar" id="viewitems-header-searchbar">
                <input type="text" id="searchbar" class="form-control"/>
            </div>
        </div>
    </div>
    <hr>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <div class="viewitems-tableview">
        <table class="table table-bordered" id="tableview">
            <thead>
                <tr>
                    <th>Store Title</th>
                    <th>Store Details</th>
                    <th>Store Primary Url</th>
                    <th>Store Secondary Url</th>
                    <th>Network</th>
                    <th>Network Url</th>
                    <th>Store type</th>
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
                            <td>{{ $store->details }}</td>
                            <td>{{ $store->primary_url }}</td>
                            <td>{{ $store->secondary_url }}</td>
                            <td>{{ $store->network->title }}</td>
                            <td>{{ $store->network_url }}</td>
                            <td>{{ $store->type }}</td>
                            <td>{{ $store->status }}</td>
                            <td><img src="{{ asset($store->logo_url) }}"/></td>
                            <td>
                                <a href="/updatestore/{{$store->id}}" id="updatestore" class="btn btn-primary"><i class="fa fa-edit"></i>Update</a>
                            <a href="/deletestore/{{$store->id}}" data-storetitle="{{$store->title}}" data-storedetails="{{$store->details}}" data-storeprimaryurl="{{$store->primary_url}}" data-storesecondaryurl="{{$store->secondary_url}}" data-storenetwork="{{$store->network->title}}" data-storenetworkurl="{{$store->network_url}}" data-storetype="{{$store->type}}" data-storestatus="{{$store->status}}" id="deletestore" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<script src="{{asset('js/bootbox.min.js')}}"></script>
<script>
    $(document).ready(function(){
        //select column for search
        $("#columnsfilter").change(function(){
            var column = $("#columnsfilter").val();
            var index = parseInt(column)+1;
            $("#tableview td, #tableview th").removeClass("highlight-column");
            $("#searchbar").val("");
            filterTable();
            if(column != ""){
                if(column == 0){
                    $("#searchbar").attr('placeholder','Search Store Title');
                }
                else if(column == 1){
                    $("#searchbar").attr('placeholder','Search Store Details');
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
                    $("#searchbar").attr('placeholder','Search Store Type');
                }
                else if(column == 7){
                    $("#searchbar").attr('placeholder','Search Store Status');
                }
                $("#viewitems-header-searchbar").css("display","block");
                $("#tableview td:nth-child("+index+"), #tableview th:nth-child("+index+")").addClass("highlight-column");
            }
            else{
                $("#viewitems-header-searchbar").css("display","none");
            }
        });
        //client side search filter
        $("#searchbar").bind('keyup input propertychange',function(){
            filterTable();
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
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
                else{
                    tr[i].style.display = "";
                }
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
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Store Title:</b>  "+$(this).data("storetitle")+"<br>"+
                    "<b>Store Details Url:</b>  "+$(this).data("storedetails")+"<br>"+
                    "<b>Store Primary Url:</b>  "+$(this).data("storeprimaryurl")+"<br>"+
                    "<b>Store Secondary Url:</b>  "+$(this).data("storesecondaryurl")+"<br>"+
                    "<b>Store Network:</b>  "+$(this).data("storenetwork")+"<br>"+
                    "<b>Store Network Url:</b>  "+$(this).data("storenetworkurl")+"<br>"+
                    "<b>Store Type:</b>  "+$(this).data("storetype")+"<br>"+
                    "<b>Store Status:</b>  "+$(this).data("storestatus")+"<br>",
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