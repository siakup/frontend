<th
    {{ $attributes->class([
        'px-6 py-[22px] text-center align-middle text-sm font-semibold text-[#262626] border-b border-r border-[#d9d9d9] last:border-r-0',
        'bg-[#d9d9d9]' => ! str_contains($attributes->get('class', ''), 'bg-'),
    ]) }}
>
    {{ $slot }}
</th>
