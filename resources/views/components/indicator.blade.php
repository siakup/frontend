@props([
    'variant' => 'sks',
    'currentValue' => 0,
    'totalValue' => 100,
    'isCompleted' => false,
    'semester' => null,
])
 
@php
    $percentage = $totalValue > 0
        ? min(100, max(0, ($currentValue / $totalValue) * 100))
        : 0;
 
    if ($variant === 'sks') {
        $label = 'SKS';
        $primaryColor = 'bg-blue-500';
        $secondaryColor = 'bg-red-500';
        $barColor = 'bg-gray-300';
        $textColor = 'text-red-500';
        $icon = $isCompleted ? 'bolt/grey-16' : 'bolt/green-16';
    } else {
        $label = 'Absensi';
        $primaryColor = 'bg-red-400';
        $secondaryColor = 'bg-blue-500';
        $barColor = 'bg-gray-300';
        $icon = 'calendar/white-16';
    }
 
    if ($isCompleted) {
        $primaryColor = 'bg-gray-700';
        $secondaryColor = 'bg-gray-600';
        $textColor = 'text-gray-700';
    }
@endphp
 
<x-container.wrapper
    items="center"
    justify="center"
    class="relative inline-grid auto-cols-max grid-flow-col gap-3 rounded-lg {{ $primaryColor }} {{ $variant==='sks' ? 'p-3' : 'p-4' }} overflow-hidden"
>
    <img src="{{ asset('assets/images/grey-pattern.svg') }}" alt="" class="absolute top-0 right-0 h-full w-auto" />

    <x-container.container class="items-center gap-1 ">
        <x-icon name="{{ $icon }}" />
        <x-typography variant="body-medium-bold" class="text-white">
            {{ $label }}
        </x-typography>
    </x-container.container>
 
    <x-container.container class="items-center justify-center overflow-hidden">
        <div class="w-24 h-2 {{ $barColor }} rounded-full overflow-hidden">
            <div
                class="h-full {{ $secondaryColor }} rounded-full"
                style="width: {{ $percentage }}%;"
            ></div>
        </div>
    </x-container.container>
 
    <x-container.container class="flex items-center justify-center w-18 h-fit">
        <x-typography variant="body-medium-bold" class="text-white">
            @if ($isCompleted && $variant === 'sks')
                Terpenuhi
            @else
                {{ $currentValue }}/{{ $totalValue }}
            @endif
        </x-typography>
    </x-container.container>
 
    @if ($semester)
        <x-container.container class="items-center overflow-hidden">
            <x-badge
                variant="red-monochrome"
                size="md"
                border="pill"
                class="!bg-white"
            >
                <x-typography
                    variant="body-medium-regular"
                    class="{{ $textColor }} "
                >
                    Semester {{ $semester }}
                </x-typography>
            </x-badge>
        </x-container.container>
    @endif
</x-container.wrapper>