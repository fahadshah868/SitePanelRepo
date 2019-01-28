<div class="form-main-container">
    <div class="form-main-heading">Add Store</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="addstoreform" action="#" method="#">
    @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Title</div>
                        <input type="text" class="form-control form-field-text" id="storetitle" name="storetitle" placeholder="Kohls"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Categories</div>
                        <select class="multiselectdropdown form-control form-field-text" id="storecategories" name="storecategories" multiple data-live-search="true">
                            @foreach($allcategories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Store's Description</div>
                        <textarea class="form-control form-field-textarea" id="storedescription" name="storedescription" placeholder="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Primary Url</div>
                        <input type="text" class="form-control form-field-text" id="storeprimaryurl" name="storeprimaryurl" placeholder="http://www.kohls.com">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Secondary Url</div>
                        <input type="text" class="form-control form-field-text" id="storesecondaryurl" name="storesecondaryurl" placeholder="kohls.com" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Network</div>
                        <select class="form-control form-field-text" id="networkid" name="networkid">
                            <option value="">Select Network</option>
                            @foreach($allnetworks as $network)
                            <option value="{{$network->id}}">{{$network->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Network Url</div>
                        <input type="text" class="form-control form-field-text" id="storenetworkurl" name="storenetworkurl" placeholder="network url">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store remarks</div>
                        <div class="form-field-inline-remarks">
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    <input type="checkbox" id="is_topstore" name="is_topstore" value="yes">Top Store
                                </label>
                            </div>
                            <div class="form-field-checkbox">
                                <label class="form-field-checkbox-remarks-label">
                                    <input type="checkbox" id="is_popularstore" name="is_popularstore" value="yes">Popular Store
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Status</div>
                        <div class="form-field-inline-remarks">
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="storestatus" name="storestatus" value="active" checked>Active
                                </label>
                            </div>
                            <div class="form-field-radiobutton">
                                <label class="form-field-radiobutton-remarks-label">
                                    <input type="radio" id="storestatus" name="storestatus" value="deactive">Deactive
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Logo</div>
                        <img src="#" id="imgpath" />
                        <input type="file" id="storelogo" name="storelogo" class="form-field-file" accept=".png, .jpg, .jpeg"/>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Store" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('/js/multiselectdropdown.js')}}"></script>
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#storeprimaryurl").bind('keyup input propertychange',function(){
            var value = $("#storeprimaryurl").val();
            if (value.indexOf("http://www.") >= 0){
                var value = value.replace("http://www.","");
                $("#storesecondaryurl").val(value);
            }
            else{
                $("#storesecondaryurl").val("");
            }
        });
        $("#is_topstore").change(function(){
            if($("#is_topstore").prop("checked")){
                $("#is_popularstore").prop("checked", true);
            }
        });
        $("#is_popularstore").change(function(){
            if($("#is_popularstore").prop("checked") == false){
                $("#is_topstore").prop("checked", false);
            }
        });
        //define custom validation method to check image dimensions
        $.validator.addMethod('validateimage', function(value, element) {
        return ($(element).data('imagewidth') >= 200 && $(element).data('imagewidth') || 0) == $(element).data('imageheight');
        }, "please select the correct image");
        //validation rules
        var validator = $("#addstoreform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                storetitle: "required",
                storecategories: "required",
                storedescription: "required",
                storeprimaryurl: { required: true, url: true },
                storesecondaryurl: "required",
                networkid: "required",
                storenetworkurl: "required",
                storestatus: "required",
                storelogo: { required: true, validateimage: true }
            },
            messages: {
                storetitle: "please enter store title",
                storecategories: "please select store categories",
                storedescription: "please enter store details",
                storeprimaryurl: { required: "please enter store site url", url: "site url must be 'http://www.site.com' format"},
                storesecondaryurl: "please enter store secondary url",
                networkid: "please select network",
                storenetworkurl: "please enter netwrok url",
                storetype: "please select store type",
                storestatus: "please select store status",
                storelogo: {required: "please select store image logo", validateimage: "image width and height must be same and must be 200 or greater e.g 200 x 200 etc"}
            },
            submitHandler: function(form) {
                var _is_topstore = "no";
                var _is_popularstore = "no";
                var _storetitle = $("#storetitle").val();
                var _storecategories = $("#storecategories").val();
                var _storedescription = $("#storedescription").val();
                var _storeprimaryurl = $("#storeprimaryurl").val();
                var _storesecondaryurl = $("#storesecondaryurl").val();
                var _networkid = $("#networkid").val();
                var _storenetworkurl = $("#storenetworkurl").val();
                var _storestatus = $("input[name='storestatus']:checked").val();
                var _storelogo = $("#storelogo")[0].files[0];
                if($("#is_topstore").prop("checked")){
                    _is_topstore = $("#is_topstore").val();
                }
                if($("#is_popularstore").prop("checked")){
                    _is_popularstore = $("#is_popularstore").val();
                }
                var formdata = new FormData();
                var _jsondata = JSON.stringify({storetitle: _storetitle, storecategories: _storecategories, storedescription: _storedescription, storeprimaryurl: _storeprimaryurl, storesecondaryurl: _storesecondaryurl, networkid: _networkid, storenetworkurl: _storenetworkurl, is_topstore: _is_topstore, is_popularstore: _is_popularstore, storestatus: _storestatus});
                formdata.append("storelogo", _storelogo);
                formdata.append("formdata", _jsondata);
                formdata.append("_token", "{{ csrf_token() }}");
                $("#addstoreform").trigger("reset");
                $('#imgpath').attr("src", "");
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/addstore",
                    dataType: "json",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#alert-success-message-area").html(data.success_message);
                            $("#alert-success").fadeTo(2000, 500).slideUp(500, function(){
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
        //set image to imagebox
        function readURL(input) {
            var photoinput = $("#storelogo");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src= e.target.result;
                    image.onload = function() {
                        var imagewidth = image.width;
                        var imageheight = image.height;
                        photoinput.data('imagewidth', imagewidth);
                        photoinput.data('imageheight', imageheight);
                        if(imagewidth >= 200 && imagewidth === imageheight){
                            $('#imgpath').attr('src', e.target.result);
                        }
                        else{
                            $('#imgpath').attr('src', '');
                        }
                        validator.element(photoinput);
                    };
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        //when select any file
        $("#storelogo").change(function(){
            readURL(this);
        });
    });
</script>