@props(['title' => '', 'subtitle' => '', 'footer' => null])

<div {{ $attributes->merge(['class' => 'bg-white/80 backdrop-blur rounded-xl p-4 shadow-md']) }}>
    @if($title)
        <div class="card-header">
            <h3 class="text-lg font-bold">{{ $title }}</h3>
            @if($subtitle)
                <p class="text-sm text-gray-600">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    <div class="card-body">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>
