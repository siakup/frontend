@extends('layouts.main')

@section('title', 'Event Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('css')
<style>
  .center {
    display: flex;
    align-items: center;
    gap: 24px;
  }

  .center * {
    display: flex; 
    align-items: center;
    justify-items: center;
    text-decoration: none;
    gap: 2px;
    font-size: 12px;
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
  .active-lable {
    background-color: #D0DE68;
    border-radius: 2px;
    padding: 2px 27px;
  }

  .inactive-lable {
    background-color: #FAFBEE;
    color: #98A725;
    border-radius: 2px;
    padding: 2px 27px;
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

  .academics-menu {
    display: flex;
    gap: 24px;
    align-items: center;
    margin-bottom: 24px;
  }

  .academics-menu .button-clean,
  .academics-menu .button-outline {
      height: 48px;
      min-height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      font-family: Poppins;
      border-radius: 10px;
      padding: 0 32px;
      box-sizing: border-box;
  }

  .btn-icon span {
    font-family: Poppins;
    font-size: 12px;
    font-weight: 400;
    color: inherit;
  }

  #btnUpload:hover img{
        filter: brightness(0) invert(1);
  }
</style>
@endsection

@section('javascript')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('searchInput');
    const dropdown = document.getElementById('searchDropdown');
    
    // Create loading indicator
    const loadingIndicator = document.createElement('div');
    loadingIndicator.className = 'dropdown-item text-center';
    loadingIndicator.innerHTML = 'Sedang mencari...';

    input.addEventListener('input', function () {
        const keyword = this.value.trim();
        if (keyword.length < 1) {
            dropdown.style.display = 'none';
            return;
        }
        dropdown.innerHTML = '';
        dropdown.appendChild(loadingIndicator);
        dropdown.style.display = 'block';
        $.ajax({
            url: `{{ route('academics-event.index') }}`,
            method: 'GET',
            data: { search: keyword },
            dataType: 'json',
            success: function(data) {
                if (!data.success || !Array.isArray(data.data) || data.data.length === 0) {
                    dropdown.innerHTML = '<div class="dropdown-item text-center">Tidak ada hasil ditemukan</div>';
                    return;
                }
                dropdown.innerHTML = '';
                data.data.forEach(user => {
                    const item = document.createElement('div');
                    item.className = 'dropdown-item';
                    item.textContent = user.username;
                    item.onclick = () => {
                        dropdown.querySelectorAll('.dropdown-item').forEach(i => i.classList.remove('active'));
                        item.classList.add('active');
                        input.value = user.username;
                        dropdown.style.display = 'none';
                        refreshTable(user.username);
                    };
                    dropdown.appendChild(item);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                dropdown.innerHTML = '<div class="dropdown-item text-center text-danger">Terjadi kesalahan, silakan coba lagi</div>';
            }
        });
    });

    function refreshTable(username) {
        $.ajax({
            url: '{{ route('users.index') }}',
            method: 'GET',
            data: { search: username },
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(response) {
                window.location.href = '{{ route('users.index') }}' + '?search=' + encodeURIComponent(username);
            },
            error: function() {
                $('tbody').html('<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>');
            }
        });
    }

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-view-event-academic');
        if (btn) {
          const id = btn.getAttribute('data-id');
            if (id) {
              $.get("{{ route('academics-event.detail') }}", { id: id }, function(html) {
                  $('#eventDetailModalContainer').html(html);
                  $('#modalDetailEvent').show();
              });
            }
        }
    });
  
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-delete-event-academic');
        if (btn) {
          const nomorInduk = btn.getAttribute('data-id');
          document.getElementById('modalKonfirmasiSimpan').setAttribute('data-id', nomorInduk);
          document.getElementById('modalKonfirmasiSimpan').style.display = 'flex';
        }
    });
  
    document.getElementById('btnSimpan').addEventListener('click', function() {
      const id = document.getElementById('modalKonfirmasiSimpan').getAttribute('data-id');
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      $.ajax({
          url: "{{ route('academics-event.delete', ['id' => ':id']) }}".replace(':id', id),
          method: 'DELETE',
          headers: { 
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
          },
          success: function(response) {
            successToast('Berhasil dihapus');
            setTimeout(() => {
              window.location.href = "{{ route('academics-event.index') }}";
            }, 3000);
          },
          error: function() {
              $('tbody').html('<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>');
          }
      });
    });
  
    document.getElementById('btnCekKembali').addEventListener('click', function() {
      document.getElementById('modalKonfirmasiSimpan').removeAttribute('data-id');
      document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
    });

    // sort dropdown
    const sortBtn = document.getElementById('sortButton');
    const sortDropdown = document.getElementById('sortDropdown');

    // Toggle dropdown on button click
    sortBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        sortDropdown.style.display = (sortDropdown.style.display === 'block') ? 'none' : 'block';
    });
  })
