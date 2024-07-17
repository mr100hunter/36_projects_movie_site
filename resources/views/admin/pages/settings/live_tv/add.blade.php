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

<form method="post" action="{{ route('admin_live_tv_add_api') }}" enctype="multipart/form-data">

    <div class="form-group mb-3">
        <label>Movie name</label>
        <input type="text" class="form-control" name="name" />
    </div>

    <div class="form-group mb-3">
        <label>Links</label>
        <input type="text" class="form-control" name="links1"  />
    </div>

    <div class="form-group mb-3">
        <label>Picture</label>
        <input type="file" class="form-control" name="pic" />
    </div>

    <div class="form-group mb-3">
        <label for="content18">18+ content</label>
        <input type="checkbox" name="content18" id="content18" value="yes" />
    </div>


    <div class="card p-3 mb-4 d-none">
        <div class="form-group">
            <label>Movie Links1</label>
            <input type="text" class="form-control" name="linksaa1" value="Links1" />
        </div>
        <div class="form-group mb-3">
            <label>Movie Links Expired1</label>
            <input type="text" class="form-control" name="expired1" value="00" />
        </div>
    
        <div class="form-group">
            <label>Movie Links2</label>
            <input type="text" class="form-control" name="links2" value="Links2" />
        </div>
        <div class="form-group mb-3">
            <label>Movie Links Expired2</label>
            <input type="text" class="form-control" name="expired2" value="00" />
        </div>
    
        <div class="form-group">
            <label>Movie Links3</label>
            <input type="text" class="form-control" name="links3" value="Links3" />
        </div>
        <div class="form-group mb-3">
            <label>Movie Links Expired3</label>
            <input type="text" class="form-control" name="expired3" value="00" />
        </div>
    
        <div class="form-group">
            <label>Movie Links4</label>
            <input type="text" class="form-control" name="links4" value="Links4" />
        </div>
        <div class="form-group mb-3">
            <label>Movie Links Expired4</label>
            <input type="text" class="form-control" name="expired4" value="00" />
        </div>
    </div>
    
    <input type="submit" value="CONFIRM" class="btn btn-success">

</form>


@endsection
