@props([
    'variant' => 'body-small-regular',
    'class' => '',
])

<x-typography 
    :variant="$variant" 
    {{ $attributes->merge(['class' => 'pagination-result-text ' . $class]) }}
    x-text="'Hasil: ' + start + ' - ' + end + ' dari ' + total"
>
</x-typography>
