@extends('layouts.main')

@section('title', 'Detail Sesi Perwalian')

@section('content')
    <div class="flex flex-col gap-4 p-4 w-full h-full">
        <x-typography variant="body-large-semibold">Detail Sesi Perwalian - Nama Dosen</x-typography>
        <x-button.back :href="route('tutelage-group.session.index')">Kelompok Perwalian</x-button.back>
        <div class="content-white flex-col gap-5 p-5 rounded-md w-full h-full">
            <x-typography variant="body-large-bold">Detail Sesi Perwalian</x-typography>
            <x-table.index>
                <x-table.body>
                    <x-table.row>
                        <x-table.header-cell variantColor="odd" position="left">Kelompok Perwalian</x-table.header-cell>
                        <x-table.cell variantColor="odd" position="left"
                            text_size="text-sm">{{ $data->kelompok_perwalian }}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.header-cell variantColor="even" position="left">Dosen Wali</x-table.header-cell>
                        <x-table.cell variantColor="even" position="left"
                            text_size="text-sm">{{ $data->dosen_wali }}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.header-cell variantColor="odd" position="left">Jenjang / Semester</x-table.header-cell>
                        <x-table.cell variantColor="odd" position="left"
                            text_size="text-sm">{{ $data->jenjang }}</x-table.cell>
                    </x-table.row>
                    <x-table.row :last="true">
                        <x-table.header-cell variantColor="even" position="left">Periode Akademik</x-table.header-cell>
                        <x-table.cell variantColor="even" position="left"
                            text_size="text-sm">{{ $data->periode_akademik }}</x-table.cell>
                    </x-table.row>
                </x-table.body>
            </x-table.index>

            <x-typography variant="body-medium-bold">Daftar Peserta</x-typography>
            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell>NIM</x-table.header-cell>
                        <x-table.header-cell>Nama Mahasiswa</x-table.header-cell>
                        <x-table.header-cell>Kehadiran</x-table.header-cell>
                        <x-table.header-cell>Lembar Kendali</x-table.header-cell>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    @foreach ($dataPeserta as $index => $daftarPeserta)
                        <x-table.row :odd="$index % 2 === 1">
                            <x-table.cell> {{ $daftarPeserta->nim }}</x-table.cell>
                            <x-table.cell> {{ $daftarPeserta->nama }}</x-table.cell>
                            <x-table.cell>
                                @php
                                    $variant = match ($daftarPeserta->kehadiran) {
                                        'Hadir' => 'green-filled',
                                        'Izin' => 'yellow-filled',
                                        'Alpa' => 'red-filled',
                                        default => null,
                                    };
                                @endphp

                                @if ($variant)
                                    <x-badge :variant="$variant">
                                        {{ $daftarPeserta->kehadiran }}
                                    </x-badge>
                                @endif
                            </x-table.cell>
                            <x-table.cell>
                                <x-button.base :icon="'registration/blue-16'" sizeText="caption-regular"
                                    class="text-blue-500 hover:underline" x-on:click="$dispatch('open-modal', {id: 'preview-file'})">
                                    {{ $daftarPeserta->lembar_kendali }}
                                </x-button.base>
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-table.body>
            </x-table.index>
            <div class="flex flex-row gap-5 justify-end">
                <x-button variant="secondary">Kembali</x-button>
            </div>
        </div>
    </div>
    <x-modal.preview cancelText="Kembali" confirmText="Unduh Lembar Kendali" :file="'files/rps.pdf'" />
@endsection
