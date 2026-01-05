@props([
    'variant' => 'gray',
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
    :buttonId="'buttonStatusBuddy'" 
    :dropdownId="'dropdownStatusBuddy'" 
    :dropdownItem="$options" 
    dropdownContainerClass="{{ $width }}"
    label="-Pilih Status Buddy-" 
    x-model="{{ $attributes->get('x-model') }}" 
/>
