@props([
    'class' => '',
    'background' => 'transparent',
    'radius' => 'md',
    'padding' => 'p-0',
    'gap' => 'gap-0',
    'height' => 'full',
    'width' => 'full',
    'row' => null,
    'col' => null,
])

@php
    // background guide
    // 'transparent',
    // 'content-white',
    // 'content-gray',
    // 'content-disable-white',
    // 'disable-red-gradient',
    // 'red-gradient',
    // 'green-gradient',
    // 'yellow-gradient',
    // 'blue-gradient',
    // 'disable-blue',
    // 'content-sender',
    // 'content-receiver',

    $widthSize = [
        'full' => 'w-full',
        'maxContent' => 'w-max',
        'auto' => 'w-auto',
        'fitContent' => 'w-fit',
    ];

    $heightSize = [
        'full' => 'h-full',
        'maxContent' => 'h-max',
        'auto' => 'h-auto',
        'fitContent' => 'h-fit',
    ];

    $grid = [
        'row' => [
            1 => 'row-span-1',
            2 => 'row-span-2',
            3 => 'row-span-3',
            4 => 'row-span-4',
            5 => 'row-span-5',
            6 => 'row-span-6',
            7 => 'row-span-7',
            8 => 'row-span-8',
            9 => 'row-span-9',
            10 => 'row-span-10',
            11 => 'row-span-11',
            12 => 'row-span-12',
        ],
        'col' => [
            1 => 'col-span-1',
            2 => 'col-span-2',
            3 => 'col-span-3',
            4 => 'col-span-4',
            5 => 'col-span-5',
            6 => 'col-span-6',
            7 => 'col-span-7',
            8 => 'col-span-8',
            9 => 'col-span-9',
            10 => 'col-span-10',
            11 => 'col-span-11',
            12 => 'col-span-12',
        ],
    ];

    $rowClass = $row ? $grid['row'][$row] ?? '' : '';
    $colClass = $col ? $grid['col'][$col] ?? '' : '';

    $containerClass = implode(' ', [
        $rowClass,
        $colClass,
        $background,
        "rounded-$radius",
        $widthSize[$width] ?? '',
        $heightSize[$height] ?? '',
        $padding,
        $gap,
        $class,
    ]);
@endphp

<div {{ $attributes->merge(['class' => $containerClass]) }}>
    {{ $slot }}
</div>
