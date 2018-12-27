<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading">All Offers<span class="viewitems-main-heading-count">({{ $offerscount }})</span></div>
        <div class="viewitems-header-searchbar-container">
            <div class="viewitems-header-searchbar-filter">
                <select class="form-control" id="columnsfilter">
                    <option value="" selected>Select Column For Search</option>
                    <option value="0">Offer Title</option>
                    <option value="1">Offer Type By Store</option>
                    <option value="2">Offer Code</option>
                    <option value="3">Offer Details</option>
                    <option value="4">Store</option>
                    <option value="5">Category</option>
                    <option value="6">Offer Starting Date</option>
                    <option value="7">Offer Expiry Date</option>
                    <option value="8">Offer Uses</option>
                    <option value="9">Offer Type</option>
                    <option value="10">Offer Status</option>
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
                    <th>Title</th>
                    <th>Offer Type By Store</th>
                    <th>Code</th>
                    <th>Details</th>
                    <th>Store</th>
                    <th>Category</th>
                    <th>Starting Data</th>
                    <th>Expiry Date</th>
                    <th>Uses</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @foreach($alloffers as $offer)
                <tr>
                    <td>{{ $offer->title }}</td>
                    <td>{{ $offer->offer_type->title }}</td>
                    @if($offer->code != null)
                    <td>{{ $offer->code }}</td>
                    @else
                    <td><span style="color: #FF0000; font-weight: 600;">Not Required</span></td>
                    @endif
                    <td>{{ $offer->details }}</td>
                    <td>{{ $offer->store->title }}</td>
                    <td>{{ $offer->category->title }}</td>
                    <td>{{ $offer->starting_date }}</td>
                    @if($offer->expiry_date != null)
                    <td>{{ $offer->expiry_date }}</td>
                    @else
                    <td><span style="color: #FF0000; font-weight: 600;">Soon</span></td>
                    @endif
                    <td>{{ $offer->uses }}</td>
                    <td>{{ $offer->type }}</td>
                    <td>{{ $offer->status }}</td>
                    <td>
                        <a href="/updateoffer/{{$offer->id}}" id="updateoffer" class="btn btn-primary">Update</a>
                        <a href="/deleteoffer/{{$offer->id}}" id="deleteoffer" data-offertitle="{{ $offer->title }}" data-offertypebystore="{{ $offer->offer_type->title }}" data-offercode="{{ $offer->code }}" data-offerdetails="{{ $offer->details }}" data-offerstore="{{ $offer->store->title }}" data-offercategory="{{ $offer->category->title }}" data-offerstartingdate="{{ $offer->starting_date }}" data-offerexpirydate="{{ $offer->expiry_date }}" data-offeruses="{{ $offer->uses }}" data-offertype="{{ $offer->type }}" data-offerstatus="{{ $offer->status }}" class="btn btn-danger">Delete</a>
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
            $("#tableview td, #tableview th").removeClass("highlighted-column");
            $("#searchbar").val("");
            filterTable();
            if(column != ""){
                if(column == 0){
                    $("#searchbar").attr('placeholder','Search Offer Title');
                }
                else if(column == 1){
                    $("#searchbar").attr('placeholder','Search Offer Type By Store');
                }
                else if(column == 2){
                    $("#searchbar").attr('placeholder','Search Offer Code');
                }
                else if(column == 3){
                    $("#searchbar").attr('placeholder','Search Offer Details');
                }
                else if(column == 4){
                    $("#searchbar").attr('placeholder','Search Store');
                }
                else if(column == 5){
                    $("#searchbar").attr('placeholder','Search Category');
                }
                else if(column == 6){
                    $("#searchbar").attr('placeholder','Search Offer Start Date');
                }
                else if(column == 7){
                    $("#searchbar").attr('placeholder','Search Offer Expiry Date');
                }
                else if(column == 8){
                    $("#searchbar").attr('placeholder','Search Offer Uses');
                }
                else if(column == 9){
                    $("#searchbar").attr('placeholder','Search Offer Type');
                }
                else if(column == 10){
                    $("#searchbar").attr('placeholder','Search Offer Status');
                }
                $("#viewitems-header-searchbar").css("display","block");
                $("#tableview td:nth-child("+index+"), #tableview th:nth-child("+index+")").addClass("highlighted-column");
            }
            else{
                $("#viewitems-header-searchbar").css("display","none");
            }
        });
        //client side search filter
        $("#searchbar").keyup(function(){
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
                    "<b>Offer Title:</b>  "+$(this).data("offertitle")+"<br>"+
                    "<b>Offer Type By Store:</b>  "+$(this).data("offertypebystore")+"<br>"+
                    "<b>Offer Code:</b>  "+$(this).data("offercode")+"<br>"+
                    "<b>Offer Details:</b>  "+$(this).data("offerdetails")+"<br>"+
                    "<b>Store:</b>  "+$(this).data("offerstore")+"<br>"+
                    "<b>Category:</b>  "+$(this).data("offercategory")+"<br>"+
                    "<b>Offer Starting Date:</b>  "+$(this).data("offerstartingdate")+"<br>"+
                    "<b>Offer Expiry Date:</b>  "+$(this).data("offerexpirydate")+"<br>"+
                    "<b>Offer Uses:</b>  "+$(this).data("offeruses")+"<br>"+
                    "<b>Offer Type:</b>  "+$(this).data("offertype")+"<br>"+
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