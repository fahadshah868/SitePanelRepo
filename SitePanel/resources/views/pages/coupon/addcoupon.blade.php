<div class="form-main-container">
    <div class="form-main-heading">Add Coupon</div>
    <hr>
    <form id="addcouponform">
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Title</div>
                        <input type="text" class="form-control" name="offertitle" placeholder="xyz"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type</div>
                        <select class="form-control" name="offertype">
                            <option value="">Select Offer Type</option>
                            <option value="Sale">Sale</option>
                            <option value="Code">Code</option>
                            <option value="Promo Code">Promo Code</option>
                            <option value="Instore Coupon">Instore Coupon</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Description</div>
                        <textarea class="form-control" name="offerdescription" placeholder="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Select Store</div>
                        <select class="multiselectdropdown" name="selectstore" multiple data-live-search="true">
                            <option>Target</option>
                            <option>Kohl's</option>
                            <option>Papa John's</option>
                            <option>Macys</option>
                            <option>Amazon</option>
                            <option>Dominos</option>
                            <option>Pizza Hut</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Select Category</div>
                        <select class="multiselectdropdown" name="selectcategory" multiple data-live-search="true">
                            <option>Baby</option>
                            <option>Clothing</option>
                            <option>Jewelery</option>
                            <option>Assessories</option>
                            <option>Beauty</option>
                            <option>Electronics</option>
                            <option>Food</option>
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
            <input type="submit" value="Add Coupon" class="btn btn-primary form-button"/>
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
                offerdescription: "required",
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
                offerdescription: "please enter offer description",
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