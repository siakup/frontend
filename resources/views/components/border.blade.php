@props([
    'radius' => 'md', // xs | sm | md | lg
    'width' => 1, // number
    'color' => 'gray-300',
    'variant' => 'solid', // solid | dashed | dotted | double | none | hidden
])

@php
    $radiusClass = match ($radius) {
        'xs' => 'rounded-xs',
        'sm' => 'rounded-sm',
        'md' => 'rounded-md',
        'lg' => 'rounded-lg',
        default => 'rounded-md',
    };

    $borderWidth = $width === 1 ? 'border' : "border border-{$width}";

    $colorBorder = "border-{$color}";

    $borderStyle = "border-{$variant}";
@endphp

<div {{ $attributes->merge(['class' => "{$radiusClass} {$borderWidth} {$borderStyle} {$colorBorder}"]) }}>
    {{ $slot }}
</div>
