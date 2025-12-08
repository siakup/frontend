@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Semester)')

@section('content')
    <x-container variant="content-wrapper">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Semester)</x-typography>
        <x-button.back href="{{ route('rps.index') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>

        <x-container variant="flat" class="flex flex-col gap-0">
            @include('rps.layout.navbar-rps')

            <x-container variant="content-under-navbar" x-data="{ matriksList: @js($matriksList ?? []) }">
                <x-typography variant="body-medium-bold">Matriks Penilaian Kognitif</x-typography>
                @if ($matriksList)
                    <x-table.index>
                        <x-table.head>
                            <x-table.row>
                                <x-table.header-cell>Nilai</x-table.header-cell>
                                <x-table.header-cell>Kualitas Jawaban</x-table.header-cell>
                                <x-table.header-cell>Aksi</x-table.header-cell>
                            </x-table.row>
                        </x-table.head>
                        <x-table.body>
                            @foreach ($matriksList as $index => $matriks)
                                <x-table.row>
                                    <x-table.cell>{{ $matriks['nilai'] }}</x-table.cell>
                                    <x-table.cell position="left">{{ $matriks['jawaban'] }}</x-table.cell>
                                    <x-table.cell>
                                        <div class="flex flex-nowrap gap-3">
                                            <x-button.base :icon="'edit/black-16'" iconPosition="left" sizeText="caption-regular"
                                                x-on:click="$dispatch('open-modal', {id: 'edit-matriks-penilaian'})">
                                                Ubah
                                            </x-button.base>
                                            <x-button.base :icon="'delete/red-16'" iconPosition="left" sizeText="caption-regular"
                                                class="text-red-500"
                                                x-on:click="$dispatch('open-modal', {id: 'delete-matriks-penilaian'})">
                                                Hapus
                                            </x-button.base>
                                        </div>
                                    </x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-table.body>
                    </x-table.index>
                @else
                    <x-container variant="content-grey" class="h-22 flex items-center justify-center">
                        <x-typography variant="body-small-bold">Belum Ada Matriks Penilaian Kognitif, Silahkan Tambah
                            Matriks Penilaian Terlebih Dahulu</x-typography>
                    </x-container>
                @endif

                <x-container variant="flat" class="flex justify-end">
                    <x-button.primary x-on:click="$dispatch('open-modal', {id: 'create-matriks-penilaian'})">Tambah Matriks
                        Penilaian</x-button.primary>
                </x-container>

                <x-container variant="flat" class="flex justify-end py-5 gap-2.5">
                    <x-button.secondary class="w-38!" x-on:click="$dispatch('open-modal', {id: 'back-confirmation'})">
                        Kembali
                    </x-button.secondary>
                    <x-button.primary class="w-38!" x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">
                        Simpan
                    </x-button.primary>
                </x-container>

            </x-container>
        </x-container>
    </x-container>
    @include('rps.matriks-penilaian-kognitif._modal-create')
    @include('rps.matriks-penilaian-kognitif._modal-edit')
    @include('rps.matriks-penilaian-kognitif._modal-delete')

    <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali">
        <p>Apakah Anda yakin ingin menyimpan <b>matriks peniliaian kognitif</b>?</p>
        <x-dialog>
            <x-slot name="header">Perhatian!</x-slot>
            Seluruh perubahan pada halaman ini akan disimpan dan anda
            secara otomatis dialihkan ke halaman berikutnya.
        </x-dialog>
    </x-modal.confirmation>

    <x-modal.confirmation id="back-confirmation" title="Tunggu Sebentar" confirmText="Ya, Kembali" cancelText="Tidak"
        :redirectConfirm="route('rps.rencana-perkuliahan')">
        <p>Apakah Anda yakin ingin kembali ke halaman sebelumnya?</p>
        <x-dialog>
            <x-slot name="header">Perhatian!</x-slot>
            Seluruh perubahan pada halaman ini akan disimpan sebagai <b>draft</b> dan anda dapat mengubah kembali
            nanti.
        </x-dialog>
    </x-modal.confirmation>
@endsection
