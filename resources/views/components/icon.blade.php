@props([
    'name' => '',
    'alt' => '',
    'class' => '',
    'id' => '',
])

<img id="{{ $id }}" src="{{ asset("assets/icons/$name.svg") }}" alt="{{ $alt }}"
    class="{{ $class }}" loading="lazy" />
