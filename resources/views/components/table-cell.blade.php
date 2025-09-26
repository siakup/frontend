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
@endphp

<td {{ $attributes->merge(['class' => $final]) }}>
    {{ $slot }}
</td>
