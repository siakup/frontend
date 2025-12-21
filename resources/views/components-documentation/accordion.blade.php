@extends('layouts.main')

@section('title', 'Accordion Documentation')

@section('content')
    {{-- Terdapat tiga parameter untuk accordion --}}
    {{-- label: label dari accordion --}}
    {{-- variant: variasi dari accordion (red-gradient dan white-background). Defaultnya adalah red-gradient --}}
    {{-- isDefaultOpen: menentukan apakah accordion terbuka secara default atau tidak (true/false). Defaultnya adalah false--}}

    <x-container.container variant="content-wrapper" class="flex flex-col gap-5">
        
        <x-typography variant="body-large-semibold">Penggunaan accordion</x-typography>

        <x-container.container class="flex flex-col gap-5" borderRadius="rounded-lg">

            {{-- Red Gradient --}}
            <x-typography variant="body-medium-semibold">Red Gradient (Default)</x-typography>
            <div class="flex flex-col gap-3">
                <x-accordion label="Accordion Red Gradient (Default)" variant="red-gradient">
                    <div class="p-4 bg-gray-50 text-gray-700">
                        Ini adalah konten untuk accordion dengan varian default (red-gradient).
                        Anda bisa memasukkan teks, gambar, atau komponen lain di sini.
                    </div>
                </x-accordion>
            </div>

            {{-- White Background --}}
            <x-typography variant="body-medium-semibold">White Background</x-typography>
            <div class="flex flex-col gap-3">
                <x-accordion label="Accordion White Background" variant="white-background">
                    <div class="p-4 bg-gray-50 text-gray-700">
                        Ini adalah konten untuk accordion dengan varian white-background.
                        Anda bisa memasukkan teks, gambar, atau komponen lain di sini.
                    </div>
                </x-accordion>
            </div>

            {{-- Default Open (default color red--}}
            <x-typography variant="body-medium-semibold">Default Open</x-typography>
            <div class="flex flex-col gap-3">
                <x-accordion label="Accordion Default Open" :isDefaultOpen="true">
                    <div class="p-4 bg-gray-50 text-gray-700">
                        Accordion ini terbuka secara otomatis saat halaman dimuat
                        Anda bisa memasukkan teks, gambar, atau komponen lain di sini.
                    </div>
                </x-accordion>
            </div>

        </x-container.container>

    </x-container.container>
@endsection