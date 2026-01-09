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
    :buttonId="'buttonPeriode'" 
    :dropdownId="'dropdownPeriode'" 
    :dropdownItem="$options" 
    dropdownContainerClass="{{ $width }}" 
    label="-Pilih Periode Akademik-" 
    x-model="{{ $attributes->get('x-model') }}" 
/>

