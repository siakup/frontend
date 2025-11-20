@props([
  'label',
  'haveIcon' => false,
  'icon' => '',
  'routeName' => '',
  'routeQuery',
  'variant', 
  'routeChild' => []
])

@php
  $variants = [
    'parent' => [
      'li' => "group/menu p-0 w-full ",
      'button' => "w-full py-3 px-6 flex items-center gap-3 text-[#333333] text-sm cursor-pointer justify-between group-hover/menu:border-r-[1px] group-hover/menu:border-r-[#D9D9D9] group-hover/menu:bg-[#F8E8E6] ".(
        empty($routeChild) ? (
          Request::is($routeQuery) 
            ? 'bg-[#FBE8E6] border-r-[1px] border-r-[#D9D9D9] text-[#E62129]' 
            : 'group-hover/menu:border-r-[1px] group-hover/menu:border-r-[#D9D9D9] group-hover/menu:bg-[#FBE8E6]'
        ) : (
          !empty(array_filter($routeChild, fn($route) => Request::is($route)))
            ? 'bg-[#FBE8E6] border-r-[1px] border-r-[#D9D9D9] text-[#E62129]' 
            : 'group-hover/menu:border-r-[1px] group-hover/menu:border-r-[#D9D9D9] group-hover/menu:bg-[#FBE8E6]'
        )
      )
    ],
    'child' => [
      'li' => 'group/submenu',
      'button' => 'w-full py-3 px-6 ps-14 flex items-center gap-3 text-[#333333] text-sm cursor-pointer '.(
        empty($routeChild) ? (
          Request::is($routeQuery) 
            ? 'font-semibold text-[#E62129] border-r-[1px] border-r-[#D9D9D9]' 
            : 'group-hover/submenu:border-r-[1px] group-hover/submenu:border-r-[#D9D9D9] group-hover/submenu:bg-[#FBE8E6]'
        ) : (
          !empty(array_filter($routeChild, fn($route) => Request::is($route)))
            ? 'font-semibold text-[#E62129] border-r-[1px] border-r-[#D9D9D9]' 
            : 'group-hover/submenu:border-r-[1px] group-hover/submenu:border-r-[#D9D9D9] group-hover/submenu:bg-[#FBE8E6]'
        )
      )
    ]
  ]
@endphp

@if($slot->isNotEmpty())
  <script>
    function onShowSubMenu(element) {
      const ul = element.nextElementSibling;
      const div = element.querySelector('div');
      const img = div.nextElementSibling;
      const imgDiv = div.querySelector('img');

      element.classList.toggle('bg-[#FBE8E6]');
      element.classList.toggle('border-r-[1px]');
      element.classList.toggle('border-r-[#D9D9D9]');
      element.classList.toggle('text-[#E62129]');

      ul.classList.toggle('block');
      ul.classList.toggle('hidden');

      imgDiv.classList.toggle('[filter:saturate(100%)_brightness(0%)]');
      imgDiv.classList.toggle('[filter:invert(27%)_sepia(91%)_saturate(2576%)_hue-rotate(335deg)_brightness(89%)_contrast(97%)]');

      img.classList.toggle('[filter:invert(27%)_sepia(91%)_saturate(2576%)_hue-rotate(335deg)_brightness(89%)_contrast(97%)]');
      img.classList.toggle('rotate-180');
    } 
  </script>
@endif

<li class="{{ $variants[$variant]['li'] }}">
  <button 
    @if($slot->isNotEmpty())
      onclick="onShowSubMenu(this)"
    @elseif($routeName != '')
      onclick="window.location.href='{{ route($routeName) }}'"
    @endif
    class="{{ $variants[$variant]['button'] }}"
  >
    <div class="flex items-center gap-3 flex-1">
      @if($haveIcon)
        <img 
          src="{{ $icon }}" 
          alt="Home Icon" 
          class="w-6 h-6 me-3 shrink-0 {{
            empty($routeChild)  
              ? ( 
                Request::is($routeQuery) 
                  ? '[filter:invert(27%)_sepia(91%)_saturate(2576%)_hue-rotate(335deg)_brightness(89%)_contrast(97%)]' 
                  : '[filter:saturate(100%)_brightness(0%)]'
              ) : (
                !empty(array_filter($routeChild, fn($route) => Request::is($route)))
                  ? '[filter:invert(27%)_sepia(91%)_saturate(2576%)_hue-rotate(335deg)_brightness(89%)_contrast(97%)]' 
                  : '[filter:saturate(100%)_brightness(0%)]'
              )
          }}"
        >
      @endif
      <span class="text-left">{{ $label }}</span>
    </div>
    @if($slot->isNotEmpty())
      <img src="{{ asset('assets/icons/arrow-down/black-32.svg') }}" alt="Expand" class="w-4 h-4 ml-2 {{
        !empty(array_filter($routeChild, fn($route) => Request::is($route)))
          ? 'rotate-180 [filter:invert(27%)_sepia(91%)_saturate(2576%)_hue-rotate(335deg)_brightness(89%)_contrast(97%)]' 
          : ''
      }}">
    @endif
  </button>
  {{ $slot->isNotEmpty() ? $slot : '' }}
</li>