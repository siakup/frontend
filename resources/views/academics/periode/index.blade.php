@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('css')
    <style>
        #toggleSortDropdown:hover,
        #toggleSortDropdown.active {
            color: #EB474D;
        }
    </style>

@endsection

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('toggleSortDropdown').addEventListener('click', function(event) {
                const dropdown = document.getElementById('sortDropdown');
                const toggleBtn = document.getElementById('toggleSortDropdown');

                const isOpen = dropdown.style.display === 'none' || dropdown.style.display === '';
                dropdown.style.display = isOpen ? 'block' : 'none';

                if (!toggleBtn.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.style.display = 'none';
                    toggleBtn.classList.remove('active');
                }
                toggleBtn.classList.toggle('active', isOpen);

                event.stopPropagation();
            });

            document.querySelectorAll('#sortDropdown .dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    const sortValue = this.dataset.sort;
                    const sortText = this.textContent.trim();

                    const sortLabel = document.getElementById('sortLabel');
                    if (sortLabel) {
                        sortLabel.textContent = sortText;
                    }

                    const url = new URL(window.location.href);
                    url.searchParams.set('sort', sortValue);
                    url.searchParams.set('page', 1);
                    window.location.href = url.toString();
                });
            });

            const params = new URLSearchParams(window.location.search);
            const currentSort = params.get('sort');
            if (currentSort) {
                const currentItem = Array.from(document.querySelectorAll('#sortDropdown .dropdown-item'))
                    .find(item => item.dataset.sort === currentSort);
                if (currentItem) {
                    const sortLabel = document.getElementById('sortLabel');
                    if (sortLabel) {
                        sortLabel.textContent = currentItem.textContent.trim();
                    }
                }
            }
            document.addEventListener('click', function(e) {
                const toggleBtn = document.getElementById('toggleSortDropdown');
                const dropdown = document.getElementById('sortDropdown');

                if (!toggleBtn.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });

            // detail
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-view-periode-academic');
                if (btn) {
                    const idPeriode = btn.getAttribute('data-periode-akademik');
                    if (idPeriode) {
                        $.get("{{ route('periode.detail') }}", {
                            id: idPeriode
                        }, function(html) {
                            $('#periodeDetailModalContainer').html(html);
                            $('#modalPeriodeAkademik').show();
                        });
                    }
                }
            });

            //search
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
                            <span id="sortLabel">Urutkan</span>
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
                                            data-periode-akademik="{{ $periode->id }}" title="Lihat">
                                            <img src="{{ asset('assets/icon-search.svg') }}" alt="Lihat">
                                            <span style="font-size: 14px;">Lihat</span>
                                        </button>

                                        <a class="btn-icon" title="Ubah"
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
    <div id="periodeDetailModalContainer"></div>
    @include('partials.success-modal')
</div @endsection
