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
        <a href="{{ route('settings.admin_category_add_web') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i></a>
        <div class="left">
            <input type="text" id="search_products" class="form-control" placeholder="Search something...">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>18+ Link</th>
                        <th>Normal link</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataType as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['role'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['link_18'] }}</td>
                            <td>{{ $item['link_normal'] }}</td>
                            <td><a href="{{route('admin_settings_category_st_controller_api', $item)}}" class="btn btn-info">@if($item['st'] == 1) Active @else Deactive @endif  </a></td>
                            <td>
                                <a href="{{ route('settings.admin_category_products_web', ['id' => $item['id']]) }}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('settings.admin_category_update_web', ['id' => $item['id']]) }}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a onclick="{return confirm('Are you sure ??')}" href="{{ route('admin_settings_category_delete_api', ['id' => $item['id']]) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="data" style="margin-top:2rem; margin-bottom:2rem">
        {{$dataType -> onEachSide(1) -> links()}}
    </div>

</div>

<style>
    tr td a.btn{
        text-transform: uppercase;
    }
    tr td img.images {
        height: 5rem;
        width: 5rem;
    }
    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
    }
    .left {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<script>
    const urls = {
        'search' : '{{ route('users_home_search_api') }}',
    }
    $("#search_products").keyup(function(){
        $.ajax({
            url: urls.search,
            method: "POST",
            data: {
                "where": "server2",
                type: "yes",
                search: $("#search_products").val()
            },
            success: function (data) {
                var map_data = data.data;
                if (map_data.length == 0) {
                $("tbody").html("<h4 class='text-danger title col-12'>No products found!</h4>");
                } else {
                let viewData = map_data.map((curE) => {
                    return `
                    <tr>
                        <td>${curE.id}</td>
                        <td><img class="images" src="{{ asset('images/products') }}/${curE.pic}" alt=""></td>
                        <td>${curE.name}</td>
                        <td><a href="{{url("/")}}/api/admin/settings/content18/${curE.id}" class="btn ${curE.content18 === "no" ? "btn-danger" : "btn-success"}">${curE.content18}</a></td>
                        <td>
                        <a href="{{url("/")}}/admin/settings/products_update/${curE.id}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{url("/")}}/api/admin/settings/products_update/${curE.id}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    `;
                });
                $("tbody").html(viewData.join(""));
                }
            }
        });
    });
</script>
@endsection
