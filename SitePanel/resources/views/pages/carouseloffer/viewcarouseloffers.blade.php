<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading" id="viewitems-main-heading">{{$mainheading}}<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">({{ $allcarouseloffers->total() }}<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">{{$filtereddaterange}}</span></div>
        <div class="date-filter-container" id="date-filter-container">
            <a href="/todayallcarouseloffers" class="btn btn-danger viewitems-header-filter-button" title="Get Today All Carousel Offers List"><i class="fas fa-list"></i>Get Today's Carousel Offers</a>
            <a href="/allcarouseloffers" class="btn btn-danger viewitems-header-filter-button" title="Get All Carousel Offers List"><i class="fas fa-list"></i>Get All Carousel Offers</a>
            <button class="btn btn-danger date-range-filter-button" title="Set Date Range To Filter Offers" data-toggle="modal" data-target="#daterangemodal"><i class="fas fa-calendar-alt"></i>Set Date Range</button>
            {{--popup to update image--}}
            <div class="modal fade" id="daterangemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form id="daterangecarouselofferfilterform" action="#" method="#">
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
    <hr id="horizontal-line">
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    {{$allcarouseloffers->links()}}
    <div class="viewitems-tableview">
        <table class="table table-bordered" id="tableview">
            <thead>
                <tr>
                    <th>Store Title</th>
                    <th>Offer Title</th>
                    <th>Offer Location</th>
                    <th>Offer Type</th>
                    <th>Offer Code</th>
                    <th>Offer Status</th>
                    <th>Offer Remark</th>
                    <th>Image</th>
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
                            <input type="text" class="header-searchbar-filter" id="offertitle" placeholder="Search Offer Title" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="offertitle_clr_btn" title="clear">&#x2715;</button>
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
                    <th></th>
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
                @if(count($allcarouseloffers) > 0)
                    @foreach($allcarouseloffers as $carouseloffer)
                        <tr>
                            <td>{{ $carouseloffer->store->title }}</td>
                            <td>{{ $carouseloffer->title }}</td>
                            <td>{{ $carouseloffer->location }}</td>
                            <td>{{ $carouseloffer->type }}</td>
                            @if($carouseloffer->code != null)
                                <td>{{ $carouseloffer->code }}</td>
                            @else
                                <td><span class="not-required-yet">Not Required</span></td>
                            @endif
                            <td>
                                @if(strcasecmp($carouseloffer->is_active,"y") == 0)
                                <span class="active-item">_active</span>
                                @else
                                <span class="deactive-item">deactive</span>
                                @endif
                            </td>
                            <td>
                            @if($carouseloffer->starting_date <= config('constants.TODAY_DATE') && ($carouseloffer->expiry_date >= config('constants.TODAY_DATE') || $carouseloffer->expiry_date == null))
                            <span class="available-offer">Available</span>
                            @elseif($carouseloffer->starting_date > config('constants.TODAY_DATE'))
                            <span class="pending-offer">Pending</span>
                            @elseif($carouseloffer->expiry_date < config('constants.TODAY_DATE'))
                            <span class="expired-offer">Expired</span>
                            @endif
                            </td>
                            <td><img src="{{ asset($carouseloffer->image_url) }}" class="carousel_image_preview"/></td>
                            @if(strcasecmp(Auth::User()->role,"admin") == 0)
                            <td>{{ $carouseloffer->user->username }}</td>
                            @endif
                            <td>
                                <a href="/viewcarouseloffer/{{$carouseloffer->id}}" id="viewcarouseloffer" class="btn btn-primary actionbutton"><i class="fa fa-eye"></i>View</a>
                                <a href="/deletecarouseloffer/{{$carouseloffer->id}}" id="deletecarouseloffer" data-storetitle="{{$carouseloffer->store->title}}" data-offertitle="{{$carouseloffer->title}}" data-offerlocation="{{$carouseloffer->location}}" data-offertype="{{$carouseloffer->type}}" data-offercode="{{$carouseloffer->code}}" data-offerstartingdate="{{$carouseloffer->starting_date}}" data-offerexpirydate="{{$carouseloffer->expiry_date}}" data-offerstatus="{{$carouseloffer->is_active}}" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{$allcarouseloffers->links()}}
    </div>
