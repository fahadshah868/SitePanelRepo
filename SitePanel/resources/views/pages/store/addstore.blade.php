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
    <form id="addstoreform" action="/addstore" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Title</div>
                        <input type="text" class="form-control" id="storetitle" name="storetitle" placeholder="Kohls"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Site Url</div>
                        <input type="text" class="form-control" id="storesiteurl" name="storesiteurl" placeholder="www.Kohls.com"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Type</div>
                        <select class="form-control" id="storetype" name="storetype">
                            <option value="">Select Type</option>
                            <option value="Regular">Regular</option>
                            <option value="Popular">Popular</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Status</div>
                        <select class="form-control" id="storestatus" name="storestatus">
                            <option value="">Select Status</option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Logo</div>
                        <img src="#" id="imgpath" />
                        <input type="file" id="storelogo" name="storelogo" accept=".png, .jpg, .jpeg"/>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Store" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        //define custom validation method to check image dimensions
        $.validator.addMethod('validateimage', function(value, element) {
        return ($(element).data('imagewidth') || 0) == $(element).data('imageheight');
        }, "please select the correct image");
        //validation rules
        var validator = $("#addstoreform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                storetitle: "required",
                storesiteurl: { required: true, url: true },
                storetype: "required",
                storestatus: "required",
                storelogo: { required: true, validateimage: true }
            },
            messages: {
                storetitle: "please enter store title",
                storesiteurl: { required: "please enter store site link", url: "site url must be 'http://www.site.com' format"},
                storetype: "please select store type",
                storestatus: "please select store status",
                storelogo: {required: "please select store image logo", validateimage: "image width and height must be same e.g 100 x 100 etc"}
            },
            submitHandler: function(form) {
                var _storetitle = $("#storetitle").val();
                var _storesiteurl = $("#storesiteurl").val();
                var _storetype = $("#storetype").val();
                var _storestatus = $("#storestatus").val();
                var _storelogo = $("#storelogo")[0].files[0];
                var formdata = new FormData();
                var _jsondata = JSON.stringify({storetitle: _storetitle, storesiteurl: _storesiteurl, storetype: _storetype, storestatus: _storestatus});
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
                            $("#alert-success").fadeTo(3000, 500).slideUp(500, function(){
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
                        if(imagewidth === imageheight){
                            $('#imgpath').attr('src', e.target.result);
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