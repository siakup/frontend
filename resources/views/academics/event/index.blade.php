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

            document.getElementById('modalKonfirmasiHapus-btnSimpan').addEventListener('click', function() {
                const id = document.getElementById('modalKonfirmasiHapus').getAttribute('data-id');
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
                        document.getElementById('modalKonfirmasiHapus').removeAttribute(
                            'data-id');
                        document.getElementById('modalKonfirmasiHapus').style.display = 'none';
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
                    @include('partials.dropdown-filter', [
                      'buttonId' => 'sortButton',
                      'dropdownId' => 'sortDropdown',
                      'dropdownItem' => [
                        'Aktif' => 'active',
                        'Tidak Aktif' => 'inactive',
                        'A-Z' => 'nama, asc',
                        'Z-A' => 'nama, desc',
                        'Terbaru' => 'created_at,desc',
                        'Terlama' => 'created_at,asc'
                      ],
                      'label' => empty($_GET) ? 'Terbaru' : ($sort === 'active' ? 'Aktif' : ($sort === 'inactive' ? 'Tidak Aktif' : ($sort === 'nama,asc' ? 'A-Z' : ($sort === 'nama,desc' ? 'Z-A' : ($sort === 'created_at,desc' ? 'Terbaru' : 'Terlama'))))),
                      'url' => route('academics-event.index'),
                      'imgSrc' => asset('assets/icon-filter.svg'),
                      'dropdownClass' => '',
                      'isIconCanRotate' => false,
                      'imgInvertSrc' => ''
                    ])
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
        @include('partials.modal', [
          'modalId' => 'modalKonfirmasiHapus',
          'modalTitle' => 'Tunggu Sebentar',
          'modalIcon' => asset('assets/icon-delete-gray-800.svg'),
          'modalMessage' => 'Apakah Anda yakin ingin menghapus event akademik ini?',
          'triggerButton' => 'btn-delete-event-academic',
          'cancelButtonLabel' => 'Batal',
          'actionButtonLabel' => 'Hapus'
        ]);
    </div>
@endsection
