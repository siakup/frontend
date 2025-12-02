@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('breadcrumbs')
    <div class="breadcrumb-item">Beranda</div>
    <div class="breadcrumb-item">Kelompok Perwalian</div>
    <div class="breadcrumb-item">Detail Kartu Mahasiswa</div>
    <div class="breadcrumb-item active">Tambah Kelas Mata Kuliah</div>
@endsection

@section('content')
    <x-container.container variant="content-wrapper">
        <x-typography variant="heading-h6">
            Tambah Kelas Mata Kuliah
        </x-typography>

        <x-button.back href="{{ route('tutelage-group.student-list.detail-krs', ['id' => $id]) }}">
            Detail Kartu Mahasiswa
        </x-button.back>

        <x-container.container class="flex flex-col gap-5">
            <div class="grid grid-cols-10 items-center gap-5">
                {{-- Program Studi --}}
                <x-typography variant="body-small-semibold" class="col-span-2">Pilih Program Studi</x-typography>
                <x-form.input
                    type="select"
                    name="program_studi"
                    class="col-span-8"
                    :options="$programStudis"
                />

                {{-- Semester --}}
                <x-typography variant="body-small-semibold" class="col-span-2">Pilih Semester</x-typography>
                <x-form.input
                    type="select"
                    name="semester"
                    class="col-span-8"
                    :options="$semesters"
                />

                {{-- Cari Mata Kuliah --}}
                <x-typography variant="body-small-semibold" class="col-span-2">Cari Mata Kuliah</x-typography>
                <x-form.input class="col-span-7" type="text" placeholder="Cari mata kuliah"/>
                <x-button.primary class="col-span-1 w-full" style="min-width: 0;">Cari</x-button.primary>
            </div>

            {{-- Table --}}
            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell>Semester</x-table.header-cell>
                        <x-table.header-cell>Nama Mata Kuliah</x-table.header-cell>
                        <x-table.header-cell>Nama Kelas</x-table.header-cell>
                        <x-table.header-cell>SKS</x-table.header-cell>
                        <x-table.header-cell>Peserta / Kapasitas</x-table.header-cell>
                        <x-table.header-cell>Jadwal</x-table.header-cell>
                        <x-table.header-cell>Pengajar</x-table.header-cell>
                        <x-table.header-cell></x-table.header-cell>
                    </x-table.row>
                </x-table.head>

                <x-table.body>
                    @foreach ($courses as $course)
                        <x-table.row>
                            <x-table.cell>{{ $course['semester'] }}</x-table.cell>
                            <x-table.cell>{{ $course['nama'] }}</x-table.cell>
                            <x-table.cell>{{ $course['kelas'] }}</x-table.cell>
                            <x-table.cell>{{ $course['sks'] }}</x-table.cell>
                            <x-table.cell>{{ $course['peserta'] }} / {{ $course['kapasitas'] }}</x-table.cell>
                            <x-table.cell class="text-left">
                                <ul class="list-disc list-inside">
                                    @foreach ($course['jadwal'] as $jadwal)
                                        <li>{{ $jadwal }}</li>
                                    @endforeach
                                </ul>
                            </x-table.cell>

                            <x-table.cell class="text-left">
                                <ul class="list-disc list-inside">
                                    @foreach ($course['pengajar'] as $pengajar)
                                        <li>{{ $pengajar }}</li>
                                    @endforeach
                                </ul>
                            </x-table.cell>

                            <x-table.cell>
                                <input type="checkbox" />
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-table.body>
            </x-table.index>

            <div class="box-border border rounded-xl border-[#D9D9D9] overflow-clip">
                <x-full-calendar :events="$events" />
            </div>

            <div class="flex gap-5 justify-end">
                <x-button.secondary href="{{route('tutelage-group.list-student')}}">Batal</x-button.secondary>
                <x-button.primary href="">Tambahkan Kelas</x-button.primary>
            </div>
        </x-container>

    </x-container>
@endsection
