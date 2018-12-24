<div class="form-main-container">
        <div class="form-main-heading">Update Category</div>
        <hr>
        <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
            <a href="#" class="close" aria-label="close">&times;</a>
            <strong id="alert-danger-message-area"></strong>
        </div>
        <form id="updatecategoryform" action="/updatecategoryform" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-field">
                            <input type="text" id="categoryid" value="{{$category->id}}" hidden>
                            <div class="form-field-heading">Category Title</div>
                        <input type="text" class="form-control" value="{{ $category->title }}" id="categorytitle" name="categorytitle" placeholder="Kohls"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">Category Type</div>
                            <select class="form-control" id="categorytype" name="categorytype">
                                @if($category->type == "regular")
                                    <option value="regular" selected>Regular</option>
                                    <option value="popular">Popular</option>
                                @else
                                    <option value="regular">Regular</option>
                                    <option value="popular" selected>Popular</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">Category Status</div>
                            <select class="form-control" id="categorystatus" name="categorystatus">
                                @if($category->status == "active")
                                    <option value="active" selected>Active</option>
                                    <option value="deactive">Deactive</option>
                                @else
                                    <option value="active">Active</option>
                                    <option value="deactive" selected>Deactive</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <a href="/updatecategory/{{$category->id}}" id="backtocategory" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Category</a>
                <input type="submit" value="Update Category" class="btn btn-primary form-button"/>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $(".close").click(function(){
                $(".alert").slideUp();
            });
            $("#backtocategory").click(function(event){
                event.preventDefault();
                $("#panel-body-container").load($(this).attr("href"));
            });
            $("#updatecategoryform").submit(function(event){
                event.preventDefault();
            }).validate({
                rules: {
                    categorytitle: "required",
                    categorytype: "required",
                    categorystatus: "required",
                },
                messages: {
                    categorytitle: "please enter category title",
                    categorytype: "please select category type",
                    categorystatus: "please select category status",
                },
                submitHandler: function(form) {
                    var _categoryid = $("#categoryid").val();
                    var _categorytitle = $("#categorytitle").val();
                    var _categorytype = $("#categorytype").val();
                    var _categorystatus = $("#categorystatus").val();
                    var _jsondata = JSON.stringify({categoryid: _categoryid, categorytitle: _categorytitle, categorytype: _categorytype, categorystatus: _categorystatus, _token: '{{csrf_token()}}'});
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
                            console.log(data);
                            if(data.status == "true"){
                                $("#panel-body-container").load('/updatecategory/'+data.id);
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