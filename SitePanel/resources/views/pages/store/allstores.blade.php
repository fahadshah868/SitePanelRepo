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
                @if(count($allstores) > 0)
                    @foreach($allstores as $store)
                        <tr>
                            <td>{{ $store->title }}</td>
                            <td>{{ $store->site_url }}</td>
                            <td>{{ $store->type }}</td>
                            <td>{{ $store->status }}</td>
                            <td><img src="{{ asset($store->logo_url) }}"/></td>
                            <td>
                                <a href="/updateuser/{{$store->id}}" id="updaterecord" class="btn btn-primary"><i class="fa fa-edit"></i>Update</a>
                                <a href="/deleteuser/{{$store->id}}" data-storetitle='{{$store->title}}' data-storetype='{{$store->type}}' id="deleterecord" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/clientsidesearchbarfilter.js')}}"></script>