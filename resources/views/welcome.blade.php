@extends('layouts.app')

@section('title', 'Bienvenido - CATALOGO')

@section('content')
<div class="relative min-h-screen w-full flex items-center justify-center overflow-hidden">

    {{-- Imagen de fondo --}}
    <div class="absolute inset-0 -z-10">
        <img src="/images/pexels-apyfz-30136066.jpg"
             class="w-full h-full object-cover scale-110">

        <!-- overlay violeta/azulado -->
        <div class="absolute inset-0 bg-gradient-to-br 
                    from-indigo-900/70 via-purple-900/60 to-black/70"></div>
    </div>

    {{-- Contenido --}}
     <div class="text-center px-6 max-w-2xl">

        {{-- Logo --}}
        <div class="mx-auto mb-6 flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 12l8.954-8.955a1.126 1.126 0 011.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        </div>

        {{-- Etiqueta superior --}}
        <p class="text-xs tracking-[0.3em] uppercase text-white/60 mb-4">
            · Catálogo Inmobiliario ·
        </p>

        {{-- Título --}}
        <h1 class="text-5xl md:text-6xl font-semibold text-white mb-6 leading-tight">
            Bienvenido a<br>Gestión Inmobiliaria
        </h1>

        {{-- Subtítulo --}}
        <p class="text-lg text-white/80 mb-10">
            Encontrá, gestioná y administrá propiedades de forma simple.
        </p>

        {{-- Botones --}}
        <div class="flex gap-3 justify-center">
            <a href="{{ route('login') }}"
                    class="inline-block px-10 py-4 rounded-full 
                    bg-gradient-to-r from-indigo-500 to-purple-600
                    text-white font-semibold text-lg
                    shadow-xl shadow-purple-500/30
                    hover:scale-105 hover:shadow-purple-500/50
                    transition-all duration-300">
                Iniciar sesión
            </a>
        </div>

    </div>
</div>
@endsection