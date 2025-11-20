@props(['href' => '', 'class' => ''])

<a 
  href="{{ $href }}"
  class="{{ $class }} w-fit px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition hover:bg-[#FFB9B3]"
  style="display: flex !important"
>
    <img src="{{ asset('assets/icons/arrow-left/red-20.svg') }}">
    <x-typography variant="body-small-regular" class="text-red-500">{{ $slot }}</x-typography>
</a>