</div>
<script src="{{asset('js/bootbox.min.js')}}"></script>
<script src="{{asset('js/hightlighttablecolumn.js')}}"></script>
<script>
    $(document).ready(function(){
        // pagination via jquery
        $(`.pagination li a`).click(function(e) {
            e.preventDefault();
            var url = $(this).attr(`href`);
            getArticles(url);
        });
        function getArticles(url) {
            $.ajax({
                url : url,
                type: 'GET',
            }).done(function (data) {
                $(`#panel-body-container`).html(data);
                $('html, body').animate({
                    scrollTop: $("hr#horizontal-line").offset().top
                }, 500)
            }).fail(function () {
                alert(`something went wrong.`);
            });
        }
        // table filters
        function clientSideFilter(){
            var $rows = $('#tablebody tr');
            var storetitle_val = $.trim($("#storetitle").val()).replace(/ +/g, ' ').toLowerCase();
            var offertitle_val = $.trim($("#offertitle").val()).replace(/ +/g, ' ').toLowerCase();
            var offerlocation_val = $.trim($("#offerlocation").val()).replace(/ +/g, ' ').toLowerCase();
            var offertype_val = $.trim($("#offertype").val()).replace(/ +/g, ' ').toLowerCase();
            var offercode_val = $.trim($("#offercode").val()).replace(/ +/g, ' ').toLowerCase();
            var offerstatus_val = $.trim($("#offerstatus").val()).replace(/ +/g, ' ').toLowerCase();
            var offerremark_val = $.trim($("#offerremark").val()).replace(/ +/g, ' ').toLowerCase();
            var offer_added_updated_by_val = $.trim($("#offer_added_updated_by").val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var storetitle_col = $(this).find('td:nth-child(1)').text().replace(/\s+/g, ' ').toLowerCase();
                var offertitle_col = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
                var offerlocation_col = $(this).find('td:nth-child(3)').text().replace(/\s+/g, ' ').toLowerCase();
                var offertype_col = $(this).find('td:nth-child(4)').text().replace(/\s+/g, ' ').toLowerCase();
                var offercode_col = $(this).find('td:nth-child(5)').text().replace(/\s+/g, ' ').toLowerCase();
                var offerstatus_col = $(this).find('td:nth-child(6)').text().replace(/\s+/g, ' ').toLowerCase();
                var offerremark_col = $(this).find('td:nth-child(7)').text().replace(/\s+/g, ' ').toLowerCase();
                var offer_added_updated_by_col = $(this).find('td:nth-child(9)').text().replace(/\s+/g, ' ').toLowerCase();
                return !~storetitle_col.indexOf(storetitle_val) || 
                        !~offertitle_col.indexOf(offertitle_val) || 
                        !~offerlocation_col.indexOf(offerlocation_val) || 
                        !~offertype_col.indexOf(offertype_val) ||
                        !~offercode_col.indexOf(offercode_val) || 
                        !~offerstatus_col.indexOf(offerstatus_val) ||
                        !~offerremark_col.indexOf(offerremark_val) ||
                        !~offer_added_updated_by_col.indexOf(offer_added_updated_by_val);
            }).hide();
            if($("#storetitle").val() != "" || 
                $("#offertitle").val() != "" ||
                $("#offerlocation").val() != "" || 
                $("#offertype").val() != "" ||
                $("#offercode").val() != "" || 
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
        $("#date-filter-container a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
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
            $("#offertitle").val("");
            $("#offerlocation").val("");
            $("#offertype").val("");
            $("#offercode").val("");
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
            else if($(this).attr("id") == "offertitle_clr_btn"){
                $("#offertitle").val("");
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
        $("#daterangecarouselofferfilterform").submit(function(event){
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
                $("#panel-body-container").load("/filteredcarouseloffers/"+_dateremark+"/"+_modal_datefrom+"/"+_modal_dateto);
                $("#daterangemodal").modal('toggle');
                return false;
            }
        });
        //navigation buttons actions
        $("#tablebody").on("click","a.actionbutton",function(event){
            event.preventDefault();
            if($(this).attr("id") == "viewcarouseloffer"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deletecarouseloffer"){
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
                    "<b>Store Title:</b>  "+$(this).data("storetitle")+"<br>"+
                    "<b>Offer Title:</b>  "+$(this).data("offertitle")+"<br>"+
                    "<b>Offer Location:</b>  "+$(this).data("offerlocation")+"<br>"+
                    "<b>Offer Type:</b>  "+$(this).data("offertype")+"<br>"+
                    "<b>Offer Code:</b>  "+code+
                    "<b>Offer Remark:</b>  "+offer_remark+
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
                                cache: false,
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