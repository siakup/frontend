{{-- resources\views\components\container.blade.php --}}

@props([
    'variant' => 'content',
    'class' => '',
    'borderRadius' => 'rounded-3xl',
])

@php
    $variants = [
        'content-wrapper' => 'content-wrapper', // konten utama
        'content' => 'content', // konten utama
        'wide' => 'wide', // layar penuh
        'narrow' => 'narrow', // konten kecil
        'content-grey' => 'content-grey', // konten abu-abu,
        'flat' => ''
    ];

    $selectedVariant = isset($variants[$variant]) ? $variants[$variant] : $variants['content'];
    $containerClass = "{$selectedVariant} {$class} {$borderRadius}";
@endphp

<div {{ $attributes->merge(['class' => $containerClass]) }}>
    {{ $slot }}
</div>
