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
    .modal-custom-content {
        max-width: 600px;
        z-index: 2;
        align-items: center;
        gap: 16px;
        align-self: auto;
    }
    .modal-custom {
        align-items: start;
    }
    @media (max-width: 900px) {
        .modal-custom-content {
            width: 90vw;
            min-width: unset;
            max-width: 98vw;
            padding: 16px;
        }
        .modal-custom-title {
            font-size: 18px;
        }
    }
  </style>
@endsection

@section('javascript')
<meta name="csrf-token" content="{{ csrf_token() }}">
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.addEventListener('click', function(e) {
          const btn = e.target.closest('.btn-delete');
          if (btn) {
              const idEvent = btn.getAttribute('data-id');
              document.getElementById('modalKonfirmasiSimpan').setAttribute('data-id', idEvent);
              document.getElementById('modalKonfirmasiSimpan').style.display = 'flex';
          }
      });

      document.getElementById('btnCekKembali').addEventListener('click', function() {
          document.getElementById('modalKonfirmasiSimpan').removeAttribute('data-id');
          document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
      });

      document.getElementById('btnSimpan').addEventListener('click', function() {
         const dataId = document.getElementById('modalKonfirmasiSimpan').getAttribute('data-id');
         const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
         document.getElementById('modalKonfirmasiSimpan').removeAttribute(
              'data-id');
          document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
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
  @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            successToast("{{ session('success') ?? 'Berhasil disimpan' }}");
            setTimeout(() => {}, 3000);
        })
    </script>
  @endif
@endsection

@section('content')
  <div class="page-header">
    <div class="page-title-text">Kurikulum</div>
  </div>
  <div class="academics-layout">
    @include('curriculums.layout.navbar-curriculum')
    <div class="academics-slicing-content content-card">
      <x-typography variant="heading-h6" class="mb-2 p-[20px]">
        Daftar Kurikulum - Teknik Kimia
      </x-typography>
      <div class="card-header option-list">
        <div class="card-header center" id="CampusProgramSection">
            <div class="page-title-text sub-title">Program Perkuliahan</div>
            @include('partials.dropdown-filter', [
              'buttonId' => 'sortButtonProgramPerkuliahan',
              'dropdownId' => 'sortProgramPerkuliahan',
              'dropdownItem' => array_column($programPerkuliahanList, 'id', 'nama'),
              'label' =>  $id_program ? array_values(array_filter($programPerkuliahanList, function($item) use($id_program) { return $item->id == $id_program; }))[0]->nama : "Semua",
              'url' => route('curriculum.list'),
              'imgSrc' => asset('assets/active/icon-arrow-down.svg'),
              'dropdownClass' => '!top-[16.2%] !left-[34.2%]',
              'isIconCanRotate' => true,
              'imgInvertSrc' => asset('assets/active/icon-arrow-up.svg')
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
                          <x-table-cell>{{ $d['nama'] }}</x-table-cell>
                          <x-table-cell class="{{ 
                              $d['program_perkuliahan'] == 'Double Degree' ? 'bg-[#E5EDAB]' : 
                              ($d['program_perkuliahan'] == 'International' ? 'bg-[#99D8FF]' : 
                              ($d['program_perkuliahan'] == 'Reguler' ? 'bg-[#FBDADB]' : 'bg-[#FEF3C0]'))
                          }}"
                          >{{ $d['program_perkuliahan'] }}</x-table-cell>
                          <x-table-cell>{{ $d['deskripsi'] }}</x-table-cell>
                          <x-table-cell>{{ $d['total_sks'] }}</x-table-cell>
                          <x-table-cell>
                            @if ($d['status'] === 'active')
                                <span class="badge badge-active" style="min-width:max-content">Aktif</span>
                            @else
                                <span class="badge badge-inactive !border-none" style="min-width:max-content">Tidak Aktif</span>
                            @endif
                          </x-table-cell>
                          <x-table-cell>
                            <div class="center">
                              <a href="{{route('curriculum.list.view', ['id' => $d['id']])}}" type="button" class="btn-icon btn-view-periode-academic"
                                  data-periode-akademik="" title="Lihat">
                                  <img src="{{ asset('assets/icon-search.svg') }}" alt="Lihat">
                                  <span>Lihat</span>
                            </a>
                              <a class="btn-icon btn-edit-periode-academic" title="Ubah"
                                  href="{{route('curriculum.list.edit', ['id' => $d['id']])}}"
                                  style="text-decoration: none; color: inherit;">
                                  <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit">
                                  <span style="color: #E62129">Ubah</span>
                              </a>
                              <button type="button" class="btn-icon btn-delete" data-id="{{$d['id']}}" title="Hapus">
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
          <a href="{{route('curriculum.list.create')}}" class="button button-outline">Tambah Kurikulum</a>
      </div>
    </div>
    <div id="modalKonfirmasiSimpan" class="modal-custom" style="display:none;">
        <div class="modal-custom-backdrop"></div>
        <div class="modal-custom-content bg-white">
            <div class="modal-custom-header">
                <span class="text-lg-bd">Hapus Daftar Kurikulum</span>
                <img src="{{ asset('assets/icon-delete-gray-800.svg') }}" alt="ikon peringatan">
            </div>
            <div class="modal-custom-body">
                <div>Apakah anda yakin ingin menghapus kurikulum ini?</div>
            </div>
            <div class="modal-custom-footer w-full">
                <button type="button" class="button button-clean !w-full" id="btnCekKembali">Batal</button>
                <button type="submit" class="button button-outline !w-full" id="btnSimpan">Hapus</button>
            </div>
        </div>
    </div>
  </div>
@endsection