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

<form method="POST" action="{{ route('admin_settings_update_links_api') }}" enctype="multipart/form-data">

    <div class="form-group mb-3">
        <label>Page Title</label>
        <input type="text" class="form-control" name="main_title" value="{{ $data['main_title'] }}" />
    </div>

    <div class="form-group mb-3">
        <label>File name</label>
        <input type="text" class="form-control" name="file_name" value="{{ $data['file_name'] }}" />
    </div>

    <div class="form-group mb-3">
        <label>File size</label>
        <input type="text" class="form-control" name="file_size" value="{{ $data['file_size'] }}" />
    </div>

    <div class="form-group mb-3">
        <label>Download button text</label>
        <input type="text" class="form-control" name="download_btn" value="{{ $data['download_btn'] }}" />
    </div>

    <div class="form-group mb-3">
        <label for="video">Video links</label>
        <input type="text" name="download_links" class="form-control" value="{{ $data['download_links'] }}" />
    </div>

    <div class="form-group mb-3">
        <label for="video">Video</label>
        <input type="file" name="video" class="form-control" />
    </div>

    <input type="submit" value="CONFIRM" class="btn btn-success">

</form>


@endsection
