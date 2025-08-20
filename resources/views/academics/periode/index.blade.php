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

        .content-card {
            background: #ffffff;
            border-radius: 0px 12px 12px 12px;
        }

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

        #btnUpload:hover img {
            filter: brightness(0) invert(1);
        }
    </style>

@endsection

@section('javascript')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            //search
            document.getElementById('searchInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    this.form.submit();
                }
            });

            // detail
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-view-periode-academic');
                if (btn) {
                    const idPeriode = btn.getAttribute('data-periode-akademik');
                    if (idPeriode) {
                        $.ajax({
                            url: "{{ route('academics-periode.detail') }}",
                            method: 'GET',
                            data: {
                                id: idPeriode
                            },
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            success: function(html) {
                                $('#periodeDetailModalContainer').html(html);
                                $('#modalPeriodeAkademik').show();
                            }
                        });
                    }
                }
            });

            document.getElementById('modalKonfirmasiHapus-btnSimpan').addEventListener('click', function() {
                const id = document.getElementById('modalKonfirmasiHapus').getAttribute('data-id');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                $.ajax({
                    url: "/academics/periode/delete/" + id,
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
                                "{{ route('academics-periode.index') }}";
                        }, 5000);
                    },
                    error: function() {
                        $('tbody').html(
                            '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
                        );
                    }
                });

            });
        });
    </script>
@endsection


@section('content')
    <div class="academics-layout">
        @include('academics.layouts.navbar-academic')
        <div class="academics-slicing-content content-card">
            <div class="academics-menu">
                <button onclick="window.location.href='{{ route('academics-periode.create') }}'" class="button button-outline">
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
                      'url' => route('academics-periode.index'),
                      'imgSrc' => asset('assets/icon-filter.svg'),
                      'dropdownClass' => '',
                      'isIconCanRotate' => false,
                      'imgInvertSrc' => ''
                    ])
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
                                        {{ $namaSemester[$periode->semester] ?? 'Tidak Diketahui' }}
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
                                            <span>Lihat</span>
                                        </button>

                                        <a class="btn-icon btn-edit-periode-academic" title="Ubah"
                                            href="{{ route('academics-periode.edit', ['id' => $periode->id]) }}"
                                            style="text-decoration: none; color: inherit;">
                                            <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit">
                                            <span style="color: #E62129">Ubah</span>
                                        </a>

                                        <button type="button" class="btn-icon btn-delete-periode-academic"
                                            data-id="{{ $periode->id }}" title="Hapus">
                                            <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus">
                                            <span>Hapus</span>
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
            'currentPage' => $data->pagination->current_page ?? 1,
            'lastPage' => $data->pagination->last_page ?? 1,
            'limit' => $limit,
            'routes' => route('academics-periode.index'),
            'showSearch' => false,
        ])
    </div>
    <div id="periodeDetailModalContainer"></div>
    @include('partials.modal', [
      'modalId' => 'modalKonfirmasiHapus',
      'modalTitle' => 'Tunggu Sebentar',
      'modalIcon' => asset('assets/icon-delete-gray-800.svg'),
      'modalMessage' => 'Apakah Anda yakin ingin menghapus periode akademik ini?',
      'triggerButton' => 'btn-delete-periode-academic',
      'cancelButtonLabel' => 'Batal',
      'actionButtonLabel' => 'Hapus'
    ]);
    @include('partials.success-modal')
@endsection
