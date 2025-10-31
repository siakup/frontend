@props([
  'variant' => 'body-small-regular'
])
<a {{$attributes->merge(['class' => 'text-[#0076BE]'])}}>
  <x-typography :variant="$variant">{{$slot}}</x-typography>
</a>