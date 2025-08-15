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
    .sort-dropdown {
      top: 16.2% !important;
      left: 34.2% !important;
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const sortBtnCampusProgram = document.querySelector('#sortButton.campus');
      const sortDropdownCampusProgram = document.querySelector('#sortDropdown.campus');
      sortBtnCampusProgram.addEventListener('click', function(e) {
          e.stopPropagation();
          sortDropdownCampusProgram.style.display = (sortDropdownCampusProgram.style.display ===
              'block') ? 'none' : 'block';
          sortBtnCampusProgram.querySelector('img').src = (sortBtnCampusProgram.querySelector('img')
                  .src === "{{ asset('assets/active/icon-arrow-up.svg') }}") ?
              "{{ asset('assets/active/icon-arrow-down.svg') }}" :
              "{{ asset('assets/active/icon-arrow-up.svg') }}";
      });
      sortDropdownCampusProgram.querySelectorAll('.dropdown-item').forEach(item => {
          item.addEventListener('click', function() {
              sortDropdownCampusProgram.querySelectorAll('.dropdown-item').forEach(i => i
                  .classList.remove('active'));
              const url = new URL(window.location.href);
              const sortKey = this.getAttribute('data-sort');
              url.searchParams.set('program_perkuliahan', sortKey);
              window.location.href = url.toString();
          });
      });
      document.addEventListener('click', (e) => {
          const dropdownCampus = e.target.closest('#CampusProgramSection');
          if (dropdownCampus == null) {
              sortDropdownCampusProgram.style.display = 'none'
              sortBtnCampusProgram.querySelector('img').src =
                  "{{ asset('assets/active/icon-arrow-down.svg') }}";
          }
      });
    });
  </script>
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
            <button class="button-clean campus" id="sortButton">
                <span>{{ $id_program ? array_values(array_filter($programPerkuliahanList, function($item) use($id_program) { return $item->id == $id_program; }))[0]->nama : "Semua" }}</span>
                <img src="{{ asset('assets/active/icon-arrow-down.svg') }}" alt="Filter">
            </button>
            <div id="sortDropdown" class="sort-dropdown campus" style="display: none;">
              @foreach($programPerkuliahanList as $programPerkuliahan)
                <div class="dropdown-item" data-sort="{{$programPerkuliahan->id}}">{{$programPerkuliahan->nama}}</div>
              @endforeach
            </div>
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
                                <span class="badge badge-inactive" style="min-width:max-content">Tidak Aktif</span>
                            @endif
                          </x-table-cell>
                          <x-table-cell>
                            <div class="center">
                              <button type="button" class="btn-icon btn-view-periode-academic"
                                  data-periode-akademik="" title="Lihat">
                                  <img src="{{ asset('assets/icon-search.svg') }}" alt="Lihat">
                                  <span>Lihat</span>
                              </button>
                              <a class="btn-icon btn-edit-periode-academic" title="Ubah"
                                  href="{{route('curriculum.list.edit', ['id' => $d['id']])}}"
                                  style="text-decoration: none; color: inherit;">
                                  <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit">
                                  <span style="color: #E62129">Ubah</span>
                              </a>
                              <button type="button" class="btn-icon btn-delete-periode-academic" data-id="" title="Hapus">
                                  <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus">
                                  <span>Hapus</span>
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
  </div>
@endsection