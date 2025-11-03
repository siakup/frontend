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
    <x-typography variant="heading-h5" class="px-6 py-3">
      Transkrip Nilai Sesuai Posisi Kurikulum Mahasiswa
    </x-typography>

    
    <div class="px-6 py-2">
      {{-- Info Mahasiswa --}}
      <x-container variant="content-wrapper" class="py-4 rounded-lg border border-[#D9D9D9] bg-[#FAFAFA] 
        grid grid-cols-4 gap-y-3 gap-x-1 ">

        <x-typography variant="body-small-regular">Nomor Induk Mahasiswa</x-typography>
        <x-typography variant="body-small-bold">{{ $transkrip['nim']}}</x-typography>
        <x-typography variant="body-small-regular">NIP Wali</x-typography>
        <x-typography variant="body-small-bold">{{ $transkrip['nip_wali']}}</x-typography>

        <x-typography variant="body-small-regular">Nama Mahasiswa</x-typography>
        <x-typography variant="body-small-bold">{{ $transkrip['nama']}}</x-typography>
        <x-typography variant="body-small-regular">Dosen Wali</x-typography>
        <x-typography variant="body-small-bold">{{ $transkrip['dosen_wali']}}</x-typography>

        <x-typography variant="body-small-regular">SKS Tempuh/Lulus</x-typography>
        <x-typography variant="body-small-bold">{{ $transkrip['sks'] }}</x-typography>
        <x-typography variant="body-small-regular">Fakultas</x-typography>
        <x-typography variant="body-small-bold">{{ $transkrip['fakultas'] }}</x-typography>

        <x-typography variant="body-small-regular">Program</x-typography>
        <x-typography variant="body-small-bold">{{ $transkrip['program'] }}</x-typography>
        <x-typography variant="body-small-regular">Program Studi</x-typography>
        <x-typography variant="body-small-bold">{{ $transkrip['prodi']}}</x-typography>

        <x-typography variant="body-small-regular">IPK</x-typography>
        <x-typography variant="body-small-bold">{{ $transkrip['ipk']}}</x-typography>
      </x-container>

      {{-- Legend --}}
      <x-container variant="content-wrapper" class="mt-4 py-3 rounded-lg border border-[#D9D9D9] bg-[#FAFAFA]">
        <x-typography variant="caption-bold">Keterangan Highlight Status :</x-typography>
        <div class="flex items-center grid grid-cols-2 gap-y-3">
            <div class="flex items-center gap-2">
                <x-badge class="bg-[#FBE8E6] text-[#EB474D] border border-[#EB474D] font-bold">Tidak Lulus</x-badge>
                <x-typography variant="caption-regular">: Menunjukkan mata kuliah dengan nilai <x-typography variant="caption-bold">tidak lulus</x-typography></x-typography>
            </div>
            <div class="flex items-center gap-2">
                <x-badge class="bg-[#FEF3C0] border border-[#FDD835] font-bold">Lulus</x-badge>
                <x-typography variant="caption-regular">: Menunjukkan mata kuliah dengan nilai <x-typography variant="caption-bold">lulus</x-typography></x-typography>
            </div>
        </div>
      </x-container>
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
                      <x-badge class="inline-flex bg-[#FEF3C0] border border-[#FDD835] font-bold">Lulus</x-badge>
                  @else
                      <x-badge class="inline-flex bg-[#FBE8E6] text-[#EB474D] border border-[#EB474D] font-bold">Tidak Lulus</x-badge>
                  @endif
                </x-table-cell>
              </x-table-row>
            @endforeach

            {{-- Baris total yang men-span semua kolom --}}
            <x-table-row>
              <x-table-cell colspan="6" class="text-left border-b-0">
                <div class="flex flex-col space-y-1">
                  <x-typography> SKS Total = {{ $semesterData['sks_total'] }}</x-typography>
                  <x-typography>IPS = {{ $semesterData['ips'] }}</x-typography>
                </div>
              </x-table-cell>
            </x-table-row>
          </x-table-body>
        </x-table>

      </div>
    @endforeach

  </div>

  {{-- Tombol Cetak--}}
  <div class="p-3">
    <x-container variant="content">
      <x-button.primary wireClick="printPem" href="javascript:window.print()">
        Cetak
      </x-button.primary>
    </x-container>
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
