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

    <x-container.wrapper gapY="4" padding="p-0">
        <x-typography variant="body-large-semibold">Dokumentasi Komponen Card</x-typography>

        <x-container.wrapper background="content-white" radius="md" padding="p-6" class="flex flex-col gap-8">

            <div>
                <x-typography variant="body-large-semibold" class="mb-4">Card Mata Kuliah (Primary dan
                    Secondary)</x-typography>

                <x-container.wrapper cols="2" gapX="5" gapY="5" padding="p-0">
                    <x-card.mata-kuliah variant="primary" :data="$mataKuliah" />
                    <x-card.mata-kuliah variant="secondary" :data="$mataKuliah" />
                </x-container.wrapper>
            </div>

            <hr class="border-gray-200" />

            <div>
                <x-typography variant="body-large-semibold" class="mb-4">Card Status Mahasiswa</x-typography>

                <x-container.wrapper background="content-gray" radius="md" padding="p-4" gapY="4"
                    class="flex flex-col">
                    <x-card.status-mahasiswa status="aktif" nama="Dian Sastro Wardoyo" nim="20240588" gender="women" />
                    <x-card.status-mahasiswa status="lulus" nama="Dian Sastro Wardoyo" nim="20240588" gender="women" />
                    <x-card.status-mahasiswa status="dropout" nama="Dian Sastro Wardoyo" nim="20240588" gender="women" />
                    <x-card.status-mahasiswa status="aktif" nama="Nicholas Saputra" nim="20240588" gender="men" />
                    <x-card.status-mahasiswa status="lulus" nama="Nicholas Saputra" nim="20240588" gender="men" />
                    <x-card.status-mahasiswa status="dropout" nama="Nicholas Saputra" nim="20240588" gender="men" />
                </x-container.wrapper>
            </div>

            <hr class="border-gray-200" />

            <div>
                <x-typography variant="body-large-regular" class="mb-4">
                    <b>Card Jadwal Kuliah</b> *klik pada card untuk memunculkan popup
                </x-typography>

                <x-typography variant="body-small-semibold" class="mb-2">Perminggu</x-typography>
                <x-container.wrapper cols="2" gapX="5" padding="p-0" justify="center" class="mb-6">
                    <x-card.jadwal-kuliah.popup :data="$data1">
                        <x-card.jadwal-kuliah.event variant="active" :data="$data1" event="week" />
                    </x-card.jadwal-kuliah.popup>
                    <x-card.jadwal-kuliah.popup :data="$data2">
                        <x-card.jadwal-kuliah.event variant="disable" :data="$data2" event="week" />
                    </x-card.jadwal-kuliah.popup>
                </x-container.wrapper>

                <x-typography variant="body-small-semibold" class="mb-2">Perhari</x-typography>
                <x-container.wrapper gapY="5" padding="p-0" class="flex flex-col">
                    <x-card.jadwal-kuliah.popup :data="$data1">
                        <x-card.jadwal-kuliah.event variant="active" :data="$data1" event="day" />
                    </x-card.jadwal-kuliah.popup>
                    <x-card.jadwal-kuliah.popup :data="$data2">
                        <x-card.jadwal-kuliah.event variant="disable" :data="$data2" event="day" />
                    </x-card.jadwal-kuliah.popup>
                </x-container.wrapper>
            </div>

            <hr class="border-gray-200" />

            <div>
                <x-typography variant="body-large-semibold" class="mb-4">Card Profile Tulis Pesan</x-typography>

                <x-container.wrapper cols="2" gapX="5" gapY="5" padding="p-0" class="mb-5">
                    <x-card.profile-message nama="Meredita Susanty, M.Sc" role="Dosen" prodi="Ilmu Komputer"
                        status="online" avatar="meredita-susanty.jpg" />
                    <x-card.profile-message nama="Meredita Susanty, M.Sc" role="Dosen" prodi="Ilmu Komputer"
                        status="offline" avatar="meredita-susanty.jpg" />
                </x-container.wrapper>

                <x-container.wrapper cols="2" gapX="5" gapY="5" padding="p-0">
                    <x-card.profile-message nama="Dian Sastro Wardoyo" role="Mahasiswa" prodi="Ilmu Komputer"
                        status="online" />
                    <x-card.profile-message nama="Dian Sastro Wardoyo" role="Mahasiswa" prodi="Ilmu Komputer"
                        status="offline" />
                </x-container.wrapper>
            </div>

            <hr class="border-gray-200" />

            <div>
                <x-typography variant="body-large-semibold" class="mb-4">Card List Subjek (Dipakai di page
                    Message)</x-typography>
                <x-container.wrapper cols="2" gapX="5" gapY="5" padding="p-0">
                    <x-card.list-subjek nomor="1" name="Putri Mariono" nim="17720002"
                        subjek="Konsultasi KRS Semester 2" latest_chat_at="hari ini 15:10"
                        latest_chat_by="Dian Sastro" />
                    <x-card.list-subjek nomor="2" name="Nicholas Saputra" nim="221511035"
                        subjek="Konsultasi KRS Semester 2" latest_chat_at="hari ini 20:10"
                        latest_chat_by="Dian Sastro" />
                </x-container.wrapper>
            </div>

        </x-container.wrapper>
    </x-container.wrapper>
@endsection
