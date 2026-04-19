<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-semibold text-white mb-2">Restablecer contraseña</h2>
        <p class="text-white/60 text-sm">Ingresa tu nueva contraseña</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex justify-center">
            <x-primary-button>
                {{ __('Reset Password') }}
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
