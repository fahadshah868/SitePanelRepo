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
        <div class="viewitems-header-searchbar"><input type="text" placeholder="Search User" id="searchbar" class="form-control"/></div>
    </div>
    <hr>
    <div class="viewitems-tableview">
        <table class="table table-bordered" id="tableview">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>User Type</th>
                    <th>User Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @for($i=1; $i<=1; $i++)
                <tr>
                    <td>bilal</td>
                    <td>12345</td>
                    <td>Employee</td>
                    <td>Active</td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr><tr>
                    <td>Ali</td>
                    <td>12345</td>
                    <td>Employee</td>
                    <td>Active</td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr><tr>
                    <td>zohaib</td>
                    <td>12345</td>
                    <td>Employee</td>
                    <td>Active</td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr><tr>
                    <td>daniel</td>
                    <td>12345</td>
                    <td>Employee</td>
                    <td>Active</td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr><tr>
                    <td>nabeel</td>
                    <td>12345</td>
                    <td>Employee</td>
                    <td>Active</td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr><tr>
                    <td>awais</td>
                    <td>12345</td>
                    <td>Employee</td>
                    <td>Active</td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr><tr>
                    <td>sajaad</td>
                    <td>12345</td>
                    <td>Employee</td>
                    <td>Active</td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr><tr>
                    <td>waqas</td>
                    <td>12345</td>
                    <td>Employee</td>
                    <td>Active</td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr><tr>
                    <td>omer</td>
                    <td>12345</td>
                    <td>Employee</td>
                    <td>Active</td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr><tr>
                    <td>javed</td>
                    <td>12345</td>
                    <td>Employee</td>
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
<script type="text/javascript" src="{{asset('js/clientsidesearchbarfilter.js')}}"></script>
</body>
</html>