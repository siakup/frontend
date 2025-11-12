{{-- resources\views\components\container.blade.php --}}

@props([
    'variant' => 'content',
    'class' => '',
    'borderRadius' => 'rounded-3xl',
])

@php
    $base = 'w-full mx-auto';
    $variants = [
        'content-wrapper' => 'px-5 flex flex-col gap-5', // konten utama
        'content' => 'p-4 sm:p-5 bg-white border-[1px] border-[#D9D9D9]', // konten utama
        'wide' => 'max-w-screen-xl px-4', // layar penuh
        'narrow' => 'max-w-lg px-4', // konten kecil
        'content-grey' => 'p-4 sm:p-5 bg-[#D9D9D9] rounded-3xl min-h-[68px]', // konten abu-abu
    ];

    $selectedVariant = isset($variants[$variant]) ? $variants[$variant] : $variants['content'];
    $containerClass = "{$base} {$selectedVariant} {$class} {$borderRadius}";
@endphp

<div {{ $attributes->merge(['class' => $containerClass]) }}>
    {{ $slot }}
</div>
