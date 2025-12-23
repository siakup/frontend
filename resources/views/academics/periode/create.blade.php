@extends('layouts.main')

@section('title', 'Tambah Periode Akademik')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
@endsection

@section('javascript')
  <script src="{{ asset('js/plugins/flatpckr.js') }}"></script>
  <script src="{{ asset('js/plugins/flatpckr-id.js') }}"></script>
@endsection

@section('content')
<x-container.wrapper :padding="'p-0'" class="grid grid-rows-[auto_1fr] content-start py-4">
  <x-container.container :background="'transparent'" :height="'maxContent'" class="py-4">
    <x-typography :variant="'body-large-semibold'">Tambah Periode Akademik</x-typography>
  </x-container.container>

  <x-container.container :height="'maxContent'" class="py-4"> 
    <x-button.back :href="route('academics-periode.index')">Periode Akademik</x-button.back>
    <form action="{{ route('academics-periode.store') }}" method="POST">
  </x-container.container>

  <x-container.container :height="'maxContent'" :background="'bg-white'" class="border border-gray-400">
    @csrf
    <x-container.wrapper :gapY="'4'" :padding="'p-4'" :cols="'5'" class="grid grid-rows-[auto_1fr] content-start">

      <x-container.container class="col-start-1 col-end-6">
        <x-typography :variant="'body-medium-bold'">Buat Periode Akademik</x-typography>
      </x-container.container>
        
      <x-container.container class="col-start-1 col-end-6">
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
                updateNewStateButton()
              "
            />
          </x-slot>
        </x-form.input-container>
      </x-container.container>

      <x-container.container class="col-start-1 col-end-6 content-center">
        <x-form.input-container class="min-w-[150px]" id="semester">
          <x-slot name="label">Semester</x-slot>
          <x-slot name="input">
            <x-form.checkbox 
              :name="'semester'"
              onchange="updateNewStateButton()"
              :options="[
                ['label' => 'Ganjil','value' => 1],
                ['label' => 'Genap','value' => 2],
                ['label' => 'Pendek','value' => 3],
              ]"
            />
          </x-slot>
        </x-form.input-container>
      </x-container.container>

      <x-container.container class="col-start-1 col-end-6">
        <x-form.input-container class="min-w-[150px]" id="semester">
          <x-slot name="label">Tahun Akademik</x-slot>
          <x-slot name="input">
            <x-container.container :variant="'content-wrapper'" :class="'flex justify-between w-full !p-0'">
              <input 
                type="text" 
                id="tahun_akademik" 
                class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-md leading-5 h-10" 
                readonly 
                name="tahun_akademik"
                value="" 
                placeholder='Auto Fill (Tahun yang dipilih +"/"+ Tahun berikutnya)'
              />
            </x-container>
          </x-slot>
        </x-form.input-container>
      </x-container.container>

      <x-container.container class="col-start-1 col-end-6">

        <x-form.input-container class="min-w-[150px]" id="semester" :fullWidth="false">
          <x-slot name="label">Tanggal Mulai</x-slot>
          <x-slot name="input">
            <x-form.calendar id="tanggal-mulai" name="tanggal_mulai" oninput="updateNewStateButton()" />
          </x-slot>
        </x-form.input-container>

        <x-form.input-container id="semester" :half="true">
          <x-slot name="label">Tanggal Berakhir</x-slot>
          <x-slot name="input">
            <x-form.calendar id="tanggal-akhir" name="tanggal_akhir" oninput="updateNewStateButton()" />
          </x-slot>
        </x-form.input-container>

      </x-container.container>

      <x-container.container class="col-start-1 col-end-6">
        <x-form.input-container class="min-w-[150px]" id="semester">
          <x-slot name="label">Deskripsi</x-slot>
          <x-slot name="input">
            <x-form.textarea
              :placeholder="'Tulis deskripsi disini'"
              :id="'deskripsi'"
              :maxChar="280"
              :helperText="'Maksimal 280 Karakter'"
              oninput="updateNewStateButton()"
            />
          </x-slot>
        </x-form.input-container>
      </x-container.container>

      <x-container.container class="col-start-1 col-end-6">
        <x-form.input-container class="min-w-[150px]" id="semester">
          <x-slot name="label">Status</x-slot>
          <x-slot name="input">
          <x-form.toggle :id="'academic-periode-status'"/>
          </x-slot>
        </x-form.input-container>
      </x-container.container>

      <x-container.container :variant="'content-wrapper'" class="col-start-4 col-end-6 justify-end">
        <x-container.wrapper :cols="'2'" :padding="'p-0'" :gapX="'4'">

          <x-container.container class="col-start-1 col-end-2">
            <x-button.secondary :href="route('academics-periode.index')" class="!w-full">Batal</x-button.secondary>
          </x-container.container>

          <x-container.container class="col-start-2 col-end-3">
            <x-button.primary 
              onclick="
                document.getElementById('modalKonfirmasiSimpan').classList.add('flex');
                document.getElementById('modalKonfirmasiSimpan').classList.remove('hidden');
              " 
              id="btnSimpan" 
              class="!w-full"
              disabled
            >
              Simpan
            </x-button.primary>
          </x-container.container>

        </x-container.wrapper>
      </x-container.container>

    </x-container.container>
  </x-container.wrapper>
</x-container.wrapper>

<x-modal.container-pure-js id="modalKonfirmasiSimpan">
  <x-slot name="header">
    <x-container.container :variant="'content-wrapper'" class="flex flex-row justify-between items-center !px-0 !ps-5 !gap-0">
      <x-typography :variant="'body-medium-bold'" class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
      <x-icon :name="'exclamation-mark/black-20'" :class="'w-8 h-8'" />
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
    <x-button.primary :type="'submit'">Ya, Simpan Sekarang</x-button.primary>
  </x-slot>
</x-modal.container-pure-js>

  <script src="{{asset('js/custom/periode.js')}}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      initCalendar();
    });
  </script>
@endsection
