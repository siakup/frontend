@extends('layouts.main')

@section('title', 'Ubah Event Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik Event</div>
@endsection

@section('content')
<form action="{{route('academics-event.update', ['id' => $id])}}" method="POST">
  @csrf
  @method('PUT')
  <x-title-page :title="'Ubah Event Akademik'" />
  <x-button.back class="ml-4" :href="route('academics-event.index')">Event Akademik</x-button.back> 
  <x-white-box :class="''">
    <x-title-page :title="'Ubah Event Akademik'" />
    <div class="px-5 pt-2.5 pb-0 flex flex-col gap-4">
      <x-form.input-container class="min-w-[150px]" id="name-container">
        <x-slot name="label">Nama Event</x-slot>
        <x-slot name="input">
          <div class="flex flex-col w-full">
              <input 
                type="text" 
                id="name" 
                class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10" 
                name="nama_event"
                value="{{ $data['nama_event'] }}" 
                placeholder='Nama Event'
                oninput=""
              />
              @error('nama_event')
                <span>{{ $message }}</span>
              @enderror
          </div>
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[150px]" id="flag">
        <x-slot name="label">Flag</x-slot>
        <x-slot name="input">
          <div class="flex gap-8 justify-items-start py-3">
            <x-form.checklist :id="'nilai'" :value="'true'" :label="'Nilai'" :name="'nilai_on'" :checked="$data['nilai_on']" />
            <x-form.checklist :id="'irs'" :value="'true'" :label="'IRS'" :name="'irs_on'" :checked="$data['irs_on']" />
            <x-form.checklist :id="'lulus'" :value="'true'" :label="'Lulus'" :name="'lulus_on'" :checked="$data['lulus_on']" />
            <x-form.checklist :id="'registrasi'" :value="'true'" :label="'Registrasi'" :name="'registrasi_on'" :checked="$data['registrasi_on']" />
            <x-form.checklist :id="'yudisium'" :value="'true'" :label="'Yudisium'" :name="'yudisium_on'" :checked="$data['yudisium_on']" />
            <x-form.checklist :id="'survei'" :value="'true'" :label="'Survei'" :name="'survei_on'" :checked="$data['survei_on']" />
            <x-form.checklist :id="'dosen'" :value="'true'" :label="'Dosen'" :name="'dosen_on'" :checked="$data['dosen_on']" />
          </div>
        </x-slot>
      </x-form.input-container>
      <x-form.toggle :id="'statusValue'" :value="$data['status'] === 'active'" />
    </div>
    <div class="flex gap-5 justify-end m-5">
      <x-button.secondary :href="route('academics-event.index')">Batal</x-button.secondary>
      <x-button.primary 
        onclick="
          document.getElementById('modalKonfirmasiSimpan').classList.add('flex');
          document.getElementById('modalKonfirmasiSimpan').classList.remove('hidden');
        "
      >
        Simpan
      </x-button.primary>
    </div>
  </x-white-box>

  <x-modal.container-pure-js id="modalKonfirmasiSimpan">
    <x-slot name="header">
      <span class="text-lg-bd">Tunggu Sebentar</span>
      <img src="{{ asset('assets/base/icon-caution.svg') }}" alt="ikon peringatan">
    </x-slot>
    <x-slot name="body">
      Apakah Anda yakin informasi yang diubah sudah benar?
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
      <x-button.primary
        type="submit"
      >
        Ya, Ubah Sekarang
      </x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
</form>
@endsection