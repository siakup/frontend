@props([
    'variant' => 'warning',
    'dialogClass' => '',
    'isCloseable' => false,
])

@php
    $icon = [
        'warning' => 'yellow',
        'danger' => 'red',
        'info' => 'grey',
        'success' => 'blue',
    ];

    $selectedIconColor = $icon[$variant] ?? $icon['warning'];
    $iconName = "caution/outline-$selectedIconColor-24";
    $dialogClass = "dialog-base $variant $dialogClass";
@endphp

<div x-data="{ open: true }" x-show="open" x-transition:leave="transition-all ease-in duration-300"
    x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0"
    {{ $attributes->merge(['class' => $dialogClass]) }}>
    <x-icon :name="$iconName" class="w-fit self-center" />

    <div class="grow">
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
        <button class="self-start cursor-pointer" x-on:click="open = false">
            <x-icon :name="'close-cancel/grey-16'" />
        </button>
    @endif
</div>
