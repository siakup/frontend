@props([
  'variant',
  'routeChild' => []
])

@php
 $variants = [
  'main' => 'p-0 m-0 list-none w-full',
  'submenu' => 'p-0 m-0 bg-[#F8F9FA] '.(
    !empty($routeChild) && !empty(array_filter($routeChild, fn($route) => Request::is($route)))
      ? 'block' 
      : 'hidden'
  )
 ]   
@endphp

<ul class="{{ $variants[$variant] }}">
  {{ $slot }}
</ul>