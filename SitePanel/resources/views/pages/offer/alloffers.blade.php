<div class="viewitems-main-container">
    <div class="viewitems-main-heading">All Offers<span class="viewitems-main-heading-count">({{ $offerscount }}<span id="filtered_row_count"></span>)</span></div>
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
                    <th>Free Shipping</th>
                    <th>Is Popular</th>
                    <th>Display At Home</th>
                    <th>Is Verified</th>
                    <th>Status</th>
                    <th>Remark</th>
                    @if(Auth::User()->role == "admin")
                    <th>Add/Update By</th>
                    @endif
                    <th>Actions</th>
                </tr>
                <tr>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="storetitle" placeholder="Search Store Title" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="storetitle_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="categorytitle" placeholder="Search Category Title" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="categorytitle_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="offertitle" placeholder="Search Offer Title" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="offertitle_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="offeranchor" placeholder="Search Offer Anchor" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="offeranchor_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="offerlocation" placeholder="Search Offer Location" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="offerlocation_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="offertype" placeholder="Search Offer Type" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="offertype_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="offercode" placeholder="Search Offer Code" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="offercode_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="freeshippingoffer" placeholder="Search Free Shipping Offers" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="freeshippingoffer_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="popularoffer" placeholder="Search Popular Offers" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="popularoffer_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="homeoffer" placeholder="Search Home Offers" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="homeoffer_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="verifiedoffer" placeholder="Search Verified Offers" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="verifiedoffer_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="offerstatus" placeholder="Search Offer Status" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="offerstatus_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="offerremark" placeholder="Search Offer Remark" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="offerremark_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    @if(Auth::User()->role == "admin")
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="offer_add_update_by" placeholder="Search User" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="offer_add_update_by_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    @endif
                    <th><button class="header-searchbar-clear-filters-button" id="clear_all_filters" title="Clear All Applied Filters"><i class="fas fa-times-circle"></i>Clear All Filters</button></th>
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
                    <!-- <td>{{ \Carbon\Carbon::parse($offer->starting_date)->format('d/m/Y') }}</td>
                    @if($offer->expiry_date != null)
                        <td>{{ \Carbon\Carbon::parse($offer->expiry_date)->format('d/m/Y') }}</td>
                    @else
                        <td><span style="color: #FF0000; font-weight: 600;">Soon</span></td>
                    @endif -->
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
                    <td>
                    @if($offer->starting_date <= config('constants.today_date') && $offer->expiry_date >= config('constants.today_date'))
                    <span class="available-offer">Available</span>
                    @elseif($offer->starting_date > config('constants.today_date'))
                    <span class="pending-offer">Pending</span>
                    @elseif($offer->expiry_date < config('constants.today_date'))
                    <span class="expired-offer">Expired</span>
                    @endif
                    </td>
                    @if(Auth::User()->role == "admin")
                    <td>{{ $offer->user->username }}</td>
                    @endif
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
<script src="{{asset('js/hightlighttablecolumn.js')}}"></script>
<script>
    $(document).ready(function(){
        function clientSideFilter(){
            var $rows = $('#tablebody tr');
            var storetitle_val = $.trim($("#storetitle").val()).replace(/ +/g, ' ').toLowerCase();
            var categorytitle_val = $.trim($("#categorytitle").val()).replace(/ +/g, ' ').toLowerCase();
            var offertitle_val = $.trim($("#offertitle").val()).replace(/ +/g, ' ').toLowerCase();
            var offeranchor_val = $.trim($("#offeranchor").val()).replace(/ +/g, ' ').toLowerCase();
            var offerlocation_val = $.trim($("#offerlocation").val()).replace(/ +/g, ' ').toLowerCase();
            var offertype_val = $.trim($("#offertype").val()).replace(/ +/g, ' ').toLowerCase();
            var offercode_val = $.trim($("#offercode").val()).replace(/ +/g, ' ').toLowerCase();
            var freeshippingoffer_val = $.trim($("#freeshippingoffer").val()).replace(/ +/g, ' ').toLowerCase();
            var popularoffer_val = $.trim($("#popularoffer").val()).replace(/ +/g, ' ').toLowerCase();
            var homeoffer_val = $.trim($("#homeoffer").val()).replace(/ +/g, ' ').toLowerCase();
            var verifiedoffer_val = $.trim($("#verifiedoffer").val()).replace(/ +/g, ' ').toLowerCase();
            var offerstatus_val = $.trim($("#offerstatus").val()).replace(/ +/g, ' ').toLowerCase();
            var offerremark_val = $.trim($("#offerremark").val()).replace(/ +/g, ' ').toLowerCase();
            var offer_add_update_by_val = $.trim($("#offer_add_update_by").val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var storetitle_col = $(this).find('td:nth-child(1)').text().replace(/\s+/g, ' ').toLowerCase();
                var categorytitle_col = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
                var offertitle_col = $(this).find('td:nth-child(3)').text().replace(/\s+/g, ' ').toLowerCase();
                var offeranchor_col = $(this).find('td:nth-child(4)').text().replace(/\s+/g, ' ').toLowerCase();
                var offerlocation_col = $(this).find('td:nth-child(5)').text().replace(/\s+/g, ' ').toLowerCase();
                var offertype_col = $(this).find('td:nth-child(6)').text().replace(/\s+/g, ' ').toLowerCase();
                var offercode_col = $(this).find('td:nth-child(7)').text().replace(/\s+/g, ' ').toLowerCase();
                var freeshippingoffer_col = $(this).find('td:nth-child(8)').text().replace(/\s+/g, ' ').toLowerCase();
                var popularoffer_col = $(this).find('td:nth-child(9)').text().replace(/\s+/g, ' ').toLowerCase();
                var homeoffer_col = $(this).find('td:nth-child(10)').text().replace(/\s+/g, ' ').toLowerCase();
                var verifiedoffer_col = $(this).find('td:nth-child(11)').text().replace(/\s+/g, ' ').toLowerCase();
                var offerstatus_col = $(this).find('td:nth-child(12)').text().replace(/\s+/g, ' ').toLowerCase();
                var offerremark_col = $(this).find('td:nth-child(13)').text().replace(/\s+/g, ' ').toLowerCase();
                var offer_add_update_by_col = $(this).find('td:nth-child(14)').text().replace(/\s+/g, ' ').toLowerCase();
                return !~storetitle_col.indexOf(storetitle_val) || 
                        !~categorytitle_col.indexOf(categorytitle_val) || 
                        !~offertitle_col.indexOf(offertitle_val) || 
                        !~offeranchor_col.indexOf(offeranchor_val) || 
                        !~offerlocation_col.indexOf(offerlocation_val) || 
                        !~offertype_col.indexOf(offertype_val) ||
                        !~offercode_col.indexOf(offercode_val) || 
                        !~freeshippingoffer_col.indexOf(freeshippingoffer_val) || 
                        !~popularoffer_col.indexOf(popularoffer_val) ||
                        !~homeoffer_col.indexOf(homeoffer_val) ||
                        !~verifiedoffer_col.indexOf(verifiedoffer_val) ||
                        !~offerstatus_col.indexOf(offerstatus_val) ||
                        !~offerremark_col.indexOf(offerremark_val) ||
                        !~offer_add_update_by_col.indexOf(offer_add_update_by_val);
            }).hide();
            if($("#storetitle").val() != "" || 
                $("#categorytitle").val() != "" || 
                $("#offertitle").val() != "" ||
                $("#offeranchor").val() != "" || 
                $("#offerlocation").val() != "" || 
                $("#offertype").val() != "" ||
                $("#offercode").val() != "" || 
                $("#freeshippingoffer").val() != "" || 
                $("#popularoffer").val() != "" ||
                $("#homeoffer").val() != "" ||
                $("#verifiedoffer").val() != "" ||
                $("#offerstatus").val() != "" ||
                $("#offerremark").val() != "" ||
                $("#offer_add_update_by").val() != "")
            {
                $("#filtered_row_count").html("/"+$("#tablebody tr:visible").length);
            }
            else{
                $("#filtered_row_count").html("");
            }
        }
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        if('{{ Session::has("offerupdated_successmessage") }}'){
            $("#alert-success-message-area").html('{{ Session::get("offerupdated_successmessage") }}');
            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        //client side filters
        $(".header-searchbar-filter").bind('keyup input propertychange',function(){
            clientSideFilter();
        });
        $("#clear_all_filters").click(function(){
            $("#storetitle").val("");
            $("#categorytitle").val("");
            $("#offertitle").val("");
            $("#offeranchor").val("");
            $("#offerlocation").val("");
            $("#offertype").val("");
            $("#offercode").val("");
            $("#freeshippingoffer").val("");
            $("#popularoffer").val("");
            $("#homeoffer").val("");
            $("#verifiedoffer").val("");
            $("#offerstatus").val("");
            $("#offerremark").val("");
            $("#offer_add_update_by").val("");
            clientSideFilter();
        });
        $(".header-searchbar-filter-button").click(function(){
            if($(this).attr("id") == "storetitle_clr_btn"){
                $("#storetitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "categorytitle_clr_btn"){
                $("#categorytitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "offertitle_clr_btn"){
                $("#offertitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "offeranchor_clr_btn"){
                $("#offeranchor").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "offerlocation_clr_btn"){
                $("#offerlocation").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "offertype_clr_btn"){
                $("#offertype").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "offercode_clr_btn"){
                $("#offercode").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "freeshippingoffer_clr_btn"){
                $("#freeshippingoffer").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "popularoffer_clr_btn"){
                $("#popularoffer").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "homeoffer_clr_btn"){
                $("#homeoffer").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "verifiedoffer_clr_btn"){
                $("#verifiedoffer").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "offerstatus_clr_btn"){
                $("#offerstatus").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "offerremark_clr_btn"){
                $("#offerremark").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "offer_add_update_by_clr_btn"){
                $("#offer_add_update_by").val("");
                clientSideFilter();
            }
        });
        //select column for search
        $("#columnsfilter").change(function(){
            var column = $("#columnsfilter").val();
            var index = parseInt(column)+1;
            $("#tablebody td, #tablebody th").removeClass("highlight-column");
            $("#searchbar").val("");
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
                    $("#searchbar").attr('placeholder','Search Offer Start Date');
                }
                else if(column == 8){
                    $("#searchbar").attr('placeholder','Search Offer Expiry Date');
                }
                else if(column == 9){
                    $("#searchbar").attr('placeholder','Search Free Shipping Offer');
                }
                else if(column == 10){
                    $("#searchbar").attr('placeholder','Search Offer Is Popular');
                }
                else if(column == 11){
                    $("#searchbar").attr('placeholder','Search Offer Display At Home');
                }
                else if(column == 12){
                    $("#searchbar").attr('placeholder','Search Offer Is Verified');
                }
                else if(column == 13){
                    $("#searchbar").attr('placeholder','Search Offer Status');
                }
                else if(column == 14){
                    $("#searchbar").attr('placeholder','Search Offer Remark');
                }
                else if(column == 15){
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
            if($(this).attr("id") == "updateoffer"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deleteoffer"){
                var url = $(this).attr("href");
                var code = null;
                var expirydate = null;
                var status = null;
                if($(this).data("offercode") != ""){
                    code = $(this).data("offercode")+"<br>";
                }
                else{
                    code = "<span style='color: #FF0000; font-weight: 600'>Not Required</span><br>";
                }
                if($(this).data("offerexpirydate") != ""){
                    expirydate = $(this).data("offerexpirydate")+"<br>";
                }
                else{
                    expirydate = "<span style='color: #FF0000; font-weight: 600'>Soon</span><br>";
                }
                if($(this).data("offerstatus") == "active"){
                    status = "<span style='color: #117C00; font-weight: 600'>"+$(this).data("offerstatus")+"</span><br>";
                }
                else if($(this).data("offerstatus") == "deactive"){
                    status = "<span style='color: #FF0000; font-weight: 600'>"+$(this).data("offerstatus")+"</span><br>";
                }
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Store:</b>  "+$(this).data("offerstore")+"<br>"+
                    "<b>Category:</b>  "+$(this).data("offercategory")+"<br>"+
                    "<b>Offer Title:</b>  "+$(this).data("offertitle")+"<br>"+
                    "<b>Offer Anchor:</b>  "+$(this).data("offeranchor")+"<br>"+
                    "<b>Offer Location:</b>  "+$(this).data("offerlocation")+"<br>"+
                    "<b>Offer Type:</b>  "+$(this).data("offertype")+"<br>"+
                    "<b>Offer Code:</b>  "+code+
                    "<b>Offer Details:</b>  "+$(this).data("offerdetails")+"<br>"+
                    "<b>Offer Starting Date:</b>  "+$(this).data("offerstartingdate")+"<br>"+
                    "<b>Offer Expiry Date:</b>  "+expirydate+
                    "<b>Free Shipping:</b>  "+$(this).data("freeshipping")+"<br>"+
                    "<b>Offer Is Popular:</b>  "+$(this).data("offer-is-popular")+"<br>"+
                    "<b>Offer Display At Home:</b>  "+$(this).data("offer-display-at-home")+"<br>"+
                    "<b>Offer Is Verified:</b>  "+$(this).data("offer-is-verified")+"<br>"+
                    "<b>Offer Status:</b>  "+status,
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