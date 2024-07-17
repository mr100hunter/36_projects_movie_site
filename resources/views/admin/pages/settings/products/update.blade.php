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

<form action="{{ route('admin_settings_products_update_img_api', ['id' => $id]) }}" method="post" class="mb-5" enctype="multipart/form-data">
    <div class="form-group mb-3">
        <label>Update img</label>
        <input type="file" class="form-control" name="pic" />
    </div>

    <input type="submit" value="UPDATE" class="btn btn-success">

</form>

<form method="post" action="{{ route('admin_settings_products_update_content_api', ['id' => $id]) }}" >

    <div class="form-group mb-3">
        <label>Select Category</label>
        <select name="cat_id" id="" class="form-select">
            @foreach ($cat as $item)
                <option value="{{$item->id}}" @if($item->id == $data->category->id) selected @endif>{{$item->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <label>Products name</label>
        <input type="text" class="form-control" name="name" value="{{ $data['name'] }}" />
    </div>

    <div class="form-group mb-3">
        <label>Rank</label>
        <input type="text" class="form-control" name="role" value="{{ $data['role'] }}" />
    </div>

    <div class="form-group mb-3">
        <label>Products Links</label>
        <input type="text" class="form-control" name="links" value="{{ $data['links'] }}" />
    </div>

    <div class="form-group mb-3">
        <label for="content18">18+ content</label>
        <input type="checkbox" name="content18" id="content18" value="yes" @if($data['content18'] == "yes") checked @endif />
    </div>

    <input type="submit" value="CONFIRM" class="btn btn-success">

</form>


@endsection
