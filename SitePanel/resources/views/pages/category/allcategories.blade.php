<div class="viewitems-main-container">
    <div class="viewitems-main-heading">All Categories</div>
    <hr>
    <div class="viewitems-tableview">
        <table class="table table-bordered">
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