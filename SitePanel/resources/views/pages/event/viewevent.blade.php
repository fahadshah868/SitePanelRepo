<div class="viewitems-main-container">
    <div class="viewitems-main-heading">View Event</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Event Title</div>
                <input type="text" class="form-control form-field-text" value="{{ $event->title }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Should This Event Display In Footer?</div>
                <input type="text" class="form-control form-field-text" value="{{ $event->display_in_footer }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Event's Description</div>
                <textarea id="eventdescription" readonly>{{ $event->description }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Is Ready To Add Offers?</div>
                <input type="text" class="form-control form-field-text" value="{{ $event->is_ready }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Event Status</div>
                @if(strcasecmp($event->is_active,"y") == 0)
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
                <div class="form-field-heading">Event Added/Updated By</div>
                <input type="text" class="form-control form-field-text" value="{{ $event->user->username }}" readonly/>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Event Created At</div>
                <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($event->created_at)->format('d-m-Y  h:i:s A') }}" readonly/>
            </div>
        </div>
    </div>
    @if($event->updated_at != null)
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Event Updated At</div>
                <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($event->updated_at)->format('d-m-Y  h:i:s A') }}" readonly/>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Event Updated At</div>
                <input type="text" class="form-control form-field-text not-required-yet" value="Not Yet" readonly/>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field" id="viewevent-action-buttons">
                <a href="{{Session::get('url')}}" id="backtoevents" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Events</a>
                <a href="/updateevent/{{$event->id}}" class="btn btn-primary form-button" id="updateevent">Update Event<i class="fa fa-forward"></i></a>
            </div>
        </div>
    </div>
</div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
    $(document).ready(function(){
        $('#eventdescription').ckeditor(); // if class is prefered.
        if('{{Session::has("updateevent_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updateevent_successmessage")}}');
            $("#alert-success").fadeTo(1000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        $("#viewevent-action-buttons a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
    });
</script>