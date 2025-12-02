
@props([
    'variant' => 'red-filled',
    'size' => 'lg',
    'border' => 'default',
    'badgeClass' => '',
])

@php
    $badge = "badge-base badge-$size badge-$border badge-$variant $badgeClass";
@endphp

<span {{ $attributes->merge(['class' => $badge])}}>
  {{ $slot }}
</span>