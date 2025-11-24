@props([
    'name' => null, // <-- nama icon saja
    'class' => '',
    'alt' => '',
])

<img src="{{ asset("assets/icons/{$name}.svg") }}" alt="{{ $alt ?: $name }}" class="{{ $class }}" loading="lazy" />
