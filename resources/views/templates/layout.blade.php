<!DOCTYPE html>
<html lang="en">
@php
$configurations = App\Helpers\CommonHelper::getConfigurations();
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="revisit-after" content="3 days">
    <meta name="robots" content="all,index,follow">
    <meta name="author" content="{{ $configurations['website_name'] }}">
    <meta name="googlebot" content="index,follow">
    <meta name="googlebot-news" content="index,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @if (\Route::currentRouteName() != 'news.detail' && \Route::currentRouteName() != 'program.detail' && Route::currentRouteName() != 'article.detail')
    <meta name="title" content="Berita Terkini dan Informasi Terbaru Hari Ini">
    <meta name="description" content="Lega TV - Situs portal berita nasional dan daerah yang menyajikan informasi terkini dan terbaru seperti, Berita Politik, Hukum, Keuangan, Teknologi">
    <meta name="keywords" content="legatv, legatvonline, berita terkini, berita hari ini, berita terbaru, kabar terkini, kabar terbaru, seputar indonesia, berita daerah, berita indonesia">
    @else
    @yield('meta-name')
    @endif

    <link rel="canonical" href="https://www.legatvonline.com/">

    <!-- style -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    @stack('css')
    <!-- favicon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}">

    <meta name="abstract" content="{{ $configurations['website_description'] }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Reply-to" content="{{ $configurations['website_mail'] }}">

    <title>{{ $configurations['website_name'] ?? '' }} - @yield('title')</title>

    <meta property="og:title" content="{{ $configurations['website_name'] }}" />
    <meta property="og:description" content="{{ $configurations['website_description'] }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.legatvonline.com" />
    <meta property="og:site_name" content="{{ $configurations['website_name'] }}">

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3111379389900750" crossorigin="anonymous"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PKT7G0HD0G"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-PKT7G0HD0G');
    </script>
</head>

<body>

    @include('templates.header')

    @yield('content')

    @include('templates.footer')

    @stack('script')
    <!-- app bundle -->
    <script src="{{ asset('assets/app.bundle.min.js') }}"></script>
    <script>
        // Function to check if the "cookies_accepted" cookie is set to "true"
        function areCookiesAccepted() {
            var cookies = document.cookie.split(";");
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i].trim();
                if (cookie.startsWith("cookies_accepted=")) {
                    var value = cookie.substring("cookies_accepted=".length);
                    return value === "true";
                }
            }
            return false;
        }

        // Function to hide the cookie message
        function hideCookieMessage() {
            var cookieContainer = document.getElementById("accept");
            if (areCookiesAccepted()) {
                cookieContainer.style.display = "none";
            }
        }

        // Check the cookie value and hide the message on page load
        window.addEventListener("load", hideCookieMessage);

        // Event listener for the "Accept All Cookies" button
        document
            .getElementById("accept-cookies-btn")
            .addEventListener("click", function() {
                // Set the "cookies_accepted" cookie to "true"
                document.cookie = "cookies_accepted=true; path=/";

                // Hide the cookie message immediately
                hideCookieMessage();
            });

        // Check the cookie value and hide the message after a short delay
        setTimeout(hideCookieMessage, 1);
    </script>
</body>

</html>