@props([
  'label',
  'haveIcon' => false,
  'iconInactive' => '',
  'iconActive' => '',
  'routeName' => '',
  'routeQuery' => '',
  'variant', 
  'routeChild' => []
])

<li
  x-data="{
    label: @js($label),
    haveIcon: @js($haveIcon),
    isSlotNotEmpty: @js($slot->isNotEmpty()),
    path: @js($routeName !== '' ? route($routeName) : ''),
    iconActive: @js($iconActive),
    iconInactive: @js($iconInactive),
    isActive: @js(Request::is($routeQuery)),
    isChildActive: @js(!empty(array_filter($routeChild, fn($route) => Request::is($route)))),
    isOpen: @js(!empty(array_filter($routeChild, fn($route) => Request::is($route)))),
    routeChild: @js($routeChild),
    variants: {
      parent: {
        li: 'group/menu p-0 w-full',
        button: 'w-full py-3 px-6 flex items-center gap-3 text-gray-800 text-sm cursor-pointer justify-between group-hover/menu:bg-disable-red '
      },
      child: {
        li: 'group/submenu',
        button: 'w-full py-3 px-6 ps-14 flex items-center gap-3 text-gray-800 text-sm cursor-pointer '
      }
    },
    variant: @js($variant),

    isButtonClick() {
      if(this.isSlotNotEmpty) {
        this.isOpen = ! this.isOpen
      } else if(this.path !== '') {
        window.location.href = this.path
      }
    }

  }"
  x-bind:class="[variants[variant].li]"
>
  <button
    x-on:click="isButtonClick"
    class="transition-all duration-300"
    x-bind:class="[
      variants[variant].button, 
      (isActive || isChildActive) && 'bg-disable-red border-l-4 border-l-red-500', 
      (isOpen) && 'bg-disable-red'
    ]"
  >
    <x-container.container :background="'transparent'" :radius="'none'" class="flex items-center gap-3 flex-1">
      <template x-if="haveIcon">
        <img 
          x-bind:src="(isActive || isChildActive || isOpen) ? iconActive : iconInactive"
          class="w-6 h-6 me-3 shrink-0"
        >
      </template>
      <span 
        class="text-left" 
        x-bind:class="(isActive || isChildActive || isOpen) && 'text-red-500'"
        x-text="label"
      ></span>
    </x-container.container>
    <template x-if="isSlotNotEmpty">
      <img 
        alt="Expand" 
        class="w-4 h-4 ml-2" 
        x-bind:class="isOpen && 'rotate-180'"
        x-bind:src="isChildActive || isOpen ? @js(asset('assets/icons/arrow-down/red-32.svg'))  : @js(asset('assets/icons/arrow-down/black-32.svg'))"
      >
    </template>
  </button>
  <div x-show="isOpen" x-transition.duration.200ms>
    {{ $slot->isNotEmpty() ? $slot : '' }}
  </div>
</li>