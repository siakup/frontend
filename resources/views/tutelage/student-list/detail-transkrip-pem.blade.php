@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('breadcrumbs')
  <div class="breadcrumb-item">Beranda</div>
  <div class="breadcrumb-item active">Kelompok Perwalian</div>
@endsection

<script type="module">
  import PerwalianKRS from "{{ asset('js/controllers/perwalianKrs.js') }}";
  document.addEventListener('alpine:init', () => {
    Alpine.store('detailPage', { 
      student: @js($student),
      pem: @js($pem)
    });

    Alpine.data('detailTranskripPEM', PerwalianKRS.detailTranskripPEM);
  });
</script>

@section('content')
  <x-container.container
    :variant="'content-wrapper'"
    x-data="detailTranskripPEM()"
  >
    <x-typography variant="body-large-semibold">Detail Kartu Studi Mahasiswa</x-typography>
    <x-container.container :variant="'content-wrapper'" :class="'flex flex-col !gap-0 !px-0'">
      <x-tab 
        :tabItems="[
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-krs',
            'routeQuery' => 'tutelage-group.student-list.detail-krs',
            'title' => 'KRS',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-student-data',
            'routeQuery' => 'tutelage-group.student-list.detail-student-data',
            'title' => 'Data Mahasiswa',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-transkrip-resmi',
            'routeQuery' => 'tutelage-group.student-list.detail-transkrip-resmi',
            'title' => 'Transk. Resmi',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-transkrip-historis',
            'routeQuery' => 'tutelage-group.student-list.detail-transkrip-historis',
            'title' => 'Transk. Historis',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-transkrip-kurikulum',
            'routeQuery' => 'tutelage-group.student-list.detail-transkrip-kurikulum',
            'title' => 'Transk. Kurikulum',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-transkrip-pem',
            'routeQuery' => 'tutelage-group.student-list.detail-transkrip-pem',
            'title' => 'Transk. PEM',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'home',
            'routeQuery' => 'home',
            'title' => 'Pesan untuk Mahasiswa',
            'param' => ['id' => $id]
          ],
        ]"
      />
      <x-container.container :class="'flex flex-col !gap-3'">
        <x-typography variant="body-medium-bold">Transkrip Penilaian Ekstrakulikuler Mahasiswa</x-typography>
        <x-container.container :variant="'content-wrapper'" class="!px-0">
          <x-table.index>
            <x-table.body>
              <x-table.row class="h-[38px]">
                <x-table.cell position="left" class="w-[313px] bg-[#E8E8E8] px-6 py-3">Nomor Induk Mahasiswa</x-table.cell>
                <x-table.cell position="left" class="bg-[#F5F5F5] px-6 py-3 font-semibold" x-text="$store.detailPage.student.nim"></x-table.cell>
              </x-table.row>
              <x-table.row class="h-[38px]">
                <x-table.cell position="left" class="bg-[#F5F5F5] px-6 py-3">Nama Mahasiswa</x-table.cell>
                <x-table.cell position="left" class="bg-white px-6 py-3 font-semibold" x-text="$store.detailPage.student.nama"></x-table.cell>
              </x-table.row>
              <x-table.row class="h-[38px]">
                <x-table.cell position="left" class="bg-[#E8E8E8] px-6 py-3">Program Studi</x-table.cell>
                <x-table.cell position="left" class="bg-[#F5F5F5] px-6 py-3 font-semibold" x-text="$store.detailPage.student.prodi"></x-table.cell>
              </x-table.row>
              <x-table.row class="h-[38px]">
                <x-table.cell position="left" class="bg-[#F5F5F5] px-6 py-3">Tahun Masuk</x-table.cell>
                <x-table.cell position="left" class="bg-white px-6 py-3 font-semibold" x-text="$store.detailPage.student.tahun_masuk"></x-table.cell>
              </x-table.row>
              <x-table.row class="h-[38px]">
                <x-table.cell position="left" class="bg-[#E8E8E8] px-6 py-3">Total PEM</x-table.cell>
                <x-table.cell position="left" class="bg-[#F5F5F5] px-6 py-3 font-semibold" x-text="$store.detailPage.student.total_pem"></x-table.cell>
              </x-table.row>
            </x-table.body>
          </x-table.index>
        </x-container>
        <x-container.container :variant="'content-wrapper'" :class="'!px-0'">
          <x-typography variant="body-medium-bold">
              TOEFL
          </x-typography>
          <x-container.container variant="content-grey" class="flex items-center justify-center">
              <x-typography variant="body-small-bold" class="text-center">
                  Belum Ada Data
              </x-typography>
          </x-container>
        </x-container>
        <template x-for="pemData in $store.detailPage.pem">
          <x-container.container :variant="'content-wrapper'" :class="'!p-6 !px-0'">
            <x-typography variant="body-medium-bold" x-text="'Daftar Keanggotaan '+pemData.organisasi"></x-typography>
            <template x-if="!pemData.kegiatan || pemData.kegiatan.length == 0">
              <x-container.container variant="content-grey" class="flex items-center justify-center">
                <x-typography variant="body-small-bold" class="text-center">
                  Belum Ada Data
                </x-typography>
              </x-container>
            </template>
            <template x-if="pemData.kegiatan && pemData.kegiatan.length > 0">
              <x-table.index class="text-sm text-center">
                <x-table.head>
                  <x-table.row>
                    <x-table.header-cell>Semester</x-table.header-cell>
                    <x-table.header-cell>Nama Kegiatan</x-table.header-cell>
                    <x-table.header-cell>Jabatan</x-table.header-cell>
                    <x-table.header-cell>Status</x-table.header-cell>
                    <x-table.header-cell>Nilai</x-table.header-cell>
                  </x-table.row>
                </x-table.head>
                <x-table.body>
                  <template x-for="kegiatan in pemData.kegiatan">
                    <x-table.row>
                      <x-table.cell x-text="kegiatan.semester"></x-table.cell>
                      <x-table.cell x-text="kegiatan.nama"></x-table.cell>
                      <x-table.cell x-text="kegiatan.jabatan"></x-table.cell>
                      <x-table.cell x-text="kegiatan.status"></x-table.cell>
                      <x-table.cell x-text="kegiatan.nilai ?? '-'"></x-table.cell>
                    </x-table.row>
                  </template>
                </x-table.body>
              </x-table.index>
            </template>
          </x-container>
        </template>
      </x-container>
        <x-container.container :class="'mt-3'">
          <x-button.primary wireClick="printPem" href="javascript:window.print()">
            Cetak
          </x-button.primary>
        </x-container>
    </x-container>
  </x-container>
@endsection
