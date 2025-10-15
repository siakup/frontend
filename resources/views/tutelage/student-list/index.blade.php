@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('breadcrumbs')
    <div class="breadcrumb-item">Beranda</div>
    <div class="breadcrumb-item active">Kelompok Perwalian</div>
@endsection

@section('content')
    <div class="page-header pl-5">
        <x-typography variant="heading-h6">Kelompok Perwalian - dosen</x-typography>
    </div>

    <div class="academics-layout">
        @include('tutelage.layout.navbar-tutelage')

        <div class="academics-slicing-content content-card p-5 flex flex-col gap-5" style="border-radius: 0 12px 12px 12px !important;">

            <x-typography variant="heading-h6">
                Daftar Mahasiswa
            </x-typography>

            <div class="border rounded-lg border-[#D9D9D9] p-5 flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <x-typography variant="body-medium-bold">Periode Akademik</x-typography>
                    <x-select.filter
                        name="periodAcademic"
                        id="periodAcademic"
                        :options="[
                            '1' => '2023 - Ganjil',
                            '2' => '2023 - Genap',
                            '3' => '2024 - Ganjil'
                        ]"
                        selected="1"
                    />

                    <x-typography variant="body-medium-bold">Tahun Masuk</x-typography>
                    <x-select.filter
                        name="enterYear"
                        id="enterYear"
                        :options="[
                            '1' => '2021',
                            '2' => '2022',
                            '3' => '2023'
                        ]"
                        selected="2"
                    />
                </div>

                <div class="flex items-center gap-3 mt-4">
                    <x-select.filter
                        name="filter"
                        id="filter"
                        :options="[
                            '1' => '2023 - Ganjil',
                            '2' => '2023 - Genap',
                            '3' => '2024 - Ganjil'
                        ]"
                    />

                    <x-select.filter
                        name="urutkan"
                        id="urutkan"
                        :options="[
                            '1' => '2021',
                            '2' => '2022',
                            '3' => '2023'
                        ]"
                    />
                </div>


            </div>

            <div class="border rounded-lg border-[#D9D9D9] p-5 flex flex-col gap-[10px] bg-[#FAFAFA]">
                <x-typography variant="caption-bold">Keterangan Status Persetujuan:</x-typography>

                @php
                    $statuses = [
                        [
                            'color' => '#D0DE68',
                            'text'  => 'Menunjukkan jumlah mata kuliah yang telah <b>disetujui</b>.',
                            'textColor' => '#262626', // default hitam
                        ],
                        [
                            'color' => '#EB474D',
                            'text'  => 'Menunjukkan jumlah mata kuliah yang telah <b>ditolak</b>.',
                            'textColor' => '#FFFFFF', // putih
                        ],
                        [
                            'color' => '#FDE05D',
                            'text'  => 'Menunjukkan jumlah mata kuliah yang <b>menunggu persetujuan</b>.',
                            'textColor' => '#262626',
                        ],
                        [
                            'color' => '#0097F5',
                            'text'  => 'Menunjukkan jumlah mata kuliah yang <b>mengajukan penghapusan</b>.',
                            'textColor' => '#FFFFFF', // putih
                        ],
                    ];
                @endphp

                <div class="grid grid-cols-2 gap-[10px]">
                    @foreach ($statuses as $status)
                        <div class="flex items-center gap-[6px]">
                            <span class="flex items-center justify-center px-4 py-[2px] rounded-[4px]"
                                  style="background-color: {{ $status['color'] }}; color: {{ $status['textColor'] }}">
                                x
                            </span>
                            <x-typography variant="caption-regular">: {!! $status['text'] !!}</x-typography>
                        </div>
                    @endforeach
                </div>

            </div>

            @php
                $statusMap = [
                    'disetujui' => ['color' => '#D0DE68', 'textColor' => '#262626'],
                    'ditolak'   => ['color' => '#EB474D', 'textColor' => '#FFFFFF'],
                    'menunggu'  => ['color' => '#FDE05D', 'textColor' => '#262626'],
                    'hapus'     => ['color' => '#0097F5', 'textColor' => '#FFFFFF'],
                ];
            @endphp

            <x-table>
                <x-table-head>
                    <x-table-row>
                        <x-table-header>No</x-table-header>
                        <x-table-header>NIM</x-table-header>
                        <x-table-header>Angkatan</x-table-header>
                        <x-table-header>Nama</x-table-header>
                        <x-table-header>IPS</x-table-header>
                        <x-table-header>IPK</x-table-header>
                        <x-table-header>SKS Lulus</x-table-header>
                        <x-table-header>SKS Lulus MK Wajib</x-table-header>
                        <x-table-header>Nilai PEM</x-table-header>
                        <x-table-header>Status Akademik</x-table-header>
                        <x-table-header>Status Persetujuan</x-table-header>
                        <x-table-header>Aksi</x-table-header>
                    </x-table-row>
                </x-table-head>

                <x-table-body>
                    @foreach ($students as $student)
                        <x-table-row>
                            <x-table-cell>{{ $student['id'] }}</x-table-cell>
                            <x-table-cell>{{ $student['nim'] }}</x-table-cell>
                            <x-table-cell>{{ $student['angkatan'] }}</x-table-cell>
                            <x-table-cell>{{ $student['nama'] }}</x-table-cell>
                            <x-table-cell>{{ number_format($student['ips'], 2) }}</x-table-cell>
                            <x-table-cell>{{ number_format($student['ipk'], 2) }}</x-table-cell>
                            <x-table-cell>{{ $student['sks_lulus'] }}</x-table-cell>
                            <x-table-cell>{{ $student['sks_lulus_wajib'] }}</x-table-cell>
                            <x-table-cell>{{ $student['nilai_pem'] }}</x-table-cell>
                            <x-table-cell>{{ $student['status_akademik'] }}</x-table-cell>
                            <x-table-cell>
                                <div class="flex flex-wrap justify-center gap-2">
                                    @foreach ($student['status_persetujuan'] as $sp)
                                        @php
                                            $cfg = $statusMap[$sp['status']] ?? ['color' => '#D9D9D9', 'textColor' => '#262626'];
                                        @endphp
                                        <span class="flex items-center justify-center px-4 py-[2px] rounded-[4px] text-xs"
                                              style="background-color: {{ $cfg['color'] }}; color: {{ $cfg['textColor'] }}">
                                            {{ $sp['nilai'] }}
                                        </span>
                                    @endforeach
                                </div>
                            </x-table-cell>
                            <x-table-cell>
                                <x-button.primary
                                    href="{{ route('tutelage-group.student-list.detail-krs', ['id' => $student['id']]) }}"
                                    class="px-0"
                                    style="min-width: 0;"
                                >
                                    Detail
                                </x-button.primary>
                            </x-table-cell>
                        </x-table-row>
                    @endforeach
                </x-table-body>
            </x-table>

        </div>

        <!-- Pagination Component -->
        <div class="px-5 py-5"
             x-data="{
        currentPage: {{ $pagination['current_page'] }},
        totalPages: {{ $pagination['total_pages'] }},
        perPage: {{ $pagination['per_page'] }},
        changePage(page) {
            if (page >= 1 && page <= this.totalPages) {
                window.location.href = '?page=' + page + '&per_page=' + this.perPage
            }
        },
        changePerPage(e) {
            this.perPage = e.target.value
            window.location.href = '?page=1&per_page=' + this.perPage
        }
     }">

            <x-pagination
                :current-page="$pagination['current_page']"
                :total-pages="$pagination['total_pages']"
                :per-page-input="$pagination['per_page']"
                :default-per-page-options="[10, 25, 50, 100]"
                onPerPageChange="changePerPage(event)"
                onPageChange="changePage({page})"
                onPrevious="changePage(currentPage - 1)"
                onNext="changePage(currentPage + 1)"
            />
        </div>

    </div>
@endsection
