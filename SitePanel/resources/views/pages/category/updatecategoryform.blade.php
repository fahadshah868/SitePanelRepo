<div class="form-main-container">
        <div class="form-main-heading">Update Category</div>
        <hr>
        <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
            <a href="#" class="close" aria-label="close">&times;</a>
            <strong id="alert-danger-message-area"></strong>
        </div>
        <form id="updatecategoryform" action="#" method="#">
        @csrf
            <div class="form-container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-field">
                            <input type="text" id="categoryid" value="{{$category->id}}" hidden>
                            <div class="form-field-heading">Category Title</div>
                        <input type="text" class="form-control form-field-text" value="{{ $category->title }}" id="categorytitle" name="categorytitle" placeholder="Baby"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-field">
                            <div class="form-field-heading">Category Description</div>
                            <textarea id="categorydescription" name="categorydescription" placeholder="description about category">{!! $category->description !!}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">Category remarks</div>
                            <div class="form-field-inline-remarks">
                                <div class="form-field-checkbox">
                                    <label class="form-field-checkbox-remarks-label">
                                        @if(strcasecmp($category->is_topcategory,"y") == 0)
                                        <input type="checkbox" id="is_topcategory" name="is_topcategory" value="y" checked>Top Category
                                        @else
                                        <input type="checkbox" id="is_topcategory" name="is_topcategory" value="y">Top Category
                                        @endif
                                    </label>
                                </div>
                                <div class="form-field-checkbox">
                                    <label class="form-field-checkbox-remarks-label">
                                        @if(strcasecmp($category->is_popularcategory,"y") == 0)
                                        <input type="checkbox" id="is_popularcategory" name="is_popularcategory" value="y" checked>Popular Category
                                        @else
                                        <input type="checkbox" id="is_popularcategory" name="is_popularcategory" value="y">Popular Category
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">Category Status</div>
                            <div class="form-field-inline-remarks">
                                @if(strcasecmp($category->is_active,"y") == 0)
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="categorystatus" name="categorystatus" value="y" checked>Active
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="categorystatus" name="categorystatus" value="n">Deactive
                                    </label>
                                </div>
                                @else
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="categorystatus" name="categorystatus" value="y">Active
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="categorystatus" name="categorystatus" value="n" checked>Deactive
                                    </label>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-buttons-container">
                    <div>
                        <a href="/viewcategory/{{$category->id}}" id="backtocategory" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Category</a>
                        <input type="submit" value="Update Category" class="btn btn-primary form-button"/>
                    </div>
                    <div>
                        <a href="#" id="resetupdatecategoryform" class="btn btn-info form-button"><i class="fa fa-undo"></i>Reset Form</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
    $(document).ready(function(){
        $('#categorydescription').ckeditor(); // if class is prefered.
        var category_description_val = $("#categorydescription").val();
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#backtocategory").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#resetupdatecategoryform").click(function(){
            event.preventDefault();
            $("#updatecategoryform").trigger("reset");
            $("#categorydescription").val(category_description_val);
        });
        $("#is_topcategory").change(function(){
            if($("#is_topcategory").prop("checked")){
                $("#is_popularcategory").prop("checked", true);
            }
        });
        $("#is_popularcategory").change(function(){
            if($("#is_popularcategory").prop("checked") == false){
                $("#is_topcategory").prop("checked", false);
            }
        });
        $("#updatecategoryform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                categorytitle: "required",
                categorydescription: "required",
                categorystatus: "required",
            },
            messages: {
                categorytitle: "please enter category title",
                categorydescription: "please enter category description",
                categorystatus: "please select category status",
            },
            submitHandler: function(form) {
                var _is_topcategory = "n";
                var _is_popularcategory = "n";
                var _categoryid = $("#categoryid").val();
                var _categorytitle = $("#categorytitle").val();
                var _categorydescription = $("#categorydescription").val();
                var _categorystatus = $("input[name='categorystatus']:checked").val();
                if($("#is_topcategory").prop("checked")){
                    _is_topcategory = $("#is_topcategory").val();
                }
                if($("#is_popularcategory").prop("checked")){
                    _is_popularcategory = $("#is_popularcategory").val();
                }
                var _jsondata = JSON.stringify({categoryid: _categoryid, categorytitle: _categorytitle, categorydescription: _categorydescription, is_topcategory: _is_topcategory, is_popularcategory: _is_popularcategory, categorystatus: _categorystatus, _token: '{{csrf_token()}}'});
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/updatecategoryform",
                    dataType: "json",
                    data: _jsondata,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#panel-body-container").load('/viewcategory/'+data.categoryid);
                        }
                        else{
                            $("#alert-danger-message-area").html(data.error_message);
                            $("#alert-danger").css("display","block");
                        }
                    },
                    error: function(){
                        alert("Ajax Error! something went wrong...");
                    }
                });
                return false;
            }
        });
    });
</script>