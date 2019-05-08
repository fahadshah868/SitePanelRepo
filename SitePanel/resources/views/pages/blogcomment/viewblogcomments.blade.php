<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading" id="viewitems-main-heading">{{$mainheading}}<span class="viewitems-main-heading-count" id="viewitems-main-heading-count">({{ $blogcategoriescount }}<span id="filtered_row_count"></span>)</span><span class="filtered_daterange">{{$filtereddaterange}}</span></div>
        <div class="date-filter-container" id="date-filter-container">
            <a href="/allblogcategories" class="btn btn-danger viewitems-header-filter-button" title="Get All Blog Categories List"><i class="fas fa-list"></i>Get All Bog Categories</a>
            <button class="btn btn-danger date-range-filter-button" title="Set Date Range To Filter Blog Categories" data-toggle="modal" data-target="#daterangemodal"><i class="fas fa-calendar-alt"></i>Set Date Range</button>
            {{--popup to update image--}}
            <div class="modal fade" id="daterangemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form id="daterangeblogcategoryfilterform" action="#" method="#">
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
                    <th>blog</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Body</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="blogcategorytitle" placeholder="Search Category Title" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="blogcategorytitle_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="blogcategorystatus" placeholder="Search Category Status" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="blogcategorystatus_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="blogcategorystatus" placeholder="Search Category Status" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="blogcategorystatus_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="blogcategorystatus" placeholder="Search Category Status" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="blogcategorystatus_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th>
                        <div class="header-searchbar-filter-assets">
                            <input type="text" class="header-searchbar-filter" id="blogcategorystatus" placeholder="Search Category Status" autocomplete="off"/>
                            <button class="header-searchbar-filter-button" id="blogcategorystatus_clr_btn" title="clear">&#x2715;</button>
                        </div>
                    </th>
                    <th><button class="header-searchbar-clear-filters-button" id="clear_all_filters" title="Clear All Applied Filters"><i class="fas fa-times-circle"></i>Clear All Filters</button></th>
                </tr>
            </thead>
            <tbody id="tablebody">
            <tr>
            <td>asd asd asd asd asd as dasd </td>
            <td>abcdefgh</td>
            <td>abcd@gmail.com</td>
            <td>comsad asd sdfdfvs dfvs dfsdf v adfvs r tgvaw erv asd v srfhwrnaedf gvwrb asdvsdv sfgbwrgv qefvadg bthqag</td>
            <td>pending</td>
            <td>
                            <div style="display: flex; flex-direction: row; margin-bottom: 10px;">
                                <a href="#" id="viewcarouseloffer" class="btn btn-primary actionbutton" style="margin-right: 5px;"><i class="fa fa-check"></i>Approve</a>
                                <a href="#" id="deletecarouseloffer"class="btn btn-danger actionbutton"><i class="fa fa-ban"></i>Reject</a>
                            </div>
                            <div style="display: flex; flex-direction: row;">
                                <a href="#" id="viewcarouseloffer" class="btn btn-primary actionbutton"><i class="fa fa-eye"></i>View</a>
                                <a href="#" id="deletecarouseloffer" id="deletestore" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>
                            </div>
                        </td>
