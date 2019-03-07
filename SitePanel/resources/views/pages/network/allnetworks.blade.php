<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading" id="viewitems-main-heading">All Networks<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">({{ $networkscount }}<span id="filtered_row_count"></span>)</span></div>
        <div class="date-filter-container" id="date-filter-container">
            <a href="/allnetworks" class="btn btn-danger viewitems-header-filter-button" title="Get All Offers List"><i class="fas fa-list"></i>Get All Networks</a>
            <button class="btn btn-danger date-range-offer-filter" title="Set Date Range To Filter Offers" data-toggle="modal" data-target="#daterangemodal"><i class="fas fa-calendar-alt"></i>Set Date Range</button>
            {{--popup to update image--}}
            <div class="modal fade" id="daterangemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form id="daterangenetworkfilterform" action="#" method="#">
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
                                                <input type="radio" value="created" name="dateremark" style="margin-right: 4px;" checked>New Created Record
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-field">
                                            <label class="form-field-radiobutton-remarks-label">
                                                <input type="radio" value="updated" name="dateremark" style="margin-right: 4px;">Updated Record
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
                                            <input type="text" id="offer_datefrom" name="offer_datefrom" class="form-control form-field-text readonly-bg-color" readonly placeholder="select From date" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-field">
                                            <div class="form-field-heading">Select Date To</div>
                                            <input type="text" id="offer_dateto" name="offer_dateto" class="form-control form-field-text readonly-bg-color" readonly placeholder="select to date" autocomplete="off"/>
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
    <div class="viewitems-tableview">
        <table class="table table-bordered" id="tableview">
            <thead>
                <tr>
                    <th>Network Title</th>
                    <th>Network Status</th>
                    @if(Auth::User()->role == "admin")
                    <th>Add/Update By</th>
                    @endif
                    <th>Actions</th>
                </tr>
                <tr>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="networktitle" placeholder="Search Network Title" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="networktitle_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="networkstatus" placeholder="Search Network Status" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="networkstatus_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    @if(Auth::User()->role == "admin")
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="network_add_update_by" placeholder="Search User" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="network_add_update_by_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    @endif
                    <th><button class="header-searchbar-clear-filters-button" id="clear_all_filters" title="Clear All Applied Filters"><i class="fas fa-times-circle"></i>Clear All Filters</button></th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @if(count($allnetworks) > 0)
                    @foreach($allnetworks as $network)
                    <tr>
                        <td>{{ $network->title }}</td>
                        <td>
                            @if($network->status == "active")
                            <span class="active-item">_{{ $network->status }}</span>
                            @else
                            <span class="deactive-item">{{ $network->status }}</span>
                            @endif
                        </td>
                        @if(Auth::User()->role == "admin")
                        <td>{{ $network->user->username}}</td>
                        @endif
                        <td>
                            <a href="/viewnetwork/{{$network->id}}" id="viewnetwork" class="btn btn-primary actionbutton"><i class="fa fa-eye"></i>View</a>
                            <a href="/deletenetwork/{{$network->id}}" data-networktitle='{{$network->title}}' data-networkstatus='{{$network->status}}' id="deletenetwork" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>
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
            var networktitle_val = $.trim($("#networktitle").val()).replace(/ +/g, ' ').toLowerCase();
            var networkstatus_val = $.trim($("#networkstatus").val()).replace(/ +/g, ' ').toLowerCase();
            var network_add_update_by_val = $.trim($("#network_add_update_by").val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var networktitle_col = $(this).find('td:nth-child(1)').text().replace(/\s+/g, ' ').toLowerCase();
                var networkstatus_col = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
                var network_add_update_by_col = $(this).find('td:nth-child(3)').text().replace(/\s+/g, ' ').toLowerCase();
                return !~networktitle_col.indexOf(networktitle_val) || !~networkstatus_col.indexOf(networkstatus_val) || !~network_add_update_by_col.indexOf(network_add_update_by_val);
            }).hide();
            if($("#networktitle").val() != "" || $("#networkstatus").val() != "" || $("#network_add_update_by").val() != ""){
                $("#filtered_row_count").html("/"+$("#tablebody tr:visible").length);
            }
            else{
                $("#filtered_row_count").html("");
            }
            
        }
        $(".close").click(function(){
            $(".alert").slideUp();
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
        //client side filter
        $(".header-searchbar-filter").bind('keyup input propertychange',function(){
            clientSideFilter();
        });
        $("#clear_all_filters").click(function(){
            $("#networktitle").val("");
            $("#networkstatus").val("");
            $("#network_add_update_by").val("");
            clientSideFilter();
        });
        $(".header-searchbar-filter-button").click(function(){
            if($(this).attr("id") == "networktitle_clr_btn"){
                $("#networktitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "networkstatus_clr_btn"){
                $("#networkstatus").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "network_add_update_by_clr_btn"){
                $("#network_add_update_by").val("");
                clientSideFilter();
            }
        });
        //filter offer by date range
        $("#date-filter-container a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#cancel_modal_button").click(function(){
            $("#daterangenetworkfilterform").trigger("reset");
            $("#offer_datefrom , #offer_dateto").datepicker("option" , {minDate: null, maxDate: new Date()});
        });
        $("#daterangenetworkfilterform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                offer_datefrom: "required",
                offer_dateto: "required",
                dateremark: "required",
            },
            messages: {
                offer_datefrom: "please select from date",
                offer_dateto: "please select to date",
                dateremark: "please select remark",
            },
            submitHandler: function(form) {
                var _dateremark = $("input[name='dateremark']:checked"). val();
                var _offer_datefrom = $("#offer_datefrom").val();
                var _offer_dateto = $("#offer_dateto").val();
                $("#daterangenetworkfilterform").trigger("reset");
                $("#offer_datefrom , #offer_dateto").datepicker("option" , {minDate: null,maxDate: null});
                $(".alert").css('display','none');
                $.ajax({
                    method: "GET",
                    url: "/filterednetworks/"+_dateremark+"/"+_offer_datefrom+"/"+_offer_dateto,
                    data: null,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        $("#daterangemodal").modal('toggle');
                        $("#tablebody").empty();
                        $("#viewitems-main-heading").html(data.mainheading);
                        $.each(data.filterednetworks, function (index, value) {
                            var html = "<tr>"+
                            "<td>"+value.title+"</td>"
                            if(value.status == "active"){
                                html = html + "<td><span class='active-item'>_"+value.status+"</span></td>"
                            }
                            else{
                                html = html + "<td><span class='deactive-item'>"+value.status+"</span></td>"
                            }
                            html = html +
                            "<td>"+value.user.username+"</td>"+
                            "<td>"+
                                "<a href='/viewnetwork/"+value.id+"' id='viewnetwork' class='btn btn-primary actionbutton'><i class='fa fa-eye'></i>View</a>"+
                                "<a href='/deletenetwork/"+value.id+"' id='deletenetwork' data-networktitle='"+value.title+"' data-networkstatus='"+value.status+"' class='btn btn-danger actionbutton'><i class='fa fa-trash'></i>Delete</a>"+
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
            if($(this).attr("id") == "viewnetwork"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deletenetwork"){
                var url = $(this).attr("href");
                var status = null;
                if($(this).data("networkstatus") == "active"){
                    status = "<span style='color: #117C00; font-weight: 600'>"+$(this).data("networkstatus")+"</span><br>";
                }
                else if($(this).data("networkstatus") == "deactive"){
                    status = "<span style='color: #FF0000; font-weight: 600'>"+$(this).data("networkstatus")+"</span><br>";
                }
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Network Title:</b>  "+$(this).data("networktitle")+"<br>"+
                    "<b>Network Status:</b>  "+status,
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
                                        $("#panel-body-container").load("/allnetworks");
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