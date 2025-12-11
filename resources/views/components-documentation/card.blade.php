@extends('layouts.main')

@section('title', 'Card')

@php
    $mataKuliah = [
        'nama' => 'Ilmu Sosial Dasar',
        'sks' => 3,
        'kode' => 'SPFA212104',
    ];

    $data1 = [
        'mataKuliah' => 'Proyek Multi Disiplin',
        'kode' => 'CS7',
        'periode' => '2024',
        'kodeRuangan' => '2705',
        'date' => 'Senin, 17 Juli',
        'startTime' => '10.00',
        'endTime' => '11.40',
    ];

    $data2 = [
        'mataKuliah' => 'Basis Data',
        'kode' => 'CS7',
        'periode' => '2024',
        'kodeRuangan' => '2705',
        'date' => 'Senin, 17 Juli',
        'startTime' => '10.00',
        'endTime' => '11.40',
    ];
@endphp

@section('content')
    <x-container.wrapper :gapY="4" :rows="15">
        <x-container.container class="row-start-1 row-end-2">
            <x-typography variant="body-large-semibold">Card</x-typography>
        </x-container.container>
        <x-container.container :background="'content-white'" :radius="'md'" :padding="'p-4'" :gap="'gap-5'"
            class="row-start-2 row-end-16 flex flex-col gap-5">
            <x-typography :variant="'body-large-semibold'">Card Mata Kuliah (Primary dan Secondary)</x-typography>
            <x-container.container class="flex flex-row" :gap="'gap-5'">
                <x-card.mata-kuliah variant="primary" :data="$mataKuliah" />
                <x-card.mata-kuliah variant="secondary" :data="$mataKuliah" />
            </x-container.container>

            <x-typography :variant="'body-large-semibold'">Card Status Mahasiswa</x-typography>
            <x-container.container :background="'content-gray'" class="flex-col" :gap="'gap-4'" :padding="'p-4'">
                <x-card.status-mahasiswa :status="'aktif'" :nama="'Dian Sastro Wardoyo'" :nim="'20240588'" :gender="'women'" />
                <x-card.status-mahasiswa :status="'lulus'" :nama="'Dian Sastro Wardoyo'" :nim="'20240588'" :gender="'women'" />
                <x-card.status-mahasiswa :status="'dropout'" :nama="'Dian Sastro Wardoyo'" :nim="'20240588'" :gender="'women'" />
                <x-card.status-mahasiswa :status="'aktif'" :nama="'Nicholas Saputra'" :nim="'20240588'" :gender="'men'" />
                <x-card.status-mahasiswa :status="'lulus'" :nama="'Nicholas Saputra'" :nim="'20240588'" :gender="'men'" />
                <x-card.status-mahasiswa :status="'dropout'" :nama="'Nicholas Saputra'" :nim="'20240588'" :gender="'men'" />
            </x-container.container>

            <x-typography :variant="'body-large-regular'"><b>Card Jadwal Kuliah</b> *klik pada card untuk memunculkan
                popup</x-typography>
            <x-typography :variant="'body-small-semibold'">Perminggu</x-typography>
            <x-container.container class="flex-row justify-center-safe" :gap="'gap-5'">
                <x-card.jadwal-kuliah.popup :data="$data1">
                    <x-card.jadwal-kuliah.event :variant="'active'" :data="$data1" :event="'week'" />
                </x-card.jadwal-kuliah.popup>
                <x-card.jadwal-kuliah.popup :data="$data2">
                    <x-card.jadwal-kuliah.event :variant="'disable'" :data="$data2" :event="'week'" />
                </x-card.jadwal-kuliah.popup>
            </x-container.container>

            <x-typography :variant="'body-small-semibold'">Perhari</x-typography>
            <x-container.container class="flex-col" :gap="'gap-5'">
                <x-card.jadwal-kuliah.popup :data="$data1">
                    <x-card.jadwal-kuliah.event :variant="'active'" :data="$data1" :event="'day'" />
                </x-card.jadwal-kuliah.popup>
                <x-card.jadwal-kuliah.popup :data="$data2">
                    <x-card.jadwal-kuliah.event :variant="'disable'" :data="$data2" :event="'day'" />
                </x-card.jadwal-kuliah.popup>
            </x-container.container>

            <x-typography :variant="'body-large-semibold'">Card Profile Tulis Pesan</x-typography>
            <x-container.container class="flex-row" :gap="'gap-5'">
                <x-card.profile-message :nama="'Meredita Susanty, M.Sc'" :role="'Dosen'" :prodi="'Ilmu Komputer'" :status="'online'"
                    :avatar="'meredita-susanty.jpg'"></x-card.profile-message>
                <x-card.profile-message :nama="'Meredita Susanty, M.Sc'" :role="'Dosen'" :prodi="'Ilmu Komputer'" :status="'offline'"
                    :avatar="'meredita-susanty.jpg'"></x-card.profile-message>
            </x-container.container>
            <x-container.container class="flex-row" :gap="'gap-5'">
                <x-card.profile-message :nama="'Dian Sastro Wardoyo'" :role="'Mahasiswa'" :prodi="'Ilmu Komputer'" :status="'online'" />
                <x-card.profile-message :nama="'Dian Sastro Wardoyo'" :role="'Mahasiswa'" :prodi="'Ilmu Komputer'" :status="'offline'" />
            </x-container.container>

            <x-typography :variant="'body-large-semibold'">Card List Subjek (Dipakai di page Message)</x-typography>
            <x-container.container class="flex-row" :gap="'gap-5'">
                <x-card.list-subjek :nomor="1" :name="'Putri Mariono'" :nim="'17720002'" :subjek="'Konsultasi KRS Semester 2'"
                    :latest_chat_at="'hari ini 15:10'" :latest_chat_by="'Dian Sastro'"></x-card.list-subjek>
                <x-card.list-subjek :nomor="2" :name="'Nicholas Saputra'" :nim="'221511035'" :subjek="'Konsultasi KRS Semester 2'"
                    :latest_chat_at="'hari ini 20:10'" :latest_chat_by="'Dian Sastro'"></x-card.list-subjek>
            </x-container.container>
        </x-container.container>
    </x-container.wrapper>
@endsection
