@props([
    'variant' => 'button',
    'class' => '',
    'iconUrl' => '',
    'iconAlt' => '',
])

@php
    $variants = [
        'button' => 'w-5 h-5',
        'menu' => 'w-[24px] h-[24px]', // perbaiki dari "2-[24px]"
    ];

    // fallback kalau variant tidak ditemukan
    $baseClass = $variants[$variant] ?? $variants['button'];

    // satukan class tanpa spasi berlebih
    $iconClass = trim("$baseClass $class");
@endphp

<img src="{{ $iconUrl }}" alt="{{ $iconAlt }}" class="{{ $iconClass }}" loading="lazy" />
