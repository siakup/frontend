@props([
  'label',
  'variant' => 'red-gradient',
  'isDefaultOpen' => false
])

@php
  $variants = [
    'red-gradient' => [
      'head' => 'bg-linear-to-r from-white to-[#FFECED]',
      'text' => 'text-[#E62129]',
      'icon' => asset('assets/icon-arrow-right-red.svg'),
      'closeRotateIcon' => 'rotate-90',
      'openRotateIcon' => '-rotate-90'
    ],
    'white-background' => [
      'head' => 'bg-white',
      'text' => 'black',
      'icon' => asset('assets/icon-arrow-down-black-16.svg'),
      'closeRotateIcon' => '',
      'openRotateIcon' => 'rotate-180'
    ]
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
    class="w-full flex items-center justify-between gap-3 px-4 py-3 font-semibold {{$variants[$variant]['head']}}"
  >
    <span class="text-[#262626]">{{$label}}</span>
    <span class="inline-flex items-center gap-2 text-sm {{$variants[$variant]['text']}}">
      <span x-text="open ? 'Tutup' : 'Buka'"></span>
      <img src="{{ $variants[$variant]['icon'] }}"
          alt="arrow"
          class="w-4 h-4 transition-transform duration-200"
          :class="open ? '{{$variants[$variant]['openRotateIcon']}}' : '{{$variants[$variant]['closeRotateIcon']}}'">
    </span>
  </button>
  <div x-show="open" x-collapse>
    {{ $slot }}
  </div>
</div>