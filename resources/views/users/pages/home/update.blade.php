<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download Video</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .container .video{
            background: #dddd;
            height: 17rem;
            width: 100%;
            border-radius: 15px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center">{{ $management['main_title'] }}</h2>

        <video class="video mb-4 mt-4" src="{{ asset('video/movie/'.$management['video']) }}" controls autoplay></video>

        <h2 class="text-center">Name: {{ $management['file_name'] }}</h2>
        <h2 class="text-center mb-4">Size: {{ $management['file_size'] }}</h2>

        <div class="d-flex justify-content-center text-center">
            <a href="{{ $management['download_links'] }}" class="btn btn-warning">{{ $management['download_btn'] }}</a>
        </div>
    </div>

</body>
</html>
