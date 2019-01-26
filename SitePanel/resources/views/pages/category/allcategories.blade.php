<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading">All Categories<span class="viewitems-main-heading-count">({{ $categoriescount }})</span></div>
        <div class="viewitems-header-searchbar-container">
            <div class="viewitems-header-searchbar-filter">
                <select class="form-control form-field-text" id="columnsfilter">
                    <option value="" selected>Select Column For Search</option>
                    <option value="0">Category Title</option>
                    <option value="1">Category Description</option>
                    <option value="2">Is TopCategory</option>
                    <option value="3">Is PopularCategory</option>
                    <option value="4">Category Status</option>
                    <option value="6">Add/Update Form User</option>
                    <option value="7">Add/Update Image User</option>
                </select>
            </div>
            <div class="viewitems-header-searchbar" id="viewitems-header-searchbar">
                <input type="text" id="searchbar" class="form-control"/>
            </div>
        </div>
    </div>
    <hr>
    <div class="viewitems-tableview">
        <table class="table table-bordered" id="tableview">
            <thead>
                <tr>
                    <th>Category Title</th>
                    <th>Category Description</th>
                    <th>Is TopCategory</th>
                    <th>Is PopularCategory</th>
                    <th>Category Status</th>
                    <th>Category Logo</th>
                    <th>Add/Update Form By</th>
                    <th>Add/Update Image By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tablebody">
            @if(count($allcategories) > 0)
                @foreach($allcategories as $category)
                    <tr>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->is_topcategory }}</td>
                        <td>{{ $category->is_popularcategory }}</td>
                        <td>{{ $category->status }}</td>
                        <td>
                            @if($category->is_topcategory == "yes")
                            <img src="{{ asset($category->logo_url) }}"/>
                            @else
                            <b>N/A</b>
                            @endif
                        </td>
                        <td>{{ $category->form_user->username}}</td>
                        <td>{{ $category->image_user->username}}</td>
                        <td>
                            <a href="/updatecategory/{{$category->id}}" id="updatecategory" class="btn btn-primary"><i class="fa fa-edit"></i>Update</a>
                            <a href="/deletecategory/{{$category->id}}" data-categorytitle='{{$category->title}}' data-categorydescription="{{$category->description}}" data-istopcategory='{{$category->is_topcategory}}' data-ispopularcategory='{{$category->is_popularcategory}}' data-categorystatus='{{$category->status}}' id="deletecategory" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
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
                    $("#searchbar").attr('placeholder','Search Category Title');
                }
                else if(column == 1){
                    $("#searchbar").attr('placeholder','Search Category Description');
                }
                else if(column == 2){
                    $("#searchbar").attr('placeholder','Search Top Categories');
                }
                else if(column == 3){
                    $("#searchbar").attr('placeholder','Search Popular Categories');
                }
                else if(column == 4){
                    $("#searchbar").attr('placeholder','Search Category Status');
                }
                else if(column == 6){
                    $("#searchbar").attr('placeholder','Search User');
                }
                else if(column == 7){
                    $("#searchbar").attr('placeholder','Search User');
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
            if($(this).attr("id") == "updatecategory"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deletecategory"){
                var url = $(this).attr("href");
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Category Title:</b>  "+$(this).data("categorytitle")+"<br>"+
                    "<b>Category Description:</b>  "+$(this).data("categorydescription")+"<br>"+
                    "<b>Is TopCategory:</b>  "+$(this).data("istopcategory")+"<br>"+
                    "<b>Is PopularCategory:</b>  "+$(this).data("ispopularcategory")+"<br>"+
                    "<b>Category Status:</b>  "+$(this).data("categorystatus")+"<br>",
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
                                        $("#panel-body-container").load("/allcategories");
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