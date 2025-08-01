<td
    {{ $attributes->merge([
        'class' =>
            'px-6 py-[24px] text-center align-middle text-sm text-[#262626] border-b border-r border-[#d9d9d9] last:border-r-0',
    ]) }}>
    {{ $slot }}
</td>
