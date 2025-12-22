@props([
    'variant' => 'sks',
    'currentValue' => 0,
    'totalValue' => 100,
    'isCompleted' => false,
    'semester' => null
])

@php
    $percentage = ($totalValue > 0) ? min(100, max(0, ($currentValue / $totalValue) * 100)) : 0;
    
    $variants = [
        'sks'=> [
            'label' => 'SKS',
            'text' => 'text-white',
            'textSemester' => '#E64325',
            'bg' => '#0076BE', 
            'barTrack' => '#FFFFFF70',
            'barProgress' => '#EF1C25',
            'bgShape'=> asset('assets/images/grey-pattern.svg'),
            'icon' => asset('assets/icons/bolt/green-16.svg'), 
            'iconNonActive' => asset('assets/icons/bolt/grey-16.svg'),
        ],
        'absensi'=>[
            'label' => 'Absensi',
            'text' => 'text-white',
            'bg' => '#EB474D',
            'barTrack' => '#FFFFFF80',
            'barProgress' => '#0076BE',
            'icon' => asset('assets/icons/calendar/white-16.svg'),
            'bgShape'=> asset('assets/images/grey-pattern.svg'),
        ]
    ];

    $style = $variants[$variant] ?? $variants['sks'];

    // Monochrome Logic
    if ($isCompleted) {
        $style['bg'] = '#565656';
        $style['barProgress'] = '#9CA3AF';
    }
@endphp

<x-container.container 
    background="transparent" 
    radius="2xl" 
    padding="p-3" 
    gap="gap-3" 
    class="relative overflow-clip flex items-center" 
    style="background-color: {{ $style['bg'] }};"
>
    
    {{-- Background Shape --}}
    <img src="{{ $style['bgShape'] }}" 
         class="absolute top-0 right-0 h-full w-auto pointer-events-none" 
         alt="pattern">

    {{-- Main Content Wrapper --}}
    <x-container.container 
        background="transparent" 
        padding="p-0" 
        gap="gap-3"
        class="flex-grow flex items-center justify-start z-10"
    >
        
        {{-- Icon & Label Box --}}
        <x-container.container 
            background="transparent" 
            padding="p-0" 
            gap="gap-1" 
            class="flex items-center min-w-max shrink-0" 
            width="fitContent"
        >
            <div class="w-6 h-6 flex items-center justify-center">
                @if ($isCompleted && $variant === 'sks')
                    <img src="{{ $style['iconNonActive'] }}" class="w-full h-full object-contain" alt="{{ $style['label'] }}">
                @else
                    <img src="{{ $style['icon'] }}" class="w-full h-full object-contain" alt="{{ $style['label'] }}">
                @endif
            </div>
            <x-typography variant="body-large-bold" class="text-white leading-none">
                {{ $style['label'] }}
            </x-typography>
        </x-container.container>

        {{-- Bar Progress --}}
        <x-container.container 
            background="transparent"
            padding="p-0"
            width="full"
            class="flex-grow"
        >
            <div class="h-2 w-full rounded-full relative overflow-hidden"
                 style="background-color: {{ $style['barTrack'] }};">
                <div class="h-full rounded-full"
                     style="width: {{ $percentage }}%; background-color: {{ $style['barProgress'] }};">
                </div>
            </div>
        </x-container.container>

        {{-- Counter Box --}}
        <x-container.container 
            background="transparent" 
            padding="p-0" 
            width="fitContent"
            class="min-w-max shrink-0"
        >
            @if ($isCompleted && $variant === 'sks')
                <x-typography variant="body-large-bold" class="text-white leading-none">
                    Terpenuhi
                </x-typography>
            @else
                <x-typography variant="body-large-bold" class="text-white leading-none">
                    {{ $currentValue }}/{{ $totalValue }}
                </x-typography>
            @endif
        </x-container.container>

    </x-container.container>

    {{-- Semester Badge --}}
    @if($semester)
        <x-container.container 
            background="bg-white" 
            radius="full" 
            padding="px-3 py-1" 
            width="fitContent"
            class="z-10 flex items-center justify-center shrink-0"
        >
            @if ($isCompleted)
                <x-typography variant="body-small-semibold" style="color: {{ $style['bg'] }};">
                    Semester {{ $semester }}
                </x-typography>
            @else
                <x-typography variant="body-small-semibold" style="color: {{ $style['textSemester'] }};">
                    Semester {{ $semester }}
                </x-typography>
            @endif
        </x-container.container>
    @endif

</x-container.container>