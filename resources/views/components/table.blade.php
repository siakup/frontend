@props([
    'class' => '',
])

<div {{ $attributes->class([
    // default
    'rounded-[24px] overflow-hidden border border-[#d9d9d9]',
])->merge() }}>
    <table class="min-w-full border-separate border-spacing-0">
        {{ $slot }}
    </table>
</div>
