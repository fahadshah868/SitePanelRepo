<div class="form-main-container">
    <div class="form-main-heading">Update Blog</div>
    <hr>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="updateblogform" action="#" method="#">
    @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <input type="text" id="blogid" name="blogid" value="{{ $blog->id }}" hidden>
                        <div class="form-field-heading">Blog Title</div>
                        <input type="text" class="form-control form-field-text" id="blog_title" name="blog_title" value="{{ $blog->title }}" placeholder="Title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Author</div>
                        <input type="text" class="form-control form-field-text" id="blog_author" name="blog_author" value="{{ $blog->author }}" placeholder="Author">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Status</div>
                        @if(strcasecmp($blog->status,"active") == 0)
                        <div class="form-field-inline-remarks">
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="blogstatus" name="blogstatus" value="active" checked>Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="blogstatus" name="blogstatus" value="deactive">Deactive
                                </label>
                            </div>
                        </div>
                        @else
                        <div class="form-field-inline-remarks">
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="blogstatus" name="blogstatus" value="active">Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="blogstatus" name="blogstatus" value="deactive" checked>Deactive
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Blog Body</div>
                        <textarea id="blog_body" name="blog_body" placeholder="Body">{!! $blog->body !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-buttons-container">
                <div>
                    <a href="/viewblog/{{$blog->id}}" id="backtoblog" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Blog</a>
                    <input type="submit" value="Update Blog" class="btn btn-primary form-button"/>
                </div>
                <div>
                    <a href="#" id="resetupdateblogform" class="btn btn-info form-button"><i class="fa fa-undo"></i>Reset Form</a>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('#blog_body').ckeditor(); // if class is prefered.
        var blog_body_val = $("#blog_body").val();
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#backtoblog").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#resetupdateblogform").click(function(){
            event.preventDefault();
            $("#updateblogform").trigger("reset");
            $("#blog_body").val(blog_body_val);
        });
        $("#updateblogform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                blog_title: "required",
                blog_body: "required",
                blog_author: "required",
                blogstatus: "required",
            },
            messages: {
                blog_title: "please enter blog title",
                blog_body: "please fill blog body",
                blog_author: "please enter blog author",
                blogstatus: "please select blog status",
            },
            submitHandler: function(form) {
                var _blogid = $("#blogid").val();
                var _blog_title = $("#blog_title").val();
                var _blog_body = $("#blog_body").val();
                var _blog_author = $("#blog_author").val();
                var _blogstatus = $("input[name='blogstatus']:checked").val();
                var _jsondata = JSON.stringify({blogid: _blogid, blog_title: _blog_title, blog_body: _blog_body, blog_author: _blog_author, blogstatus: _blogstatus, _token: "{{ csrf_token() }}"});
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/updateblogform",
                    dataType: "json",
                    data: _jsondata,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#panel-body-container").load('/viewblog/'+data.blogid);
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