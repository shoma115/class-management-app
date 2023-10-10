<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- jQueryのautocompleteライブラリ -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body>
    <div id="app">
        <main class="mb-5 pt-3">
            @yield('content')
        </main>  
    </div>
    @include('layouts.footer')
</body>
</html>
