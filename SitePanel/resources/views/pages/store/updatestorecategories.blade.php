<div class="form-main-container">
    <div class="form-main-heading">Update Store Categories</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="updatestorecategoriesform" action="#" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <input type="text" value="{{ $store->id }}" id="storeid" hidden>
                        <div class="form-field-heading">Store Title</div>
                        <input type="text" class="form-control" id="storetitle" name="storetitle" value="{{ $store->title }}" readonly/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Categories</div>
                        <select class="multiselectdropdown" id="storecategories" name="storecategories" multiple data-live-search="true">
                            @foreach($allcategories as $category)
                                @php $flag = false
                                @foreach($store->storecategorygroup as $storecategory)
                                    @if($category->id == $storecategory->category_id)
                                        $flag = true
                                        <option value="{{$category->id}}" selected>{{$category->title}}</option>
                                        break
                                    @endif
                                @endforeach
                                @if($flag == false)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <a href="/allstorecategories" id="backtostorecategories" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Store Categories</a>
            <input type="submit" value="Update Store Categories" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('js/multiselectdropdown.js')}}"></script>
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $(".alert").slideUp();
        });
        $("#backtostorecategories").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
        //validation rules
        $("#updatestorecategoriesform").submit(function(event){
            event.preventDefault();
        }).validate({
            rules: {
                storecategories: "required",
            },
            messages: {
                storecategories: "please select store categories",
            },
            submitHandler: function(form) {
                var _storecategories = $("#storecategories").val();
                var _jsondata = JSON.stringify({storecategories: _storecategories});
                $("#addstoreform").trigger("reset");
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/updatestorecategories",
                    dataType: "json",
                    data: _jsondata,
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
    });
</script>