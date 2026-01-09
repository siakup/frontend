{{-- resources\views\components\container.blade.php --}}

@props([
    'variant' => 'content',
    'class' => '',
    'background' => 'transparent',
    'radius' => 'md',
    'padding' => 'p-0',
    'gap' => 'gap-0',
    'height' => 'full',
    'width' => 'full'
])

@php
    // background guide
    // 'transparent',
    // 'content-white',
    // 'content-grey',
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
      'fitContent' => 'w-fit'
    ];

    $heightSize = [
      'full' => 'h-full',
      'maxContent' => 'h-max',
      'auto' => 'h-auto',
      'fitContent' => 'H-fit'
    ];

    $containerClass = "{$background} {$class} rounded-{$radius} {$widthSize[$width]} {$heightSize[$height]} {$padding} {$gap}";
@endphp

<div {{ $attributes->merge(['class' => $containerClass]) }}>
    {{ $slot }}
</div>
