<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-semibold text-white mb-2">Iniciar sesión</h2>
        <p class="text-white/60 text-sm">Accede a tu cuenta</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-white/20 bg-white/10 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <label for="remember_me" class="ml-2 block text-sm text-white/80">
                {{ __('Remember me') }}
            </label>
        </div>

        <div class="flex items-center justify-between">
            @if (Route::has('password.request'))
                <a class="text-sm text-white/60 hover:text-white underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-8 text-center">
        <p class="text-white/60 text-sm">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-white hover:text-indigo-300 underline ml-1">
                Regístrate aquí
            </a>
        </p>
    </div>
</x-guest-layout>
