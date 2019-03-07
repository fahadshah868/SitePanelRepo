<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading" id="viewitems-main-heading">{{ $mainheading }}<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">({{ $categoriescount }}<span id="filtered_row_count"></span>)</span></div>
        <div class="date-filter-container" id="date-filter-container">
            <a href="/todayallcategories" class="btn btn-danger viewitems-header-filter-button" title="Get Today's Categories List"><i class="fas fa-list"></i>Get Today All Categories</a>
            <a href="/allcategories" class="btn btn-danger viewitems-header-filter-button" title="Get All Categories List"><i class="fas fa-list"></i>Get All Categories</a>
            <button class="btn btn-danger date-range-filter-button" title="Set Date Range To Filter Categories" data-toggle="modal" data-target="#daterangemodal"><i class="fas fa-calendar-alt"></i>Set Date Range</button>
            {{--popup to update image--}}
            <div class="modal fade" id="daterangemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form id="daterangecategoryfilterform" action="#" method="#">
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
                    <th>Category Title</th>
                    <th>Is TopCategory</th>
                    <th>Is PopularCategory</th>
                    <th>Category Status</th>
                    <th>Category Logo</th>
                    @if(Auth::User()->role == "admin")
                    <th>Add/Update Form By</th>
                    <th>Add/Update Image By</th>
                    @endif
                    <th>Actions</th>
                </tr>
                <tr>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="categorytitle" placeholder="Search Category Title" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="categorytitle_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="istopcategory" placeholder="Search Top Category" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="istopcategory_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="ispopularcategory" placeholder="Search Popular Category" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="ispopularcategory_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="categorystatus" placeholder="Search Category Status" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="categorystatus_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th></th>
                    @if(Auth::User()->role == "admin")
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="category_form_add_update_by" placeholder="Search User" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="category_form_add_update_by_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="category_image_add_update_by" placeholder="Search User" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="category_image_add_update_by_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    @endif
                    <th><button class="header-searchbar-clear-filters-button" id="clear_all_filters" title="Clear All Applied Filters"><i class="fas fa-times-circle"></i>Clear All Filters</button></th>
                </tr>
            </thead>
            <tbody id="tablebody">
            @if(count($allcategories) > 0)
                @foreach($allcategories as $category)
                    <tr>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->is_topcategory }}</td>
                        <td>{{ $category->is_popularcategory }}</td>
                        <td>
                            @if($category->status == "active")
                            <span class="active-item">_{{ $category->status }}</span>
                            @else
                            <span class="deactive-item">{{ $category->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if($category->is_topcategory == "yes")
                            <img src="{{ asset($category->logo_url) }}"/>
                            @else
                            <b>N/A</b>
                            @endif
                        </td>
                        @if(Auth::User()->role == "admin")
                        <td>{{ $category->form_user->username}}</td>
                        <td>{{ $category->image_user->username}}</td>
                        @endif
                        <td>
                            <a href="/viewcategory/{{$category->id}}" id="viewcategory" class="btn btn-primary actionbutton"><i class="fa fa-eye"></i>View</a>
                            <a href="/deletecategory/{{$category->id}}" data-categorytitle='{{$category->title}}' data-categorydescription="{{$category->description}}" data-istopcategory='{{$category->is_topcategory}}' data-ispopularcategory='{{$category->is_popularcategory}}' data-categorystatus='{{$category->status}}' id="deletecategory" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>
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
            var categorytitle_val = $.trim($("#categorytitle").val()).replace(/ +/g, ' ').toLowerCase();
            var istopcategory_val = $.trim($("#istopcategory").val()).replace(/ +/g, ' ').toLowerCase();
            var ispopularcategory_val = $.trim($("#ispopularcategory").val()).replace(/ +/g, ' ').toLowerCase();
            var categorystatus_val = $.trim($("#categorystatus").val()).replace(/ +/g, ' ').toLowerCase();
            var category_form_add_update_by_val = $.trim($("#category_form_add_update_by").val()).replace(/ +/g, ' ').toLowerCase();
            var category_image_add_update_by_val = $.trim($("#category_image_add_update_by").val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var categorytitle_col = $(this).find('td:nth-child(1)').text().replace(/\s+/g, ' ').toLowerCase();
                var istopcategory_col = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
                var ispopularcategory_col = $(this).find('td:nth-child(3)').text().replace(/\s+/g, ' ').toLowerCase();
                var categorystatus_col = $(this).find('td:nth-child(4)').text().replace(/\s+/g, ' ').toLowerCase();
                var category_form_add_update_by_col = $(this).find('td:nth-child(6)').text().replace(/\s+/g, ' ').toLowerCase();
                var category_image_add_update_by_col = $(this).find('td:nth-child(7)').text().replace(/\s+/g, ' ').toLowerCase();
                return !~categorytitle_col.indexOf(categorytitle_val) || 
                        !~istopcategory_col.indexOf(istopcategory_val) || 
                        !~ispopularcategory_col.indexOf(ispopularcategory_val) || 
                        !~categorystatus_col.indexOf(categorystatus_val) || 
                        !~category_form_add_update_by_col.indexOf(category_form_add_update_by_val) || 
                        !~category_image_add_update_by_col.indexOf(category_image_add_update_by_val);
            }).hide();

            if($("#categorytitle").val() != "" || 
                $("#istopcategory").val() != "" || 
                $("#ispopularcategory").val() != "" ||
                $("#categorystatus").val() != "" || 
                $("#category_form_add_update_by").val() != "" || 
                $("#category_image_add_update_by").val() != "")
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
            $("#categorytitle").val("");
            $("#istopcategory").val("");
            $("#ispopularcategory").val("");
            $("#categorystatus").val("");
            $("#category_form_add_update_by").val("");
            $("#category_image_add_update_by").val("");
            clientSideFilter();
        });
        $(".header-searchbar-filter-button").click(function(){
            if($(this).attr("id") == "categorytitle_clr_btn"){
                $("#categorytitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "istopcategory_clr_btn"){
                $("#istopcategory").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "ispopularcategory_clr_btn"){
                $("#ispopularcategory").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "categorystatus_clr_btn"){
                $("#categorystatus").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "category_form_add_update_by_clr_btn"){
                $("#category_form_add_update_by").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "category_image_add_update_by_clr_btn"){
                $("#category_image_add_update_by").val("");
                clientSideFilter();
            }
        });
        //filter categories by date range
        $("#date-filter-container a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#cancel_modal_button").click(function(){
            $("#daterangecategoryfilterform").trigger("reset");
            $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null, maxDate: new Date()});
        });
        $("#daterangecategoryfilterform").submit(function(event){
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
                $("#daterangecategoryfilterform").trigger("reset");
                $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null,maxDate: null});
                $(".alert").css('display','none');
                $.ajax({
                    method: "GET",
                    url: "/filteredcategories/"+_dateremark+"/"+_modal_datefrom+"/"+_modal_dateto,
                    data: null,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        $("#daterangemodal").modal('toggle');
                        $("#tablebody").empty();
                        $("#viewitems-main-heading").html(data.mainheading);
                        $.each(data.filteredcategories, function (index, value) {
                            var html = "<tr>"+
                            "<td>"+value.title+"</td>"+
                            "<td>"+value.is_topcategory+"</td>"+
                            "<td>"+value.is_popularcategory+"</td>"
                            if(value.status == "active"){
                                html = html + "<td><span class='active-item'>_"+value.status+"</span></td>"
                            }
                            else{
                                html = html + "<td><span class='deactive-item'>"+value.status+"</span></td>"
                            }
                            if(value.is_topcategory == "yes"){
                                html = html + 
                                `<td><img src="{{asset("/")}}`+value.logo_url+`"></td>`
                            }
                            else{
                                html = html +
                                "<td><br>N/A</br></td>"
                            }
                            if('{{Auth::User()->role}}' == "admin"){
                                html = html +
                                "<td>"+value.form_user.username+"</td>"+
                                "<td>"+value.image_user.username+"</td>"
                            }
                            html = html +
                            "<td>"+
                                "<a href='/viewcategory/"+value.id+"' id='viewcategory' class='btn btn-primary actionbutton'><i class='fa fa-eye'></i>View</a>"+
                                "<a href='/deletecategory/"+value.id+"' data-categorytitle='{{$category->title}}' data-categorydescription='"+value.description+"' data-istopcategory='"+value.is_topcategory+"' data-ispopularcategory='"+value.is_popularcategory+"' data-categorystatus='"+value.status+"' id='deletecategory' class='btn btn-danger actionbutton'><i class='fa fa-trash'></i>Delete</a>"+
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
            if($(this).attr("id") == "viewcategory"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deletecategory"){
                var url = $(this).attr("href");
                var status = null;
                if($(this).data("categorystatus") == "active"){
                    status = "<span style='color: #117C00; font-weight: 600'>"+$(this).data("categorystatus")+"</span><br>";
                }
                else if($(this).data("categorystatus") == "deactive"){
                    status = "<span style='color: #FF0000; font-weight: 600'>"+$(this).data("categorystatus")+"</span><br>";
                }
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Category Title:</b>  "+$(this).data("categorytitle")+"<br>"+
                    "<b>Category Description:</b>  "+$(this).data("categorydescription")+"<br>"+
                    "<b>Is TopCategory:</b>  "+$(this).data("istopcategory")+"<br>"+
                    "<b>Is PopularCategory:</b>  "+$(this).data("ispopularcategory")+"<br>"+
                    "<b>Category Status:</b>  "+status,
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
                                        $("#panel-body-container").load("/allcategories");
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