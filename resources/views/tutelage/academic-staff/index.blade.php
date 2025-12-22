@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('javascript')
    <script type="module">
        document.addEventListener('alpine:init', () => {
            Alpine.store('index', {
                lecturer: '',
                periode: '',
                major: '',
                data: @json($perwalian),
            });
        });
    </script>
@endsection

@section('content')
    <div class="flex flex-col gap-4 p-4 w-full h-full" x-data="{}">
        <x-typography variant="body-large-semibold">Kelompok Perwalian</x-typography>
        <div class="content-white p-5 flex-col gap-5 rounded-md w-full h-full">
            <div class="flex flex-col gap-5">
                <x-form.input-container>
                    <x-slot name="label">Periode Akademik</x-slot>
                    <x-slot name="input">
                        <x-dropdown.periode-akademik x-model="$store.index.periode"></x-dropdown.periode-akademik>
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container>
                    <x-slot name="label">Program Studi</x-slot>
                    <x-slot name="input">
                        <x-dropdown.major x-model="$store.index.major"></x-dropdown.major>
                    </x-slot>
                </x-form.input-container>
                <x-form.input-container inputClass="flex flex-row gap-3">
                    <x-slot name="label">Dosen Perkuliahan</x-slot>
                    <x-slot name="input">
                        <x-dropdown.lecturer x-model="$store.index.lecturer"></x-dropdown.lecturer>
                        <x-button variant="primary" buttonClass="min-w-40!">Cari</x-button>
                    </x-slot>
                </x-form.input-container>
            </div>
            <x-dialog variant="warning">
                <x-slot name="header">Perhatian!</x-slot>
                23 Mahasiswa belum memiliki <b>kelompok perwalian</b>
            </x-dialog>

            {{-- Tabel --}}
            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell>No</x-table.header-cell>
                        <x-table.header-cell>Nama Kelompok</x-table.header-cell>
                        <x-table.header-cell>Periode Akademik</x-table.header-cell>
                        <x-table.header-cell>Jumlah Bimbingan</x-table.header-cell>
                        <x-table.header-cell>Status Aktif</x-table.header-cell>
                        <x-table.header-cell>Status Cuti</x-table.header-cell>
                        <x-table.header-cell>Status Kosong</x-table.header-cell>
                        <x-table.header-cell>Aksi</x-table.header-cell>
                        <x-table.header-cell>Salin Perwalian</x-table.header-cell>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    @foreach ($perwalian as $index => $data)
                        <x-table.row :odd="$index % 2 === 0">
                            <x-table.cell> {{ $index }}</x-table.cell>
                            <x-table.cell> {{ $data->nama }}</x-table.cell>
                            <x-table.cell> {{ $data->periode_akademik }}</x-table.cell>
                            <x-table.cell>
                                <div class="whitespace-nowrap">
                                    {!! $data->bimbingan_formatted !!}
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                {!! $data->status_aktif !!}
                            </x-table.cell>
                            <x-table.cell>
                                {!! $data->status_cuti !!}
                            </x-table.cell>
                            <x-table.cell>
                                {!! $data->status_kosong !!}
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex-nowrap inline-flex gap-3">
                                    <x-button.base :icon="'circle-remove/black-16'" iconPosition="left" sizeText="caption-regular"
                                        x-on:click="$dispatch('open-modal', {id: 'end-perwalian', dosen: '{{ $data->nama }}'})">
                                        Akhiri
                                    </x-button.base>
                                    <x-button.base :icon="'edit/red-16'" iconPosition="left" class="text-red-500"
                                        sizeText="caption-regular" :href="route('tutelage-group.edit', $data->id)" >
                                        Ubah
                                    </x-button.base>
                                    <x-button.base :icon="'delete/grey-16'" iconPosition="left" class="text-gray-600"
                                        sizeText="caption-regular" x-data
                                        x-on:click="$dispatch('toast-show', { type: 'info', message: 'Berhasil menghapus kelompok perwalian {{ $data->nama }}', size: 'lg' })">
                                        Hapus
                                    </x-button.base>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <x-button.base :icon="'copy/black-16'" iconPosition="left" sizeText="caption-regular"
                                    :href="route('tutelage-group.copy', $data->id)">
                                    Salin
                                </x-button.base>
                            </x-table.cell>
                        </x-table.row>
                    @endforeach

                </x-table.body>
            </x-table.index>
            <div class="flex justify-end">
                <x-button variant="primary" :href="route('tutelage-group.create')">Tambah Kelompok Perwalian</x-button>
            </div>
        </div>
    </div>
    <x-toast />
    <x-modal.tutelage.end />

@endsection
