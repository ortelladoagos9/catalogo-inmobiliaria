@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'p-4 bg-green-500/10 border border-green-500/20 rounded-lg text-green-400 text-sm']) }}>
        {{ $status }}
    </div>
@endif
