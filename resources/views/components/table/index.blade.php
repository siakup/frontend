@props([
  'variant' => 'default',
  'isHaveTitle' => false,
  'isRoundedTop' => true,
  'isRoundedBottom' => true,
  'isBordered' => true,
  'colorTypeTableTitle' => 'pure-gray'
])

<x-container.wrapper 
  :rows="3"
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
  :padding="'p-0'"
  class="overflow-hidden h-auto"
  x-bind:class="variants[variant].divClass"
>
  <x-container.container :background="'transparent'" x-bind:class="{'row-start-1': isHaveTitle, 'row-end-2': isHaveTitle, 'hidden': !isHaveTitle}">
    <template x-if="isHaveTitle">
      <x-container.wrapper x-bind:class="variantColorsTableTitle[colorTypeTableTitle]">

        <x-container.container :background="'transparent'" class="col-start-1 col-end-2 row-start-1 row-end-2">
          {{ $tableTitleSlot ?? '' }}
        </x-container.container>

      </x-container.wrapper>
    </template>
  </x-container.container>

  <x-container.container :background="'transparent'" :radius="'none'" class="row-end-4 overflow-scroll scroll-hide" x-bind:class="{'row-start-2': isHaveTitle, 'row-start-1': !isHaveTitle}">
    <table x-bind:class="variants[variant].tableClass" class="min-w-full table-fixed">
        {{ $slot }}
    </table>
  </x-container.container>

</x-container.wrapper>
