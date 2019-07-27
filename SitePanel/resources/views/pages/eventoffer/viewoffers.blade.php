<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading" id="viewitems-main-heading">{{$mainheading}}<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">({{ $eventoffers->total() }}<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">{{$filtereddaterange}}</span></div>
        <div class="date-filter-container" id="date-filter-container">
            <a href="/event/todayalloffers" class="btn btn-danger viewitems-header-filter-button" title="Get Today All Offers List"><i class="fas fa-list"></i>Get Today's Event Offers</a>
            <a href="/event/alloffers" class="btn btn-danger viewitems-header-filter-button" title="Get All Offers List"><i class="fas fa-list"></i>Get All Event Offers</a>
            <button class="btn btn-danger date-range-filter-button" title="Set Date Range To Filter Offers" data-toggle="modal" data-target="#daterangemodal"><i class="fas fa-calendar-alt"></i>Set Date Range</button>
            {{--popup to update image--}}
            <div class="modal fade" id="daterangemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form id="daterangeeventofferfilterform" action="#" method="#">
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
    {{$eventoffers->links()}}
    <div class="viewitems-tableview">
        <table class="table table-bordered" id="tableview">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Offer Title</th>
                    <th>Store</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="eventtitle" placeholder="Search Event Title" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="eventtitle_clr_btn" title="clear">&#x2715;</button>
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
                    <th><button class="header-searchbar-clear-filters-button" id="clear_all_filters" title="Clear All Applied Filters"><i class="fas fa-times-circle"></i>Clear All Filters</button></th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @foreach($eventoffers as $eventoffer)
                <tr>
                    <td>{{ $eventoffer->event->title }}</td>
                    <td>{{ $eventoffer->offer->title }}</td>
                    <td>{{ $eventoffer->offer->store->title }}</td>
                    <td>{{ $eventoffer->offer->category->title }}</td>
                    <td>
                        @if(strcasecmp($eventoffer->offer->is_active,"y") == 0)
                        <span class="active-item">_active</span>
                        @else
                        <span class="deactive-item">deactive</span>
                        @endif
                    </td>
                    <td>
                        @if($eventoffer->offer->starting_date <= config('constants.TODAY_DATE') && ($eventoffer->offer->expiry_date >= config('constants.TODAY_DATE') || $eventoffer->offer->expiry_date == null))
                        <span class="available-offer">Available</span>
                        @elseif($eventoffer->offer->starting_date > config('constants.TODAY_DATE'))
                        <span class="pending-offer">Pending</span>
                        @elseif($eventoffer->offer->expiry_date < config('constants.TODAY_DATE'))
                        <span class="expired-offer">Expired</span>
                        @endif
                    </td>
                    <td>
                        <a href="/event/viewoffer/{{$eventoffer->id}}" id="viewoffer" class="btn btn-primary actionbutton"><i class="fa fa-eye"></i>View</a>
                        <a href="/event/deleteoffer/{{$eventoffer->id}}" id="deleteoffer" data-eventtitle="{{ $eventoffer->event->title }}" data-offertitle="{{ $eventoffer->offer->title }}" data-offerstore="{{ $eventoffer->offer->store->title }}" data-offercategory="{{ $eventoffer->offer->category->title }}" data-offerstartingdate="{{ $eventoffer->offer->starting_date }}" data-offerexpirydate="{{ $eventoffer->offer->expiry_date }}" data-offerstatus="{{ $eventoffer->offer->is_active }}" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$eventoffers->links()}}
    </div>
</div>
<script src="{{asset('js/bootbox.min.js')}}"></script>
<script src="{{asset('js/hightlighttablecolumn.js')}}"></script>
<script>
    $(document).ready(function(){
        function clientSideFilter(){
            var $rows = $('#tablebody tr');
            var eventtitle_val = $.trim($("#eventtitle").val()).replace(/ +/g, ' ').toLowerCase();
            var offertitle_val = $.trim($("#offertitle").val()).replace(/ +/g, ' ').toLowerCase();
            var storetitle_val = $.trim($("#storetitle").val()).replace(/ +/g, ' ').toLowerCase();
            var categorytitle_val = $.trim($("#categorytitle").val()).replace(/ +/g, ' ').toLowerCase();
            var offerstatus_val = $.trim($("#offerstatus").val()).replace(/ +/g, ' ').toLowerCase();
            var offerremark_val = $.trim($("#offerremark").val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var eventtitle_col = $(this).find('td:nth-child(1)').text().replace(/\s+/g, ' ').toLowerCase();
                var offertitle_col = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
                var storetitle_col = $(this).find('td:nth-child(3)').text().replace(/\s+/g, ' ').toLowerCase();
                var categorytitle_col = $(this).find('td:nth-child(4)').text().replace(/\s+/g, ' ').toLowerCase();
                var offerstatus_col = $(this).find('td:nth-child(5)').text().replace(/\s+/g, ' ').toLowerCase();
                var offerremark_col = $(this).find('td:nth-child(6)').text().replace(/\s+/g, ' ').toLowerCase();
                return !~eventtitle_col.indexOf(eventtitle_val) || 
                        !~offertitle_col.indexOf(offertitle_val) || 
                        !~storetitle_col.indexOf(storetitle_val) || 
                        !~categorytitle_col.indexOf(categorytitle_val) || 
                        !~offerstatus_col.indexOf(offerstatus_val) ||
                        !~offerremark_col.indexOf(offerremark_val)
            }).hide();
            if($("#eventtitle").val() != "" ||
                $("#offertitle").val() != "" ||
                $("#storetitle").val() != "" || 
                $("#categorytitle").val() != "" || 
                $("#offerstatus").val() != "" ||
                $("#offerremark").val() != "")
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
            $("#eventtitle").val("");
            $("#offertitle").val("");
            $("#storetitle").val("");
            $("#categorytitle").val("");
            $("#offerstatus").val("");
            $("#offerremark").val("");
            clientSideFilter();
        });
        $(".header-searchbar-filter-button").click(function(){
            if($(this).attr("id") == "eventtitle_clr_btn"){
                $("#eventtitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "offertitle_clr_btn"){
                $("#offertitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "storetitle_clr_btn"){
                $("#storetitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "categorytitle_clr_btn"){
                $("#categorytitle").val("");
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
        });
        //filter offer by date range
        $("#date-filter-container a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#cancel_modal_button").click(function(){
            $("#daterangeeventofferfilterform").trigger("reset");
            $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null, maxDate: new Date()});
        });
        $("#daterangeeventofferfilterform").submit(function(event){
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
                $("#panel-body-container").load("/event/filteredoffers/"+_dateremark+"/"+_modal_datefrom+"/"+_modal_dateto);
                $("#daterangemodal").modal('toggle');
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
                var offer_remark = null;
                var status = null;
                // alert($(this).data("offerstartingdate") + "  " + $(this).data("offerexpirydate"));
                if($(this).data("offerstartingdate") <= "{{config('constants.TODAY_DATE')}}" && ($(this).data("offerexpirydate") >= "{{config('constants.TODAY_DATE')}}" || $(this).data("offerexpirydate") == null || $(this).data("offerexpirydate") == "")){
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
                    "<b>Event:</b>  "+$(this).data("eventtitle")+"<br>"+
                    "<b>Offer Title:</b>  "+$(this).data("offertitle")+"<br>"+
                    "<b>Store:</b>  "+$(this).data("offerstore")+"<br>"+
                    "<b>Category:</b>  "+$(this).data("offercategory")+"<br>"+
                    "<b>Offer Status:</b>  "+status+
                    "<b>Offer Remark:</b>  "+offer_remark,
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