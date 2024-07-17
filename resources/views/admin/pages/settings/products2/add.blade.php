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

<form method="post" action="{{ route('admin_settings_products2_add_api') }}" enctype="multipart/form-data">

    <div class="form-group mb-3">
        <label>Products name</label>
        <input type="text" class="form-control" name="name" />
    </div>

    <div class="form-group mb-3">
        <label>Products Links</label>
        <input type="text" class="form-control" name="links" />
    </div>

    <div class="form-group mb-3">
        <label>Picture</label>
        <input type="file" class="form-control" name="pic"  />
    </div>

    <div class="form-group mb-3">
        <label for="content18">18+ content</label>
        <input type="checkbox" name="content18" id="content18" value="yes" />
    </div>

    <input type="submit" value="CONFIRM" class="btn btn-success">

</form>


@endsection
