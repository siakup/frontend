@props(['variant'])

@php 
  $variants = [
    'h1' => "font-bold text-[56px] leading-16",
    'h2' => "font-bold text-5xl leading-13.5",
    'h3' => "font-bold text-4xl leading-11.5",
    'h4' => "font-bold text-[32px] leading-9.5",
    'h5' => "font-bold text-2xl leading-8",
    'h6' => "font-bold text-xl leading-7"
  ]
@endphp

<Text {{ $attributes->merge(['class' => $variants[$variant]]) }}>{{ $slot }}</Text>