<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading" id="viewitems-main-heading">{{$mainheading}}<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">({{ $offerscount }}<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">{{$filtereddaterange}}</span></div>
        <div class="date-filter-container" id="date-filter-container">
            <a href="/todayalloffers" class="btn btn-danger viewitems-header-filter-button" title="Get Today All Offers List"><i class="fas fa-list"></i>Get Today's Offers</a>
            <a href="/alloffers" class="btn btn-danger viewitems-header-filter-button" title="Get All Offers List"><i class="fas fa-list"></i>Get All Offers</a>
            <button class="btn btn-danger date-range-filter-button" title="Set Date Range To Filter Offers" data-toggle="modal" data-target="#daterangemodal"><i class="fas fa-calendar-alt"></i>Set Date Range</button>
            {{--popup to update image--}}
            <div class="modal fade" id="daterangemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form id="daterangeofferfilterform" action="#" method="#">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Select Date Range</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding: 30px;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-field">
                                            <div class="form-field-heading">Select Remark</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-field">
                                            <label class="form-field-radiobutton-remarks-label">
                                                <input type="radio" value="created" name="dateremark" style="margin-right: 4px;" checked>New Created Records
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-field">
                                            <label class="form-field-radiobutton-remarks-label">
                                                <input type="radio" value="updated" name="dateremark" style="margin-right: 4px;">Updated Records
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-field">
                                            <label class="form-field-radiobutton-remarks-label">
                                                <input type="radio" value="both" name="dateremark" style="margin-right: 4px;">Both
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-field">
                                            <div class="form-field-heading">Select Date From</div>
                                            <input type="text" id="modal_datefrom" name="modal_datefrom" class="form-control form-field-text readonly-bg-color" readonly placeholder="select From date" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-field">
                                            <div class="form-field-heading">Select Date To</div>
                                            <input type="text" id="modal_dateto" name="modal_dateto" class="form-control form-field-text readonly-bg-color" readonly placeholder="select to date" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success form-button" id="cancel_modal_button" data-dismiss="modal"><i class="fa fa-backward"></i>Cancel</button>
                                <input type="submit" class="btn btn-primary form-button" value="Search">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end popup --}}
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
                    @if(strcasecmp(Auth::User()->role,"admin") == 0)
                    <th>Added/Updated By</th>
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
                    @if(strcasecmp(Auth::User()->role,"admin") == 0)
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="offer_added_updated_by" placeholder="Search User" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="offer_added_updated_by_clr_btn" title="clear">&#x2715;</button>
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
                        <td><span class='not-required-yet'>Not Required</span></td>
                    @endif
                    <td>{{ $offer->free_shipping }}</td>
                    <td>{{ $offer->is_popular }}</td>
                    <td>{{ $offer->display_at_home }}</td>
                    <td>{{ $offer->is_verified }}</td>
                    <td>
                        @if(strcasecmp($offer->is_active,"y") == 0)
                        <span class="active-item">_active</span>
                        @else
                        <span class="deactive-item">deactive</span>
                        @endif
                    </td>
                    <td>
                    @if($offer->starting_date <= config('constants.TODAY_DATE') && ($offer->expiry_date >= config('constants.TODAY_DATE') || $offer->expiry_date == null))
                    <span class="available-offer">Available</span>
                    @elseif($offer->starting_date > config('constants.TODAY_DATE'))
                    <span class="pending-offer">Pending</span>
                    @elseif($offer->expiry_date < config('constants.TODAY_DATE'))
                    <span class="expired-offer">Expired</span>
                    @endif
                    </td>
                    @if(strcasecmp(Auth::User()->role,"admin") == 0)
                    <td>{{ $offer->user->username }}</td>
                    @endif
                    <td>
                        <a href="/viewoffer/{{$offer->id}}" id="viewoffer" class="btn btn-primary actionbutton"><i class="fa fa-eye"></i>View</a>
                        <a href="/deleteoffer/{{$offer->id}}" id="deleteoffer" data-offerstore="{{ $offer->store->title }}" data-offercategory="{{ $offer->category->title }}" data-offertitle="{{ $offer->title }}" data-offeranchor="{{ $offer->anchor }}" data-offerlocation="{{ $offer->location }}" data-offertype="{{ $offer->type }}" data-offercode="{{ $offer->code }}" data-offerdetails="{{ $offer->details }}" data-offerstartingdate="{{ $offer->starting_date }}" data-offerexpirydate="{{ $offer->expiry_date }}", data-freeshipping="{{ $offer->free_shipping }}" data-offer-is-popular="{{$offer->is_popular}}", data-offer-display-at-home="{{$offer->display_at_home}}", data-offer-is-verified="{{$offer->is_verified}}", data-offerstatus="{{ $offer->is_active }}" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>
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
            var offer_added_updated_by_val = $.trim($("#offer_added_updated_by").val()).replace(/ +/g, ' ').toLowerCase();
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
                var offer_added_updated_by_col = $(this).find('td:nth-child(14)').text().replace(/\s+/g, ' ').toLowerCase();
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
                        !~offer_added_updated_by_col.indexOf(offer_added_updated_by_val);
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
                $("#offer_added_updated_by").val() != "")
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
        var dates = $("#modal_datefrom, #modal_dateto").datepicker({
            changeYear: true,
            changeMonth: true,
            showButtonPanel: true,
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
            onSelect: function(selectedDate) {
                var option = this.id == "modal_datefrom" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            },
            beforeShow: function( input ) {
                setTimeout(function() {
                    var buttonPane = $( input )
                        .datepicker( "widget" )
                        .find( ".ui-datepicker-buttonpane" );

                    $( "<button>", {
                        text: "Clear",
                        click: function() {
                        //Code to clear your date field (text box, read only field etc.) I had to remove the line below and add custom code here
                            $.datepicker._clearDate( input );
                        }
                    }).appendTo( buttonPane ).addClass("ui-datepicker-clear ui-state-default ui-priority-primary ui-corner-all");
                }, 1 );
            },
            onChangeMonthYear: function( year, month, instance ) {
                setTimeout(function() {
                    var buttonPane = $( instance )
                        .datepicker( "widget" )
                        .find( ".ui-datepicker-buttonpane" );

                    $( "<button>", {
                        text: "Clear",
                        click: function() {
                        //Code to clear your date field (text box, read only field etc.) I had to remove the line below and add custom code here
                            $.datepicker._clearDate( instance.input );
                        }
                    }).appendTo( buttonPane ).addClass("ui-datepicker-clear ui-state-default ui-priority-primary ui-corner-all");
                }, 1 );
            }
        });
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
            $("#offer_added_updated_by").val("");
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
            else if($(this).attr("id") == "offer_added_updated_by_clr_btn"){
                $("#offer_added_updated_by").val("");
                clientSideFilter();
            }
        });
        //filter offer by date range
        $("#date-filter-container a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#cancel_modal_button").click(function(){
            $("#daterangeofferfilterform").trigger("reset");
            $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null, maxDate: new Date()});
        });
        $("#daterangeofferfilterform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                modal_datefrom: "required",
                modal_dateto: "required",
                dateremark: "required",
            },
            messages: {
                modal_datefrom: "please select from date",
                modal_dateto: "please select to date",
                dateremark: "please select remark",
            },
            submitHandler: function(form) {
                var _dateremark = $("input[name='dateremark']:checked"). val();
                var _modal_datefrom = $("#modal_datefrom").val();
                var _modal_dateto = $("#modal_dateto").val();
                $("#daterangeofferfilterform").trigger("reset");
                $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null,maxDate: null});
                $(".alert").css('display','none');
                $.ajax({
                    method: "GET",
                    url: "/filteredoffers/"+_dateremark+"/"+_modal_datefrom+"/"+_modal_dateto,
                    data: null,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        $("#daterangemodal").modal('toggle');
                        $("#tablebody").empty();
                        $("#viewitems-main-heading").html(data.mainheading);
                        $.each(data.filteredoffers, function (index, value) {
                            var html = "<tr>"+
                            "<td>"+value.store.title+"</td>"+
                            "<td>"+value.category.title+"</td>"+
                            "<td>"+value.title+"</td>"+
                            "<td>"+value.anchor+"</td>"+
                            "<td>"+value.location+"</td>"+
                            "<td>"+value.type+"</td>"
                            if(value.code != null){
                                html = html + "<td>"+value.code+"</td>"
                            }
                            else{
                                html = html + "<td><span class='not-required-yet'>Not Required</span></td>"
                            }
                            html  = html +
                            "<td>"+value.free_shipping+"</td>"+
                            "<td>"+value.is_popular+"</td>"+
                            "<td>"+value.display_at_home+"</td>"+
                            "<td>"+value.is_verified+"</td>"
                            if(value.is_active == "y"){
                                html = html + "<td><span class='active-item'>active</span></td>"
                            }
                            else{
                                html = html + "<td><span class='deactive-item'>deactive</span></td>"
                            }
                            if(value.starting_date <= "{{config('constants.TODAY_DATE')}}" && (value.expiry_date >= "{{config('constants.TODAY_DATE')}}" || value.expiry_date == null)){
                                html = html + "<td><span class='available-offer'>Available</span></td>"
                            }
                            else if(value.starting_date > "{{config('constants.TODAY_DATE')}}"){
                                html = html + "<td><span class='pending-offer'>Pending</span></td>"
                            }
                            else if(value.expiry_date < "{{config('constants.TODAY_DATE')}}"){
                                html = html + "<td><span class='expired-offer'>Expired</span></td>"
                            }
                            if("{{Auth::User()->role}}" == "admin"){
                                html = html +
                                "<td>"+value.user.username+"</td>"
                            }
                            html = html +
                            "<td>"+
                                "<a href='/viewoffer/"+value.id+"' id='viewoffer' class='btn btn-primary actionbutton'><i class='fa fa-eye'></i>View</a>"+
                                "<a href='/deleteoffer/"+value.id+"' id='deleteoffer' data-offerstore='"+value.store.title+"' data-offercategory='"+value.category.title+"' data-offertitle='"+value.title+"' data-offeranchor='"+value.anchor+"' data-offerlocation='"+value.location+"' data-offertype='"+value.type+"' data-offercode='"+value.code+"' data-offerdetails='"+value.details+"' data-offerstartingdate='"+value.starting_date+"' data-offerexpirydate='"+value.expiry_date+"' data-freeshipping='"+value.free_shipping+"' data-offer-is-popular='"+value.is_popular+"' data-offer-display-at-home='"+value.display_at_home+"' data-offer-is-verified='"+value.is_verified+"' data-offerstatus='"+value.is_active+"' class='btn btn-danger actionbutton'><i class='fa fa-trash'></i>Delete</a>"+
                            "</td>"+
                            "</tr>";
                            $("#tablebody").append(html);
                        });
                    },
                    error: function(){
                        alert("Ajax Error! something went wrong...");
                    }
                });
                return false;
            }
        });
        //navigation buttons actions
        $("#tablebody").on("click","a.actionbutton",function(event){
            event.preventDefault();
            if($(this).attr("id") == "viewoffer"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deleteoffer"){
                var url = $(this).attr("href");
                var code = null;
                var offer_remark = null;
                var status = null;
                if($(this).data("offercode") != null && $(this).data("offercode") != ""){
                    code = $(this).data("offercode")+"<br>";
                }
                else{
                    code = "<span class='not-required-yet'>Not Required</span><br>";
                }
                if($(this).data("offerstartingdate") <= "{{config('constants.TODAY_DATE')}}" && ($(this).data("offerexpirydate") >= "{{config('constants.TODAY_DATE')}}" || $(this).data("offerexpirydate") == null)){
                    offer_remark = "<span class='available-offer'>Available</span><br>"
                }
                else if($(this).data("offerstartingdate") > "{{config('constants.TODAY_DATE')}}"){
                    offer_remark = "<span class='pending-offer'>Pending</span><br>"
                }
                else if($(this).data("offerexpirydate") < "{{config('constants.TODAY_DATE')}}"){
                    offer_remark = "<span class='expired-offer'>Expired</span><br>"
                }
                if($(this).data("offerstatus") == "y"){
                    status = "<span class='active-item'>_active</span><br>";
                }
                else if($(this).data("offerstatus") == "n"){
                    status = "<span class='deactive-item'>deactive</span><br>";
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
                    "<b>Offer Remark:</b>  "+offer_remark+
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
                                        $("#panel-body-container").load(data.url);
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