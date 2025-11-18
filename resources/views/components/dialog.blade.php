@props([
    'variant' => 'warning',
    'dialogClass' => '',
    'isCloseable' => false,
])

@php
    $base = 'px-5 py-3 border rounded-lg flex flex-row gap-4 mx-auto my-4';
    $variants = [
        'warning' => 'bg-yellow-50 border-yellow-500',
        'danger' => 'bg-disable-red border-red-400',
        'info' => 'bg-gray-200 border-gray-400',
        'success' => 'bg-disable-blue border-blue-500',
    ];

    $icon = [
        'warning' => 'assets/icon-caution-warning.svg',
        'danger' => 'assets/icon-caution-red.svg',
        'info' => 'assets/icon-caution-black.svg',
        'success' => 'assets/icon-caution-blue.svg',
    ];

    $selectedVariant = $variants[$variant] ?? $variants['warning'];
    $selectedIcon = $icon[$variant] ?? $icon['warning'];
    $dialogClass = "{$base} {$selectedVariant} {$dialogClass}";
@endphp

<div 
    x-data="{ open: true }"
    x-show="open"
    {{ $attributes->merge(['class' => $dialogClass]) }}
>
    <x-icon iconUrl="{{ asset($selectedIcon) }}"/>
    <div class="flex-grow">
        {{ $slot }}
    </div>
    @if ($isCloseable)
        <button 
            class="self-start cursor-pointer"
            x-on:click="open = false"
        >
            <x-icon iconUrl="{{ asset('assets/base/icon-close-cancel.svg') }}" class="h-4 w-4"/>
        </button>
    @endif
</div>