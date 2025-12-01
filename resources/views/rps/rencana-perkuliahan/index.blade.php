@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Semester)')

@section('content')
    <x-container variant="content-wrapper">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Semester)</x-typography>
        <x-button.back href="{{ route('rps.index') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>

        <x-container variant="flat" class="flex flex-col gap-0">
            @include('rps.layout.navbar-rps')
            <x-container variant="content-under-navbar" x-data="{ rencanaPerkuliahan: @js($rencanaPerkuliahan ?? []) }">
                <x-typography variant="body-medium-bold">Rencana Perkuliahan</x-typography>
                @if ($rencanaPerkuliahan)
                    <x-table.index>
                        <x-table.head>
                            <x-table.row>
                                <x-table.header-cell rowspan="2">Minggu ke-</x-table.header-cell>
                                <x-table.header-cell rowspan="2">CPMK</x-table.header-cell>
                                <x-table.header-cell rowspan="2">Sub CPMK</x-table.header-cell>
                                <x-table.header-cell rowspan="2">Topik dan Konten Perkuliahan</x-table.header-cell>
                                <x-table.header-cell colspan="3">
                                    Total Waktu Kegiatan Tatap Muka & Terstruktur (Menit)
                                </x-table.header-cell>
                                <x-table.header-cell rowspan="2">Total Waktu Belajar Mandiri
                                    (Menit)</x-table.header-cell>
                                <x-table.header-cell rowspan="2">Total Waktu (Menit)</x-table.header-cell>
                                <x-table.header-cell rowspan="2">Metode Pembelajaran</x-table.header-cell>
                            </x-table.row>
                            <x-table.row>
                                <x-table.header-cell>K</x-table.header-cell>
                                <x-table.header-cell>DL</x-table.header-cell>
                                <x-table.header-cell>T</x-table.header-cell>
                            </x-table.row>
                        </x-table.head>


                        <x-table.body>
                            @foreach ($rencanaPerkuliahan as $index => $rencana)
                                <x-table.row :odd="$index % 2 === 1" :last="$loop->last">
                                    <x-table.cell>{{ $rencana['minggu'] }}</x-table.cell>
                                    <x-table.cell>{{ $rencana['cpmk'] }}</x-table.cell>
                                    <x-table.cell class="whitespace-pre-line"
                                        position="left">{{ $rencana['sub_cpmk'] }}</x-table.cell>
                                    <x-table.cell class="whitespace-pre-line"
                                        position="left">{{ $rencana['rencana'] }}</x-table.cell>
                                    <x-table.cell>{{ $rencana['waktu_kuliah'] }}</x-table.cell>
                                    <x-table.cell>{{ $rencana['waktu_diskusi_latihan'] }}</x-table.cell>
                                    <x-table.cell>{{ $rencana['waktu_praktikum'] }}</x-table.cell>
                                    <x-table.cell>{{ $rencana['waktu_mandiri'] }}</x-table.cell>
                                    <x-table.cell>{{ $rencana['total_waktu'] }}</x-table.cell>
                                    <x-table.cell>{{ $rencana['metode_penilaian'] }}</x-table.cell>
                                </x-table.row>
                            @endforeach
                            <x-table.row :odd="true" class="font-bold">
                                <x-table.cell colspan="4">Waktu Pembelajaran Total dalam 1 Semester
                                    (menit)</x-table.cell>
                                <x-table.cell>{{ $waktuTotal['kuliah'] }}</x-table.cell>
                                <x-table.cell>{{ $waktuTotal['diskusi_latihan'] }}</x-table.cell>
                                <x-table.cell>{{ $waktuTotal['praktikum'] }}</x-table.cell>
                                <x-table.cell>{{ $waktuTotal['mandiri'] }}</x-table.cell>
                                <x-table.cell>{{ $waktuTotal['total'] }}</x-table.cell>
                                <x-table.cell></x-table.cell>
                            </x-table.row>
                            <x-table.row :odd="true" class="font-bold">
                                <x-table.cell colspan="4">Waktu Pembelajaran Standar Nasional untuk 1 SKS
                                    (menit)</x-table.cell>
                                <x-table.cell></x-table.cell>
                                <x-table.cell></x-table.cell>
                                <x-table.cell></x-table.cell>
                                <x-table.cell> </x-table.cell>
                                <x-table.cell>{{ $waktuStandarNasional }}</x-table.cell>
                                <x-table.cell></x-table.cell>
                            </x-table.row>
                            <x-table.row :odd="true" class="font-bold">
                                <x-table.cell colspan="4">Satuan Kredit Semester (SKS)</x-table.cell>
                                <x-table.cell></x-table.cell>
                                <x-table.cell></x-table.cell>
                                <x-table.cell></x-table.cell>
                                <x-table.cell></x-table.cell>
                                <x-table.cell>{{ $sks }}</x-table.cell>
                                <x-table.cell></x-table.cell>
                            </x-table.row>
                        </x-table.body>
                    </x-table.index>
                @else
                    <x-container variant="content-grey" class="flex items-center justify-center">
                        <x-typography variant="body-small-bold">Belum Ada Rencana Perkuliahan, Silahkan Tambah Rencana
                            Perkuliahan Terlebih Dahulu</x-typography>
                    </x-container>
                @endif
                <div class="flex justify-end">
                    <x-button.primary :href="route('rps.rencana-perkuliahan.create')">Tambah Rencana Perkuliahan</x-button.primary>
                </div>


                <div class="flex mt-5 justify-end gap-2">
                    <x-button.secondary x-bind:disabled="!rencanaPerkuliahan || rencanaPerkuliahan.length === 0"
                        x-on:click="$dispatch('open-modal', {id: 'back-confirmation'})">
                        Kembali
                    </x-button.secondary>
                    <x-button.primary x-bind:disabled="!rencanaPerkuliahan || rencanaPerkuliahan.length === 0"
                        x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">
                        Simpan
                    </x-button.primary>
                </div>
            </x-container>
        </x-container>
    </x-container>


    <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali" :redirectConfirm="route('rps.matriks-penilaian-kognitif')">
        <p>Apakah Anda yakin ingin menyimpan <b>rencana perkuliahan</b>?</p>
        <x-dialog variant="warning">
            <x-slot name="header">Perhatian!</x-slot>
            Seluruh perubahan pada halaman ini akan disimpan dan anda
            secara otomatis dialihkan ke halaman berikutnya.
        </x-dialog>
    </x-modal.confirmation>

    <x-modal.confirmation id="back-confirmation" title="Tunggu Sebentar" confirmText="Ya, Kembali" cancelText="Tidak"
        :redirectConfirm="route('rps.komponen-penilaian')">
        <p>Apakah Anda yakin ingin kembali ke halaman sebelumnya?</p>
        <x-dialog variant="warning">
            <x-slot name="header">Perhatian!</x-slot>
            Seluruh perubahan pada halaman ini akan disimpan sebagai <b>draft</b> dan anda dapat mengubah kembali
            nanti.
        </x-dialog>
    </x-modal.confirmation>
@endsection
