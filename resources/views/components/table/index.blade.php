@props([
    'variant' => 'default',
    'isHaveTitle' => false,
    'isRoundedTop' => true,
    'isRoundedBottom' => true,
    'isBordered' => true,
    'colorTypeTableTitle' => 'pure-gray',
])

<div x-data="{
    variants: {
        default: {
            divClass: ({{ json_encode($isRoundedTop) }} ? '!rounded-t-md ' : '!rounded-t-none ') +
                ({{ json_encode($isRoundedBottom) }} ? '!rounded-b-md ' : '!rounded-b-none') +
                ({{ json_encode($isBordered) }} ? 'border border-gray-400 ' : ''),
            tableClass: 'border-separate border-spacing-0'
        },
        old: {
            divClass: ({{ json_encode($isRoundedTop) }} ? 'rounded-t-md ' : '') +
                ({{ json_encode($isRoundedBottom) }} ? 'rounded-b-md ' : '') +
                ({{ json_encode($isBordered) }} ? 'border border-solid border-gray-400 ' : ''),
            tableClass: 'border-collapse'
        },
    },
    variant: {{ json_encode($variant) }},
    variantColorsTableTitle: {
        'pure-gray': 'disable-blue',
        'light-yellow-gradient': 'yellow-gradient',
        'light-blue-gradient': 'blue-gradient',
        'light-red-gradient': 'red-gradient',
        'light-green-gradient': 'green-gradient',
        'white-red-gradient': 'white-red-gradient',
    },
    isHaveTitle: {{ json_encode($isHaveTitle) }},
    colorTypeTableTitle: {{ json_encode($colorTypeTableTitle) }}
}" class="flex flex-col gap-0 overflow-hidden h-auto w-full"
    x-bind:class="variants[variant].divClass">
    <div>
        <template x-if="isHaveTitle">
            <div class="p-4" x-bind:class="variantColorsTableTitle[colorTypeTableTitle]">
              {{ $tableTitleSlot ?? '' }}
            </div>
        </template>
    </div>

    <div class="overflow-scroll scroll-hide">
        <table x-bind:class="variants[variant].tableClass" class="min-w-full table-fixed">
            {{ $slot }}
        </table>
      </div>

</div>
