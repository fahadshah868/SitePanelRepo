<div class="form-main-container">
    <div class="form-main-heading">Update Store Categories</div>
    <hr>
    <div id="alert-danger" class="alert alert-danger alert-dismissible fade show alert-danger-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-danger-message-area"></strong>
    </div>
    <form id="updatestorecategoriesform" action="#" method="#">
    @csrf
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <input type="text" value="{{ $store->id }}" id="storeid" hidden>
                        <div class="form-field-heading">Store Title</div>
                        <input type="text" class="form-control form-field-text" id="storetitle" name="storetitle" value="{{ $store->title }}" readonly/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store Categories</div>
                        <select class="multiselectdropdown" id="storecategories" name="storecategories" multiple data-live-search="true">
                            @foreach($allcategories as $category)
                                @php
                                $flag = 0
                                @endphp
                                @foreach($store->storecategories as $storecategory)
                                    @if($category->id == $storecategory->category_id)
                                        @php
                                            $flag = 1
                                        @endphp
                                        <option value="{{$category->id}}" selected>{{$category->title}}</option>
                                        @break
                                    @endif
                                @endforeach
                                @if($flag == 0)
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
                var _storeid = $("#storeid").val();
                var _storecategories = $("#storecategories").val();
                var _jsondata = JSON.stringify({storeid: _storeid, storecategories: _storecategories, _token: "{{ csrf_token() }}"});
                $(".alert").css("display","none");
                $.ajax({
                    method: "POST",
                    url: "/updatestorecategories",
                    dataType: "json",
                    data: _jsondata,
                    contentType: "application/json",
                    cache: false,
                    success: function(data){
                        if(data.status == "true"){
                            $("#panel-body-container").load("/allstorecategories")
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