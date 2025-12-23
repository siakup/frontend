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
            'textSemester' => 'var(--color-red-500)',
            'bg' => 'var(--color-blue-500)', 
            'barTrack' => 'var(--color-gray-300)',
            'barProgress' => 'var(--color-red-500)',
            'bgShape'=> asset('assets/images/grey-pattern.svg'),
            // 'icon' => 'bolt/green-16', 
            // 'iconNonActive' => 'bolt/green-16',
        ],
        'absensi'=>[
            'label' => 'Absensi',
            'text' => 'text-white',
            'bg' => 'var(--color-red-400)',
            'barTrack' => 'var(--color-gray-300)',
            'barProgress' => 'var(--color-blue-500)',
            // 'icon' => 'calendar/white-16',
            'bgShape'=> asset('assets/images/grey-pattern.svg'),
        ]
    ];

    $style = $variants[$variant] ?? $variants['sks'];

    // Monochrome Logic
    if ($isCompleted) {
        $style['bg'] = 'var(--color-gray-700)';
        $style['barProgress'] = 'var(--color-gray-500)';
    }
@endphp

@if ($variant === 'sks')
    @if ($isCompleted)
        <x-container.wrapper cols="4" padding="p-3" class="bg-gray-600 rounded-lg" width="auto" height="auto">
            {{-- icon dan label --}}
            <x-container.container col="2" class="items-center">
                <x-container.wrapper cols="1">
                    <x-container.container row="1" class="justify-center">
                        <x-icon name="bolt/grey-16"></x-icon>
                    </x-container.container>
                </x-container.wrapper>
                <x-container.wrapper cols="1">
                    <x-container.container row="1" class="justify-center items-center">
                        <x-typography variant="body-large-bold" class="text-white">
                            {{ $style['label'] }}
                        </x-typography>
                    </x-container.container>
                </x-container.wrapper>
            </x-container.container>
            {{-- bar Progress --}}
            <x-container.container col="1" class="justify-center items-center" width="full" padding="p-0">
                <div class="h-2 w-full rounded-full relative overflow-hidden"
                    style="background-color: {{ $style['barTrack'] }};">
                    <div class="h-full rounded-full"
                        style="width: {{ $percentage }}%; background-color: {{ $style['barProgress'] }};">
                    </div>
                </div>
            </x-container.container>
            {{-- counter --}}
            <x-container.container col="1" class="items-center justify-center" >
                <x-typography variant="body-large-bold" class="text-white">
                    {{ $currentValue }}/{{ $totalValue }}
                </x-typography>
            </x-container.container>
            {{-- pill --}}
            <x-container.container col="1" padding="p-0" class="items-center justify-center">
                <x-badge variant="red-monochrome" size="md" border="pill" class="!bg-white" style="background-color: white !important;">
                    @if($semester)
                        <x-typography variant="body-small-semibold" class="whitespace-nowrap !text-gray-500">
                            Semester {{ $semester }}
                        </x-typography>
                    @endif
                </x-badge>
            </x-container.container>
        </x-container.wrapper>
    @else
        <x-container.wrapper cols="4" padding="p-3" class="bg-blue-500 rounded-lg" width="auto" height="auto">
            {{-- icon dan label --}}
            <x-container.container col="2" class="items-center">
                <x-container.wrapper cols="1">
                    <x-container.container row="1" class="justify-center">
                        <x-icon name="bolt/green-16"></x-icon>
                    </x-container.container>
                </x-container.wrapper>
                <x-container.wrapper cols="1">
                    <x-container.container row="1" class="justify-center items-center">
                        <x-typography variant="body-large-bold" class="text-white">
                            {{ $style['label'] }}
                        </x-typography>
                    </x-container.container>
                </x-container.wrapper>
            </x-container.container>
            {{-- bar Progress --}}
            <x-container.container col="1" class="justify-center items-center" width="full" padding="p-0">
                <div class="h-2 w-full rounded-full relative overflow-hidden"
                    style="background-color: {{ $style['barTrack'] }};">
                    <div class="h-full rounded-full"
                        style="width: {{ $percentage }}%; background-color: {{ $style['barProgress'] }};">
                    </div>
                </div>
            </x-container.container>
            {{-- counter --}}
            <x-container.container col="1" class="items-center justify-center" >
                <x-typography variant="body-large-bold" class="text-white">
                    {{ $currentValue }}/{{ $totalValue }}
                </x-typography>
            </x-container.container>
            {{-- pill --}}
            <x-container.container col="1" padding="p-0" class="items-center justify-center">
                <x-badge variant="red-monochrome" size="md" border="pill" class="!bg-white" style="background-color: white !important;">
                    @if($semester)
                        <x-typography variant="body-small-semibold" class="!text-gray-500">
                            Semester {{ $semester }}
                        </x-typography>
                    @endif
                </x-badge>
            </x-container.container>
        </x-container.wrapper>
    @endif
