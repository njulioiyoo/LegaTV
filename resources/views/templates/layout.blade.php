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
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @yield('meta-name')

    <!-- style -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    @stack('css')
    <!-- favicon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}">

    <meta name="abstract" content="{{ $configurations['website_description'] }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Reply-to" content="{{ $configurations['website_mail'] }}">

    <title>{{ $configurations['website_name'] ?? '' }}</title>

    <meta property="og:title" content="{{ $configurations['website_name'] }}" />
    <meta property="og:description" content="{{ $configurations['website_description'] }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.legatvonline.com" />
    <meta property="og:site_name" content="{{ $configurations['website_name'] }}">

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
</body>

</html>