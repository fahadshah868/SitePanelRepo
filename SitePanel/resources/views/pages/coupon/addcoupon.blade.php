<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="bootstrap-multiselect.css" type="text/css"/> -->

<script   src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>


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
                        
                        <!-- <select class="form-control">
                            <option>Select Store</option>
                            <option>Target</option>
                            <option>Kohl's</option>
                            <option>Papa John's</option>
                            <option>Macys</option>
                            <option>Amazon</option>
                            <option>Dominos</option>
                            <option>Pizza Hut</option>
                        </select> -->
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-field">
                        <div class="form-field-heading">Category</div>
                        <select class="form-control">
                            <option>Select Category</option>
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




<select id="multiselectwithsearch" multiple="multiple" class="form-control">
                            <option value="India">India</option>
                            <option value="Australia">Australia</option>
                            <option value="United State">United State</option>
                            <option value="Canada">Canada</option>
                            <option value="Taiwan">Taiwan</option>
                            <option value="Romania">Romania</option>
                        </select>
<script type="text/javascript" src="js/multiselectdropdown.js"></script>