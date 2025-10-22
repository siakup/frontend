@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('content')
  <x-title-page :title="'Tambah Event Akademik'" />
  <x-button.back :class="'ml-4'" :href="route('academics-event.index')">Event Akademik</x-button.back>
  <x-white-box :class="'p-4 flex flex-col items-start gap-2.5 self-stretch'">
    <div class="flex items-center justify-center">
      <x-title-page :title="'Impor Event Akademik'" />
      <img src="{{ asset('assets/base/icon-caution.svg')}}" alt="caution-icon" class="h-[1.5em] w-auto">
    </div>
    <div class="flex gap-10 justify-between px-5">
        <div class="basis-[35%] shrink-0 grow-0 min-w-1/5 max-w-[35%] flex flex-col gap-1">
            <div>
                Allowed Type: [.xlsx, .xls, .csv]
            </div>
            <x-button.link href="{{ route('academics-event.template', ['type' => 'xlsx']) }}">Download Sample Data (.xlsx)</x-button.link>
            <x-button.link href="{{ route('academics-event.template', ['type' => 'csv']) }}">Download Sample Data (.csv)</x-button.link>
        </div>
        <div class="grow-1 shrink-1 basis-0 min-w-3/4 flex flex-col gap-4 relative items-start w-full">
            <div class="font-medium w-full">Unggah File Event Akademik</div>
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
        </div>
    </div>
    <div class="my-0 mx-auto flex flex-col p-5 max-w-96/100 w-full gap-2.5 rounded-xl border-[1px] border-[#D9D9D9] bg-[#FAFAFA]">
      <div>
        File yang diterima adalah file .csv dengan pemisah antar kolom berupa titik koma "," atau file .xlsx<br>
        Urutan kolom sebagai berikut:
      </div>
      <ul>
        <li class="text-[#E62129]"><span class="font-bold">nama</span>: Nama event akademik *)</li>
        <li class="text-[#E62129]"><span class="font-bold">event nilai</span>: y/n *)</li>
        <li class="text-[#E62129]"><span class="font-bold">event krs</span>: y/n  *)</li>
        <li class="text-[#E62129]"><span class="font-bold">event kelulusan</span>: y/n *)</li>
        <li class="text-[#E62129]"><span class="font-bold">event registrasi</span>: y/n *)</li>
        <li class="text-[#E62129]"><span class="font-bold">event yudisium</span>: y/n *)</li>
        <li class="text-[#E62129]"><span class="font-bold">event survei</span>: y/n *)</li>
        <li class="text-[#E62129]"><span class="font-bold">event dosen</span>: y/n *)</li>
        <li class="text-[#E62129]"><span class="font-bold">status</span>: active/inactive *)</li>
        
        <li class="text-[#E62129]"><br> *) data perlu diisi, jika tidak diisi salah satu kolom pada baris, data dianggap tidak valid dan data pada baris bersangkutan tidak akan tersimpan</li>
      </ul>
    </div>
  </x-white-box>
  <x-modal.container-pure-js id="modalKonfirmasiUnggah">
    <x-slot name="header">
      <span class="text-xl font-bold leading-7">Tunggu Sebentar</span>
      <img src="{{ asset('assets/icon-caution.svg')}}" alt="icon-caution">
    </x-slot>
    <x-slot name="body">
      <div>Apakah Anda yakin untuk mengunggah event akademik dari file ini?</div>
    </x-slot>
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
@endsection
