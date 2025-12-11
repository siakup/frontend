@props([
    'rows' => 1,
    'cols' => 1,
    'gapX' => 0,
    'gapY' => 0,
    'padding' => 'p-4',
    'align' => 'start',
    'justify' => 'start',
    'height' => 'full',
    'width' => 'full',
])

@php
    $grid = [
        'rows' => [
            1 => 'grid-rows-1',
            2 => 'grid-rows-2',
            3 => 'grid-rows-3',
            4 => 'grid-rows-4',
            5 => 'grid-rows-5',
            6 => 'grid-rows-6',
            7 => 'grid-rows-7',
            8 => 'grid-rows-8',
            9 => 'grid-rows-9',
            10 => 'grid-rows-10',
            11 => 'grid-rows-11',
            12 => 'grid-rows-12',
        ],
        'cols' => [
            1 => 'grid-cols-1',
            2 => 'grid-cols-2',
            3 => 'grid-cols-3',
            4 => 'grid-cols-4',
            5 => 'grid-cols-5',
            6 => 'grid-cols-6',
            7 => 'grid-cols-7',
            8 => 'grid-cols-8',
            9 => 'grid-cols-9',
            10 => 'grid-cols-10',
            11 => 'grid-cols-11',
            12 => 'grid-cols-12',
        ],
    ];

    $gap = [
        'x' => [
            1 => 'gap-x-1',
            2 => 'gap-x-2',
            3 => 'gap-x-3',
            4 => 'gap-x-4',
            5 => 'gap-x-5',
            6 => 'gap-x-6',
            7 => 'gap-x-7',
            8 => 'gap-x-8',
            9 => 'gap-x-9',
        ],
        'y' => [
            1 => 'gap-y-1',
            2 => 'gap-y-2',
            3 => 'gap-y-3',
            4 => 'gap-y-4',
            5 => 'gap-y-5',
            6 => 'gap-y-6',
            7 => 'gap-y-7',
            8 => 'gap-y-8',
            9 => 'gap-y-9',
        ],
    ];
@endphp

<div
    {{ $attributes->merge(['class' => 'grid grid-rows-' . $rows . ' grid-cols-' . $cols . ' w-full h-full ' . $padding . ' gap-x-' . $gapX . ' gap-y-' . $gapY . ' items-' . $align . ' justify-' . $justify]) }}>
    {{ $slot }}
</div>
