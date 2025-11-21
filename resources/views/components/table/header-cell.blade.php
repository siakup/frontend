@props([
  'variant' => 'default',
  'colspan' => null,
  'rowspan' => null,
])

@php
  $variants = [
    'default' => [
        'px-6 py-[22px] text-[#262626] border-b border-r border-[#d9d9d9] last:border-r-0',
        'bg-[#d9d9d9]' => ! str_contains($attributes->get('class', ''), 'bg-'),
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
