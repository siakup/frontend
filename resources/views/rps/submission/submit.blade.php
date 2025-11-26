@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Semester)')

@section('content')
    <x-container variant="content-wrapper" class="!gap-2">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Semester)</x-typography>
        <x-button.back class="ml-2" href="{{ route('rps.submission') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>
        <x-container class="flex flex-col gap-3 mb-5">
            <div class="flex flex-row gap-3">
                <x-typography variant="heading-h5">Submit RPS</x-typography>
                <x-icon name="exclamation-mark/black-24"></x-icon>
            </div>

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
                        <x-table.cell>{{ $infoRps['mata_kuliah'] }}</x-table.cell>
                        <x-table.cell>{{ $infoRps['kode'] }}</x-table.cell>
                        <x-table.cell>{{ $infoRps['bobot'] }}</x-table.cell>
                        <x-table.cell>{{ $infoRps['semester'] }}</x-table.cell>
                        <x-table.cell>{{ $infoRps['rumpun_mk'] }}</x-table.cell>
                        <x-table.cell>{{ $infoRps['level_program'] }}</x-table.cell>
                        <x-table.cell>{{ $infoRps['tgl_penyusunan'] }}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell colspan="2" class="whitespace-pre-line">
                            <br><br><br>
                            {{ $dosen['nama'] }}
                            NIP. {{ $dosen['nip'] }}
                        </x-table.cell>
                        <x-table.cell colspan="3" class="whitespace-pre-line">
                            <br><br><br>
                            {{ $kaprodi['nama'] }}
                            NIP. {{ $kaprodi['nip'] }}
                        </x-table.cell>
                        <x-table.cell colspan="2" class="whitespace-pre-line">
                            <br><br><br>
                            {{ $dekan['nama'] }}
                            NIP. {{ $dekan['nip'] }}
                        </x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell rowspan="7"><b>Capaian Pembelajaran (CP)</b></x-table.cell>
                        <x-table.cell colspan="6"><b>Capaian Pembelajaran Lulusan (CPL)</b></x-table.cell>
                    </x-table.row>
                    @foreach ($cplList as $i => $cpl)
                        <x-table.row :odd="$i % 2 === 0" :last="$loop->last">
                            <x-table.cell colspan="1">{{ $cpl['kode'] }}</x-table.cell>
                            <x-table.cell colspan="5" position="left" class="whitespace-normal break-word max-w-0">
                                {{ $cpl['deskripsi'] }}
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                    <x-table.row>
                        <x-table.cell colspan="6"><b>Capaian Pembelajaran Mata Kuliah (CPMK)</b></x-table.cell>
                    </x-table.row>
                    @foreach ($cpmkList as $i => $cpmk)
                        <x-table.row :odd="$i % 2 === 0" :last="$loop->last">
                            <x-table.cell colspan="1">{{ $cpmk['kode'] }}</x-table.cell>
                            <x-table.cell colspan="5" position="left" class="max-w-0">
                                {{ $cpmk['deskripsi'] }}
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                    <x-table.row>
                        <x-table.cell class="max-w-0"><b>Deskripsi Singkat Mata Kuliah</b></x-table.cell>
                        <x-table.cell colspan="6" position="left"
                            class="max-w-0">{{ $deskripsiUmum['deskripsi'] }}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell class="max-w-0"><b>Materi Pembelajaran/Pokok Bahasan</b></x-table.cell>
                        <x-table.cell colspan="6" position="left"
                            class="max-w-0">{{ $deskripsiUmum['materi'] }}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell><b>Pustaka</b></x-table.cell>
                        <x-table.cell colspan="6" position="left"
                            class="max-w-0">{!! $deskripsiUmum['pustaka'] !!}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell><b>Metode Pembelajaran</b></x-table.cell>
                        <x-table.cell colspan="6" position="left"
                            class="max-w-0">{{ $deskripsiUmum['metode'] }}</x-table.cell>
                    </x-table.row>
                </x-table.body>
            </x-table.index>
        </x-container>
    </x-container>
@endsection
