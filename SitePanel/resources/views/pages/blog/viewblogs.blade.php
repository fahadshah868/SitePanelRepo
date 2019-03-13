<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading" id="viewitems-main-heading">{{$mainheading}}<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">({{ $blogscount }}<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">{{$filtereddaterange}}</span></div>
        <div class="date-filter-container" id="date-filter-container">
            <a href="/todayallblogs" class="btn btn-danger viewitems-header-filter-button" title="Get Today's Blogs List"><i class="fas fa-list"></i>Get Today All Blogs</a>
            <a href="/allblogs" class="btn btn-danger viewitems-header-filter-button" title="Get All Blogs List"><i class="fas fa-list"></i>Get All Blogs</a>
            <button class="btn btn-danger date-range-filter-button" title="Set Date Range To Filter Blogs" data-toggle="modal" data-target="#daterangemodal"><i class="fas fa-calendar-alt"></i>Set Date Range</button>
            {{--popup to update image--}}
            <div class="modal fade" id="daterangemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form id="daterangeblogfilterform" action="#" method="#">
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
                    <th>Blog Title</th>
                    <th>Blog Body</th>
                    <th>Blog Author</th>
                    <th>Blog Status</th>
                    <th>Blog Image</th>
                    @if(Auth::User()->role == "admin")
                    <th>Added/Updated Form By</th>
                    <th>Added/Updated Image By</th>
                    @endif
                    <th>Actions</th>
                </tr>
                <tr>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="blogtitle" placeholder="Search Blog Title" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="blogtitle_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="blogbody" placeholder="Search Blog Body" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="blogbody_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="blogauthor" placeholder="Search Blog Body" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="blogauthor_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="blogstatus" placeholder="Search Blog Status" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="blogstatus_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th></th>
                    @if(Auth::User()->role == "admin")
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="blog_form_added_updated_by" placeholder="Search User" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="blog_form_added_updated_by_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="blog_image_added_updated_by" placeholder="Search User" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="blog_image_added_updated_by_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    @endif
                    <th><button class="header-searchbar-clear-filters-button" id="clear_all_filters" title="Clear All Applied Filters"><i class="fas fa-times-circle"></i>Clear All Filters</button></th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @if(count($allblogs) > 0)
                    @foreach($allblogs as $blog)
                        <tr>
                            <td><div class="blog-title-container">{{ $blog->title }}</div></td>
                            <td><div class="blog-body-container">{!! $blog->body !!}</div></td>
                            <td>{{ $blog->author }}</td>
                            <td>
                                @if($blog->status == "active")
                                <span class="active-item">_{{ $blog->status }}</span>
                                @else
                                <span class="deactive-item">{{ $blog->status }}</span>
                                @endif
                            </td>
                            <td><img class="blog_image_preview" src="{{asset($blog->image_url)}}"></td>
                            @if(Auth::User()->role == "admin")
                            <td>{{ $blog->form_user->username }}</td>
                            <td>{{ $blog->image_user->username }}</td>
                            @endif
                            <td>
                                <a href="/viewblog/{{$blog->id}}" id="viewblog" class="btn btn-primary actionbutton "><i class="fa fa-eye"></i>View</a>
                                <a href="/deleteblog/{{$blog->id}}" data-blogtitle="{{$blog->title}}" data-blogbody="{{$blog->body}}" data-blogauthor="{{$blog->author}}" data-blogstatus="{{$blog->status}}" id="deleteblog" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>
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
            var blogtitle_val = $.trim($("#blogtitle").val()).replace(/ +/g, ' ').toLowerCase();
            var blogbody_val = $.trim($("#blogbody").val()).replace(/ +/g, ' ').toLowerCase();
            var blogauthor_val = $.trim($("#blogauthor").val()).replace(/ +/g, ' ').toLowerCase();
            var blogstatus_val = $.trim($("#blogstatus").val()).replace(/ +/g, ' ').toLowerCase();
            var blog_form_added_updated_by_val = $.trim($("#blog_form_added_updated_by").val()).replace(/ +/g, ' ').toLowerCase();
            var blog_image_added_updated_by_val = $.trim($("#blog_image_added_updated_by").val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var blogtitle_col = $(this).find('td:nth-child(1)').text().replace(/\s+/g, ' ').toLowerCase();
                var blogbody_col = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
                var blogauthor_col = $(this).find('td:nth-child(3)').text().replace(/\s+/g, ' ').toLowerCase();
                var blogstatus_col = $(this).find('td:nth-child(4)').text().replace(/\s+/g, ' ').toLowerCase();
                var blog_form_added_updated_by_col = $(this).find('td:nth-child(6)').text().replace(/\s+/g, ' ').toLowerCase();
                var blog_image_added_updated_by_col = $(this).find('td:nth-child(7)').text().replace(/\s+/g, ' ').toLowerCase();
                return !~blogtitle_col.indexOf(blogtitle_val) || 
                        !~blogbody_col.indexOf(blogbody_val) || 
                        !~blogauthor_col.indexOf(blogauthor_val) || 
                        !~blogstatus_col.indexOf(blogstatus_val) || 
                        !~blog_form_added_updated_by_col.indexOf(blog_form_added_updated_by_val) || 
                        !~blog_image_added_updated_by_col.indexOf(blog_image_added_updated_by_val);
            }).hide();
            if($("#blogtitle").val() != "" || 
                $("#blogbody").val() != "" || 
                $("#blogauthor").val() != "" || 
                $("#blogstatus").val() != "" ||
                $("#blog_form_added_updated_by").val() != "" || 
                $("#blog_image_added_updated_by").val() != "")
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
            $("#blogtitle").val("");
            $("#blogbody").val("");
            $("#blogauthor").val("");
            $("#blogstatus").val("");
            $("#blog_form_added_updated_by").val("");
            $("#blog_image_added_updated_by").val("");
            clientSideFilter();
        });
        $(".header-searchbar-filter-button").click(function(){
            if($(this).attr("id") == "blogtitle_clr_btn"){
                $("#blogtitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "blogbody_clr_btn"){
                $("#blogbody").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "blogauthor_clr_btn"){
                $("#blogauthor").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "blogstatus_clr_btn"){
                $("#blogstatus").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "blog_form_added_updated_by_clr_btn"){
                $("#blog_form_added_updated_by").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "blog_image_added_updated_by_clr_btn"){
                $("#blog_image_added_updated_by").val("");
                clientSideFilter();
            }
        });
        //filter blogs by date range
        $("#date-filter-container a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#cancel_modal_button").click(function(){
            $("#daterangeblogfilterform").trigger("reset");
            $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null, maxDate: new Date()});
        });
        $("#daterangeblogfilterform").submit(function(event){
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
                $("#daterangeblogfilterform").trigger("reset");
                $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null,maxDate: null});
                $(".alert").css('display','none');
                $.ajax({
                    method: "GET",
                    url: "/filteredblogs/"+_dateremark+"/"+_modal_datefrom+"/"+_modal_dateto,
                    data: null,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        $("#daterangemodal").modal('toggle');
                        $("#tablebody").empty();
                        $("#viewitems-main-heading").html(data.mainheading);
                        $.each(data.filteredblogs, function (index, value) {
                            var html = "<tr>"+
                            "<td><div class='blog-title-container'>"+value.title+"</div></td>"+
                            "<td><div class='blog-body-container'>"+value.body+"</div></td>"+
                            "<td>"+value.author+"</td>"
                            if(value.status == "active"){
                                html = html + "<td><span class='active-item'>_"+value.status+"</span></td>"
                            }
                            else{
                                html = html + "<td><span class='deactive-item'>"+value.status+"</span></td>"
                            }
                            html = html +
                            `<td><img src="{{asset("/")}}`+value.image_url+`" class='blog_image_preview'></td>`
                            if('{{Auth::User()->role}}' == "admin"){
                                html = html +
                                "<td>"+value.form_user.username+"</td>"+
                                "<td>"+value.image_user.username+"</td>"
                            }
                            html = html +
                            "<td>"+
                                "<a href='/viewblog/"+value.id+"' id='viewblog' class='btn btn-primary actionbutton'><i class='fa fa-eye'></i>View</a>"+
                                "<a href='/deleteblog/"+value.id+"' data-blogtitle='"+value.title+"' data-blogbody='"+value.body+"' data-blogauthor='"+value.author+"' data-blogstatus='"+value.status+"' id='deleteblog' class='btn btn-danger actionbutton'><i class='fa fa-trash'></i>Delete</a>"+
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
            if($(this).attr("id") == "viewblog"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deleteblog"){
                var url = $(this).attr("href");
                var status = null;
                if($(this).data("blogstatus") == "active"){
                    status = "<span class='active-item'>_"+$(this).data("blogstatus")+"</span><br>";
                }
                else if($(this).data("blogstatus") == "deactive"){
                    status = "<span class='deactive-item'>"+$(this).data("blogstatus")+"</span><br>";
                }
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Blog Title:</b>  "+$(this).data("blogtitle")+"<br>"+
                    "<b>Blog Body:</b>  "+$(this).data("blogbody")+"<br>"+
                    "<b>Blog Author:</b>  "+$(this).data("blogauthor")+"<br>"+
                    "<b>Blog Status:</b>  "+status,
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