@props([
    'type' => 'text', // text, select, textarea
    'options' => [], // hanya untuk select
    'name' => '', // opsional, bisa juga lewat attribut biasa
    'label' => '', // opsional
    'value' => '', // default value
])

<div class="flex flex-col gap-1">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif

    @if ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}"
            {{ $attributes->merge(['class' => 'rounded-lg border-gray-300 focus:ring focus:ring-blue-200 outline-0 w-full text-sm border py-[9px] px-[12px] text-gray-800']) }}>{{ old($name, $value) }}</textarea>
    @elseif ($type === 'select')
        <select name="{{ $name }}" id="{{ $name }}"
            {{ $attributes->merge(['class' => 'rounded-lg border-gray-300 focus:ring focus:ring-blue-200 outline-0 w-full text-sm border py-[9px] px-[12px] text-gray-800']) }}>
            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected(old($name, $value) == $optionValue)>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name, $value) }}"
            {{ $attributes->merge(['class' => 'rounded-lg border-gray-300 focus:ring focus:ring-blue-200 outline-0 w-full text-sm border py-[9px] px-[12px] text-gray-800']) }} />
    @endif
</div>
