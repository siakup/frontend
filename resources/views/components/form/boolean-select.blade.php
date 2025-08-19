@props([
    'name' => '',
    'label' => '',
    'trueLabel' => 'Ya',
    'falseLabel' => 'Tidak',
    'value' => false,
    'disabled' => false,
    'alpineModel' => null,
    'options' => [
        // Tetap ada untuk kompatibilitas
        true => 'Ya',
        false => 'Tidak',
    ],
])

@php
    $baseInputClass =
        'rounded-lg border-gray-300 focus:ring focus:ring-blue-200 outline-0 w-full text-sm border py-[9px] px-[12px] text-gray-800';
    $disabledClass = $disabled ? 'bg-[#f5f5f5] text-gray-600 cursor-not-allowed' : '';
    $booleanValue = filter_var($value, FILTER_VALIDATE_BOOLEAN);
@endphp

<div class="flex flex-col gap-1">
    @if ($label)
        <label for="{{ $name }}" class="text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}"
        @if ($alpineModel) x-model.boolean="{{ $alpineModel }}" @endif
        {{ $attributes->merge([
            'class' => "$baseInputClass $disabledClass",
            'disabled' => $disabled ? 'disabled' : null,
        ]) }}>
        <option value="true" @selected($booleanValue === true)>{{ $trueLabel }}</option>
        <option value="false" @selected($booleanValue === false)>{{ $falseLabel }}</option>
    </select>
</div>

@if ($alpineModel)
    <script>
        document.addEventListener('alpine:initialized', () => {
            // Ensure boolean value is properly initialized
            if (typeof Alpine.raw("{{ $alpineModel }}") === 'undefined') {
                Alpine.reactive("{{ $alpineModel }}", {{ $booleanValue ? 'true' : 'false' }});
            }
        });
    </script>
@endif
