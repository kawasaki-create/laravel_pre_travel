<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PreTravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        #app-banner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
            z-index: 9999;
        }
    </style>
</head>
<body>
    <div id="app-banner" style="display: none;">
        <img src="{{ asset('img/ptfav.png') }}" alt="">
        <a id="app-link" href="#" style="margin-right: 20px;"></a>
        <button id="open-app-button" style="display: none;"></button>
    </div>
    <div id="smart-br" style="display: none;">
        <br><br>
    </div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @auth
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'PreTravel') }}
                    </a>
                @else
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'PreTravel') }}
                    </a>
                @endauth
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>
</html>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var appBanner = document.getElementById('app-banner');
        var appLink = document.getElementById('app-link');
        var openAppButton = document.getElementById('open-app-button');
        var userAgent = navigator.userAgent || navigator.vendor;
        var urlScheme = 'pretravel://';
        var iosStoreUrl = 'https://apps.apple.com/app/id6478861524';
        var androidStoreUrl = 'https://play.google.com/store/apps/details?id=com.pretravel.kawasaki_create.pre_travel_mobile';
        var smartBr = document.getElementById('smart-br');
        
        if (/iPhone|iPad|iPod/i.test(userAgent)) {
            appLink.href = iosStoreUrl;
            appLink.textContent = 'App Storeでダウンロード';
            appLink.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = iosStoreUrl;
            });
            appBanner.style.display = 'inline-block';

            openAppButton.textContent = '開く';
            openAppButton.addEventListener('click', function() {
                window.location.href = urlScheme;
            });
        } else if (/Android/i.test(userAgent)) {
            appLink.href = androidStoreUrl;
            appLink.textContent = 'Google Playでダウンロード';
            appLink.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = androidStoreUrl;
            });
            appBanner.style.display = 'inline-block';

            openAppButton.textContent = '開く';
            openAppButton.addEventListener('click', function() {
                window.location.href = urlScheme;
            });
        }

        // Check if the app is installed
        // var fallbackLink = document.createElement('a');
        // fallbackLink.href = urlScheme;
        // fallbackLink.style.display = 'none';
        // document.body.appendChild(fallbackLink);

        // fallbackLink.click();

            if (/iPhone|iPad|iPod|Android/i.test(userAgent)) {
                // appLink.style.display = 'none';
                openAppButton.style.display = 'inline-block';
                smartBr.style.display = 'inline-block';
            }
    });
</script>
