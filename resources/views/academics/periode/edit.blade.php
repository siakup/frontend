@extends('layouts.main')

@section('title', 'Ubah Periode Akademik')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
@endsection

@section('content')
  <x-container.container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Ubah Periode Akademik</x-typography>
    <x-button.back :href="route('academics-periode.index')">Periode Akademik</x-button.back>
    <form action="{{ route('academics-periode.update', ['id' => $id]) }}" method="POST">
      @csrf
      @method('PUT')
      <x-container.container :class="'!gap-5 flex flex-col'">
        <x-typography :variant="'body-medium-bold'">Ubah Periode Akademik</x-typography>
        <x-container.container :variant="'content-wrapper'" :class="'flex flex-col gap-8 !px-0'">
            <input type="hidden" id="user_id" value="">
            <x-form.input-container class="min-w-[150px]" id="year">
              <x-slot name="label">Tahun</x-slot>
              <x-slot name="input">
                <x-form.year
                  :id="'Year-Input'"
                  :name="'tahun'"
                  onclick="
                    const value = this.getAttribute('data-year');
                    document.getElementById('tahun_akademik').value = `${value}/${+value + 1}`;
                  "
                  :value="$data['tahun']"
                />
              </x-slot>
            </x-form.input-container>
            <x-form.input-container class="min-w-[150px]" id="semester">
              <x-slot name="label">Semester</x-slot>
              <x-slot name="input">
                <x-form.checkbox 
                  :name="'semester'"
                  onchange="updateNewStateButton()"
                  :options="[
                    ['label' => 'Ganjil', 'value' => 1],
                    ['label' => 'Genap', 'value' => 2],
                    ['label' => 'Pendek', 'value' => 3],
                  ]"
                  :value="$data['semester']"
                />
              </x-slot>
            </x-form.input-container>
            <x-form.input-container class="min-w-[150px]" id="semester">
              <x-slot name="label">Tahun Akademik</x-slot>
              <x-slot name="input">
                <x-container.container  :variant="'content-wrapper'" :class="'flex justify-between w-full !p-0'">
                  <input 
                    type="text" 
                    id="tahun_akademik" 
                    class="w-full pe-10 box-border ps-3 border-[1px] border-[#D9D9D9] rounded-lg leading-5 h-10" 
                    readonly 
                    name="tahun_akademik"
                    value="{{ $data['tahun'] . '/' . ($data['tahun'] + 1) }}" 
                    placeholder='Auto Fill (Tahun yang dipilih +"/"+ Tahun berikutnya)'
                  />
                </x-container>
              </x-slot>
            </x-form.input-container>
            <x-container.container :variant="'content-wrapper'" :class="'!px-0 flex flex-row justify-between'">
              <x-form.input-container class="min-w-[150px]" id="semester">
                <x-slot name="label">Tanggal Mulai</x-slot>
                <x-slot name="input">
                  <x-form.calendar 
                    id="tanggal-mulai" 
                    name="tanggal_mulai" 
                    oninput="updateNewStateButton()" 
                    :value="\Carbon\Carbon::parse($data['tanggal_mulai'])->format('d-m-Y, H:i')"
                  />
                </x-slot>
              </x-form.input-container>
              <x-form.input-container class="min-w-[150px]" id="semester">
                <x-slot name="label">Tanggal Berakhir</x-slot>
                <x-slot name="input">
                  <x-form.calendar 
                    id="tanggal-akhir" 
                    name="tanggal_akhir" 
                    oninput="updateNewStateButton()"
                    :value="\Carbon\Carbon::parse($data['tanggal_akhir'])->format('d-m-Y, H:i')"
                  />
                </x-slot>
              </x-form.input-container>
            </x-container>
            <x-form.input-container class="min-w-[150px]" id="semester">
              <x-slot name="label">Deskripsi</x-slot>
              <x-slot name="input">
                <x-form.textarea
                  :placeholder="'Tulis deskripsi disini'"
                  :id="'deskripsi'"
                  :maxChar="280"
                  oninput="updateNewStateButton()"
                  :value="$data['deskripsi']"
                />
              </x-slot>
            </x-form.input-container>
            <x-form.toggle :id="'academic-periode-status'" :value="$data['status'] === 'active'" />
            <x-container.container :variant="'content-wrapper'" :class="'!px-0 flex flex-row gap-5 justify-end'">
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
            </x-container>
        </x-container>
        <x-modal.container-pure-js id="modalKonfirmasiSimpan">
          <x-slot name="header">
            <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
              <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
              <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
            </x-container>
          </x-slot>
          <x-slot name="body">Apakah Anda yakin informasi yang diubah sudah benar?</x-slot>
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
      </x-container>
    </form>
  </x-container>

  <script src="{{ asset('js/plugins/flatpckr.js') }}"></script>
  <script src="{{ asset('js/plugins/flatpckr-id.js') }}"></script>
  <script src="{{ asset('js/custom/periode.js')}}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      initCalendar();
      initMaxAndMinCalendar();
      updateNewStateButton();
    });
  </script>

  @include('partials.success-notification-modal', [
    'route' => route('academics-periode.edit', ['id' => $id])
  ])
@endsection
