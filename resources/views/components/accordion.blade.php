@props([
  'label',
  'variant' => 'red-gradient',
  'isDefaultOpen' => false
])

@php
  $variants = [
    'red-gradient' => 'bg-linear-to-r from-white to-[#FFECED]'
  ]
@endphp

<div 
  x-data="{ open: {{ json_encode($isDefaultOpen) }} }" 
  class="rounded-lg border border-[#E8E8E8] overflow-hidden"
  @if($attributes->has('x-on:click'))
    x-on:click="{{$attributes->get('x-on:click')}}"
  @endif
>
  <button 
    type="button"
    @click="open = !open"
    class="w-full flex items-center justify-between px-4 py-3 font-semibold {{$variants[$variant]}}"
  >
    <span class="text-[#262626]">{{$label}}</span>
    <span class="inline-flex items-center gap-2 text-sm text-[#E62129]">
      <span x-text="open ? 'Tutup' : 'Buka'"></span>
      <img src="{{ asset('assets/icon-arrow-right-red.svg') }}"
          alt="arrow"
          class="w-4 h-4 transition-transform duration-200"
          :class="open ? 'rotate-[-90deg]' : 'rotate-90'">
    </span>
  </button>
  <div x-show="open" x-collapse>
    {{ $slot }}
  </div>
</div>