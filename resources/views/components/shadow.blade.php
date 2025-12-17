@props([
    'variant' => 'low', // low | medium | high
    'radius' => 'md', // sm | md | lg | none
    'inverse' => false,
    'inherit' => true,
])

@php
    $shadowClass = $inverse ? "shadow-{$variant}-inverse" : "shadow-{$variant}";
    $radiusClass = $radius !== 'none' ? "rounded-{$radius}" : '';
    $inheritClass = $inherit ? 'rounded-inherit' : '';
@endphp

<div {{ $attributes->merge(['class' => "{$shadowClass} {$radiusClass} {$inheritClass}"]) }}>
    {{ $slot }}
</div>
