<div class="form-main-container">
    <div class="form-main-heading">Add Event</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="addeventform" action="#" method="#">
    @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Event Title</div>
                        <input type="text" class="form-control form-field-text" id="eventtitle" name="eventtitle" placeholder="Black Friday, Christmas, Cyber Monday"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Is Top Event?</div>
                        <div class="form-field-inline-remarks">
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="istopevent" name="istopevent" value="y">Yes
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="istopevent" name="istopevent" value="n">No
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Event's Description</div>
                        <textarea id="eventdescription" name="eventdescription" placeholder="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Is Ready To Add Offers?</div>
                        <div class="form-field-inline-remarks">
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="iseventready" name="iseventready" value="y" >Yes
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="iseventready" name="iseventready" value="n">No
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Event Status</div>
                        <div class="form-field-inline-remarks">
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="eventstatus" name="eventstatus" value="y">Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="eventstatus" name="eventstatus" value="n">Deactive
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Event" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#eventdescription").ckeditor(); // if class is prefered.
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        //validation rules
        $("#addeventform").submit(function(event){
            event.preventDefault();
        }).validate({
            ignore: ".hide",
            rules: {
                eventtitle: "required",
                istopevent: "required",
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
                istopevent: "please select top event remark",
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
                var _eventtitle = $("#eventtitle").val();
                var _istopevent = $("input[name='istopevent']:checked").val();
                var _eventdescription = $("#eventdescription").val();
                var _iseventready = $("input[name='iseventready']:checked").val();
                var _eventstatus = $("input[name='eventstatus']:checked").val();
                var _jsondata = JSON.stringify({eventtitle: _eventtitle, istopevent: _istopevent, eventdescription: _eventdescription, iseventready: _iseventready, eventstatus: _eventstatus, _token: '{{ csrf_token() }}'});
                $("#addeventform").trigger("reset");
                CKEDITOR.instances['eventdescription'].setData('');
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/addevent",
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