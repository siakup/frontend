@props([
  'variant' => 'default', 
  'position' => 'center', 
  'rowspan' => null, 
  'colspan' => null, 
  'text_size' => 'text-xs',
  'variantColor' => 'default',
  'class' => '',
])

<td 
  x-data="{
    variants: {
      default: 'border-r border-gray-400 last:border-r-0 p-6',
      old: 'py-4 px-2 border-b-gray-400',
    },
    variantColors: {
      default: {
        default: 'bg-white',
        old: ''
      },
      odd: {
        default: 'bg-disable-white w-7/10',
        old: ''
      },
      even: {
        default: 'bg-white w-7/10',
        old: ''
      }
    },
    variant: @js($variant),
    variantColor: @js($variantColor),
    colSpan: @js($colspan),
    rowSpan: @js($rowspan),
    textSize: @js($text_size),
    positions: {
      left: 'text-left',
      center: 'text-center',
      right: 'text-right'
    },
    position: @js($position)
  }"
  class="align-middle border-b text-gray-800 {{ $class }}"
  colspan="{{ $colspan }}"
  rowspan="{{ $rowspan }}"
  x-bind:class="[variants[variant], variantColors[variantColor][variant], positions[position], textSize]"
  @if($attributes->has('x-text')) x-text="{{ $attributes->get('x-text') }}" @endif
>
  {{ $slot }}
</td>
