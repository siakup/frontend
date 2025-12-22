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
      default: 'text-gray-800 border-b border-r border-gray-400 last:border-b-0',
      old: 'py-4 px-2',
    },
    variantColors: {
      default: {
        default: 'bg-gray-400 px-6 py-5.5 font-semibold',
        old: ''
      },
      odd: {
        default: 'bg-disable-gray w-3/10 py-2 px-5 font-normal',
        old: ''
      },
      even: {
        default: 'bg-disable-white w-3/10 py-2 px-5 font-normal',
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
  class="text-center align-middle text-sm {{ $class }}"
  colspan="{{ $colspan }}"
  rowspan="{{ $rowspan }}"
  x-bind:class="[variants[variant], variantColors[variantColor][variant], positions[position]]"
  @if($attributes->has('x-text')) x-text="{{ $attributes->get('x-text') }}" @endif
>
    {{ $slot }}
</th>
