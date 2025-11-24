@extends('layouts.main')

@section('title', 'Tooltip Documentation')

@section('content')
    {{-- Terdapat dua parameter yaitu "text" dan "position" --}}
    {{-- text: Konten dari tooltip --}}
    {{-- position: posisi dari tooltip --}}


    <x-container variant="content-wrapper">
        <x-typography variant="body-large-semibold">Penggunaan tooltip pada element</x-typography>
        <x-container class="grid grid-cols-3 gap-10 justify-items-center-safe" borderRadius="rounded-lg">
            {{-- Posisi Top Left --}}
            <x-tooltip text="Content for tooltip, don’t forget to use simple," position="top-left">
                <x-button.primary>Top Left</x-button.primary>
            </x-tooltip>

            {{-- Posisi Top Center --}}
            <x-tooltip text="Content for tooltip, don’t forget to use simple," position="top-center">
                <x-button.primary>Top Center</x-button.primary>
            </x-tooltip>

            {{-- Posisi Top Right --}}
            <x-tooltip text="Content for tooltip, don’t forget to use simple," position="top-right">
                <x-button.primary>Top Right</x-button.primary>
            </x-tooltip>

            {{-- Posisi Left Top --}}
            <x-tooltip text="Content for tooltip, don’t forget to use simple," position="left-top">
                <x-button.primary>Left Top</x-button.primary>
            </x-tooltip>

            {{-- Posisi Left Center --}}
            <x-tooltip text="Content for tooltip, don’t forget to use simple," position="left-center">
                <x-button.primary>Left Center</x-button.primary>
            </x-tooltip>

            {{-- Posisi Left Bottom --}}
            <x-tooltip text="Content for tooltip, don’t forget to use simple," position="left-bottom">
                <x-button.primary>Left Bottom</x-button.primary>
            </x-tooltip>

            {{-- Posisi Right Top --}}
            <x-tooltip text="Content for tooltip, don’t forget to use simple," position="right-top">
                <x-button.primary>Right Top</x-button.primary>
            </x-tooltip>

            {{-- Posisi Right Center --}}
            <x-tooltip text="Content for tooltip, don’t forget to use simple," position="right-center">
                <x-button.primary>Right Center</x-button.primary>
            </x-tooltip>

            {{-- Posisi Right Bottom --}}
            <x-tooltip text="Content for tooltip, don’t forget to use simple," position="right-bottom">
                <x-button.primary>Right Bottom</x-button.primary>
            </x-tooltip>

            {{-- Posisi Bottom Left --}}
            <x-tooltip text="Content for tooltip, don’t forget to use simple," position="bottom-left">
                <x-button.primary>Bottom Left</x-button.primary>
            </x-tooltip>

            {{-- Posisi Bottom Center --}}
            <x-tooltip text="Content for tooltip, don’t forget to use simple," position="bottom-center">
                <x-button.primary>Bottom Center</x-button.primary>
            </x-tooltip>
            {{-- Posisi Bottom Right --}}
            <x-tooltip text="Content for tooltip, don’t forget to use simple," position="bottom-right">
                <x-button.primary>Bottom Right</x-button.primary>
            </x-tooltip>
        </x-container>

    </x-container>
@endsection
