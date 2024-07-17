<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WELCOME</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <link rel="stylesheet" href="{{asset('style/style.css?v=1.1.1')}}">
    <script>
        // if(window.location.origin != 'https://new.msw-app.com'){
        //     window.location.href="https://i.ibb.co/xhc2n9H/IMG-20240112-WA0001.jpg";
        // }
    </script>
    <script>
        document.addEventListener('contextmenu', function (e) {
            // e.preventDefault();
        });
    </script>
    <script>
        document.addEventListener('keydown', function (e) {
            // if (e.ctrlKey && e.code === 'KeyC') {
            //     e.preventDefault();
            // }
        });
    </script>
</head>
<body>

    <div class="home_header" style="background: {{ $management['bg_color'] }};">
        <p class="title">Username: {{$userData['username']}} <br> @if(intval(($userData['expired']-time())/86400) < 1) Expired Today @else Validity:  {{intval(($userData['expired']-time())/86400)+1}} days @endif</p>
        @if($userData['role'] == "1")
            <button class="btn btn-primary" id="Change_Color">EDIT</button>
            <input type="color" id="colo_box" style="display:none" id="">
        @endif

        <div style="display: flex;align-items: center;justify-content: center" class="content_wrapper18">
            <a href="{{route('users_note_web')}}"><img style="height:35px;margin-right: 10px;" src="{{asset('images/icons/note.png')}}" ></a>
            <div>
                <input id="checkbox" type="checkbox" class="checkbox" @if(session() -> has('content18')) value="on" checked @else value="no" @endif>
                <label for="checkbox" class="switch">
                  <span class="switch__circle">
                    <span class="switch__circle-inner"></span>
                  </span>
                  <span class="switch__left">Off</span>
                  <span class="switch__right">On</span>
                </label>
            </div>
        </div>
    </div>
    
    <div class="container">
          <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($slider as $item)
                        @if(session() -> has('content18') == "on")
                            <a href="{{ $item['links'] }}" class="swiper-slide">
                                <img style="height:30vh" src="{{ asset('images/slider/'.$item['img']) }}" alt="">
                            </a>
                        @else
                            @if($item['user_adult'] == 0)
                                <a href="{{ $item['links'] }}" class="swiper-slide">
                                    <img style="height:30vh" src="{{ asset('images/slider/'.$item['img']) }}" alt="">
                                </a>
                            @endif
                        @endif
                @endforeach
            </div>
        </div>

        <marquee style="transform: translateY(-8.4rem); color: #D03030; font-weight: bold; font-size: 15px;" behavior="scroll">
            {{$management->news2}}
        </marquee>

        {{-- <div style="background: white; border:1px solid #dddd;" class="card_row p-2 mb-3">

        </div> --}}

        <div style="background: white; border:1px solid #dddd;" class="card_row">

            <div class="button_wrapper">
                @foreach ($cat as $item)
                    <div class="btn_w">
                        <a href="{{route("cat", ['id' => $item->id])}}" class="btn @if($id == $item->id) btn-primary @else btn-dark  @endif" style="width:100%; text-align: center; text-transform:uppercase;white-space: nowrap;">{{$item->name}}</a>
                    </div>
                @endforeach
            </div>

            @if ($userData['products_access'] == "Yes")
                <div class="row p-4 pb-0">
                    <input type="hidden" id="hidden_value" value="@if(session() -> has('content18')){{$cat_r['link_18']}}@else{{$cat_r['link_normal']}}@endif" />
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" style="text-align: center" id="search_input" placeholder="Search" />
                        <a href="" id="search_data" class="btn btn-secondary"><i class="fa-solid fa-magnifying-glass"></i></a>
                    </div>
                </div>
            @else
                <div class="row p-4 pb-0">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" style="text-align: center" placeholder="Search" />
                        <a class="btn btn-secondary"><i class="fa-solid fa-magnifying-glass"></i></a>
                    </div>
                </div>
            @endif

            <div id="all_products_wrapper" class="row">
                @foreach ($products as $item)
                    @php
                        if(Route::is("users_livetv_web")){
                            $links = $item['links1'];
                        }else{
                            $links = $item['links'];
                        }
                    @endphp

                    @if ($userData['products_access'] == "Yes")
                        <a href="{{ $links }}" class="col-4 mt-3">
                            <img class="images" src="{{ asset('images/products/'.$item['pic']) }}" alt="">
                            <h2 class="title">{{ $item['name'] }}</h2>
                        </a>
                    @else
                        <a class="col-4 mt-3 products_access">
                            <img class="images" src="{{ asset('images/products/'.$item['pic']) }}" alt="">
                            <h2 class="title">{{ $item['name'] }}</h2>
                        </a>
                    @endif

                @endforeach
            </div>
        </div>

        <center id="center" style="transform: translateY(-55px);"><script type="text/javascript" src="https://cdn.livetrafficfeed.com/static/online/live.v2.js?text=ffffff&bg=e61c1c&ro=0&tz=America%2FNew_York"></script><noscript id="LTF_online_website"><a href="http://livetrafficfeed.com/online-counter">Online Counter</a></noscript></center>
        @if($userData['role'] != "1")
            <style>
                #center{
                    opacity:0;
                }
            </style>
        @endif
        
    </div>
   
    

    <div id="hidden_wrapper" class="d-none">
        <div class="container">
            <h2 class="title">You are currenctly unavaiable for access!</h2>
        </div>
    </div>

    <input type="hidden" id="where" value="{{$where}}" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" ></script>
    <script>
        const urls = {
            'content18' : '{{ route('users_home_content18_api') }}',
            'expired_time' : '{{ route('users_home_getexpired_time_api') }}',
            'search' : '{{ route('users_home_search_api') }}',
            'home_bg' : '{{ route('users_home_change_bg_color_api') }}',
            'url' : '{{ url("/") }}',
        }
    </script>

    <script src="{{ asset('script\users\home.js') }}"></script>


</body>
</html>
