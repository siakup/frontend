@props([
  'variant' => 'default'
])

@php
    $variants = [
      'default' => "bg-white",
      'old' => "bg-gradient-to-r from-white to-[#FFECED] w-full border-b-1 border-b-solid border-b-[#D9D9D9] sticky top-0 z-1",
    ]
@endphp
<thead {{ $attributes->merge(['class' => $variants[$variant]]) }}>
    {{ $slot }}
</thead>
