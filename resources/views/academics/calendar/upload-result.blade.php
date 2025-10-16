@extends('layouts.main')

@section('title', 'Kalender Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Lihat Event Kalender Akademik</div>
@endsection

@section('content')
  <x-title-page :title="'Unggah Event Kalender Akademik'" />
  <x-button.back :href="route('calendar.upload', ['id' => $id])">Unggah Event</x-button.back>
  <x-white-box :class="''">
    <div class="flex items-center">
      <x-title-page :title="'Impor Event Kalender Akademik'" />
      <img src="{{ asset('assets/base/icon-caution.svg')}}" alt="caution-icon" class="h-[1.5em] w-auto">
    </div>
    <x-table :variant="'old'" :isHaveTitle="true" :tableTitle="'Event Kalender Akademik'">
      <x-table-head :variant="'old'">
        <x-table-row :variant="'old'">
          <x-table-header :variant="'old'">Nama Event</x-table-header>
          <x-table-header :variant="'old'">Tanggal Mulai</x-table-header>
          <x-table-header :variant="'old'">Tanggal Selesai</x-table-header>
        </x-table-row>
      </x-table-head>
      <tbody>
        @foreach($data as $d)
          <x-table-row :variant="'old'">
              <x-table-cell :variant="'old'">{{$d['name_event']}}</x-table-cell>
              <x-table-cell :variant="'old'">{{ formatDateTime($d['tanggal_mulai']) }}</x-table-cell>
              <x-table-cell :variant="'old'">{{ formatDateTime($d['tanggal_selesai']) }}</x-table-cell>
          </x-table-row>
          @endforeach
      </tbody>
    </x-table>
    <div class="flex items-center justify-end gap-3 w-full p-4">
      <x-button.secondary :href="route('calendar.upload', ['id' => $id])">Batal</x-button.secondary>
      <x-button.primary
        onclick="
          document.getElementById('modalKonfirmasiUpload').classList.add('flex');
          document.getElementById('modalKonfirmasiUpload').classList.remove('hidden');
        "
      >
        Simpan
      </x-button.primary>
    </div>
    <form action="{{route('study.save-upload', ['id' => $id])}}" method="POST">
      @csrf
      @foreach($data as $index => $event)
        <input type="hidden" name="data[{{$index}}][name_event]" value="{{$event['name_event']}}">
        <input type="hidden" name="data[{{$index}}][tanggal_mulai]" value="{{$event['tanggal_mulai']}}">
        <input type="hidden" name="data[{{$index}}][tanggal_selesai]" value="{{$event['tanggal_selesai']}}">
      @endforeach
      <x-modal.container-pure-js id="modalKonfirmasiUpload">
        <x-slot name="header">
          <span class="text-lg-bd">Tunggu Sebentar</span>
          <img src="{{ asset('assets/icon-caution.svg')}}" alt="icon-caution">
        </x-slot>
        <x-slot name="body">
          <div>Apakah anda yakin untuk menyimpan Event Kalender Akademik dari (csv/xlsx)?</div>
        </x-slot>
        <x-slot name="footer">
          <x-button.secondary
            onclick="
              document.getElementById('modalKonfirmasiUpload').removeAttribute('data-id');
              document.getElementById('modalKonfirmasiUpload').classList.add('hidden');
              document.getElementById('modalKonfirmasiUpload').classList.remove('flex');
            "
          >
            Tidak
          </x-button.secondary>
          <x-button.primary type="submit">Ya, Simpan</x-button.primary>
        </x-slot>
      </x-modal.container-pure-js>
    </form>
  </x-white-box>
@endsection