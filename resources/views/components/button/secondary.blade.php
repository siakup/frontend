@props([
    'type' => 'button',
    'label' => '',
    'icon' => null,
    'iconPosition' => 'left',
    'class' => '',
    'wireClick' => null,
    'href' => null,
    'isUsedWithLabelTagForFileInput' => false,
])

@if ($isUsedWithLabelTagForFileInput)
    <label
        class="{{ $attributes->has('class') ? $attributes->get('class') : '' }} {{ $class }} inline-flex w-fit min-w-37.75 justify-center items-center gap-1 px-4 py-2 rounded-lg bg-white border border-red-500 text-red-500 hover:bg-red-50 active:bg-red-100 cursor-pointer disabled:border-gray-600 disabled:text-gray-600">
        {{ $slot }}
        <input type="file" class="hidden" {{ $attributes->except('class')->merge() }}>
    </label>
@else
    <button type="{{ $type }}" @if ($wireClick) wire:click="{{ $wireClick }}" @endif
        @if ($href) onclick="window.location.href='{{ $href }}'" @endif
        {{ $attributes->merge([
            'class' => "inline-flex w-fit w-max justify-center items-center gap-1 px-4 py-2 rounded-sm bg-white border border-[#E62129] text-[#E62129] hover:bg-[#FBDADB] active:bg-[#F7B6B8] cursor-pointer disabled:border-[#E8E8E8] disabled:text-[#8C8C8C] disabled:bg-white disabled:cursor-not-allowed {$class}",
        ]) }}>
        @if ($icon && $iconPosition === 'left')
            <x-icon :name="$icon" />
        @endif

        {{-- Slot sebagai prioritas, fallback ke label --}}
        <x-typography variant="body-medium-regular">
            {{ $slot->isNotEmpty() ? $slot : $label }}
        </x-typography>

        @if ($icon && $iconPosition === 'right')
            <x-icon :name="$icon" />
        @endif
    </button>
@endif
