@props([
  'variant' => 'default'
])

@php
    $variants = [
      'default' => [
        'div-class' => "rounded-[24px] overflow-hidden border border-[#d9d9d9]",
        'table-class' => 'min-w-full border-separate border-spacing-0'
      ],
      'old' => [
        'div-class' => "max-h-[580px] rounded-xl m-4 bg-white border-[1px] border-solid border-[#D9D9D9]",
        'table-class' => "w-full border-collapse rounded-xl overflow-hidden table-fixed"
      ],
    ]
@endphp

<div class="{{$variants[$variant]['div-class']}}">
    <table {{ $attributes->merge(['class' => $variants[$variant]['table-class']]) }}>
        {{ $slot }}
    </table>
</div>
