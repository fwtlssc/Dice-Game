<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="icon" href="{{asset('files/favicon.ico')}}">
    @yield('styles')
    <style>
        body{
            background-image: url("{{asset('files/wood.png')}}");
            background-repeat: no-repeat;
            background-size:100% 100%;
        }
        footer{
            background-image: url("{{asset('files/wood1.png')}}");

        }
        nav{
            background-image: url("{{asset('files/wood1.png')}}");
        }

    </style>
    <title>Roll A Dice</title>
</head>
<body class="d-flex flex-column">
    <nav class="navbar navbar-expand navbar-dark p-3 justify-content-center">
        <h2 class="navbar-brand">Roll a dice</h2>
    </nav>
    <main class="flex-grow-1">
        @yield('content')
    </main>
    <footer class="p-4 text-center d-flex align-items-center justify-content-center">
        <p>&copy; 2021 Mohammad Termanini</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @yield('scripts')
</body>
</html>