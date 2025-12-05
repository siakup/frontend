@props([
    'tabItems' => [], 
    'variant' => 'underline',
    'bgActive' => 'bg-white', 
    'containerClass' => '', 
    'textColorActive' => 'text-red-500', 
    'borderColorActive' => 'border-red-500', 
])

@php
    $baseLinkClasses = "flex items-center transition-all duration-200 hover:shadow-sm";
      
    if ($variant === 'underline') {
        $containerClasses = "grid grid-flow-col auto-cols-max gap-0 mt-4 relative -bottom-px z-20 " . $containerClass;
        $activeClasses = $bgActive.' rounded-t-[10px] '.$textColorActive.' font-bold border border-red-200 border-b-white';
        $inactiveClasses = 'text-gray-600 hover:text-red-400';
        $itemClasses = 'py-2.5 px-8 ' . $baseLinkClasses;

    } elseif ($variant === 'boxed') {
        $containerClasses = "grid grid-flow-col auto-cols-max gap-3 mt-4 z-20 " . $containerClass;
        $activeClasses = $bgActive . ' ' . $textColorActive . ' font-bold ' . $borderColorActive . ' shadow-sm';
        $inactiveClasses = 'text-gray-600 border-gray-400 hover:scale-[1.03]';
        $itemClasses = 'py-2.5 px-8 rounded-2.5 border gap-2 ' . $baseLinkClasses;
        
    } elseif ($variant === 'minimal-underline') {
        $containerClasses = "grid grid-flow-col auto-cols-max gap-3 mt-4 relative -bottom-px z-20" . $containerClass;
        $activeClasses = $borderColorActive . ' ' . $textColorActive . ' font-bold hover:scale-[1.03]'; 
        $inactiveClasses = 'text-gray-400 hover:scale-[1.03]';
        $itemClasses = 'p-2 border-b-2 ' . $baseLinkClasses;

    } elseif ($variant === 'pill-colored') {
        $containerClasses = "grid grid-flow-col auto-cols-max gap-3 mt-4 z-20 " . $containerClass;
        $activeClasses = 'bg-red-50 ' . $textColorActive . ' font-bold ' . $borderColorActive;
        $inactiveClasses = 'text-gray-800 border-gray-300 font-bold';
        $itemClasses = 'py-2 px-3 rounded-md border gap-2 ' . $baseLinkClasses;

    } else {
        $containerClasses = "grid grid-flow-col auto-cols-max gap-0 mt-4 relative -bottom-px z-20 border-b border-gray-300 " . $containerClass;
        $activeClasses = $bgActive.' rounded-t-2.5 '.$textColorActive.' font-bold border border-red-200 border-b-0';
        $inactiveClasses = 'text-gray-600 hover:text-red-400';
        $itemClasses = 'py-2.5 px-8 ' . $baseLinkClasses;
    }
@endphp

<div class="{{ $containerClasses }}">
    @if (!empty($tabItems))
        @foreach ($tabItems as $tabItem)
            @php
                $isActive = Route::currentRouteName() === $tabItem->routeQuery;
                $finalClasses = $itemClasses . ' ' . ($isActive ? $activeClasses : $inactiveClasses);
                
                $shouldShowIcon = ($variant === 'boxed') || isset($tabItem->icon) || isset($tabItem->icon_active);
                $iconSrc = '';
                
                if ($shouldShowIcon) {
                     $iconSrc = $isActive 
                        ? ($tabItem->icon_active ?? '/assets/icons/tab/red.svg') 
                        : ($tabItem->icon ?? '/assets/icons/tab/grey.svg'); 
                }
            @endphp 

            <a href="{{ route($tabItem->routeName, $tabItem->param ?? []) }}"
               class="{{ $finalClasses }}">
                
                @if ($shouldShowIcon)
                    <img src="{{ $iconSrc }}" class="w-5 h-5 object-contain" alt="{{ $tabItem->title }} icon" />
                @endif
                
                <span>{{ $tabItem->title }}</span>
            </a>
        @endforeach
    @endif
</div>
