@props([
    'type' => 'text',
    'name' => '', // opsional
    'label' => '', // opsional
    'value' => '', // default value
    'disabled' => false, // prop untuk disable,
    'showRemoveIcon' => false,
    'placeholder' => '',
    'inputClass' => '',
])

{{-- Label --}}
@if ($label)
    <label for="{{ $name }}" class="input-label">
        {{ $label }}
    </label>
@endif


<div {{ $attributes->whereStartsWith('x-') }}
    class="input-wrap {{ $disabled || $attributes->has('readonly') ? 'input-disabled' : 'bg-white' }} {{ $inputClass }}"
    x-data="{
        removeButton: {{ $value ? 'true' : 'false' }},
        showRemoveIcon: {{ $showRemoveIcon ? 'true' : 'false' }},
        value: @js($value ?? '')
    }" x-modelable="value" x-model="{{ $attributes->whereStartsWith('x-model')->first() }}">
    <input
        x-on:input="if('{{ $type }}' === 'number') { value = $event.target.value.replace(/[^0-9]/g, ''); } else { value = $event.target.value } removeButton = value !== '';"
        placeholder="{{ $placeholder }}" name="{{ $name }}" type="{{ $type }}" id="{{ $name }}"
        class="input-base" x-model="value" {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->except(['placeholder', 'name', 'type', 'id', 'class']) }} />
    @if ($showRemoveIcon)
        <button type="button" x-show="removeButton && value !== ''" x-on:click="value = ''; removeButton = false;"
            class="cursor-pointer">
            <x-icon :name="'multiplication-sign-circle/solid-grey-16'"></x-icon>
        </button>
    @endif
</div>
