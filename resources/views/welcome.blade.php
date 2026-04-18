<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inmobiliaria</title>

        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100 flex items-center justify-center h-screen">

        <div class="text-center">
            <h1 class="text-4xl font-bold mb-6">Sistema Inmobiliario</h1>

            <a href="{{ route('login') }}" 
            class="bg-blue-500 text-black px-6 py-2 rounded">
                Iniciar sesión
            </a>
        </div>

    </body>
</html>