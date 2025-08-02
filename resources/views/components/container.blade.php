{{-- resources\views\components\container.blade.php --}}

@props([
    'variant' => 'content',
    'class' => '',
])

@php
    $base = 'w-full mx-auto';
    $variants = [
        'content' => 'p-4 sm:p-5 bg-white rounded-3xl border-[1px] border-[#D9D9D9]', // konten utama
        'wide' => 'max-w-screen-xl px-4', // layar penuh
        'narrow' => 'max-w-lg px-4', // konten kecil
    ];

    $selectedVariant = isset($variants[$variant]) ? $variants[$variant] : $variants['content'];
    $containerClass = "{$base} {$selectedVariant} {$class}";
@endphp

<div {{ $attributes->merge(['class' => $containerClass]) }}>
    {{ $slot }}
</div>
