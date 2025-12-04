@props([
    'variant' => 'secondary',
])

@php
    $variants = [
        'primary' => 'card-mk-primary',
        'secondary' => 'card-mk-secondary',
    ];

    $backgrounds = [
        'primary' => "background-image: url('/images/bg-card-study.png')",
        'secondary' => "background-image: url('/images/bg-study-list.png')",
    ];

    $selectedVariant = $variants[$variant] ?? $variants['secondary'];
    $selectedBg  = $backgrounds[$variant] ?? $backgrounds['secondary'];

@endphp

<div class="card-mk-base {{ $selectedVariant }}"
    style="{{ $selectedBg }}">
    <x-typography variant="body-large-bold">{{ $mataKuliah }}</x-typography>
    <div>
        <x-typography variant="body-medium-bold">{{ $sks }} SKS | {{ $kode }}</x-typography>
    </div>
</div>
