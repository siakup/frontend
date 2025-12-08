@props([
    'id' => '',
    'data' => null,
    'variant' => 'active',
    'event' => 'week',
])

@php
    $variants = [
        'active' => 'white',
        'disable' => 'red',
    ];

    $selectedVariant = $variants[$variant];
    $icon = "timer/outline-$selectedVariant-12";
@endphp

<div class="card-jadwal {{ $event }} {{ $variant }}">
    <div class="grid grid-row-2 gap-1">
        <div>
            <x-typography :variant="'pixie-bold'">{{ $data['mataKuliah'] }} - {{ $data['kode'] }} - {{ $data['periode'] }}
                [{{ $data['kodeRuangan'] }}]</x-typography>
        </div>
        <div class="flex flex-cols gap-1">
            <x-icon :name="$icon"></x-icon>
            <x-typography :variant="'pixie-regular'" class="time {{ $variant }}">{{ $data['startTime'] }} -
                {{ $data['endTime'] }}</x-typography>
        </div>
    </div>
</div>
