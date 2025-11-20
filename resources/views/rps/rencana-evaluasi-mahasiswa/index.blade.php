@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Semester)')

@section('content')
    <div class="page-header pl-5">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Semester)</x-typography>
    </div>
    <x-button.back class="ml-2" href="{{ route('rps.index') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>

    <div class="academics-layout">
    @include('rps.layout.navbar-rps')

        <div x-data="{ rencanaList: @js($rencanaList ?? []) }"  class="rps-content p-5 flex flex-col gap-5" >
            <x-typography variant="body-medium-bold">Rencana Evaluasi Mahasiswa</x-typography>

            @if($rencanaList)
                <x-table>
                    <x-table-head>
                        <x-table-row>
                            <x-table-header>Bentuk Ujian</x-table-header>
                            <x-table-header>Judul Evaluasi</x-table-header>
                            <x-table-header>Sub - CPMK</x-table-header>
                            <x-table-header>Metode Pengerjaan</x-table-header>
                            <x-table-header>Aksi</x-table-header>
                        </x-table-row>
                    </x-table-head>

                    <x-table-body>
                        @foreach($rencanaList as $index => $rencana)
                        <x-table-row>
                            <x-table-cell text_size="text-xs">{{ $rencana['bentuk_ujian'] }}</x-table-cell>
                            <x-table-cell text_size="text-xs">{{ $rencana['judul_evaluasi'] }}</x-table-cell>
                            <x-table-cell text_size="text-xs" class="whitespace-pre-line">
                                @foreach ($rencana['sub_cpmk'] as $sub_cpmk)
                                    {{ $sub_cpmk }}
                                @endforeach
                            </x-table-cell>
                            <x-table-cell text_size="text-xs" class="whitespace-pre-line">{{ $rencana['metode_pengerjaan'] }}</x-table-cell>
                            <x-table-cell>
                                <div class="flex flex-nowrap gap-3">
                                    <x-button.base 
                                        :icon="asset('assets/icons/search/black-16.svg')"
                                        iconPosition="left"
                                        sizeText="caption-regular"
                                        x-on:click="$dispatch('open-modal', {id: 'view-rencana-evaluasi'})"
                                    >
                                        Lihat
                                    </x-button.base>
                                    <x-button.base 
                                        :icon="asset('assets/icons/edit/red-16.svg')"
                                        iconPosition="left"
                                        sizeText="caption-regular"
                                        buttonClass="text-red-500"
                                        :href="route('rps.rencana-evaluasi-mahasiswa.edit', ['id' => $rencana['id']])"
                                    >
                                        Ubah
                                    </x-button.base>
                                    <x-button.base 
                                        :icon="asset('assets/icons/delete/grey-16.svg')"
                                        iconPosition="left"
                                        sizeText="caption-regular"
                                        buttonClass="text-gray-600"
                                        x-on:click="$dispatch('open-modal', {id: 'delete-rencana-evaluasi'})"

                                    >
                                        Hapus
                                    </x-button.base>
                                </div>
                            </x-table-cell>
                        </x-table-row>
                        @endforeach
                    </x-table-body>
                </x-table>
            @else
                <x-container variant="content-grey" class="h-22 flex items-center justify-center" borderRadius="rounded-xl">
                    <x-typography variant="body-small-bold">Belum Ada Rencana Evaluasi Mahasiswa, Silahkan Tambah Rencana Evaluasi Terlebih Dahulu</x-typography>
                </x-container>
            @endif

            <div class="flex justify-end">
                <x-button.primary :href="route('rps.rencana-evaluasi-mahasiswa.create')">Tambah Rencana Evaluasi</x-button.primary>
            </div>
            <div class="flex mt-5 justify-end gap-2">
                <x-button.secondary x-bind:disabled="!rencanaList || rencanaList.length === 0" x-on:click="$dispatch('open-modal', {id: 'back-confirmation'})">Kembali</x-button.secondary>
                <x-button.primary x-bind:disabled="!rencanaList || rencanaList.length === 0" x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
            </div>
            
        </div>
    </div>
    @include('rps.rencana-evaluasi-mahasiswa._view')
    @include('rps.rencana-evaluasi-mahasiswa._delete')

    <x-modal.confirmation 
        id="save-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali"
    >
        <p>Apakah Anda yakin ingin menyimpan <b>rencana evaluasi mahasiswa</b>?</p>
        <x-dialog variant="warning" dialogClass="mb-0">
            <x-slot name="header">Perhatian!</x-slot>
            Seluruh perubahan pada halaman ini akan disimpan dan anda secara otomatis dialihkan ke halaman berikutnya.
        </x-dialog>
    </x-modal.confirmation>

    <x-modal.confirmation 
        id="back-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Kembali"
        cancelText="Tidak"
       :redirectConfirm="route('rps.evaluasi-pemetaan-capaian')"
    >
        <p>Apakah Anda yakin ingin kembali ke halaman sebelumnya?</p>
        <x-dialog variant="warning" dialogClass="mb-0">
            <x-slot name="header">Perhatian!</x-slot>
            Seluruh perubahan pada halaman ini akan disimpan sebagai <b>draft</b> dan anda dapat mengubah kembali nanti.
        </x-dialog>
    </x-modal.confirmation>
@endsection