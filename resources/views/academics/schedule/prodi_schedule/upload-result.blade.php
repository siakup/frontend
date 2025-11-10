@extends('layouts.main')

@section('title', 'Preview Upload File FET')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Preview Upload File FET</div>
@endsection

<script type="module">
  import ProdiSchedule from "{{ asset('js/controllers/prodiSchedule.js') }}";

  document.addEventListener('alpine:init', () => {
    Alpine.data('previewUploadProdiScheduleComponents', ProdiSchedule.previewUploadProdiScheduleComponents);
  });
</script>

@section('content')
<div 
  x-data="previewUploadProdiScheduleComponents(@js($datas))"
>
  <x-container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Unggah FET</x-typography>
    <x-button.back :href="route('academics.schedule.prodi-schedule.import-fet1')">Unggah FET</x-button.back>
    <x-container :class="'flex flex-col items-stretch relative !z-0 gap-4'">
      <x-container :variant="'content-wrapper'" class="flex flex-row items-center !px-0">
        <x-typography :variant="'body-medium-bold'">Impor File FET</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-auto h-[1.5em]'" />
      </x-container>
      <x-table>
        <x-table-head>
          <x-table-row>
            <x-table-header class="cursor-pointer">Semester</x-table-header>
            <x-table-header class="cursor-pointer">Mata Kuliah</x-table-header>
            <x-table-header class="cursor-pointer">Nama Kelas</x-table-header>
            <x-table-header class="cursor-pointer">Kapasitas</x-table-header>
            <x-table-header class="cursor-pointer">Jadwal</x-table-header>
            <x-table-header class="cursor-pointer">Pengajar</x-table-header>
          </x-table-row>
        </x-table-head>
        <x-table-body>
          <template x-if="datas && datas.length > 0">
            <template x-for="data in datas">
              <x-table-row>
                <x-table-cell x-text="data.semester"></x-table-cell>
                <x-table-cell x-text="data.nama_matakuliah_id"></x-table-cell>
                <x-table-cell x-text="data.nama_kelas"></x-table-cell>
                <x-table-cell x-text="data.kapasitas"></x-table-cell>
                <x-table-cell>
                  <ul class="list-disc px-10">
                    <template x-if="data.scheduleList && data.scheduleList.length > 0">
                      <template x-for="schedule in data.scheduleList">
                        <li x-text="schedule.hari+' ('+schedule.jam_mulai+' - '+schedule.jam_selesai+') [Ruang '+schedule.ruangan+']'"></li>
                      </template>
                    </template>
                  </ul>
                </x-table-cell>
                <x-table-cell>
                  <ul class="list-disc px-10">
                    <template x-if="data.lectureList && data.lectureList.length > 0">
                      <template x-for="lecture in data.lectureList">
                        <li x-text="lecture"></li>
                      </template>
                    </template>
                  </ul>
                </x-table-cell>
              </x-table-row>
            </template>
          </template>
          <template x-if="!datas || datas.length == 0">
            <x-table-row>
              <x-table-cell colspan="3" class="text-center py-4">Tidak ada data ditemukan</x-table-cell>
            </x-table-row>
          </template>
        </x-table-body>
      </x-table>
    </x-container>
    <x-container class="flex gap-5 justify-end m-5">
      <x-button.secondary x-on:click="isModalConfirmationOpen = true">Batal</x-button.secondary>
      <x-button.primary x-on:click="sendValidateData">Simpan FET</x-button.primary>
    </x-container>
  </x-container>
  <x-modal.container-pure-js x-bind:class="{'hidden': !isModalConfirmationOpen, 'flex': isModalConfirmationOpen}">
    <x-slot name="header">
      <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Batalkan impor data (csv/xlsx)?</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
      </x-container>
    </x-slot>
    <x-slot name="body">Apakah Anda yakin ingin membatalkan unggah jadwal perkuliahan ini?</x-slot>
    <x-slot name="footer">
      <x-button.secondary x-on:click="isModalConfirmationOpen = false">Kembali</x-button.secondary>
      <x-button.primary :href="route('academics.schedule.prodi-schedule.import-fet1')">Batalkan</x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
</div>
@endsection
