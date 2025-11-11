@extends('layouts.main')

@section('title', 'Tambah Jadwal Kuliah Program Studi')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kurikulum</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
@endsection

<script src="{{ asset('js/plugins/flatpckr.js') }}"></script>
<script src="{{ asset('js/plugins/flatpckr-id.js') }}"></script>
<script src="{{ asset('js/component-helpers/api.js')}}"></script>
<script src="{{ asset('js/properties/calendar.js')}}"></script>
<script type="module">
  import ProdiSchedule from "{{ asset('js/controllers/prodiSchedule.js') }}";

  document.addEventListener('alpine:init', () => {
    Alpine.store('editPage', {
      program_perkuliahan: @js($data->program_perkuliahan),
      program_studi: @js($data->program_studi),
      periode: @js($data->periode),
      course: @js($data->course),
      nama_kelas: @js($data->nama_kelas),
      nama_singkat: @js($data->nama_singkat),
      kapasitas_peserta: @js($data->kapasitas_peserta),
      kelas_mbkm: @js($data->kelas_mbkm),
      tanggal_mulai: @js($data->tanggal_mulai),
      tanggal_akhir: @js($data->tanggal_akhir),
      scheduleList: @js($data->scheduleList),
      lectureList: @js($data->lectureList),
    });

    Alpine.data('editProdiScheduleComponents', ProdiSchedule.editProdiScheduleComponents);
    Alpine.data('lectureViewComponents', ProdiSchedule.lectureViewComponents);
    Alpine.data('courseViewComponents', ProdiSchedule.courseViewComponents);
    Alpine.data('createScheduleListComponents', ProdiSchedule.createScheduleListComponents);
  });
</script>

