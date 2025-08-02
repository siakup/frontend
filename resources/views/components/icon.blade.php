@props([
    'iconUrl' => '',
    'iconAlt' => '',
    'class' => '',
])

<img src="{{ $iconUrl }}" alt="{{ $iconAlt }}" class="{{ $class }}" loading="lazy" />
