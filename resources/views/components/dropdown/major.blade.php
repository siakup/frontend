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
    :buttonId="'buttonMajor'" 
    :dropdownId="'dropdownMajor'" 
    :dropdownItem="$options" 
    dropdownContainerClass="{{ $width }}" 
    label="-Pilih Program Studi-" 
    x-model="{{ $attributes->get('x-model') }}" 
/>

