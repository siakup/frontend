@props([
    'class' => '',
    'background' => 'transparent',
    'radius' => 'md', // sm | md | lg
    'padding' => null,
    'gap' => 'gap-0',
    'height' => null, // full|max|auto|fit
    'width' => null, // full|max|auto|fit
    'row' => null,
    'col' => null,
])

@php
    $widthMap = [
        'full' => 'w-full',
        'max' => 'w-max',
        'auto' => 'w-auto',
        'fit' => 'w-fit',
    ];

    $heightMap = [
        'full' => 'h-full',
        'max' => 'h-max',
        'auto' => 'h-auto',
        'fit' => 'h-fit',
    ];

    $gridMap = [
        'row' => array_combine(range(1, 12), array_map(fn($i) => "row-span-$i", range(1, 12))),
        'col' => array_combine(range(1, 12), array_map(fn($i) => "col-span-$i", range(1, 12))),
    ];

    $resolve = fn($value, $map) => $value !== null && isset($map[$value]) ? $map[$value] : null;

    $classes = collect([
        $resolve($row, $gridMap['row']),
        $resolve($col, $gridMap['col']),

        $background,
        "rounded-$radius",

        $resolve($width, $widthMap),
        $resolve($height, $heightMap),

        $padding,
        $gap,
        $class,
    ])
        ->filter()
        ->implode(' ');
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
