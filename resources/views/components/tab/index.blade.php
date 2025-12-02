@props([
  'tabItems' => [],
  'bgActive' => 'bg-white',
])
<x-container.container :variant="'flat'" class="w-full flex mt-4 z-2 overflow-scroll scroll-hidden rounded-none relative -bottom-px">
  @if(!empty($tabItems))
    @foreach($tabItems as $tabItem)
      <a 
        href="{{ route($tabItem->routeName, $tabItem->param ?? []) }}" 
        class="flex items-center justify-center text-center px-4 gap-2 py-3 {{ Route::currentRouteName() === $tabItem->routeQuery ? $bgActive.' rounded-t-[10px] text-red-500 font-bold border border-red-200 border-b-0' : 'text-gray-600' }} "
      >
        <x-typography :variant="'body-medium-regular'" class="w-max">{{$tabItem->title}}</x-typography>
        @if(isset($tabItem->iconActive) && isset($tabItem->iconInactive))
          @if(Route::currentRouteName() === $tabItem->routeQuery)
            <x-icon :name="$tabItem->iconActive" />
          @else
            <x-icon :name="$tabItem->iconInactive" />
          @endif
        @endif
      </a>
    @endforeach
  @endif
</x-container>
