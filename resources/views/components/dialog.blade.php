@props([
    'variant' => 'warning',
    'dialogClass' => '',
    'isCloseable' => false,
])

@php
    $base = 'p-4 border rounded-sm flex flex-row gap-4 mx-auto my-4 text-left';
    $variants = [
        'warning' => 'bg-yellow-50 border-yellow-500',
        'danger' => 'bg-disable-red border-red-400',
        'info' => 'bg-gray-200 border-gray-400',
        'success' => 'bg-disable-blue border-blue-500',
    ];

    $icon = [
        'warning' => 'assets/icons/caution/outline-yellow-24.svg',
        'danger' => 'assets/icons/caution/outline-red-24.svg',
        'info' => 'assets/icons/caution/outline-grey-24.svg',
        'success' => 'assets/icons/caution/outline-blue-24.svg',
    ];

    $selectedVariant = $variants[$variant] ?? $variants['warning'];
    $selectedIcon = $icon[$variant] ?? $icon['warning'];
    $dialogClass = "{$base} {$selectedVariant} {$dialogClass}";
@endphp

<div 
    x-data="{ open: true }"
    x-show="open"
    x-transition:leave="transition-all ease-in duration-300"
    x-transition:leave-start="opacity-100 max-h-screen"
    x-transition:leave-end="opacity-0 max-h-0"
    {{ $attributes->merge(['class' => $dialogClass]) }}
>
    <x-icon iconUrl="{{ asset($selectedIcon) }}"/>

    <div class="flex-grow">
        @if (isset($header))
            <x-typography variant="body-medium-bold">
                {{ $header }}
            </x-typography>
        @endif
        <div class="flex flex-col">
            <x-typography variant="body-medium-regular">
                {{ $slot }}
            </x-typography>
        </div>
    </div>

    @if ($isCloseable)
        <button 
            class="self-start cursor-pointer"
            x-on:click="open = false"
        >
            <x-icon iconUrl="{{ asset('assets/icons/close-cancel/grey-16.svg') }}"/>
        </button>
    @endif
</div>