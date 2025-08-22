@props([
    'type' => 'view', // 'view', 'edit', 'delete'
    'label' => '',
    'icon' => '', // optional override (full asset path),
    'iconAlt' => '', // optional alt override
])

@php
    $types = [
        'view' => [
            'color' => 'text-gray-800 hover:underline',
            'icon' => asset('assets/icon-search.svg'),
            'alt' => 'Lihat',
        ],
        'edit' => [
            'color' => 'text-red-500 hover:underline',
            'icon' => asset('assets/icon-edit.svg'),
            'alt' => 'Ubah',
        ],
        'delete' => [
            'color' => 'text-gray-600 hover:underline',
            'icon' => asset('assets/icon-delete-gray-600.svg'),
            'alt' => 'Hapus',
        ],
    ];

    $config = $types[$type] ?? $types['view'];
    $iconUrl = $icon ?: $config['icon'];
    $iconAlt = $iconAlt ?: $config['alt'];
@endphp

<button {{ $attributes->merge(['class' => $config['color'] . ' flex items-center gap-1 text-sm cursor-pointer']) }}>
    <x-icon :iconUrl="$iconUrl" :iconAlt="$iconAlt" class="w-4 h-4" />
    <span>{{ $label }}</span>
</button>
