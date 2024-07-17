@extends('admin.layout.master')
@section('admin_master')

<!--  -->
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

<form method="post" action="{{ route('admin_settings_category_update_api', ['id' => $id]) }}" enctype="multipart/form-data">
    <div class="form-group mb-3">
        <label>Rank</label>
        <input type="text" class="form-control" name="role" value="{{ $data['role'] }}" />
    </div>

    <div class="form-group mb-3">
        <label>Category name</label>
        <input type="text" class="form-control" name="name" value="{{ $data['name'] }}" />
    </div>

    <div class="form-group mb-3">
        <label>Category Links 18+</label>
        <input type="text" class="form-control" name="link_18" value="{{ $data['link_18'] }}" />
    </div>
    <div class="form-group mb-3">
        <label>Category Links Normal</label>
        <input type="text" class="form-control" name="link_normal" value="{{ $data['link_normal'] }}"  />
    </div>

    <input type="submit" value="CONFIRMED" class="btn btn-success">
</form>


@endsection
