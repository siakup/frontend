@props([
    'type' => 'button',
    'label' => '',
    'icon' => null,
    'iconPosition' => 'left',
    'class' => '',
    'wireClick' => null,
    'href' => null,
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
      'class' => "inline-flex w-fit min-w-[151px] justify-center items-center gap-1 px-4 py-2 rounded-lg cursor-pointer {$class}"
    ]) 
  }}
>
    @if ($icon && $iconPosition === 'left')
        <x-icon :iconUrl="$icon" class="w-5 h-5" />
    @endif

    {{-- Slot sebagai prioritas, fallback ke label --}} 
    <x-typography variant="body-medium-regular">
        {{ $slot->isNotEmpty() ? $slot : $label }}
    </x-typography>

    @if ($icon && $iconPosition === 'right')
        <x-icon :iconUrl="$icon" class="w-5 h-5" />
    @endif
</button>
