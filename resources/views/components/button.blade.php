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
        'primary' => 'group/primary
          text-white bg-red-500 
          not-disabled:hover:bg-red-600 not-disabled:hover:scale-[1.02] not-disabled:hover:shadow-md
          not-disabled:active:bg-red-700 not-disabled:active:scale-[0.97] active:shadow-sm
          disabled:bg-gray-300 disabled:filter-gray
          transition-all duration-200 ease-in-out',
        'secondary' => 'group/secondary
          text-red-500 bg-white border border-red-500 
          not-disabled:hover:bg-red-50 not-disabled:hover:scale-[1.02] not-disabled:hover:shadow-sm 
          not-disabled:active:scale-[0.97] not-disabled:active:bg-red-100 not-disabled:active:shadow-none
          disabled:bg-white disabled:border-gray-300
          transition-all duration-200 ease-in-out',
        'tertiary' => 'group/tertiary
          text-red-500 bg-transparent 
          not-disabled:hover:bg-red-50 not-disabled:hover:scale-[1.01] 
          not-disabled:active:bg-red-100 not-disabled:active:scale-[0.98]
          disabled:text-gray-400
          transition-all duration-200 ease-in-out',
        'text-link' => 'group/textlink 
          text-red-500 bg-transparent',
    ];

    $sizes = [
        'lg' => ['padding' => 'px-4 py-2 gap-1 h-10', 'text' => 'body-medium-regular'],
        'md' => ['padding' => 'px-3 py-2 gap-1 h-7.5', 'text' => 'body-small-regular'],
        'sm' => ['padding' => 'px-2 py-1', 'text' => 'caption-regular'],
    ];

    $iconVariants = [
        'primary' => 'filter-white',
        'secondary' => 'filter-red',
        'tertiary' => 'filter-red',
        'text-link' => 'filter-red',
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
