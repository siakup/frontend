@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Semester)')

@section('content')
    <div class="flex flex-col gap-4 p-4 w-full h-full">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Semester)</x-typography>
        <x-button.back href="{{ route('rps.index') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>
        <div x-data="{ rencanaList: @js($rencanaList ?? []) }" class="flex flex-col gap-0">
            @include('rps.layout.navbar-rps')
            <div class="content-under-navbar rounded-md">
                <x-typography variant="body-medium-bold">Rencana Evaluasi Mahasiswa</x-typography>
                @if ($rencanaList)
                    <x-table.index>
                        <x-table.head>
                            <x-table.row>
                                <x-table.header-cell>Bentuk Ujian</x-table.header-cell>
                                <x-table.header-cell>Judul Evaluasi</x-table.header-cell>
                                <x-table.header-cell>Sub - CPMK</x-table.header-cell>
                                <x-table.header-cell>Metode Pengerjaan</x-table.header-cell>
                                <x-table.header-cell>Aksi</x-table.header-cell>
                            </x-table.row>
                        </x-table.head>
                        <x-table.body>
                            @foreach ($rencanaList as $index => $rencana)
                                <x-table.row>
                                    <x-table.cell>{{ $rencana['bentuk_ujian'] }}</x-table.cell>
                                    <x-table.cell>{{ $rencana['judul_evaluasi'] }}</x-table.cell>
                                    <x-table.cell class="whitespace-pre-line">
                                        @foreach ($rencana['sub_cpmk'] as $sub_cpmk)
                                            {{ $sub_cpmk }}
                                        @endforeach
                                    </x-table.cell>
                                    <x-table.cell
                                        class="whitespace-pre-line">{{ $rencana['metode_pengerjaan'] }}</x-table.cell>
                                    <x-table.cell>
                                        <div class="flex flex-nowrap gap-3">
                                            <x-button.base :icon="'search/black-16'" iconPosition="left" sizeText="caption-regular"
                                                x-on:click="$dispatch('open-modal', {id: 'view-rencana-evaluasi'})">
                                                Lihat
                                            </x-button.base>
                                            <x-button.base :icon="'edit/red-16'" iconPosition="left" sizeText="caption-regular"
                                                buttonClass="text-red-500" :href="route('rps.rencana-evaluasi-mahasiswa.edit', [
                                                    'id' => $rencana['id'],
                                                ])">
                                                Ubah
                                            </x-button.base>
                                            <x-button.base :icon="'delete/grey-16'" iconPosition="left" sizeText="caption-regular"
                                                buttonClass="text-gray-600"
                                                x-on:click="$dispatch('open-modal', {id: 'delete-rencana-evaluasi'})">
                                                Hapus
                                            </x-button.base>
                                        </div>
                                    </x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-table.body>
                    </x-table.index>
                @else
                    <div class="content-grey rounded-md p-5 flex items-center justify-center" borderRadius="rounded-xl">
                        <x-typography variant="body-small-bold">Belum Ada Rencana Evaluasi Mahasiswa, Silahkan Tambah
                            Rencana Evaluasi Terlebih Dahulu</x-typography>
                    </div>
                @endif

                <div class="flex justify-end">
                    <x-button variant="primary" :href="route('rps.rencana-evaluasi-mahasiswa.create')">Tambah Rencana Evaluasi</x-button>
                </div>
                <div class="flex mt-5 justify-end gap-2">
                    <x-button variant="secondary" x-bind:disabled="!rencanaList || rencanaList.length === 0"
                        x-on:click="$dispatch('open-modal', {id: 'back-confirmation'})">Kembali</x-button>
                    <x-button variant="primary" x-bind:disabled="!rencanaList || rencanaList.length === 0"
                        x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button>
                </div>
            </div>
        </div>
    </div>

    @include('rps.rencana-evaluasi-mahasiswa._view')
    @include('rps.rencana-evaluasi-mahasiswa._delete')

    <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali">
        <p>Apakah Anda yakin ingin menyimpan <b>rencana evaluasi mahasiswa</b>?</p>
        <x-dialog variant="warning" dialogClass="mb-0">
            <x-slot name="header">Perhatian!</x-slot>
            Seluruh perubahan pada halaman ini akan disimpan dan anda secara otomatis dialihkan ke halaman berikutnya.
        </x-dialog>
    </x-modal.confirmation>

    <x-modal.confirmation id="back-confirmation" title="Tunggu Sebentar" confirmText="Ya, Kembali" cancelText="Tidak"
        :redirectConfirm="route('rps.evaluasi-pemetaan-capaian')">
        <p>Apakah Anda yakin ingin kembali ke halaman sebelumnya?</p>
        <x-dialog variant="warning" dialogClass="mb-0">
            <x-slot name="header">Perhatian!</x-slot>
            Seluruh perubahan pada halaman ini akan disimpan sebagai <b>draft</b> dan anda dapat mengubah kembali nanti.
        </x-dialog>
    </x-modal.confirmation>
@endsection
