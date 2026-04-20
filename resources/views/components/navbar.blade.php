<nav class="absolute top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-8 py-5 flex justify-between items-center">
        @auth
            <a href="/properties/" class="text-white text-2xl font-semibold tracking-wide">
                Inmobiliaria
            </a>
            <p class="text-sm text-white/80 text-center">
                {{ auth()->user()->name }}
            </p>
        @else
            <!-- Logo -->
            <a href="/" class="text-white text-2xl font-semibold tracking-wide">
                Inmobiliaria
            </a>
        @endauth

        <!-- Links -->
        <div class="flex items-center gap-4 text-sm">

            @auth
                <a href="{{ route('properties.index') }}" class="text-white/80 hover:text-fuchsia-500 transition">
                    Propiedades
                </a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('audit.index') }}" class="text-white/80 hover:text-fuchsia-500 transition">
                        Auditorías
                    </a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="text-white/80 hover:text-fuchsia-500 transition">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" 
                   class="text-white/80 hover:text-white transition">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="px-5 py-2 rounded-full bg-white/10 backdrop-blur border border-white/20 text-white hover:bg-white hover:text-gray-900 transition">
                    Registrarse
                </a>
            @endauth

        </div>

    </div>
</nav>