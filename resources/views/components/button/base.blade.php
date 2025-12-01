@props([
    'type' => 'button',
    'label' => '',
    'icon' => null,
    'iconPosition' => 'left',
    'buttonClass' => '',
    'wireClick' => null,
    'href' => null,
    'sizeText' => 'body-small-regular'
])

<button 
  type="{{ $type }}" 
  @if ($wireClick) 
    wire:click="{{ $wireClick }}" 
  @endif 
  @if ($href) 
    onclick="window.location.href='{{ $href }}'" 
  @endif
  {{ 
    $attributes->merge([
      'class' => "inline-flex w-max justify-center items-center gap-1 py-2 rounded-lg cursor-pointer {$buttonClass}"
    ]) 
  }}
>
    @if ($icon && $iconPosition === 'left')
        <x-icon :name="$icon"/>
    @endif

    {{-- Slot sebagai prioritas, fallback ke label --}} 
    <x-typography variant="{{ $sizeText }}">
        {{ $slot->isNotEmpty() ? $slot : $label }}
    </x-typography>

    @if ($icon && $iconPosition === 'right')
        <x-icon :name="$icon" />
    @endif
</button>
