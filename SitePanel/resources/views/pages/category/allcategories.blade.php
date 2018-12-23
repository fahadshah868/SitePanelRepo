<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading">All Categories<span class="viewitems-main-heading-count">({{ $categoriescount }})</span></div>
        <div class="viewitems-header-searchbar"><input type="text" placeholder="Search Category" id="searchbar" class="form-control"/></div>
    </div>
    <hr>
    <div class="viewitems-tableview">
        <table class="table table-bordered" id="tableview">
            <thead>
                <tr>
                    <th>Category Title</th>
                    <th>Category Type</th>
                    <th>Category Status</th>
                    <th>Category Logo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tablebody">
            @if(count($allcategories) > 0)
                @foreach($allcategories as $category)
                    <tr>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->type }}</td>
                        <td>{{ $category->status }}</td>
                        <td>
                            @if($category->type == "regular")
                            <b>N/A</b>
                            @else
                            <img src="{{ asset($category->logo_url) }}"/></td>
                            @endif
                        <td>
                            <a href="/updatecategory/{{$category->id}}" id="updatecategory" class="btn btn-primary"><i class="fa fa-edit"></i>Update</a>
                            <a href="/deletecategory/{{$category->id}}" data-categorytitle='{{$category->title}}' data-categorytype='{{$category->type}}' data-categorystatus='{{$category->status}}' id="deletecategory" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
<script src="{{asset('js/bootbox.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/clientsidesearchbarfilter.js')}}"></script>
<script>
    $(document).ready(function(){
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
                    "<b>Category Type:</b>  "+$(this).data("categorytype")+"<br>"+
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