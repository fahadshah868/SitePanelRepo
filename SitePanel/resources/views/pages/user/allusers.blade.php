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
                @if(count($allusers) > 0)
                    @foreach($allusers as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->password }}</td>
                            <td>{{ $user->usertype }}</td>
                            <td>{{ $user->userstatus }}</td>
                            <td>
                                <a href="/updateuser/{{$user->id}}" class="btn btn-primary">Update</a>
                                <a href="/updateuser/{{$user->id}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/clientsidesearchbarfilter.js')}}"></script>