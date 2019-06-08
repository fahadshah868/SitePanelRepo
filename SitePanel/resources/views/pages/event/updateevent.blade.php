<div class="form-main-container">
    <div class="form-main-heading">Update Event</div>
    <hr>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="updateeventform" action="#" method="#">
        @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <input type="text" id="eventid" value="{{$event->id}}" hidden >
                        <div class="form-field-heading">Event Title</div>
                        <input type="text" class="form-control form-field-text" id="eventtitle" name="eventtitle" value="{{$event->title}}" placeholder="cj, shareasale, clickbank"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Should This Event Display In Footer?</div>
                        <div class="form-field-inline-remarks">
                            @if(strcasecmp($event->display_in_footer,"y") == 0)
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="displayinfooter" name="displayinfooter" value="y" checked>Yes
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="displayinfooter" name="displayinfooter" value="n">No
                                </label>
                            </div>
                            @else
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="displayinfooter" name="displayinfooter" value="y">Yes
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="displayinfooter" name="displayinfooter" value="n" checked>No
                                </label>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Event Description</div>
                        <textarea id="eventdescription" name="eventdescription">{{$event->description}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Is Event Ready To Add Offers?</div>
                        <div class="form-field-inline-remarks">
                            @if(strcasecmp($event->is_ready,"y") == 0)
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="iseventready" name="iseventready" value="y" checked>Yes
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="iseventready" name="iseventready" value="n">No
                                </label>
                            </div>
                            @else
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="iseventready" name="iseventready" value="y">Yes
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="iseventready" name="iseventready" value="n" checked>No
                                </label>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Event Status</div>
                        <div class="form-field-inline-remarks">
                            @if(strcasecmp($event->is_active,"y") == 0)
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="eventstatus" name="eventstatus" value="y" checked>Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="eventstatus" name="eventstatus" value="n">Deactive
                                </label>
                            </div>
                            @else
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="eventstatus" name="eventstatus" value="y">Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="eventstatus" name="eventstatus" value="n" checked>Deactive
                                </label>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-buttons-container">
                <div>
                    <a href="/viewevent/{{$event->id}}" id="backtoevents" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Event</a>
                    <input type="submit" value="Update Event" class="btn btn-primary form-button"/>
                </div>
                <div>
                    <a href="#" id="resetupdateeventform" class="btn btn-info form-button"><i class="fa fa-undo"></i>Reset Form</a>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
    $(document).ready(function(){
        var eventdescription = $("#eventdescription").val();
        $('#eventdescription').ckeditor(); // if class is prefered.
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#backtoevents").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        $("#resetupdateeventform").click(function(){
            event.preventDefault();
            $("#updateeventform").trigger("reset");
            $("#eventdescription").val(eventdescription);
        });
        $("#updateeventform").submit(function(event){
            event.preventDefault();
        }).validate({
            ignore: ".hide",
            rules: {
                eventtitle: "required",
                displayinfooter: "required",
                eventdescription: { 
                                        required: function(){
                                            CKEDITOR.instances.eventdescription.updateElement();
                                        },
                                        minlength: 1,
                                    },
                iseventready: "required",
                eventstatus: "required",
            },
            messages: {
                eventtitle: "please fill event title",
                displayinfooter: "please select top event remark",
                eventdescription: {
                                        required: "please fill event description",
                                        minlength:"please fill event description",
                                    },
                iseventready: "please select event ready remark",
                eventstatus: "please select event status",
            },
            errorPlacement: function(error, element) 
            {
                if ( element.is(":radio") ) 
                {
                    error.appendTo( element.parents('.form-field-inline-remarks') );
                }
                else 
                { // This is the default behavior 
                    error.insertAfter( element );
                }
            },
            submitHandler: function(form) {
                var _eventid = $("#eventid").val();
                var _eventtitle = $("#eventtitle").val();
                var _displayinfooter = $("input[name='displayinfooter']:checked").val();
                var _eventdescription = $("#eventdescription").val();
                var _iseventready = $("input[name='iseventready']:checked").val();
                var _eventstatus = $("input[name='eventstatus']:checked").val();
                var _jsondata = JSON.stringify({ eventid: _eventid, eventtitle: _eventtitle, displayinfooter: _displayinfooter, eventdescription: _eventdescription, iseventready: _iseventready, eventstatus: _eventstatus, _token: '{{ csrf_token() }}'});
                $(".alert").css("display","none");
                $.ajax({
                    method: 'POST',
                    url: '/updateevent',
                    dataType: "json",
                    data: _jsondata,
                    dataType: "json",
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#panel-body-container").load("/viewevent/"+data.event_id);
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