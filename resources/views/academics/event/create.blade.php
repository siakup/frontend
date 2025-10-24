@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('content')
  <x-container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Tambah Event Akademik</x-typography>
    <x-button.back :href="route('academics-event.index')">Event Akademik</x-button.back>
    <x-container :class="'flex flex-col gap-4'">
      <x-typography :variant="'body-medium-bold'">Tambah Event Akademik</x-typography>
      <x-container :variant="'content-wrapper'" class="flex flex-col gap-4 !p-0">
        <input type="hidden" id="user_id" value="">
        <x-form.input-container class="min-w-[150px]" id="name-container">
          <x-slot name="label">Nama Event</x-slot>
          <x-slot name="input">
            <x-container :variant="'content-wrapper'" class="flex justify-between w-full !p-0">
                <input 
                  type="text" 
                  id="name" 
                  class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10" 
                  name="name"
                  value="" 
                  placeholder='Nama Event'
                  oninput="updateSaveButtonState()"
                />
            </x-container>
          </x-slot>
        </x-form.input-container>
        <x-form.input-container class="min-w-[150px]" id="flag">
          <x-slot name="label">Flag</x-slot>
          <x-slot name="input">
            <x-container :variant="'content-wrapper'" class="flex flex-row justify-items-start py-3 !p-0">
              <x-form.checklist :id="'nilai'" :value="'nilai_on'" :label="'Nilai'" :name="'flag[]'" />
              <x-form.checklist :id="'irs'" :value="'irs_on'" :label="'IRS'" :name="'flag[]'" />
              <x-form.checklist :id="'lulus'" :value="'lulus_on'" :label="'Lulus'" :name="'flag[]'" />
              <x-form.checklist :id="'registrasi'" :value="'registrasi_on'" :label="'Registrasi'" :name="'flag[]'" />
              <x-form.checklist :id="'yudisium'" :value="'yudisium_on'" :label="'Yudisium'" :name="'flag[]'" />
              <x-form.checklist :id="'survei'" :value="'survei_on'" :label="'Survei'" :name="'flag[]'" />
              <x-form.checklist :id="'dosen'" :value="'dosen_on'" :label="'Dosen'" :name="'flag[]'" />
            </x-container>
          </x-slot>
        </x-form.input-container>
        <x-form.toggle :id="'statusValue'" />
        <x-container :variant="'content-wrapper'" class="flex gap-5 justify-end flex-row !p-0">
          <x-button.secondary :href="route('academics-event.index')">Batal</x-button.secondary>
          <x-button.primary
            onclick="
              document.getElementById('modalKonfirmasiSimpan').classList.add('flex');
              document.getElementById('modalKonfirmasiSimpan').classList.remove('hidden');
            "
            id="btnSave"
            disabled
          >
            Simpan
          </x-button.primary>
        </x-container>
      </x-container>
    </x-container>
  </x-container>

  <x-modal.container-pure-js id="modalKonfirmasiSimpan">
    <x-slot name="header">
      <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
      </x-container>
    </x-slot>
    <x-slot name="body">Apakah Anda yakin informasi yang ditambah sudah benar?</x-slot>
    <x-slot name="footer">
      <x-button.secondary
        onclick="
          document.getElementById('modalKonfirmasiSimpan').classList.add('hidden');
          document.getElementById('modalKonfirmasiSimpan').classList.remove('flex');
        "
      >
        Cek Kembali
      </x-button.secondary>
      <x-button.primary
        onclick="onClickCreateEventAcademic('{{ route('academics-event.store') }}', '{{ route('academics-event.index') }}')"
      >
        Ya, Simpan Sekarang
      </x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>

  <script src="{{asset('js/custom/event.js')}}"></script>
@endsection