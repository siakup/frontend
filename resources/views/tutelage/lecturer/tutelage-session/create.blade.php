@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('content')
    <div class="flex flex-col gap-4 p-4 w-full h-full" x-data="{ angkatan: '', tanggal: '', event_perwalian: '', kehadiran: 'alpa' }">
        <x-typography variant="body-large-semibold">Tambah Sesi Perwalian - Nama Dosen</x-typography>
        <x-button.back :href="route('tutelage-group.session.index')">Kelompok Perwalian</x-button.back>
        <div class="content-white flex-col gap-5 p-5 rounded-md w-full h-full">
            <x-typography variant="body-large-bold">Tambah Sesi Perwalian</x-typography>
            <x-dialog>
                <x-slot name="header">Perhatian!</x-slot>
                Info panduan perwalian dapat anda unduh di sini.
            </x-dialog>

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

            <x-typography variant="body-medium-bold">Detail Sesi Perwalian Baru</x-typography>
            <div class="content-white rounded-md p-5">
                <div class="grid grid-cols-2 grid-rows-2 gap-5">
                    <x-form.input-container :fullWidth="false">
                        <x-slot name="label">Angkatan</x-slot>
                        <x-slot name="input">
                            <x-dropdown.tahun-masuk x-model="angkatan" label="-Pilih Angkatan-"></x-dropdown.tahun-masuk>
                        </x-slot>
                    </x-form.input-container>
                    <x-form.input-container :fullWidth="false">
                        <x-slot name="label">Tanggal dan Waktu</x-slot>
                        <x-slot name="input">
                            <x-form.calendar id="create-sesi-perwalian" name="tanggal_sesi_perwalian" x-model="tanggal"
                                oninput=""></x-form.calendar>
                        </x-slot>
                    </x-form.input-container>
                    <x-form.input-container :fullWidth="false">
                        <x-slot name="label">Event Perwalian</x-slot>
                        <x-slot name="input">
                            <x-dropdown.event-perwalian x-model="event_perwalian"></x-dropdown.event-perwalian>
                        </x-slot>
                    </x-form.input-container>
                    <x-form.input-container :fullWidth="false">
                        <x-slot name="label">Tempat</x-slot>
                        <x-slot name="input">
                            <x-form.input placeholder="Masukkan Tempat Perwalian" name="tempat"></x-form.input>
                        </x-slot>
                    </x-form.input-container>
                </div>
            </div>
            <x-typography variant="body-medium-bold">Daftar Peserta</x-typography>
            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell>NIM</x-table.header-cell>
                        <x-table.header-cell>Nama Mahasiswa</x-table.header-cell>
                        <x-table.header-cell>Institusi</x-table.header-cell>
                        <x-table.header-cell>Kehadiran</x-table.header-cell>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    @foreach ($dataPeserta as $index => $daftarPeserta )
                        <x-table.row>
                            <x-table.cell> {{ $daftarPeserta->nim }}</x-table.cell>
                            <x-table.cell> {{ $daftarPeserta->nama }}</x-table.cell>
                            <x-table.cell> {{ $daftarPeserta->institusi }}</x-table.cell>
                            <x-table.cell>
                                <x-dropdown.kehadiran x-model="kehadiran" ></x-dropdown.kehadiran>
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-table.body>
            </x-table.index>
            <div class="flex flex-row gap-5 justify-end">
                <x-button variant="secondary">Batal</x-button>
                <x-button variant="primary" x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button>
            </div>
        </div>
    </div>
@endsection
