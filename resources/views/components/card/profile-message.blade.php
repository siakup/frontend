@props([
    'nama' => '',
    'role' => 'Dosen', // ada dosen dan mahasiswa
    'prodi' => '',
    'avatar' => '',
    'status' => 'online',
    'clickButton' => null, // ada offline dan ada online
])

@php
    $listStatus = [
        'online' => 'green',
        'offline' => 'red',
    ];

    $status = $listStatus[$status] ?? 'green';
    $iconStatus = "dot/$status-12";

@endphp

<div class="flex flex-col gap-3">
    <div class="flex flex-row gap-2">
        @if ($role == 'Mahasiswa')
            <x-icon :name="'avatar/women/4-32'" class="w-17 h-17" />
        @else
            <div class="w-17 h-17 rounded-full overflow-hidden p-2.5">
                <img src="{{ asset("assets/images/$avatar") }}" class="w-full h-full object-top object-cover scale-150"
                    loading="lazy" />
            </div>
        @endif
        <x-icon :name="$iconStatus" class="w-fit h-fit py-1.5" />
        <div class="flex flex-col gap-3 p-3/4">
            <x-typography :variant="'body-small-bold'">{{ $nama }}</x-typography>
            <div class="flex flex-col">
                <x-typography :variant="'caption-regular'">{{ $role }}</x-typography>
                <x-typography :variant="'pixie-regular'">{{ $prodi }}</x-typography>
            </div>
        </div>
    </div>
    <x-button :variant="'primary'" :size="'md'" :icon="'message/white-20'" class="min-w-full" :href="$clickButton">Buat
        Pesan</x-button>
</div>
