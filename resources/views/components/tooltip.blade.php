@props([
    'text' => '',
    'position' => 'top-center',
])

@php
    [$dir, $align] = explode('-', $position);

    $positionClass = "base-$dir";
    $alignClass = in_array($dir, ['top', 'bottom']) ? "align-x-$align" : "align-y-$align";

    $arrowDir = "arrow-$dir";
    $arrowOffset = in_array($dir, ['top', 'bottom']) ? "offset-x-$align" : "offset-y-$align";

    $positionClass = "$positionClass $alignClass";
    $arrowClass = "$arrowDir $arrowOffset";
@endphp

<div x-data="{ show: false }" class="relative inline-block">

    {{-- Trigger --}}
    <div x-on:mouseenter="show = true" x-on:mouseleave="show = false">
        {{ $slot }}
    </div>

    {{-- Tooltip --}}
    <div x-show="show" x-transition.opacity.duration.250ms class="tooltip {{ $positionClass }}" style="display: none;">
        {{ $text }}

        {{-- Arrow --}}
        <div class="arrow {{ $arrowClass }}"></div>
    </div>

</div>
