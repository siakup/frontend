@extends('layouts.main')

@section('title', 'Kalender Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kalender Akademik</div>
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
            font-size: 12px;
        }

        .center .btn-view-event-academic {
            color: #262626;
        }

        .page-title-text.sub-title {
            font-size: 16px;
        }

        .card-header.option-list {
            justify-content: left;
        }

        .card-header {
            padding-left: 0px;
        }

        .sort-dropdown.left {
            top: 29%;
            left: 29.7%;
            z-index: 999;
            right: auto;
        }

        .sort-dropdown.right {
            top: 41%;
            right: 39%;
            z-index: 999;
        }

        .label-status {
            padding: 3.5px 12px;
            background-color: #0097F5;
            color: white;
            font-size: 10px;
            font-weight: 400;
            border-radius: 16px;
        }
    </style>
@endsection

@section('javascript')
    <script>
        function sortTable(value) {
            $.ajax({
                url: "{{ route('calendar.index') }}",
                method: 'GET',
                data: {
                    sort: value
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    window.location.href = "{{ route('academics-event.index') }}" + '?sort=' +
                        encodeURIComponent(value);
                },
                error: function() {
                    $('tbody').html(
                        '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
                    );
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // sort dropdown
            const sortBtnCampusProgram = document.querySelector('#sortButton.campus');
            const sortDropdownCampusProgram = document.querySelector('#sortDropdown.campus');
            const sortBtnStudyProgram = document.querySelector('#sortButton.study');
            const sortDropdownStudyProgram = document.querySelector('#sortDropdown.study');

            // Toggle dropdown on button click
            sortBtnCampusProgram.addEventListener('click', function(e) {
                e.stopPropagation();
                sortDropdownCampusProgram.style.display = (sortDropdownCampusProgram.style.display ===
                    'block') ? 'none' : 'block';
                sortBtnCampusProgram.querySelector('img').src = (sortBtnCampusProgram.querySelector('img')
                        .src === "{{ asset('assets/active/icon-arrow-up.svg') }}") ?
                    "{{ asset('assets/active/icon-arrow-down.svg') }}" :
                    "{{ asset('assets/active/icon-arrow-up.svg') }}";
            });
            sortDropdownCampusProgram.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    sortDropdownCampusProgram.querySelectorAll('.dropdown-item').forEach(i => i
                        .classList.remove('active'));
                    const url = new URL(window.location.href);

                    const sortKey = this.getAttribute('data-sort');

                    url.searchParams.set('program_perkuliahan', sortKey);
                    window.location.href = url.toString();
                });
            });

            sortBtnStudyProgram.addEventListener('click', function(e) {
                e.stopPropagation();
                sortDropdownStudyProgram.style.display = (sortDropdownStudyProgram.style.display ===
                    'block') ? 'none' : 'block';
                sortBtnStudyProgram.querySelector('img').src = (sortBtnStudyProgram.querySelector('img')
                        .src === "{{ asset('assets/active/icon-arrow-up.svg') }}") ?
                    "{{ asset('assets/active/icon-arrow-down.svg') }}" :
                    "{{ asset('assets/active/icon-arrow-up.svg') }}";
            });
            sortDropdownStudyProgram.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    sortDropdownStudyProgram.querySelectorAll('.dropdown-item').forEach(i => i
                        .classList.remove('active'));
                    const url = new URL(window.location.href);

                    const sortKey = this.getAttribute('data-sort');

                    url.searchParams.set('program_studi', sortKey);
                    window.location.href = url.toString();
                });
            });

            document.addEventListener('click', (e) => {
                const dropdownCampus = e.target.closest('#CampusProgramSection');
                const dropdownStudy = e.target.closest('#StudyProgramSection');

                if (dropdownCampus == null) {
                    sortDropdownCampusProgram.style.display = 'none';
                    sortBtnCampusProgram.querySelector('img').src =
                        "{{ asset('assets/active/icon-arrow-down.svg') }}";
                }
                if (dropdownStudy == null) {
                    sortDropdownStudyProgram.style.display = 'none'
                    sortBtnStudyProgram.querySelector('img').src =
                        "{{ asset('assets/active/icon-arrow-down.svg') }}";
                }
            });
        })
    </script>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-title-text">Kalender Akademik - Universitas Pertamina</div>
    </div>
    <div class="content-card">
        <div class="card-header">
            <div class="page-title-text sub-title">Tahun Akademik 2025-2026</div>
        </div>
        <div class="card-header option-list">
            <div class="card-header" id="CampusProgramSection">
                <div class="page-title-text sub-title">Program Perkuliahan</div>
                <button class="button-clean campus" id="sortButton">
                    <span>{{ empty($_GET['program_perkuliahan']) ? 'Reguler' : ucwords(str_replace('-', ' ', strtolower($params['program_perkuliahan']))) }}</span>
                    <img src="{{ asset('assets/active/icon-arrow-down.svg') }}" alt="Filter">
                </button>
                <div id="sortDropdown" class="sort-dropdown left campus" style="display: none;">
                    <div class="dropdown-item" data-sort="reguler">Reguler</div>
                    <div class="dropdown-item" data-sort="double-degree">Double Degree</div>
                    <div class="dropdown-item" data-sort="international">International</div>
                    <div class="dropdown-item" data-sort="karyawan">Karyawan</div>
                </div>
            </div>
            <div class="card-header" id="StudyProgramSection">
                <div class="page-title-text sub-title">Program Studi</div>
                <button class="button-clean study" id="sortButton">
                    <span>{{ empty($_GET['program_studi']) ? 'Ilmu Komputer' : ucwords(str_replace('-', ' ', strtolower($params['program_studi']))) }}</span>
                    <img src="{{ asset('assets/active/icon-arrow-down.svg') }}" alt="Filter">
                </button>
                <div id="sortDropdown" class="sort-dropdown right study" style="display: none;">
                    <div class="dropdown-item" data-sort="1">Ilmu Komputer</div>
                    <div class="dropdown-item" data-sort="2">Teknik Kimia</div>
                    <div class="dropdown-item" data-sort="3">Teknik Sipil</div>
                    <div class="dropdown-item" data-sort="4">Teknik Industri</div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table" id="list-user" style="--table-cols:7;">
                <thead>
                    <tr>
                        <th>Periode Akademik</th>
                        <th>Semester</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Aksi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d['periode_akademik'] }}</td>
                            <td>{{ $d['semester'] }}</td>
                            @php
                                $mulai = new DateTime($d['tanggal_mulai']);
                                $akhir = new DateTime($d['tanggal_akhir']);
                            @endphp
                            <td>{{ $mulai->format('d') . ' ' . bulan((int) $mulai->format('m')) . ' ' . $mulai->format('Y, H:i') }}
                            </td>
                            <td>{{ $akhir->format('d') . ' ' . bulan((int) $akhir->format('m')) . ' ' . $akhir->format('Y, H:i') }}
                            </td>

                            <td>
                                <div class="center">
                                    <a href="{{ route('calendar.show', ['id' => $d['id']]) }}"
                                        class="btn-icon btn-view-event-academic" data-id="{{ $d['id'] }}"
                                        title="View" type="button">
                                        <img src="{{ asset('assets/icon-search.svg') }}" alt="View">
                                        <span>Lihat</span>
                                    </a>
                                </div>
                            </td>
                            <td>
                                @if (new DateTime() >= new DateTime($d['tanggal_mulai']) && new DateTime() <= new DateTime($d['tanggal_akhir']))
                                    <span class="label-status">Sedang berlangsung</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="right">
            <a href="" class="button button-outline">Generate Riwayat Akademik</a>
        </div>
    </div>
@endsection
