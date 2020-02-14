<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    @yield('custom_css')

</head>
<body>
    <div id="app">

        <navbar-component></navbar-component>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    
    @yield('custom_js')
</body>
</html>

        {{-- <nav class="navbar navbar-expand-md navbar-light navbar-laravel bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Brand') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto nav-flex-icons">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="badge badge-danger ml-2">{{ count(auth()->user()->unreadNotifications) > 0 ? count(auth()->user()->unreadNotifications) : 0 }}</span>
                                    <i class="fas fa-bell"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink-5">
                                    @if(count(auth()->user()->unreadNotifications) > 0)
                                        @foreach(auth()->user()->unreadNotifications as $notification)
                                            @if($notification->type == 'App\Notifications\UserRegistered')
                                                <a class="dropdown-item waves-effect waves-light" href="{{ route('read.notifications', $notification->notifiable_id) }}">
                                                    New User has been registered {{ $notification->data['email']}}
                                                </a>
                                            @elseif($notification->type == 'App\Notifications\CommentPost')
                                                <a class="dropdown-item waves-effect waves-light" href="{{ route('read.notifications', $notification->notifiable_id) }}">
                                                    {{ $notification->data['user'] }} commented on your post

                                                </a>
                                            @endif
                                        @endforeach
                                    @else
                                        <a href="" class="dropdown-item waves-effect waves-light"> View all Notifications</a>
                                    @endif
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.index') }}"> <i class="fa fa-users"></i> Users</a>
                                    <a class="dropdown-item" href="{{ route('chats.index') }}"><i class="fa fa-comment"></i> Chat Box</a>
                                    <a class="dropdown-item" href="{{ route('posts.index') }}"> <i class="fa fa-sticky-note"></i> Posts</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

