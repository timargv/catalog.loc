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
                <div class="d-flex">
                    <div class="city mr-auto">
                        <i class="fas fa-location-arrow text-muted"></i>
                        <span>Регион:</span>
                        <a class="text-white border-bottom border-white text-decoration-none" href="#">Воронеж</a>
                    </div>

                    <div class="top-head-nav">
                        <ul class="list-unstyled nav p-0 text-white">
                            <li class="pl-3">Бесплатная <a class="text-white" href="#">доставка</a></li>
                            <li class="pl-3">Удобная <a class="text-white" href="#">оплата</a></li>
                            <li class="pl-3">Лёгкий <a class="text-white" href="#">возврат</a></li>
                        </ul>
                    </div>
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

            <div class="container pt-4 px-4 wm-1140 rounded-top bg-white position-relative" style="top: -20px; min-height: 1380px;">
                @section('breadcrumbs', Breadcrumbs::render())
                @yield('breadcrumbs')
                @yield('content')
            </div>
        </main>

        <footer class="p-5 text-white">
            <div class="container d-flex wm-1140">
                <div class="row w-100">
                    <div class="col-3">
                        <div class="footer-logo mb-3">
                            <a class="text-white h2 font-weight-bold text-decoration-none" href="/">атис</a>
                        </div>
                        <div class="footer-copy text-white-50">
                            © 2014 ООО «Атис» — интернет магазин с низкими ценами!
                            <a class="text-white w-100 mt-3 d-block" href="#">Пользовательское соглашение</a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-4">
                                <div class="title-footer-menu mb-3 font-weight-bold h5">
                                    Меню
                                </div>
                                <ul class="nav flex-column list-unstyled">
                                    <li class="nav-item h6"><a class="text-white text-decoration-none" href="#">Обратная связь</a></li>
                                    <li class="nav-item h6"><a class="text-white text-decoration-none" href="#">Мои заказы</a></li>
                                    <li class="nav-item h6"><a class="text-white text-decoration-none" href="#">Настройки</a></li>
                                    <li class="nav-item h6"><a class="text-white text-decoration-none" href="#">О сервисе</a></li>
                                </ul>
                            </div>
                            <div class="col-4">
                                <div class="title-footer-menu mb-3 font-weight-bold h5">
                                    Как купить
                                </div>
                                <ul class="nav flex-column list-unstyled">
                                    <li class="nav-item h6"><a class="text-white text-decoration-none" href="#">Оплата и доставка</a></li>
                                    <li class="nav-item h6"><a class="text-white text-decoration-none" href="#">Возврат</a></li>
                                    <li class="nav-item h6"><a class="text-white text-decoration-none" href="#">Помощь</a></li>
                                </ul>
                            </div>
                            <div class="col-4">
                                <div class="title-footer-menu mb-3 font-weight-bold h5">
                                    Партнёрам
                                </div>
                                <ul class="nav flex-column list-unstyled">
                                    <li class="nav-item h6"><a class="text-white text-decoration-none" href="#">Как начать сотрудничество</a></li>
                                    <li class="nav-item h6"><a class="text-white text-decoration-none" href="#">Справка для партнёров</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="footer-social-block">
                            <div class="title-footer-menu mb-3 font-weight-bold h5">
                                Атис в социальных сетях
                            </div>
                            <ul class="nav list-unstyled">
                                <li class="nav-item mr-2"><a class="text-white" href="#"><i class="fab fa-vk fa-2x"></i></a></li>
                                <li class="nav-item mr-2"><a class="text-white" href="#"><i class="fab fa-facebook fa-2x"></i></a></li>
                                <li class="nav-item mr-2"><a class="text-white" href="#"><i class="fab fa-ok fa-2x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

