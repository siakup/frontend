@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Dosen)')

@section('content')
    <div class="page-header pl-5">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Dosen)</x-typography>
    </div>
    <x-button.back class="ml-2" href="{{ route('rps.index') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>

    <div class="academics-layout">
    @include('rps.layout.navbar-rps')

        <div x-data="{ rencanaPerkuliahan: @js($rencanaPerkuliahan ?? []) }" class="academics-slicing-content content-card p-5 flex flex-col gap-5" style="border-radius: 0 12px 12px 12px !important;">
            <x-typography variant="body-medium-bold">Rencana Perkuliahan</x-typography>

            @if($rencanaPerkuliahan)
                <x-table>
                    <x-table-head>
                        <x-table-row>
                            <x-table-header rowspan="2">Minggu ke-</x-table-header>
                            <x-table-header rowspan="2" class="w-[95px]">CPMK</x-table-header>
                            <x-table-header rowspan="2">Sub CPMK</x-table-header>
                            <x-table-header rowspan="2">Topik dan Konten Perkuliahan</x-table-header>
                            <x-table-header colspan="3">
                                Total Waktu Kegiatan Tatap Muka & Terstruktur (Menit)
                            </x-table-header>
                            <x-table-header rowspan="2">Total Waktu Belajar Mandiri (Menit)</x-table-header>
                            <x-table-header rowspan="2">Total Waktu (Menit)</x-table-header>
                            <x-table-header rowspan="2">Metode Pembelajaran</x-table-header>
                        </x-table-row>

                        <x-table-row>
                            <x-table-header>K</x-table-header>
                            <x-table-header>DL</x-table-header>
                            <x-table-header>T</x-table-header>
                        </x-table-row>
                    </x-table-head>


                    <x-table-body>
                        @foreach($rencanaPerkuliahan as $index => $rencana)
                        <x-table-row :odd="$index % 2 === 1" :last="$loop->last">
                            <x-table-cell class="text-xs">{{ $rencana['minggu'] }}</x-table-cell>
                            <x-table-cell class="text-xs">{{ $rencana['cpmk'] }}</x-table-cell>
                            <x-table-cell class="text-xs" position="left">{{ $rencana['sub_cpmk'] }}</x-table-cell>
                            <x-table-cell class="text-xs" position="left">{{ $rencana['rencana'] }}</x-table-cell>
                            <x-table-cell class="text-xs">{{ $rencana['waktu_kuliah'] }}</x-table-cell>
                            <x-table-cell class="text-xs">{{ $rencana['waktu_diskusi_latihan'] }}</x-table-cell>
                            <x-table-cell class="text-xs">{{ $rencana['waktu_praktikum'] }}</x-table-cell>
                            <x-table-cell class="text-xs">{{ $rencana['waktu_mandiri'] }}</x-table-cell>
                            <x-table-cell class="text-xs">{{ $rencana['total_waktu'] }}</x-table-cell>
                            <x-table-cell class="text-xs">{{ $rencana['metode_penilaian'] }}</x-table-cell>
                        </x-table-row>
                        @endforeach
                        <x-table-row :odd="true" class="font-bold">
                            <x-table-cell class="text-xs" colspan="4">Waktu Pembelajaran Total dalam 1 Semester (menit)</x-table-cell>
                            <x-table-cell class="text-xs">{{ $waktuTotal['kuliah'] }}</x-table-cell>
                            <x-table-cell class="text-xs">{{ $waktuTotal['diskusi_latihan'] }}</x-table-cell>
                            <x-table-cell class="text-xs">{{ $waktuTotal['praktikum'] }}</x-table-cell>
                            <x-table-cell class="text-xs">{{ $waktuTotal['mandiri'] }}</x-table-cell>
                            <x-table-cell class="text-xs">{{ $waktuTotal['total'] }}</x-table-cell>
                            <x-table-cell></x-table-cell>
                        </x-table-row>
                        <x-table-row :odd="true" class="font-bold">
                            <x-table-cell class="text-xs" colspan="4">Waktu Pembelajaran Standar Nasional untuk 1 SKS (menit)</x-table-cell>
                            <x-table-cell></x-table-cell>
                            <x-table-cell></x-table-cell>
                            <x-table-cell></x-table-cell>
                            <x-table-cell></x-table-cell>
                            <x-table-cell class="text-xs">{{ $waktuStandarNasional }}</x-table-cell>
                            <x-table-cell></x-table-cell>
                        </x-table-row>
                        <x-table-row :odd="true" class="font-bold">
                            <x-table-cell class="text-xs" colspan="4">Satuan Kredit Semester (SKS)</x-table-cell>
                            <x-table-cell></x-table-cell>
                            <x-table-cell></x-table-cell>
                            <x-table-cell></x-table-cell>
                            <x-table-cell></x-table-cell>
                            <x-table-cell class="text-xs">{{ $sks }}</x-table-cell>
                            <x-table-cell></x-table-cell>
                        </x-table-row>
                    </x-table-body>
                </x-table>
            @else
                <x-container variant="content-grey" class="!rounded-xl h-[88px] flex items-center justify-center">
                    <x-typography variant="body-small-bold">Belum Ada Rencana Perkuliahan, Silahkan Tambah Rencana Perkuliahan Terlebih Dahulu</x-typography>
                </x-container>
            @endif
            <div class="flex justify-end">
                <x-button.primary :href="route('rps.rencana-perkuliahan.create')">Tambah Rencana Perkuliahan</x-button.primary>
            </div>


            <div class="flex mt-5 justify-end gap-2">
                <x-button.secondary 
                    x-bind:disabled="!rencanaPerkuliahan || rencanaPerkuliahan.length === 0"
                    x-on:click="$dispatch('open-modal', {id: 'back-confirmation'})"
                >
                    Kembali
                </x-button.secondary>
                <x-button.primary
                    x-bind:disabled="!rencanaPerkuliahan || rencanaPerkuliahan.length === 0" 
                    x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})"
                >
                    Simpan
                </x-button.primary>
            </div>
        </div>
    </div>
    
    <x-modal.confirmation 
        id="save-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali"
        :redirectConfirm="route('rps.matriks-penilaian-kognitif')"
    >
        <p>Apakah Anda yakin ingin menyimpan <b>rencana perkuliahan</b>?</p>

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
        :redirectConfirm="route('rps.komponen-penilaian')"
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