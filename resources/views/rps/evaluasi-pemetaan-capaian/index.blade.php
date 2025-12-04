@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Dosen)')

@section('content')
    <x-container variant="content-wrapper">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Dosen)</x-typography>
        <x-button.back href="{{ route('rps.index') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>
        <x-container variant="flat" class="flex flex-col gap-0">
            @include('rps.layout.navbar-rps')

            <x-container variant="content-under-navbar" x-data>
                <x-typography variant="body-medium-bold">Evaluasi Pemetaan Konten Perkuliahan Dengan Capaian
                    Lulusan</x-typography>
                <x-typography variant="body-small-semibold" class="mt-4">Capaian Pembelajaran Lulusan (CPL)</x-typography>

                @if ($evaluasiList)
                    <x-table.index>
                        <x-table.head>
                            <x-table.row>
                                <x-table.header-cell colspan="2" rowspan="2">Capaian Mata Kuliah
                                    (CPMK)</x-table.header-cell>
                                <x-table.header-cell colspan="3">{{ $cpl }}</x-table.header-cell>
                            </x-table.row>
                            <x-table.row>
                                <x-table.header-cell>Tugas</x-table.header-cell>
                                <x-table.header-cell>UTS</x-table.header-cell>
                                <x-table.header-cell>UAS</x-table.header-cell>
                            </x-table.row>
                        </x-table.head>

                        <x-table.body>
                            @foreach ($evaluasiList as $eval)
                                <x-table.row>
                                    <x-table.cell class="w-50">{{ $eval['cpmk'] }}</x-table.cell>
                                    <x-table.cell position="left">{{ $eval['deskripsi'] }}</x-table.cell>

                                    <x-table.cell>
                                        @if ($eval['rincian']['tugas'])
                                            <x-icon :name="'tick/black-20'" class="mx-auto"></x-icon>
                                        @endif
                                    </x-table.cell>
                                    <x-table.cell class="text-center">
                                        @if ($eval['rincian']['uts'])
                                            <x-icon :name="'tick/black-20'" class="mx-auto"></x-icon>
                                        @endif
                                    </x-table.cell>
                                    <x-table.cell class="text-center">
                                        @if ($eval['rincian']['uas'])
                                            <x-icon :name="'tick/black-20'" class="mx-auto"></x-icon>
                                        @endif
                                    </x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-table.body>
                    </x-table.index>
                @else
                    <x-table.index>
                        <x-table.head>
                            <x-table.row>
                                <x-table.header-cell colspan="2">Capaian Mata Kuliah (CPMK)</x-table.header-cell>
                                <x-table.header-cell></x-table.header-cell>
                            </x-table.row>
                        </x-table.head>
                        <x-table.body>
                            @foreach ($evaluasiList as $eval)
                                <x-table.row>
                                    <x-table.cell class="w-50">{{ $eval['cpmk'] }}</x-table.cell>
                                    <x-table.cell position="left">{{ $eval['deskripsi'] }}</x-table.cell>
                                    @if ($loop->first)
                                        <x-table.cell rowspan="{{ $loop->count }}"
                                            class="bg-gray-400 font-semibold text-xs">Belum Ada Evaluasi Pemetaan, Silahkan
                                            Tambah Evaluasi Pemetaan Terlebih Dahulu</x-table.cell>
                                    @endif
                                </x-table.row>
                            @endforeach
                        </x-table.body>
                    </x-table.index>
                @endif

                <div class="flex justify-end">
                    <x-button.primary x-on:click="$dispatch('open-modal', {id: 'create-evaluasi-pemetaan'})">Tambah Evaluasi
                        Pemetaan</x-button.primary>
                </div>
                <div class="flex mt-5 justify-end gap-2">
                    <x-button.secondary
                        x-on:click="$dispatch('open-modal', {id: 'back-confirmation'})">Kembali</x-button.secondary>
                    <x-button.primary
                        x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
                </div>
            </x-container>
        </x-container>
    </x-container>

    @include('rps.evaluasi-pemetaan-capaian._create')

    <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali" :redirectConfirm="route('rps.rencana-perkuliahan')">
        <p>Apakah Anda yakin ingin menyimpan <b>komponen penilaian</b>?</p>

        <x-dialog>
            <x-slot name="header">Perhatian!</x-slot>
            Seluruh perubahan pada halaman ini akan disimpan dan anda
            secara otomatis dialihkan ke halaman berikutnya.
        </x-dialog>
    </x-modal.confirmation>

    <x-modal.confirmation id="back-confirmation" title="Tunggu Sebentar" confirmText="Ya, Kembali" cancelText="Tidak"
        :redirectConfirm="route('rps.capaian-pembelajaran')">
        <p>Apakah Anda yakin ingin kembali ke halaman sebelumnya?</p>
        <x-dialog>
            <x-slot name="header">Perhatian!</x-slot>
            Seluruh perubahan pada halaman ini akan disimpan sebagai <b>draft</b> dan anda dapat mengubah kembali
            nanti.
        </x-dialog>
    </x-modal.confirmation>
@endsection
