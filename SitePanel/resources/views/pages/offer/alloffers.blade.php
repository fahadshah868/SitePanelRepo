<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading">All Offers<span class="viewitems-main-heading-count">({{ $offerscount }})</span></div>
        <div class="viewitems-header-searchbar-container">
            <div class="viewitems-header-searchbar-filter">
                <select class="form-control" id="columnsfilter">
                    <option value="" selected>Select Column For Search</option>
                    <option value="0">Offer Title</option>
                    <option value="1">Offer Type</option>
                    <option value="2">Offer Code</option>
                    <option value="3">Offer Details</option>
                    <option value="4">Store</option>
                    <option value="5">Category</option>
                    <option value="6">Offer Starting Date</option>
                    <option value="7">Offer Expiry Date</option>
                    <option value="8">Offer Uses</option>
                    <option value="9">Type</option>
                    <option value="10">Offer Status</option>
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
                    <th>Offer Title</th>
                    <th>Offer Type</th>
                    <th>Code</th>
                    <th>Details</th>
                    <th>Store</th>
                    <th>Category</th>
                    <th>Starting Data</th>
                    <th>Expiry Date</th>
                    <th>Uses</th>
                    <th>Type</th>
                    <th>Offer Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alloffers as $offer)
                <tr>
                    <td>$offer->title</td>
                    <td>$offer->offer_type_id</td>
                    <td>$offer->code</td>
                    <td>$offer->details</td>
                    <td>$offer->store_id</td>
                    <td>$offer->category_id</td>
                    <td>$offer->starting_date</td>
                    <td>$offer->expiry_date</td>
                    <td>$offer->uses</td>
                    <td>$offer->type</td>
                    <td>$offer->status</td>
                    <td>
                        <a href="#" class="btn btn-primary">Update</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function(){
        if('{{ Session::has("updateoffer_successmessage") }}'){
            $("#alert-success-message-area").html('{{ Session::get("updateoffer_successmessage") }}');
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
                    $("#searchbar").attr('placeholder','Search Offer Type');
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
                    $("#searchbar").attr('placeholder','Search Type');
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
            }
        } 
        //navigation buttons actions
        $("#tablebody tr td a").click(function(event){
            event.preventDefault();
            if($(this).attr("id") == "updateOffer"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deleteOffer"){
                var url = $(this).attr("href");
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Offer:</b>  "+$(this).data("Offername")+"<br>"+
                    "<b>Offer Role:</b>  "+$(this).data("Offerrole")+"<br>"+
                    "<b>Offer Status:</b>  "+$(this).data("Offerstatus"),
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
                                        $("#panel-body-container").load("/allOffers");
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