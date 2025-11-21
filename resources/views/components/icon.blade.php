@props([
    'url' => '',
    'alt' => '',
    'class' => '',
    'id' => '',
])

<img id="{{ $id }}" src="{{ asset("assets/icons/$url.svg") }}" alt="{{ $alt }}"
    class="{{ $class }}" loading="lazy" />