@section('content')
  <x-container 
    :variant="'content-wrapper'" 
    x-data='editProdiScheduleComponents()'
  >
    <x-typography :variant="'body-large-semibold'">Ubah Jadwal Program Studi</x-typography>
    <x-button.back :href="route('academics.schedule.prodi-schedule.index')">Jadwal Kuliah Program Studi</x-button.back>
    <x-container>
      <x-typography :variant="'body-medium-bold'">Informasi Kelas</x-typography>
      <x-container :variant="'content-wrapper'" class="flex flex-col gap-4 !p-0">
        <x-container :variant="'content-wrapper'" class="flex flex-row justify-between !px-0">
            <x-form.input-container :class="'min-w-[170px]'">
              <x-slot name="label">Program Perkuliahan</x-slot>
              <x-slot name="input">
                <x-form.dropdown 
                  :buttonId="'sortCampusProgram'"
                  :dropdownId="'campusProgramList'"
                  :label="'Pilih Program Perkuliahan'"
                  :imgSrc="asset('assets/base/icon-arrow-down.svg')"
                  :isIconCanRotate="true"
                  :dropdownItem="array_column($programPerkuliahanList, 'name', 'name')"
                  :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9] !text-black !w-full flex items-center justify-between flex-1'"
                  :dropdownContainerClass="'!w-full'"
                  :isUsedForInputField="true"
                  :inputFieldName="'program_perkuliahan'"
                  onclick=""
                  x-model="$store.editPage.program_perkuliahan"
                  :inputValue="$data->program_perkuliahan"
                />
              </x-slot>
            </x-form.input-container>
            <x-form.input-container :class="'min-w-[170px]'">
              <x-slot name="label">Program Studi</x-slot>
              <x-slot name="input">
                <x-form.dropdown 
                  :buttonId="'sortStudyProgram'"
                  :dropdownId="'studyProgramList'"
                  :label="'Pilih Program Studi'"
                  :imgSrc="asset('assets/base/icon-arrow-down.svg')"
                  :isIconCanRotate="true"
                  :dropdownItem="array_column($programStudiList, 'id', 'nama')"
                  :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9] !text-black w-full flex items-center justify-between flex-1'"
                  :dropdownContainerClass="'!w-full'"
                  :isUsedForInputField="true"
                  :inputFieldName="'program_studi'"
                  onclick=""
                  x-model="$store.editPage.program_studi"
                  :inputValue="$data->program_studi"
                />
              </x-slot>
            </x-form.input-container>
        </x-container>
        <x-form.input-container :class="'min-w-[170px]'">
          <x-slot name="label">Periode</x-slot>
          <x-slot name="input">
            <x-form.dropdown 
              :buttonId="'sortPeriode'"
              :dropdownId="'periodeList'"
              :label="'Pilih Periode'"
              :imgSrc="asset('assets/base/icon-arrow-down.svg')"
              :isIconCanRotate="true"
              :dropdownItem="array_column(array_map(function ($item) {
                $data = [
                  'nama' => $item->tahun . ' - ' . $item->semester,
                  'id' => $item->id
                ];
                return $data;
              }, $periodeList), 'id', 'nama')"
              :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9] !text-black !w-full flex items-center justify-between flex-1'"
              :dropdownContainerClass="'!w-full'"
              :isUsedForInputField="true"
              :inputFieldName="'periode'"
              onclick=""
              x-model="$store.editPage.periode"
              :inputValue="$data->periode"
            />
          </x-slot>
        </x-form.input-container>
        <x-container :variant="'content-wrapper'" :class="'!flex flex-row !p-0 justify-between items-center'">
          <x-form.input-container :containerClass="'w-full'" class="min-w-[170px]">
            <x-slot name="label">Nama Mata Kuliah</x-slot>
            <x-slot name="input">
              <x-form.input 
                :placeholder="'Pilih Mata Kuliah'" 
                :name="'nama_matakuliah'" 
                readonly
                x-model="$store.editPage.course.nama_matakuliah_id"
              />
              <input placeholder="Pilih Mata Kuliah" name="matakuliah[jenis_matakuliah]" x-model="$store.editPage.course.id_jenis" type="hidden">
              <input placeholder="Pilih Mata Kuliah" name="matakuliah[sks]" x-model="$store.editPage.course.sks" type="hidden">
              <input placeholder="Pilih Mata Kuliah" name="matakuliah[kurikulum]" x-model="$store.editPage.course.id_kurikulum" type="hidden">
              <input placeholder="Pilih Mata Kuliah" name="matakuliah[kode_matakuliah]" x-model="$store.editPage.course.kode_matakuliah" type="hidden">
              <input placeholder="Pilih Mata Kuliah" name="matakuliah[id]" x-model="$store.editPage.course.id_matakuliah" type="hidden">
            </x-slot>
          </x-form.input-container>
          <x-button.primary 
            x-bind:disabled="$store.editPage.program_perkuliahan == '' || $store.editPage.program_studi == '' || $store.editPage.periode == ''" 
            :icon="asset('assets/icon-mata-kuliah-white.svg')"
            x-on:click="showModal(
              '{{ route('academics.schedule.prodi-schedule.add-course', ['periode' => '__periode__', 'program_perkuliahan' => '__program_perkuliahan__', 'program_studi' => '__program_studi__']) }}'
                .replace('__periode__', $store.editPage.periode)
                .replace('__program_perkuliahan__', $store.editPage.program_perkuliahan)
                .replace('__program_studi__', $store.editPage.program_studi), 
              '#list-course', 
              '#modalListCourse'
            )"
          >
            Pilih Mata Kuliah
          </x-button.primary>
        </x-container>
        <x-form.input-container :class="'min-w-[170px]'">
          <x-slot name="label">Nama Kelas</x-slot>
          <x-slot name="input">
            <x-form.input 
              :name="'nama_kelas'" 
              :iconUrl="asset('assets/icon-remove-text-input.svg')" 
              :showRemoveIcon="true" 
              :placeholder="'Masukan Nama Kelas. Contoh: Makroekonomi-EC2'"
              x-model="$store.editPage.nama_kelas"
            />
          </x-slot>
        </x-form.input-container>
        <x-form.input-container :class="'min-w-[170px]'">
          <x-slot name="label">Nama Singkat</x-slot>
          <x-slot name="input">
            <x-form.input 
              :name="'nama_singkat'" 
              :iconUrl="asset('assets/icon-remove-text-input.svg')" 
              :showRemoveIcon="true" 
              :placeholder="'Masukan Nama Singkat. Contoh: EC2'"
              x-model="$store.editPage.nama_singkat"
            />
          </x-slot>
        </x-form.input-container>
        <x-container :variant="'content-wrapper'" :class="'flex flex-row items-center !px-0 justify-between'">
          <x-form.input-container :class="'min-w-[170px]'">
            <x-slot name="label">Kapasitas Peserta</x-slot>
            <x-slot name="input">
              <x-form.input 
                :type="'number'"
                :name="'kapasitas_peserta'" 
                :iconUrl="asset('assets/icon-remove-text-input.svg')" 
                :showRemoveIcon="true" 
                :placeholder="'Masukkan Kapasitas. Contoh: 50'"
                x-model="$store.editPage.kapasitas_peserta"
              />
            </x-slot>
          </x-form.input-container>
          <x-form.input-container :class="'min-w-[170px]'">
            <x-slot name="label">Kelas MBKM</x-slot>
            <x-slot name="input">
              <x-form.dropdown 
                :buttonId="'sortMBKMClass'"
                :dropdownId="'MBKMClassType'"
                :label="'Pilih Kelas MBKM'"
                :imgSrc="asset('assets/base/icon-arrow-down.svg')"
                :isIconCanRotate="true"
                :dropdownItem="[
                  'Ya' => true,
                  'Tidak' => false,
                ]"
                :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9] !text-black w-full flex items-center justify-between flex-1'"
                :dropdownContainerClass="'!w-full'"
                :isUsedForInputField="true"
                :inputFieldName="'kelas_mbkm'"
                onclick=""
                x-model="$store.editPage.kelas_mbkm"
                :inputValue="$data->kelas_mbkm"
              />
            </x-slot>
          </x-form.input-container>
        </x-container>
        <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between !p-0'">
          <x-form.input-container class="min-w-[170px]" id="tanggal_mulai">
            <x-slot name="label">Tanggal Mulai</x-slot>
            <x-slot name="input">
              <x-form.calendar id="tanggal-mulai" name="tanggal_mulai" x-model="$store.editPage.tanggal_mulai" oninput="" />
            </x-slot>
          </x-form.input-container>
          <x-form.input-container class="min-w-[170px]" id="tanggal_selesai">
            <x-slot name="label">Tanggal Berakhir</x-slot>
            <x-slot name="input">
              <x-form.calendar id="tanggal-akhir" name="tanggal_akhir" x-model="$store.editPage.tanggal_akhir" oninput="" />
            </x-slot>
          </x-form.input-container>
        </x-container>
      </x-container>
    </x-container>
    <x-container :class="'flex flex-col !gap-4'">
      <x-container :variant="'content-wrapper'" class="!px-0 flex flex-row items-center justify-between">
          <x-typography :variant="'body-medium-bold'">Daftar Pengajar</x-typography>
          <x-button.primary x-on:click="showModal('{{ route('academics.schedule.prodi-schedule.add-lecture') }}', '#list-lecture', '#modalListLecture')">Tambah Pengajar</x-button.primary>
      </x-container>
      <x-table id="selected-lecture">
          <x-table-head>
              <x-table-row>
                  <x-table-header>Nama Pengajar</x-table-header>
                  <x-table-header>Status Pengajar</x-table-header>
                  <x-table-header>Aksi</x-table-header>
              </x-table-row>
          </x-table-head>
          <x-table-body>
            <template x-for="(lecture, index) in $store.editPage.lectureList">
              <x-table-row>
                <x-table-cell x-text="lecture.nama"></x-table-cell>
                <x-table-cell>
                  <x-form.dropdown 
                    :buttonId="'sortMBKMClass'"
                    :dropdownId="'MBKMClassType'"
                    :label="'Pilih Status Pengajar'"
                    :imgSrc="asset('assets/base/icon-arrow-down.svg')"
                    :isIconCanRotate="true"
                    :dropdownItem="[
                      'Pengajar Utama' => 'Pengajar Utama',
                      'Bukan Pengajar Utama' => 'Bukan Pengajar Utama',
                    ]"
                    :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9] !text-black w-full flex items-center justify-between flex-1'"
                    :dropdownContainerClass="'!w-full'"
                    :optionStyleClass="'!static'"
                    :isUsedForInputField="true"
                    :inputFieldName="'lectureList[][status_pengajar]'"
                    onclick=""
                    x-model="$store.editPage.lectureList[index].status_pengajar"
                  />
                </x-table-cell>
                <x-table-cell>
                  <x-button.base
                    :icon="asset('assets/icon-delete-gray-600.svg')"
                    class="text-[#8C8C8C] scale-75"
                    x-on:click="onDeleteLecture(index)"
                  >
                    Hapus
                  </x-button.base>
                </x-table-cell>
              </x-table-row>
            </template>
          </x-table-body>
      </x-table>
    </x-container>
    <x-container :class="'flex flex-col !gap-4'">
      <x-container :variant="'content-wrapper'" class="!px-0 flex flex-row items-center justify-between">
          <x-typography :variant="'body-medium-bold'">Daftar Jadwal Kelas</x-typography>
          <x-button.primary x-on:click="showModal('{{ route('academics.schedule.prodi-schedule.add-class-schedule') }}', '#add-schedule', '#modalAddSchedule')">Tambah Jadwal Kelas</x-button.primary>
      </x-container>
      <x-table id="class-schedule">
          <x-table-head>
              <x-table-row>
                  <x-table-header>Hari</x-table-header>
                  <x-table-header>Waktu Mulai Kelas</x-table-header>
                  <x-table-header>Waktu Selesai Kelas</x-table-header>
                  <x-table-header>Ruangan</x-table-header>
                  <x-table-header>Aksi</x-table-header>
              </x-table-row>
          </x-table-head>
          <x-table-body>
            <template x-for="(schedule, index) in $store.editPage.scheduleList">
              <x-table-row>
                <x-table-cell x-text="schedule.hari"></x-table-cell>
                <x-table-cell x-text="schedule.jam_mulai"></x-table-cell>
                <x-table-cell x-text="schedule.jam_akhir"></x-table-cell>
                <x-table-cell x-text="schedule.ruangan"></x-table-cell>
                <x-table-cell>
                  <x-button.base
                    :icon="asset('assets/icon-delete-gray-600.svg')"
                    class="text-[#8C8C8C] scale-75"
                    x-on:click="onDeleteScheduleClass(index)"
                  >
                    Hapus
                  </x-button.base>
                </x-table-cell>
              </x-table-row>
            </template>
          </x-table-body>
      </x-table>
    </x-container>
    <x-container>
      <x-container :variant="'content-wrapper'" class="flex flex-row items-center justify-end !px-0">
          <x-button.secondary :href="route('academics.schedule.prodi-schedule.index')" x-bind:disabled="checkValidity">Batal</x-button.secondary>
          <x-button.primary x-on:click="editConfirmationModalOpen = true" x-bind:disabled="checkValidity">Simpan</x-button.primary>
      </x-container>
    </x-container>
    <x-modal.container-pure-js x-bind:class="{'hidden': !editConfirmationModalOpen, 'flex': editConfirmationModalOpen}">
      <x-slot name="header">
        <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
          <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
          <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
        </x-container>
      </x-slot>
      <x-slot name="body">Apakah Anda yakin informasi yang diubah sudah benar?</x-slot>
      <x-slot name="footer">
        <x-button.secondary x-on:click="editConfirmationModalOpen = false">Cek Kembali</x-button.secondary>
        <x-button.primary x-on:click="onUpdateProdiSchedule">Ya, Simpan Sekarang</x-button.primary>
      </x-slot>
    </x-modal.container-pure-js>
    <div id="list-course"></div>
    <div id="list-lecture"></div>
    <div id="add-schedule"></div>
  </x-container>
@endsection
