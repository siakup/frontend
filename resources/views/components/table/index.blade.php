@props([
  'variant' => 'default',
  'isHaveTitle' => false,
  'isRoundedTop' => true,
  'isRoundedBottom' => true,
  'isBordered' => true,
  'colorTypeTableTitle' => 'pure-gray'
])

{{-- @php
  $variantColorsTableTitle = [
    'pure-gray'=> 'disable-blue',
    'light-yellow-gradient'=> 'yellow-gradient',
    'light-blue-gradient'=> 'blue-gradient',
    'light-red-gradient'=> 'red-gradient',
    'light-green-gradient'=> 'green-gradient',
  ];
@endphp --}}

<x-container.container 
  x-data="{
    variants: {
      default: {
        divClass: ({{json_encode($isRoundedTop)}} ? '!rounded-t-lg ' : '!rounded-t-none ')
          +({{json_encode($isRoundedBottom)}} ? '!rounded-b-lg ' : '!rounded-b-none')
          +({{json_encode($isBordered)}} ? 'border border-gray-400 ' : ''),
        tableClass:'border-separate border-spacing-0'
      },
      old: {
        divClass: ({{json_encode($isRoundedTop)}} ? 'rounded-t-md ' : '')
          +({{json_encode($isRoundedBottom)}} ? 'rounded-b-md ' : '')
          +({{json_encode($isBordered)}} ? 'border border-solid border-gray-400 ' : ''),
        tableClass: 'border-collapse'
      },
    },
    variant: {{json_encode($variant)}},
    variantColorsTableTitle: {
      'pure-gray': 'disable-blue',
      'light-yellow-gradient': 'yellow-gradient',
      'light-blue-gradient': 'blue-gradient',
      'light-red-gradient': 'red-gradient',
      'light-green-gradient': 'green-gradient',
    },
    isHaveTitle: {{json_encode($isHaveTitle)}},
    colorTypeTableTitle: {{json_encode($colorTypeTableTitle)}}
  }"
  class="overflow-x-scroll flex-col scroll-hide w-full p-0!"
  x-bind:class="variants[variant].divClass"
>
  <template x-if="isHaveTitle">
    <div 
      class="sticky left-0 border-b border-b-gray-400 flex justify-between p-4! rounded-none! w-full"
      x-bind:class="variantColorsTableTitle[colorTypeTableTitle]"
    >
      {{ $tableTitleSlot ?? '' }}
    </div>
  </template>
  <table x-bind:class="variants[variant].tableClass" class="min-w-full table-fixed">
      {{ $slot }}
  </table>
</x-container>
