<div class="rounded-[24px] overflow-hidden border border-[#d9d9d9]">
    <table {{ $attributes->merge(['class' => 'min-w-full border-separate border-spacing-0']) }}>
        {{ $slot }}
    </table>
</div>
