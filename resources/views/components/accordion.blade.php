@props([
  'label',
  'variant' => 'red-gradient',
  'isDefaultOpen' => false
])

@php
  $variants = [
    'red-gradient' => [
      'bg' => 'bg-linear-to-r from-white to-red-100',
      'text' => 'text-red-500'
    ],
    'white-background' => [
      'bg' => '!bg-white',
      'text' => 'text-gray-800'
    ]
  ]
@endphp

<x-container.wrapper 
  x-data="{ open: {{ json_encode($isDefaultOpen) }} }"
  cols="1"
  {{ $attributes->class(['rounded-lg border border-gray-300 overflow-hidden bg-white']) }}
>
  <!-- Header container -->
  <x-container.container 
    @click="open = !open"
    class="px-0 py-0 cursor-pointer w-full {{$variants[$variant]['bg']}}"
  >
    <x-container.wrapper cols="2" width="full" items="center" class="px-4 py-3">
      {{-- judul label --}}
      <x-container.container class="min-w-0">
        <x-typography variant="body-medium-semibold">{{$label}}</x-typography>
      </x-container.container>
      {{-- buka/tutup + arrow --}}
      <x-container.container class="justify-end gap-2 {{$variants[$variant]['text']}}">
        <x-typography variant="body-small-semibold" x-text="open ? 'Tutup' : 'Buka'"></x-typography>
        <x-container.container class="items-center justify-center transition-transform duration-200" x-bind:class="{ 'rotate-180': open }">
          @if($variant === 'red-gradient')
            <x-icon name="arrow-down/red-16" alt="arrow"/>
          @else
            <x-icon name="arrow-down/black-16" alt="arrow"/>
          @endif
        </x-container.container>
      </x-container.container>
    </x-container.wrapper>
  </x-container.container>

  <!-- Content Container -->
  <x-container.container x-show="open" x-collapse class="w-full px-4 py-3 !bg-white !text-gray-700">
    {{ $slot }}
  </x-container.container>
</x-container.wrapper>