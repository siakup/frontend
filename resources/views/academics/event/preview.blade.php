@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('content')
  <x-container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Unggah Event Akademik</x-typography>
    <x-button.back :href="route('academics-event.index')">Event Akademik</x-button.back>
    <x-container :class="'flex flex-col items-stretch relative !z-0 gap-4'">
      <x-container :variant="'content-wrapper'" class="flex flex-row items-center !px-0">
        <x-typography :variant="'body-medium-bold'">Impor Event Akademik</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-auto h-[1.5em]'" />
      </x-container>
      <form action="{{ route('academics-event.store-upload') }}" method="POST">
          @csrf
          <x-table :variant="'old'">
            <x-table-head :variant="'old'">
              <x-table-row :variant="'old'">
                <x-table-header :variant="'old'">Nama Event</x-table-header>
                <x-table-header :variant="'old'">Event Nilai</x-table-header>
                <x-table-header :variant="'old'">Event IRS</x-table-header>
                <x-table-header :variant="'old'">Event Lulus</x-table-header>
                <x-table-header :variant="'old'">Event Registrasi</x-table-header>
                <x-table-header :variant="'old'">Event Yudisium</x-table-header>
                <x-table-header :variant="'old'">Event Survei</x-table-header>
                <x-table-header :variant="'old'">Event Dosen</x-table-header>
                <x-table-header :variant="'old'">Status</x-table-header>
              </x-table-row>
            </x-table-head>
            <tbody>
              @foreach($datas as $row)
                <x-table-row :variant="'old'">
                  @foreach($row as $index => $cell)
                      @if ($loop->last)
                      <x-table-cell :variant="'old'">
                          <input type="hidden" name="data[{{ $loop->parent->index }}][{{ $index }}]" value="{{ $cell }}">
                          @if ($cell === 'active')
                            <x-badge class="bg-[#D0DE68]">Aktif</x-badge>
                          @else
                            <x-badge class="bg-[#FAFBEE] text-[#98A725] leading-5 border-[1px] border-[#D0DE68]">Tidak Aktif</x-badge>
                          @endif
                      </x-table-cell>
                      @else
                      <x-table-cell :variant="'old'">
                          <input type="hidden" name="data[{{ $loop->parent->index }}][{{ $index }}]" value="{{ $cell }}">
                          {{ $cell === 'y' ? 'Ya' : ($cell === 'n' ?'Tidak' : $cell) }}
                      </x-table-cell>
                      @endif
                  @endforeach
                </x-table-row>
              @endforeach
            </tbody>
          </x-table>
          <div class="flex gap-5 justify-end m-5">
            <x-button.secondary 
              onclick="
                document.getElementById('modalBatalUnggah').classList.add('flex');
                document.getElementById('modalBatalUnggah').classList.remove('hidden');
              "
            >
              Batal
            </x-button.secondary>
            <x-button.primary type="submit">Simpan Event Akademik</x-button.primary>
          </div>
      </form>
    </x-container>
  </x-container>
  <x-modal.container-pure-js id="modalBatalUnggah">
    <x-slot name="header">
      <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Batalkan impor data (csv/xlsx)?</x-typography>
        <x-icon :iconUrl="asset('assets/icon-caution.svg')" :class="'w-8 h-8'" />
      </x-container>
    </x-slot>
    <x-slot name="body">Apakah Anda yakin ingin membatalkan unggah event akademik?</x-slot>
    <x-slot name="footer">
      <x-button.secondary
        onclick="
          document.getElementById('modalBatalUnggah').classList.add('hidden');
          document.getElementById('modalBatalUnggah').classList.remove('flex');
        "
      >
        Kembali
      </x-button.secondary>
      <x-button.primary :href="route('academics-event.upload')">Batalkan</x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
@endsection