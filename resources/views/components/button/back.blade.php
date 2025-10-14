@props(['href' => $href, 'class' => ''])

<a 
  href="{{ $href }}"
  class="{{ $class }} w-fit px-[16px] py-[8px] rounded-lg flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition hover:bg-[#FFB9B3]"
  style="display: flex !important"
>
    <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="left arrow" class="w-5 h-5">
    <x-typography variant="body-medium-regular" class="text-red-500">{{ $slot }}</x-typography>
</a>
