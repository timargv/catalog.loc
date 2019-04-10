<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="/js/app.js" defer></script>
{{--    <script src="{{ mix('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/plug/plug.css">
{{--    <link href="{{ mix('css/app.css') }}" rel="stylesheet">--}}
</head>
<body>
    <div id="app">
        <div class="top-line bg-purpl text-white py-2">
            <div class="container wm-1140">
                <div class="city">
                    <i class="fas fa-location-arrow text-muted"></i>
                    <span>Регион:</span>
                    <a class="text-white border-bottom border-white text-decoration-none" href="#">Воронеж</a>
                </div>
            </div>
        </div>
        <nav class="navbar-laravel shadow-none pt-4 pb-2">
            <div class="container d-flex wm-1140">
                <a class=" navbar-brand position-relative px-5 font-weight-bold text-white" href="{{ url('/') }}">
                    {{--{{ config('app.name', 'SHOP VRN') }}--}}
                    <span class="position-absolute">атис</span>
                </a>

                <div class="flex-grow-1">
                    <div class="d-flex bd-highlight">
                        <!-- Left Side Of Navbar -->
                        @include('layouts.navbar._left')

                        <!-- Right Side Of Navbar -->
                        @include('layouts.navbar._right')
                    </div>
                </div>
            </div>
        </nav>

        <main class="position-relative bg-white-50" aria-live="polite" aria-atomic="true">
            @include('layouts.partials.flash')
            <div class="bg-purpl p-3"></div>
            <div class="container  wm-1140  position-relative " style="top: -20px">
                @yield('slide')
            </div>

            <div class="container pt-4 px-4 wm-1140 rounded-top bg-white position-relative" style="top: -20px">
                @section('breadcrumbs', Breadcrumbs::render())
                @yield('breadcrumbs')
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
