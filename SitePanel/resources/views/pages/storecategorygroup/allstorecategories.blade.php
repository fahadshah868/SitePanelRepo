<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading">All Store Categories</div>
        <div class="viewitems-header-searchbar-container">
            <div class="viewitems-header-searchbar-filter">
                <select class="form-control form-field-text" id="columnsfilter">
                    <option value="" selected>Select Column For Search</option>
                    <option value="0">Store Title</option>
                    <option value="1">Store Categories</option>
                    <option value="2">Add/Update By</option>
                </select>
            </div>
            <div class="viewitems-header-searchbar" id="viewitems-header-searchbar">
                <input type="text" id="searchbar" class="form-control"/>
            </div>
        </div>
    </div>
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
                    <th>Store Title</th>
                    <th>Store Categories</th>
                    @if(Auth::User()->role == "admin")
                    <th>Add/Update By</th>
                    @endif
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @if(count($allstores) > 0)
                    @foreach($allstores as $store)
                        <tr>
                            <td>{{ $store->title }}<span class="viewitems-table-count">({{ count($store->storecategorygroup) }})</span></td>
                            <td>
                            @foreach($store->storecategorygroup as $storecategory)
                                {{ $storecategory->category->title }}, 
                            @endforeach
                            </td>
                            @if(Auth::User()->role == "admin")
                            <td>{{ $store->storecategorygroup{0}->user->username }}</td>
                            @endif
                            <td>
                                <a href="/updatestorecategories/{{$store->id}}" id="updatestorecategories" class="btn btn-primary"><i class="fa fa-edit"></i>Update</a>
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
        if('{{Session::has("updatestorecategories_successmessage")}}'){
            $("#alert-success-message-area").html('{{ Session::get("updatestorecategories_successmessage") }}');
            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        //select column for search
        $("#columnsfilter").change(function(){
            var column = $("#columnsfilter").val();
            var index = parseInt(column)+1;
            $("#tablebody td, #tablebody th").removeClass("highlight-column");
            $("#searchbar").val("");
            filterTable();
            if(column != ""){
                if(column == 0){
                    $("#searchbar").attr('placeholder','Search Store Title');
                }
                else if(column == 1){
                    $("#searchbar").attr('placeholder','Search Store categories');
                }
                else if(column == 2){
                    $("#searchbar").attr('placeholder','Search User');
                }
                $("#viewitems-header-searchbar").css("display","block");
                $("#tablebody td:nth-child("+index+"), #tablebody th:nth-child("+index+")").addClass("highlight-column");
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
            if($(this).attr("id") == "updatestorecategories"){
                $("#panel-body-container").load($(this).attr("href"));
            }
        });
    });
</script>


