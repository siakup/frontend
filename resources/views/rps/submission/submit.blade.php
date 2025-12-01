@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Semester)')

@section('content')
    <x-container variant="content-wrapper" class="gap-2!">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Semester)</x-typography>
        <x-button.back href="{{ route('rps.submission') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>
        <x-container class="flex flex-col gap-5">
            <x-container variant="flat" class="flex flex-row gap-2.5">
                <x-typography variant="heading-h5">Submit RPS</x-typography>
                <x-icon :name="'exclamation-mark/black-16'"></x-icon>
            </x-container>
            {{-- Tabel 1 --}}
            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell>Mata Kuliah</x-table.header-cell>
                        <x-table.header-cell>Kode</x-table.header-cell>
                        <x-table.header-cell>Bobot (SKS)</x-table.header-cell>
                        <x-table.header-cell>Semester</x-table.header-cell>
                        <x-table.header-cell>Rumpun Mata Kuliah</x-table.header-cell>
                        <x-table.header-cell>Level Program</x-table.header-cell>
                        <x-table.header-cell>Tgl. Penyusunan</x-table.header-cell>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    <x-table.row>
                        <x-table.cell></x-table.cell>
                    </x-table.row>
                </x-table.body>
            </x-table.index>

            {{-- Tabel 2 --}}
            <x-table.index :isHaveTitle="true" :colorTypeTableTitle="'light-red-gradient'">
                <x-slot name="tableTitleSlot">
                    <x-typography variant="body-medium-bold">Tabel Rencana Perkuliahan</x-typography>
                </x-slot>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell rowspan="2">Minggu ke-</x-table.header-cell>
                        <x-table.header-cell rowspan="2">CPMK</x-table.header-cell>
                        <x-table.header-cell rowspan="2">Sub CPMK</x-table.header-cell>
                        <x-table.header-cell rowspan="2">Topik dan Konten Perkuliahan</x-table.header-cell>
                        <x-table.header-cell colspan="3">
                            Total Waktu Kegiatan Tatap Muka & Terstruktur (Menit)
                        </x-table.header-cell>
                        <x-table.header-cell rowspan="2">Total Waktu Belajar Mandiri
                            (Menit)</x-table.header-cell>
                        <x-table.header-cell rowspan="2">Total Waktu (Menit)</x-table.header-cell>
                        <x-table.header-cell rowspan="2">Metode Pembelajaran</x-table.header-cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.header-cell>K</x-table.header-cell>
                        <x-table.header-cell>DL</x-table.header-cell>
                        <x-table.header-cell>T</x-table.header-cell>
                    </x-table.row>
                </x-table.head>


                <x-table.body>
                    @foreach ($rencanaPerkuliahan as $index => $rencana)
                        <x-table.row :odd="$index % 2 === 1" :last="$loop->last">
                            <x-table.cell>{{ $rencana['minggu'] }}</x-table.cell>
                            <x-table.cell>{{ $rencana['cpmk'] }}</x-table.cell>
                            <x-table.cell class="whitespace-pre-line"
                                position="left">{{ $rencana['sub_cpmk'] }}</x-table.cell>
                            <x-table.cell class="whitespace-pre-line"
                                position="left">{{ $rencana['rencana'] }}</x-table.cell>
                            <x-table.cell>{{ $rencana['waktu_kuliah'] }}</x-table.cell>
                            <x-table.cell>{{ $rencana['waktu_diskusi_latihan'] }}</x-table.cell>
                            <x-table.cell>{{ $rencana['waktu_praktikum'] }}</x-table.cell>
                            <x-table.cell>{{ $rencana['waktu_mandiri'] }}</x-table.cell>
                            <x-table.cell>{{ $rencana['total_waktu'] }}</x-table.cell>
                            <x-table.cell>{{ $rencana['metode_penilaian'] }}</x-table.cell>
                        </x-table.row>
                    @endforeach
                    <x-table.row :odd="true" class="font-bold">
                        <x-table.cell colspan="4">Waktu Pembelajaran Total dalam 1 Semester
                            (menit)</x-table.cell>
                        <x-table.cell>{{ $waktuTotal['kuliah'] }}</x-table.cell>
                        <x-table.cell>{{ $waktuTotal['diskusi_latihan'] }}</x-table.cell>
                        <x-table.cell>{{ $waktuTotal['praktikum'] }}</x-table.cell>
                        <x-table.cell>{{ $waktuTotal['mandiri'] }}</x-table.cell>
                        <x-table.cell>{{ $waktuTotal['total'] }}</x-table.cell>
                        <x-table.cell></x-table.cell>
                    </x-table.row>
                    <x-table.row :odd="true" class="font-bold">
                        <x-table.cell colspan="4">Waktu Pembelajaran Standar Nasional untuk 1 SKS
                            (menit)</x-table.cell>
                        <x-table.cell></x-table.cell>
                        <x-table.cell></x-table.cell>
                        <x-table.cell></x-table.cell>
                        <x-table.cell> </x-table.cell>
                        <x-table.cell>{{ $waktuStandarNasional }}</x-table.cell>
                        <x-table.cell></x-table.cell>
                    </x-table.row>
                    <x-table.row :odd="true" class="font-bold">
                        <x-table.cell colspan="4">Satuan Kredit Semester (SKS)</x-table.cell>
                        <x-table.cell></x-table.cell>
                        <x-table.cell></x-table.cell>
                        <x-table.cell></x-table.cell>
                        <x-table.cell></x-table.cell>
                        <x-table.cell>{{ $sks }}</x-table.cell>
                        <x-table.cell></x-table.cell>
                    </x-table.row>
                </x-table.body>
            </x-table.index>

            {{-- Tabel 3 --}}
            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell></x-table.header-cell>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    <x-table.row>
                        <x-table.cell></x-table.cell>
                    </x-table.row>
                </x-table.body>
            </x-table.index>
        </x-container>
    </x-container>
@endsection
