@props([
    'title' => null,
    'buttonBack' => '',
    'href' => null,
])

<div class="flex flex-col gap-4 p-4 flex-1">
    <x-breadcrumb />
    {{-- PAGE HEADER --}}
    @if ($title)
        <x-layouts.title :text="$title" />
    @endif

    @if ($buttonBack !== '')
        <x-button.back :href="$href">{{ $buttonBack }}</x-button.back>
    @endif

    {{-- PAGE BODY --}}
    <div class="flex-1">
        {{ $slot }}
    </div>

</div>
