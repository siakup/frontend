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
            'barTrack' => 'rgba(255, 255, 255, 0.7)',
            'barProgress' => '#EF1C25',
            'bgShape'=> asset('assets/images/grey-pattern.svg'),
            'icon' => asset('assets/icons/bolt/green-16.svg'), 
            'iconNonActive' => asset('assets/icons/bolt/grey-16.svg'),
        ],
        'absensi'=>[
            'label' => 'Absensi',
            'text' => 'text-white',
            'bg' => '#EB474D',
            'barTrack' => 'rgba(255, 255, 255, 0.8)',
            'barProgress' => '#0076BE',
            'icon' => asset('assets/icons/calendar/white-16.svg'),
            'bgShape'=> asset('assets/images/grey-pattern.svg'),
        ]
    ];

    $style = $variants[$variant] ?? $variants['sks'];

    // Monochrome
    if ($isCompleted) {
        $style['bg'] = '#565656';
        $style['barProgress'] = '#9CA3AF';
    }
@endphp

<div class="relative w-full overflow-clip rounded-2xl p-4 flex items-center gap-3" 
     style="background-color: {{ $style['bg'] }};">
    
    {{-- Background Shape --}}
    <img src="{{ $style['bgShape'] }}" 
         class="absolute top-0 right-0 h-full w-auto pointer-events-none" 
         alt="pattern">

    {{-- Info + Bar + Counter --}}
    <div class="flex-grow flex items-center gap-3 w-full">
        
        {{-- Icon dan label --}}
        <div class="flex items-center gap-1 min-w-max shrink-0">
            <div class="w-6 h-6 flex items-center justify-center">
                @if ($isCompleted && $variant === 'sks')
                    <img src="{{ $style['iconNonActive'] }}" class="w-full h-full object-contain" alt="{{ $style['label'] }}">
                @else
                    <img src="{{ $style['icon'] }}" class="w-full h-full object-contain" alt="{{ $style['label'] }}">
                @endif
            </div>
            <span class="font-bold text-xl text-white leading-none">
                {{ $style['label'] }}
            </span>
        </div>

        {{-- Bar Progress --}}
        <div class="flex-grow w-full">
            <div class="h-2 w-full rounded-full relative overflow-hidden"
                 style="background-color: {{ $style['barTrack'] }};">
                <div class="h-full rounded-full"
                     style="width: {{ $percentage }}%; background-color: {{ $style['barProgress'] }};">
                </div>
            </div>
        </div>

        {{-- Counter --}}
        <div class="min-w-max shrink-0">
            @if ($isCompleted && $variant === 'sks')
                <span class="font-bold text-xl text-white leading-none">
                    Terpenuhi
                </span>
                
            @else
                <span class="font-bold text-xl text-white leading-none">
                    {{ $currentValue }}/{{ $totalValue }}
                </span>
            @endif

        </div>

    </div>

    {{-- Semester Badge--}}
    @if($semester)
        <div class="z-10 bg-white px-3 py-1 rounded-full flex items-center justify-center shrink-0">
            @if ($isCompleted)
                <span class="text-sm font-medium" style="color: {{ $style['bg'] }};">
                    Semester {{ $semester }}
                </span>
            @else
                <span class="text-sm font-medium" style="color: {{ $style['textSemester'] }};">
                    Semester {{ $semester }}
                </span>
            @endif
        </div>
    @endif

</div>