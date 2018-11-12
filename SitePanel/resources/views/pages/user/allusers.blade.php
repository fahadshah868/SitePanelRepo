<div class="viewitems-main-container">
    <div class="viewitems-main-heading">All Users</div>
    <hr>
    <div class="viewitems-tableview">
        <table class="table table-bordered">
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
                @for($i=1; $i<=100; $i++)
                <tr>
                    <td>Ali</td>
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