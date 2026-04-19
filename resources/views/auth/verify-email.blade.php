<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-semibold text-white mb-2">Verificar email</h2>
        <p class="text-white/60 text-sm">¡Gracias por registrarte! Antes de comenzar, verifica tu dirección de email haciendo clic en el enlace que te enviamos.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-lg">
            <p class="text-green-400 text-sm">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </p>
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div class="flex justify-center">
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <div class="text-center">
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf

                <button type="submit" class="text-sm text-white/60 hover:text-white underline">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>

    <div class="mt-8 text-center">
        <p class="text-white/60 text-sm">
            ¿Ya verificaste tu email?
            <a href="{{ route('login') }}" class="text-white hover:text-indigo-300 underline ml-1">
                Inicia sesión aquí
            </a>
        </p>
    </div>
</x-guest-layout>
