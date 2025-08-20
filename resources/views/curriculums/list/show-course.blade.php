@extends('layouts.main')

@section('title', Request::routeIs('curriculum.list.view.show-study') ? 'Lihat Mata Kuliah Kurikulum' : 'Ubah Mata Kuliah Kurikulum')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kurikulum</div>
@endsection

@section('css')
<style>
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

<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const courseType = document.querySelector('input[name="jenis_mata_kuliah"]');
    const sortBtnCourseType = document.querySelector('#sortEvent');
    const sortDropdownCourseType = document.querySelector('#Option-Program-Perkuliahan');

    function updateSaveButtonState() {
      const courseTypeFilled = courseType.value.trim() !== '';
      if(courseTypeFilled) {
        document.querySelector('#btnCari').disabled = false;
      } else {
        document.querySelector('#btnCari').disabled = true;
      }
    }
  
    sortBtnCourseType.addEventListener('click', function(e) {
        e.stopPropagation();
        sortDropdownCourseType.style.display = (sortDropdownCourseType.style.display === 'block') ?
            'none' : 'block';
        sortBtnCourseType.querySelector('img').src = (sortBtnCourseType.querySelector('img').src ===
                "{{ asset('assets/icon-arrow-up-black-20.svg') }}") ?
            "{{ asset('assets/icon-arrow-down-grey-20.svg') }}" :
            "{{ asset('assets/icon-arrow-up-black-20.svg') }}";
    });

    document.addEventListener('click', (e) => {
        const dropdownStudy = e.target.closest('#jenis_mata_kuliah');
        if (dropdownStudy == null) {
            sortDropdownCourseType.style.display = 'none'
            sortBtnCourseType.querySelector('img').src =
                "{{ asset('assets/icon-arrow-down-grey-20.svg') }}";
        }
    });

    document.querySelectorAll('#Option-Program-Perkuliahan .dropdown-item').forEach((dropdownItem) => {
        dropdownItem.addEventListener('click', () => {
            const value = dropdownItem.getAttribute('data-event');
            const span = sortBtnCourseType.querySelector('span');
            span.innerHTML = dropdownItem.innerHTML;
            span.style.color = "black";
            courseType.value = value;
            updateSaveButtonState();
        });
    });
    
    document.getElementById('modalKonfirmasiHapus-btnSimpan').addEventListener('click', function() {
       const dataId = document.getElementById('modalKonfirmasiHapus').getAttribute('data-id');
       const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
       document.getElementById('modalKonfirmasiHapus').removeAttribute(
            'data-id');
        document.getElementById('modalKonfirmasiHapus').style.display = 'none';
        successToast('Berhasil dihapus');
        setTimeout(() => {
          window.location.href = "{{route('curriculum.list.edit.show-study', ['id' => $id])}}"
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
  })
</script>

@section('content')
  <div class="page-header">
    @if(Request::routeIs('curriculum.list.view.show-study'))
      <div class="page-title-text">Lihat Daftar Mata Kuliah</div>
    @else
      <div class="page-title-text">Ubah Mata Kuliah</div>
    @endif
  </div>
  @if(Request::routeIs('curriculum.list.view.show-study'))
    <a href="{{ route('curriculum.list.view', ['id' => $id]) }}" class="button-no-outline-left">
        <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Lihat Detail Kurikulum
    </a>
  @else
    <a href="{{ route('curriculum.list.edit', ['id' => $id]) }}" class="button-no-outline-left">
        <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Ubah Kurikulum
    </a>
  @endif
  <div class="content-card">
    <div class="form-title-text">Daftar Mata Kuliah</div>
    <form action="{{Request::routeIs('curriculum.list.view.show-study') ? route('curriculum.list.view.show-study', ['id' => $id]) : route('curriculum.list.edit.show-study', ['id' => $id])}}" method="GET">
      <div class="form-section">
        <div class="form-group">
            <label for="name">Program Perkuliahan</label>
            <div class="filter-box w-full" id="jenis_mata_kuliah">
                <button type="button" class="button-clean input border-[1px] !border-[#BFBFBF] w-full flex items-center justify-between" id="sortEvent">
                    <span id="selectedEventLabel" class="{{Request::routeIs('curriculum.list.view.show-study') && $jenis_mata_kuliah == '' ? 'text-[#8C8C8C]' : 'text-black'}}">{{$jenis_mata_kuliah != '' ? ($jenis_mata_kuliah == 1 ? 'Mata Kuliah Dasar Umum' : 'Mata Kuliah Program Studi'): "Pilih Mata Kuliah"}}</span>
                    <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                </button>
                <div id="Option-Program-Perkuliahan" class="sort-dropdown select !top-[9.8%] !left-[15.2%]" style="display: none;">
                  <div class="dropdown-item" data-event="1">Mata Kuliah Dasar Umum</div>
                  <div class="dropdown-item" data-event="2">Mata Kuliah Program Studi</div>
                </div>
                <input type="hidden" value="{{$jenis_mata_kuliah}}" name="jenis_mata_kuliah">
            </div>
        </div>
        <div class="form-group">
            <label for="Curriculum-Name">Nama Mata Kuliah</label>
            <div class="flex items-center border-[1px] border-[#D9D9D9] rounded-lg w-full">
                <input placeholder="Ketik Mata Kuliah" name="nama" type="text" id="Curriculum-Name" class="!border-transparent focus:outline-none" value="">
                <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
            </div>
        </div>
        <div class="button-group flex w-full justify-end items-stretch">
          <button type="button" class="button button-clean disabled:!bg-white disabled:!border-[#BFBFBF] disabled:!border-[1px] min-w-[151px]" id="btnBatal" @if($jenis_mata_kuliah == '' && $nama_mata_kuliah == '') disabled @endif>Batal</button>
          <button type="submit" class="button button-outline min-w-[151px]" id="btnCari" @if($jenis_mata_kuliah == '' && $nama_mata_kuliah == '') disabled @endif>Cari</button>
        </div>
      </div>
    </form>
    <x-container class="border-none">
        <div class="flex flex-col gap-5">
          <x-table>
              <x-table-head>
                  <x-table-row>
                      <x-table-header class="cursor-pointer">
                          Kode Mata Kuliah
                      </x-table-header>
                      <x-table-header class="cursor-pointer">
                          Nama
                      </x-table-header>
                      <x-table-header class="cursor-pointer">
                          SKS
                      </x-table-header>
                      <x-table-header class="cursor-pointer">
                          Semester
                      </x-table-header>
                      <x-table-header>Jumlah CPL</x-table-header>
                      <x-table-header>Jenis Mata Kuliah</x-table-header>
                      @if(!Request::routeIs('curriculum.list.view.show-study'))
                        <x-table-header>Aksi</x-table-header>
                      @endif
                  </x-table-row>
              </x-table-head>
              <x-table-body>
                  @forelse ($data as $d)
                      <x-table-row>
                          <x-table-cell>{{ $d['kode_mata_kuliah'] }}</x-table-cell>
                          <x-table-cell>{{ $d['nama'] }}</x-table-cell>
                          <x-table-cell>{{ $d['sks'] }}</x-table-cell>
                          <x-table-cell>{{ $d['semester'] }}</x-table-cell>
                          <x-table-cell>{{ $d['jumlah_cpl']}}</x-table-cell>
                          <x-table-cell>{{ $d['jenis_mata_kuliah']}}</x-table-cell>
                          @if(!Request::routeIs('curriculum.list.view.show-study'))
                            <x-table-cell>
                              <div class="center">
                                <a href="{{route('curriculum.list.edit.edit-study', ['id' => $id, 'course_id' => $d['id']])}}" class="btn-icon btn-edit-periode-academic" title="Ubah"
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
                          @endif
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
    @include('partials.modal', [
      'modalId' => 'modalKonfirmasiHapus',
      'modalTitle' => 'Hapus Daftar Mata Kuliah',
      'modalIcon' => asset('assets/icon-delete-gray-800.svg'),
      'modalMessage' => 'Apakah Anda yakin ingin menghapus ini?',
      'triggerButton' => 'btn-delete',
      'cancelButtonLabel' => 'Batal',
      'actionButtonLabel' => 'Hapus'
    ]);
  </div>
  @include('partials.pagination', [
      'currentPage' => 1,
      'lastPage' => 10,
      'limit' => 10,
      'routes' => '',
  ])
@endsection