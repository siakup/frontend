@extends('layouts.main')

@section('title', 'Kalender Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kalender Akademik</div>
@endsection

@section('content')
<x-container.container :variant="'content-wrapper'">
  <x-typography :variant="'body-large-semibold'">Kalender Akademik - Universitas Pertamina</x-typography>
  <x-container.container :class="'!gap-3 flex flex-col'">
    <x-typography :variant="'body-medium-bold'">Tahun Akademik 2025 - 2026</x-typography>
    <x-table.index :variant="'old'">
      <x-table.head :variant="'old'">
        <x-table.row :variant="'old'">
          <x-table.header-cell :variant="'old'">Periode Akademik</x-table.header-cell>
          <x-table.header-cell :variant="'old'">Semester</x-table.header-cell>
          <x-table.header-cell :variant="'old'">Tanggal Mulai</x-table.header-cell>
          <x-table.header-cell :variant="'old'">Tanggal Berakhir</x-table.header-cell>
          <x-table.header-cell :variant="'old'">Aksi</x-table.header-cell>
          <x-table.header-cell :variant="'old'">Status</x-table.header-cell>
        </x-table.row>
      </x-table.head>
      <tbody>
          @foreach ($data as $d)
              <x-table.row :variant="'old'">
                  <x-table.cell :variant="'old'">{{ $d->tahun.'-'.$d->semester }}</x-table.cell>
                  <x-table.cell :variant="'old'">
                    {{ 
                      $d->semester === 1 
                        ? 'Ganjil' 
                        : (
                          $d->semester === 2 
                            ? 'Genap' 
                            : 'Pendek'
                        ) 
                    }}
                  </x-table.cell>
                  <x-table.cell class="text-xs" :variant="'old'">
                    {{ formatDateTime($d->tanggal_mulai) }}
                  </x-table.cell>
                  <x-table.cell class="text-xs" :variant="'old'">
                    {{ formatDateTime($d->tanggal_akhir) }}
                  </x-table.cell>
                  <x-table.cell :variant="'old'">
                    <x-button.base
                      :icon="asset('assets/icon-search.svg')"
                      :href="route('calendar.show', ['id' => $d->id])"
                      class="text-[#262626] scale-75"
                    >
                      Lihat
                    </x-button.base>
                  </x-table.cell>
                  <x-table.cell :variant="'old'">
                      @if (new DateTime() >= new DateTime($d->tanggal_mulai) && new DateTime() <= new DateTime($d->tanggal_akhir))
                        <x-badge variant="blue-filled">Sedang berlangsung</x-badge>
                      @endif
                  </x-table.cell>
              </x-table.row>
          @endforeach
      </tbody>
    </x-table.index>
    <div class="flex items-end justify-end">
      <x-button.primary :href="route('calendar.generate')">Generate Riwayat Akademik</x-button.primary>
    </div>
  </x-container>
</x-container>
@endsection
