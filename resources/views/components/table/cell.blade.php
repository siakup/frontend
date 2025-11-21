@props([
  'variant' => 'default', 
  'position' => 'center', 
  'rowspan' => null, 
  'colspan' => null, 
  'text_size' => 'text-sm'
])
@php
    $userClass = $attributes->get('class', '');

    $positions = [
        'left' => 'text-left',
        'center' => 'text-center',
        'right' => 'text-right'
    ];

    $variants = [
      'default' => 'border-r border-gray-400 last:border-r-0 p-6 ',
      'old' => "py-4 px-2 border-b-gray-400 ",
    ];
@endphp

<td {{ $attributes
        ->merge([
            'colspan' => $colspan,
            'rowspan' => $rowspan,
        ])
        ->class('align-middle border-b text-[#262626] '.$variants[$variant].$positions[$position].' '.$text_size)
    }}>
    {{ $slot }}
</td>
