@if (session('success') || session('error'))
<div 
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 5000)"
    x-show="show"
    x-transition
    class="fixed top-24 right-6 z-50 max-w-sm w-full">

    <div class="flex items-start gap-3 p-4 rounded-xl backdrop-blur-md 
        border shadow-lg
        {{ session('success') 
            ? 'bg-green-500/20 border-green-400/30 text-green-200' 
            : 'bg-red-500/20 border-red-400/30 text-red-200' }}">

        <!-- Icono -->
        <div>
            @if(session('success'))
                <svg class="w-5 h-5 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                </svg>
            @else
                <svg class="w-5 h-5 text-red-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"/>
                </svg>
            @endif
        </div>

        <!-- Texto -->
        <div class="flex-1 text-sm font-medium">
            {{ session('success') ?? session('error') }}
        </div>

        <!-- Botón cerrar -->
        <button @click="show = false" 
                class="text-white/50 hover:text-white transition text-sm">
            ✕
        </button>

    </div>
</div>
@endif