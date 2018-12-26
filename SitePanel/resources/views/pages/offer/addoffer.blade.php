<div class="form-main-container">
    <div class="form-main-heading">Add Offer</div>
    <hr>
    <form id="addcouponform">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Title</div>
                        <input type="text" class="form-control" name="offertitle" placeholder="offer"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type</div>
                        <select class="form-control" name="offertype">
                            <option value="">Select Offer Type</option>
                            @foreach($alloffertypes as $offertype)
                            <option value="{{$offertype->title}}">{{$offertype->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Code</div>
                        <input type="text" class="form-control" name="offercode" placeholder="code">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Details</div>
                        <textarea class="form-control" name="offerdetails" placeholder="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Select Store</div>
                        <select class="multiselectdropdown" name="selectstore" multiple data-live-search="true">
                            @foreach($allstores as $store)
                            <option value="{{$store->title}}">{{$store->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Select Category</div>
                        <select class="multiselectdropdown" name="selectcategory" multiple data-live-search="true">
                            @foreach($allcategories as $category)
                            <option value="{{$category->title}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Start Date</div>
                        <input type="date" name="startdate" class="form-control"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">End Date</div>
                        <input type="date" name="enddate" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Coupon Type</div>
                        <select class="form-control" name="coupontype">
                            <option value="">Select Type</option>
                            <option value="Normal">Normal</option>
                            <option value="Popular">Popular</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Coupon Status</div>
                        <select class="form-control" name="couponstatus">
                            <option value="">Select Type</option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Offer" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('js/multiselectdropdown.js')}}"></script>
<script>
    $(document).ready(function(){
        //validation rules
        $("#addcouponform").validate({
            rules: {
                offertitle: "required",
                offertype: "required",
                offercode: "required",
                offerdetails: "required",
                selectstore: "required",
                selectcategory: "required",
                startdate: "required",
                enddate: "required",
                coupontype: "required",
                couponstatus: "required"
            },
            messages: {
                offertitle: "please enter offer title",
                offertype: "please select offer type",
                offercode: "please enter offer code",
                offerdetails: "please enter offer description",
                selectstore: "please select store",
                selectcategory: "please select category",
                startdate: "please select starting date",
                enddate: "please select ending date",
                coupontype: "please select coupon type",
                couponstatus: "please select coupon status"
            }
        });
    });
</script>