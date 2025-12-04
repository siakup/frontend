@props([
  'variant' => 'default',
  'isHaveTitle' => false,
  'isRoundedTop' => true,
  'isRoundedBottom' => true,
  'isBordered' => true,
  'colorTypeTableTitle' => 'pure-gray'
])

<x-container 
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
    variantColorsTableTitle: {
      'pure-gray': 'bg-disable-blue',
      'light-yellow-gradient': 'bg-gradient-to-r from-white to-yellow-100',
      'light-blue-gradient': 'bg-gradient-to-r from-white to-blue-50',
      'light-red-gradient': 'bg-gradient-to-r from-white to-red-100',
      'light-green-gradient': 'bg-gradient-to-r from-white to-green-400',
      'light-red-white-gradient': 'bg-gradient-to-r from-disable-red to-white',
      
    },
    variant: {{json_encode($variant)}},
    isHaveTitle: {{json_encode($isHaveTitle)}},
    colorTypeTableTitle: {{json_encode($colorTypeTableTitle)}}
  }"
  class="overflow-x-scroll scroll-hide w-full p-0!"
  x-bind:class="variants[variant].divClass"
>
  <template x-if="isHaveTitle">
    <div 
      :variant="'content-wrapper'"
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
