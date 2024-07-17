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
            <a href="{{route('users_note_web')}}"><img style="height:35px; " src="{{asset('images/icons/note.png')}}" ></a>
            <a href="{{route('users_home_web')}}"><img style="height:35px; " src="{{asset('images/icons/home.png')}}" ></a>
        </div>
    </div>

    <div class="container">
        <div style="background: white; border:1px solid #dddd; min-height:30vh;     padding: 20px;" class="card_row">
            
            <p>@php echo nl2br($userData->note); @endphp</p>

        </div>
    </div>


</body>
</html>
