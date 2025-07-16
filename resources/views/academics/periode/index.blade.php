@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('css')
@endsection

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortButton = document.getElementById('toggleSortDropdown');
            const sortDropdown = document.getElementById('sortDropdown');

            sortButton.addEventListener('click', function(e) {
                e.stopPropagation();
                sortDropdown.style.display = (sortDropdown.style.display === 'none' || sortDropdown.style
                        .display === '') ?
                    'block' :
                    'none';
            });
            document.addEventListener('click', function() {
                sortDropdown.style.display = 'none';
            });
        });
    </script>
    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-view-periode-academic');
            if (btn) {
                const nomorInduk = btn.getAttribute('data-nomor-induk');

                $.get("{{ route('academics-periode.detail') }}", {}, function(html) {
                    $('#periodeDetailModalContainer').html(html);
                    $('#modalPeriodeAkademik').show();
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
                <button onclick="window.location.href='{{ route('periode.create') }}'" class="button button-outline">
                    Tambah Periode Akademik
                </button>
            </div>
            <div class="content-card content-card-search">
                <div class="card-header">
                    <div class="search-section">
                        <div class="search-container">
                            <input type="text" name="search" placeholder="Tahun/Semester/Tahun Akademik/Status"
                                class="search-filter" id="searchInput" autocomplete="off" value="{{ $search }}"
                                style="width: 400px;">
                            <img src="{{ asset('icons/search-left.svg') }}" alt="search" class="search-icon-right">
                            <div class="search-dropdown" id="searchDropdown"></div>
                        </div>
                    </div>
                    <div class="filter-box">
                        <button class="button-clean sort-toggle-btn" id="toggleSortDropdown">
                            Urutkan
                            <img src="{{ asset('icons/icon-filter.svg') }}" alt="Filter">
                        </button>
                        <div id="sortDropdown" class="sort-dropdown" style="display: none;">
                            <div class="dropdown-item" data-sort="active">Aktif</div>
                            <div class="dropdown-item" data-sort="inactive">Tidak Aktif</div>
                            <div class="dropdown-item" data-sort="nama,asc">A-Z</div>
                            <div class="dropdown-item" data-sort="nama,desc">Z-A</div>
                            <div class="dropdown-item" data-sort="created_at,desc">Terbaru</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- start tabel --}}
            <div class="table-responsive">
                <table class="table" id="list-user" style="--table-cols:7;">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Semester</th>
                            <th>Tahun Akademik</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    {{-- view error filter --}}
                    {{-- <tbody>
                        @include('academics.periode.error-filter')
                    </tbody> --}}
                    <tbody>
                        <td>2019</td>
                        <td>Ganjil</td>
                        <td>2019/2020</td>
                        <td><span class="badge badge-active">Aktif</span></td>
                        <td>
                            <button class="btn-icon btn-view-periode-academic" data-nomor-induk="" title="View"
                                type="button">
                                <img src="{{ asset('icons/button-view.svg') }}" alt="View">
                            </button>
                            <a class="btn-icon" title="Ubah Data" href="#" style="margin-right: 8px;">
                                <img src="{{ asset('icons/button-edit.svg') }}" alt="Ubah">
                            </a>
                            <a class="btn-icon" title="Hapus Data" href="#">
                                <img src="{{ asset('icons/button-delete.svg') }}" alt="Hapus">
                            </a>
                        </td>
                    </tbody>
                    <tbody>
                        <td>2020</td>
                        <td>Genap</td>
                        <td>2023/2024</td>
                        <td><span class="badge badge-inactive">Tidak
                                Aktif</span></td>
                        <td>
                            <button class="btn-icon btn-view-event-academic" title="Lihat Data" type="button"
                                style="margin-right: 8px;">
                                <img src="{{ asset('icons/button-view.svg') }}" alt="Lihat">
                            </button>
                            <a class="btn-icon" title="Ubah Data" href="#" style="margin-right: 8px;">
                                <img src="{{ asset('icons/button-edit.svg') }}" alt="Ubah">
                            </a>
                            <a class="btn-icon" title="Hapus Data" href="#">
                                <img src="{{ asset('icons/button-delete.svg') }}" alt="Hapus">
                            </a>
                        </td>
                    </tbody>
                </table>
            </div>
            {{-- @include('partials.pagination', [
                // "currentPage" => $data['pagination']['current_page'],
                'currentPage' => 1,
                // "lastPage" => $data['pagination']['last_page'],
                'lastPage' => 10,
                // "limit" => $limit,
                'limit' => 5,
                'routes' => route('academics-periode.index'),
            ]) --}}
        </div>
    </div>
    <div id="periodeDetailModalContainer"></div>
</div @endsection
