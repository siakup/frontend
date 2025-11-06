@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Dosen)')

@section('content')
    <div class="page-header pl-5">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Dosen)</x-typography>
    </div>
    <x-button.base
        :icon="asset('assets/icon-less-than-red-20.svg')"
        :href="route('rps.index')"
        class="ml-5 mb-3 text-[#E62129]"
    >
        Buat RPS (Rencana Pembelajaran Dosen)
    </x-button.base>

    @include('rps.layout.navbar-rps')

    <div x-data class="academics-slicing-content content-card p-5 flex flex-col gap-5" style="border-radius: 0 12px 12px 12px !important;">
        <x-typography variant="body-medium-bold">Komponen Penilaian</x-typography>

        @if($komponenList)
            <x-table>
                <x-table-head>
                    <x-table-row>
                        <x-table-header class="w-[104px]">Nama Komponen</x-table-header>
                        <x-table-header class="w-[104px]">Bobot Komponen</x-table-header>
                        @foreach($cpmkList as $cpmk)
                        <x-table-header class="w-[85px]">{{ $cpmk }}</x-table-header>
                        @endforeach
                    </x-table-row>
                </x-table-head>

                <x-table-body>
                    @foreach($komponenList as $index => $komponen)
                    <x-table-row>
                        <x-table-cell>{{ $komponen['nama'] }}</x-table-cell>
                        <x-table-cell>{{ $komponen['bobot'] }}</x-table-cell>
                        @foreach($komponen['cpmk'] as $nilaiCpmk)
                            <x-table-cell>
                                @if($nilaiCpmk === true)
                                    <div class="flex justify-center items-center">
                                        @if ($nilaiCpmk)
                                            <x-icon iconUrl="{{ asset('assets/base/icon-tick.svg') }}" class="h-[20px] w-[20px]" />
                                        @endif
                                    </div>
                                @endif
                            </x-table-cell>
                        @endforeach
                    </x-table-row>
                    @endforeach
                </x-table-body>
            </x-table>
        @else
            <x-container variant="content-grey" class="!rounded-xl h-[88px] flex items-center justify-center">
                <x-typography variant="body-small-bold">Belum Ada Komponen Penilaian, Silahkan Tambah Komponen Terlebih Dahulu</x-typography>
            </x-container>
        @endif
        <div class="flex justify-end">
            <x-button.primary x-on:click="$dispatch('open-modal', {id: 'create-komponen-penilaian'})">Tambah Komponen</x-button.primary>
        </div>
        <div class="flex mt-5 justify-end gap-2">
            <x-button.secondary x-on:click="$dispatch('open-modal', {id: 'back-confirmation'})">Batal</x-button.secondary>
            <x-button.primary x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
        </div>
    </div>
    @include('rps.komponen-penilaian._modal-create')

    <x-modal.confirmation 
        id="save-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali"
    >
        <p>Apakah Anda yakin ingin menyimpan <b>komponen penilaian</b>?</p>

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
        redirectTo="{{ route('rps.capaian-pembelajaran') }}"
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