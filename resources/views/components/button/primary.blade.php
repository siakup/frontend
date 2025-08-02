@props([
    'type' => 'button',
    'label' => '',
    'icon' => null,
    'iconPosition' => 'left',
    'class' => '',
    'wireClick' => null,
])

<button type="{{ $type }}" @if ($wireClick) wire:click="{{ $wireClick }}" @endif
    class="inline-flex w-fit min-w-[151px] justify-center items-center gap-1 px-4 py-2 rounded-lg text-white bg-[#E62129] hover:bg-[#B5171C] active:bg-[#841418] cursor-pointer {{ $class }}">
    {{ $attributes }}
    @if ($icon && $iconPosition === 'left')
        <x-icon :iconUrl="$icon" class="w-5 h-5" />
    @endif

    <x-typography variant="body-medium-regular">{{ $label }}</x-typography>

    @if ($icon && $iconPosition === 'right')
        <x-icon :iconUrl="$icon" class="w-5 h-5" />
    @endif
</button>
