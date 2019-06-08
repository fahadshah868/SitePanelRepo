<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading" id="viewitems-main-heading">{{$mainheading}}<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">({{ $eventscount }}<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">{{$filtereddaterange}}</span></div>
        <div class="date-filter-container" id="date-filter-container">
            <a href="/allevents" class="btn btn-danger viewitems-header-filter-button" title="Get All Events List"><i class="fas fa-list"></i>Get All Events</a>
            <button class="btn btn-danger date-range-filter-button" title="Set Date Range To Filter Categories" data-toggle="modal" data-target="#daterangemodal"><i class="fas fa-calendar-alt"></i>Set Date Range</button>
            {{--popup to update image--}}
            <div class="modal fade" id="daterangemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form id="daterangeeventfilterform" action="#" method="#">
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
                    <th>Event Title</th>
                    <th>Display In Footer</th>
                    <th>Is Ready</th>
                    <th>Event Status</th>
                    @if(strcasecmp(Auth::User()->role,"admin") == 0)
                    <th>Added/Updated By</th>
                    @endif
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
                            <input type="text" class="header-searchbar-filter" id="displayinfooter" placeholder="Search Top Event" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="displayinfooter_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="iseventready" placeholder="Search Ready Event" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="iseventready_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="eventstatus" placeholder="Search Event Status" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="eventstatus_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    @if(strcasecmp(Auth::User()->role,"admin") == 0)
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="event_added_updated_by" placeholder="Search User" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="event_added_updated_by_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    @endif
                    <th><button class="header-searchbar-clear-filters-button" id="clear_all_filters" title="Clear All Applied Filters"><i class="fas fa-times-circle"></i>Clear All Filters</button></th>
                </tr>
            </thead>
            <tbody id="tablebody">
            @if(count($allevents) > 0)
                @foreach($allevents as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->display_in_footer }}</td>
                        <td>{{ $event->is_ready }}</td>
                        <td>
                            @if(strcasecmp($event->is_active,"y") == 0)
                            <span class="active-item">_active</span>
                            @else
                            <span class="deactive-item">deactive</span>
                            @endif
                        </td>
                        @if(strcasecmp(Auth::User()->role,"admin") == 0)
                        <td>{{ $event->user->username}}</td>
                        @endif
                        <td>
                            <a href="/viewevent/{{$event->id}}" id="viewevent" class="btn btn-primary actionbutton"><i class="fa fa-eye"></i>View</a>
                            <a href="/deleteevent/{{$event->id}}" data-eventtitle='{{$event->title}}' data-displayinfooter='{{$event->display_in_footer}}' data-iseventready='{{$event->is_ready}}' data-eventstatus='{{$event->is_active}}' id="deleteevent" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>
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
            var eventtitle_val = $.trim($("#eventtitle").val()).replace(/ +/g, ' ').toLowerCase();
            var displayinfooter_val = $.trim($("#displayinfooter").val()).replace(/ +/g, ' ').toLowerCase();
            var iseventready_val = $.trim($("#iseventready").val()).replace(/ +/g, ' ').toLowerCase();
            var eventstatus_val = $.trim($("#eventstatus").val()).replace(/ +/g, ' ').toLowerCase();
            var event_added_updated_by_val = $.trim($("#event_added_updated_by").val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var eventtitle_col = $(this).find('td:nth-child(1)').text().replace(/\s+/g, ' ').toLowerCase();
                var displayinfooter_col = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
                var iseventready_col = $(this).find('td:nth-child(3)').text().replace(/\s+/g, ' ').toLowerCase();
                var eventstatus_col = $(this).find('td:nth-child(4)').text().replace(/\s+/g, ' ').toLowerCase();
                var event_added_updated_by_col = $(this).find('td:nth-child(5)').text().replace(/\s+/g, ' ').toLowerCase();
                return !~eventtitle_col.indexOf(eventtitle_val) || 
                        !~displayinfooter_col.indexOf(displayinfooter_val) || 
                        !~iseventready_col.indexOf(iseventready_val) || 
                        !~eventstatus_col.indexOf(eventstatus_val) || 
                        !~event_added_updated_by_col.indexOf(event_added_updated_by_val);
            }).hide();
            if($("#eventtitle").val() != "" || 
                $("#displayinfooter").val() != "" || 
                $("#iseventready").val() != "" ||
                $("#eventstatus").val() != "" || 
                $("#event_added_updated_by").val() != "")
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
            $("#displayinfooter").val("");
            $("#iseventready").val("");
            $("#eventstatus").val("");
            $("#event_added_updated_by").val("");
            clientSideFilter();
        });
        $(".header-searchbar-filter-button").click(function(){
            if($(this).attr("id") == "eventtitle_clr_btn"){
                $("#eventtitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "displayinfooter_clr_btn"){
                $("#displayinfooter").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "iseventready_clr_btn"){
                $("#iseventready").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "eventstatus_clr_btn"){
                $("#eventstatus").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "event_added_updated_by_clr_btn"){
                $("#event_added_updated_by").val("");
                clientSideFilter();
            }
        });
        //filter categories by date range
        $("#date-filter-container a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#cancel_modal_button").click(function(){
            $("#daterangeeventfilterform").trigger("reset");
            $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null, maxDate: new Date()});
        });
        $("#daterangeeventfilterform").submit(function(event){
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
                $("#daterangeeventfilterform").trigger("reset");
                $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null,maxDate: null});
                $(".alert").css('display','none');
                $.ajax({
                    method: "GET",
                    url: "/filteredevents/"+_dateremark+"/"+_modal_datefrom+"/"+_modal_dateto,
                    data: null,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        $("#daterangemodal").modal('toggle');
                        $("#tablebody").empty();
                        $("#viewitems-main-heading").html(data.mainheading);
                        $.each(data.filteredevents, function (index, value) {
                            var html = "<tr>"+
                            "<td>"+value.title+"</td>"+
                            "<td>"+value.display_in_footer+"</td>"+
                            "<td>"+value.is_eventready+"</td>"
                            if(value.is_active == "y"){
                                html = html + "<td><span class='active-item'>_active</span></td>"
                            }
                            else{
                                html = html + "<td><span class='deactive-item'>deactive</span></td>"
                            }
                            if('{{Auth::User()->role}}' == "admin"){
                                html = html +
                                "<td>"+value.user.username+"</td>"
                            }
                            html = html +
                            "<td>"+
                                "<a href='/viewevent/"+value.id+"' id='viewevent' class='btn btn-primary actionbutton'><i class='fa fa-eye'></i>View</a>"+
                                "<a href='/deleteevent/"+value.id+"' data-eventtitle='"+value.title+"' data-displayinfooter='"+value.display_in_footer+"' data-iseventready='"+value.is_ready+"' data-eventstatus='"+value.is_active+"' id='deleteevent' class='btn btn-danger actionbutton'><i class='fa fa-trash'></i>Delete</a>"+
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
            if($(this).attr("id") == "viewevent"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deleteevent"){
                var url = $(this).attr("href");
                var status = null;
                if($(this).data("eventstatus") == "y"){
                    status = "<span class='active-item'>_active</span><br>";
                }
                else if($(this).data("eventstatus") == "n"){
                    status = "<span class='deactive-item'>deactive</span><br>";
                }
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Event Title:</b>  "+$(this).data("eventtitle")+"<br>"+
                    "<b>Is TopEvent:</b>  "+$(this).data("displayinfooter")+"<br>"+
                    "<b>Is Event Ready:</b>  "+$(this).data("iseventready")+"<br>"+
                    "<b>Event Status:</b>  "+status,
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