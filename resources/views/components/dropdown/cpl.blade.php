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

<x-form.dropdown variant="{{ $variant }}" :buttonId="'buttonCpl'" :dropdownId="'dropdownCpl'" :dropdownItem="$options"
    dropdownContainerClass="{{ $width }}" label="-Pilih CPL-" x-model="{{ $attributes->get('x-model') }}" />
