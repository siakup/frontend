@props([
    'type' => 'button',
    'label' => '',
    'icon' => null,
    'iconPosition' => 'left', // 'left' atau 'right'
    'class' => '',
])

<button type="{{ $type }}"
    class="inline-flex w-fit items-center gap-1 px-4 py-2 rounded-lg bg-white border border-[#E62129] text-[#E62129] hover:bg-[#FBDADB] active:bg-[#F7B6B8] cursor-pointer {{ $class }}">

    @if ($icon && $iconPosition === 'left')
        <x-icon :icon-url="$icon" class="w-5 h-5" />
    @endif

    <x-typography variant="body-medium-regular">{{ $label }}</x-typography>

    @if ($icon && $iconPosition === 'right')
        <x-icon :iconUrl="$icon" class="w-5 h-5" />
    @endif
</button>
