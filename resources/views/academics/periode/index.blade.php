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
                            <img src="{{ asset('assets/search-left.svg') }}" alt="search" class="search-icon-right">
                            <div class="search-dropdown" id="searchDropdown"></div>
                        </div>
                    </div>
                    <div class="filter-box">
                        <button class="button-clean sort-toggle-btn" id="toggleSortDropdown">
                            Urutkan
                            <img src="{{ asset('assets/icon-filter.svg') }}" alt="Filter">
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
                        <td class="center">
                            <button type="button" class="btn-icon btn-view-periode-academic" data-nomor-induk="d"
                                title="Lihat">
                                <img src="{{ asset('assets/icon-search.svg') }}" alt="Lihat">
                                <span style="font-size: 14px;">Lihat</span>
                            </button>
                            <a class="btn-icon" title="Edit" href="{{ route('academics-periode.edit', ['id' => 1]) }}"
                                style="text-decoration: none; color: inherit;">
                                <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit">
                                <span>Ubah</span>
                            </a>

                            <button type="button" class="btn-icon btn-delete-event-academic" data-nomor-induk="d"
                                title="Hapus">
                                <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus">
                                <span style="font-size: 14px;">Hapus</span>
                            </button>
                        </td>
                    </tbody>
                    <tbody>
                        <td>2020</td>
                        <td>Genap</td>
                        <td>2023/2024</td>
                        <td><span class="badge badge-inactive">Tidak
                                Aktif</span></td>
                        <td class="center">
                            <button type="button" class="btn-icon btn-view-periode-academic" data-nomor-induk="d"
                                title="Lihat">
                                <img src="{{ asset('assets/icon-search.svg') }}" alt="Lihat">
                                <span style="font-size: 14px;">Lihat</span>
                            </button>
                            <a class="btn-icon" title="Edit" href="{{ route('academics-periode.edit', ['id' => 1]) }}"
                                style="text-decoration: none; color: inherit;">
                                <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit">
                                <span>Ubah</span>
                            </a>

                            <button type="button" class="btn-icon btn-delete-event-academic" data-nomor-induk="d"
                                title="Hapus">
                                <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus">
                                <span style="font-size: 14px;">Hapus</span>
                            </button>
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
