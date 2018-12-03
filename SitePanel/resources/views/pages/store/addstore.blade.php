<div class="form-main-container">
    <div class="form-main-heading">Add Store</div>
    <hr>
    <form id="addstoreform" action="/addstore" method="POST">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Title</div>
                        <input type="text" class="form-control" name="storetitle" placeholder="Kohls"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Site Url</div>
                        <input type="text" class="form-control" name="storesiteurl" placeholder="www.Kohls.com"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Type</div>
                        <select class="form-control" name="storetype">
                            <option value="">Select Type</option>
                            <option value="Normal">Normal</option>
                            <option value="Popular">Popular</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Status</div>
                        <select class="form-control" name="storestatus">
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
                        <input type="file" id="imgfilepath" name="storelogo" accept=".png, .jpg, .jpeg"/>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Store" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        //define custom validation method to check image dimensions
        $.validator.addMethod('validateimage', function(value, element) {
        return ($(element).data('imagewidth') || 0) == $(element).data('imageheight');
        }, "please select the correct image");
        //validation rules
        var validator = $("#addstoreform").validate({
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
                var url = $("#addstoreform").attr("action");
                var method = $("#addstoreform").attr("method");
                var storetitle = $("#storetitle").val();
                var storesiteurl = $("#storesiteurl").val();
                var storetype = $("#storetype").val();
                var storestatus = $("#storestatus").val();
                var storelogo = $("#storelogo").val();
                var jsondata = JSON.stringify({storetitle: storetitle, storesiteurl: storesiteurl, storetype: storetype, storestatus: storestatus, storelogo: storelogo, _token: '{{ csrf_token() }}'});
                $("#addstoreform").trigger("reset");
                $(".alert").css('display','none');
                $.ajax({
                    method: method,
                    url: url,
                    dataType: "json",
                    data: jsondata,
                    contentType: "application/json",
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
            var photoinput = $("#imgfilepath");
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
        $("#imgfilepath").change(function(){
            readURL(this);
        });
    });
</script>