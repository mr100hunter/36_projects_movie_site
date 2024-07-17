@extends('admin.layout.master')
@section('admin_master')

    <div class="container">


        @if (session() -> has('msg'))
            <div class="alert alert-primary d-flex align-items-center mt-5" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <div>
                    {{session() -> get('msg')}}
                </div>
            </div>
        @endif
        

        <div class="card mt-5 mb-5">
            <div style="display: flex; align-items:center; justify-content:space-between" class="card-header">
                @if (isset($_REQUEST['up']))
                    <p>UPDATE URL</p>
                @else
                    <p>ADD NEW URL</p>
                @endif
                <a href="{{route("settings.urls_admin_urls_web")}}" class="btn btn-success">ADD NEW</a>
            </div>
            <div class="card-body">
                <form @if(isset($_REQUEST['up'])) action="{{route("admin_urls_update_urls_api", ['id' => $_REQUEST['up']])}}" @else action="{{route("admin_urls_add_urls_api")}}" @endif method="post">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" placeholder="Your uniqe key name..." name="uniqeKey" @if($first_urls != "disabled") value="{{$first_urls['uniqeKey']}}" @endif />
                        </div>
                        <div class="col-12 mb-3"> 
                            <input type="text" class="form-control" placeholder="Your url address..." name="url" @if($first_urls != "disabled") value="{{$first_urls['url']}}" @endif />
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="CONFIRM">
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-2">
                <input type="text" class="form-control" placeholder="Search your url name..." id="search_url" />
            </div>
        </div>

        <div style="overflow-y: scroll" class="table_wrapper">
            <table style="min-width: 25rem;" class="table">
                <thead class="bg-dark text-light">
                    <tr>
                        <th scope="col">#</th>
                        <th id="is_copy" scope="col">Sorten Url</th>
                        <th scope="col">Url</th>
                        <th scope="col">View</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="table_data">
                    @foreach ($urls as $item)
                        <tr>
                            <th scope="row">{{$item['id']}}</th>
                            <td class="text_copy">{{route("settings.urls_admin_urls_links_web")}}/{{$item['uniqeKey']}}</td>
                            <td><input type="text" style="min-width:6rem" value="{{$item['url']}}" class="form-control"></td>
                            <td>{{$item['view']}}</td>
                            <td>
                                <a href="{{route("settings.urls_admin_urls_web")}}?up={{$item['id']}}" class="btn btn-success">UPDATE</a>
                                <a href="{{route("admin_urls_delete_urls_api", ['id' => $item['id']])}}" class="btn btn-danger">DELETE</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{$urls -> onEachSide(1) -> links()}}

    </div>


    {{-- <script></script> --}}
    <script>
        const urls = {
            "search" : '{{route('admin_urls_search_api')}}',
            "url" : '{{url("")}}',
        }
    </script>
    <script>
        $("#search_url").keyup(function(){
            console.log($("#search_url").val());
            $.ajax({
                "url" : urls.search,
                "method" : "POST",
                'data' : {
                    "url" : $("#search_url").val()
                },
                success:function(data){
                    console.log(data);
                    const map_data = data.data;
                    const map_filtaring_data = map_data.map((curE) => {
                        return `
                        <tr>
                            <th scope="row">${curE.id}</th>
                            <td class="text_copy" >${urls.url}/${curE.uniqeKey}</td>
                            <td><input style="min-width:6rem"  type="text" value="${curE.url}" class="form-control"></td>
                            <td>${curE.view}</td>
                            <td>
                                <a href="${urls.url}/?up=${curE.id}" class="btn btn-success">UPDATE</a>
                                <a href="${urls.url}/api/admin/deshbord/delete_urls/${curE.id}" class="btn btn-danger">DELETE</a>
                            </td>
                        </tr>
                        `
                    })

                    $("#table_data").html(map_filtaring_data);
                }
            });
        });
        // Select the text you want to copy
        $('.text_copy').click(function(){
            $("#is_copy").html("Coping...");
            setTimeout(() => {
                $("#is_copy").html("Sorten Url");
            }, 300);

            let textToCopy = $(this).html();
            try {
            // Use the newer Clipboard API if available
            navigator.clipboard.writeText(textToCopy).then(function() {
            }, function() {
                // If Clipboard API is not available, use document.execCommand() instead
                const textField = document.createElement("textarea");
                textField.value = textToCopy;
                document.body.appendChild(textField);
                textField.select();
                document.execCommand("copy");
                textField.remove();
            });
            } catch (err) {
                // Fallback to document.execCommand() if Clipboard API is not available
                const textField = document.createElement("textarea");
                textField.value = textToCopy;
                document.body.appendChild(textField);
                textField.select();
                document.execCommand("copy");
                textField.remove();
            }
        });

    </script>


@endsection