</tr>            

                @if(count($allblogcomments) > 0)
                    @foreach($allblogcomments as $blogcomment)
                    <tr>
                        <td>{{ $blogcomment->blog->title }}</td>
                        <td>{{ $blogcomment->author }}</td>
                        <td>{{ $blogcomment->email }}</td>
                        <td>{{ $blogcomment->body }}</td>
                        <td>
                            @if(strcasecmp($blogcomment->status,"pending") == 0)
                                <span class="pending-comment">{{ $blogcomment->status }}</span>
                            @elseif(strcasecmp($blogcomment->status,"approved") == 0)
                                <span class="approved-comment">{{ $blogcomment->status }}</span>
                            @elseif(strcasecmp($blogcomment->status,"rejected") == 0)
                                <span class="rejected-comment">{{ $blogcomment->status }}</span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: row; margin-bottom: 10px;">
                                <a href="/viewcarouseloffer/{{$carouseloffer->id}}" id="viewcarouseloffer" class="btn btn-primary actionbutton"><i class="fa fa-eye"></i>View</a>
                                <a href="/deletecarouseloffer/{{$carouseloffer->id}}" id="deletecarouseloffer" data-storetitle="{{$carouseloffer->store->title}}" data-offertitle="{{$carouseloffer->title}}" data-offerlocation="{{$carouseloffer->location}}" data-offertype="{{$carouseloffer->type}}" data-offercode="{{$carouseloffer->code}}" data-offerstartingdate="{{$carouseloffer->starting_date}}" data-offerexpirydate="{{$carouseloffer->expiry_date}}" data-offerstatus="{{$carouseloffer->status}}" id="deletestore" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>
                            </div>
                            <div style="display: flex; flex-direction: row;">
                                <a href="/viewcarouseloffer/{{$carouseloffer->id}}" id="viewcarouseloffer" class="btn btn-primary actionbutton"><i class="fa fa-eye"></i>View</a>
                                <a href="/deletecarouseloffer/{{$carouseloffer->id}}" id="deletecarouseloffer" data-storetitle="{{$carouseloffer->store->title}}" data-offertitle="{{$carouseloffer->title}}" data-offerlocation="{{$carouseloffer->location}}" data-offertype="{{$carouseloffer->type}}" data-offercode="{{$carouseloffer->code}}" data-offerstartingdate="{{$carouseloffer->starting_date}}" data-offerexpirydate="{{$carouseloffer->expiry_date}}" data-offerstatus="{{$carouseloffer->status}}" id="deletestore" class="btn btn-danger actionbutton"><i class="fa fa-trash"></i>Delete</a>
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
            var blogcategorytitle_val = $.trim($("#blogcategorytitle").val()).replace(/ +/g, ' ').toLowerCase();
            var blogcategorystatus_val = $.trim($("#blogcategorystatus").val()).replace(/ +/g, ' ').toLowerCase();
            var blogcategory_added_updated_by_val = $.trim($("#blogcategory_added_updated_by").val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function() {
                var blogcategorytitle_col = $(this).find('td:nth-child(1)').text().replace(/\s+/g, ' ').toLowerCase();
                var blogcategorystatus_col = $(this).find('td:nth-child(2)').text().replace(/\s+/g, ' ').toLowerCase();
                var blogcategory_added_updated_by_col = $(this).find('td:nth-child(3)').text().replace(/\s+/g, ' ').toLowerCase();
                return !~blogcategorytitle_col.indexOf(blogcategorytitle_val) || !~blogcategorystatus_col.indexOf(blogcategorystatus_val) || !~blogcategory_added_updated_by_col.indexOf(blogcategory_added_updated_by_val);
            }).hide();
            if($("#blogcategorytitle").val() != "" || $("#blogcategorystatus").val() != "" || $("#blogcategory_added_updated_by").val() != ""){
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
            $("#blogcategorytitle").val("");
            $("#blogcategorystatus").val("");
            $("#blogcategory_added_updated_by").val("");
            clientSideFilter();
        });
        $(".header-searchbar-filter-button").click(function(){
            if($(this).attr("id") == "blogcategorytitle_clr_btn"){
                $("#blogcategorytitle").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "blogcategorystatus_clr_btn"){
                $("#blogcategorystatus").val("");
                clientSideFilter();
            }
            else if($(this).attr("id") == "blogcategory_added_updated_by_clr_btn"){
                $("#blogcategory_added_updated_by").val("");
                clientSideFilter();
            }
        });
        $("#tablebody").on('click','#comment-status a',function(){
            alert('as');
        });
        //filter blogcategorys by date range
        $("#date-filter-container a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#cancel_modal_button").click(function(){
            $("#daterangeblogcategoryfilterform").trigger("reset");
            $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null, maxDate: new Date()});
        });
        $("#daterangeblogcategoryfilterform").submit(function(event){
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
                $("#daterangeblogcategoryfilterform").trigger("reset");
                $("#modal_datefrom , #modal_dateto").datepicker("option" , {minDate: null,maxDate: null});
                $(".alert").css('display','none');
                $.ajax({
                    method: "GET",
                    url: "/filteredblogcategories/"+_dateremark+"/"+_modal_datefrom+"/"+_modal_dateto,
                    data: null,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        $("#daterangemodal").modal('toggle');
                        $("#tablebody").empty();
                        $("#viewitems-main-heading").html(data.mainheading);
                        $.each(data.filteredblogcategories, function (index, value) {
                            var html = "<tr>"+
                            "<td>"+value.title+"</td>"
                            if(value.status == "active"){
                                html = html + "<td><span class='active-item'>_"+value.status+"</span></td>"
                            }
                            else{
                                html = html + "<td><span class='deactive-item'>"+value.status+"</span></td>"
                            }
                            if("{{Auth::User()->role}}" == "admin"){
                                html = html +
                                "<td>"+value.user.username+"</td>"
                            }
                            html = html +
                            "<td>"+
                                "<a href='/viewblogcategory/"+value.id+"' id='viewblogcategory' class='btn btn-primary actionbutton'><i class='fa fa-eye'></i>View</a>"+
                                "<a href='/deleteblogcategory/"+value.id+"' id='deleteblogcategory' data-blogcategorytitle='"+value.title+"' data-blogcategorystatus='"+value.status+"' class='btn btn-danger actionbutton'><i class='fa fa-trash'></i>Delete</a>"+
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
            if($(this).attr("id") == "viewblogcategory"){
                $("#panel-body-container").load($(this).attr("href"));
            }
            else if($(this).attr("id") == "deleteblogcategory"){
                var url = $(this).attr("href");
                var status = null;
                if($(this).data("blogcategorystatus") == "active"){
                    status = "<span class='active-item'>_"+$(this).data("blogcategorystatus")+"</span><br>";
                }
                else if($(this).data("blogcategorystatus") == "deactive"){
                    status = "<span class='deactive-item'>"+$(this).data("blogcategorystatus")+"</span><br>";
                }
                bootbox.confirm({
                    message: "<b>Are you sure to delete this record?</b><br>"+
                    "<b>Category Title:</b>  "+$(this).data("blogcategorytitle")+"<br>"+
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