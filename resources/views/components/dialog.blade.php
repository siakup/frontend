@props([
    'variant' => 'yellow',
    'class' => '',
])

@php
    $base = 'px-5 py-3 border-[1px] rounded-lg flex flex-row gap-4 mx-auto';
    $variants = [
        'yellow' => 'bg-[#FFFBEB] border-[#FDD835]',
        'red' => 'bg-[#FBE8E6] border-[#EB474D]',
        'grey' => 'bg-[#F5F5F5] border-[#D9D9D9]',
        'blue' => 'bg-[#E9EDF4] border-[#0076BE]',
    ];

    $icon = [
        'yellow' => 'assets/icon-caution-warning.svg',
        'red' => 'assets/icon-caution-red.svg',
        'grey' => 'assets/icon-caution-black.svg',
        'blue' => 'assets/icon-caution-blue.svg',
    ];

    $selectedVariant = $variants[$variant] ?? $variants['yellow'];
    $selectedIcon = $icon[$variant] ?? $icon['yellow'];
    $dialogClass = "{$base} {$selectedVariant} {$class}";
@endphp

<div {{ $attributes->merge(['class' => $dialogClass]) }}>
    <x-icon iconUrl="{{ asset($selectedIcon) }}"/>
    <div class="flex-grow">
        {{ $slot }}
    </div>
</div>