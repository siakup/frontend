@extends('layouts.main')

@section('title', 'Accordion Documentation')

@section('content')
    {{-- Terdapat tiga parameter untuk accordion --}}
    {{-- label: label dari accordion --}}
    {{-- variant: variasi dari accordion (red-gradient dan white-background). Defaultnya adalah red-gradient --}}
    {{-- isDefaultOpen: menentukan apakah accordion terbuka secara default atau tidak (true/false). Defaultnya adalah
    false--}}

    <x-container.wrapper>
        <x-container.container col="1">
            <x-typography variant="body-large-semibold">Penggunaan accordion</x-typography>
        </x-container.container>

        <x-container.container col="1">
            <x-container.wrapper rows="3" class="gap-1">

                {{-- Red Gradient --}}
                <x-container.container row="1" class="flex flex-col gap-3">
                    <x-typography variant="body-medium-semibold">Red Gradient (Default)</x-typography>
                    <x-accordion label="Accordion Red Gradient (Default)" variant="red-gradient">
                        <x-container.wrapper cols="1" class="bg-gray-50 text-gray-700">
                            <x-container.container row="1" padding="px-4 py-3">
                                <x-typography variant="body-small-regular">
                                    Ini adalah konten untuk accordion dengan varian default (red-gradient).
                                    Anda bisa memasukkan teks, gambar, atau komponen lain di sini.
                                </x-typography>
                            </x-container.container>
                        </x-container.wrapper>
                    </x-accordion>
                </x-container.container>

                {{-- White Background --}}
                <x-container.container row="1" class="flex flex-col gap-3">
                    <x-typography variant="body-medium-semibold">White Background</x-typography>
                    <x-accordion label="Accordion White Background" variant="white-background">
                        <x-container.wrapper cols="1" class="bg-gray-50 text-gray-700">
                            <x-container.container row="1" padding="px-4 py-3">
                                <x-typography variant="body-small-regular">
                                    Ini adalah konten untuk accordion dengan varian white-background.
                                    Anda bisa memasukkan teks, gambar, atau komponen lain di sini.
                                </x-typography>
                            </x-container.container>
                        </x-container.wrapper>
                    </x-accordion>
                </x-container.container>

                {{-- Default Open --}}
                <x-container.container row="1" class="flex flex-col gap-3">
                    <x-typography variant="body-medium-semibold">Default Open</x-typography>
                    <x-accordion label="Accordion Default Open" :isDefaultOpen="true">
                        <x-container.wrapper cols="1" class="bg-gray-50 text-gray-700">
                            <x-container.container row="1" padding="px-4 py-3">
                                <x-typography variant="body-small-regular">
                                    Accordion ini terbuka secara otomatis saat halaman dimuat.
                                    Anda bisa memasukkan teks, gambar, atau komponen lain di sini.
                                </x-typography>
                            </x-container.container>
                        </x-container.wrapper>
                    </x-accordion>
                </x-container.container>
            </x-container.wrapper>
        </x-container.container>
    </x-container.wrapper>

@endsection