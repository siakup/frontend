@props([
    'variant' => 'body-small-regular',
    'class' => '',
])

@php
    $base = 'font-poppins';

    $sizes = [
        'heading-h1' => 'h1',
        'heading-h2' => 'h2',
        'heading-h3' => 'h3',
        'heading-h4' => 'h4',
        'heading-h5' => 'h5',
        'heading-h6' => 'h6',

        'body-large-regular' => 'body-large',
        'body-large-bold' => 'body-large font-bold',
        'body-large-semibold' => 'body-large font-semibold',
        'body-large-italic' => 'body-large italic',
        'body-medium-regular' => 'body-medium',
        'body-medium-bold' => 'body-medium font-bold',
        'body-medium-italic' => 'body-medium italic',
        'body-medium-semibold' => 'body-medium semibold',
        'body-small-regular' => 'body-small',
        'body-small-bold' => 'body-small font-bold',
        'body-small-semibold' => 'body-small font-semibold',
        'body-small-italic' => 'body-small italic',

        'caption-regular' => 'caption',
        'caption-bold' => 'caption font-bold',
        'caption-semibold' => 'caption font-semibold',
        'caption-italic' => 'caption italic',
        'pixie-regular' => 'pixie',
        'pixie-bold' => 'pixie font-bold',
        'pixie-italic' => 'pixie italic',
        'pixie-semibold' => 'pixie font-semibold',
    ];

    $typographyClass = "$base {$sizes[$variant]} $class";
@endphp

<span {{ $attributes->merge(['class' => $typographyClass]) }}>
    {{ $slot }}
</span>
