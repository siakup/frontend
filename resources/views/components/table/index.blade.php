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
        divClass: ({{json_encode($isRoundedTop)}} ? 'rounded-t-[24px] ' : '')
          +({{json_encode($isRoundedBottom)}} ? 'rounded-b-[24px] ' : '')
          +({{$isBordered}} ? 'border border-[#d9d9d9] ' : ''),
        tableClass:'border-separate border-spacing-0'
      },
      old: {
        divClass: ({{json_encode($isRoundedTop)}} ? 'rounded-t-xl ' : '')
          +({{json_encode($isRoundedBottom)}} ? 'rounded-b-xl ' : '')
          +({{json_encode($isBordered)}} ? 'border-[1px] border-solid border-[#D9D9D9] ' : ''),
        tableClass: 'border-collapse'
      },
    },
    variantColorsTableTitle: {
      'pure-gray': 'bg-disable-blue',
      'light-yellow-gradient': 'bg-gradient-to-r from-white to-[#FEF3C0]',
      'light-blue-gradient': 'bg-gradient-to-r from-white to-[#99D8FF]',
      'light-red-gradient': 'bg-gradient-to-r from-white to-[#F7B6B8]',
      'light-green-gradient': 'bg-gradient-to-r from-white to-[#D0DE68]',
    },
    variant: {{json_encode($variant)}},
    isHaveTitle: {{json_encode($isHaveTitle)}},
    colorTypeTableTitle: {{json_encode($colorTypeTableTitle)}}
  }"
  class="overflow-scroll w-full !p-0"
  x-bind:class="variants[variant].divClass"
>
  <template x-if="isHaveTitle">
    <x-container 
      :variant="'content-wrapper'"
      class="border-b-[1px] border-b-[#D9D9D9] flex justify-between !p-4 !rounded-none"
      x-bind:class="variantColorsTableTitle[colorTypeTableTitle]"
    >
      {{ $tableTitleSlot ?? '' }}
    </x-container>
  </template>
  <table x-bind:class="variants[variant].tableClass" class="min-w-full w-max">
      {{ $slot }}
  </table>
</x-container>
