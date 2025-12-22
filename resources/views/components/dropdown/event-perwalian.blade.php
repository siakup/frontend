@props([
    'variant' => 'gray',
    'label' => '-Pilih Event Perwalian-',
])

@php
    if ($variant === 'gray') {
        $width = 'w-full';
    } else {
        $width = 'w-fit';
    }
@endphp

<x-form.dropdown 
    variant="{{ $variant }}" 
    :buttonId="'buttonEventPerwalian'" 
    :dropdownId="'dropdownEventPerwalian'" 
    :dropdownItem="$options" 
    dropdownContainerClass="{{ $width }}"
    label="{{ $label }}" 
    x-model="{{ $attributes->get('x-model') }}" 
/>