@props([
    'variant' => 'gray',
    'label' => '',
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
    :buttonId="'buttonKehadiran'" 
    :dropdownId="'dropdownKehadiran'" 
    :dropdownItem="$options" 
    dropdownContainerClass="{{ $width }}"
    label="{{ $label }}" 
    x-model="{{ $attributes->get('x-model') }}" 
/>