<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-3 bg-white/10 border border-white/20 rounded-lg font-semibold text-sm text-white hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-transparent backdrop-blur-sm transition-all duration-200']) }}>
    {{ $slot }}
</button>
