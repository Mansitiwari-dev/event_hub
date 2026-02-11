@props(['type' => 'button', 'variant' => 'primary'])

@php
$classes = 'btn';
switch($variant){
    case 'secondary': $classes .= ' btn-secondary'; break;
    case 'outline': $classes .= ' btn-outline'; break;
    case 'large': $classes .= ' btn-large'; break;
    case 'small': $classes .= ' btn-small'; break;
    default: $classes .= ' btn-primary';
}
@endphp

<button {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold text-white shadow-md transition transform hover:-translate-y-0.5']) }}>
    {{ $slot }}
</button>
