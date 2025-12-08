@props([
    'variant' => 'secondary',
    'data'=> null,
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
    <x-typography variant="body-large-bold">{{ $data['nama'] }}</x-typography>
    <div>
        <x-typography variant="body-medium-bold">{{ $data['sks'] }} SKS | {{ $data['kode'] }}</x-typography>
    </div>
</div>
