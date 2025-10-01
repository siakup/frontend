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

<div class="academics-layout">
  @include('tutelage.student-list.layout.navbar-tutelage', ["id" => $id])

  <div class="academics-slicing-content content-card p-[10px]">

    {{-- Header --}}
    <div class="px-6 py-4 font-semibold text-lg">
      Transkrip Nilai Historis Mahasiswa
    </div>

    {{-- Info Mahasiswa --}}
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

        <div class="font-normal">IPK</div>
        <div class="font-bold">{{ $transkrip['ipk'] ?? '3.17' }}</div>
    </div>

    {{-- Legend --}}
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

    {{-- Loop per semester --}}
    @foreach($historis ?? [
        [
            'tahun' => 2021,
            'semester' => 'Ganjil',
            'matkul' => [
                ['kode'=>'10101','nama'=>'Bahasa Indonesia','sks'=>2,'nilai'=>'A-','status'=>'Lulus'],
                ['kode'=>'10102','nama'=>'Bahasa Inggris I','sks'=>2,'nilai'=>'B-','status'=>'Lulus'],
                ['kode'=>'52101','nama'=>'Kalkulus I','sks'=>4,'nilai'=>'C+','status'=>'Lulus'],
            ],
            'sks_total' => 18,
            'ips' => 3.12,
        ],
        [
            'tahun' => 2021,
            'semester' => 'Genap',
            'matkul' => [
                ['kode'=>'10103','nama'=>'Bahasa Inggris II','sks'=>2,'nilai'=>'A-','status'=>'Lulus'],
                ['kode'=>'10105','nama'=>'Metode Kreatif Penyelesaian Masalah','sks'=>1,'nilai'=>'B+','status'=>'Lulus'],
                ['kode'=>'52105','nama'=>'Kalkulus II','sks'=>3,'nilai'=>'C+','status'=>'Lulus'],
            ],
            'sks_total' => 15,
            'ips' => 3.00,
        ]
    ] as $semesterData)
      <div class="p-6">
        <div class="font-semibold mb-3">
          Semester {{ $semesterData['semester'] }} Tahun {{ $semesterData['tahun'] }}
        </div>

        <x-table class="text-sm text-center">
          <x-table-head>
            <x-table-row>
              <x-table-header>No</x-table-header>
              <x-table-header>Tahun</x-table-header>
              <x-table-header>Semester</x-table-header>
              <x-table-header>Semester Kurikulum</x-table-header>
              <x-table-header>Kode Kuliah</x-table-header>
              <x-table-header>Nama Mata Kuliah</x-table-header>
              <x-table-header>SKS</x-table-header>
              <x-table-header>Nilai</x-table-header>
              <x-table-header>Status</x-table-header>
            </x-table-row>
          </x-table-head>

          <x-table-body>
            @foreach($semesterData['matkul'] as $i => $row)
              <x-table-row>
                <x-table-cell>{{ $i+1 }}</x-table-cell>
                <x-table-cell>{{ $semesterData['tahun'] }}</x-table-cell>
                <x-table-cell>{{ $semesterData['semester'] }}</x-table-cell>
                <x-table-cell>1</x-table-cell>
                <x-table-cell>{{ $row['kode'] }}</x-table-cell>
                <x-table-cell class="text-center">{{ $row['nama'] }}</x-table-cell>
                <x-table-cell>{{ $row['sks'] }}</x-table-cell>
                <x-table-cell>{{ $row['nilai'] }}</x-table-cell>
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

        <div class="mt-2 text-sm">
          <div>SKS Total = {{ $semesterData['sks_total'] }}</div>
          <div>IPS = {{ $semesterData['ips'] }}</div>
        </div>
      </div>
    @endforeach

    {{-- Tombol --}}
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

  @include('partials.pagination', [
        'currentPage' => 1,
        'lastPage' => 10,
        'limit' => 3,
        'routes' => '',
    ])
    {{-- @if (isset($data['data']))
    @endif --}}

</div>


</div>
@endsection
