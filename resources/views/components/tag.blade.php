@props([
    'variant' => 'red-filled',
    'size' => 'lg',
    'border' => 'default',
    'tagClass' => '',
])

@php
    $base = 'inline-flex flex items-center justify-center';

    $borders = [
        'default' => 'rounded-xs',
        'pill' => 'rounded-2xl',
    ];

    $sizes = [
        'xl' => 'text-base w-25 h-8 py-1 px-3',
        'lg' => 'text-xs w-20 h-6 py-1 px-3',
        'md' => 'text-[10px] w-25 h-4 py-1 px-4'
    ];

    $variants = [
        'red-bordered' => 'border bg-red-50 border-red-400 text-red-400',
        'red-monochrome' => 'bg-red-50 border-red-400 text-red-400',
        'red-filled' => 'bg-red-400 text-gray-50',
        'yellow-bordered' => 'border -yellow-100 border-yellow-500 text-gray-800',
        'yellow-monochrome' => 'bg-yellow-100 text-gray-800',
        'yellow-filled' => 'bg-yellow-400 text-gray-800',
        'blue-bordered' => 'border bg-blue-50 border-blue-400 text-blue-600',
        'blue-monochrome' => 'bg-blue-50 text-blue-600',
        'blue-filled' => 'bg-blue-400 text-gray-50',
        'green-bordered' => 'border bg-green-50 border-green-400 text-green-700',
        'green-monochrome' => 'bg-green-50 text-green-700',
        'green-filled' => 'bg-green-400 text-gray-800',
    ];

    $selectedVariant = $variants[$variant] ?? $variants['red-filled'];
    $selectedSizes = $sizes[$size] ?? $sizes['lg'];
    $selectedBorder = $borders[$border] ?? $borders['default'];

    $tag = "{$base} {$selectedVariant} {$selectedSizes} {$selectedBorder} {$tagClass}";
@endphp

<span {{ $attributes->merge(['class' => $tag])}}>
  {{ $slot }}
</span>