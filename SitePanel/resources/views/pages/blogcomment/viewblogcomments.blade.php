<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading" id="viewitems-main-heading">{{$mainheading}}<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">({{ $blogcommentscount }}<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">{{$filtereddaterange}}</span></div>
        <div class="date-filter-container" id="date-filter-container">
            <a href="/allblogcomments" class="btn btn-danger viewitems-header-filter-button" title="Get All Blog Comments List"><i class="fas fa-list"></i>Get All Bog Comments</a>
            <button class="btn btn-danger date-range-filter-button" title="Set Date Range To Filter Blog Comments" data-toggle="modal" data-target="#daterangemodal"><i class="fas fa-calendar-alt"></i>Set Date Range</button>
            {{--popup to update image--}}
            <div class="modal fade" id="daterangemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form id="daterangeblogcommentfilterform" action="#" method="#">
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
                    <th>blog Title</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Body</th>
                    <th>Status</th>
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
                            <input type="text" class="header-searchbar-filter" id="commentauthor" placeholder="Search Author" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="commentauthor_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="commentauthoremail" placeholder="Search Email" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="commentauthoremail_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="commentbody" placeholder="Search Comment" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="commentbody_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="blogcommentstatus" placeholder="Search Comment Status" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="commentstatus_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th><button class="header-searchbar-clear-filters-button" id="clear_all_filters" title="Clear All Applied Filters"><i class="fas fa-times-circle"></i>Clear All Filters</button></th>
                </tr>
            </thead>
            <tbody id="tablebody">
                @if(count($allblogcomments) > 0)
                    @foreach($allblogcomments as $blogcomment)
                    <tr>
                        <td>{{ $blogcomment->blog->title }}</td>
                        <td>{{ $blogcomment->author }}</td>
                        <td>{{ $blogcomment->email }}</td>
                        <td>{{ $blogcomment->body }}</td>
                        <td class="comment-status">
                            @if(strcasecmp($blogcomment->status,"pending") == 0)
                                <span class="pending-comment">{{ $blogcomment->status }}</span>
                            @elseif(strcasecmp($blogcomment->status,"approved") == 0)
                                <span class="approved-comment">{{ $blogcomment->status }}</span>
                            @elseif(strcasecmp($blogcomment->status,"rejected") == 0)
                                <span class="rejected-comment">{{ $blogcomment->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if(strcasecmp($blogcomment->status,"pending") == 0)
                            <div id="approval-actions" class="action-buttons-container">
                                <a href="/updateblogcomment" id="changecommentstatus" data-blogcommentid="{{$blogcomment->id}}" data-blogcommentstatus="approved" class="btn btn-success actionbutton"><i class="fa fa-check"></i>Approve</a>
                                <a href="/updateblogcomment" id="changecommentstatus" data-blogcommentid="{{$blogcomment->id}}" data-blogcommentstatus="rejected" class="btn btn-danger actionbutton"><i class="fa fa-ban"></i>Reject</a>
                            </div>
                            @endif
                            <div class="action-buttons-container">
                                <a href="/viewblogcomment/{{$blogcomment->id}}" id="viewblogcomment" class="btn btn-primary actionbutton"><i class="fa fa-eye"></i>View</a>
                                <a href="/deleteblogcomment/{{$blogcomment->id}}" id="deleteblogcomment" data-blogtitle="{{$blogcomment->blog->title}}" data-commentauthor="{{$blogcomment->author}}" data-commentauthoremail="{{$blogcomment->email}}" data-commentbody="{{$blogcomment->body}}" data-blogcommentstatus="{{$blogcomment->status}}" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>
                            </div>
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
            var commentauthor_val = $.trim($("#commentauthor").val()).replace(/ +/g, ' ').toLowerCase();
            var commentauthoremail_val = $.trim($("#commentauthoremail").val()).replace(/ +/g, ' ').toLowerCase();
            var commentbody_val = $.trim($("#commentbody").val()).replace(/ +/g, ' ').toLowerCase();
            var commentstatus_val = $.trim($("#blogcommentstatus").val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var blogtitle_col = $(this).find('td:nth-child(1)').text().replace(/\s+/g, ' ').toLowerCase();
                var commentauthor_col = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
                var commentauthoremail_col = $(this).find('td:nth-child(3)').text().replace(/\s+/g, ' ').toLowerCase();
                var commentbody_col = $(this).find('td:nth-child(4)').text().replace(/\s+/g, ' ').toLowerCase();
                var commentstatus_col = $(this).find('td:nth-child(5)').text().replace(/\s+/g, ' ').toLowerCase();
                return !~blogtitle_col.indexOf(blogtitle_val) || 
                !~commentauthor_col.indexOf(commentauthor_val) ||
                !~commentauthoremail_col.indexOf(commentauthoremail_val) ||
                !~commentbody_col.indexOf(commentbody_val) || 
                !~commentstatus_col.indexOf(commentstatus_val);
            }).hide();
            if($("#blogtitle").val() != "" || $("#commentauthor").val() != "" || $("#commentauthoremail").val() != "" || $("#commentbody").val() != "" || $("#blogcommentstatus").val() != ""){
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
        //client side filter
        $(".header-searchbar-filter").bind('keyup input propertychange',function(){
            clientSideFilter();
        });
        $("#clear_all_filters").click(function(){
            $("#blogtitle").val("");
            $("#commentauthor").val("");
            $("#commentauthoremail").val("");
            $("#commentbody").val("");
            $("#blogcommentstatus").val("");
            clientSideFilter();
        });
        $(".header-searchbar-filter-button").click(function(){
            if($(this).attr("id") == "blogtitle_clr_btn"){
                $("#blogtitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "commentauthor_clr_btn"){
                $("#commentauthor").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "commentauthoremail_clr_btn"){
                $("#commentauthoremail").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "commentbody_clr_btn"){
                $("#commentbody").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "commentstatus_clr_btn"){
                $("#blogcommentstatus").val("");
                clientSideFilter();
            }
        });
        //filter blog comments by date range
        $("#date-filter-container a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#cancel_modal_button").click(function(){
            $("#daterangeblogcommentfilterform").trigger("reset");
            $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null, maxDate: new Date()});
        });
        $("#daterangeblogcommentfilterform").submit(function(event){
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
                $("#daterangeblogcommentfilterform").trigger("reset");
                $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null,maxDate: null});
                $(".alert").css('display','none');
                $.ajax({
                    method: "GET",
                    url: "/filteredblogcomments/"+_dateremark+"/"+_modal_datefrom+"/"+_modal_dateto,
                    data: null,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        $("#daterangemodal").modal('toggle');
                        $("#tablebody").empty();
                        $("#viewitems-main-heading").html(data.mainheading);
                        $.each(data.filteredblogcomments, function (index, value) {
                            var html = "<tr>"+
                            "<td>"+value.blog.title+"</td>"+
                            "<td>"+value.author+"</td>"+
                            "<td>"+value.email+"</td>"+
                            "<td>"+value.body+"</td>"+
                            "<td class='comment-status'>"
                            if(value.status.toLowerCase() == "pending"){
                                html = html + `<span class="pending-comment">`+value.status+`</span>`;
                            }
                            else if(value.status.toLowerCase() == "approved"){
                                html = html + `<span class="approved-comment">`+value.status+`</span>`;
                            }
                            else if(value.status.toLowerCase() == "rejected"){
                                html = html + `<span class="rejected-comment">`+value.status+`</span>`;
                            }
                            html = html + "</td>"+
                            "<td>"
                                if(value.status.toLowerCase() == "pending"){
                                    html = html +
                                    `<div id="approval-actions" class="action-buttons-container">`+
                                        `<a href="/updateblogcomment" id="changecommentstatus" data-blogcommentid="`+value.id+`" data-blogcommentstatus="approved" class="btn btn-success actionbutton"><i class="fa fa-check"></i>Approve</a>`+
                                        `<a href="/updateblogcomment" id="changecommentstatus" data-blogcommentid="`+value.id+`" data-blogcommentstatus="rejected" class="btn btn-danger actionbutton"><i class="fa fa-ban"></i>Reject</a>`+
                                    `</div>`
                                }
                                html = html +
                                `<div class="action-buttons-container">`+
                                    `<a href="/viewblogcomment/`+value.id+`" id="viewblogcomment" class="btn btn-primary actionbutton"><i class="fa fa-eye"></i>View</a>`+
                                    `<a href="/deleteblogcomment/`+value.id+`" data-blogtitle="`+value.blog.title+`" data-commentauthor="`+value.author+`" data-commentauthoremail="`+value.email+`" data-commentbody="`+value.body+`" data-blogcommentstatus="`+value.status+`" id="deleteblogcomment" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>`+
                                `</div>`+
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
            if($(this).attr("id") == "changecommentstatus"){
                var url = $(this).attr("href");
                var parent_row = $(this).parent().parent().parent();
                var parent_div = $(this).parent();
                var parent_td = $(this).parent().parent();
                var _blogcomment_id = $(this).data("blogcommentid");
                var _blogcomment_status = $(this).data("blogcommentstatus");
                var _jsondata = JSON.stringify({blogcomment_id: _blogcomment_id, blogcomment_status: _blogcomment_status, _token: "{{ csrf_token() }}"})
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: _jsondata,
                    dataType: "json",
                    contentType: "application/json",
                    success: function(data){
                        if(data.status == "true"){
                            parent_div.html("")
                            parent_div.css("margin",0)
                            parent_td.find(".action-buttons-container #deleteblogcomment").data('blogcommentstatus',_blogcomment_status);
                            if(_blogcomment_status == "approved"){
                                parent_row.find('td.comment-status').html(`<span class="approved-comment">`+_blogcomment_status+`</span>`);
                            }
                            else if(_blogcomment_status == "rejected"){
                                parent_row.find('td.comment-status').html(`<span class="rejected-comment">`+_blogcomment_status+`</span>`);
                            }
                        }
                    },
                    error: function(){
                        alert("Ajax Error! something went wrong...");
                    }
                });
            }
            else if($(this).attr("id") == "viewblogcomment"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deleteblogcomment"){
                var url = $(this).attr("href");
                var status = null;
                if($(this).data("blogcommentstatus") == "pending"){
                    status = "<span class='pending-comment'>"+$(this).data("blogcommentstatus")+"</span><br>";
                }
                else if($(this).data("blogcommentstatus") == "approved"){
                    status = "<span class='approved-comment'>"+$(this).data("blogcommentstatus")+"</span><br>";
                }
                else if($(this).data("blogcommentstatus") == "rejected"){
                    status = "<span class='rejected-comment'>"+$(this).data("blogcommentstatus")+"</span><br>";
                }
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Blog Title:</b>  "+$(this).data("blogtitle")+"<br>"+
                    "<b>Author:</b>  "+$(this).data("commentauthor")+"<br>"+
                    "<b>Email:</b>  "+$(this).data("commentauthoremail")+"<br>"+
                    "<b>Comment:</b>  "+$(this).data("commentbody")+"<br>"+
                    "<b>Status:</b>  "+status,
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