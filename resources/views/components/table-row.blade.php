@props(['odd' => false, 'last' => false])

<tr
    {{ $attributes->merge([
        'class' => ($odd ? 'bg-[#f5f5f5]' : 'bg-white') . ($last ? ' last:border-b-0' : ''),
    ]) }}>
    {{ $slot }}
</tr>
