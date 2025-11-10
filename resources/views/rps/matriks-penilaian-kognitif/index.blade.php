@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Dosen)')

@section('content')
    <div class="page-header pl-5">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Dosen)</x-typography>
    </div>
    <x-button.back class="ml-2" href="{{ route('rps.index') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>

    @include('rps.layout.navbar-rps')

    <div x-data="{ matriksList: @js($matriksList ?? []) }" class="academics-slicing-content content-card p-5 flex flex-col gap-5" style="border-radius: 0 12px 12px 12px !important;">
        <x-typography variant="body-medium-bold">Matriks Penilaian Kognitif</x-typography>

        @if($matriksList)
            <x-table>
                <x-table-head>
                    <x-table-row>
                        <x-table-header class="w-[150px]">Nilai</x-table-header>
                        <x-table-header>Kualitas Jawaban</x-table-header>
                        <x-table-header class="w-[202px]">Aksi</x-table-header>
                    </x-table-row>
                </x-table-head>

                <x-table-body>
                    @foreach($matriksList as $index => $matriks)
                    <x-table-row>
                        <x-table-cell>{{ $matriks['nilai'] }}</x-table-cell>
                        <x-table-cell position="left">{{ $matriks['jawaban'] }}</x-table-cell>
                        <x-table-cell>
                            <div class="flex flex-wrap gap-3">
                                <x-button.base 
                                    :icon="asset('assets/base/icon-edit-16.svg')"
                                    iconPosition="left"
                                    sizeText="caption-regular"
                                    x-on:click="$dispatch('open-modal', {id: 'edit-matriks-penilaian'})"
                                >
                                    Ubah
                                </x-button.base>
                                <x-button.base 
                                    :icon="asset('assets/active/icon-delete.svg')"
                                    iconPosition="left"
                                    sizeText="caption-regular"
                                    class="text-[#E62129]"
                                    x-on:click="$dispatch('open-modal', {id: 'delete-matriks-penilaian'})"

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
            <x-container variant="content-grey" class="!rounded-xl h-[88px] flex items-center justify-center">
                <x-typography variant="body-small-bold">Belum Ada Matriks Penilaian Kognitif, Silahkan Tambah Matriks Penilaian Terlebih Dahulu</x-typography>
            </x-container>
        @endif

        <div class="flex justify-end">
            <x-button.primary x-on:click="$dispatch('open-modal', {id: 'create-matriks-penilaian'})">Tambah Matriks Penilaian</x-button.primary>
        </div>

        <div class="flex mt-5 justify-end gap-2">
            <x-button.secondary x-bind:disabled="!matriksList || matriksList.length === 0" x-on:click="$dispatch('open-modal', {id: 'back-confirmation'})">Kembali</x-button.secondary>
            <x-button.primary x-bind:disabled="!matriksList || matriksList.length === 0" x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
        </div>
        
    </div>
    @include('rps.matriks-penilaian-kognitif._modal-create')
    @include('rps.matriks-penilaian-kognitif._modal-edit')
    @include('rps.matriks-penilaian-kognitif._modal-delete')

    <x-modal.confirmation 
        id="save-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali"
    >
        <p>Apakah Anda yakin ingin menyimpan <b>matriks peniliaian kognitif</b>?</p>

        <x-container variant="content-wrapper" class="bg-[#FFFBEB] border-[1px] border-[#FDD835] rounded-lg py-3 mt-4">
            <div class="flex gap-4">
                <x-icon iconUrl="{{ asset('assets/icon-caution-warning.svg') }}"/>
                <div class="flex flex-col text-left">
                    <x-typography variant="body-small-bold">Perhatian!</x-typography>
                    <x-typography variant="body-small-regular">Seluruh perubahan pada halaman ini akan disimpan dan anda secara otomatis dialihkan ke halaman berikutnya.</x-typography>
                </div>
            </div>
        </x-container>
    </x-modal.confirmation>

    <x-modal.confirmation 
        id="back-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Kembali"
        cancelText="Tidak"
       :redirectSave="route('rps.rencana-perkuliahan')"
    >
        <p>Apakah Anda yakin ingin kembali ke halaman sebelumnya?</p>

        <x-container variant="content-wrapper" class="bg-[#FFFBEB] border-[1px] border-[#FDD835] rounded-lg py-3 mt-4">
            <div class="flex gap-4">
                <x-icon iconUrl="{{ asset('assets/icon-caution-warning.svg') }}"/>
                <div class="flex flex-col text-left">
                    <x-typography variant="body-small-bold">Perhatian!</x-typography>
                    <p>Seluruh perubahan pada halaman ini akan disimpan sebagai <b>draft</b> dan anda dapat mengubah kembali nanti.</p>
            </div>
        </x-container>
    </x-modal.confirmation>
@endsection