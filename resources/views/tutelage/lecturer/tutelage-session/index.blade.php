@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('content')
    <div class="flex flex-col gap-4 p-4 w-full h-full" x-data="{ periode: '' }">
        <x-typography variant="body-large-semibold">Kelompok Perwalian</x-typography>
        <div class="flex flex-col gap-0 h-full">
            @include('tutelage.lecturer.layout.navbar')
            <div class="content-under-navbar h-full w-full rounded-md">
                <x-typography variant="body-large-bold">Sesi Perwalian</x-typography>
                <x-dialog>
                    <x-slot name="header">Perhatian!</x-slot>
                    Info panduan perwalian dapat anda unduh 
                    <button class="text-blue-500 font-bold underline cursor-pointer" x-on:click="$dispatch('open-modal', {id: 'preview-file'})">di sini.</button> 
                </x-dialog>
                <div class="content-white flex-row p-5 items-center justify-between rounded-md">
                    <div class="flex flex-row gap-5 items-center">
                        <x-typography variant="body-medium-bold">Periode Akademik</x-typography>
                        <x-dropdown.periode-akademik variant="red" x-model="periode" />
                    </div>
                    <x-button variant="primary" iconPosition="right" :icon="'caret-positive/red-20'" :href="route('tutelage-group.session.create')">Tambah Sesi
                        Perwalian</x-button>
                </div>
                <x-table.index>
                    <x-table.head>
                        <x-table.row>
                            <x-table.header-cell>Nama Event</x-table.header-cell>
                            <x-table.header-cell>Periode Akademik</x-table.header-cell>
                            <x-table.header-cell>Tanggal</x-table.header-cell>
                            <x-table.header-cell>Tempat</x-table.header-cell>
                            <x-table.header-cell>Jumlah Peserta</x-table.header-cell>
                            <x-table.header-cell>Aksi</x-table.header-cell>
                        </x-table.row>
                    </x-table.head>
                    <x-table.body>
                        @foreach ($perwalian as $index => $data)
                            <x-table.row :odd="$index % 2 === 0">
                                <x-table.cell> {{ $data->nama_event }}</x-table.cell>
                                <x-table.cell> {{ $data->periode_akademik }}</x-table.cell>
                                <x-table.cell> {{ $data->tanggal }}</x-table.cell>
                                <x-table.cell> {{ $data->tempat }}</x-table.cell>
                                <x-table.cell> {{ $data->jumlah_peserta }}</x-table.cell>
                                <x-table.cell>
                                    <div class="flex-nowrap inline-flex gap-3">
                                        <x-button.base :icon="'search/black-16'" iconPosition="left" sizeText="caption-regular">
                                            Lihat
                                        </x-button.base>
                                        <x-button.base :icon="'edit/red-16'" iconPosition="left" class="text-red-500"
                                            sizeText="caption-regular">
                                            Ubah
                                        </x-button.base>
                                        <x-button.base :icon="'delete/grey-16'" iconPosition="left" class="text-gray-600"
                                            sizeText="caption-regular">
                                            Hapus
                                        </x-button.base>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-table.body>
                </x-table.index>
            </div>
        </div>
    </div>
    <x-modal.preview :file="'files/rps.pdf'"/>
@endsection
