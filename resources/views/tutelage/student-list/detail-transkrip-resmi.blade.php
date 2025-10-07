@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('breadcrumbs')
  <div class="breadcrumb-item">Beranda</div>
  <div class="breadcrumb-item active">Kelompok Perwalian</div>
@endsection


@section('content')
<div class="page-header">
  <div class="page-title-text">Detail Kartu Studi Mahasiswa</div>
</div>

  @include('tutelage.student-list.layout.navbar-tutelage', ["id" => $id])

    <div class="academics-slicing-content content-card p-[10px]">

        <div class="px-6 py-4 font-semibold text-lg">
            Transkrip Nilai Resmi Mahasiswa
        </div>

        <div class="m-4 px-6 py-4 rounded-lg border border-[#D9D9D9] bg-[#FAFAFA] 
            grid grid-cols-4 gap-y-3 text-sm text-[#262626]">

            <div class="font-normal">Nomor Induk Mahasiswa</div>
            <div class="font-bold">{{ $transkrip['nim'] ?? '105221015' }}</div>
            <div class="font-normal">NIP Wali</div>
            <div class="font-bold">{{ $transkrip['nip_wali'] ?? '116130' }}</div>

            <div class="font-normal">Nama Mahasiswa</div>
            <div class="font-bold">{{ $transkrip['nama'] ?? 'Fauzan Akmal Mukhlas' }}</div>
            <div class="font-normal">Dosen Wali</div>
            <div class="font-bold">{{ $transkrip['dosen_wali'] ?? 'Ade Irawan Ph.D' }}</div>

            <div class="font-normal">SKS Tempuh/Lulus</div>
            <div class="font-bold">{{ $transkrip['sks'] ?? '118/118' }}</div>
            <div class="font-normal">Fakultas</div>
            <div class="font-bold">{{ $transkrip['fakultas'] ?? 'Fakultas Sains dan Ilmu Komputer' }}</div>

            <div class="font-normal">Program</div>
            <div class="font-bold">{{ $transkrip['program'] ?? 'Sarjana' }}</div>
            <div class="font-normal">Program Studi</div>
            <div class="font-bold">{{ $transkrip['prodi'] ?? 'Ilmu Komputer' }}</div>
        </div>

 
            <div class="m-4 px-6 py-4 text-sm rounded-lg border border-[#D9D9D9] bg-[#FAFAFA]">
                <div class="flex items-center grid grid-cols-2 gap-y-3">
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-1 text-xs bg-[#FBE8E6] text-[#EB474D] border border-[#EB474D] rounded font-bold">Tidak Lulus</span>
                        <span>: Menunjukkan mata kuliah dengan nilai <span class="font-bold">tidak lulus</span></span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="px-2 py-1 text-xs bg-[#FEF3C0] border border-[#FDD835] rounded font-bold">Lulus</span>
                        <span>: Menunjukkan mata kuliah dengan nilai <span class="font-bold">lulus</span></span>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="font-semibold mb-3">Tahap Sarjana</div>
                <x-table class="text-sm text-center">
                    <x-table-head>
                        <x-table-row>
                            <x-table-header class="w-[50px]">No</x-table-header>
                            <x-table-header class="w-[200px]">Kode Kuliah</x-table-header>
                            <x-table-header class="text-center">Nama Mata Kuliah</x-table-header>
                            <x-table-header class="w-[60px]">SKS</x-table-header>
                            <x-table-header class="w-[80px]">Nilai</x-table-header>
                            <x-table-header class="w-[140px]">Historis Nilai</x-table-header>
                            <x-table-header class="w-[80px]">Konversi</x-table-header>
                            <x-table-header class="w-[100px]">Status</x-table-header>
                        </x-table-row>
                    </x-table-head>

                    <x-table-body>
                        @foreach($transkrip['matkul'] ?? [
                            ['kode'=>'10101','nama'=>'Bahasa Indonesia','sks'=>2,'nilai'=>'A-','histori'=>'2021/Ganjil/A-','konversi'=>'7.40','status'=>'Lulus'],
                            ['kode'=>'10102','nama'=>'Bahasa Inggris I','sks'=>2,'nilai'=>'B-','histori'=>'2021/Ganjil/B-','konversi'=>'5.40','status'=>'Lulus'],
                            ['kode'=>'52102','nama'=>'Berpikir Komputasi','sks'=>2,'nilai'=>'A-','histori'=>'2021/Ganjil/A-','konversi'=>'7.40','status'=>'Lulus'],
                        ] as $i => $row)
                            <x-table-row>
                                <x-table-cell>{{ $i+1 }}</x-table-cell>
                                <x-table-cell>{{ $row['kode'] }}</x-table-cell>
                                <x-table-cell class="text-center">{{ $row['nama'] }}</x-table-cell>
                                <x-table-cell>{{ $row['sks'] }}</x-table-cell>
                                <x-table-cell>{{ $row['nilai'] }}</x-table-cell>
                                <x-table-cell>{{ $row['histori'] }}</x-table-cell>
                                <x-table-cell>{{ $row['konversi'] }}</x-table-cell>
                                <x-table-cell>
                                    @if($row['status']==='Lulus')
                                        <span class="px-2 py-1 text-xs bg-[#FACC15] rounded">Lulus</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-[#E62129] text-white rounded">Tidak Lulus</span>
                                    @endif
                                </x-table-cell>
                            </x-table-row>
                        @endforeach
                    </x-table-body>
                </x-table>
            </div>

            <div class="pt-2 flex justify-end gap-3">
                <button onclick="window.print()" 
                    class="h-9 px-6 rounded bg-[#E62129] text-white font-medium hover:opacity-90">
                    Cetak
                </button>
    
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center justify-center h-9 px-4 rounded-lg border border-[#E62129] text-[#E62129]">
                    Kembali
                </a>
            </div>


        </div>

    </div>
</div>

@endsection
