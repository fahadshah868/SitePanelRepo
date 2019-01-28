<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading">All Carousel Offers<span class="viewitems-main-heading-count">({{ $carouselofferscount }})</span></div>
        <div class="viewitems-header-searchbar-container">
            <div class="viewitems-header-searchbar-filter">
                <select class="form-control form-field-text" id="columnsfilter">
                    <option value="" selected>Select Column For Search</option>
                    <option value="0">Store Title</option>
                    <option value="1">Offer Title</option>
                    <option value="2">Offer Type</option>
                    <option value="3">Offer Code</option>
                    <option value="4">Offer Starting Date</option>
                    <option value="5">Offer Expiry Date</option>
                    <option value="6">Offer Status</option>
                    <option value="8">Add/Update Form By</option>
                    <option value="9">Add/Update Image By</option>
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
                    <th>Offer Title</th>
                    <th>Offer Type</th>
                    <th>Offer Code</th>
                    <th>Starting Date</th>
                    <th>Expiry Date</th>
                    <th>Offer Status</th>
                    <th>Image</th>
                    <th>Add/Update Form By</th>
                    <th>Add/Update Image By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @if(count($allcarouseloffers) > 0)
                    @foreach($allcarouseloffers as $carouseloffer)
                        <tr>
                            <td>{{ $carouseloffer->store->title }}</td>
                            <td>{{ $carouseloffer->title }}</td>
                            <td>{{ $carouseloffer->type }}</td>
                            @if($carouseloffer->code != null)
                                <td>{{ $carouseloffer->code }}</td>
                            @else
                                <td><span style="color: #FF0000; font-weight: 600;">Not Required</span></td>
                            @endif
                            <td>{{ $carouseloffer->starting_date}}</td>
                            @if($carouseloffer->expiry_date != null)
                                <td>{{ $carouseloffer->expiry_date }}</td>
                            @else
                                <td><span style="color: #FF0000; font-weight: 600;">Soon</span></td>
                            @endif
                            <td>{{ $carouseloffer->status }}</td>
                            <td><img src="{{ asset($carouseloffer->image_url) }}" class="carouselofferimage"/></td>
                            <td>{{ $carouseloffer->form_user->username }}</td>
                            <td>{{ $carouseloffer->image_user->username }}</td>
                            <td>
                                <a href="/updatecarouseloffer/{{$carouseloffer->id}}" id="updatecarouseloffer" class="btn btn-primary"><i class="fa fa-edit"></i>Update</a>
                                <a href="/deletecarouseloffer/{{$carouseloffer->id}}" id="deletecarouseloffer" data-storetitle="{{$carouseloffer->store->title}}" data-offertitle="{{$carouseloffer->title}}" data-offertype="{{$carouseloffer->type}}" data-offercode="{{$carouseloffer->code}}" data-offerstartingdate="{{$carouseloffer->starting_date}}" data-offerexpirydate="{{$carouseloffer->expiry_date}}" data-offerstatus="{{$carouseloffer->status}}" id="deletestore" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
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
        $(".close").click(function(){
            $(".alert").slideUp();
        });
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
                    $("#searchbar").attr('placeholder','Search Offer Title');
                }
                else if(column == 2){
                    $("#searchbar").attr('placeholder','Search Offer Type');
                }
                else if(column == 3){
                    $("#searchbar").attr('placeholder','Search Offer Code');
                }
                else if(column == 4){
                    $("#searchbar").attr('placeholder','Search Offer Starting Date');
                }
                else if(column == 5){
                    $("#searchbar").attr('placeholder','Search Offer Expiry Date');
                }
                else if(column == 6){
                    $("#searchbar").attr('placeholder','Search Offer Status');
                }
                else if(column == 8){
                    $("#searchbar").attr('placeholder','Search User');
                }
                else if(column == 9){
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
            if($(this).attr("id") == "updatecarouseloffer"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deletecarouseloffer"){
                var url = $(this).attr("href");
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Store Title:</b>  "+$(this).data("storetitle")+"<br>"+
                    "<b>Offer Title:</b>  "+$(this).data("offertitle")+"<br>"+
                    "<b>Offer Type:</b>  "+$(this).data("offertype")+"<br>"+
                    "<b>Offer Code:</b>  "+$(this).data("offercode")+"<br>"+
                    "<b>Offer Starting Date:</b>  "+$(this).data("offerstartingdate")+"<br>"+
                    "<b>Offer Expiry Date:</b>  "+$(this).data("offerexpirydate")+"<br>"+
                    "<b>Offer Status:</b>  "+$(this).data("offerstatus")+"<br>",
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
                                        $("#panel-body-container").load("/allcarouseloffers");
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