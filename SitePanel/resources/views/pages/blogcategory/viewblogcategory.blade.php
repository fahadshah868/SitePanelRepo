<div class="viewitems-main-container">
    <div class="viewitems-main-heading">View Blog Category</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Category Title</div>
                <input type="text" class="form-control form-field-text" value="{{ $blogcategory->title }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Category Status</div>
                @if(strcasecmp($blogcategory->is_active,"y") == 0)
                <input type="text" class="form-control form-field-text active-item" value="_active" readonly/>
                @else
                <input type="text" class="form-control form-field-text deactive-item" value="deactive" readonly/>
                @endif
            </div>
        </div>
    </div>
    @if(strcasecmp(Auth::User()->role,"admin") == 0)
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Category Added/Updated By</div>
                <input type="text" class="form-control form-field-text" value="{{ $blogcategory->user->username }}" readonly/>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Category Created At</div>
                <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($blogcategory->created_at)->format('d-m-Y  h:i:s A') }}" readonly/>
            </div>
        </div>
    </div>
    @if($blogcategory->updated_at != null)
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Category Updated At</div>
                <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($blogcategory->updated_at)->format('d-m-Y  h:i:s A') }}" readonly/>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Category Updated At</div>
                <input type="text" class="form-control form-field-text not-required-yet" value="Not Yet" readonly/>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field" id="viewblogcategory-action-buttons">
                <a href="{{Session::get('url')}}" id="backtoblogcategories" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Blog Categories</a>
                <a href="/updateblogcategory/{{$blogcategory->id}}" class="btn btn-primary form-button" id="updateblogcategory">Update Blog Category<i class="fa fa-forward"></i></a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        if('{{Session::has("updateblogcategory_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updateblogcategory_successmessage")}}');
            $("#alert-success").fadeTo(1000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        $("#viewblogcategory-action-buttons a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
    });
</script>