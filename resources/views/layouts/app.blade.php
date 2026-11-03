<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- adds js class so animations only run when js works --}}
    <script>document.documentElement.classList.add('js')</script>
    <title>@yield('title', 'Barocco Art')</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=2">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}?v=2">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- base.css is for all pages, @stack adds the css of each page --}}
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    @stack('styles')

    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    {{-- menu and footer are in the partials folder --}}
    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>