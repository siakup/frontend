@props([
    'tabItems' => [], 
    'variant' => 'underline',
    'bgActive' => 'bg-white', 
    'containerClass' => '', 
    'textColorActive' => 'text-[var(--color-red-500)]', 
    'borderColorActive' => 'border-[var(--color-red-500)]', 
])

@php
    $baseLinkClasses = "flex items-center transition-all duration-200 hover:shadow-sm";
      
    if ($variant === 'underline') {
        $containerClasses = "grid grid-flow-col auto-cols-max gap-0 mt-4 relative -bottom-[1px] z-20 border-b border-[var(--color-gray-300)] " . $containerClass;
        $activeClasses = $bgActive.' rounded-t-[10px] '.$textColorActive.' font-bold border border-[var(--color-red-200)] border-b-0';
        $inactiveClasses = 'text-[var(--color-gray-600)] hover:text-[var(--color-red-400)]';
        $itemClasses = 'py-2.5 px-8 ' . $baseLinkClasses;

    } elseif ($variant === 'boxed') {
        $containerClasses = "grid grid-flow-col auto-cols-max gap-3 mt-4 z-20 " . $containerClass;
        $activeClasses = $bgActive . ' ' . $textColorActive . ' font-bold ' . $borderColorActive . ' shadow-sm';
        $inactiveClasses = 'text-[var(--color-gray-600)] border-[var(--color-gray-400)] hover:scale-[1.03]';
        $itemClasses = 'py-2.5 px-8 rounded-[10px] border gap-2 ' . $baseLinkClasses;
        
    } elseif ($variant === 'minimal-underline') {
        $containerClasses = "grid grid-flow-col auto-cols-max gap-3 mt-4 relative -bottom-[1px] z-20" . $containerClass;
        $activeClasses = $borderColorActive . ' ' . $textColorActive . ' font-bold hover:scale-[1.03]'; 
        $inactiveClasses = 'text-[var(--color-gray-400)] hover:scale-[1.03]';
        $itemClasses = 'py-2 px-2 border-b-2 ' . $baseLinkClasses;

    } elseif ($variant === 'pill-colored') {
        $containerClasses = "grid grid-flow-col auto-cols-max gap-3 mt-4 z-20 " . $containerClass;
        $activeClasses = 'bg-[var(--color-red-50)] ' . $textColorActive . ' font-bold ' . $borderColorActive;
        $inactiveClasses = 'text-[var(--color-gray-800)] border-[var(--color-gray-300)] font-bold';
        $itemClasses = 'py-2 px-3 rounded-[8px] border gap-2 ' . $baseLinkClasses;

    } else {
        $containerClasses = "grid grid-flow-col auto-cols-max gap-0 mt-4 relative -bottom-[1px] z-20 border-b border-[var(--color-gray-300)] " . $containerClass;
        $activeClasses = $bgActive.' rounded-t-[10px] '.$textColorActive.' font-bold border border-[var(--color-red-200)] border-b-0';
        $inactiveClasses = 'text-[var(--color-gray-600)] hover:text-[var(--color-red-400)]';
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
