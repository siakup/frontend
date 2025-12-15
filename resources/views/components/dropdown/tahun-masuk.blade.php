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
    :buttonId="'buttonTahunMasuk'" 
    :dropdownId="'dropdownTahunMasuk'" 
    :dropdownItem="$options" 
    dropdownContainerClass="{{ $width }}"
    label="-Pilih Tahun Masuk-" 
    x-model="{{ $attributes->get('x-model') }}" 
/>