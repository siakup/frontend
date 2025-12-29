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
        'row' => array_combine(range(1, 12), array_map(fn($i) => "row-span-$i", range(1, 12))),
        'col' => array_combine(range(1, 12), array_map(fn($i) => "col-span-$i", range(1, 12))),
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
