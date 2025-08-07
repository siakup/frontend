@props([
    'type' => 'text', // text, select, textarea
    'options' => [], // hanya untuk select
    'name' => '', // opsional, bisa juga lewat attribut biasa
    'label' => '', // opsional
    'value' => '', // default value
    'iconUrl' => null, // HTML string atau view component untuk icon
    'disabled' => false, // prop untuk disable
])

@php
    $baseInputClass =
        'rounded-lg border-gray-300 focus:ring focus:ring-blue-200 outline-0 w-full text-sm border py-[9px] px-[12px] text-gray-800';
    $disabledClass = $disabled ? 'bg-[#f5f5f5] text-gray-600 cursor-not-allowed' : '';
@endphp

<div class="flex flex-col gap-1">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif

    @if ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}"
            {{ $attributes->merge([
                'class' => "$baseInputClass $disabledClass",
                'disabled' => $disabled ? 'disabled' : null,
            ]) }}>{{ old($name, $value) }}</textarea>
    @elseif ($type === 'select')
        <select name="{{ $name }}" id="{{ $name }}"
            {{ $attributes->merge([
                'class' => "$baseInputClass $disabledClass",
                'disabled' => $disabled ? 'disabled' : null,
            ]) }}>
            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected(old($name, $value) == $optionValue)>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>
    @else
        <div class="relative">
            <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
                value="{{ old($name, $value) }}"
                {{ $attributes->merge([
                    'class' => "$baseInputClass pr-10 $disabledClass",
                    'disabled' => $disabled ? 'disabled' : null,
                ]) }} />

            @if ($iconUrl)
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <x-icon iconUrl="{{ $iconUrl }}" />
                </div>
            @endif
        </div>
    @endif
</div>
