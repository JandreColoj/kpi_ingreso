<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
        <meta name="msapplication-TileColor" content="#3372DF">

        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ asset('css/library/getmdl-select.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/library/nv.d3.css') }}" rel="stylesheet">
        <link href="{{ asset('css/library/application.css') }}" rel="stylesheet">
        <link href="{{ asset('css/library/font-awesome-4.7.0/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/componentes.css') }}" rel="stylesheet">
        <link href="{{ asset('js/block/angular-block-ui.css') }}" rel="stylesheet">
        
    </head>

    <body ng-app="myApp">
        {{-- <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
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
        </nav> --}}

        @yield('content')

        <script type="text/javascript" src="{{asset('js/angular.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/appAngular.js')}}"></script>
        
        <script type="text/javascript" src="{{asset('js/library/d3.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/library/getmdl-select.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/library/material.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/library/nv.d3.js')}}"></script>
        
        <script type="text/javascript" src="{{asset('js/library/widgets/line-chart/line-chart-nvd3.js')}}"></script>
        {{-- <script type="text/javascript" src="{{asset('js/library/widgets/map/maps.js')}}"></script> --}}
        <script type="text/javascript" src="{{asset('js/library/widgets/pie-chart/pie-chart-nvd3.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/library/widgets/table/table.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/library/widgets/todo/todo.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/block/angular-block-ui.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/chart.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/highcharts.js')}}"></script>
        @stack('scripts')
    </body>

</html>
