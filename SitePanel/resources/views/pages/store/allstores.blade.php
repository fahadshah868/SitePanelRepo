<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading" id="viewitems-main-heading">{{$mainheading}}<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">({{ $storescount }}<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">{{$filtereddaterange}}</span></div>
        <div class="date-filter-container" id="date-filter-container">
            <a href="/todayallstores" class="btn btn-danger viewitems-header-filter-button" title="Get Today's Stores List"><i class="fas fa-list"></i>Get Today All Stores</a>
            <a href="/allstores" class="btn btn-danger viewitems-header-filter-button" title="Get All Stores List"><i class="fas fa-list"></i>Get All Stores</a>
            <button class="btn btn-danger date-range-filter-button" title="Set Date Range To Filter Stores" data-toggle="modal" data-target="#daterangemodal"><i class="fas fa-calendar-alt"></i>Set Date Range</button>
            {{--popup to update image--}}
            <div class="modal fade" id="daterangemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form id="daterangestorefilterform" action="#" method="#">
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
                    <th>Store Title</th>
                    <th>Store Primary Url</th>
                    <th>Network</th>
                    <th>Network Url</th>
                    <th>Is TopStore</th>
                    <th>Is PopularStore</th>
                    <th>Store Status</th>
                    <th>Store Logo</th>
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
                            <input type="text" class="header-searchbar-filter" id="storeprimaryurl" placeholder="Search Primary URL" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="storeprimaryurl_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="storenetwork" placeholder="Search Network" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="storenetwork_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="storenetworkurl" placeholder="Search Network URL" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="storenetworkurl_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="istopstore" placeholder="Search Top Store" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="istopstore_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="ispopularstore" placeholder="Search Popular Store" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="ispopularstore_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="storestatus" placeholder="Search Store Status" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="storestatus_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th></th>
                    @if(Auth::User()->role == "admin")
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="store_form_add_update_by" placeholder="Search User" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="store_form_add_update_by_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="store_image_add_update_by" placeholder="Search User" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="store_image_add_update_by_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    @endif
                    <th><button class="header-searchbar-clear-filters-button" id="clear_all_filters" title="Clear All Applied Filters"><i class="fas fa-times-circle"></i>Clear All Filters</button></th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @if(count($allstores) > 0)
                    @foreach($allstores as $store)
                        <tr>
                            <td>{{ $store->title }}</td>
                            <td>{{ $store->primary_url }}</td>
                            <td>{{ $store->network->title }}</td>
                            <td>{{ $store->network_url }}</td>
                            <td>{{ $store->is_topstore }}</td>
                            <td>{{ $store->is_popularstore }}</td>
                            <td>
                                @if($store->status == "active")
                                <span class="active-item">_{{ $store->status }}</span>
                                @else
                                <span class="deactive-item">{{ $store->status }}</span>
                                @endif
                            </td>
                            <td><img src="{{asset($store->logo_url)}}"></td>
                            @if(Auth::User()->role == "admin")
                            <td>{{ $store->form_user->username }}</td>
                            <td>{{ $store->image_user->username }}</td>
                            @endif
                            <td>
                                <a href="/viewstore/{{$store->id}}" id="viewstore" class="btn btn-primary actionbutton "><i class="fa fa-eye"></i>View</a>
                                <a href="/deletestore/{{$store->id}}" data-storetitle="{{$store->title}}" data-storedescription="{{$store->description}}" data-storeprimaryurl="{{$store->primary_url}}" data-storesecondaryurl="{{$store->secondary_url}}" data-storenetwork="{{$store->network->title}}" data-storenetworkurl="{{$store->network_url}}" data-istopstore="{{$store->is_topstore}}" data-ispopularstore="{{$store->is_popularstore}}" data-storestatus="{{$store->status}}" id="deletestore" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>
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
            var storeprimaryurl_val = $.trim($("#storeprimaryurl").val()).replace(/ +/g, ' ').toLowerCase();
            var storenetwork_val = $.trim($("#storenetwork").val()).replace(/ +/g, ' ').toLowerCase();
            var storenetworkurl_val = $.trim($("#storenetworkurl").val()).replace(/ +/g, ' ').toLowerCase();
            var istopstore_val = $.trim($("#istopstore").val()).replace(/ +/g, ' ').toLowerCase();
            var ispopularstore_val = $.trim($("#ispopularstore").val()).replace(/ +/g, ' ').toLowerCase();
            var storestatus_val = $.trim($("#storestatus").val()).replace(/ +/g, ' ').toLowerCase();
            var store_form_add_update_by_val = $.trim($("#store_form_add_update_by").val()).replace(/ +/g, ' ').toLowerCase();
            var store_image_add_update_by_val = $.trim($("#store_image_add_update_by").val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var storetitle_col = $(this).find('td:nth-child(1)').text().replace(/\s+/g, ' ').toLowerCase();
                var storeprimaryurl_col = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
                var storenetwork_col = $(this).find('td:nth-child(3)').text().replace(/\s+/g, ' ').toLowerCase();
                var storenetworkurl_col = $(this).find('td:nth-child(4)').text().replace(/\s+/g, ' ').toLowerCase();
                var istopstore_col = $(this).find('td:nth-child(5)').text().replace(/\s+/g, ' ').toLowerCase();
                var ispopularstore_col = $(this).find('td:nth-child(6)').text().replace(/\s+/g, ' ').toLowerCase();
                var storestatus_col = $(this).find('td:nth-child(7)').text().replace(/\s+/g, ' ').toLowerCase();
                var store_form_add_update_by_col = $(this).find('td:nth-child(8)').text().replace(/\s+/g, ' ').toLowerCase();
                var store_image_add_update_by_col = $(this).find('td:nth-child(9)').text().replace(/\s+/g, ' ').toLowerCase();
                return !~storetitle_col.indexOf(storetitle_val) || 
                        !~storeprimaryurl_col.indexOf(storeprimaryurl_val) || 
                        !~storenetwork_col.indexOf(storenetwork_val) || 
                        !~storenetworkurl_col.indexOf(storenetworkurl_val) || 
                        !~istopstore_col.indexOf(istopstore_val) || 
                        !~ispopularstore_col.indexOf(ispopularstore_val) ||
                        !~storestatus_col.indexOf(storestatus_val) || 
                        !~store_form_add_update_by_col.indexOf(store_form_add_update_by_val) || 
                        !~store_image_add_update_by_col.indexOf(store_image_add_update_by_val);
            }).hide();
            if($("#storetitle").val() != "" || 
                $("#storeprimaryurl").val() != "" || 
                $("#storenetwork").val() != "" ||
                $("#storenetworkurl").val() != "" || 
                $("#istopstore").val() != "" || 
                $("#ispopularstore").val() != "" ||
                $("#storestatus").val() != "" || 
                $("#store_form_add_update_by").val() != "" || 
                $("#store_image_add_update_by").val() != "")
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
            $("#storeprimaryurl").val("");
            $("#storenetwork").val("");
            $("#storenetworkurl").val("");
            $("#istopstore").val("");
            $("#ispopularstore").val("");
            $("#storestatus").val("");
            $("#store_form_add_update_by").val("");
            $("#store_image_add_update_by").val("");
            clientSideFilter();
        });
        $(".header-searchbar-filter-button").click(function(){
            if($(this).attr("id") == "storetitle_clr_btn"){
                $("#storetitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "storeprimaryurl_clr_btn"){
                $("#storeprimaryurl").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "storenetwork_clr_btn"){
                $("#storenetwork").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "storenetworkurl_clr_btn"){
                $("#storenetworkurl").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "istopstore_clr_btn"){
                $("#istopstore").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "ispopularstore_clr_btn"){
                $("#ispopularstore").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "storestatus_clr_btn"){
                $("#storestatus").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "store_form_add_update_by_clr_btn"){
                $("#store_form_add_update_by").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "store_image_add_update_by_clr_btn"){
                $("#store_image_add_update_by").val("");
                clientSideFilter();
            }
        });
        //filter stores by date range
        $("#date-filter-container a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#cancel_modal_button").click(function(){
            $("#daterangestorefilterform").trigger("reset");
            $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null, maxDate: new Date()});
        });
        $("#daterangestorefilterform").submit(function(event){
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
                $("#daterangestorefilterform").trigger("reset");
                $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null,maxDate: null});
                $(".alert").css('display','none');
                $.ajax({
                    method: "GET",
                    url: "/filteredstores/"+_dateremark+"/"+_modal_datefrom+"/"+_modal_dateto,
                    data: null,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        $("#daterangemodal").modal('toggle');
                        $("#tablebody").empty();
                        $("#viewitems-main-heading").html(data.mainheading);
                        $.each(data.filteredstores, function (index, value) {
                            var html = "<tr>"+
                            "<td>"+value.title+"</td>"+
                            "<td>"+value.primary_url+"</td>"+
                            "<td>"+value.network.title+"</td>"+
                            "<td>"+value.network_url+"</td>"+
                            "<td>"+value.is_topstore+"</td>"+
                            "<td>"+value.is_popularstore+"</td>"
                            if(value.status == "active"){
                                html = html + "<td><span class='active-item'>_"+value.status+"</span></td>"
                            }
                            else{
                                html = html + "<td><span class='deactive-item'>"+value.status+"</span></td>"
                            }
                            html = html +
                            `<td><img src="{{asset("/")}}`+value.logo_url+`"></td>`
                            if('{{Auth::User()->role}}' == "admin"){
                                html = html +
                                "<td>"+value.form_user.username+"</td>"+
                                "<td>"+value.image_user.username+"</td>"
                            }
                            html = html +
                            "<td>"+
                                "<a href='/viewstore/"+value.id+"' id='viewstore' class='btn btn-primary actionbutton'><i class='fa fa-eye'></i>View</a>"+
                                "<a href='/deletestore/"+value.id+"' data-storetitle='"+value.title+"' data-storedescription='"+value.description+"' data-storeprimaryurl='"+value.primary_url+"' data-storesecondaryurl='"+value.secondary_url+"' data-storenetwork='"+value.network.title+"' data-storenetworkurl='"+value.network_url+"' data-istopstore='"+value.is_topstore+"' data-ispopularstore='"+value.is_popularstore+"' data-storestatus='"+value.status+"' id='deletestore' class='btn btn-danger actionbutton'><i class='fa fa-trash'></i>Delete</a>"+
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
            if($(this).attr("id") == "viewstore"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deletestore"){
                var url = $(this).attr("href");
                var status = null;
                if($(this).data("storestatus") == "active"){
                    status = "<span style='color: #117C00; font-weight: 600'>"+$(this).data("storestatus")+"</span><br>";
                }
                else if($(this).data("storestatus") == "deactive"){
                    status = "<span style='color: #FF0000; font-weight: 600'>"+$(this).data("storestatus")+"</span><br>";
                }
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Store Title:</b>  "+$(this).data("storetitle")+"<br>"+
                    "<b>Store Description:</b>  "+$(this).data("storedescription")+"<br>"+
                    "<b>Store Primary Url:</b>  "+$(this).data("storeprimaryurl")+"<br>"+
                    "<b>Store Secondary Url:</b>  "+$(this).data("storesecondaryurl")+"<br>"+
                    "<b>Store Network:</b>  "+$(this).data("storenetwork")+"<br>"+
                    "<b>Store Network Url:</b>  "+$(this).data("storenetworkurl")+"<br>"+
                    "<b>Is TopStore:</b>  "+$(this).data("istopstore")+"<br>"+
                    "<b>Is PopularStore:</b>  "+$(this).data("ispopularstore")+"<br>"+
                    "<b>Store Status:</b>  "+status,
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