<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    @stack('css')
    <!-- favicon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}">
    @php
    $configurations = App\Helpers\CommonHelper::getConfigurations();
    @endphp
    <title>{{ $configurations['website_name'] ?? '' }}</title>
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