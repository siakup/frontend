@props([
  'variant' => 'default',
  'isHaveTitle' => false,
  'tableTitle' => '',
  'isRoundedTop' => true,
  'isRoundedBottom' => true,
  'isBordered' => true
])

@php
    $variants = [
      'default' => [
        'div-class' => "overflow-hidden ".($isRoundedTop ? 'rounded-t-[24px] ' : '').($isRoundedBottom ? 'rounded-b-[24px] ' : '').($isBordered ? 'border border-[#d9d9d9] ' : ''),
        'table-class' => 'min-w-full border-separate border-spacing-0'
      ],
      'old' => [
        'div-class' => "max-h-[580px] bg-white overflow-hidden ".($isRoundedTop ? 'rounded-t-xl ' : '').($isRoundedBottom ? 'rounded-b-xl ' : '').($isBordered ? 'border-[1px] border-solid border-[#D9D9D9] ' : ''),
        'table-class' => "w-full border-collapse"
      ],
    ]
@endphp

<div class="{{$variants[$variant]['div-class']}}">
  @if($isHaveTitle)
    <div class="bg-[#E9EDF4] border-b-[1px] border-b-[#D9D9D9] flex justify-center text-center font-bold p-4">{{ $tableTitle }}</div>
  @endif
  <table {{ $attributes->merge(['class' => $variants[$variant]['table-class']]) }}>
      {{ $slot }}
  </table>
</div>
