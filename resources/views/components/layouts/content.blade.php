@props([
    'title' => null,
])

<div class="flex flex-col gap-4 h-full">

    {{-- PAGE HEADER --}}
    @if ($title)
        <x-layouts.title :text="$title" />
    @endif

    {{-- PAGE BODY --}}
    <div class="flex-1">
        {{ $slot }}
    </div>

</div>
