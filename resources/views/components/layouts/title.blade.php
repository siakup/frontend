@props([
    'text' => null,
])

<x-container.container padding="p-1" radius="none" background="transparent" align="start">
    <x-typography variant="body-large-semibold">
        {{ $text ?? $slot }}
    </x-typography>
</x-container.container>
