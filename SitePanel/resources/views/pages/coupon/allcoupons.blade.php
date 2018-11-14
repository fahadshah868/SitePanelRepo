<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="viewitems-main-container">
    <div class="viewitems-header-container">
        <div class="viewitems-main-heading">All Stores</div>
        <div class="viewitems-header-searchbar"><input type="text" placeholder="Search Coupon" id="searchbar" class="form-control"/></div>
    </div>
    <hr>
    <div class="viewitems-tableview">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Offer Title</th>
                    <th>Offer Type</th>
                    <th>Description</th>
                    <th>Store</th>
                    <th>Category</th>
                    <th>Coupon Type</th>
                    <th>Coupon Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @for($i=1; $i<=100; $i++)
                <tr>
                    <td>upto 40% off on clothing</td>
                    <td>Code</td>
                    <td>description about coupon</td>
                    <td>Kohl's</td>
                    <td>Clothing</td>
                    <td>Popular</td>
                    <td>Active</td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
</body>
</html>