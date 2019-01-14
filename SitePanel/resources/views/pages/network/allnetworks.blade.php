<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading">All Networks<span class="viewitems-main-heading-count">({{ $networkscount }})</span></div>
        <div class="viewitems-header-searchbar-container">
            <div class="viewitems-header-searchbar-filter">
                <select class="form-control" id="columnsfilter">
                    <option value="" selected>Select Column For Search</option>
                    <option value="0">Network Title</option>
                    <option value="1">Netowrk Status</option>
                </select>
            </div>
            <div class="viewitems-header-searchbar" id="viewitems-header-searchbar">
                <input type="text" id="searchbar" class="form-control"/>
            </div>
        </div>
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
                    <th>Network Title</th>
                    <th>Network Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @if(count($allnetworks) > 0)
                    @foreach($allnetworks as $network)
                    <tr>
                        <td>{{ $network->title }}</td>
                        <td>{{ $network->status }}</td>
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
<script>
    $(document).ready(function(){
        if('{{ Session::has("updatenetwork_successmessage") }}'){
            $("#alert-success-message-area").html('{{ Session::get("updatenetwork_successmessage") }}');
            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        //select column for search
        $("#columnsfilter").change(function(){
            var column = $("#columnsfilter").val();
            var index = parseInt(column)+1;
            $("#tableview td, #tableview th").removeClass("highlight-column");
            $("#searchbar").val("");
            filterTable();
            if(column != ""){
                if(column == 0){
                    $("#searchbar").attr('placeholder','Search Network Title');
                }
                else if(column == 1){
                    $("#searchbar").attr('placeholder','Search Network Status');
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
            if($(this).attr("id") == "updatenetwork"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deletenetwork"){
                var url = $(this).attr("href");
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Network Title:</b>  "+$(this).data("networktitle")+"<br>"+
                    "<b>Network Status:</b>  "+$(this).data("networkstatus"),
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