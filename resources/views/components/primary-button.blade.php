<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full px-6 py-3 rounded-lg bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-200']) }}>
    {{ $slot }}
</button>
