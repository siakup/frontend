@props(['odd' => false, 'last' => false])

<tr {{ $attributes->class([$odd ? 'bg-[#f5f5f5]' : 'bg-white', $last ? 'border-b-0' : '']) }}>
    {{ $slot }}
</tr>
