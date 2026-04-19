<!-- Breadcrumb Navigation -->
<nav class="absolute top-16 left-0 w-full z-40 px-6 py-3">

    <div class="max-w-7xl mx-auto flex items-center gap-1 text-xs text-white/50">

        @foreach($items as $index => $item)
            @if($index > 0)
                <span class="mx-1">/</span>
            @endif

            @if(isset($item['url']))
                <a href="{{ $item['url'] }}" class="hover:text-white/80 transition">
                    {{ $item['label'] }}
                </a>
            @else
                <span class="text-white/80">{{ $item['label'] }}</span>
            @endif
        @endforeach

    </div>
</nav>
