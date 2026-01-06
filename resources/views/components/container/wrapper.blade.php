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
    $rowsMap = [
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
    ];

    $colsMap = [
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
    ];

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

    use App\Helpers\Components\Utilities;

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
        ...Utilities::resolve($attributes),
    ])
        ->filter()
        ->implode(' ');
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
