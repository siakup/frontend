@props([
    'padding' => 'p-1x',
    'margin' => 'm-1x'
])

<div {{ $attributes->merge(['class' => "$padding $margin"]) }}>
    {{ $slot }}
</div>
