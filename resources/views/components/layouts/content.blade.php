@props([
    'title' => null,
])

<div class="flex flex-col gap-4 p-4 flex-1">

    {{-- PAGE HEADER --}}
    @if ($title)
        <x-layouts.title :text="$title" />
    @endif

    {{-- PAGE BODY --}}
    <div class="flex-1">
        {{ $slot }}
    </div>

</div>
