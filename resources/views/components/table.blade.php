@props([
  'variant' => 'default',
  'isHaveTitle' => false,
  'tableTitle' => '',
])

@php
    $variants = [
      'default' => [
        'div-class' => "rounded-[24px] overflow-hidden border border-[#d9d9d9]",
        'table-class' => 'min-w-full border-separate border-spacing-0'
      ],
      'old' => [
        'div-class' => "max-h-[580px] rounded-xl m-4 bg-white border-[1px] border-solid border-[#D9D9D9] overflow-hidden",
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
