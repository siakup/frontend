@props([
  'tabItems' => [],

])
<div class="flex ml-4 mt-4 relative -bottom-[1px] z-2">
  @if(!empty($tabItems))
    @foreach($tabItems as $tabItem)
      <a 
        href="{{ route($tabItem->routeName) }}" 
        class="py-2.5 px-8 {{ Route::currentRouteName() === $tabItem->routeQuery ? 'bg-white rounded-t-[10px] text-[#E64325] font-bold border-[1px] border-[#F39194] border-b-0' : 'text-[#8C8C8C]' }} "
      >
        {{$tabItem->title}}
      </a>
    @endforeach
  @endif
</div>
