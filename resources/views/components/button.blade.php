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
    'primary' => 'text-white bg-red-500 hover:bg-red-600 active:bg-red-700 disabled:bg-gray-300 disabled:hover:bg-gray-300 group/primary ',
    'secondary' => 'text-red-500 bg-white hover:bg-red-50 disabled:hover:bg-white active:bg-red-100 border border-red-500 disabled:border-gray-50 group/secondary ',
    'tertiary' => 'text-red-500 bg-transparent hover:bg-red-50 active:bg-red-100 disabled:hover:bg-transparent group/tertiary ',
    'text-link' => 'text-red-500 bg-transparent group/textlink '
  ];

  $variantSizingClass = [
    'md' => ($slot->isNotEmpty() || $label !== '') ? "px-3 py-1 " : 'p-1.25 ',
    'lg' => ($slot->isNotEmpty() || $label !== '') ? "px-4 py-2 " : 'p-2.5 ',
    'sm' => ($slot->isNotEmpty() || $label !== '') ? "px-3 py-1 " : 'p-1.25 ',
  ];
  
  $variantsSizing = [
    'md' => 'body-small-regular',
    'lg' => 'body-medium-regular',
    'sm' => 'caption-regular'
  ];

  $variantsIcon = [
    'primary' => '[filter:brightness(0)_invert(1)] group-disabled/primary:[filter:brightness(0)_invert(54%)]',
    'secondary' => 'group-disabled/secondary:[filter:brightness(0)_invert(54%)]',
    'tertiary' => 'group-disabled/tertiary:[filter:brightness(0)_invert(54%)]',
    'text-link' => 'group-disabled/textlink:[filter:brightness(0)_invert(54%)]'
];

  $variantsLabel = [];
  $class = $variantsModelling[$variant].$variantSizingClass[$size]."flex w-max justify-center items-center gap-1 rounded-sm cursor-pointer disabled:text-gray-600 disabled:cursor-not-allowed";
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
        <x-icon :iconUrl="$icon" class="w-5 h-5 {{$variantsIcon[$variant]}}" />
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
