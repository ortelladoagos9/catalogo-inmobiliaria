<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-semibold text-white mb-2">Recuperar contraseña</h2>
        <p class="text-white/60 text-sm">Ingresa tu email para recibir un enlace de recuperación</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="flex justify-center">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-8 text-center">
        <p class="text-white/60 text-sm">
            ¿Recordaste tu contraseña?
            <a href="{{ route('login') }}" class="text-white hover:text-indigo-300 underline ml-1">
                Inicia sesión aquí
            </a>
        </p>
    </div>
</x-guest-layout>
