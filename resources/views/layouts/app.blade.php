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
        <div class="top-line bg-purpl text-white py-1">
            <div class="container">
                <div class="city">
                    <i class="fas fa-location-arrow"></i>
                    <span>Регион:</span>
                    <a class="text-white border-bottom border-white text-decoration-none" href="#">Воронеж</a>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel shadow-none bg-white py-3">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @include('layouts.navbar._left')

                    <!-- Right Side Of Navbar -->
                    @include('layouts.navbar._right')
                </div>
            </div>
        </nav>

        <main class="py-4 position-relative bg-white-50" aria-live="polite" aria-atomic="true">
            @include('layouts.partials.flash')
            @yield('content')
        </main>
    </div>
</body>
</html>
