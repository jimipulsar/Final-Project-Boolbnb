<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Boolbnb</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/maps.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    

	

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/maps.css') }}" rel="stylesheet">

</head>
<body>

        <nav class="navbar navbar-expand-md navbar-light navbar-laravel bg-light" >
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="/storage/images/logo.png" style="height:60px;" class="imglogo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Entra</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}"> <i class="fas fa-user-plus"></i> Registrati</a>
                                @endif
                            </li>
                        @else
                        <li><a class="nav-link" href="{{ route('search.index') }}"><i class="fa fa-search"> </i> Ricerca</a></li>

                        <li><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i> Utenti</a></li>

                        <li><a class="nav-link" href="{{ route('roles.index') }}"><i class="fas fa-user-tag"></i> Ruoli</a></li>
                    
                        <li><a class="nav-link" href="{{ route('rooms.index') }}"><i class="fas fa-building"></i> Appartamenti</a></li>


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> <i class="fas fa-user-circle"></i>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right bg-light dropdown-light" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user"></i>
                                        Il mio profilo
                                    </a>
                                    <a class="dropdown-item" href="{{ route('rooms.stanze') }}"><i class="fas fa-bed"></i>
                                        Gestisci appartamenti
                                    </a>
                                   
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                                        Esci
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
        </nav>
      @yield('content')
      @include('partials.footer')
</body>
</html>
