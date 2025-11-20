@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Dosen)')

{{-- <script src="{{ asset('js/controllers/rpsCpl.js') }}" defer></script> --}}

@section('content')
    <div class="page-header pl-5">
        <x-typography variant="heading-h6">Ubah Rencana Evaluasi</x-typography>
    </div>
    <x-button.back class="ml-2 mb-4" href="{{ route('rps.rencana-evaluasi-mahasiswa') }}">Rencana Evaluasi Mahasiswa</x-button.back>

    
    <div class="cpl-head border border-gray-400 ml-3 grad-peach">
        <x-typography variant="body-medium-bold">Ubah Rencana Evaluasi</x-typography>
    </div>
    <x-container x-data variant="content" class="ml-3" borderRadius="rounded-b-xl">
        <x-container variant="content" class="flex flex-col gap-3" borderRadius="rounded-xl">
            <x-form.input-container labelClass="w-50">
                <x-slot name="label">Bentuk Ujian</x-slot>
                <x-slot name="input">
                    <x-form.dropdown
                        variant="gray"
                        buttonId="dropdownUjianButton"
                        dropdownId="dropdownUjianList"
                        label="-Pilih Bentuk Ujian-"
                        :dropdownItem="$bentukUjian"
                        dropdownContainerClass="w-full"
                        :imgSrc="asset('assets/icons/arrow-down/grey-20.svg')"
                        :isIconCanRotate="true"
                    />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container labelClass="w-50">
                <x-slot name="label">Judul Evaluasi</x-slot>
                <x-slot name="input">
                    <x-form.input
                        name="judul_evaluasi"
                        placeholder="Masukkan Judul Evaluasi"
                    />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container labelClass="w-50">
                <x-slot name="label">Sub CPMK</x-slot>
                <x-slot name="input">
                    <div class="flex flex-col gap-2">
                        @foreach($subCpmk as $value => $label)
                        <x-form.checklist 
                            id="{{ $value }}" 
                            value="{{ $value }}" 
                            label="{{ $label }}" 
                            name="{{ $value }}" 
                            x-model="cpmk"
                        />
                        @endforeach
                    </div>
                </x-slot>
            </x-form.input-container>
            <x-form.input-container labelClass="w-50">
                <x-slot name="label">Deskripsi Evaluasi</x-slot>
                <x-slot name="input">
                    <x-form.textarea
                        id="deskripsi_evaluasi"
                        maxChar="100"
                        rows="5"
                        placeholder="Masukkan Deskripsi Evaluasi"
                    />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container labelClass="w-50">
                <x-slot name="label">Metode Pengerjaan Evaluasi</x-slot>
                <x-slot name="input">
                    <x-form.textarea
                        id="metode_pengerjaan_evaluasi"
                        maxChar="100"
                        rows="5"
                        placeholder="Masukkan Metode Pengerjaan Evaluasi"
                    />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container labelClass="w-50">
                <x-slot name="label">Bentuk dan Format Luaran</x-slot>
                <x-slot name="input">
                    <x-form.textarea
                        id="bentuk_format_luaran"
                        maxChar="100"
                        rows="5"
                        placeholder="Masukkan Bentuk dan Format Luaran"
                    />
                </x-slot>
            </x-form.input-container>
        </x-container>
        
        <div class="flex flex-col gap-4 my-5">
            <x-typography variant="body-medium-bold">Indikator, Kriteria dan Bobot Penilaian</x-typography>
            <x-table>
                <x-table-head>
                    <x-table-row>
                        <x-table-header>Indikator dan Kriteria</x-table-header>
                        <x-table-header>Bobot</x-table-header>
                        <x-table-header>Aksi</x-table-header>
                    </x-table-row>
                </x-table-head>
                <x-table-body>
                    @foreach ($indikatorList as $index => $indikator)
                    <x-table-row>
                        <x-table-cell class="text-xs">{{ $indikator['indikator'] }}</x-table-cell>
                        <x-table-cell class="text-xs">{{ $indikator['bobot'] }}</x-table-cell>
                        <x-table-cell>
                            <x-button.base                  
                                :icon="asset('assets/icons/delete/grey-20.svg')"
                                iconPosition="left"
                                sizeText="caption-regular"
                                buttonClass="text-[#8C8C8C]"
                                x-on:click="$dispatch('open-modal', {id: 'delete-indikator'})"
                            >
                                Hapus
                            </x-button.base>
                        </x-table-cell>
                    </x-table-row>
                    @endforeach
                </x-table-body>
            </x-table>
            <div class="flex justify-end">
                <x-button.primary x-on:click="$dispatch('open-modal', {id: 'create-indikator'})">Tambah Indikator dan Kriteria</x-button.primary>
            </div> 
        </div>

        <div class="flex flex-col gap-4 my-5">
            <x-typography variant="body-medium-bold">Jadwal Pelaksanaan</x-typography>
            <x-table>
                <x-table-head>
                    <x-table-row>
                        <x-table-header>Nama Kegiatan</x-table-header>
                        <x-table-header>Minggu ke-</x-table-header>
                        <x-table-header>Aksi</x-table-header>
                    </x-table-row>
                </x-table-head>
                <x-table-body>
                    @foreach ($jadwalPelaksanaan as $index => $jadwal)
                    <x-table-row>
                        <x-table-cell class="text-xs">{{ $jadwal['nama_kegiatan'] }}</x-table-cell>
                        <x-table-cell class="text-xs">{{ $jadwal['minggu_ke'] }}</x-table-cell>
                        <x-table-cell>
                            <x-button.base                  
                                :icon="asset('assets/icons/delete/grey-20.svg')"
                                iconPosition="left"
                                sizeText="caption-regular"
                                buttonClass="text-gray-600"
                                x-on:click="$dispatch('open-modal', {id: 'delete-kegiatan'})"
                            >
                                Hapus
                            </x-button.base>
                        </x-table-cell>
                    </x-table-row>
                    @endforeach
                </x-table-body>
            </x-table>
            <div class="flex justify-end">
                <x-button.primary x-on:click="$dispatch('open-modal', {id: 'create-kegiatan'})">Tambah Kegiatan</x-button.primary>
            </div> 
        </div>
        <x-form.input-container labelClass="w-50">
            <x-slot name="label">Catatan dan Lainnya</x-slot>
            <x-slot name="input">
                <x-form.textarea
                    id="catatan"
                    maxChar="100"
                    rows="5"
                />
            </x-slot>
        </x-form.input-container>
        <div class="flex mt-5 justify-end gap-2">
            <x-button.secondary x-on:click="$dispatch('open-modal', {id: 'back-confirmation'})">Batal</x-button.secondary>
            <x-button.primary x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button.primary>
        </div>
    </x-container>
    @include('rps.rencana-evaluasi-mahasiswa._create-indikator')
    @include('rps.rencana-evaluasi-mahasiswa._create-kegiatan')
    @include('rps.rencana-evaluasi-mahasiswa._delete-indikator')
    @include('rps.rencana-evaluasi-mahasiswa._delete-kegiatan')

    <x-modal.confirmation 
        id="save-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali"
    >
        <p>Apakah Anda yakin informasi yang ditambahkan sudah benar?</p>
    </x-modal.confirmation>
    
@endsection