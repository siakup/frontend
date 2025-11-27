@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('breadcrumbs')
  <div class="breadcrumb-item">Beranda</div>
  <div class="breadcrumb-item active">Kelompok Perwalian</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="module">
  document.addEventListener('alpine:init', () => {
    Alpine.store('detailPage', { 
      data: @js($data)
    });

    Alpine.data('detailStudentData', window.PerwalianKRSController.detailStudentData);
  });
</script>

@section('content')
<x-container
  :variant="'content-wrapper'"
  x-data="detailStudentData()"
>
  <x-typography variant="body-large-semibold">Detail Kartu Studi Mahasiswa</x-typography>
  <x-container :variant="'content-wrapper'" :class="'flex flex-col !gap-0 !px-0'">
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
      <x-container :class="'flex flex-col gap-4 rounded-tl-none items-stretch my-0 border-t-[1] border-t-[#F39194] relative !z-0'">
          <x-container :variant="'content-wrapper'" class="!px-0 space-y-4">
            <x-accordion :label="'Data Pribadi'" :isDefaultOpen="true">
              <x-table.index :isRoundedTop="false">
                <x-table.body>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Nama Mahasiswa</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.student.nama">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Nomor Induk Mahasiswa</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.student.nim"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Judul Tugas Akhir</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.judul_ta || '-'">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Nomor Induk Kependudukan</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.nik"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Kota Lahir</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.kota_lahir">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Tanggal Lahir</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.tanggal_lahir"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Agama</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.agama">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Jenis Kelamin</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.jenis_kelamin"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Kewarganegaraan</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.kewarganegaraan">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Alamat Asal</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.alamat_asal"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">RT</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.rt">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">RW</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.rw"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Dusun</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.dusun">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Kelurahan</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.kelurahan"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Kecamatan</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.kecamatan">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Kota Kabupaten</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.kota"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Provinsi</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.provinsi">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Kode Pos</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.kode_pos"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Jenis Tinggal</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.jenis_tinggal">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Jenis Tinggal Lainnya</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.jenis_tinggal_lain"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Alat Transportasi</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.transport">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Alat Transportasi Lainnya (Isi Jika Pilih Lainnya</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.transport_lain"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Alamat Domisili</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.alamat_domisili">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Nomor Telepon Rumah</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.telp_rumah"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Nomor Telepon Seluler</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.telp_seluler">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Nomor Telepon Darurat</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.telp_darurat"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Email</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.email">Cell 1</x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Nomor KPS (Jika Ya)</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.no_kps"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Kebutuhan Khusus</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.kebutuhan_khusus"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Nama Ibu Kandung</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.nama"></x-table.cell>
                  </x-table.row>
                </x-table.body>
              </x-table.index>
            </x-accordion>
            
            <x-accordion :label="'Data Orang Tua'">
              <x-table.index :isRoundedTop="false">
                <x-table.body>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Nama Ayah</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ayah.nik"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Nomor Induk Kependudukan Ayah</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ayah.nik"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Tanggal Lahir Ayah</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ayah.tanggal_lahir"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Riwayat Pendidikan Ayah</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ayah.pendidikan"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Tanggal Lahir Ayah</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ayah.tanggal_lahir"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Pendidikan Ayah Lainnya (Isi Jika Pilih Lainnya)</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ayah.pendidikan_lain || '-'"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Pekerjaan Ayah</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ayah.pekerjaan"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Pekerjaan Ayah Lainnya (Isi Jika Pilih Lainnya)</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ayah.pekerjaan_lain || '-'"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Penghasilan Ayah</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ayah.penghasilan"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Nama Ibu</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.nama"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Nomor Induk Kependudukan Ibu</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.nik"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Tanggal Lahir Ibu</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.tanggal_lahir"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Riwayat Pendidikan Ibu</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.pendidikan"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Tanggal Lahir Ibu</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.tanggal_lahir"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Pendidikan Ibu Lainnya (Isi Jika Pilih Lainnya)</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.pendidikan_lain || '-'"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Pekerjaan Ibu</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.pekerjaan"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Pekerjaan Ibu Lainnya (Isi Jika Pilih Lainnya)</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.pekerjaan_lain || '-'"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Penghasilan Ibu</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.penghasilan"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Jumlah Tanggungan Orang Tua</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.jumlah_tanggungan"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Alamat Orang Tua</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.alamat_orang_tua"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Alamat Alternatif Orang Tua</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.alamat_alternatif_orang_tua"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Nomor HP Orang Tua</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.no_hp_orang_tua"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Kecamatan Orang Tua</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.kecamatan_orang_tua"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Kota Orang Tua</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.kota_orang_tua"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'odd'" :position="'left'">Provinsi Orang Tua</x-table.header-cell>
                      <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.provinsi_orang_tua"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                      <x-table.header-cell :variantColor="'even'" :position="'left'">Email Orang Tua</x-table.header-cell>
                      <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.orang_tua.ibu.email_orang_tua"></x-table.cell>
                  </x-table.row>
                </x-table.body>
              </x-table.index>
            </x-accordion>

            <x-accordion :label="'Data SMTA'">
              <x-table.index :isRoundedTop="false">
                <x-table.body>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Nomor Induk Siswa Nasional</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.data_sma.nisn"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'even'" :position="'left'">Tahun Lulus</x-table.header-cell>
                    <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.data_sma.tahun_lulus"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Asal Sekolah</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.data_sma.asal"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'even'" :position="'left'">Provinsi Sekolah</x-table.header-cell>
                    <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.data_sma.provinsi"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Kota Sekolah</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.data_sma.kota"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'even'" :position="'left'">Kecamatan Sekolah</x-table.header-cell>
                    <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.data_sma.kecamatan"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Jenis Sekolah</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.data_sma.jenis"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'even'" :position="'left'">Jurusan Sekolah</x-table.header-cell>
                    <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.data_sma.jurusan"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Nomor Ijazah</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.data_sma.no_ijazah"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'even'" :position="'left'">Nilai UAN Matematika</x-table.header-cell>
                    <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.data_sma.uan_mtk"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Nilai UAN Bahasa Inggris</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.data_sma.uan_inggris"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'even'" :position="'left'">Nilai UAN Fisika</x-table.header-cell>
                    <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.data_sma.uan_fisika"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Nilai Rapor Matematika</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.data_sma.rapor_mtk"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'even'" :position="'left'">Nilai Rapor Bahasa Inggris</x-table.header-cell>
                    <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.data_sma.rapor_inggris"></x-table.cell>
                  </x-table.row>
                </x-table.body>
              </x-table.index>
            </x-accordion>

            <x-accordion :label="'Data Kesehatan'">
              <x-table.index :isRoundedTop="false">
                <x-table.body>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Keterangan Bebas Buta Warna</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.health.buta_warna ? 'Ya' : 'Tidak'"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'even'" :position="'left'">Keterangan Napza</x-table.header-cell>
                    <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.health.napza ? 'Ya' : 'Tidak'"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Riwayat Kesehatan Pribadi</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.health.riwayat_pribadi ? 'Ya' : 'Tidak'"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'even'" :position="'left'">Riwayat Kesehatan Keluarga</x-table.header-cell>
                    <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.health.riwayat_keluarga ? 'Ya' : 'Tidak'"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'">Pernyataan Kesehatan</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.health.pernyataan_kesehatan || '-'"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'even'" :position="'left'">Pernyataan Napza</x-table.header-cell>
                    <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.health.pernyataan_napza ? 'Ya' : 'Tidak'"></x-table.cell>
                  </x-table.row>
                </x-table.body>
              </x-table.index>
            </x-accordion>

            <x-accordion :label="'Dokumen Pendukung'">
              <x-table.index :isRoundedTop="false">
                <x-table.body>
                  <template x-for="([label, key], i) in Object.entries(docs)">
                    <template x-if="i % 2 != 0">
                      <x-table.row>
                        <x-table.header-cell :variantColor="'odd'" x-text="label"></x-table.header-cell>
                        <x-table.cell :variantColor="'odd'">
                          <template x-if="loadingKey === key">
                            <span class="text-gray-500">Memuat…</span>
                          </template>
                          <template x-if="loadingKey !== key">
                            <a href="#"
                              x-on:click.prevent="openDoc(key, $store.detailPage.data.nim)"
                              class="underline text-[#1D4ED8] hover:opacity-80"
                            >
                              Dokumen
                            </a>
                          </template>
                        </x-table.cell>
                      </x-table.row>
                    </template>
                    <template x-if="i % 2 == 0">
                      <x-table.row>
                        <x-table.header-cell :variantColor="'even'" x-text="label"></x-table.header-cell>
                        <x-table.cell :variantColor="'even'">
                          <template x-if="loadingKey === key">
                            <span class="text-gray-500">Memuat…</span>
                          </template>
                          <template x-if="loadingKey !== key">
                            <a href="#"
                              x-on:click.prevent="openDoc(key, $store.detailPage.data.nim)"
                              class="underline text-[#1D4ED8] hover:opacity-80"
                            >
                              Dokumen
                            </a>
                          </template>
                        </x-table.cell>
                      </x-table.row>
                    </template>
                  </template>
                </x-table.body>
              </x-table.index>
            </x-accordion>

            <x-accordion :label="'Status Administrasi Akademik'">
              <x-table.index :isRoundedTop="false">
                <x-table.body>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'odd'" :position="'left'" >Status Administrasi</x-table.header-cell>
                    <x-table.cell :variantColor="'odd'" :position="'left'" x-text="$store.detailPage.data.statusAdministrasi.administrasi"></x-table.cell>
                  </x-table.row>
                  <x-table.row>
                    <x-table.header-cell :variantColor="'even'" :position="'left'">Status Akademik</x-table.header-cell>
                    <x-table.cell :variantColor="'even'" :position="'left'" x-text="$store.detailPage.data.statusAdministrasi.akademik == 'active' ? 'Aktif' : 'Tidak Aktif'"></x-table.cell>
                  </x-table.row>
                </x-table.body>
              </x-table.index>
            </x-accordion>

            <x-accordion :label="'Statistik IPK Mahasiswa'" x-on:click="initChart()">
              <x-container :variant="'content-wrapper'" :class="'!p-5'">
                <x-typography :variant="'body-medium-bold'" class="w-full text-center">Statistik IPK dan IPS Mahasiswa</x-typography>
                <x-container :variant="'content-wrapper'" class="!px-0 !h-[400px]">
                    <canvas class="w-full h-full"></canvas>
                </x-container>
                <x-container :variant="'content-wrapper'" class="!flex-row justify-end gap-3">
                  <x-button :variant="'primary'" x-on:click="printChart()">Cetak Grafik</x-button.secondary>
                  <x-button :variant="'primary'" x-on:click="downloadChart()">Unduk Grafik</x-button.secondary>
                </x-container>
              </x-container>
            </x-accordion>

            <x-accordion :label="'Catatan Akademis Mahasiswa'">
              <x-table.index :isRoundedTop="false" :isRoundedBottom="false">
                <x-table.head>
                  <x-table.row>
                      <x-table.header-cell>Tahun / Term</x-table.header-cell>
                      <x-table.header-cell>IPS</x-table.header-cell>
                      <x-table.header-cell>IPK</x-table.header-cell>
                      <x-table.header-cell>SKS Diambil</x-table.header-cell>
                      <x-table.header-cell>SKS Diperoleh</x-table.header-cell>
                      <x-table.header-cell>Opsi</x-table.header-cell>
                  </x-table.row>
                </x-table.head>
                <x-table.body>
                  <template x-if="$store.detailPage.data.catatanAkademik && $store.detailPage.data.catatanAkademik.length > 0">
                    <template x-for="catatanAkademik in $store.detailPage.data.catatanAkademik">
                      <x-table.row>
                        <x-table.cell x-text="catatanAkademik.year+'/'+catatanAkademik.semester"></x-table.cell>
                        <x-table.cell x-text="catatanAkademik.ips"></x-table.cell>
                        <x-table.cell x-text="catatanAkademik.ipk"></x-table.cell>
                        <x-table.cell x-text="catatanAkademik.sks_diambil+' SKS'"></x-table.cell>
                        <x-table.cell x-text="catatanAkademik.sks_diperoleh+' SKS'"></x-table.cell>
                        <x-table.cell>
                          <x-button
                            :variant="'text-link'"
                            class="underline !text-blue-500"
                            x-on:click="isModalOpen = true; selectedId = catatanAkademik.id"
                            :icon="'search/blue-16'"
                          >
                            Detail Akademis
                          </x-button>
                        </x-table.cell>
                      </x-table.row>
                    </template>
                  </template>
                  <template x-if="!$store.detailPage.data.catatanAkademik && $store.detailPage.data.catatanAkademik.length == 0">
                    <x-table.row>
                      <x-table.cell colspan="6" class="text-center text-gray-500">
                        Belum Ada Data
                      </x-table.cell>
                    </x-table.row>
                  </template>
                </x-table.body>
              </x-table.index>
            </x-accordion>
            <x-button
              :variant="'secondary'" 
              :href="url()->previous()"
              :class="'self-end'"
            >
              Kembali
            </x-button>
          </x-container>
          <x-modal.container-pure-js x-bind:class="{'hidden': !isModalOpen, 'flex': isModalOpen}">
            <x-slot name="header">
              <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
                <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Detail Akademis</x-typography>
                <x-button.base
                  x-on:click="isModalOpen = false; selectedId = null"
                  :class="'scale-150'"
                >
                    &times;
                </x-button.base>
              </x-container>
            </x-slot>
            <x-slot name="body">
              <x-table.index>
                <x-table.head>
                  <x-table.row>
                    <x-table.header-cell>Nama Mata Kuliah</x-table.header-cell>
                    <x-table.header-cell>Nama Kelas</x-table.header-cell>
                    <x-table.header-cell>Nilai</x-table.header-cell>
                  </x-table.row>
                </x-table.head>
                <x-table.body>
                  <template x-if="
                    $store.detailPage.data.catatanAkademik.some(value => value.id == selectedId) && 
                    ($store.detailPage.data.catatanAkademik.find(value => value.id == selectedId)?.mataKuliah.length > 0)
                  ">
                    <template x-for="mataKuliah in $store.detailPage.data.catatanAkademik.find((value) => value.id == selectedId).mataKuliah">
                      <x-table.row>
                        <x-table.cell x-text="mataKuliah.nama"></x-table.cell>
                        <x-table.cell x-text="mataKuliah.nama_kelas"></x-table.cell>
                        <x-table.cell x-text="mataKuliah.nilai"></x-table.cell>
                      </x-table.row>
                    </template>
                  </template>
                  <template x-if="
                    !$store.detailPage.data.catatanAkademik.some(v => v.id == selectedId) ||
                    !$store.detailPage.data.catatanAkademik.find(v => v.id == selectedId)?.mataKuliah ||
                    $store.detailPage.data.catatanAkademik.find(v => v.id == selectedId)?.mataKuliah.length == 0
                  ">
                    <x-table.row>
                      <x-table.cell colspan="6" class="text-center text-gray-500">
                        Belum Ada Data
                      </x-table.cell>
                    </x-table.row>
                  </template>
                </x-table.body>
              </x-table.index>
            </x-slot>
            <x-slot name="footer">
              <x-button :variant="'secondary'" x-on:click="isModalOpen = false; selectedId = null">Kembali</x-button>
            </x-slot>
          </x-modal.container-pure-js>
      </x-container>
  </x-container>
</x-container>
@endsection
