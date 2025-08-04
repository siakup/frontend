<th
    {{ $attributes->merge([
        'class' =>
            'px-6 py-[22px] text-center align-middle text-sm font-semibold text-[#262626] bg-[#d9d9d9] border-b border-r border-[#d9d9d9] last:border-r-0',
    ]) }}>
    {{ $slot }}
</th>
