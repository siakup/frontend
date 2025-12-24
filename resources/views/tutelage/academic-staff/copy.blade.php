@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('javascript')
    <script type="module">
        document.addEventListener('alpine:init', () => {
            Alpine.store('copy', {
                dosen: @js($lectureName),
                periode: @js($periode),
                major: @js($major),
            });
        });
    </script>
@endsection

@section('content')
    <div class="flex flex-col gap-4 p-4 w-full h-full" x-data="{ status: false }">
        <x-typography variant="body-large-semibold">Salin Kelompok Perwalian - <span x-text="$store.copy.dosen"></span>
        </x-typography>
        <div class="content-white p-5 flex-col gap-5 rounded-md w-full h-full">
            <div class="flex flex-col gap-5">
                <x-form.input-container>
                    <x-slot name="label">Periode Akademik</x-slot>
                    <x-slot name="input">
                        <x-dropdown.periode-akademik x-model="$store.copy.periode"></x-dropdown.periode-akademik>
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container>
                    <x-slot name="label">Program Studi</x-slot>
                    <x-slot name="input">
                        <x-dropdown.major x-model="$store.copy.major"></x-dropdown.major>
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container>
                    <x-slot name="label">Dosen Wali</x-slot>
                    <x-slot name="input">
                        <x-form.input name="dosen" x-model="$store.copy.dosen" :disabled="true" />
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container inputClass="flex flex-row justify-between">
                    <x-slot name="label">Status</x-slot>
                    <x-slot name="input">
                        <x-form.switch name="status" x-model="status" />
                    </x-slot>
                </x-form.input-container>
            </div>

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
                            <x-table.cell> {{ $index }}</x-table.cell>
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
                <x-button variant="primary">Salin</x-button>
            </div>
        </div>
        <x-modal.tutelage.mahasiswa-bimbingan.create :data="$perwalian" />
    </div>

@endsection
