{{-- resources\views\components\container.blade.php --}}

@props([
    'class' => '',
    'background' => 'transparent',
    'radius' => 'md', //ada sm, md, dan lg
    'padding' => 'p-0',
    'gap' => 'gap-0',
    'height' => 'full',
    'width' => 'full'
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
      'fitContent' => 'w-fit'
    ];

    $heightSize = [
      'full' => 'h-full',
      'maxContent' => 'h-max',
      'auto' => 'h-auto',
      'fitContent' => 'h-fit'
    ];

    $containerClass = "{$background} {$class} rounded-{$radius} {$widthSize[$width]} {$heightSize[$height]} {$padding} {$gap}";
@endphp

<div {{ $attributes->merge(['class' => $containerClass]) }}>
    {{ $slot }}
</div>
