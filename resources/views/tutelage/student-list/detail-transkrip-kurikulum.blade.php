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
      curriculum: @js($curriculum),
      transkrip: @js($transkrip)
    });

    Alpine.data('detailTranskripKurikulum', PerwalianKRS.detailTranskripKurikulum);
  });
</script>

@section('content')
  <x-container.container
    :variant="'content-wrapper'"
    x-data="detailTranskripKurikulum()"
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
      <x-container.container :class="'flex flex-col gap-4 rounded-tl-none items-stretch my-0 border-t-[1] border-t-[#F39194] relative !z-0'">
        <x-typography variant="body-medium-bold">Transkrip Nilai Sesuai Posisi Kurikulum Mahasiswa</x-typography>
        <x-container.container :variant="'content-wrapper'" class="!px-0">
          <x-container.container class="!bg-[#FAFAFA] grid grid-cols-4 !gap-y-3 !gap-x-1 ">
            <x-typography variant="body-small-regular">Nomor Induk Mahasiswa</x-typography>
            <x-typography variant="body-small-bold" x-text="$store.detailPage.transkrip.nim"></x-typography>
            <x-typography variant="body-small-regular">NIP Wali</x-typography>
            <x-typography variant="body-small-bold" x-text="$store.detailPage.transkrip.nip_wali"></x-typography>
            <x-typography variant="body-small-regular">Nama Mahasiswa</x-typography>
            <x-typography variant="body-small-bold" x-text="$store.detailPage.transkrip.nama"></x-typography>
            <x-typography variant="body-small-regular">Dosen Wali</x-typography>
            <x-typography variant="body-small-bold" x-text="$store.detailPage.transkrip.dosen_wali"></x-typography>
            <x-typography variant="body-small-regular">SKS Tempuh/Lulus</x-typography>
            <x-typography variant="body-small-bold" x-text="$store.detailPage.transkrip.sks"></x-typography>
            <x-typography variant="body-small-regular">Fakultas</x-typography>
            <x-typography variant="body-small-bold" x-text="$store.detailPage.transkrip.fakultas"></x-typography>
            <x-typography variant="body-small-regular">Program</x-typography>
            <x-typography variant="body-small-bold" x-text="$store.detailPage.transkrip.program"></x-typography>
            <x-typography variant="body-small-regular">Program Studi</x-typography>
            <x-typography variant="body-small-bold" x-text="$store.detailPage.transkrip.prodi"></x-typography>
            <x-typography variant="body-small-regular">IPK</x-typography>
            <x-typography variant="body-small-bold" x-text="$store.detailPage.transkrip.ipk"></x-typography>
          </x-container>
          <x-container.container variant="content-wrapper" class="mt-4 py-3 rounded-lg border border-[#D9D9D9] bg-[#FAFAFA]">
            <x-typography variant="caption-bold">Keterangan Highlight Status :</x-typography>
            <x-container.container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center justify-between'">
                <x-container.container :variant="'content-wrapper'" class="!px-0 flex flex-row items-center gap-2 w-full">
                    <x-badge class="bg-[#FBE8E6] text-[#EB474D] border border-[#EB474D] font-bold">Tidak Lulus</x-badge>
                    <x-typography variant="caption-regular">: Menunjukkan mata kuliah dengan nilai <x-typography variant="caption-bold">tidak lulus</x-typography></x-typography>
                </x-container>
                <x-container.container :variant="'content-wrapper'" class="!px-0 flex flex-row items-center gap-2 w-full">
                    <x-badge class="bg-[#FEF3C0] border border-[#FDD835] font-bold">Lulus</x-badge>
                    <x-typography variant="caption-regular">: Menunjukkan mata kuliah dengan nilai <x-typography variant="caption-bold">lulus</x-typography></x-typography>
                </x-container>
            </x-container>
          </x-container>
        </x-container>
        <template x-for="semesterData in $store.detailPage.curriculum">
          <x-container.container :variant="'content-wrapper'" class="!p-0 !pt-3">
            <x-typography variant="body-medium-bold" x-text="'Semester '+semesterData.semester+' ('+semesterData.jenis+' Tahun '+semesterData.tahun+') '"></x-typography>
            <x-table.index class="text-sm text-center">
              <x-table.head>
                <x-table.row>
                  <x-table.header-cell>No</x-table.header-cell>
                  <x-table.header-cell>Kode Kuliah</x-table.header-cell>
                  <x-table.header-cell>Nama Mata Kuliah</x-table.header-cell>
                  <x-table.header-cell>SKS</x-table.header-cell>
                  <x-table.header-cell>Nilai</x-table.header-cell>
                  <x-table.header-cell>Status</x-table.header-cell>
                </x-table.row>
              </x-table.head>
              <x-table.body>
                <template x-for="(matkul, index) in semesterData.matkul">
                  <x-table.row>
                    <x-table.cell x-text="index+1"></x-table.cell>
                    <x-table.cell x-text="matkul.kode"></x-table.cell>
                    <x-table.cell x-text="matkul.nama" class="text-center"></x-table.cell>
                    <x-table.cell x-text="matkul.sks"></x-table.cell>
                    <x-table.cell x-text="matkul.nilai"></x-table.cell>
                    <x-table.cell>
                      <x-badge 
                        class="inline-flex bg-[#FEF3C0] border border-[#FDD835] font-bold" 
                        x-bind:class="{
                          'bg-[#FEF3C0]': matkul.status == 'Lulus',
                          'border-[#FDD835]': matkul.status == 'Lulus',
                          'bg-[#FBE8E6]': matkul.status !== 'Lulus',
                          'text-[#EB374D]': matkul.status !== 'Lulus',
                          'border-[#EB474D]': matkul.status !== 'Lulus'
                        }"
                        x-text="matkul.status"
                      ></x-badge>
                    </x-table.cell>
                  </x-table.row>
                </template>
                <x-table.row>
                  <x-table.cell colspan="6" class="text-left border-b-0">
                    <x-container.container class="flex flex-col space-y-1">
                      <x-typography x-text="'SKS Total = '+semesterData.sks_total"></x-typography>
                      <x-typography x-text="'IPS = '+semesterData.ips"></x-typography>
                    </x-container>
                  </x-table.cell>
                </x-table.row>
              </x-table.body>
            </x-table.index>
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
