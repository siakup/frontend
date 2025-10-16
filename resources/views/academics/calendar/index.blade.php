@extends('layouts.main')

@section('title', 'Kalender Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kalender Akademik</div>
@endsection

@section('content')
  <x-title-page :title="'Kalender Akademik - Universitas Pertamina'" />
  <x-white-box :class="''">
    <x-title-page :title="'Tahun Akademik 2025 - 2026'" />
    <x-table :variant="'old'">
      <x-table-head :variant="'old'">
        <x-table-row :variant="'old'">
          <x-table-header :variant="'old'">Periode Akademik</x-table-header>
          <x-table-header :variant="'old'">Semester</x-table-header>
          <x-table-header :variant="'old'">Tanggal Mulai</x-table-header>
          <x-table-header :variant="'old'">Tanggal Berakhir</x-table-header>
          <x-table-header :variant="'old'">Aksi</x-table-header>
          <x-table-header :variant="'old'">Status</x-table-header>
        </x-table-row>
      </x-table-head>
      <tbody>
          @foreach ($data as $d)
              <x-table-row :variant="'old'">
                  <x-table-cell :variant="'old'">{{ $d->tahun.'-'.$d->semester }}</x-table-cell>
                  <x-table-cell :variant="'old'">
                    {{ 
                      $d->semester === 1 
                        ? 'Ganjil' 
                        : (
                          $d->semester === 2 
                            ? 'Genap' 
                            : 'Pendek'
                        ) 
                    }}
                  </x-table-cell>
                  <x-table-cell class="text-xs" :variant="'old'">
                    {{ formatDateTime($d->tanggal_mulai) }}
                  </x-table-cell>
                  <x-table-cell class="text-xs" :variant="'old'">
                    {{ formatDateTime($d->tanggal_akhir) }}
                  </x-table-cell>
                  <x-table-cell :variant="'old'">
                      <div class="flex items-center justify-center gap-6">
                        <x-button.base
                          :icon="asset('assets/icon-search.svg')"
                          :href="route('calendar.show', ['id' => $d->id])"
                          class="text-[#262626] scale-75"
                        >
                          Lihat
                        </x-button.base>
                      </div>
                  </x-table-cell>
                  <x-table-cell :variant="'old'">
                      @if (new DateTime() >= new DateTime($d->tanggal_mulai) && new DateTime() <= new DateTime($d->tanggal_akhir))
                        <x-badge class="bg-[#0097F5] text-white">Sedang berlangsung</x-badge>
                      @endif
                  </x-table-cell>
              </x-table-row>
          @endforeach
      </tbody>
    </x-table>
    <div class="flex items-end justify-end p-4">
      <x-button.primary :href="route('calendar.generate')">Generate Riwayat Akademik</x-button.primary>
    </div>
  </x-white-box>
@endsection
