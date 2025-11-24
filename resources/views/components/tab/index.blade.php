@props([
  'tabItems' => [],
  'bgActive' => 'bg-white',
])
<div class="flex mt-4 mx-4 relative -bottom-px z-2">
  @if(!empty($tabItems))
    @foreach($tabItems as $tabItem)
      <a 
        href="{{ route($tabItem->routeName, $tabItem->param ?? []) }}" 
        class="flex items-center text-center px-4 py-3 {{ Route::currentRouteName() === $tabItem->routeQuery ? $bgActive.' rounded-t-[10px] text-red-500 font-bold border border-red-200 border-b-0' : 'text-gray-600' }} "
      >
        {{$tabItem->title}}
      </a>
    @endforeach
  @endif
</div>
