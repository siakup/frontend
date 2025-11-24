@props([
  'type' => 'button',
  'label' => '',
  'icon' => null,
  'iconPosition' => 'left',
  'class' => '',
  'wireClick' => null,
  'href' => null,
])

@php
  $variantsSizing = [
    'md' => '',
    'lg' => ''
  ]
@endphp

<button 
  type="{{ $type }}" 
  @if ($wireClick) wire:click="{{ $wireClick }}" @endif 
  @if ($href) onclick="window.location.href='{{ $href }}'" @endif
  {{ $attributes->merge([
    'class' => "flex w-fit w-max justify-center items-center gap-1 px-4 py-2 rounded-lg text-white bg-red-500 hover:bg-[#B5171C] active:bg-[#841418] cursor-pointer disabled:bg-[#E8E8E8] disabled:text-[#8C8C8C] disabled:cursor-not-allowed {$class}"
  ]) }}
>
  @if ($icon && $iconPosition === 'left')
      <x-icon :iconUrl="$icon" class="w-5 h-5 [filter:brightness(0)_invert(1)]" />
  @endif

    {{-- Slot sebagai prioritas, fallback ke label --}}
    @if($slot->isNotEmpty() || $label !== '')
      <x-typography variant="body-medium-regular">
        {{ $slot->isNotEmpty() ? $slot : $label }}
      </x-typography>
    @endif

    @if ($icon && $iconPosition === 'right')
        <x-icon :iconUrl="$icon" class="w-5 h-5 [filter:brightness(0)_invert(1)]" />
    @endif
</button>
