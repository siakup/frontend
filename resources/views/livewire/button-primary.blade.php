<button type="{{ $type }}"
    class="inline-flex w-fit items-center gap-1 px-4 py-2 rounded-lg text-white bg-[#E62129] hover:bg-[#B5171C] active:bg-[#841418]">

    @if ($icon && $iconPosition === 'left')
        <x-icon :icon-url="$icon" />
    @endif

    <x-typography variant="body-medium-regular">{{ $label }}</x-typography>

    @if ($icon && $iconPosition === 'right')
        <x-icon :icon-url="$icon" />
    @endif
</button>
