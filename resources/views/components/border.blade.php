@props([
    'variant' => 'solid', // Tipe garis: solid | dashed | dotted | double | hidden
    'radius' => 'md', // Radius border: sm | md | lg | none
    'color' => 'gray-300', // Warna border
    'width' => '1', // Lebar border (px)
    'inherit' => true, // Apakah mengikuti radius parent
])

@php
    $inheritClass = $inherit ? 'rounded-inherit' : '';
    $borderVariantStyle = $variant === 'solid' ? 'border-style: solid;' : "border-style: {$variant}";
    $borderColorStyle = $color ? "border-color: var(--color-{$color})" : '';
    $borderWidthStyle = $width ? "border-width: {$width}px" : '';
@endphp

<div {{ $attributes->merge(['style' => "{$borderColorStyle}; {$borderWidthStyle}; {$borderVariantStyle}"]) }}
    {{ $attributes->merge(['class' => "rounded-{$radius} {$inheritClass}"]) }}>
    {{ $slot }}
</div>
