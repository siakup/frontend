@props(['variant' => 'default'])
@php
    $userClass = $attributes->get('class', '');

    $base = 'px-6 text-center align-middle text-sm text-[#262626] border-b border-r border-[#d9d9d9] last:border-r-0';

    // cek apakah user kasih py-* atau px-*
    $hasPy = preg_match('/(^|\s)!?py-(\[[^\]]+\]|\d+)/', $userClass);
    $hasPx = preg_match('/(^|\s)!?px-(\[[^\]]+\]|\d+)/', $userClass);

    // kalau nggak ada -> pakai default
    $final = $base;
    if (!$hasPy) $final .= ' py-[24px]';
    if (!$hasPx) $final .= ' px-6';

    $variants = [
      'default' => $final,
      'old' => "w-auto text-center text-sm py-4 px-2 align-middle border-b-[1px] border-b-solid border-b-[#D9D9D9]",
    ]
@endphp

<td {{ $attributes->merge(['class' => $variants[$variant]]) }}>
    {{ $slot }}
</td>
