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
      Transkrip Nilai Sesuai Posisi Kurikulum Mahasiswa
    </div>

    {{-- Info Mahasiswa --}}
    <div class="m-4 px-6 py-4 rounded-lg border border-[#D9D9D9] bg-[#FAFAFA] 
        grid grid-cols-4 gap-y-3 text-sm text-[#262626]">

        <div class="font-normal">Nomor Induk Mahasiswa</div>
        <div class="font-bold">{{ $transkrip['nim']}}</div>
        <div class="font-normal">NIP Wali</div>
        <div class="font-bold">{{ $transkrip['nip_wali']}}</div>

        <div class="font-normal">Nama Mahasiswa</div>
        <div class="font-bold">{{ $transkrip['nama']}}</div>
        <div class="font-normal">Dosen Wali</div>
        <div class="font-bold">{{ $transkrip['dosen_wali']}}</div>

        <div class="font-normal">SKS Tempuh/Lulus</div>
        <div class="font-bold">{{ $transkrip['sks'] }}</div>
        <div class="font-normal">Fakultas</div>
        <div class="font-bold">{{ $transkrip['fakultas'] }}</div>

        <div class="font-normal">Program</div>
        <div class="font-bold">{{ $transkrip['program'] }}</div>
        <div class="font-normal">Program Studi</div>
        <div class="font-bold">{{ $transkrip['prodi']}}</div>

        <div class="font-normal">IPK</div>
        <div class="font-bold">{{ $transkrip['ipk']}}</div>
    </div>

    {{-- Legend --}}
    <div class="m-4 px-6 py-4 text-sm rounded-lg border border-[#D9D9D9] bg-[#FAFAFA]">
      <div class="font-bold mb-3">Keterangan Highlight Status :</div>
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
    @foreach($historis as $semesterData)
      <div class="p-6">
        <div class="font-semibold mb-3">
          Semester {{ $semesterData['semester'] }} ( {{ $semesterData['jenis'] }} Tahun {{ $semesterData['tahun'] }} )
        </div>

        <x-table class="text-sm text-center">
          <x-table-head>
            <x-table-row>
              <x-table-header>No</x-table-header>
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
                <x-table-cell>{{ $row['kode'] }}</x-table-cell>
                <x-table-cell class="text-center">{{ $row['nama'] }}</x-table-cell>
                <x-table-cell>{{ $row['sks'] }}</x-table-cell>
                <x-table-cell>{{ $row['nilai'] }}</x-table-cell>
                <x-table-cell>
                  @if($row['status']==='Lulus')
                      <span class="px-2 py-1 text-xs bg-[#FEF3C0] border border-[#FDD835] rounded font-bold">Lulus</span>
                  @else
                      <span class="px-2 py-1 text-xs bg-[#FBE8E6] text-[#EB474D] border border-[#EB474D] rounded font-bold">Tidak Lulus</span>
                  @endif
                </x-table-cell>
              </x-table-row>
            @endforeach

            {{-- Baris total yang men-span semua kolom --}}
            <x-table-row>
              <x-table-cell colspan="6" class="text-left border-b-0">
                <div class="text-sm">
                  <div>
                    SKS Total = {{ $semesterData['sks_total'] }} 
                  </div>
                  <div>
                    IPS = {{ $semesterData['ips'] }}
                  </div>
                </div>
              </x-table-cell>
            </x-table-row>
          </x-table-body>
        </x-table>

      </div>
    @endforeach

  </div>

  {{-- Tombol --}}
  <div class="m-4 px-6 py-4 text-sm rounded-[12px] bg-white">
    <button onclick="window.print()" 
        class="ml-3 h-12 px-15 rounded-lg bg-[#E62129] text-white font-medium hover:opacity-90">
        Cetak
    </button>
  </div>

  {{-- Pagination --}}
  @include('partials.pagination', [
        'currentPage' => 1,
        'lastPage' => 10,
        'limit' => 3,
        'routes' => '',
    ])
</div>


</div>
@endsection
