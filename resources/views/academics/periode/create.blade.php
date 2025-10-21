@extends('layouts.main')

@section('title', 'Tambah Periode Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
@endsection

@section('javascript')
  <script src="{{ asset('js/plugins/flatpckr.js') }}"></script>
  <script src="{{ asset('js/plugins/flatpckr-id.js') }}"></script>
@endsection

@section('content')
  <x-title-page :title="'Tambah Periode Akademik'" />
  <x-button.back 
    :href="route('academics-periode.index')" 
    :class="'ml-4'"
  >
    Periode Akademik
  </x-button.back>
  <form action="{{ route('academics-periode.store') }}" method="POST">
    @csrf
    <x-white-box :class="''">
      <x-title-page :title="'Buat Periode Akademik'" />
      <div class="flex flex-col gap-8 px-3">
        <input type="hidden" id="user_id" value="" />
        <x-form.input-container class="min-w-[150px]" id="year">
          <x-slot name="label">Tahun</x-slot>
          <x-slot name="input">
            <x-form.year
              :id="'Year-Input'"
              :name="'year'"
              onclick="
                const value = this.getAttribute('data-year');
                document.getElementById('tahun_akademik').value = `${value}/${+value + 1}`;
                updateCreatePeriodeState()
              "
            />
          </x-slot>
        </x-form.input-container>
        <x-form.input-container class="min-w-[150px]" id="semester">
          <x-slot name="label">Semester</x-slot>
          <x-slot name="input">
            <x-form.checkbox 
              :name="'semester'"
              onchange="updateCreatePeriodeState()"
              :options="[
                ['label' => 'Ganjil','value' => 1],
                ['label' => 'Genap','value' => 2],
                ['label' => 'Pendek','value' => 3],
              ]"
            />
          </x-slot>
        </x-form.input-container>
        <x-form.input-container class="min-w-[150px]" id="semester">
          <x-slot name="label">Tahun Akademik</x-slot>
          <x-slot name="input">
            <div class="flex justify-between w-full">
                <input 
                  type="text" 
                  id="tahun_akademik" 
                  class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10" 
                  readonly 
                  name="tahun_akademik"
                  value="" 
                  placeholder='Auto Fill (Tahun yang dipilih +"/"+ Tahun berikutnya)'
                />
            </div>
          </x-slot>
        </x-form.input-container>
        <div class="flex justify-between">
          <x-form.input-container class="min-w-[150px]" id="semester">
            <x-slot name="label">Tanggal Mulai</x-slot>
            <x-slot name="input">
              <x-form.calendar id="tanggal-mulai" name="tanggal_mulai" oninput="updateCreatePeriodeState()" />
            </x-slot>
          </x-form.input-container>
          <x-form.input-container class="min-w-[150px]" id="semester">
            <x-slot name="label">Tanggal Berakhir</x-slot>
            <x-slot name="input">
              <x-form.calendar id="tanggal-akhir" name="tanggal_akhir" oninput="updateCreatePeriodeState()" />
            </x-slot>
          </x-form.input-container>
        </div>
        <x-form.input-container class="min-w-[150px]" id="semester">
          <x-slot name="label">Deskripsi</x-slot>
          <x-slot name="input">
            <x-form.textarea
              :placeholder="'Tulis deskripsi disini'"
              :id="'deskripsi'"
              :maxChar="280"
              oninput="updateCreatePeriodeState()"
            />
          </x-slot>
        </x-form.input-container>
        <x-form.toggle :id="'academic-periode-status'"/>
        <div class="flex gap-5 justify-end m-5">
          <x-button.secondary :href="route('academics-periode.index')">Batal</x-button.secondary>
          <x-button.primary 
            onclick="
              document.getElementById('modalKonfirmasiSimpan').classList.add('flex');
              document.getElementById('modalKonfirmasiSimpan').classList.remove('hidden');
            " 
            id="btnSimpan" 
            disabled
          >
            Simpan
          </x-button.primary>
        </div>
      </div>
    </x-white-box>
    <x-modal.container-pure-js id="modalKonfirmasiSimpan">
      <x-slot name="header">
        <span class="text-lg-bd">Tunggu Sebentar</span>
        <img src="{{ asset('assets/base/icon-caution.svg') }}" alt="ikon peringatan">
      </x-slot>
      <x-slot name="body">
        Apakah Anda yakin informasi yang ditambah sudah benar?
      </x-slot>
      <x-slot name="footer">
        <x-button.secondary
          onclick="
            document.getElementById('modalKonfirmasiSimpan').classList.add('hidden');
            document.getElementById('modalKonfirmasiSimpan').classList.remove('flex');
          "
        >
          Cek Kembali
        </x-button.secondary>
        <x-button.primary :type="'submit'">Ya, Simpan Sekarang</x-button.primary>
      </x-slot>
    </x-modal.container-pure-js>
  </form>
  <script>
    const tahun = document.querySelector('#Year-Input #year');
    const deskripsi = document.getElementById('deskripsi');
    const tanggalMulai = document.getElementById('tanggal-mulai');
    const tanggalAkhir = document.getElementById('tanggal-akhir');
    const btnSave = document.getElementById('btnSimpan');

    let tanggalMulaiInput, tanggalAkhirInput;

    function updateCreatePeriodeState() {
      const descriptionFilled = (deskripsi.value !== null && deskripsi.value.trim() !== '') && deskripsi.value.length <= 280;
      const tahunFilled = tahun.value !== '';
      const startDateFilled = tanggalMulai.value !== '' && (tanggalMulaiInput.selectedDates[0] < tanggalAkhirInput.selectedDates[0]);
      const endDateFilled = tanggalAkhir.value !== '' && (tanggalAkhirInput.selectedDates[0] > tanggalMulaiInput.selectedDates[0]);
      
      const semester = document.querySelector('input[name="semester"]:checked');
      const semesterOptionFilled = semester ? true : false;

      if (descriptionFilled && tahunFilled && semesterOptionFilled && startDateFilled && endDateFilled) {
        btnSave.disabled = false;
      } else {
        btnSave.disabled = true;
      }
    }

    function initCalendar() {
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
    }
    
    document.addEventListener('DOMContentLoaded', () => {
      initCalendar();
    });
  </script>
@endsection
