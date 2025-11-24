@props([
    'type' => 'button',
    'label' => null,
    'icon' => null,
    'iconPosition' => 'left',
    'wireClick' => null,
    'href' => null,
    'size' => 'lg',
    'variant' => 'primary',
    'fileInput' => false,
])

@php
    $variants = [
        'primary' => 'text-white bg-red-500 group/primary
          not-disabled:hover:bg-red-600
          active:bg-red-700 
          disabled:bg-gray-300
          transition-all duration-200 ease-in-out
          not-disabled:hover:scale-[1.02] active:scale-[0.97] not-disabled:hover:shadow-md active:shadow-sm',
        'secondary' => 'text-red-500 bg-white border border-red-500 group/secondary
          not-disabled:hover:bg-red-50 active:bg-red-100 disabled:bg-white disabled:border-gray-300
          transition-all duration-200 ease-in-out
          not-disabled:hover:scale-[1.02] active:scale-[0.97]
          not-disabled:hover:shadow-sm active:shadow-none',
        'tertiary' => 'text-red-500 bg-transparent group/tertiary
          not-disabled:hover:bg-red-50 active:bg-red-100 disabled:text-gray-400
          transition-all duration-200 ease-in-out
          not-disabled:hover:scale-[1.01] active:scale-[0.98]',
        'text-link' => 'text-red-500 bg-transparent group/textlink',
    ];

    $sizes = [
        'lg' => ['padding' => 'px-4 py-2 gap-1 h-10', 'text' => 'body-medium-regular'],
        'md' => ['padding' => 'px-3 py-2 gap-1 h-7.5', 'text' => 'body-small-regular'],
        'sm' => ['padding' => 'px-2 py-1', 'text' => 'caption-regular'],
    ];

    $iconVariants = [
        'primary' => 'filter brightness-0 invert group-disabled/primary:[filter:brightness(0)_invert(54%)]',
        'secondary' => 'group-disabled/secondary:[filter:brightness(0)_invert(54%)]',
        'tertiary' => 'group-disabled/tertiary:[filter:brightness(0)_invert(54%)]',
        'text-link' => 'group-disabled/textlink:[filter:brightness(0)_invert(54%)]',
    ];

    $class = collect([
        'flex items-center gap-1 rounded-sm cursor-pointer w-max select-none whitespace-nowrap',
        'disabled:cursor-not-allowed disabled:text-gray-600',
        $variants[$variant] ?? '',
        $sizes[$size]['padding'] ?? '',
    ])->join(' ');
@endphp

@if ($fileInput)
    <label class="{{ $class }}">
        @if ($icon && $iconPosition === 'left')
            <x-icon :name="$icon" class="{{ $iconVariants[$variant] }}" />
        @endif

        @if ($label || $slot->isNotEmpty())
            <x-typography variant="{{ $sizes[$size]['text'] }}">
                {{ $label ?? $slot }}
            </x-typography>
        @endif

        @if ($icon && $iconPosition === 'right')
            <x-icon :name="$icon" class="{{ $iconVariants[$variant] }}" />
        @endif

        <input type="file" class="hidden" {{ $attributes }}>
    </label>
@else
    <button type="{{ $type }}"
        @if ($href) onclick="window.location.href='{{ $href }}'" @endif
        @if ($wireClick) wire:click="{{ $wireClick }}" @endif
        {{ $attributes->merge(['class' => $class]) }}>

        @if ($icon && $iconPosition === 'left')
            <x-icon :name="$icon" class="{{ $iconVariants[$variant] }}" />
        @endif

        @if ($label || $slot->isNotEmpty())
            <x-typography variant="{{ $sizes[$size]['text'] }}">
                {{ $label ?? $slot }}
            </x-typography>
        @endif

        @if ($icon && $iconPosition === 'right')
            <x-icon :name="$icon" class="{{ $iconVariants[$variant] }}" />
        @endif
    </button>
@endif
