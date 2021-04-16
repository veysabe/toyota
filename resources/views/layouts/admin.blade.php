<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Админ панель</title>

    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <header class="header">
        <div class="container">
            <div class="header-content">
                <img src="img/logo.png" alt="">
                <div class="phone">
                    <a href="tel:+74752456000"><img src="img/phone.png" alt="">
                        <span>+7 4752 456 000</span></a>
                </div>
            </div>
        </div>
    </header>
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
