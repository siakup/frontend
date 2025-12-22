@extends('layouts.main')

@section('title', 'RPS (Rencana Pembelajaran Semester)')

@section('content')
    <div class="flex flex-col gap-4 p-4 w-full h-full">
        <x-typography variant="heading-h6">Buat RPS (Rencana Pembelajaran Semester)</x-typography>
        <x-button.back href="{{ route('rps.submission') }}">RPS (Rencana Pembelajaran Semester)</x-button.back>
        <div class="content-white flex-col gap-5 p-5 rounded-md">
            <div class="flex flex-row gap-2.5">
                <x-typography variant="heading-h5">Submit RPS</x-typography>
                <x-icon :name="'exclamation-mark/black-16'"></x-icon>
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
                        <x-table.cell class="whitespace-pre-line" colspan="2">
                            <br><br><br>
                            {{ $dosen['nama'] }}
                            NIP. {{ $dosen['nip'] }}
                        </x-table.cell>
                        <x-table.cell class="whitespace-pre-line" colspan="3">
                            <br><br><br>
                            {{ $kaprodi['nama'] }}
                            NIP. {{ $kaprodi['nip'] }}
                        </x-table.cell>
                        <x-table.cell class="whitespace-pre-line" colspan="2">
                            <br><br><br>
                            {{ $dekan['nama'] }}
                            NIP. {{ $dekan['nip'] }}
                        </x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell rowspan="7"><b>Capaian Pembelajaran (CP)</b></x-table.cell>
                        <x-table.cell colspan="6"><b>Capaian Pembelajaran Lulusan (CPL)</b></x-table.cell>
                    </x-table.row>
                    @foreach ($cplList as $index => $dataCpl)
                        <x-table.row>
                            <x-table.cell>{{ $dataCpl['kode'] }}</x-table.cell>
                            <x-table.cell colspan="5" position="left">{{ $dataCpl['deskripsi'] }}</x-table.cell>
                        </x-table.row>
                    @endforeach
                    <x-table.row>
                        <x-table.cell colspan="6"><b>Capaian Pembelajaran Mata Kuliah (CPMK)</b></x-table.cell>
                    </x-table.row>
                    @foreach ($cpmkList as $index => $dataCpmk)
                        <x-table.row :odd="$index % 2 === 0">
                            <x-table.cell>{{ $dataCpmk['kode'] }}</x-table.cell>
                            <x-table.cell colspan="5" position="left">{{ $dataCpmk['deskripsi'] }}</x-table.cell>
                        </x-table.row>
                    @endforeach
                    <x-table.row>
                        <x-table.cell> <b>Deksripsi Singkat Mata Kuliah</b> </x-table.cell>
                        <x-table.cell colspan="6" position="left">{{ $deskripsiUmum['deskripsi'] }}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell> <b>Materi Pembelajaran/Pokok Bahasan</b> </x-table.cell>
                        <x-table.cell colspan="6" position="left">{{ $deskripsiUmum['materi'] }}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell> <b>Pustaka</b> </x-table.cell>
                        <x-table.cell colspan="6" position="left"
                            class="whitespace-pre-line">{!! $deskripsiUmum['pustaka'] !!}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell> <b>Metode Pembelajaran</b> </x-table.cell>
                        <x-table.cell colspan="6" position="left"
                            class="whitespace-pre-line">{!! $deskripsiUmum['metode'] !!}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell> <b>Media Pembelajaran</b> </x-table.cell>
                        <x-table.cell colspan="6" position="left"
                            class="whitespace-pre-line">{!! $deskripsiUmum['media'] !!}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell> <b>Tim Pengajaran</b> </x-table.cell>
                        <x-table.cell colspan="6">{{ $deskripsiUmum['pengajar'] }}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell> <b>Mata Kuliah Syarat</b> </x-table.cell>
                        <x-table.cell colspan="6">{{ $deskripsiUmum['mk_syarat'] }}</x-table.cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.cell rowspan="6"> <b>Penilaian</b> </x-table.cell>
                        <x-table.cell colspan="2"><b>Metode</b></x-table.cell>
                        <x-table.cell colspan="2"><b>Bobot (%)</b></x-table.cell>
                        <x-table.cell> <b>CPMK-1 (%)</b> </x-table.cell>
                        <x-table.cell><b>CPMK-2 (%)</b></x-table.cell>
                    </x-table.row>
                    @foreach ($penilaianList['penilaian'] as $index => $penilaian)
                        <x-table.row>
                            <x-table.cell colspan="2">{{ $penilaian['metode'] }}</x-table.cell>
                            <x-table.cell colspan="2">{{ $penilaian['bobot'] }}</x-table.cell>
                            @foreach ($penilaian['cpmk'] as $cpmk)
                                <x-table.cell>
                                    @if ($cpmk)
                                        <x-icon :name="'tick/black-20'" class="mx-auto"></x-icon>
                                    @endif
                                </x-table.cell>
                            @endforeach
                        </x-table.row>
                    @endforeach
                    <x-table.row>
                        <x-table.cell colspan="2"> <b>Total</b> </x-table.cell>
                        <x-table.cell colspan="2"> <b>{{ $penilaianList['total'] }}</b> </x-table.cell>
                        <x-table.cell></x-table.cell>
                        <x-table.cell></x-table.cell>
                    </x-table.row>
                </x-table.body>
            </x-table.index>

            {{-- Tabel 2 --}}
            <x-table.index :isHaveTitle="true" :colorTypeTableTitle="'white-red-gradient'">
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
                    <x-table.row class="font-bold">
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
            <x-table.index :isHaveTitle="true" :colorTypeTableTitle="'white-red-gradient'">
                <x-slot name="tableTitleSlot">
                    <x-typography variant="body-medium-bold">Tabel Matriks Penilaian Kognitif</x-typography>
                </x-slot>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell>Nilai</x-table.header-cell>
                        <x-table.header-cell>Kualitas Jawaban</x-table.header-cell>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    @foreach ($matriksList as $index => $matriks)
                        <x-table.row>
                            <x-table.cell>{{ $matriks['nilai'] }}</x-table.cell>
                            <x-table.cell position="left">{{ $matriks['jawaban'] }}</x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-table.body>
            </x-table.index>

            {{-- Tabel 4 --}}
            <x-table.index :isHaveTitle="true" :colorTypeTableTitle="'white-red-gradient'">
                <x-slot name="tableTitleSlot">
                    <x-typography variant="body-medium-bold">Tabel Evaluasi Pemetaan Konten Perkuliahan dengan Capaian
                        Lulusan</x-typography>
                </x-slot>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell colspan="2" rowspan="2">Capaian Mata Kuliah
                            (CPMK)</x-table.header-cell>
                        <x-table.header-cell colspan="4">{{ $cpl }}</x-table.header-cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.header-cell>Tugas</x-table.header-cell>
                        <x-table.header-cell>Kuis</x-table.header-cell>
                        <x-table.header-cell>UTS</x-table.header-cell>
                        <x-table.header-cell>UAS</x-table.header-cell>
                    </x-table.row>
                </x-table.head>
                <x-table.body>
                    @foreach ($evaluasiList as $eval)
                        <x-table.row>
                            <x-table.cell>{{ $eval['cpmk'] }}</x-table.cell>
                            <x-table.cell position="left">{{ $eval['deskripsi'] }}</x-table.cell>
                            <x-table.cell>
                                @if ($eval['rincian']['tugas'])
                                    <x-icon :name="'tick/black-20'" class="mx-auto"></x-icon>
                                @endif
                            </x-table.cell>
                            <x-table.cell>
                                @if ($eval['rincian']['kuis'])
                                    <x-icon :name="'tick/black-20'" class="mx-auto"></x-icon>
                                @endif
                            </x-table.cell>
                            <x-table.cell>
                                @if ($eval['rincian']['uts'])
                                    <x-icon :name="'tick/black-20'" class="mx-auto"></x-icon>
                                @endif
                            </x-table.cell>
                            <x-table.cell>
                                @if ($eval['rincian']['uas'])
                                    <x-icon :name="'tick/black-20'" class="mx-auto"></x-icon>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-table.body>
            </x-table.index>

            {{-- Tabel Rencana Evaluasi Mahasiswa --}}
            @for ($i = 0; $i < 3; $i++)
                <x-table.index :isHaveTitle="true" :colorTypeTableTitle="'white-red-gradient'">
                    <x-slot name="tableTitleSlot">
                        <x-typography variant="body-medium-bold">Rencana Evaluasi Mahasiswa</x-typography>
                    </x-slot>
                    <x-table.head>
                        <x-table.row>
                            <x-table.header-cell colspan="7">Rencana Pembelajaran Semester</x-table.header-cell>
                        </x-table.row>
                    </x-table.head>
                    <x-table.body>
                        <x-table.row>
                            <x-table.cell> <b>Mata Kuliah</b></x-table.cell>
                            <x-table.cell colspan="6">Termodinamika Teknik Kimia 2</x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell><b>Kode</b></x-table.cell>
                            <x-table.cell colspan="2">23219</x-table.cell>
                            <x-table.cell>Bobot</x-table.cell>
                            <x-table.cell>3</x-table.cell>
                            <x-table.cell>Semester</x-table.cell>
                            <x-table.cell>4</x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell> <b>Dosen Pengampu</b> </x-table.cell>
                            <x-table.cell colspan="6">Eddy Bambang Soewono</x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell> <b>Bentuk Evaluasi</b> </x-table.cell>
                            <x-table.cell colspan="6">Tugas</x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell> <b>Judul Evaluasi</b> </x-table.cell>
                            <x-table.cell colspan="6">Tugas</x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell> <b>Sub-CPMK</b> </x-table.cell>
                            <x-table.cell colspan="6">CPMK 1, CPMK 2</x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell> <b>Deskripsi Evaluasi</b> </x-table.cell>
                            <x-table.cell colspan="6" position="left">Kuis diberikan agar mahasiswa dapat melatih
                                kemampuan
                                penyelesaian
                                masalah secara matematis dan menerapkan konsep sains yang telah dipelajari.</x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell> <b>Metode Pengerjaan Evaluasi</b> </x-table.cell>
                            <x-table.cell colspan="6" position="left">Kuis menggunakan media e-learning</x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell> <b>Bentuk dan Format Luaran</b> </x-table.cell>
                            <x-table.cell colspan="6" position="left">Lembar jawaban tertulis maupun digital pada
                                e-learning</x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell> <b>Indikator, Kriteria Dan Bobot Penilaian</b> </x-table.cell>
                            <x-table.cell colspan="6" position="left">Kemampuan menjawab soal yang diberikan dengan tepat
                                (Bobot 100%)</x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell> <b>Jadwal Pelaksanaan</b> </x-table.cell>
                            <x-table.cell colspan="3">UTS</x-table.cell>
                            <x-table.cell colspan="3">Minggu ke-8</x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell> <b>Lainnya</b> </x-table.cell>
                            <x-table.cell colspan="6" position="left">Bobot penilaian ujian ini adalah 25% dari 100%
                                penilaian mata kuliah ini.</x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell> <b>Daftar Rujukan</b> </x-table.cell>
                            <x-table.cell colspan="6" position="left"></x-table.cell>
                        </x-table.row>
                    </x-table.body>
                </x-table.index>
            @endfor

            <div class="flex justify-end gap-5">
                <x-button.secondary x-on:click="$dispatch('open-modal', {id: 'back-confirmation'})">
                    Batal
                </x-button.secondary>
                <x-button.primary x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})">
                    Simpan RPS
                </x-button.primary>
            </div>
        </div>
    </div>

    <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Submit Sekarang"
        cancelText="Tidak, Kembali" :redirectConfirm="route('rps.index')">
        <p>Apakah Anda yakin untuk submit RPS ini?</p>
    </x-modal.confirmation>
    <x-modal.confirmation id="back-confirmation" title="Tunggu Sebentar" confirmText="Ya, Batalkan" cancelText="Tidak, Kembali"
        :redirectConfirm="route('rps.submission')">
        <p>Apakah Anda yakin ingin membatalkan submit RPS ini?</p>
    </x-modal.confirmation>
@endsection
