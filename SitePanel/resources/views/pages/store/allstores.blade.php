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
        <div class="viewitems-header-searchbar"><input type="text" placeholder="Search Store" id="searchbar" class="form-control"/></div>
    </div>
    <hr>
    <div class="viewitems-tableview">
        <table class="table table-bordered" id="tableview">
            <thead>
                <tr>
                    <th>Store Title</th>
                    <th>Store Site Link</th>
                    <th>Store Type</th>
                    <th>Store Status</th>
                    <th>Store Logo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @for($i=1; $i<=100; $i++)
                <tr>
                    <td>kohls</td>
                    <td>www.kohls.com</td>
                    <td>Popular</td>
                    <td>Active</td>
                    <td><img src="https://botw-pd.s3.amazonaws.com/styles/logo-thumbnail/s3/0007/0994/brand.gif?itok=UM7EbV20" /></td>
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