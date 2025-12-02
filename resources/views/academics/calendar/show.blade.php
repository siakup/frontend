@extends('layouts.main')

@section('title', 'Kalender Akademik')

@section('breadcrumbs')
  <div class="breadcrumb-item active">Lihat Event Kalender Akademik</div>
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
@endsection

@section('javascript')
  <script src="{{ asset('js/plugins/flatpckr.js') }}"></script>
  <script src="{{ asset('js/plugins/flatpckr-id.js') }}"></script>
  <script src="{{ asset('js/custom/calendar-academic.js')}}"></script>
@endsection

@include('partials.success-notification-modal', ['route' => route('calendar.show', ['id' => $id])])
@section('content')
  @include('academics.calendar.create', ['id' => $id, 'id_program' => $id_program, 'id_prodi' => $id_prodi]) 
  @include('academics.calendar.edit', ['id' => $id, 'data' => $data])
  <x-container.container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">
      Lihat Event Kalender Akademik - Universitas Pertamina - Periode Akademik
      {{
        $period->tahun.' - '
        .$period->semester.' '
        .($period->semester == 1 
          ? 'Ganjil' 
          : (
              $period->semester == 2 
                ? 'Genap' 
                : 'Pendek'
            )
        )
      }}
    </x-typography>
    <x-button.back :href="route('calendar.index')">Kalender Akademik</x-button.back>
    <x-container.container :class="'flex flex-col gap-4'">
      <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center !mx-0 !justify-start z-10 !px-0">
        <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center !mx-0 !px-0 !w-max" id="CampusProgramSection">
          <x-typography :variant="'body-medium-bold'">Program Perkuliahan</x-typography>
          <x-form.dropdown 
            :buttonId="'sortButtonCampus'"
            :dropdownId="'sortCampus'"
            :label="
              count(
                array_filter(
                  $programPerkuliahanList, 
                  function($item) use($id_program) { 
                    return $item['name'] == urldecode($id_program); 
                  }
                )
              ) > 0 
                ? array_values(
                    array_filter(
                      $programPerkuliahanList, 
                      function($item) use($id_program) { 
                        return $item['name'] == urldecode($id_program); 
                      }
                    )
                  )[0]['name']
                : ''
            "
            :imgSrc="asset('assets/active/icon-arrow-down.svg')"
            :isIconCanRotate="true"
            :isOptionRedirectableToURLQueryParameter="true"
            :queryParameter="'program_perkuliahan'"
            :url="route('calendar.show', ['id' => $id])"
            :dropdownItem="array_column($programPerkuliahanList, 'name', 'name')"
          />
        </x-container>
        <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center !mx-0 !w-max !px-0" id="StudyProgramSection">
          <x-typography :variant="'body-medium-bold'">Program Studi</x-typography>
          <x-form.dropdown 
            :buttonId="'sortButtonStudyProgram'"
            :dropdownId="'sortStudyProgram'"
            :label="
            count(
              array_filter(
                $programStudiList, 
                function($item) use($id_prodi) { 
                  return $item->id == $id_prodi; 
                }
              )
            ) > 0 
              ? array_values(
                array_filter(
                  $programStudiList, 
                  function($item) use($id_prodi) { 
                    return $item->id == $id_prodi; 
                  }
                )
              )[0]->nama 
              : ''
            "
            :imgSrc="asset('assets/active/icon-arrow-down.svg')"
            :isIconCanRotate="true"
            :isOptionRedirectableToURLQueryParameter="true"
            :queryParameter="'program_studi'"
            :url="route('calendar.show', ['id' => $id])"
            :dropdownItem="array_column($programStudiList, 'id', 'nama')"
          />
        </x-container>
      </x-container>
      <x-table.index :variant="'old'" :isHaveTitle="true" :tableTitle="'Event Kalender Akademik'">
        <x-slot name="tableTitleSlot">
          <x-container.container :variant="'content-wrapper'">
            <x-typography :variant="'body-medium-bold'" class="text-center">Event Kalender Akademik</x-typography>
          </x-container>
        </x-slot>
        <x-table.head :variant="'old'">
          <x-table.row :variant="'old'">
              <x-table.header-cell :variant="'old'">Nama Event</x-table.header-cell>
              <x-table.header-cell :variant="'old'">Tanggal Mulai</x-table.header-cell>
              <x-table.header-cell :variant="'old'">Tanggal Selesai</x-table.header-cell>
              <x-table.header-cell :variant="'old'">Aksi</x-table.header-cell>
          </x-table.row>
        </x-table.head>
        <tbody>
          @foreach ($data as $d)
            <x-table.row :variant="'old'">
              <x-table.cell :variant="'old'">{{ $d->nama_event }}</x-table.cell>
              <x-table.cell :variant="'old'">{{ formatDateTime($d->tanggal_awal) }}</x-table.cell>
              <x-table.cell :variant="'old'">{{ formatDateTime($d->tanggal_akhir) }}</x-table.cell>
              <x-table.cell :variant="'old'">
                <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center justify-center gap-6">
                  <x-button.base 
                    class="text-[#E62129] scale-75 !min-w-max"
                    data-id="{{$d->id}}"
                    onclick='onClickShowEditModal(this, {{json_encode($data)}})'
                    :icon="asset('assets/icon-edit.svg')"
                  >
                    Ubah
                  </x-button.base>
                  <x-button.base 
                    class="text-[#8C8C8C] scale-75 !min-w-max"
                    data-id="{{$d->id}}"
                    :icon="asset('assets/icon-delete-gray-600.svg')"
                    onclick="onClickShowConfirmationDeleteEvent(this)"
                  >
                    Hapus
                  </x-button.base>
                  <x-button.base
                    class="text-black scale-75 !min-w-max"
                    :icon="asset('assets/icon-sync.svg')"
                  >
                    Sync
                  </x-button.base>
                </x-container>
              </x-table.cell>
            </x-table.row>
          @endforeach
        </tbody>
      </x-table.index>
      <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center justify-between !p-0">
        <x-button.secondary :href="route('calendar.index')">Kembali</x-button.secondary>
        <x-container.container :variant="'content-wrapper'" class="flex flex-row !w-max !px-0 !mx-0 items-center gap-3">
          <x-button.secondary 
            :icon="asset('assets/icon-upload-red-500.svg')"
            :iconPosition="'right'"
            :href="route('calendar.upload', ['id' => $id, 'program_studi' => $id_prodi, 'program_perkuliahan' => $id_program])"
          >
            Impor Event Kalender Akademik
          </x-button.secondary>
          <x-button.primary 
            onclick="
              document.getElementById('modalAddEvent').classList.add('flex');
              document.getElementById('modalAddEvent').classList.remove('hidden');
            "
          >
            Tambah Event
          </x-button.primary>
        </x-container>
      </x-container>
      <x-modal.container-pure-js id="modalKonfirmasiHapus">
        <x-slot name="header">
          <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
            <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Hapus Event Kalender Akademik</x-typography>
            <x-icon :iconUrl="asset('assets/icon-delete-gray-800.svg')" :class="'w-8 h-8'" />
          </x-container>
        </x-slot>
        <x-slot name="body">Apakah Anda yakin ingin menghapus event kalender akademik ini?</x-slot>
        <x-slot name="footer">
          <x-button.secondary 
            onclick="
              document.getElementById('modalKonfirmasiHapus').classList.add('hidden');
              document.getElementById('modalKonfirmasiHapus').classList.remove('flex');
            "
          >
            Batal
          </x-button.secondary>
          <x-button.primary 
            onclick="
              const id = this.parentElement.parentElement.parentElement.getAttribute('data-id');
              onDeleteEvent(
                '{{ route('calendar.delete', ['id' => 'ID_REPLACE']) }}'.replace('ID_REPLACE', id),
                '{{ route('calendar.show', ['id' => 'ID_REPLACE']) }}'.replace('ID_REPLACE', '{{$id}}')
              );
            "
          >
            Hapus
          </x-button.primary>
        </x-slot>
      </x-modal.container-pure-js>
    </x-container>
  </x-container>
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
