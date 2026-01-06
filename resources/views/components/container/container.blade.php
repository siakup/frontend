@props([
    'class' => '',
    'background' => 'transparent',
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

    $resolve = fn($value, $map) => $value !== null && isset($map[$value]) ? $map[$value] : null;

    use App\Helpers\Components\Utilities;

    $classes = collect([
        $resolve($row, $gridMap['row']),
        $resolve($col, $gridMap['col']),
        $background,
        $resolve($width, $widthMap),
        $resolve($height, $heightMap),
        $class,
        ...Utilities::resolve($attributes),
    ])->filter()->unique()->implode(' ');
@endphp

<div {{ $attributes->except([
        'rows', 'cols',
        'gap', 'gapX', 'gapY',
        'padding', 'px', 'py', 'pt', 'pb', 'pl', 'pr',
        'margin', 'marginX', 'marginY', 'mt', 'mb', 'ml', 'mr',
        'spaceX', 'spaceY',
        'shadow',
        'radius',
        'border', 'borderWidth', 'borderColor',
    ])->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
