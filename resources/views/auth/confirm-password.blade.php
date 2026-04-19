<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-semibold text-white mb-2">Confirmar contraseña</h2>
        <p class="text-white/60 text-sm">Esta es un área segura. Confirma tu contraseña para continuar.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="flex justify-center">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-8 text-center">
        <p class="text-white/60 text-sm">
            ¿Olvidaste tu contraseña?
            <a href="{{ route('password.request') }}" class="text-white hover:text-indigo-300 underline ml-1">
                Recupérala aquí
            </a>
        </p>
    </div>
</x-guest-layout>
