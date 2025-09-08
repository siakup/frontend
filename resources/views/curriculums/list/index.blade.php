@extends('layouts.main')

@section('title', 'Daftar Kurikulum')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Daftar Kurikulum</div>
@endsection

@section('css')
  <style>
    .card-header.option-list {
        justify-content: left;
    }
    .center {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 24px;
    }
    .center .btn-icon {
        display: flex;
        align-items: center;
        justify-items: center;
        text-decoration: none;
        gap: 2px;
        font-size: 12px;
        width: max-content;
    }
    .center .btn-delete-periode-academic {
        color: #8C8C8C;
    }
    .center .btn-view-periode-academic {
        color: #262626;
    }
    .center .btn-edit-periode-academic {
        color: #E62129;
    }
    .sub-title {
      padding: 10px 20px !important;
    }
  </style>
@endsection

@section('javascript')
<meta name="csrf-token" content="{{ csrf_token() }}">
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('modalKonfirmasiHapus-btnSimpan').addEventListener('click', function() {
         const dataId = document.getElementById('modalKonfirmasiHapus').getAttribute('data-id');
         const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
         document.getElementById('modalKonfirmasiHapus').removeAttribute('data-id');
          document.getElementById('modalKonfirmasiHapus').style.display = 'none';
          successToast('Berhasil dihapus');
          setTimeout(() => {
            window.location.href = "{{route('curriculum.list')}}"
          }, 5000);
        //  $.ajax({
        //      url: "{{ route('academics-event.delete', ['id' => ':id']) }}".replace(':id',
        //          id),
        //      method: 'DELETE',
        //      headers: {
        //          'X-CSRF-TOKEN': csrfToken,
        //          'X-Requested-With': 'XMLHttpRequest'
        //      },
        //      success: function(response) {
        //          document.getElementById('modalKonfirmasiSimpan').removeAttribute(
        //              'data-id');
        //          document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
        //          successToast('Berhasil dihapus');
        //          setTimeout(() => {
        //              window.location.href =
        //                  "{{ route('academics-event.index') }}";
        //          }, 5000);
        //      },
        //      error: function() {
        //          $('tbody').html(
        //              '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
        //          );
        //      }
        //  });
      });
    });
  </script>
  @include('partials.success-notification-modal', ['route' => 'curriculum.list'])
@endsection

