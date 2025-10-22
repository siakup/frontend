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
  <script>
    function onClickShowConfirmationDeleteEvent(element) {
      const modalKonfirmasiHapus = document.getElementById('modalKonfirmasiHapus');
      modalKonfirmasiHapus.setAttribute('data-id', element.getAttribute('data-id'));
      modalKonfirmasiHapus.classList.add('flex');
      modalKonfirmasiHapus.classList.remove('hidden');
    }

    function onDeleteEvent(element) {
      const id = element.parentElement.parentElement.parentElement.getAttribute('data-id');
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      $.ajax({
        url: "{{ route('calendar.delete', ['id' => 'ID_REPLACE']) }}".replace('ID_REPLACE', id),
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
          document.getElementById('modalKonfirmasiHapus').removeAttribute('data-id');
          document.getElementById('modalKonfirmasiHapus').style.display = 'none';
          successToast('Berhasil dihapus');
          setTimeout(() => {
            window.location.href = "{{ route('calendar.show', ['id' => 'ID_REPLACE']) }}".replace('ID_REPLACE', "{{$id}}");
          }, 5000);
        },
        error: function() {
          $('tbody').html(
            '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
          );
        }
      });
    }
  </script>
@endsection

@include('partials.success-notification-modal', ['route' => route('calendar.show', ['id' => $id])])
@section('content')
  @include('academics.calendar.create', ['id' => $id, 'id_program' => $id_program, 'id_prodi' => $id_prodi]) 
  @include('academics.calendar.edit', ['id' => $id, 'data' => $data])
  <x-title-page 
    :title="'Lihat Event Kalender Akademik - Universitas Pertamina - Periode Akademik '
      .$period->tahun.' - '
      .$period->semester.' '
      .($period->semester == 1 
        ? 'Ganjil' 
        : (
            $period->semester == 2 
              ? 'Genap' 
              : 'Pendek'
          )
      )" 
  />
  <x-button.back :href="route('calendar.index')">Kalender Akademik</x-button.back>
  <x-white-box :class="''">
    <div class="flex items-center z-10 p-2.5 w-full">
      <div class="flex items-center" id="CampusProgramSection">
        <x-title-page :title="'Program Perkuliahan'" />
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
      </div>
      <div class="flex items-center" id="StudyProgramSection">
        <x-title-page :title="'Program Studi'" />
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
      </div>
    </div>
    <x-table :variant="'old'" :isHaveTitle="true" :tableTitle="'Event Kalender Akademik'">
      <x-table-head :variant="'old'">
        <x-table-row :variant="'old'">
            <x-table-header :variant="'old'">Nama Event</x-table-header>
            <x-table-header :variant="'old'">Tanggal Mulai</x-table-header>
            <x-table-header :variant="'old'">Tanggal Selesai</x-table-header>
            <x-table-header :variant="'old'">Aksi</x-table-header>
        </x-table-row>
      </x-table-head>
      <tbody>
        @foreach ($data as $d)
          <x-table-row :variant="'old'">
            <x-table-cell :variant="'old'">{{ $d->nama_event }}</x-table-cell>
            <x-table-cell :variant="'old'">{{ formatDateTime($d->tanggal_awal) }}</x-table-cell>
            <x-table-cell :variant="'old'">{{ formatDateTime($d->tanggal_akhir) }}</x-table-cell>
            <x-table-cell :variant="'old'">
              <div class="center flex items-center justify-center gap-6">
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
              </div>
            </x-table-cell>
          </x-table-row>
        @endforeach
      </tbody>
    </x-table>
    <div class="flex items-center justify-between p-4">
      <a href="{{ route('calendar.index') }}" class="button-clean">Kembali</a>
      <div class="flex items-center gap-3">
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
      </div>
    </div>
    <x-modal.container-pure-js id="modalKonfirmasiHapus">
      <x-slot name="header">
        <span class="text-lg-bd">Hapus Event Kalender Akademik</span>
        <img src="{{asset('assets/icon-delete-gray-800.svg')}}" alt="ikon-hapus" />
      </x-slot>
      <x-slot name="body">
        Apakah Anda yakin ingin menghapus event kalender akademik ini?
      </x-slot>
      <x-slot name="footer">
        <x-button.secondary 
          onclick="
            document.getElementById('modalKonfirmasiHapus').classList.add('hidden');
            document.getElementById('modalKonfirmasiHapus').classList.remove('flex');
          "
        >
          Batal
        </x-button.secondary>
        <x-button.primary onclick="onDeleteEvent(this)">
          Hapus
        </x-button.primary>
      </x-slot>
    </x-modal.container-pure-js>
  </x-white-box>
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
