@props(['variant' => 'default', 'odd' => false, 'last' => false])

@php
  $variants = [
    'default' => [
      'other-class' => '',
      'odd' => $odd ? 'bg-gray-200' : 'bg-white',
      'last' => $last ? 'border-b-none' : ''
    ],
    'old' => [
      'other-class' => "items-center",
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
