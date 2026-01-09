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
    :buttonId="'buttonProgramPerkuliahan'" 
    :dropdownId="'dropdownProgramPerkuliahan'" 
    :dropdownItem="$options" 
    dropdownContainerClass="{{ $width }}"
    label="-Pilih Program Perkuliahan-" 
    x-model="{{ $attributes->get('x-model') }}" 
/>
