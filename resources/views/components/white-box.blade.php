@props(['class'])

<div class="bg-white rounded-xl m-4 border-[1px] border-solid border-[#D9D9D9] overflow-visible z-10 {{$class}}">
  {{ $slot }}
</div>