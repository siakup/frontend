@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('css')
    <style>
        #toggleSortDropdown:hover {
            color: #EB474D;
        }

        .badge {
            padding: 2px 5px;
            border-radius: 2px;
            font-size: 10px;
        }
    </style>

@endsection

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Toggle sort dropdown
            document.getElementById('toggleSortDropdown').addEventListener('click', function(event) {
                const dropdown = document.getElementById('sortDropdown');
                dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display ===
                    '' ? 'block' : 'none';
                event.stopPropagation(); // Cegah dropdown langsung tertutup
            });

            // Klik opsi sort
            document.querySelectorAll('#sortDropdown .dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    const sortValue = this.dataset.sort;

                    const url = new URL(window.location.href);
                    url.searchParams.set('sort', sortValue);
                    url.searchParams.set('page', 1); // reset ke halaman 1 saat filter

                    window.location.href = url.toString();
                });
            });

            // Klik di luar dropdown -> tutup dropdown
            document.addEventListener('click', function(e) {
                const toggleBtn = document.getElementById('toggleSortDropdown');
                const dropdown = document.getElementById('sortDropdown');

                if (!toggleBtn.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });

            // Tombol lihat detail
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

            // Tombol search enter
            document.getElementById('searchInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    this.form.submit();
                }
            });

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
                    {{-- start search --}}
                    <form method="GET" action="{{ route('academics-periode.index') }}">
                        <div class="search-section">
                            <div class="search-container" style="display: flex; align-items: center;">
                                <input type="text" name="search" placeholder="Tahun/Semester/Tahun Akademik/Status"
                                    class="search-filter" id="searchInput" autocomplete="off"
                                    value="{{ request('search') }}" style="width: 400px;">

                                <button type="submit"
                                    style="background: none; border: none; padding: 0; margin-left: -35px; cursor: pointer;">
                                    <img src="{{ asset('assets/search-left.svg') }}" alt="search"
                                        style="width: 20px; height: 20px;">
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- start filter --}}
                    <div class="filter-box">
                        <button class="button-clean sort-toggle-btn" id="toggleSortDropdown">
                            Urutkan
                            <img src="{{ asset('assets/icon-filter.svg') }}" alt="Filter">
                        </button>
                        <div id="sortDropdown" class="sort-dropdown" style="display: none;">
                            <div class="dropdown-item" data-sort="active">Aktif</div>
                            <div class="dropdown-item" data-sort="inactive">Tidak Aktif</div>
                            <div class="dropdown-item" data-sort="id_periode,asc">A-Z</div>
                            <div class="dropdown-item" data-sort="id_periode,desc">Z-A</div>
                            <div class="dropdown-item" data-sort="created_at,asc">Terbaru</div>
                            <div class="dropdown-item" data-sort="created_at,desc">Terlama</div>
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
                    <tbody>
                        @if (empty($data->data) || count($data->data) === 0)
                            @include('academics.periode.error-filter')
                        @else
                            @foreach ($data->data as $periode)
                                <tr>
                                    <td>{{ $periode->tahun }}</td>
                                    <td>
                                        @php
                                            $namaSemester = [
                                                1 => 'Ganjil',
                                                2 => 'Genap',
                                                3 => 'Pendek',
                                            ];
                                        @endphp
                                        {{ $periode->semester }}
                                    </td>
                                    <td>{{ $periode->tahun }}/{{ $periode->tahun + 1 }}</td>
                                    <td>
                                        @if ($periode->status === 'active')
                                            <span class="badge badge-active">Aktif</span>
                                        @else
                                            <span class="badge badge-inactive">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="center">
                                        <button type="button" class="btn-icon btn-view-periode-academic"
                                            data-id="{{ $periode->id }}" title="Lihat">
                                            <img src="{{ asset('assets/icon-search.svg') }}" alt="Lihat">
                                            <span style="font-size: 14px;">Lihat</span>
                                        </button>

                                        <a class="btn-icon" title="Edit"
                                            href="{{ route('academics-periode.edit', ['id' => $periode->id]) }}"
                                            style="text-decoration: none; color: inherit;">
                                            <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit">
                                            <span>Ubah</span>
                                        </a>

                                        <button type="button" class="btn-icon btn-delete-event-academic"
                                            data-id="{{ $periode->id }}" title="Hapus">
                                            <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus">
                                            <span style="font-size: 14px;">Hapus</span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            @include('partials.pagination', [
                // "currentPage" => $data['pagination']['current_page'],
                'currentPage' => 1,
                // "lastPage" => $data['pagination']['last_page'],
                'lastPage' => 10,
                // "limit" => $limit,
                'limit' => 5,
                'routes' => route('academics-periode.index'),
            ])
        </div>
    </div>
    <div id="periodeDetailModalContainer"></div>
</div @endsection