@section('content')
  <div class="page-header">
    <div class="page-title-text">Kurikulum</div>
  </div>
  <div class="academics-layout">
    @include('curriculums.layout.navbar-curriculum')
    <div class="academics-slicing-content content-card">
      <x-typography variant="heading-h6" class="mb-2 p-[20px]">
        Daftar Kurikulum - {{array_values(array_filter($programStudiList, function($item) use($id_prodi) { return $item->id == $id_prodi; }))[0]->nama}}
      </x-typography>
      <div class="card-header option-list">
        <div class="card-header center" id="CampusProgramSection">
            <div class="page-title-text sub-title">Program Perkuliahan</div>
            @include('partials.dropdown-filter', [
              'buttonId' => 'sortButtonProgramPerkuliahan',
              'dropdownId' => 'sortProgramPerkuliahan',
              'dropdownItem' => array_column($programPerkuliahanList, 'name', 'name'),
              'label' =>  $id_program ? array_values(array_filter($programPerkuliahanList, function($item) use($id_program) { return $item->name == urldecode($id_program); }))[0]->name : "Semua",
              'url' => route('curriculum.list'),
              'imgSrc' => asset('assets/active/icon-arrow-down.svg'),
              'dropdownClass' => '!top-[25.2%] !left-[32.4%]',
              'isIconCanRotate' => true,
              'imgInvertSrc' => asset('assets/active/icon-arrow-up.svg'),
              'queryParameter' => 'program_perkuliahan'
            ])
        </div>
        <div class="card-header center" id="CampusProgramSection">
            <div class="page-title-text sub-title">Program Studi</div>
            @include('partials.dropdown-filter', [
              'buttonId' => 'sortButtonProgramStudi',
              'dropdownId' => 'sortProgramStudi',
              'dropdownItem' => array_column($programStudiList, 'id', 'nama'),
              'label' =>  array_values(array_filter($programStudiList, function($item) use($id_prodi) { return $item->id == $id_prodi; }))[0]->nama,
              'url' => route('curriculum.list'),
              'imgSrc' => asset('assets/active/icon-arrow-down.svg'),
              'dropdownClass' => '!top-[25.2%] !left-[62.4%]',
              'isIconCanRotate' => true,
              'imgInvertSrc' => asset('assets/active/icon-arrow-up.svg'),
              'queryParameter' => 'program_studi'
            ])
        </div>
      </div>
      <x-container class="border-none">
        <div class="flex flex-col gap-5">
          <x-table>
              <x-table-head>
                  <x-table-row>
                      <x-table-header class="cursor-pointer">
                          Nama
                      </x-table-header>
                      <x-table-header class="cursor-pointer">
                          Program Perkuliahan
                      </x-table-header>
                      <x-table-header class="cursor-pointer">
                          Deskripsi
                      </x-table-header>
                      <x-table-header class="cursor-pointer">
                          Total SKS
                      </x-table-header>
                      <x-table-header>Status</x-table-header>
                      <x-table-header>Aksi</x-table-header>
                  </x-table-row>
              </x-table-head>
              <x-table-body>
                  @forelse ($data as $d)
                      <x-table-row>
                          <x-table-cell>{{ $d->nama_kurikulum }}</x-table-cell>
                          <x-table-cell class="{{
                              $d->perkuliahan == 'Double Degree' ? 'bg-[#E5EDAB]' :
                              ($d->perkuliahan == 'International Class' ? 'bg-[#99D8FF]' :
                              ($d->perkuliahan == 'Reguler' ? 'bg-[#FBDADB]' : 'bg-[#FEF3C0]'))
                          }}"
                          >{{ $d->perkuliahan }}</x-table-cell>
                          <x-table-cell>{{ $d->deskripsi }}</x-table-cell>
                          <x-table-cell>{{ $d->sks_total }}</x-table-cell>
                          <x-table-cell>
                            @if ($d->status === 'active')
                                <span class="badge badge-active" style="min-width:max-content">Aktif</span>
                            @else
                                <span class="badge badge-inactive !border-none" style="min-width:max-content">Tidak Aktif</span>
                            @endif
                          </x-table-cell>
                          <x-table-cell>
                            <div class="center">
                              <a href="{{route('curriculum.list.view', ['id' => $d->id])}}" type="button" class="btn-icon btn-view-periode-academic"
                                  data-periode-akademik="" title="Lihat">
                                  <img src="{{ asset('assets/icon-search.svg') }}" alt="Lihat">
                                  <span>Lihat</span>
                            </a>
                              <a class="btn-icon btn-edit-periode-academic" title="Ubah"
                                  href="{{route('curriculum.list.edit', ['id' => $d->id])}}"
                                  style="text-decoration: none; color: inherit;">
                                  <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit">
                                  <span style="color: #E62129">Ubah</span>
                              </a>
                              <button type="button" class="btn-icon btn-delete" data-id="{{$d->id}}" title="Hapus">
                                  <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus">
                                  <span class="text-[#8C8C8C]">Hapus</span>
                              </button>
                            </div>
                          </x-table-cell>
                      </x-table-row>
                  @empty
                      <x-table-row>
                          <x-table-cell colspan="6" class="text-center py-4">
                              Tidak ada data ditemukan
                          </x-table-cell>
                      </x-table-row>
                  @endforelse
              </x-table-body>
          </x-table>
        </div>
      </x-container>
      <div class="right">
          <a href="{{route('curriculum.list.create', ['program_studi' => $id_prodi])}}" class="button button-outline">Tambah Kurikulum</a>
      </div>
    </div>
    @include('partials.modal', [
      'modalId' => 'modalKonfirmasiHapus',
      'modalTitle' => 'Hapus Daftar kurikulum',
      'modalIcon' => asset('assets/icon-delete-gray-800.svg'),
      'modalMessage' => 'Apakah Anda yakin ingin menghapus kurikulum ini?',
      'triggerButton' => 'btn-delete',
      'cancelButtonLabel' => 'Batal',
      'actionButtonLabel' => 'Hapus'
    ]);
  </div>
@endsection
