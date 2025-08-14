@props(['odd' => false, 'last' => false])

<tr
    {{ $attributes->class([
        $attributes->get('odd') ? 'bg-[#f5f5f5]' : 'bg-white',
        $attributes->get('last') ? 'border-b-0' : '',
    ]) }}>
    {{ $slot }}
</tr>
