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
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let tanggalMulaiInput, tanggalAkhirInput;

        tanggalMulaiInput = flatpickr("#tanggal-mulai", {
            locale: 'id',
            enableTime: true,
            dateFormat: "d-m-Y, H:i",
            time_24hr: true,
            onChange: (selectedDates) => {
                if (selectedDates.length > 0) {
                    tanggalAkhirInput.set('minDate', selectedDates[0]);
                } else {
                    tanggalAkhirInput.set('minDate', null);
                }
            }
        });

        tanggalAkhirInput = flatpickr("#tanggal-akhir", {
            locale: 'id',
            enableTime: true,
            dateFormat: "d-m-Y, H:i",
            time_24hr: true,
            onChange: (selectedDates) => {
                if (selectedDates.length > 0) {
                    tanggalMulaiInput.set('maxDate', selectedDates[0]);
                } else {
                    tanggalMulaiInput.set('maxDate', null);
                }
            }
        });

        document.getElementById('chooseLecture').addEventListener('click', () => {
            $.ajax({
                url: "{{ route('academics.schedule.prodi-schedule.add-lecture') }}",
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(html) {
                    $('#list-lecture').html(html);
                    $('#modalListLecture').show();
                },
            });
        });

        document.getElementById('chooseCourse').addEventListener('click', () => {
            const periodeId = document.querySelector('input[name="periode"]').value
            $.ajax({
                url: "{{ route('academics.schedule.prodi-schedule.add-course', ['periode' => '__periode__']) }}"
                    .replace('__periode__', periodeId),
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(html) {
                    $('#list-course').html(html);
                    $('#modalListCourse').show();
                },
            });
        });

        document.getElementById('createScheduleClass').addEventListener('click', () => {
            $.ajax({
                url: "{{ route('academics.schedule.prodi-schedule.add-class-schedule') }}",
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(html) {
                    $('#add-schedule').html(html);
                    $('#modalAddSchedule').show();
                },
            });
        });

    });
</script>

@section('content')
<form action="{{ route('academics.schedule.prodi-schedule.store') }}" method="POST">
  @csrf
  <x-container 
    :variant="'content-wrapper'" 
    x-data="{
      program_perkuliahan: '',
      program_studi: '',
      periode: '',
      nama_kelas: '',
      nama_singkat: '',
      kapasitas_peserta: '',
      kelas_mbkm: false,
      checkValidity() {
        return this.program_perkuliahan == '' ||
          this.program_studi == '' ||
          this.periode == '' ||
          this.nama_kelas == '' ||
          this.nama_singkat == '' ||
          this.kapasitas_peserta == '';
      }
    }"
  >
    <x-typography :variant="'body-large-semibold'">Tambah Jadwal Program Studi</x-typography>
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
                          x-model="program_perkuliahan"
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
                          x-model="program_studi"
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
                      x-model="periode"
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
                      />
                      <input placeholder="Pilih Mata Kuliah" name="matakuliah[jenis_matakuliah]" type="hidden">
                      <input placeholder="Pilih Mata Kuliah" name="matakuliah[sks]" type="hidden">
                      <input placeholder="Pilih Mata Kuliah" name="matakuliah[kurikulum]" type="hidden">
                      <input placeholder="Pilih Mata Kuliah" name="matakuliah[kode_matakuliah]" type="hidden">
                      <input placeholder="Pilih Mata Kuliah" name="matakuliah[id]" type="hidden">
                    </x-slot>
                  </x-form.input-container>
                  <x-button.primary id="chooseCourse" x-bind:disabled="program_perkuliahan == '' || program_studi == '' || periode == ''" :icon="asset('assets/icon-mata-kuliah-white.svg')">Pilih Mata Kuliah</x-button.primary>
                </x-container>
                <x-form.input-container :class="'min-w-[170px]'">
                  <x-slot name="label">Nama Kelas</x-slot>
                  <x-slot name="input">
                    <x-form.input 
                      :name="'nama_kelas'" 
                      :iconUrl="asset('assets/icon-remove-text-input.svg')" 
                      :showRemoveIcon="true" 
                      :placeholder="'Masukan Nama Kelas. Contoh: Makroekonomi-EC2'"
                      x-model="nama_kelas"
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
                      x-model="nama_singkat"
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
                        x-model="kapasitas_peserta"
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
                        x-model="kelas_mbkm"
                      />
                    </x-slot>
                  </x-form.input-container>
                </x-container>
                <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between !p-0'">
                  <x-form.input-container class="min-w-[170px]" id="semester">
                    <x-slot name="label">Tanggal Mulai</x-slot>
                    <x-slot name="input">
                      <x-form.calendar id="tanggal-mulai" name="tanggal_mulai" oninput="" />
                    </x-slot>
                  </x-form.input-container>
                  <x-form.input-container class="min-w-[170px]" id="semester">
                    <x-slot name="label">Tanggal Berakhir</x-slot>
                    <x-slot name="input">
                      <x-form.calendar id="tanggal-akhir" name="tanggal_akhir" oninput="" />
                    </x-slot>
                  </x-form.input-container>
                </x-container>
            </x-container>
          </x-container>
          <x-container :class="'flex flex-col !gap-4'">
            <x-container :variant="'content-wrapper'" class="!px-0 flex flex-row items-center justify-between">
                <x-typography :variant="'body-medium-bold'">Daftar Pengajar</x-typography>
                <x-button.primary id="chooseLecture">Tambah Pengajar</x-button.primary>
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
                </x-table-body>
            </x-table>
          </x-container>
          <x-container :class="'flex flex-col !gap-4'">
            <x-container :variant="'content-wrapper'" class="!px-0 flex flex-row items-center justify-between">
                <x-typography :variant="'body-medium-bold'">Daftar Jadwal Kelas</x-typography>
                <x-button.primary id="createScheduleClass">Tambah Jadwal Kelas</x-button.primary>
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
                </x-table-body>
            </x-table>
          </x-container>
          <x-container>
            <x-container :variant="'content-wrapper'" class="flex flex-row items-center justify-end !px-0">
                <x-button.secondary id="btnBatal" x-bind:disabled="checkValidity">Batal</x-button.secondary>
                <x-button.primary id="btnSimpan" x-bind:disabled="checkValidity">Simpan</x-button.primary>
            </x-container>
          </x-container>
        @include('partials.modal', [
            'modalId' => 'modalKonfirmasiSimpan',
            'modalTitle' => 'Tunggu Sebentar',
            'modalIcon' => asset('assets/base/icon-caution.svg'),
            'modalMessage' => 'Apakah Anda yakin informasi yang ditambah sudah benar?',
            'triggerButton' => 'btnSimpan',
            'cancelButtonLabel' => 'Cek Kembali',
            'actionButtonLabel' => 'Ya, Simpan Sekarang',
        ]);
    <div id="list-course"></div>
    <div id="list-lecture"></div>
    <div id="add-schedule"></div>
  </x-container>
</form>
@endsection
