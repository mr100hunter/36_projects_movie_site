<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In!!</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    /* Importing fonts from Google */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
    /* Reseting */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background-image: url('{{asset('images/icons/'.$data['bg'])}}');
        background-size:100% 100%;
    }

    .wrapper {
        max-width: 310px;
        min-height: 500px;
        margin: 80px auto;
        padding: 15px;
        /* padding-top: 0; */
        background: #ecf0f3;
        border-radius: 15px;
        /* box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff; */
    }

    .logo {
        width: 80px;
        margin: auto;
    }

    .logo img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0px 0px 3px #5f5f5f,
            0px 0px 0px 5px #ecf0f3,
            8px 8px 15px #a7aaa7,
            -8px -8px 15px #fff;
    }

    .wrapper .name {
        font-weight: 600;
        font-size: 1.4rem;
        letter-spacing: 1.3px;
        padding-left: 10px;
        color: #555;
    }

    .wrapper .form-field input {
        width: 100%;
        display: block;
        border: none;
        outline: none;
        background: none;
        font-size: 1.2rem;
        color: #666;
        padding: 10px 15px 10px 10px;
        /* border: 1px solid red; */
    }

    .wrapper .form-field {
        padding-left: 10px;
        margin-bottom: 20px;
        border-radius: 20px;
        box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
    }

    .wrapper .form-field .fas {
        color: #555;
    }

    .wrapper .btn {
        box-shadow: none;
        width: 100%;
        height: 40px;
        background-color: #03A9F4;
        color: #fff;
        border-radius: 25px;
        box-shadow: 3px 3px 3px #b1b1b1,
            -3px -3px 3px #fff;
        letter-spacing: 1.3px;
    }

    .wrapper .btn:hover {
        background-color: #039BE5;
    }

    .wrapper a {
        text-decoration: none;
        font-size: 0.8rem;
        color: #03A9F4;
    }

    .wrapper a:hover {
        color: #039BE5;
    }

    .login_wrapper {
        height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column
    }

    .news_wrapper{
        display: block;
        margin: auto;
        overflow: hidden;
    }
    .news_wrapper .news{
        white-space: nowrap;
        transform: translateX(0px);
        margin-bottom: 0 !important;
        padding-bottom: 15px;
    }

    @media(max-width: 380px) {
        .wrapper {
            margin: 30px 20px;
            padding: 15px 15px 15px 15px;
        }
    }

    </style>
</head>
<body>

    <div class="login_wrapper">
        <div class="wrapper">

            @if(!empty($data['news']))
                <div class="news_wrapper">
                    <p class="news" style="color: #D03030" >{{ $data['news'] }}</p>
                </div>
            @endif

            <div class="logo">
                <img src="{{asset('images/contact/'.$data['logo'])}}" alt="">
            </div>

            <div class="text-center mt-4 name">
                WELCOME
            </div>
            <form style="padding-top: 0 !important" class="p-3" id="submit_form">

                <span id="error"></span>

                <p style="text-align: center">Enter your username</p>
                <div class="form-field d-flex align-items-center">
                    <span class="far fa-user"></span>
                    <input type="text" name="userName" id="login_username" placeholder="Username">
                </div>
                <button style="background: #D03030" id="sub_btn" class="btn mt-3">Login</button>
            </form>
            <div class="text-center fs-6">
                <a href="#" class="" style="color: #D03030">Contact US</a>
                <div class="icons mt-3" style="display: flex; align-items:center;justify-content:center; gap:15px">
                    <a href="{{$data['links1']}}"><img style="width: 3rem;height: 3rem;border-radius: 50%;" src="{{asset('images/contact/'.$data['img1'])}}" alt=""></a>
                    <a href="{{$data['links2']}}"><img style="width: 3rem;height: 3rem;border-radius: 50%;" src="{{asset('images/contact/'.$data['img2'])}}" alt=""></a>
                    <a href="{{$data['links3']}}"><img style="width: 3rem;height: 3rem;border-radius: 50%;" src="{{asset('images/contact/'.$data['img3'])}}" alt=""></a>
                </div>
            </div>
        </div>
    </div>

    {{-- hidden input  --}}
    <input type="hidden" value="" id="city">
    <input type="hidden" value="" id="ip">
    <input type="hidden" value="" id="loc">

    {{-- script  --}}
    <script>
        const urls = {
            'login' : '{{ route('users_users_login_api') }}'
        }
    </script>
    <script src="{{ asset('script\users\accounts.js') }}?v=1.1.4"></script>

</body>
</html>

