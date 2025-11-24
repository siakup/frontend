@props([
  'variant' => 'default',
  'colspan' => null,
  'rowspan' => null,
])

@php
  $variants = [
    'default' => [
        'px-6 py-[22px] text-gray-800 border-b border-r border-gray-400 last:border-r-0',
        'bg-gray-400' => ! str_contains($attributes->get('class', ''), 'bg-'),
    ],
    'old' => ["py-4 px-2"],
  ]
@endphp

<th
    {{ $attributes
        ->merge([
            'colspan' => $colspan,
            'rowspan' => $rowspan,
        ])
        ->class(["text-center align-middle font-semibold text-sm text-center align-middle font-semibold text-sm", ...$variants[$variant]])
    }}
>
    {{ $slot }}
</th>