@else
    @if ($isCompleted)
        
    @else
        
    @endif
@endif
{{-- <x-container.wrapper 
    cols="5" 
    width="fitContent" 
    gapY="0" 
    gapX="2" 
    padding="p-2" 
    class="relative overflow-hidden shrink-0 items-center justify-center !grid-cols-[min-content_min-content_1fr_min-content_min-content]"
    style="background-color: {{ $style['bg'] }}; border-radius:;" 
>
    
    Background Shape
    <img src="{{ $style['bgShape'] }}" 
         class="absolute top-0 right-0 h-full w-auto pointer-events-none" 
         alt="pattern">

    Icon
    <x-container.container col="1" class="items-center justify-center" padding="p-0" width="fitContent">
         <x-container.container 
            width="fitContent" 
            padding="p-0" 
            gap="gap-0"
            class="w-6 h-6 flex items-center justify-center"
        >
            @if ($isCompleted && $variant === 'sks')
                 <x-icon name="{{ $style['iconNonActive'] }}" class="w-full h-full object-contain" alt="{{ $style['label'] }}" />
            @else
                 <x-icon name="{{ $style['icon'] }}" class="w-full h-full object-contain" alt="{{ $style['label'] }}" />
            @endif
        </x-container.container>
    </x-container.container>

    Col 2: Label
    <x-container.container col="1" class="items-center justify-center" padding="p-0" width="fitContent">
        <x-typography variant="body-large-bold" class="text-white whitespace-nowrap">
            {{ $style['label'] }}
        </x-typography>
    </x-container.container>

    Col 3: Progress Bar
    <x-container.container col="1" class="justify-center items-center" width="full" padding="p-0">
        <div class="h-2 w-full rounded-full relative overflow-hidden"
            style="background-color: {{ $style['barTrack'] }};">
            <div class="h-full rounded-full"
                style="width: {{ $percentage }}%; background-color: {{ $style['barProgress'] }};">
            </div>
        </div>
    </x-container.container>

    Col 4: Counter
    <x-container.container col="1" class="items-center justify-center" padding="p-0" width="fitContent">
         @if ($isCompleted && $variant === 'sks')
            <x-typography variant="body-large-bold" class="text-white leading-none whitespace-nowrap">
                Terpenuhi
            </x-typography>
        @else
            <x-typography variant="body-large-bold" class="text-white leading-none whitespace-nowrap">
                {{ $currentValue }}/{{ $totalValue }}
            </x-typography>
        @endif
    </x-container.container>

    Col 5: Badge
    <x-container.container col="1" padding="p-0" class="items-center justify-center" width="fitContent">
        @if($semester)
            <x-container.container 
                background="bg-white" 
                radius="full" 
                padding="px-3 py-1" 
                width="fitContent"
                class="z-10 flex items-center justify-center shrink-0"
            >
                 @if ($isCompleted)
                    <x-typography variant="body-small-semibold" style="color: {{ $style['bg'] }};" class="whitespace-nowrap">
                        Semester {{ $semester }}
                    </x-typography>
                @else
                    <x-typography variant="body-small-semibold" style="color: {{ $style['textSemester'] }};" class="whitespace-nowrap">
                        Semester {{ $semester }}
                    </x-typography>
                @endif
            </x-container.container>
        @endif
    </x-container.container>

</x-container.wrapper> 
--}}




{{-- KODE REFERENSI


<x-container.wrapper cols="5" class="bg-blue-500 rounded-lg" width="fit" height="auto" ...(background)...>
    <x-container.container col="1" class="items-center justify-center" padding="p-4">
        <x-icon name="bolt/grey-12">
        </x-icon>
    </x-container.container>
    <x-container.container col="1" class="items-center justify-center">
        <x-typography variant="body-large-bold" class="text-white">
            {{ $style['label'] }}
        </x-typography>
    </x-container.container>
    <x-container.container col="1" class="justify-center items-center" width="full">
        <div class="h-2 w-full rounded-full relative overflow-hidden"
            style="background-color: {{ $style['barTrack'] }};">
            <div class="h-full rounded-full"
                style="width: {{ $percentage }}%; background-color: {{ $style['barProgress'] }};">
            </div>
        </div>
    </x-container.container>
    <x-container.container col="1" class="items-center justify-center">
        <x-typography variant="body-large-bold" class="text-white">
            {{ $currentValue }}/{{ $totalValue }}
        </x-typography>
    </x-container.container>
    <x-container.container col="1" padding="p-0" class="items-center justify-center">
        <x-badge variant="red-monochrome" size="md" border="pill" class="!bg-white">Label</x-badge>
    </x-container.container>
</x-container.wrapper>



--}}