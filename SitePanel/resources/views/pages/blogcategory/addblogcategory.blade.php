<div class="form-main-container">
    <div class="form-main-heading">Add Blog Category</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="addblogcategoryform" action="#" method="#">
    @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Category Title</div>
                        <input type="text" class="form-control form-field-text" id="blogcategorytitle" name="blogcategorytitle" placeholder="Shopping, Food"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Category Status</div>
                        <div class="form-field-inline-remarks">
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="blogcategorystatus" name="blogcategorystatus" value="active" checked>Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="blogcategorystatus" name="blogcategorystatus" value="deactive">Deactive
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Category" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        //validation rules
        $("#addblogcategoryform").submit(function(event){
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
                var _blogcategorytitle = $("#blogcategorytitle").val();
                var _blogcategorystatus = $("input[name='blogcategorystatus']:checked").val();
                var _jsondata = JSON.stringify({blogcategorytitle: _blogcategorytitle, blogcategorystatus: _blogcategorystatus, _token: '{{ csrf_token() }}'});
                $("#addblogcategoryform").trigger("reset");
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/addblogcategory",
                    dataType: "json",
                    data: _jsondata,
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#alert-success-message-area").html(data.success_message);
                            $("#alert-success").fadeTo(1000, 500).slideUp(500, function(){
                                $("#alert-success").slideUp(500);
                            });
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