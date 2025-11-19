@props([
  'type' => 'button',
  'label' => '',
  'icon' => null,
  'iconPosition' => 'left',
  'wireClick' => null,
  'href' => null,
  'size' => 'lg',
  'variant' => 'primary',
  'isUsedWithLabelTagForFileInput' => false,
])

@php
  $variantsModelling = [
    'primary' => 'text-white bg-[#E62129] hover:bg-[#B5171C] active:bg-[#841418] disabled:bg-[#E8E8E8] ',
    'secondary' => 'text-[#E62129] bg-white hover:bg-[#FBDADB] active:bg-[#F7B6B8] disabled:bg-white border border-[#E62129] disabled:border-[#E8E8E8] ',
    'tertiary' => 'text-[#E62129] bg-white hover:bg-[#FBDADB] active:bg-[#F7B6B8] disabled:bg-white '
  ];

  $variantSizingClass = [
    'md' => ($slot->isNotEmpty() || $label !== '') ? "px-3 py-1 " : 'p-1.25 ',
    'lg' => ($slot->isNotEmpty() || $label !== '') ? "px-4 py-2 " : 'p-2.5 '
  ];
  
  $variantsSizing = [
    'md' => 'body-small-regular',
    'lg' => 'body-medium-regular'
  ];

  $variantsIcon = [
    'primary' => '[filter:brightness(0)_invert(1)]',
    'secondary' => '',
    'tertiary' => ''
];

  $variantsLabel = [];
  $class = "flex w-max justify-center items-center gap-1 rounded-lg cursor-pointer disabled:text-[#8C8C8C] disabled:cursor-not-allowed ".$variantsModelling[$variant].$variantSizingClass[$size];
@endphp

@if($isUsedWithLabelTagForFileInput)
  <label class="{{$class}}">
      {{ $slot }}
      <input 
        type="file"
        class="hidden"
        {{ $attributes->except('class')->merge() }}
      >
  </label>
@else
  <button 
    type="{{ $type }}"
    @if ($wireClick) wire:click="{{ $wireClick }}" @endif 
    @if ($href) onclick="window.location.href='{{ $href }}'" @endif
    {{ $attributes->merge([
      'class' => $class
    ]) }}
  >
    @if ($icon && $iconPosition === 'left')
        <x-icon :iconUrl="$icon" class="w-5 h-5 [filter:brightness(0)_invert(1)]" />
    @endif

    @if($slot->isNotEmpty() || $label !== '')
      <x-typography :variant="$variantsSizing[$size]">
        {{ $slot->isNotEmpty() ? $slot : $label }}
      </x-typography>
    @endif

    @if ($icon && $iconPosition === 'right')
        <x-icon :iconUrl="$icon" class="w-5 h-5 {{$variantsIcon[$variant]}}" />
    @endif

  </button>
@endif