</script>

@if(session('success'))
<script>
  document.addEventListener('DOMContentLoaded', function () {
    successToast('Berhasil disimpan');
    setTimeout(() => {
      window.location.href = "{{ route('academics-event.index') }}";
    }, 3000);
  })
</script>
@endif
@endsection

@section('content')
<div class="academics-layout">
  @include('academics.layouts.navbar-academic')
  <div class="academics-slicing-content content-card">

    <div class="academics-menu">
      <a href="{{ route('academics-event.upload') }}" class="button button-clean" id="btnUpload">
        Upload Event Akademik
        <img src="{{ asset('assets/icon-upload-red-500.svg') }}" alt="Upload">
      </a>
      <a href="{{ route('academics-event.create') }}" class="button button-outline">Tambah Event Akademik</a>
    </div>
    <div class="content-card content-card-search">
      <div class="card-header">
        <div class="search-section">
            <div class="search-container">
                <input type="text" placeholder="Nama Event" class="search-filter" id="searchInput" autocomplete="off" value="{{ $search }}">
                <img src="{{ asset('assets/search-left.svg') }}" alt="search" class="search-icon-right">
                <div class="search-dropdown" id="searchDropdown"></div>
            </div>
        </div>
        <div class="filter-box">
          <button class="button-clean" id="sortButton">
              Urutkan
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
                    <th style="width: 50%;">Nama Event</th>
                    <th style="width: 40%;">Event Nilai</th>
                    <th style="width: 40%;">Event IRS</th>
                    <th style="width: 40%;">Event Registrasi</th>
                    <th style="width: 40%;">Event Yudisium</th>
                    <th style="width: 40%;">Event Survei</th>
                    <th style="width: 40%;">Event Dosen</th>
                    <th style="width: 40%;">Event Status</th>
                    <th style="width: 60%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
              @foreach($data['data'] ?? [] as $event)
                <tr>
                  <td>{{ $event['nama_event'] }}</td>
                  <td>{{ $event['nilai_on'] ? "Ya" : "Tidak" }}</td>
                  <td>{{ $event['irs_on'] ? "Ya" : "Tidak" }}</td>
                  <td>{{ $event['registrasi_on'] ? "Ya" : "Tidak" }}</td>
                  <td>{{ $event['yudisium_on'] ? "Ya" : "Tidak" }}</td>
                  <td>{{ $event['survei_on'] ? "Ya" : "Tidak" }}</td>
                  <td>{{ $event['dosen_on'] ? "Ya" : "Tidak" }}</td>
                  <td>
                    <span class="{{$event['status']}}-lable">{{$event['status'] === 'active' ? "Aktif" : "Tidak Aktif"}}</span>
                  </td>
                  <td class="center">
                    <button class="btn-icon btn-view-event-academic" data-id="{{$event['id']}}" title="View" type="button">
                        <img src="{{ asset('assets/icon-search.svg') }}" alt="View">
                        <span>Lihat</span>
                    </button>
                    <a class="btn-icon" title="Edit" href="{{ route('academics-event.edit', ['id' => $event['id']]) }}">
                        <img src="{{ asset('assets/button-edit.svg') }}" alt="Edit">
                    </a>
                    <button class="btn-icon btn-delete-event-academic" data-id="{{ $event['id'] }}" title="Delete" type="button">
                        <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Delete">
                        <span>Hapus</span>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
  </div>
  @if (isset($data['data']))
  @include('partials.pagination', [
    "currentPage" => $data['pagination']['current_page'],
    "lastPage" => $data['pagination']['last_page'],
    "limit" => $limit,
    "routes" => route('academics-event.index')
  ])
  @endif
  
  <div id="eventDetailModalContainer"></div>
  <div id="modalKonfirmasiSimpan" class="modal-custom" style="display:none;">
    <div class="modal-custom-backdrop"></div>
    <div class="modal-custom-content">
      <div class="modal-custom-header">
        <span class="text-lg-bd">Tunggu Sebentar</span>
        <img src="{{ asset('assets/icon-delete-gray-800.svg')}}" alt="ikon peringatan">
      </div>
      <div class="modal-custom-body">
        <div>Apakah anda yakin ingin menghapus event akademik ini?</div>
      </div>
      <div class="modal-custom-footer">
        <button type="button" class="button button-clean" id="btnCekKembali">Batal</button>
        <button type="submit" class="button button-outline" id="btnSimpan">Hapus</button>
      </div>
    </div>
  </div>
</div>
@endsection