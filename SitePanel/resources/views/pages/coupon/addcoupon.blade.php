
<div class="form-main-container">
    <div class="form-main-heading">Add Coupon</div>
    <hr>
    <form>
        <div class="form-container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Title</div>
                        <input type="text" class="form-control" placeholder="xyz"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Offer Type</div>
                        <select class="form-control">
                            <option>Select Offer Type</option>
                            <option>Sale</option>
                            <option>Code</option>
                            <option>Promo Code</option>
                            <option>Instore Coupon</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-field">
                        <div class="form-field-heading">Description</div>
                        <textarea class="form-control" placeholder="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Store</div>
                        <select class="multiselectdropdown" multiple data-live-search="true">
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
                        <div class="form-field-heading">Category</div>
                        <select class="multiselectdropdown" multiple data-live-search="true">
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
                        <div class="form-field-heading">Coupon Type</div>
                        <select class="form-control">
                            <option>Select Type</option>
                            <option>Normal</option>
                            <option>Popular</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Coupon Status</div>
                        <select class="form-control">
                            <option>Select Type</option>
                            <option>Active</option>
                            <option>Deactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Start Date</div>
                        <input type="date" class="form-control"/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">End Date</div>
                        <input type="date" class="form-control"/>
                    </div>
                </div>
            </div>
            <input type="submit" value="Add Coupon" class="btn btn-primary form-button"/>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('js/multiselectdropdown.js')}}"></script>