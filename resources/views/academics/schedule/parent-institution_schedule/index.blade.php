@extends('layouts.main')

@section('title', 'Jadwal Kuliah Program Studi')

@section('breadcrumbs')
    <div class="breadcrumb-item">Beranda</div>
    <div class="breadcrumb-item active">Jadwal Kuliah</div>
@endsection

@section('css')
    <style>
        .card-header.option-list {
            justify-content: flex-start;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .sub-title {
            padding: 10px 20px !important;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .button-clean {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            background: #fff;
        }

        .sort-dropdown {
            position: absolute;
            z-index: 30;
            display: none;
            min-width: 220px;
            background: #fff;
            border: 1px solid #E5E7EB;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
        }

        .sort-dropdown .dropdown-item {
            padding: 10px 14px;
            cursor: pointer;
        }

        .sort-dropdown .dropdown-item:hover {
            background: #F8FAFC;
        }

        .CampusWrap, .StudyWrap {
            position: relative;
        }

        .sort-dropdown.campus {
            top: 48px;
            left: 0;
        }

        .sort-dropdown.study {
            top: 48px;
            left: 0;
        }

        .searchbox {
            position: relative;
        }

        .searchbox input {
            padding-left: 36px;
        }

        .searchbox img {
            position: absolute;
            left: 10px;
            top: 10px;
        }

        .action-right {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            text-decoration: none;
        }

        .btn-view {
            color: #262626;
        }

        .btn-edit {
            color: #E62129;
        }

        .btn-delete {
            color: #8C8C8C;
        }

        .footerbar {
            display: flex;
            gap: 12px;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
    </style>
@endsection

@include('partials.success-notification-modal', ['route' => route('academics.schedule.parent-institution-schedule.index')])

@section('javascript')
    <script>
        function onClickShowSchedule(e) {
            const id = e.getAttribute('data-id');
            $.ajax({
                url: "{{ route('academics.schedule.parent-institution-schedule.view', ['id' => 'id']) }}".replace("'id'", id),
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function (html) {
                    $('#view-schedule').html(html);
                    $('#modalViewParentInstitutionSchedule').show();
                },
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const campusBtn = document.querySelector('#sortButtonCampus');
            const campusDrop = document.querySelector('#sortDropdownCampus');
            const studyBtn = document.querySelector('#sortButtonStudy');
            const studyDrop = document.querySelector('#sortDropdownStudy');

            // toggle dropdowns
            campusBtn?.addEventListener('click', function (e) {
                e.stopPropagation();
                campusDrop.style.display = campusDrop.style.display === 'block' ? 'none' : 'block';
                studyDrop.style.display = 'none';
                toggleArrow(this);
            });
            studyBtn?.addEventListener('click', function (e) {
                e.stopPropagation();
                studyDrop.style.display = studyDrop.style.display === 'block' ? 'none' : 'block';
                campusDrop.style.display = 'none';
                toggleArrow(this);
            });

            //search
            document.getElementById('searchInput').addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    this.form.submit();
                }
            });

            // choose items
            campusDrop?.querySelectorAll('.dropdown-item').forEach(el => {
                el.addEventListener('click', function () {
                    const url = new URL(window.location.href);
                    url.searchParams.set('program_perkuliahan', this.dataset.sort);
                    url.searchParams.set('page', 1);
                    window.location.href = url.toString();
                });
            });
            studyDrop?.querySelectorAll('.dropdown-item').forEach(el => {
                el.addEventListener('click', function () {
                    const url = new URL(window.location.href);
                    url.searchParams.set('program_studi', this.dataset.sort);
                    url.searchParams.set('page', 1);
                    window.location.href = url.toString();
                });
            });

            // close on outside click
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.CampusWrap')) {
                    campusDrop.style.display = 'none';
                    resetArrow(campusBtn);
                }
                if (!e.target.closest('.StudyWrap')) {
                    studyDrop.style.display = 'none';
                    resetArrow(studyBtn);
                }
            });

            // search
            document.querySelector('#btnSearch')?.addEventListener('click', function () {
                const q = document.querySelector('#q').value || '';
                const url = new URL(window.location.href);
                if (q) url.searchParams.set('q', q); else url.searchParams.delete('q');
                url.searchParams.set('page', 1);
                window.location.href = url.toString();
            });

            // sort popover (dummy — tinggal kirim query sort)
            document.querySelector('#btnSort')?.addEventListener('click', function () {
                const url = new URL(window.location.href);
                // contoh: sort=matkul_asc
                url.searchParams.set('sort', 'matkul_asc');
                window.location.href = url.toString();
            });

            function toggleArrow(btn) {
                const img = btn.querySelector('img');
                if (!img) return;
                img.src = img.src.includes('icon-arrow-up.svg')
                    ? "{{ asset('assets/active/icon-arrow-down.svg') }}"
                    : "{{ asset('assets/active/icon-arrow-up.svg') }}";
            }

            function resetArrow(btn) {
                const img = btn?.querySelector('img');
                if (img) img.src = "{{ asset('assets/active/icon-arrow-down.svg') }}";
            }
        });

        document.addEventListener('alpine:init', () => {
            Alpine.data('parentInstitutionSchedule', () => ({
                async deleteParentInstitutionSchedule(id) {
                    try {
                        // const response = await fetch(`/api/ekuivalensi/${id}`, {
                        //     method: 'DELETE'
                        // });
                        // if (!response.ok) throw new Error("Gagal hapus");

                        console.log('🔥 Berhasil menghapus data dengan id:', id);

                        // akses komponen blade & trigger
                        this.$store.flashMessage.trigger();

                    } catch (err) {
                        console.error(err);
                        this.$store.flashMessage.type = 'error';
                        this.$store.flashMessage.message = 'Gagal menghapus data';
                        this.$store.flashMessage.trigger();
                    }
                }
            }))
        })

    </script>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-title-text">Jadwal Kuliah</div>
    </div>

    <div class="academics-layout" x-data="parentInstitutionSchedule">
        @include('academics.schedule.prodi_schedule.navbar-jadwal-prodi')
        <div class="academics-slicing-content content-card p-[20px]">
            <x-typography variant="heading-h6" class="mb-2 p-[20px]">
                Jadwal Kuliah Institusi Parent
            </x-typography>
            <div class="card-header option-list">
                <div class="card-header">
                    <div class="page-title-text sub-title">Peran</div>
                    @include('partials.dropdown-filter', [
                        'buttonId' => 'sortButtonRole',
                        'dropdownId' => 'sortRole',
                        'dropdownItem' => call_user_func_array('array_merge', array_map(function ($peran) {
                          return [$peran->nama => $peran->id];
                        }, $peranList)),
                        'label' =>  current(array_filter($peranList, function ($list) use($peran) {
                          return $list->id == $peran;
                        }))->nama,
                        'url' => route('academics.schedule.parent-institution-schedule.index'),
                        'imgSrc' => asset('assets/active/icon-arrow-down.svg'),
                        'dropdownClass' => '!top-[21%] !left-[11.4%]',
                        'isIconCanRotate' => true,
                        'imgInvertSrc' => asset('assets/active/icon-arrow-up.svg'),
                        'queryParameter' => 'role'
                    ])
                </div>

                <div class="card-header">
                    <div class="page-title-text sub-title">Program Studi</div>
                    @include('partials.dropdown-filter', [
                        'buttonId' => 'sortButtonStudy',
                        'dropdownId' => 'sortStudy',
                        'dropdownItem' => call_user_func_array('array_merge', array_map(function ($programStudi) {
                          return [$programStudi->nama => $programStudi->id];
                        }, $programStudiList)),
                        'label' =>  current(array_filter($programStudiList, function ($list) use($program_studi) {
                          return $list->id == $program_studi;
                        }))->nama,
                        'url' => route('academics.schedule.parent-institution-schedule.index'),
                        'imgSrc' => asset('assets/active/icon-arrow-down.svg'),
                        'dropdownClass' => '!top-[21%] !left-[41.7%]',
                        'isIconCanRotate' => true,
                        'imgInvertSrc' => asset('assets/active/icon-arrow-up.svg'),
                        'queryParameter' => 'study_program'
                    ])
                </div>
            </div>
            <x-container>
                <div class="card-header">
                    <form method="GET" action="{{ route('academics.schedule.parent-institution-schedule.index') }}">
                        <div class="search-section">
                            <div class="search-container" style="display: flex; align-items: center;">
                                <input type="text" name="search" placeholder="Nama Pengajar / Nama Mata Kuliah / Hari"
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

                    @include('partials.dropdown-filter', [
                      'buttonId' => 'sortButton',
                      'dropdownId' => 'sortDropdown',
                      'dropdownItem' => [
                      'A-Z' => 'nama,asc',
                      'Z-A' => 'nama,desc',
                      'Terbaru' => 'created_at,desc',
                      'Terlama' => 'created_at,asc'
                      ],
                      'label' => empty($_GET) ? 'Urutkan' : ($sort === 'active' ? 'Aktif' : ($sort === 'inactive' ? 'Tidak Aktif' : ($sort === 'nama,asc' ? 'A-Z' : ($sort === 'nama,desc' ? 'Z-A' : ($sort === 'created_at,desc' ? 'Terbaru' : 'Terlama'))))),
                      'url' => route('academics.schedule.parent-institution-schedule.index'),
                      'imgSrc' => asset('assets/icon-filter.svg'),
                      'dropdownClass' => '!top-[34%] !right-[4.2%]',
                      'isIconCanRotate' => false,
                      'imgInvertSrc' => ''
                    ])
                </div>
            </x-container>
            <div class="flex flex-col gap-5 mt-5">
                <x-table>
                    <x-table-head>
                        <x-table-row>
                            <x-table-header>Mata Kuliah</x-table-header>
                            <x-table-header>Nama Kelas</x-table-header>
                            <x-table-header>Kapasitas</x-table-header>
                            <x-table-header>Jadwal</x-table-header>
                            <x-table-header>Pengajar</x-table-header>
                            <x-table-header>Aksi</x-table-header>
                        </x-table-row>
                    </x-table-head>
                    <x-table-body>
                        @forelse ($data as $d)
                            <x-table-row>
                                <x-table-cell>{{ $d['mata_kuliah'] }}</x-table-cell>
                                <x-table-cell>{{ $d['nama_kelas'] }}</x-table-cell>
                                <x-table-cell>{{ $d['kapasitas'] }}</x-table-cell>
                                <x-table-cell>
                                    <ul class="list-disc text-left">
                                        @foreach(($d['jadwal'] ?? []) as $jadwal)
                                            <li class="mb-[5px]">
                                                <div class="flex flex-col gap-[5px]">
                                                    <span>{{$jadwal['hari']}} ({{$jadwal['jam_mulai']}} - {{$jadwal['jam_selesai']}})</span>
                                                    <span class="font-bold">[Ruang {{$jadwal['ruangan']}}]</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </x-table-cell>
                                <x-table-cell>
                                    <div class="flex flex-col gap-[12px]">
                                        @foreach(($d['pengajar'] ?? []) as $pengajar)
                                            <span class="text-left">{{$pengajar}}</span>
                                        @endforeach
                                    </div>
                                </x-table-cell>
                                <x-table-cell x-data="{ showModalDeleteConfirmation: false }">
                                    <div class="flex justify-center gap-1">
                                        <button type="button" class="btn-icon btn-view-periode-academic"
                                                data-id="{{$d['id']}}" title="Lihat"
                                                onclick="onClickShowSchedule(this)">
                                            <img src="{{ asset('assets/icon-search.svg') }}" alt="Lihat">
                                            <span>Lihat</span>
                                        </button>
                                        <a class="btn-icon btn-edit-periode-academic" title="Ubah"
                                           href="{{route('academics.schedule.parent-institution-schedule.edit', ['id' => $d['id']])}}"
                                           style="text-decoration: none; color: inherit;">
                                            <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit">
                                            <span style="color: #E62129">Ubah</span>
                                        </a>
                                        <x-button.action type="delete" label="Hapus"
                                                         x-on:click="$dispatch('open-modal', {id: 'delete-confirmation'})"/>
                                    </div>
                                </x-table-cell>
                            </x-table-row>
                        @empty
                            @include('academics.periode.error-filter')
                        @endforelse
                    </x-table-body>
                </x-table>
            </div>
            <div class="card-header">
                <div class="right gap-5">
                    <a href="{{route('academics.schedule.parent-institution-schedule.upload')}}" class="button-clean"
                       id="">
                        <span>Impor File FET</span>
                        <img src="{{ asset('assets/icon-upload-red-500.svg') }}" alt="Filter">
                    </a>
                    <button
                        onclick="window.location.href='{{ route('academics.schedule.parent-institution-schedule.create') }}'"
                        class="button-outline btn-add-event">Tambah Jadwal Baru +
                    </button>
                </div>
            </div>
        </div>

        {{-- TODO: Id nya jan lupa nnti yak --}}
        <div x-data @on-submit="deleteParentInstitutionSchedule(1)">
            <x-modal.confirmation
                id="delete-confirmation"
                title="Hapus Jadwal"
                confirmText="Ya, Hapus"
                cancelText="Batal"
                iconUrl="{{ asset('assets/icon-delete-gray-800.svg') }}"
            >
                <div class="w-full text-center">
                    <x-typography>Apakah Anda yakin ingin menghapus Jadwal ini?</x-typography>
                </div>
            </x-modal.confirmation>
        </div>


        <x-flash-message type="success" message="Jadwal berhasil dihapus"
                         redirect="{{ route('academics.schedule.parent-institution-schedule.index') }}" />

    </div>
    @include('partials.pagination', [
        'currentPage' => 1,
        'lastPage' => 10,
        'limit' => 3,
        'routes' => '',
    ])
    {{-- @if (isset($data['data']))
    @endif --}}

    <div id="view-schedule"></div>
@endsection
