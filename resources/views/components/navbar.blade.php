<nav class="absolute top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-6 md:px-8 py-5 flex justify-between items-center">
        @auth
            <a href="/properties/" class="text-white text-xl md:text-2xl font-semibold tracking-wide">
                Inmobiliaria
            </a>
            <p class="hidden md:block text-sm text-white/80 text-center flex-1">
                {{ auth()->user()->name }}
            </p>
            <p class="md:hidden text-xs text-white/80 font-bold absolute left-1/2 transform -translate-x-1/2 top-5 mt-2 ml-8">
                {{ auth()->user()->name }}
            </p>
        @else
            <!-- Logo -->
            <a href="/" class="text-white text-xl md:text-2xl font-semibold tracking-wide">
                Inmobiliaria
            </a>
        @endauth

        <!-- Links Desktop -->
        <div class="hidden md:flex items-center gap-4 text-sm">

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

        <!-- Hamburger Menu Mobile -->
        @auth
            <button class="md:hidden text-white focus:outline-none" id="mobile-menu-toggle">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        @endauth

    </div>

    <!-- Mobile Menu -->
    @auth
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-6 py-4 bg-gray-950/95 backdrop-blur border-b border-white/10 space-y-3">
                <a href="{{ route('properties.index') }}" class="block text-white/80 hover:text-fuchsia-500 transition py-2">
                    Propiedades
                </a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('audit.index') }}" class="block text-white/80 hover:text-fuchsia-500 transition py-2">
                        Auditorías
                    </a>
                @endif

                <form action="{{ route('logout') }}" method="POST" class="pt-2 border-t border-white/10">
                    @csrf
                    <button type="submit" class="block text-white/80 hover:text-fuchsia-500 transition py-2 w-full text-left">Logout</button>
                </form>
            </div>
        </div>
    @endauth

</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('mobile-menu-toggle');
        const menu = document.getElementById('mobile-menu');
        
        if (toggle && menu) {
            toggle.addEventListener('click', function() {
                menu.classList.toggle('hidden');
            });

            // Cerrar menú al hacer click en un link
            const links = menu.querySelectorAll('a, button');
            links.forEach(link => {
                link.addEventListener('click', function() {
                    menu.classList.add('hidden');
                });
            });
        }
    });
</script>