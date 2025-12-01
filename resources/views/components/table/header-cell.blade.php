@props([
  'variant' => 'default',
  'variantColor' => 'default',
  'colspan' => '',
  'rowspan' => '',
  'position' => 'center',
  'class' => '',
])

<th
  x-data="{
    variants: {
      default: 'px-6 py-5.5 text-gray-800 border-b border-r border-gray-400 last:border-r-0',
      old: 'py-4 px-2',
    },
    variantColors: {
      default: {
        default: 'bg-gray-400',
        old: ''
      },
      odd: {
        default: 'bg-disable-gray w-3/10',
        old: ''
      },
      even: {
        default: 'bg-disable-white w-3/10',
        old: ''
      }
    },
    variant: @js($variant),
    variantColor: @js($variantColor),
    positions: {
      left: 'text-left',
      center: 'text-center',
      right: 'text-right'
    },
    position: @js($position)
  }"
  class="text-center align-middle font-semibold text-sm {{ $class }}"
  colspan="{{ $colspan }}"
  rowspan="{{ $rowspan }}"
  x-bind:class="[variants[variant], variantColors[variantColor][variant], positions[position]]"
  @if($attributes->has('x-text')) x-text="{{ $attributes->get('x-text') }}" @endif
>
    {{ $slot }}
</th>
