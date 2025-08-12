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
            justify-content: center;
            gap: 24px;
        }

        .center .btn-icon {
            display: flex;
            align-items: center;
            justify-items: center;
            text-decoration: none;
            gap: 2px;
            font-size: 12px !important;
            width: auto !important;
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

        .modal-custom-content {
            max-width: 600px;
            z-index: 2;
            align-items: center;
            gap: 16px;
            align-self: auto;
        }

        .active-lable {
            background-color: #D0DE68;
            border-radius: 2px;
            padding: 2px 29px;
        }

        .inactive-lable {
            background-color: #FAFBEE;
            color: #98A725;
            border-radius: 2px;
            padding: 2px 10px;
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

        .status-lable {
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        .btn-edit-event-academic {
            color: #E62129;
        }

        #btnUpload:hover img {
            filter: brightness(0) invert(1);
        }
    </style>
@endsection

@section('javascript')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('searchInput');
            const dropdown = document.getElementById('searchDropdown');

            // Create loading indicator
            const loadingIndicator = document.createElement('div');
            loadingIndicator.className = 'dropdown-item text-center';
            loadingIndicator.innerHTML = 'Sedang mencari...';

            input.addEventListener('input', function() {
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
                    data: {
                        search: keyword
                    },
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(data) {
                        if (!data.success || !Array.isArray(data.data) || data.data.length ===
                            0) {
                            dropdown.innerHTML =
                                '<div class="dropdown-item text-center">Tidak ada hasil ditemukan</div>';
                            return;
                        }
                        dropdown.innerHTML = '';
                        data.data.forEach(event => {
                            const item = document.createElement('div');
                            item.className = 'dropdown-item';
                            item.textContent = event.nama_event;
                            item.onclick = () => {
                                dropdown.querySelectorAll('.dropdown-item').forEach(
                                    i => i.classList.remove('active'));
                                item.classList.add('active');
                                input.value = event.nama_event;
                                dropdown.style.display = 'none';
                                refreshTable(event.nama_event);
                            };
                            dropdown.appendChild(item);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        dropdown.innerHTML =
                            '<div class="dropdown-item text-center text-danger">Terjadi kesalahan, silakan coba lagi</div>';
                    }
                });
            });

            function refreshTable(nama_event) {
                $.ajax({
                    url: '{{ route('academics-event.index') }}',
                    method: 'GET',
                    data: {
                        search: nama_event
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        window.location.href = '{{ route('academics-event.index') }}' + '?search=' +
                            encodeURIComponent(nama_event);
                    },
                    error: function() {
                        $('tbody').html(
                            '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
                        );
                    }
                });
            }

            function sortTable(value) {
                $.ajax({
                    url: '{{ route('academics-event.index') }}',
                    method: 'GET',
                    data: {
                        sort: value
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        window.location.href = '{{ route('academics-event.index') }}' + '?sort=' +
                            encodeURIComponent(value);
                    },
                    error: function() {
                        $('tbody').html(
                            '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
                        );
                    }
                });
            }

            document.querySelectorAll('#sortDropdown .dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    sortDropdown.querySelectorAll('.dropdown-item').forEach(i => i.classList.remove(
                        'active'));
                    const sortKey = this.getAttribute('data-sort');

                    this.classList.add('active');
                    sortDropdown.style.display = 'none';
                    sortTable(sortKey); // Panggil AJAX sortTable
                });
            });

            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-view-event-academic');
                if (btn) {
                    const id = btn.getAttribute('data-id');
                    if (id) {
                        $.ajax({
                            url: "{{ route('academics-event.detail') }}",
                            method: 'GET',
                            data: {
                                id: id
                            },
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            success: function(html) {
                                $('#eventDetailModalContainer').html(html);
                                $('#modalDetailEvent').show();
                            }
                        });
                    }
                }
            });

            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-delete-event-academic');
                if (btn) {
                    const idEvent = btn.getAttribute('data-id');
                    document.getElementById('modalKonfirmasiSimpan').setAttribute('data-id', idEvent);
                    document.getElementById('modalKonfirmasiSimpan').style.display = 'flex';
                }
            });

            document.getElementById('btnSimpan').addEventListener('click', function() {
                const id = document.getElementById('modalKonfirmasiSimpan').getAttribute('data-id');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                $.ajax({
                    url: "{{ route('academics-event.delete', ['id' => ':id']) }}".replace(':id',
                        id),
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        document.getElementById('modalKonfirmasiSimpan').removeAttribute(
                            'data-id');
                        document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
                        successToast('Berhasil dihapus');
                        setTimeout(() => {
                            window.location.href =
                                "{{ route('academics-event.index') }}";
                        }, 5000);
                    },
                    error: function() {
                        $('tbody').html(
                            '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
                        );
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
            sortBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                sortDropdown.style.display = (sortDropdown.style.display === 'block') ? 'none' : 'block';
            });
        })
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                successToast("{{ session('success') ?? 'Berhasil disimpan' }}");
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
                    Unggah Event Akademik
                    <img src="{{ asset('assets/icon-upload-red-500.svg') }}" alt="Upload">
                </a>
                <a href="{{ route('academics-event.create') }}" class="button button-outline">Tambah Event Akademik</a>
            </div>
            <div class="content-card content-card-search">
                <div class="card-header">
                    <div class="search-section">
                        <div class="search-container">
                            <input type="text" placeholder="Nama Event" class="search-filter" id="searchInput"
                                autocomplete="off" value="{{ $search }}">
                            <img src="{{ asset('assets/search-left.svg') }}" alt="search" class="search-icon-right">
                            <div class="search-dropdown" id="searchDropdown"></div>
                        </div>
                    </div>
                    <div class="filter-box">
                        <button class="button-clean" id="sortButton">
                            {{ empty($_GET) ? 'Terbaru' : ($sort === 'active' ? 'Aktif' : ($sort === 'inactive' ? 'Tidak Aktif' : ($sort === 'nama,asc' ? 'A-Z' : ($sort === 'nama,desc' ? 'Z-A' : ($sort === 'created_at,desc' ? 'Terbaru' : 'Terlama'))))) }}
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
                <table class="table" id="list-user" style="--table-cols:10">
                    <thead>
                        <tr>
                            <th style="width: 45%;">Nama Event</th>
                            <th style="width: 30%;">Event <br> Nilai</th>
                            <th style="width: 30%;">Event <br> IRS</th>
                            <th style="width: 30%;">Event <br> Lulus</th>
                            <th style="width: 35%;">Event <br> Registrasi</th>
                            <th style="width: 35%;">Event <br> Yudisium</th>
                            <th style="width: 30%;">Event <br> Survei</th>
                            <th style="width: 30%;">Event <br> Dosen</th>
                            <th style="width: 35%;">Status</th>
                            <th style="width: 100%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['data'] ?? [] as $event)
                            <tr>
                                <td>{{ $event['nama_event'] }}</td>
                                <td>{{ $event['nilai_on'] ? 'Ya' : 'Tidak' }}</td>
                                <td>{{ $event['irs_on'] ? 'Ya' : 'Tidak' }}</td>
                                <td>{{ $event['lulus_on'] ? 'Ya' : 'Tidak' }}</td>
                                <td>{{ $event['registrasi_on'] ? 'Ya' : 'Tidak' }}</td>
                                <td>{{ $event['yudisium_on'] ? 'Ya' : 'Tidak' }}</td>
                                <td>{{ $event['survei_on'] ? 'Ya' : 'Tidak' }}</td>
                                <td>{{ $event['dosen_on'] ? 'Ya' : 'Tidak' }}</td>
                                <td>
                                    <span
                                        class="{{ $event['status'] }}-lable status-lable">{{ $event['status'] === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="center">
                                        <button class="btn-icon btn-view-event-academic" data-id="{{ $event['id'] }}"
                                            title="View" type="button">
                                            <img src="{{ asset('assets/icon-search.svg') }}" alt="View">
                                            <span>Lihat</span>
                                        </button>
                                        <a class="btn-icon btn-edit-event-academic" title="Edit"
                                            href="{{ route('academics-event.edit', ['id' => $event['id']]) }}">
                                            <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit">
                                            <span>Ubah</span>
                                        </a>
                                        <button class="btn-icon btn-delete-event-academic" data-id="{{ $event['id'] }}"
                                            title="Delete" type="button">
                                            <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Delete">
                                            <span>Hapus</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if (isset($data['data']))
            @include('partials.pagination', [
                'currentPage' => $data['pagination']['current_page'],
                'lastPage' => $data['pagination']['last_page'],
                'limit' => $limit,
                'routes' => route('academics-event.index'),
            ])
        @endif

        <div id="eventDetailModalContainer"></div>
        <div id="modalKonfirmasiSimpan" class="modal-custom" style="display:none;">
            <div class="modal-custom-backdrop"></div>
            <div class="modal-custom-content" style="background-color: #98A725 ">
                <div class="modal-custom-header">
                    <span class="text-lg-bd">Tunggu Sebentar</span>
                    <img src="{{ asset('assets/icon-delete-gray-800.svg') }}" alt="ikon peringatan">
                </div>
                <div class="modal-custom-body">
                    <div>Apakah Anda yakin ingin menghapus event akademik ini?</div>
                </div>
                <div class="modal-custom-footer">
                    <button type="button" class="button button-clean" id="btnCekKembali">Batal</button>
                    <button type="submit" class="button button-outline" id="btnSimpan">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection
