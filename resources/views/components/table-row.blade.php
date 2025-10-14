@props(['variant' => 'default', 'odd' => false, 'last' => false])

@php
  $variants = [
    'default' => [
      'other-class' => "bg-white",
      'odd' => $odd ? 'bg-[#f5f5f5]' : 'bg-white',
      'last' => $last ? 'border-b-0' : ''
    ],
    'old' => [
      'other-class' => "w-full items-center m-0 p-0 table-row",
      'odd' => '',
      'last' => '',
    ],
  ]
@endphp

<tr {{ $attributes->class([
  $variants[$variant]['odd'], 
  $variants[$variant]['last'],
  $variants[$variant]['other-class']
]) }}>
    {{ $slot }}
</tr>
