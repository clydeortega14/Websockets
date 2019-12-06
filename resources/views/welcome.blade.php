<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto+Condensed:100,600" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="/css/bootstrap.css" type="text/css">

        <!-- Custom Css -->
        <link rel="stylesheet" type="text/css" href="/css/style.css">
    </head>
    <body>

        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        @endif

        <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script scr="/js/bootstrap.js" type="text/javascript"></script>
    </body>
</html>
