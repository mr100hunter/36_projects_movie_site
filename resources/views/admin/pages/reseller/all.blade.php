@extends('admin.layout.master')
@section('admin_master')

<!-- Example DataTables Card-->
<div class="container">
    <div class="row">
        @if (session() -> has('msg'))
            <div class="alert alert-success col-12" role="alert">
                <h4 class="alert-heading">Alert</h4>
                <hr>
                <p>{{session() -> get('msg')}}</p>
            </div>
        @endif
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> DATA TABLE
        <a href="{{ route('users.admin_add_web') }}" class="btn btn-success">ADD NEW</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Expired date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userData as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['username'] }}</td>
                            <td>{{ ( $item['expired'] - time())/86400 }}</td>
                            <td>
                                <a href="{{ route('admin_reseller_ban_api', ['id' => $item['id']]) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                <a href="{{ route('users.admin_update_web', ['id' => $item['id']]) }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="data" style="margin-top:2rem; margin-bottom:2rem">
        {{$userData -> onEachSide(1) -> links()}}
    </div>

</div>
@endsection
