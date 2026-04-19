<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="relative min-h-screen w-full flex items-center justify-center overflow-hidden">

            {{-- Imagen de fondo --}}
            <div class="absolute inset-0 -z-10">
                <img src="/images/pexels-apyfz-30136066.jpg"
                     class="w-full h-full object-cover scale-110">

                <!-- overlay violeta/azulado -->
                <div class="absolute inset-0 bg-gradient-to-br
                            from-indigo-900/70 via-purple-900/60 to-black/70"></div>
            </div>

            <!-- Breadcrumb/Back Navigation -->
            <div class="fixed top-8 left-6 z-40">
                <button onclick="history.back()" class="flex items-center gap-2 text-xs text-white/50 hover:text-white/80 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Atrás
                </button>
            </div>

            {{-- Contenido --}}
            <div class="w-full max-w-md px-6 py-8 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
