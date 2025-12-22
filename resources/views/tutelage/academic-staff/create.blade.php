@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('javascript')
    <script type="module">
        document.addEventListener('alpine:init', () => {
            Alpine.store('create', {
                lecturer: '',
                periode: '',
                major: '',
                data: @json($perwalian),
                status: false,
            });
        });
    </script>
@endsection

@section('content')
    <div class="flex flex-col gap-4 p-4 w-full h-full" x-data="{}">
        <x-typography variant="body-large-semibold">Tambah Kelompok Perwalian</x-typography>
        <div class="content-white p-5 flex-col gap-5 rounded-md w-full h-full">
            <div class="flex flex-col gap-5">
                <x-form.input-container>
                    <x-slot name="label">Periode Akademik</x-slot>
                    <x-slot name="input">
                        <x-dropdown.periode-akademik x-model="$store.create.periode"></x-dropdown.periode-akademik>
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container>
                    <x-slot name="label">Program Studi</x-slot>
                    <x-slot name="input">
                        <x-dropdown.major x-model="$store.create.major"></x-dropdown.major>
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container>
                    <x-slot name="label">Dosen Wali</x-slot>
                    <x-slot name="input">
                        <x-dropdown.lecturer x-model="$store.create.lecturer" label="-Pilih Dosen Wali-" />
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container inputClass="flex flex-row justify-between">
                    <x-slot name="label">Status</x-slot>
                    <x-slot name="input">
                        <x-form.switch name="status" x-model="$store.create.status" />
                        <x-button variant="primary"
                            x-on:click="$dispatch('open-modal', {id: 'create-mahasiswa-bimbingan'})">Tambah Mahasiswa
                            Bimbingan</x-button>
                    </x-slot>
                </x-form.input-container>
            </div>
            <x-dialog variant="warning">
                <x-slot name="header">Perhatian!</x-slot>
                <div class="ml-4">
                    <ul class="list-disc list-inside">
                        <li>Kelompok perwalian harus memiliki minimal 1 peserta</li>
                        <li>Tidak diperbolehkan ada mahasiswa yang tidak memiliki dosen wali</li>
                        <li>1 Dosen wali hanya memiliki 1 kelompok perwalian pada suatu periode akademik tertentu</li>
                        <li>1 Mahasiswa hanya boleh masuk dalam 1 kelompok perwalian pada suatu periode akademik tertentu
                        </li>
                    </ul>
                </div>
            </x-dialog>

            {{-- Tabel --}}
            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell>No</x-table.header-cell>
                        <x-table.header-cell>Nomor Induk Mahasiswa</x-table.header-cell>
                        <x-table.header-cell>Tahun Masuk</x-table.header-cell>
                        <x-table.header-cell>Nama Mahasiswa Bimbingan</x-table.header-cell>
                        <x-table.header-cell>Institusi</x-table.header-cell>
                        <x-table.header-cell>Hapus</x-table.header-cell>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    @foreach ($perwalian as $index => $data)
                        <x-table.row :odd="$index % 2 === 0">
                            <x-table.cell> {{ $index + 1 }}</x-table.cell>
                            <x-table.cell> {{ $data->nim }}</x-table.cell>
                            <x-table.cell> {{ $data->tahun_masuk }}</x-table.cell>
                            <x-table.cell> {{ $data->nama }}</x-table.cell>
                            <x-table.cell> {{ $data->institusi }}</x-table.cell>
                            <x-table.cell>
                                <x-button.base :icon="'delete/grey-16'" iconPosition="left" class="text-gray-600"
                                    sizeText="caption-regular">
                                    Hapus
                                </x-button.base></x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-table.body>
            </x-table.index>
            <div class="flex flex-row gap-5 justify-end">
                <x-button variant="secondary">Batal</x-button>
                <x-button variant="primary" x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">Simpan</x-button>
            </div>
        </div>
    </div>
    <x-modal.tutelage.mahasiswa-bimbingan.create :data="$perwalian" />
    <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan"
        cancelText="Tidak, Kembali">
        <p><span x-text="$store.create.lecturer"></span> sudah memiliki kelompok perwalian, apakah Anda akan menggabungkan peserta kelompok perwalian ini ke kelompok perwalian aktif yang berisi?</p>
    </x-modal.confirmation>
@endsection
