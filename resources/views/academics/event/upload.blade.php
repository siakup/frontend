@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('content')
  <x-container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Upload Event Akademik</x-typography>
    <x-button.back :href="route('academics-event.index')">Event Akademik</x-button.back>
    <x-container :class="'p-4 flex flex-col items-start gap-2.5 self-stretch'">
      <x-container :variant="'content-wrapper'" class="flex flex-row !mx-0 !px-0 !w-max items-center">
        <x-typography :variant="'body-medium-bold'">Impor Event Akademik</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-auto h-[1.5em]'" />
      </x-container>
      <x-container :variant="'content-wrapper'" class="flex flex-row gap-10 justify-between !px-0">
        <x-container :variant="'content-wrapper'" class="basis-[35%] shrink-0 grow-0 min-w-1/5 max-w-[35%] flex flex-col !gap-2 !px-0">
          <x-typography>Allowed Type: [.xlsx, .xls, .csv]</x-typography>  
          <x-button.link href="{{ route('academics-event.template', ['type' => 'xlsx']) }}">Download Sample Data (.xlsx)</x-button.link>
          <x-button.link href="{{ route('academics-event.template', ['type' => 'csv']) }}">Download Sample Data (.csv)</x-button.link>
        </x-container>
          <x-container :variant="'content-wrapper'" class="grow-1 shrink-1 basis-0 min-w-3/4 flex flex-col !mx-0 !px-0 !gap-4 relative items-start w-full">
            <x-typography :variant="'body-medium-regular'">Unggah File Event Akademik</x-typography>
            <form action="{{ route('academics-event.preview') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
              @csrf
              <x-form.file 
                :cancelConfirmationModalButtonId="'modalKonfirmasiBatal'" 
                onclick="
                  event.preventDefault();
                  document.getElementById('modalKonfirmasiUnggah').classList.add('flex');
                  document.getElementById('modalKonfirmasiUnggah').classList.remove('hidden');
                "
              />
            </form>
          </x-container>
      </x-container>
      <x-container class="flex flex-col !p-5 !gap-2.5 !bg-[#FAFAFA]">
        <x-typography :variant="'body-small-regular'">
          File yang diterima adalah file .csv dengan pemisah antar kolom berupa titik koma "," atau file .xlsx<br>
          Urutan kolom sebagai berikut:
        </x-typography>
        <ul>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">nama</x-typography>
            <x-typography :variant="'body-small-regular'">: Nama event akademik *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">event nilai</x-typography>
            <x-typography :variant="'body-small-regular'">: y/n *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">event krs</x-typography>
            <x-typography :variant="'body-small-regular'">: y/n *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">event kelulusan</x-typography>
            <x-typography :variant="'body-small-regular'">: y/n *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">event registrasi</x-typography>
            <x-typography :variant="'body-small-regular'">: y/n *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">event yudisium</x-typography>
            <x-typography :variant="'body-small-regular'">: y/n *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">event survei</x-typography>
            <x-typography :variant="'body-small-regular'">: y/n *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">event dosen</x-typography>
            <x-typography :variant="'body-small-regular'">: y/n *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <x-typography :variant="'body-small-bold'">status</x-typography>
            <x-typography :variant="'body-small-regular'">: active/inactive *)</x-typography>
          </li>
          <li class="text-[#E62129]">
            <br> 
            <x-typography :variant="'body-small-regular'">*) data perlu diisi, jika tidak diisi salah satu kolom pada baris, data dianggap tidak valid dan data pada baris bersangkutan tidak akan tersimpan</x-typography>
          </li>
        </ul>
      </x-container>
    </x-container>
    <x-modal.container-pure-js id="modalKonfirmasiUnggah">
      <x-slot name="header">
        <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
          <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
          <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
        </x-container>
      </x-slot>
      <x-slot name="body">Apakah Anda yakin untuk mengunggah event akademik dari file ini?</x-slot>
      <x-slot name="footer">
        <x-button.secondary
          onclick="
            document.getElementById('modalKonfirmasiUnggah').classList.add('hidden');
            document.getElementById('modalKonfirmasiUnggah').classList.remove('flex');
          "
        >
          Tidak
        </x-button.secondary>
        <x-button.primary onclick="document.getElementById('uploadForm').submit()">Ya</x-button.primary>
      </x-slot>
    </x-modal.container-pure-js>
  </x-container>
@endsection
