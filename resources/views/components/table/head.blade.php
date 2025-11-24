@props([
  'variant' => 'default'
])

@php
    $variants = [
      'default' => "bg-white",
      'old' => "bg-gradient-to-r from-white to-disable-red border-b-1 border-b-solid border-b-gray-400",
    ]
@endphp
<thead {{ $attributes->merge(['class' => $variants[$variant]]) }}>
    {{ $slot }}
</thead>
