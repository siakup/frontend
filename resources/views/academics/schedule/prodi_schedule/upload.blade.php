@extends('layouts.main')

@section('title', 'Upload Jadwal Kuliah Program Studi')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Upload Jadwal Kuliah Program Studi</div>
@endsection

<script type="module">
  import ProdiSchedule from "{{ asset('js/controllers/prodiSchedule.js') }}";
  document.addEventListener('alpine:init', () => {
    Alpine.store('uploadPage', { 
      periode: '',
      program_studi: ''
    });

    Alpine.data('uploadProdiScheduleComponents', ProdiSchedule.uploadProdiScheduleComponents);
  });
</script>

@include('partials.success-notification-modal', ['route' => route('academics.schedule.prodi-schedule.import-fet1')])
@section('content')
  <x-container :variant="'content-wrapper'" x-data="uploadProdiScheduleComponents">
    <x-typography :variant="'body-large-semibold'">Unggah Jadwal Kuliah Program Studi</x-typography>
    <x-button.back :href="route('academics.schedule.prodi-schedule.index')">Jadwal Kuliah Program Studi</x-button.back>
    <x-container :class="'flex flex-col items-start !gap-8 self-stretch'">
      <x-container :variant="'content-wrapper'" class="flex flex-row items-center justify-start !px-0">
        <x-typography :variant="'body-medium-bold'">Impor Pemetaan Jadwal Kuliah</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-auto h-[1.5em]'" />
      </x-container>
      <x-typography :variant="'body-small-italic'" :class="'text-[#E62129]'" x-bind:class="{'hidden': !checkValidity()}">Pilih Program Studi dan Periode terlebih dahulu!</x-typography>
      <x-container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center justify-start !mx-0 !gap-3 max-w-2/3'">
        <x-container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center !gap-2'">
          <x-typography :variant="'body-medium-bold'">Periode</x-typography>
          <x-form.dropdown 
            :buttonId="'sortButtonCampus'"
            :dropdownId="'sortCampus'"
            :label="'Pilih Periode'"
            :imgSrc="asset('assets/active/icon-arrow-down.svg')"
            :isIconCanRotate="true"
            :isUsedForInputField="true"
            :dropdownItem="array_merge(
              ['Pilih Periode' => ''], array_column(array_map(function ($item) {
                $data = [
                  'nama' => $item->tahun . ' - ' . $item->semester,
                  'id' => $item->id
                ];
                return $data;
              }, $periodeList), 'id', 'nama')
            )"
            x-model="$store.uploadPage.periode"
          />
        </x-container>
        <x-container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center !gap-2'">
          <x-typography :variant="'body-medium-bold'">Program Studi</x-typography>
          <x-form.dropdown 
            :buttonId="'sortButtonStudyProgram'"
            :dropdownId="'sortStudyProgram'"
            :label="'Pilih Program Studi'"
            :imgSrc="asset('assets/active/icon-arrow-down.svg')"
            :isIconCanRotate="true"
            :isUsedForInputField="true"
            :dropdownItem="array_merge(['Pilih Program Studi' => ''],array_column($programStudiList, 'id', 'nama'))"
            x-model="$store.uploadPage.program_studi"
          />
        </x-container>
      </x-container>
      <x-container :variant="'content-wrapper'" class="flex-row gap-10 justify-between !px-0" x-bind:class="{'hidden': checkValidity(), 'flex': !checkValidity()}">
          <x-container :variant="'content-wrapper'" class="basis-[35%] shrink-0 grow-0 min-w-1/5 max-w-[35%] flex flex-col !gap-1 !px-0">
            <x-typography>Allowed Type: [.xlsx, .xls, .csv]</x-typography>  
            <x-button.link href="{{ route('academics.schedule.prodi-schedule.template', ['type' => 'xlsx']) }}">Download Sample Data (.xlsx)</x-button.link>
            <x-button.link href="{{ route('academics.schedule.prodi-schedule.template', ['type' => 'csv']) }}">Download Sample Data (.csv)</x-button.link>
          </x-container>
          <x-container :variant="'content-wrapper'" class="grow-1 shrink-1 basis-0 min-w-3/4 flex flex-col !gap-4 relative items-start w-full !px-0">
            <x-typography :variant="'body-medium-regular'">Impor CSV Jadwal Kuliah File</x-typography>
            <form action="{{ route('academics.schedule.prodi-schedule.upload-result') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
              @csrf
              <input type="hidden" x-model="$store.uploadPage.program_perkuliahan" x-bind:value="$store.uploadPage.periode" name="periode">
              <input type="hidden" x-model="$store.uploadPage.program_studi" x-bind:value="$store.uploadPage.program_studi" name="program_studi">
              <x-form.file :cancelConfirmationModalButtonId="'modalKonfirmasiBatal'" />
            </form>
          </x-container>
      </x-container>
      <x-container class="my-0 mx-auto flex-col p-5 !gap-2.5 bg-[#FAFAFA]" x-bind:class="{'hidden': checkValidity(), 'flex': !checkValidity()}">
        <x-typography :variant="'body-small-regular'">
          File yang diterima adalah file .csv dengan pemisah antar kolom berupa titik koma "," atau file .xlsx<br>
          Urutan kolom sebagai berikut:
        </x-typography>
        <ul>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Activity Id</x-typography>
            <x-typography :variant="'body-small-regular'">: ID aktivitas *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Day</x-typography>
            <x-typography :variant="'body-small-regular'">: Hari Pelaksanaan (misal Senin, Selasa, Rabu) *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Hour</x-typography>
            <x-typography :variant="'body-small-regular'">: Jam kegiatan (misal 13:00-13:30)  *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Students Sets</x-typography>
            <x-typography :variant="'body-small-regular'">: Kelas atau kelompok mahasiswa *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Subject</x-typography>
            <x-typography :variant="'body-small-regular'">: Mata kuliah yang diajarkan *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Teachers</x-typography>
            <x-typography :variant="'body-small-regular'">: Nama dosen pengajar *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Activity Tags</x-typography>
            <x-typography :variant="'body-small-regular'">: Tipe aktivitas (misal GP, Lab) *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Room</x-typography>
            <x-typography :variant="'body-small-regular'">: Ruang kelas *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">Comments</x-typography>
            <x-typography :variant="'body-small-regular'">: Catatan tambahan *)</x-typography>
          </li>
          
          <li class="text-[#E62129]">
            <br> 
            <x-typography :variant="'body-small-regular'">*) data perlu diisi, jika tidak diisi salah satu kolom pada baris, data dianggap tidak valid dan data pada baris bersangkutan tidak akan tersimpan</x-typography>
          </li>
        </ul>
         <div class="text-md-rg">
            Activity Id;Day;Hour;Students Sets;Subject;Teachers;Activity Tags;Room;Comments<br>
            1;Rabu;13:00-13:30;GP2+GP2DD;10103#Bahasa Inggris II;Harumi Manik Ayu Yamin;GP;2602;<br>
            1;Rabu;13:30-14:00;GP2+GP2DD;10103#Bahasa Inggris II;Harumi Manik Ayu Yamin;GP;2602;<br>
            1;Rabu;14:00-14:30;GP2+GP2DD;10103#Bahasa Inggris II;Harumi Manik Ayu Yamin;GP;2602;
        </div>
        <div class="text-md-rg">
            <span>Jumlah Data : 0</span><br>
            <span>Jumlah Data Sukses: 0</span><br>
            <span>Jumlah Data Gagal:</span>
        </div>
      </x-container>
    </x-container>
  </x-container>
  <x-modal.container-pure-js id="modalKonfirmasiBatal">
    <x-slot name="header">
      <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
      </x-container>
    </x-slot>
    <x-slot name="body">Apakah Anda yakin ingin membatalkan unggah Jadwal Kuliah?</x-slot>
    <x-slot name="footer">
      <x-button.secondary
        onclick="
          document.getElementById('modalKonfirmasiBatal').classList.add('hidden');
          document.getElementById('modalKonfirmasiBatal').classList.remove('flex');
        "
      >
        Kembali
      </x-button.secondary>
      <x-button.primary :href="route('academics.schedule.prodi-schedule.index')">Batalkan</x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
@endsection
