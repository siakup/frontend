@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('css')
<style>
  .center {
    display: flex;
    align-items: center;
    gap: 0px;
  }

  .center * {
    display: flex; 
    align-items: center;
    justify-items: center;
    text-decoration: none;
    gap: 2px;
    font-size: 10px;
  }

  .center .btn-delete-event-academic {
    color: #8C8C8C;
  }

  .center .btn-view-event-academic {
    color: #262626;
  }

  .center .btn-edit-event-academic {
    color: #E62129;
  }

  .modal-custom {
      position: fixed;
      inset: 0;
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
  }
  .modal-custom-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.25); 
      z-index: 1;
  }
  .modal-custom-content {
      position: relative;
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.12);
      /* padding: 32px 32px 24px 32px; */
      width: 40vw; 
      min-width: 340px;
      max-width: 600px;
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 16px;
  }
  .modal-custom-header {
      border-radius: 12px 12px 0px 0px;
      border: 1px solid var(--Surface-Border-Primary, #D9D9D9);
      background: var(--Background-Disable-White, #F5F5F5);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      align-self: stretch;
  }
  .modal-custom-header span {
    margin-right: auto;
    text-align: center;
    width: 100%;
  }
  .modal-custom-header img {
    margin-left: auto;
  }
  .modal-custom-footer {
      display: flex;
      justify-content: flex-start;
  }
  /* Custom dropdown style for modal select */
  .modal-custom-content select.form-control {
      width: 100%;
      padding: 10px 36px 10px 16px;
      border: 1px solid var(--Surface-Border-Secondary, #BFBFBF);
      border-radius: 8px;
      font-family: Poppins;
      font-size: 14px;
      font-weight: 400;
      color: var(--Surface-Border-Secondary, #BFBFBF); /* grey for placeholder */
      background: var(--Neutral-Gray-50, #FFF) url('/icons/icon-arrow-down-grey-24.svg') no-repeat right 16px center/18px 18px;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      box-sizing: border-box;
      outline: none;
      transition: border 0.2s;
      height: 40px;
  }
  .modal-custom-content select.form-control:focus {
      border-color: var(--Red-Red-500, #E62129);
  }
  .modal-custom-content select.form-control option {
      color: #222;
  }
  .modal-custom-content select.form-control option[value=""] {
      color: var(--Surface-Border-Secondary, #BFBFBF) !important;
  }
  .modal-custom-content select.form-control option[disabled][hidden] {
      color: var(--Surface-Border-Secondary, #BFBFBF) !important;
  }
  .modal-custom-content select.form-control:not(:focus):not([value=""]):not(:invalid) {
      color: #222;
  }
  .modal-custom-content select.form-control:focus:not([value=""]):not(:invalid) {
      color: #222;
  }
  /* Highlight selected option in dropdown with red background */
  .modal-custom-content select.form-control option:checked {
      background: var(--Red-Red-500, #E62129) !important;
      color: #fff !important;
  }
  /* Highlight hovered option in dropdown with red background */
  .modal-custom-content select.form-control option:hover {
      background: var(--Red-Red-500, #E62129) !important;
      color: #fff !important;
  }
  @media (max-width: 900px) {
      .modal-custom-content {
          width: 90vw;
          min-width: unset;
          max-width: 98vw;
          padding: 16px;
      }
      .modal-custom-title { font-size: 18px; }
  }
</style>
@endsection

@section('javascript')
<script>
  document.addEventListener('DOMContentLoaded', function () {
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
  
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-delete-event-academic');
        if (btn) {
          const nomorInduk = btn.getAttribute('data-nomor-induk');
          document.getElementById('modalKonfirmasiSimpan').setAttribute('data-nomor-induk', nomorInduk);
          document.getElementById('modalKonfirmasiSimpan').style.display = 'flex';
        }
    });
  
    document.getElementById('btnSimpan').addEventListener('click', function() {
      const id = document.getElementById('modalKonfirmasiSimpan').getAttribute('data-nomor-induk');
    });
  
    document.getElementById('btnCekKembali').addEventListener('click', function() {
      document.getElementById('modalKonfirmasiSimpan').removeAttribute('data-nomor-induk');
      document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
    });
  })
</script>
@endsection

@section('content')
<div class="academics-layout">
  @include('academics.layouts.navbar-academic')
  <div class="academics-slicing-content content-card">
    <div class="academics-menu">
      <button class="button-clean" id="sortButton">
          Upload Event Akademik
          <img src="{{ asset('assets/icon-upload-red-500.svg') }}" alt="Filter">
          <img src="{{ asset('assets/icon-upload-red-500.svg') }}" alt="Filter">
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
                <img src="{{ asset('assets/search-left.svg') }}" alt="search" class="search-icon-right">
                <img src="{{ asset('assets/search-left.svg') }}" alt="search" class="search-icon-right">
                <div class="search-dropdown" id="searchDropdown"></div>
            </div>
        </div>
        <div class="filter-box">
          <button class="button-clean" id="sortButton">
              Urutkan
              <img src="{{ asset('assets/icon-filter.svg') }}" alt="Filter">
              <img src="{{ asset('assets/icon-filter.svg') }}" alt="Filter">
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
            <td class="center">
              <button class="btn-icon btn-view-event-academic" data-nomor-induk="d" title="View" type="button">
                  <img src="{{ asset('assets/icon-search.svg') }}" alt="View">
                  <span>Lihat</span>
              </button>
              <a class="btn-icon" title="Edit" href="{{ route('academics-event.edit', ['id' => 1]) }}">
                  <img src="{{ asset('assets/button-edit.svg') }}" alt="Edit">
              <a class="btn-icon" title="Edit" href="{{ route('academics-event.edit', ['id' => 1]) }}">
                  <img src="{{ asset('assets/button-edit.svg') }}" alt="Edit">
              </a>
              <button class="btn-icon btn-delete-event-academic" data-nomor-induk="d" title="Delete" type="button">
                  <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Delete">
                  <span>Hapus</span>
              </button>
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
  <div id="modalKonfirmasiSimpan" class="modal-custom" style="display:none;">
    <div class="modal-custom-backdrop"></div>
    <div class="modal-custom-content">
      <div class="modal-custom-header">
        <span class="text-lg-bd">Tunggu Sebentar</span>
        <img src="{{ asset('assets/icon-delete-gray-800.svg')}}" alt="ikon peringatan">
      </div>
      <div class="modal-custom-body">
        <div>Apakah anda yakin informasi anda sudah benar?</div>
      </div>
      <div class="modal-custom-footer">
        <button type="button" class="button button-clean" id="btnCekKembali">Cek Kembali</button>
        <button type="submit" class="button button-outline" id="btnSimpan">Ya, Simpan Sekarang</button>
      </div>
    </div>
  </div>
</div>
@endsection