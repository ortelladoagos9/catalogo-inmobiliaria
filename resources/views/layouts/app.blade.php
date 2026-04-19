<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="icon" type="image/png" href="{{ asset('images/agencia-inmobiliaria.png') }}">
        <title>@yield('title', 'Inmobiliaria')</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-black">
        @include('components.navbar')

        @yield('breadcrumb')

        <main class="relative">
            <!-- Flash Messages -->
            <div class="fixed top-20 left-0 right-0 z-40 px-6">
                @include('components.flash-messages')
            </div>

            @yield('content')
        </main>

        @include('components.footer')
    </body>
</html>
