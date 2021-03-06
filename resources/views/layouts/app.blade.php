<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sidenav.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/f98e6d7453.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/leaflet.extra-markers.min.css') }}" rel="stylesheet">

    <!-- Maps -->
    <link href='https://api.mapbox.com/mapbox.js/v3.3.0/mapbox.css' rel='stylesheet' />

    <!-- Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="{{route('welcome')}}">Home</a>
                </li>
                <li>
                    <a href="#mapDetail" data-toggle="collapse" aria-expanded="false" class="placeDropdown">Maps</a>
                    <ul class="collapse list-unstyled" id="mapDetail">
                        <li>
                            <a href="{{route('map', 'PM1')}}">PM1</a>
                        </li>
                        <li>
                            <a href="{{route('map', 'PM2.5')}}">PM2.5</a>
                        </li>
                        <li>
                            <a href="{{route('map', 'PM10')}}">PM10</a>
                        </li>
                        <li>
                            <a href="{{route('map', 'Temperature')}}">Temperature</a>
                        </li>
                        <li>
                            <a href="{{route('map', 'Pressure')}}">Pressure</a>
                        </li>
                        <li>
                            <a href="{{route('map', 'Light')}}">Light</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/about') }}">About</a>
                </li>
            </ul>
        </nav>
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a href="{{route('home')}}" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" v-pre>
                                    Admin <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right text-dark" aria-labelledby="navbarDropdown">
                                    <a href="{{route('admin.devices.index')}}" class="dropdown-item">Devices</a>
                                    <a href="{{route('admin.places.index')}}" class="dropdown-item">Places & locations</a>
                                </div>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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
            </nav>
            @yield('content')
        </div>
        @yield('scripts')
    </div>
</body>

</html>
