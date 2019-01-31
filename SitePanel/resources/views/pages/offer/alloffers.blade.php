<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading">All Offers<span class="viewitems-main-heading-count">({{ $offerscount }})</span></div>
        <div class="viewitems-header-searchbar-container">
            <div class="viewitems-header-searchbar-filter">
                <select class="form-control form-field-text" id="columnsfilter">
                    <option value="" selected>Select Column For Search</option>
                    <option value="0">Store</option>
                    <option value="1">Category</option>
                    <option value="2">Offer Title</option>
                    <option value="3">Offer Anchor</option>
                    <option value="4">Offer Location</option>
                    <option value="5">Offer Type</option>
                    <option value="6">Offer Code</option>
                    <option value="7">Offer Details</option>
                    <option value="8">Offer Starting Date</option>
                    <option value="9">Offer Expiry Date</option>
                    <option value="10">Free Shipping</option>
                    <option value="11">Offer Is Popular</option>
                    <option value="12">Offer Display At Home</option>
                    <option value="13">Offer Is Verified</option>
                    <option value="14">Offer Status</option>
                    <option value="15">Add/Update By</option>
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
                    <th>Store</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Anchor</th>
                    <th>Offer Location</th>
                    <th>Offer Type</th>
                    <th>Code</th>
                    <th>Details</th>
                    <th>Starting Data</th>
                    <th>Expiry Date</th>
                    <th>Free Shipping</th>
                    <th>Is Popular</th>
                    <th>Display At Home</th>
                    <th>Is Verified</th>
                    <th>Status</th>
                    <th>Add/Update By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @foreach($alloffers as $offer)
                <tr>
                    <td>{{ $offer->store->title }}</td>
                    <td>{{ $offer->category->title }}</td>
                    <td>{{ $offer->title }}</td>
                    <td>{{ $offer->anchor }}</td>
                    <td>{{ $offer->location }}</td>
                    <td>{{ $offer->type }}</td>
                    @if($offer->code != null)
                        <td>{{ $offer->code }}</td>
                    @else
                        <td><span style="color: #FF0000; font-weight: 600;">Not Required</span></td>
                    @endif
                    <td>{{ $offer->details }}</td>
                    <td>{{ $offer->starting_date }}</td>
                    @if($offer->expiry_date != null)
                        <td>{{ $offer->expiry_date }}</td>
                    @else
                        <td><span style="color: #FF0000; font-weight: 600;">Soon</span></td>
                    @endif
                    <td>{{ $offer->free_shipping }}</td>
                    <td>{{ $offer->is_popular }}</td>
                    <td>{{ $offer->display_at_home }}</td>
                    <td>{{ $offer->is_verified }}</td>
                    <td>
                        @if($offer->status == "active")
                        <span class="active-item">{{ $offer->status }}</span>
                        @else
                        <span class="deactive-item">{{ $offer->status }}</span>
                        @endif
                    </td>
                    <td>{{ $offer->user->username }}</td>
                    <td>
                        <a href="/updateoffer/{{$offer->id}}" id="updateoffer" class="btn btn-primary">Update</a>
                        <a href="/deleteoffer/{{$offer->id}}" id="deleteoffer" data-offerstore="{{ $offer->store->title }}" data-offercategory="{{ $offer->category->title }}" data-offertitle="{{ $offer->title }}" data-offeranchor="{{ $offer->anchor }}" data-offerlocation="{{ $offer->location }}" data-offertype="{{ $offer->type }}" data-offercode="{{ $offer->code }}" data-offerdetails="{{ $offer->details }}" data-offerstartingdate="{{ $offer->starting_date }}" data-offerexpirydate="{{ $offer->expiry_date }}", data-freeshipping="{{ $offer->free_shipping }}" data-offer-is-popular="{{$offer->is_popular}}", data-offer-display-at-home="{{$offer->display_at_home}}", data-offer-is-verified="{{$offer->is_verified}}", data-offerstatus="{{ $offer->status }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
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
        if('{{ Session::has("offerupdated_successmessage") }}'){
            $("#alert-success-message-area").html('{{ Session::get("offerupdated_successmessage") }}');
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
                    $("#searchbar").attr('placeholder','Search Store');
                }
                else if(column == 1){
                    $("#searchbar").attr('placeholder','Search Category');
                }
                else if(column == 2){
                    $("#searchbar").attr('placeholder','Search Offer Title');
                }
                else if(column == 3){
                    $("#searchbar").attr('placeholder','Search Offer Anchor');
                }
                else if(column == 4){
                    $("#searchbar").attr('placeholder','Search Offer Location');
                }
                else if(column == 5){
                    $("#searchbar").attr('placeholder','Search Offer Type');
                }
                else if(column == 6){
                    $("#searchbar").attr('placeholder','Search Offer Code');
                }
                else if(column == 7){
                    $("#searchbar").attr('placeholder','Search Offer Details');
                }
                else if(column == 8){
                    $("#searchbar").attr('placeholder','Search Offer Start Date');
                }
                else if(column == 9){
                    $("#searchbar").attr('placeholder','Search Offer Expiry Date');
                }
                else if(column == 10){
                    $("#searchbar").attr('placeholder','Search Free Shipping Offer');
                }
                else if(column == 11){
                    $("#searchbar").attr('placeholder','Search Offer Is Popular');
                }
                else if(column == 12){
                    $("#searchbar").attr('placeholder','Search Offer Display At Home');
                }
                else if(column == 13){
                    $("#searchbar").attr('placeholder','Search Offer Is Verified');
                }
                else if(column == 14){
                    $("#searchbar").attr('placeholder','Search Offer Status');
                }
                else if(column == 15){
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
            if($(this).attr("id") == "updateoffer"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deleteoffer"){
                var url = $(this).attr("href");
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Store:</b>  "+$(this).data("offerstore")+"<br>"+
                    "<b>Category:</b>  "+$(this).data("offercategory")+"<br>"+
                    "<b>Offer Title:</b>  "+$(this).data("offertitle")+"<br>"+
                    "<b>Offer Anchor:</b>  "+$(this).data("offeranchor")+"<br>"+
                    "<b>Offer Location:</b>  "+$(this).data("offerlocation")+"<br>"+
                    "<b>Offer Type:</b>  "+$(this).data("offertype")+"<br>"+
                    "<b>Offer Code:</b>  "+$(this).data("offercode")+"<br>"+
                    "<b>Offer Details:</b>  "+$(this).data("offerdetails")+"<br>"+
                    "<b>Offer Starting Date:</b>  "+$(this).data("offerstartingdate")+"<br>"+
                    "<b>Offer Expiry Date:</b>  "+$(this).data("offerexpirydate")+"<br>"+
                    "<b>Free Shipping:</b>  "+$(this).data("freeshipping")+"<br>"+
                    "<b>Offer Is Popular:</b>  "+$(this).data("offer-is-popular")+"<br>"+
                    "<b>Offer Display At Home:</b>  "+$(this).data("offer-display-at-home")+"<br>"+
                    "<b>Offer Is Verified:</b>  "+$(this).data("offer-is-verified")+"<br>"+
                    "<b>Offer Status:</b>  "+$(this).data("offerstatus"),
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
                                        $("#panel-body-container").load("/alloffers");
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