@props([
    'variant' => 'gray',
    'label' => "-Pilih Dosen Perkuliahan-"
])

@php
    if ($variant === 'gray') {
        $width = 'w-full';
    } else {
        $width = 'w-fit';
    }
@endphp

<x-form.dropdown variant="{{ $variant }}" :buttonId="'buttonLecturer'" :dropdownId="'dropdownLecturer'" :dropdownItem="$options"
    dropdownContainerClass="{{ $width }}" label="{{ $label }}" x-model="{{ $attributes->get('x-model') }}" />
