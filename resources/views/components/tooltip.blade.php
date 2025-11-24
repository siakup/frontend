@props([
    'text' => '',
    'position' => 'top-center',
])

@php
    $positions = [
        // TOP
        'top-left'      => 'bottom-full left-0 mb-2',
        'top-center'    => 'bottom-full left-1/2 -translate-x-1/2 mb-2',
        'top-right'     => 'bottom-full right-0 mb-2',

        // BOTTOM
        'bottom-left' => 'top-full left-0 mt-2',
        'bottom-center' => 'top-full left-1/2 -translate-x-1/2 mt-2',
        'bottom-right' => 'top-full right-0 mt-2',

        // LEFT
        'left-top' => 'right-full top-0 mr-2',
        'left-center' => 'right-full top-1/2 -translate-y-1/2 mr-2',
        'left-bottom' => 'right-full bottom-0 mr-2',

        // RIGHT
        'right-top' => 'left-full top-0 ml-2',
        'right-center' => 'left-full top-1/2 -translate-y-1/2 ml-2',
        'right-bottom' => 'left-full bottom-0 ml-2',
    ];

    $positionClass = $positions[$position] ?? $positions['top-center'];

    $arrows = [
        // TOP arrow
        'top-left' => 'top-full left-3 -mt-1',
        'top-center' => 'top-full left-1/2 -translate-x-1/2 -mt-1',
        'top-right' => 'top-full right-3 -mt-1',

        // BOTTOM arrow
        'bottom-left' => 'top-0 left-3 -mt-1',
        'bottom-center' => 'top-0 left-1/2 -translate-x-1/2 -mt-1',
        'bottom-right' => 'top-0 right-3 -mt-1',

        // LEFT arrow
        'left-top' => 'left-full top-3 -ml-1',
        'left-center' => 'left-full top-1/2 -translate-y-1/2 -ml-1',
        'left-bottom' => 'left-full bottom-3 -ml-1',

        // RIGHT arrow
        'right-top' => 'right-full top-3 -mr-1',
        'right-center' => 'right-full top-1/2 -translate-y-1/2 -mr-1',
        'right-bottom' => 'right-full bottom-3 -mr-1',
    ];

    $arrowClass = $arrows[$position] ?? $arrows['top-center'];
@endphp

<div x-data="{ show: false }" class="relative inline-block">

    {{-- Trigger --}}
    <div x-on:mouseenter="show = true" x-on:mouseleave="show = false">
        {{ $slot }}
    </div>

    {{-- Tooltip --}}
    <div x-show="show" x-transition.opacity.duration.250ms
        class="absolute z-50 p-2 text-xs text-left text-gray-50 bg-gray-800 w-max max-w-60 rounded-lg shadow {{ $positionClass }}"
        style="display: none;">
        {{ $text }}

        {{-- Arrow --}}
        <div class="absolute w-2 h-2 bg-gray-900 rotate-45 {{ $arrowClass }}"></div>
    </div>

</div>
