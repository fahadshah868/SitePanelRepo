<div class="viewitems-main-container">
    <div class="viewitems-main-heading">All Categories<span class="viewitems-main-heading-count">({{ $categoriescount }}<span id="filtered_row_count"></span>)</span></div>
    <hr>
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
                            <span class="active-item">{{ $category->status }}</span>
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
                            <a href="/viewcategory/{{$category->id}}" id="viewcategory" class="btn btn-primary"><i class="fa fa-eye"></i>View</a>
                            <a href="/deletecategory/{{$category->id}}" data-categorytitle='{{$category->title}}' data-categorydescription="{{$category->description}}" data-istopcategory='{{$category->is_topcategory}}' data-ispopularcategory='{{$category->is_popularcategory}}' data-categorystatus='{{$category->status}}' id="deletecategory" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
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
        //navigation buttons actions
        $("#tablebody tr td a").click(function(event){
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