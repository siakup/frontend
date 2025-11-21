@props([
  'variant' => 'default'
])

@php
    $variants = [
      'default' => "bg-white",
      'old' => "bg-gradient-to-r from-white to-[#FFECED] border-b-1 border-b-solid border-b-[#D9D9D9]",
    ]
@endphp
<thead {{ $attributes->merge(['class' => $variants[$variant]]) }}>
    {{ $slot }}
</thead>
