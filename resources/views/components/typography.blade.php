@props([
    'variant' => 'body-small-regular',
    'class' => '',
])

@php
    $base = 'font-poppins';

    $sizes = [
        'heading-h1' => 'text-[56px] leading-[64px] font-bold',
        'heading-h2' => 'text-[48px] leading-[54px] font-bold',
        'heading-h3' => 'text-[36px] leading-[46px] font-bold',
        'heading-h4' => 'text-[32px] leading-[38px] font-bold',
        'heading-h5' => 'text-[24px] leading-[32px] font-bold',
        'heading-h6' => 'text-[20px] leading-[28px] font-bold',

        'body-large-regular' => 'text-[20px] leading-[28px]',
        'body-large-bold' => 'text-[20px] leading-[28px] font-bold',
        'body-large-semibold' => 'text-[20px] leading-[28px] font-semibold',
        'body-large-italic' => 'text-[20px] leading-[28px] italic',
        'body-medium-regular' => 'text-[16px] leading-[24px]',
        'body-medium-bold' => 'text-[16px] leading-[24px] font-bold',
        'body-medium-italic' => 'text-[16px] leading-[24px] italic',
        'body-medium-semibold' => 'text-[16px] leading-[24px] font-semibold',
        'body-small-regular' => 'text-[14px] leading-[22px]',
        'body-small-bold' => 'text-[14px] leading-[22px] font-bold',
        'body-small-semibold' => 'text-[14px] leading-[22px] font-semibold',
        'body-small-italic' => 'text-[14px] leading-[22px] italic',

        'caption-regular' => 'text-[12px] leading-[20px]',
        'caption-bold' => 'text-[12px] leading-[20px] font-bold',
        'caption-semibold' => 'text-[12px] leading-[20px] font-semibold',
        'caption-italic' => 'text-[12px] leading-[20px] italic',
        'pixie-regular' => 'text-[10px] leading-[12px]',
        'pixie-bold' => 'text-[10px] leading-[12px] font-bold',
        'pixie-italic' => 'text-[10px] leading-[12px] italic',
        'pixie-semibold' => 'text-[10px] leading-[12px] font-semibold',
    ];

    $typographyClass = "$base {$sizes[$variant]} $class";
@endphp

<span {{ $attributes->merge(['class' => $typographyClass]) }}>
    {{ $slot }}
</span>
