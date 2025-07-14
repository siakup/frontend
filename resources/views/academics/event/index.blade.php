@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('css')

@endsection

@section('javascript')
<script>
  document.addEventListener('click', function(e) {
      const btn = e.target.closest('.btn-view-event-academic');
      if (btn) {
        const nomorInduk = btn.getAttribute('data-nomor-induk');
          // if (nomorInduk) {
              // $.get("{{ route('users.detail') }}", { nomor_induk: nomorInduk }, function(html) {
              //     $('#userDetailModalContainer').html(html);
              //     $('#modalDetailPengguna').show();
              // });
          // }
          $.get("{{ route('academics-event.detail') }}", {  }, function(html) {
              $('#eventDetailModalContainer').html(html);
              $('#modalDetailEvent').show();
          });
      }
  });
</script>
@endsection

@section('content')
<div class="academics-layout">
  @include('academics.layouts.navbar-academic')
  <div class="academics-slicing-content content-card">
    <div class="academics-menu">
      <button class="button-clean" id="sortButton">
          Upload Event Akademik
          <img src="{{ asset('icons/icon-upload-red-500.svg') }}" alt="Filter">
      </button>
      <button class="button-outline" id="sortButton">
          Tambah Periode Akademik
      </button>
    </div>
    <div class="content-card content-card-search">
      <div class="card-header">
        <div class="search-section">
            <div class="search-container">
                <input type="text" placeholder="Nama Event" class="search-filter" id="searchInput" autocomplete="off" value="">
                <img src="{{ asset('icons/search-left.svg') }}" alt="search" class="search-icon-right">
                <div class="search-dropdown" id="searchDropdown"></div>
            </div>
        </div>
        <div class="filter-box">
          <button class="button-clean" id="sortButton">
              Urutkan
              <img src="{{ asset('icons/icon-filter.svg') }}" alt="Filter">
          </button>
          <div id="sortDropdown" class="sort-dropdown" style="display: none;">
              <div class="dropdown-item" data-sort="active">Aktif</div>
              <div class="dropdown-item" data-sort="inactive">Tidak Aktif</div>
              <div class="dropdown-item" data-sort="nama,asc">A-Z</div>
              <div class="dropdown-item" data-sort="nama,desc">Z-A</div>
              <div class="dropdown-item" data-sort="created_at,desc">Terbaru</div>
              <div class="dropdown-item" data-sort="created_at,asc">Terlama</div>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
        <table class="table" id="list-user" style="--table-cols:7">
            <thead>
                <tr>
                    <th>Nama Event</th>
                    <th>Event Nilai</th>
                    <th>Event IRS</th>
                    <th>Event Registrasi</th>
                    <th>Event Yudisium</th>
                    <th>Event Survei</th>
                    <th>Event Dosen</th>
                    <th>Event Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
              <button class="btn-icon btn-view-event-academic" data-nomor-induk="" title="View" type="button">
                  <img src="{{ asset('icons/button-view.svg') }}" alt="View">
              </button>
              <a class="btn-icon" title="Edit" href="{{ route('academics-event.edit', ['id' => 1]) }}">
                  <img src="{{ asset('icons/button-edit.svg') }}" alt="Edit">
              </a>
            </td>
            </tbody>
        </table>
    </div>
  </div>
  @include('partials.pagination', [
    // "currentPage" => $data['pagination']['current_page'],
    "currentPage" =>  1,
    // "lastPage" => $data['pagination']['last_page'],
    "lastPage" => 10,
    // "limit" => $limit,
    "limit" => 5,
    "routes" => route('academics-periode.index')
  ])

  <div id="eventDetailModalContainer"></div>
</div>
@endsection