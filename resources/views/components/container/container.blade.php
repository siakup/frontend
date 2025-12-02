{{-- resources\views\components\container.blade.php --}}

@props([
    'variant' => 'content',
    'class' => '',
])

@php
    $variants = [
        'content-wrapper' => 'content-wrapper', // konten utama
        'content' => 'content', // konten utama
        'wide' => 'wide', // layar penuh
        'narrow' => 'narrow', // konten kecil
        'content-grey' => 'content-grey', // konten abu-abu,
        'content-disable-white' => 'content-disable-white',
        'flat' => '',
        'red-gradient' => 'red-gradient',
        'green-gradient' => 'green-gradient',
        'yellow-gradient' => 'yellow-gradient',
        'blue-gradient' => 'blue-gradient',
        'disable-blue' => 'disable-blue',
        'content-sender' => 'content-sender',
        'content-receiver' => 'content-receiver',
        'disable-red-gradient' => 'disable-red-gradient',
        'content-under-navbar' =>  'content-under-navbar',
    ];

    $selectedVariant = isset($variants[$variant]) ? $variants[$variant] : $variants['content'];
    $containerClass = "{$selectedVariant} {$class}";
@endphp

<div {{ $attributes->merge(['class' => $containerClass]) }}>
    {{ $slot }}
</div>
