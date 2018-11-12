<div class="viewitems-main-container">
    <div class="viewitems-main-heading">All Stores</div>
    <hr>
    <div class="viewitems-tableview">
        <table class="table table-bordered">
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
