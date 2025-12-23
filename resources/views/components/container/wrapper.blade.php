@props([
    'rows' => null,
    'cols' => null,

    'gap' => null,
    'gapX' => null,
    'gapY' => null,

    'items' => 'start',
    'justify' => 'start',

    'width' => null,
    'height' => null,

    'sm:rows' => null,
    'md:rows' => null,
    'lg:rows' => null,
    'xl:rows' => null,

    'sm:cols' => null,
    'md:cols' => null,
    'lg:cols' => null,
    'xl:cols' => null,

    'sm:gap' => null,
    'md:gap' => null,
    'lg:gap' => null,
    'xl:gap' => null,

    'sm:width' => null,
    'md:width' => null,
    'lg:width' => null,
    'xl:width' => null,

    'sm:height' => null,
    'md:height' => null,
    'lg:height' => null,
    'xl:height' => null,
])

@php
    $rowsMap = array_combine(range(1, 12), array_map(fn($i) => "grid-rows-$i", range(1, 12)));

    $colsMap = array_combine(range(1, 12), array_map(fn($i) => "grid-cols-$i", range(1, 12)));

    $gapMap = array_combine(range(0, 9), array_map(fn($i) => "gap-$i", range(0, 9)));

    $widthMap = [
        'full' => 'w-full',
        'auto' => 'w-auto',
        'fit' => 'w-fit',
        'max' => 'w-max',
        'min' => 'w-min',
        'screen' => 'w-screen',
    ];

    $heightMap = [
        'full' => 'h-full',
        'auto' => 'h-auto',
        'fit' => 'h-fit',
        'max' => 'h-max',
        'min' => 'h-min',
        'screen' => 'h-screen',
    ];

    $resolve = function ($value, $map, $prefix = '') {
        if ($value === null) {
            return null;
        }
        return $map[$value] ?? null;
    };

    $classes = collect([
        'grid',

        $resolve($rows, $rowsMap),
        $resolve($cols, $colsMap),

        $resolve($gap, $gapMap),
        $gapX !== null ? "gap-x-$gapX" : null,
        $gapY !== null ? "gap-y-$gapY" : null,

        "items-$items",
        "justify-$justify",

        $resolve($width, $widthMap),
        $resolve($height, $heightMap),

        $resolve($attributes->get('sm:rows'), $rowsMap),
        $resolve($attributes->get('md:rows'), $rowsMap),
        $resolve($attributes->get('lg:rows'), $rowsMap),
        $resolve($attributes->get('xl:rows'), $rowsMap),

        $resolve($attributes->get('sm:cols'), $colsMap),
        $resolve($attributes->get('md:cols'), $colsMap),
        $resolve($attributes->get('lg:cols'), $colsMap),
        $resolve($attributes->get('xl:cols'), $colsMap),

        $resolve($attributes->get('sm:gap'), $gapMap),
        $resolve($attributes->get('md:gap'), $gapMap),
        $resolve($attributes->get('lg:gap'), $gapMap),
        $resolve($attributes->get('xl:gap'), $gapMap),

        $resolve($attributes->get('sm:width'), $widthMap),
        $resolve($attributes->get('md:width'), $widthMap),
        $resolve($attributes->get('lg:width'), $widthMap),
        $resolve($attributes->get('xl:width'), $widthMap),

        $resolve($attributes->get('sm:height'), $heightMap),
        $resolve($attributes->get('md:height'), $heightMap),
        $resolve($attributes->get('lg:height'), $heightMap),
        $resolve($attributes->get('xl:height'), $heightMap),
    ])
        ->filter()
        ->implode(' ');
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
