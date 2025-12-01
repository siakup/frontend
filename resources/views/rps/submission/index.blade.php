@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Semester)')

@section('content')
    <x-container variant="content-wrapper" class="mb-5">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Semester)</x-typography>
        <x-button.back href="{{ route('rps.index') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>
        <x-container variant="flat" class="flex flex-col gap-0">
            @include('rps.layout.navbar-rps')
            <x-container variant="content-under-navbar">
                <x-container variant="flat" class="flex flex-row justify-between py-2">
                    <x-typography variant="body-medium-bold" class="self-center">Submit RPS</x-typography>
                    <x-button.primary x-on:click="$dispatch('open-modal', {id: 'preview-rps'})">
                        Pratinjau
                    </x-button.primary>
                </x-container>
                <x-table.index>
                    <x-table.head>
                        <x-table.row>
                            <x-table.header-cell class="max-w-0">Dosen Pengembang RPS</x-table.header-cell>
                            <x-table.header-cell class="max-w-0">Ketua Program Studi</x-table.header-cell>
                            <x-table.header-cell class="max-w-0">Dekan</x-table.header-cell>
                        </x-table.row>
                    </x-table.head>
                    <x-table.body>
                        <x-table.row>
                            <x-table.cell class="whitespace-pre-line">
                                <br><br><br>
                                {{ $dosen['nama'] }}
                                NIP. {{ $dosen['nip'] }}
                            </x-table.cell>
                            <x-table.cell class="whitespace-pre-line">
                                <br><br><br>
                                {{ $kaprodi['nama'] }}
                                NIP. {{ $kaprodi['nip'] }}
                            </x-table.cell>
                            <x-table.cell class="whitespace-pre-line">
                                <br><br><br>
                                {{ $dekan['nama'] }}
                                NIP. {{ $dekan['nip'] }}
                            </x-table.cell>
                        </x-table.row>
                    </x-table.body>
                </x-table.index>
                <x-container variant="flat" class="flex p-5 justify-end gap-2.5">
                    <x-button.secondary x-on:click="$dispatch('open-modal', {id: 'back-confirmation'})">
                        Kembali
                    </x-button.secondary>
                    <x-button.primary x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">
                        Simpan
                    </x-button.primary>
                    <x-button.primary :href="route('rps.submission.submit')">
                        Submit
                    </x-button.primary>
                </x-container>
            </x-container>
        </x-container>
    </x-container>
    @include('rps.submission._preview')

    <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali" :redirectConfirm="route('rps.matriks-penilaian-kognitif')">
        <p>Apakah Anda yakin ingin menyimpan <b>rencana perkuliahan</b>?</p>
        <x-dialog>
            <x-slot name="header">Perhatian!</x-slot>
            Seluruh perubahan pada halaman ini akan disimpan dan anda secara otomatis dialihkan ke halaman berikutnya.
        </x-dialog>
    </x-modal.confirmation>

    <x-modal.confirmation id="back-confirmation" title="Tunggu Sebentar" confirmText="Ya, Kembali" cancelText="Tidak"
        :redirectConfirm="route('rps.komponen-penilaian')">
        <p>Apakah Anda yakin ingin kembali ke halaman sebelumnya?</p>
        <x-dialog>
            Seluruh perubahan pada halaman ini akan disimpan sebagai <b>draft</b> dan anda dapat mengubah kembali nanti.
        </x-dialog>
    </x-modal.confirmation>
@endsection
