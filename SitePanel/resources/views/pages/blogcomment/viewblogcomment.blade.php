<div class="viewitems-main-container">
    <div class="viewitems-main-heading">View Blog Comment</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Blog Title</div>
                <input type="text" class="form-control form-field-text" value="{{ $blogcomment->blog->title }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Author</div>
                <input type="text" class="form-control form-field-text" value="{{ $blogcomment->author }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Email</div>
                <input type="text" class="form-control form-field-text" value="{{ $blogcomment->email }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Body</div>
                <textarea class="form-control form-field-textarea" readonly>{{ $blogcomment->body }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Status</div>
                @if(strcasecmp($blogcomment->status,"pending") == 0)
                <input type="text" class="form-control form-field-text pending-comment" value="{{ $blogcomment->status }}" readonly/>
                @elseif(strcasecmp($blogcomment->status,"approved") == 0)
                <input type="text" class="form-control form-field-text approved-comment" value="{{ $blogcomment->status }}" readonly/>
                @elseif(strcasecmp($blogcomment->status,"rejected") == 0)
                <input type="text" class="form-control form-field-text rejected-comment" value="{{ $blogcomment->status }}" readonly/>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Posted At</div>
                <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($blogcomment->created_at)->format('d-m-Y  h:i:s A') }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field" id="viewblogcomment-action-buttons">
                <a href="{{Session::get('url')}}" id="backtoblogcomments" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Blog Comments</a>
                <a href="/updateblogcomment/{{$blogcomment->id}}" class="btn btn-primary form-button" id="updateblogcomment">Update Blog Comment<i class="fa fa-forward"></i></a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        if('{{Session::has("updateblogcomment_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updateblogcomment_successmessage")}}');
            $("#alert-success").fadeTo(1000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        $("#viewblogcomment-action-buttons a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
    });
</script>