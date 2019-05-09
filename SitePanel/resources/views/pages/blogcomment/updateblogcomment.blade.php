<div class="form-main-container">
    <div class="form-main-heading">Update Blog Comment</div>
    <hr>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="updateblogcommentform" action="#" method="#">
        @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <input type="text" id="blogcommentid" value="{{$blogcomment->id}}" hidden >
                        <div class="form-field-heading">Status</div>
                        @if(strcasecmp($blogcomment->status,"pending") == 0)
                            <div class="form-field-inline-remarks">
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="blogcommentstatus" name="blogcommentstatus" value="pending" checked>Pending
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="blogcommentstatus" name="blogcommentstatus" value="approved">Approve
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="blogcommentstatus" name="blogcommentstatus" value="rejected">Reject
                                    </label>
                                </div>
                            </div>
                        @elseif(strcasecmp($blogcomment->status,"approved") == 0)
                            <div class="form-field-inline-remarks">
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="blogcommentstatus" name="blogcommentstatus" value="approved" checked>Approve
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="blogcommentstatus" name="blogcommentstatus" value="rejected">Reject
                                    </label>
                                </div>
                            </div>
                        @elseif(strcasecmp($blogcomment->status,"rejected") == 0)
                            <div class="form-field-inline-remarks">
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="blogcommentstatus" name="blogcommentstatus" value="approved">Approve
                                    </label>
                                </div>
                                <div class="form-field-radiobutton">
                                    <label class="form-field-radiobutton-remarks-label">
                                        <input type="radio" id="blogcommentstatus" name="blogcommentstatus" value="rejected" checked>Reject
                                    </label>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-buttons-container">
                <div>
                    <a href="/viewblogcomment/{{$blogcomment->id}}" id="backtoblogcomment" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Blog Comment</a>
                    <input type="submit" value="Update Blog Comment" class="btn btn-primary form-button"/>
                </div>
                <div>
                    <a href="#" id="resetupdateblogcommentform" class="btn btn-info form-button"><i class="fa fa-undo"></i>Reset Form</a>
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
        $("#backtoblogcomment").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#resetupdateblogcommentform").click(function(){
            event.preventDefault();
            $("#updateblogcommentform").trigger("reset");
        });
        $("#updateblogcommentform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                blogcommentstatus: "required",
            },
            messages: {
                blogcommentstatus: "please select blog comment status",
            },
            submitHandler: function(form) {
                var _blogcommentid = $("#blogcommentid").val();
                var _blogcommentstatus = $("input[name='blogcommentstatus']:checked").val();
                var _jsondata = JSON.stringify({blogcomment_id: _blogcommentid, blogcomment_status: _blogcommentstatus, _token: '{{ csrf_token() }}'});
                $(".alert").css("display","none");
                $.ajax({
                    method: 'POST',
                    url: '/updateblogcomment',
                    dataType: "json",
                    data: _jsondata,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#panel-body-container").load("/viewblogcomment/"+data.blogcomment_id);
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