<nav class="bg-gray-800 text-white p-4 flex justify-between">
    <div>
        <a href="/" class="font-bold">Inmobiliaria</a>
    </div>

    <div class="space-x-4">
        @auth
            <a href="{{ route('properties.index') }}">Propiedades</a>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('audit.index') }}">Ver auditoría</a>
            @endif

            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button>Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </div>
</nav>