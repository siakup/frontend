@props([
    'iconUrl' => '',
    'iconAlt' => '',
    'class' => '',
    'id' => ''
])

<img id="{{ $id }}" src="{{ $iconUrl }}" alt="{{ $iconAlt }}" class="{{ $class }}" loading="lazy" />
