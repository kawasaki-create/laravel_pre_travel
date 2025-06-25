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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- 広告ブロッカー検出用のbaitファイル -->
    <script src="{{ asset('ads.js') }}" async></script>
    
    <!-- Scripts -->
    @vite(['resources/css/app-modern.css', 'resources/sass/app.scss', 'resources/js/app.js'])

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
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #app-banner span {
            margin-right: 10px;
        }

        #app-banner a {
            display: inline-block;
            margin-right: 10px;
        }

        #app-banner button {
            margin-left: 10px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="font-sans antialiased">
    <!-- デバッグ用(すぐ消す)　-->
    <!-- <div>
        <a href="" style="width: 35px; height: 35px; border-radius: 22%; overflow: hidden; display: inline-block; vertical-align: middle;"><img src="https://is1-ssl.mzstatic.com/image/thumb/Purple221/v4/76/cf/55/76cf55e1-a085-7781-710a-50f44008ce9f/AppIcon-0-0-1x_U007emarketing-0-7-0-P3-85-220.png/540x540bb.jpg" alt="PreTravel〜旅行計画作成アプリ〜" style="width: 35px; height: 35px; border-radius: 22%; overflow: hidden; display: inline-block; vertical-align: middle;" id="badge"></a>
        <a href='https://play.google.com/store/apps/details?id=com.pretravel.kawasaki_create.pre_travel_mobile&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Google Play で手に入れよう' src='https://play.google.com/intl/ja/badges/static/images/badges/ja_badge_web_generic.png' style="width: 106px; height: 35px;" id="android-badge"/></a>
        <a href="https://apps.apple.com/jp/app/pretravel-%E6%97%85%E8%A1%8C%E8%A8%88%E7%94%BB%E4%BD%9C%E6%88%90%E3%82%A2%E3%83%97%E3%83%AA/id6478861524?itsct=apps_box_badge&amp;itscg=30200" style="display: inline-block; overflow: hidden; border-radius: 13px; width: 106px; height: 35px;"><img src="https://tools.applemediaservices.com/api/badges/download-on-the-app-store/white/ja-jp?size=250x83&amp;releaseDate=1709769600" alt="Download on the App Store" style="border-radius: 13px; width: 106px; height: 35px;" id="ios-badge"></a>
        <button>ひらく</button>
    </div> -->
    <!-- デバッグ用ここまで　-->
    <div id="app-banner" style="display: none;">
        <span>アプリ版DLはこちら：</span>
        <a href='https://play.google.com/store/apps/details?id=com.pretravel.kawasaki_create.pre_travel_mobile&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1' id="android-badge">
            <img alt='Google Play で手に入れよう' src='https://play.google.com/intl/ja/badges/static/images/badges/ja_badge_web_generic.png' style="width: 106px; height: 35px;">
        </a>
        <a href="https://apps.apple.com/jp/app/pretravel-%E6%97%85%E8%A1%8C%E8%A8%88%E7%94%BB%E4%BD%9C%E6%88%90%E3%82%A2%E3%83%97%E3%83%AA/id6478861524?itsct=apps_box_badge&amp;itscg=30200" id="ios-badge">
            <img src="https://tools.applemediaservices.com/api/badges/download-on-the-app-store/white/ja-jp?size=250x83&amp;releaseDate=1709769600" alt="Download on the App Store" style="border-radius: 13px; width: 106px; height: 35px;">
        </a>
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
        
        <!-- 広告ブロッカー検出モーダル -->
        @include('components.adblock-modal')
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var appBanner = document.getElementById('app-banner');
        var openAppButton = document.getElementById('open-app-button');
        var userAgent = navigator.userAgent || navigator.vendor;
        var urlScheme = 'pretravel://';
        var iosStoreUrl = 'https://apps.apple.com/app/id6478861524';
        var androidStoreUrl = 'https://play.google.com/store/apps/details?id=com.pretravel.kawasaki_create.pre_travel_mobile';
        var smartBr = document.getElementById('smart-br');
        var iosBadge = document.getElementById('ios-badge');
        var androidBadge = document.getElementById('android-badge');
        
        if (/iPhone|iPad|iPod/i.test(userAgent)) {
            iosBadge.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = iosStoreUrl;
            });
            appBanner.style.display = 'flex';
            androidBadge.style.display = 'none';

            openAppButton.textContent = '開く';
            openAppButton.addEventListener('click', function() {
                window.location.href = urlScheme;
            });
        } else if (/Android/i.test(userAgent)) {
            appBanner.style.display = 'flex';
            iosBadge.style.display = 'none';

            openAppButton.textContent = '開く';
            openAppButton.addEventListener('click', function() {
                window.location.href = urlScheme;
            });
        }

        if (/iPhone|iPad|iPod|Android/i.test(userAgent)) {
            openAppButton.style.display = 'inline-block';
            smartBr.style.display = 'block';
        }
    });
</script>
