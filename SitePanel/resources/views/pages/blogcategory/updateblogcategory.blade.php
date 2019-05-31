<div class="form-main-container">
        <div class="form-main-heading">Update Blog Category</div>
        <hr>
        <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
            <a href="#" class="close" aria-label="close">&times;</a>
            <strong id="alert-danger-message-area"></strong>
        </div>
        <form id="updateblogcategoryform" action="#" method="#">
            @csrf
            <div class="form-container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-field">
                            <input type="text" id="blogcategoryid" value="{{$blogcategory->id}}" hidden >
                            <div class="form-field-heading">Category Title</div>
                            <input type="text" class="form-control form-field-text" id="blogcategorytitle" name="blogcategorytitle" value="{{$blogcategory->title}}" placeholder="cj, shareasale, clickbank"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-field">
                            <div class="form-field-heading">Category Status</div>
                            <div class="form-field-inline-remarks">
                                @if(strcasecmp($blogcategory->is_active,"y") == 0)
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="blogcategorystatus" name="blogcategorystatus" value="y" checked>Active
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="blogcategorystatus" name="blogcategorystatus" value="n">Deactive
                                    </label>
                                </div>
                                @else
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="blogcategorystatus" name="blogcategorystatus" value="y">Active
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="blogcategorystatus" name="blogcategorystatus" value="n" checked>Deactive
                                    </label>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-buttons-container">
                    <div>
                        <a href="/viewblogcategory/{{$blogcategory->id}}" id="backtoblogcategory" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Blog Category</a>
                        <input type="submit" value="Update Category" class="btn btn-primary form-button"/>
                    </div>
                    <div>
                        <a href="#" id="resetupdateblogcategoryform" class="btn btn-info form-button"><i class="fa fa-undo"></i>Reset Form</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $(".close").click(function(){
                $(".alert").slideUp();
            });
            $("#backtoblogcategory").click(function(event){
                event.preventDefault();
                $("#panel-body-container").load($(this).attr("href"));
            });
            $("#resetupdateblogcategoryform").click(function(){
                event.preventDefault();
                $("#updateblogcategoryform").trigger("reset");
            });
            $("#updateblogcategoryform").submit(function(event){
                event.preventDefault();
            }).validate({
                rules: {
                    blogcategorytitle: "required",
                    blogcategorystatus: "required"
                },
                messages: {
                    blogcategorytitle: "please enter category title",
                    blogcategorystatus: "please select category status"
                },
                submitHandler: function(form) {
                    var _blogcategoryid = $("#blogcategoryid").val();
                    var _blogcategorytitle = $("#blogcategorytitle").val();
                    var _blogcategorystatus = $("input[name='blogcategorystatus']:checked").val();
                    var _jsondata = JSON.stringify({ blogcategoryid: _blogcategoryid, blogcategorytitle: _blogcategorytitle, blogcategorystatus: _blogcategorystatus, _token: '{{ csrf_token() }}'});
                    $(".alert").css("display","none");
                    $.ajax({
                        method: 'POST',
                        url: '/updateblogcategory',
                        dataType: "json",
                        data: _jsondata,
                        dataType: "json",
                        contentType: "application/json",
                        cache: false,
                        success: function(data){
                            if(data.status == "true"){
                                $("#panel-body-container").load("/viewblogcategory/"+data.blogcategory_id);
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