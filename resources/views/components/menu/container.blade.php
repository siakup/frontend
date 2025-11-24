@props([
  'variant',
  'routeChild' => []
])

@php
 $variants = [
  'main' => 'list-none w-full',
  'submenu' => 'bg-gray-100 '
 ]   
@endphp

<ul class="p-0 m-0 {{ $variants[$variant] }}">
  {{ $slot }}
</ul>