<div class="viewitems-main-container">
<div class="viewitems-header-container">
        <div class="viewitems-main-heading" id="viewitems-main-heading">{{ $mainheading }}<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">({{ $carouselofferscount }}<span id="filtered_row_count"></span>)</span></div>
        <div class="date-filter-container" id="date-filter-container">
            <a href="/allcarouseloffers" class="btn btn-danger all-offers-filter" title="Get All Offers List"><i class="fas fa-list"></i>Get All Offers</a>
            <button class="btn btn-danger date-range-offer-filter" title="Set Date Range To Filter Offers" data-toggle="modal" data-target="#daterangemodal"><i class="fas fa-calendar-alt"></i>Set Date Range</button>
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
                                <div class="date-filter-container">
                                    <input type="text" id="offer_datefrom" name="offer_datefrom" class="form-control offer_datefrom readonly-bg-color" readonly placeholder="select From date" autocomplete="off"/>
                                    <input type="text" id="offer_dateto" name="offer_dateto" class="form-control offer_dateto readonly-bg-color" readonly placeholder="select to date" autocomplete="off"/>
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
                    @if(Auth::User()->role == "admin")
                    <th>Add/Update Form By</th>
                    <th>Add/Update Image By</th>
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
                    @if(Auth::User()->role == "admin")
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="offer_form_add_update_by" placeholder="Search User" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="offer_form_add_update_by_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="offer_image_add_update_by" placeholder="Search User" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="offer_image_add_update_by_clr_btn" title="clear">&#x2715;</button>
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
                                <td><span style="color: #FF0000; font-weight: 600;">Not Required</span></td>
                            @endif
                            <td>
                                @if($carouseloffer->status == "active")
                                <span class="active-item">{{ $carouseloffer->status }}</span>
                                @else
                                <span class="deactive-item">{{ $carouseloffer->status }}</span>
                                @endif
                            </td>
                            <td>
                            @if($carouseloffer->starting_date <= config('constants.today_date') && $carouseloffer->expiry_date >= config('constants.today_date'))
                            <span class="available-offer">Available</span>
                            @elseif($carouseloffer->starting_date > config('constants.today_date'))
                            <span class="pending-offer">Pending</span>
                            @elseif($carouseloffer->expiry_date < config('constants.today_date'))
                            <span class="expired-offer">Expired</span>
                            @endif
                            </td>
                            <td><img src="{{ asset($carouseloffer->image_url) }}" class="carouselofferimage"/></td>
                            @if(Auth::User()->role == "admin")
                            <td>{{ $carouseloffer->form_user->username }}</td>
                            <td>{{ $carouseloffer->image_user->username }}</td>
                            @endif
                            <td>
                                <a href="/viewcarouseloffer/{{$carouseloffer->id}}" id="viewcarouseloffer" class="btn btn-primary actionbutton"><i class="fa fa-eye"></i>View</a>
                                <a href="/deletecarouseloffer/{{$carouseloffer->id}}" id="deletecarouseloffer" data-storetitle="{{$carouseloffer->store->title}}" data-offertitle="{{$carouseloffer->title}}" data-offertype="{{$carouseloffer->type}}" data-offercode="{{$carouseloffer->code}}" data-offerstartingdate="{{$carouseloffer->starting_date}}" data-offerexpirydate="{{$carouseloffer->expiry_date}}" data-offerstatus="{{$carouseloffer->status}}" id="deletestore" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
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
            var offertitle_val = $.trim($("#offertitle").val()).replace(/ +/g, ' ').toLowerCase();
            var offerlocation_val = $.trim($("#offerlocation").val()).replace(/ +/g, ' ').toLowerCase();
            var offertype_val = $.trim($("#offertype").val()).replace(/ +/g, ' ').toLowerCase();
            var offercode_val = $.trim($("#offercode").val()).replace(/ +/g, ' ').toLowerCase();
            var offerstatus_val = $.trim($("#offerstatus").val()).replace(/ +/g, ' ').toLowerCase();
            var offerremark_val = $.trim($("#offerremark").val()).replace(/ +/g, ' ').toLowerCase();
            var offer_form_add_update_by_val = $.trim($("#offer_form_add_update_by").val()).replace(/ +/g, ' ').toLowerCase();
            var offer_image_add_update_by_val = $.trim($("#offer_image_add_update_by").val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var storetitle_col = $(this).find('td:nth-child(1)').text().replace(/\s+/g, ' ').toLowerCase();
                var offertitle_col = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
                var offerlocation_col = $(this).find('td:nth-child(3)').text().replace(/\s+/g, ' ').toLowerCase();
                var offertype_col = $(this).find('td:nth-child(4)').text().replace(/\s+/g, ' ').toLowerCase();
                var offercode_col = $(this).find('td:nth-child(5)').text().replace(/\s+/g, ' ').toLowerCase();
                var offerstatus_col = $(this).find('td:nth-child(6)').text().replace(/\s+/g, ' ').toLowerCase();
                var offerremark_col = $(this).find('td:nth-child(7)').text().replace(/\s+/g, ' ').toLowerCase();
                var offer_form_add_update_by_col = $(this).find('td:nth-child(9)').text().replace(/\s+/g, ' ').toLowerCase();
                var offer_image_add_update_by_col = $(this).find('td:nth-child(10)').text().replace(/\s+/g, ' ').toLowerCase();
                return !~storetitle_col.indexOf(storetitle_val) || 
                        !~offertitle_col.indexOf(offertitle_val) || 
                        !~offerlocation_col.indexOf(offerlocation_val) || 
                        !~offertype_col.indexOf(offertype_val) ||
                        !~offercode_col.indexOf(offercode_val) || 
                        !~offerstatus_col.indexOf(offerstatus_val) ||
                        !~offerremark_col.indexOf(offerremark_val) ||
                        !~offer_form_add_update_by_col.indexOf(offer_form_add_update_by_val) ||
                        !~offer_image_add_update_by_col.indexOf(offer_image_add_update_by_val);
            }).hide();
            if($("#storetitle").val() != "" || 
                $("#offertitle").val() != "" ||
                $("#offerlocation").val() != "" || 
                $("#offertype").val() != "" ||
                $("#offercode").val() != "" || 
                $("#offerstatus").val() != "" ||
                $("#offerremark").val() != "" ||
                $("#offer_form_add_update_by").val() != "" ||
                $("#offer_image_add_update_by").val() != "")
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
        var dates = $("#offer_datefrom, #offer_dateto").datepicker({
            changeYear: true,
            changeMonth: true,
            showButtonPanel: true,
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
            onSelect: function(selectedDate) {
                var option = this.id == "offer_datefrom" ? "minDate" : "maxDate",
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
            $("#offer_form_add_update_by").val("");
            $("#offer_image_add_update_by").val("");
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
            else if($(this).attr("id") == "offer_form_add_update_by_clr_btn"){
                $("#offer_form_add_update_by").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "offer_image_add_update_by_clr_btn"){
                $("#offer_image_add_update_by").val("");
                clientSideFilter();
            }
        });
        $("#daterangecarouselofferfilterform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                offer_datefrom: "required",
                offer_dateto: "required",
            },
            messages: {
                offer_datefrom: "please select from date",
                offer_dateto: "please select to date",
            },
            submitHandler: function(form) {
                var _offer_datefrom = $("#offer_datefrom").val();
                var _offer_dateto = $("#offer_dateto").val();
                $("#daterangecarouselofferfilterform").trigger("reset");
                $("#offer_datefrom , #offer_dateto").datepicker("option" , {minDate: null,maxDate: null});
                $(".alert").css('display','none');
                $.ajax({
                    method: "GET",
                    url: "/filteredcarouseloffers/"+_offer_datefrom+"/"+_offer_dateto,
                    data: null,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        $("#daterangemodal").modal('toggle');
                        $("#tablebody").empty();
                        $("#viewitems-main-heading").html(data.mainheading);
                        $("#viewitems-main-heading-count").html("("+data.offerscount+")");
                        $.each(data.filteredcarouseloffers, function (index, value) {
                            var html = "<tr>"+
                            "<td>"+value.store.title+"</td>"+
                            "<td>"+value.title+"</td>"+
                            "<td>"+value.location+"</td>"+
                            "<td>"+value.type+"</td>"
                            if(value.code != null){
                                html = html + "<td>"+value.code+"</td>"
                            }
                            else{
                                html = html + "<td><span style='color: #FF0000; font-weight: 600;'>Not Required</span></td>"
                            }
                            if(value.status == "active"){
                                html = html + "<td><span class='active-item'>"+value.status+"</span></td>"
                            }
                            else{
                                html = html + "<td><span class='deactive-item'>"+value.status+"</span></td>"
                            }
                            if(value.starting_date <= "{{config('constants.today_date')}}" && (value.expiry_date >= "{{config('constants.today_date')}}" || value.expiry_date == null)){
                                html = html + "<td><span class='available-offer'>Available</span></td>"
                            }
                            else if(value.starting_date > "{{config('constants.today_date')}}"){
                                html = html + "<td><span class='pending-offer'>Pending</span></td>"
                            }
                            else if(value.expiry_date < "{{config('constants.today_date')}}"){
                                html = html + "<td><span class='expired-offer'>Expired</span></td>"
                            }
                            html = html +
                            "<td><img src='{{ asset('/') }}"+value.image_url+"' class='carouselofferimage'/></td>"
                            if("{{Auth::User()->role}}" == "admin"){
                                html = html +
                                "<td>"+value.form_user.username+"</td>"+
                                "<td>"+value.image_user.username+"</td>"
                            }
                            html = html +
                            "<td>"+
                                "<a href='/viewcarouseloffer/"+value.id+"' id='viewcarouseloffer' class='btn btn-primary actionbutton'><i class='fa fa-eye'></i>View</a>"+
                                "<a href='/deletecarouseloffer/"+value.id+"' id='deletecarouseloffer' data-offerstore='"+value.store.title+"' data-offertitle='"+value.title+"' data-offerlocation='"+value.location+"' data-offertype='"+value.type+"' data-offercode='"+value.code+"' data-offerstartingdate='"+value.starting_date+"' data-offerexpirydate='"+value.expiry_date+"' data-offerstatus='"+value.status+"' class='btn btn-danger actionbutton'><i class='fa fa-trash'></i>Delete</a>"+
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
                    code = "<span style='color: #FF0000; font-weight: 600'>Not Required</span><br>";
                }
                if($(this).data("offerstartingdate") <= "{{config('constants.today_date')}}" && ($(this).data("offerexpirydate") >= "{{config('constants.today_date')}}" || $(this).data("offerexpirydate") == null)){
                    offer_remark = "<span class='available-offer'>Available</span><br>"
                }
                else if($(this).data("offerstartingdate") > "{{config('constants.today_date')}}"){
                    offer_remark = "<span class='pending-offer'>Pending</span><br>"
                }
                else if($(this).data("offerexpirydate") < "{{config('constants.today_date')}}"){
                    offer_remark = "<span class='expired-offer'>Expired</span><br>"
                }
                if($(this).data("offerstatus") == "active"){
                    status = "<span style='color: #117C00; font-weight: 700'>"+$(this).data("offerstatus")+"</span><br>";
                }
                else if($(this).data("offerstatus") == "deactive"){
                    status = "<span style='color: #FF0000; font-weight: 700'>"+$(this).data("offerstatus")+"</span><br>";
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