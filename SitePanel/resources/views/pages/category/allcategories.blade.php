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
        <div class="viewitems-main-heading">All Categories</div>
        <div class="viewitems-header-searchbar"><input type="text" placeholder="Search Category" id="searchbar" class="form-control"/></div>
    </div>
    <hr>
    <div class="viewitems-tableview">
        <table class="table table-bordered" id="tableview">
            <thead>
                <tr>
                    <th>Category Title</th>
                    <th>Category Type</th>
                    <th>Category Status</th>
                    <th>Category Logo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @for($i=1; $i<=100; $i++)
                <tr>
                    <td>Clothing</td>
                    <td>Popular</td>
                    <td>Active</td>
                    <td><img src="https://www.designevo.com/res/templates/thumb_small/yellow-handbag-and-black-t-shirt.png" /></td>
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
<script type="text/javascript" src="{{asset('js/clientsidesearchbarfilter.js')}}"></script>
</body>
</html>