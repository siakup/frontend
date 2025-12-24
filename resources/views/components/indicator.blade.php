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
            'primaryColor' => 'var(--color-blue-500)',
            'secondaryColor' => 'var(--color-red-500)',
            'barColor' => 'var(--color-gray-300)',
            'cols' => $semester ? 12 : 8,
            'colOfLabel' => 1,
        ],
        'absensi'=>[
            'label' => 'Absensi',
            'primaryColor' => 'var(--color-red-400)',
            'secondaryColor' => 'var(--color-blue-500)',
            'barColor' => 'var(--color-gray-300)',
            'cols' => 9,
            'colOfLabel' => 2,
        ]
    ];


    // Fallback
    $style = $variants[$variant] ?? $variants['sks'];

    // Disabled styles
    if ($isCompleted) {
        $style['primaryColor'] = 'var(--color-gray-700)';
        $style['secondaryColor'] = 'var(--color-gray-600)';
    }
@endphp


<x-container.wrapper
    cols="1"
    class="rounded-lg overflow-hidden"
    style="background-color: {{ $style['primaryColor'] }}; background-image: url('{{ asset('assets/images/grey-pattern.svg') }}'); background-repeat: no-repeat; background-position: 100% 0;"
    width="full"
>
    <x-container.container col="1" padding="px-4 py-3" >
        <x-container.wrapper cols="{{ $style['cols'] }}" gap="5" items="center">

            {{-- Icon --}}
            <x-container.container col="1" class="items-center justify-center" height="fit">
                @if ($variant === 'sks')
                    @if ($isCompleted)
                        <x-icon name="bolt/grey-16"></x-icon>
                    @else
                        <x-icon name="bolt/green-16"></x-icon>
                    @endif
                @else
                    <x-icon name="calendar/white-16"></x-icon>
                @endif
            </x-container.container>
            
            {{-- Label --}}
            <x-container.container col="{{ $style['colOfLabel'] }}" class="items-center justify-center">
                <x-typography variant="body-medium-bold" class="text-white">
                    {{ $style['label'] }}
                </x-typography>
            </x-container.container>
            
            {{-- Progress Bar --}}
            <x-container.container col="4" class="items-center justify-center">
                <x-container.container width="full" radius="full" class="h-2" style="background-color: {{ $style['barColor'] }};">
                    <x-container.container height="full" radius="full" style="width: {{ $percentage }}%; background-color: {{ $style['secondaryColor'] }};"></x-container.container>
                </x-container.container>
            </x-container.container>
            
            {{-- Counter --}}
            <x-container.container col="2" class="items-center justify-center">
                <x-typography variant="body-medium-bold" class="text-white">
                    @if($isCompleted && $variant === 'sks')
                        Terpenuhi
                    @else
                        {{ $currentValue }}/{{ $totalValue }}
                    @endif
                </x-typography>
            </x-container.container>
            
            {{-- Badge Semester --}}
            @if($semester)
                <x-container.container col="4" class="items-center justify-center">
                        <x-badge
                            variant="red-monochrome"
                            size="md"
                            border="pill"
                            style="background-color: white !important; padding: 0 !important;"
                        >
                        <x-typography 
                            variant="body-small-semibold"
                            class="px-6 py-0 whitespace-nowrap"
                            style="color: {{ $style['secondaryColor'] }}; overflow: hidden; text-overflow: ellipsis;"
                        >
                            Semester {{ $semester }}
                        </x-typography>
                    </x-badge>
                </x-container.container>
            @endif
        </x-container.wrapper>
    </x-container.container>
</x-container.wrapper>


{{-- 
1 1 4 2 4
1 2 4 2
--}}