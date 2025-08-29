@extends('layouts.main')

@section('title', 'Mata Kuliah')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Pemetaan CPL</div>
@endsection

@section('css')

@endsection

@section('javascript')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')
    <div class="px-5 flex flex-col gap-5">
        <x-typography variant="heading-h6" bold class="">
            Pemetaan CPL
        </x-typography>

        <div class="flex flex-col gap-5" x-data="pemetaanCplTable" x-init="fetchData()">
            <x-container variant="content" class="flex flex-col gap-5">
                <x-typography variant="heading-h6" class="mb-2">
                    Daftar Pemetaan CPL
                </x-typography>

                <div class="flex flex-col gap-5" x-data="{ itemToDelete: null }" x-cloak>
                    <!-- Search and Filters -->
                    <div
                        class="p-5 flex flex-col md:flex-row justify-between items-center gap-4 border border-gray-300 rounded-3xl">
                        <!-- Search Input -->
                        <div class="w-full md:w-1/3">
                            <x-form.input placeholder="Kode Mata Kuliah / Nama Mata Kuliah / Jenis Mata Kuliah"
                                iconUrl="{{ asset('assets/icon-search.svg') }}" />
                        </div>

                        <!-- Filter and Sort Buttons -->
                        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                            <!-- Program Studi Dropdown -->
                            <div class="w-full md:w-auto">
                                <select wire:model.live="programStudi"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                    <option value="">Semua Program Studi</option>
                                    {{-- @foreach ($prodiOptions as $prodi)
                                        <option value="{{ $prodi }}">{{ $prodi }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <x-table>
                        <x-table-head>
                            <x-table-row>
                                <x-table-header>Kode Mata Kuliah</x-table-header>
                                <x-table-header>Nama Mata Kuliah</x-table-header>
                                <x-table-header>CPL-A</x-table-header>
                                <x-table-header>CPL-B</x-table-header>
                                <x-table-header>CPL-C</x-table-header>
                                <x-table-header>CPL-D</x-table-header>
                                <x-table-header>CPL-E</x-table-header>
                                <x-table-header>CPL-F</x-table-header>
                                <x-table-header>CPL-G</x-table-header>
                                <x-table-header>CPL-H</x-table-header>
                                <x-table-header>CPL-I</x-table-header>
                                <x-table-header>CPL-J</x-table-header>
                                <x-table-header>CPL-K</x-table-header>
                                <x-table-header>CPL-L</x-table-header>
                                <x-table-header>CPL-M</x-table-header>
                            </x-table-row>
                        </x-table-head>

                        <x-table-body x-data="{
                            getRowClass(idx, length) {
                                let classes = idx % 2 === 1 ? 'bg-[#f5f5f5]' : 'bg-white';
                                if (idx === length - 1) classes += ' border-b-0';
                                return classes;
                            }
                        }">
                            <template x-if="mataKuliahList.length > 0">
                                <template x-for="(matkul, idx) in mataKuliahList" :key="matkul.kode">
                                    <tr :class="getRowClass(idx, mataKuliahList.length)">
                                        <x-table-cell x-text="matkul.kode"></x-table-cell>
                                        <x-table-cell x-text="matkul.nama_id"></x-table-cell>

                                        <!-- helper cell: tampilkan ✓ kalau true -->
                                        <x-table-cell class="text-center"><span x-show="matkul.a">✓</span></x-table-cell>
                                        <x-table-cell class="text-center"><span x-show="matkul.b">✓</span></x-table-cell>
                                        <x-table-cell class="text-center"><span x-show="matkul.c">✓</span></x-table-cell>
                                        <x-table-cell class="text-center"><span x-show="matkul.d">✓</span></x-table-cell>
                                        <x-table-cell class="text-center"><span x-show="matkul.e">✓</span></x-table-cell>
                                        <x-table-cell class="text-center"><span x-show="matkul.f">✓</span></x-table-cell>
                                        <x-table-cell class="text-center"><span x-show="matkul.g">✓</span></x-table-cell>
                                        <x-table-cell class="text-center"><span x-show="matkul.h">✓</span></x-table-cell>
                                        <x-table-cell class="text-center"><span x-show="matkul.i">✓</span></x-table-cell>
                                        <x-table-cell class="text-center"><span x-show="matkul.j">✓</span></x-table-cell>
                                        <x-table-cell class="text-center"><span x-show="matkul.k">✓</span></x-table-cell>
                                        <x-table-cell class="text-center"><span x-show="matkul.l">✓</span></x-table-cell>
                                        <x-table-cell class="text-center"><span x-show="matkul.m">✓</span></x-table-cell>
                                    </tr>
                                </template>
                            </template>

                            <template x-if="mataKuliahList.length === 0">
                                <x-table-row>
                                    <x-table-cell colspan="6" class="text-center py-4">
                                        Tidak ada data ditemukan
                                    </x-table-cell>
                                </x-table-row>
                            </template>
                        </x-table-body>
                    </x-table>

                    <!-- Action Buttons -->
                    <div class="flex justify-end items-center gap-5">
                        <a href="{{ route('cpl-mapping.upload') }}">
                            <x-button.secondary type="button" label="Upload Pemetaan CPL"
                                icon="{{ asset('assets/icon-upload-red-500.svg') }}" iconPosition="right" />
                        </a>
                    </div>

                </div>
            </x-container>

            {{-- !!! TODO: Benerin --}}
            <!-- Pagination and Per Page Selector -->
            @include('partials.pagination', [
                'currentPage' => 1,
                'lastPage' => 5,
                'limit' => 10,
                'routes' => route('academics-event.index'),
            ])


            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('pemetaanCplTable', () => ({
                        mataKuliahList: [{
                                kode: 'MK001',
                                nama_id: 'Algoritma & Pemrograman',
                                a: true,
                                b: false,
                                c: true,
                                d: false,
                                e: true,
                                f: false,
                                g: false,
                                h: true,
                                i: false,
                                j: true,
                                k: false,
                                l: true,
                                m: false
                            },
                            {
                                kode: 'MK002',
                                nama_id: 'Struktur Data',
                                a: false,
                                b: true,
                                c: false,
                                d: true,
                                e: false,
                                f: true,
                                g: true,
                                h: false,
                                i: true,
                                j: false,
                                k: true,
                                l: false,
                                m: true
                            },
                            {
                                kode: 'MK003',
                                nama_id: 'Basis Data',
                                a: true,
                                b: true,
                                c: false,
                                d: false,
                                e: true,
                                f: true,
                                g: false,
                                h: false,
                                i: true,
                                j: true,
                                k: false,
                                l: false,
                                m: true
                            },
                            {
                                kode: 'MK004',
                                nama_id: 'Jaringan Komputer',
                                a: false,
                                b: false,
                                c: true,
                                d: true,
                                e: false,
                                f: false,
                                g: true,
                                h: true,
                                i: false,
                                j: false,
                                k: true,
                                l: true,
                                m: false
                            },
                            {
                                kode: 'MK005',
                                nama_id: 'Pemrograman Web',
                                a: true,
                                b: false,
                                c: true,
                                d: true,
                                e: true,
                                f: false,
                                g: true,
                                h: false,
                                i: true,
                                j: false,
                                k: true,
                                l: false,
                                m: true
                            },
                        ],

                        async fetchData() {
                            // try {
                            //     const url = `${window.LECTURER_API_URL}/courses`; // GET request
                            //     const res = await fetch(url, {
                            //         method: 'GET', // eksplisit pakai GET
                            //         headers: {
                            //             'Accept': 'application/json'
                            //         }
                            //     });

                            //     if (!res.ok) throw new Error('Gagal memuat data');
                            //     const data = await res.json();

                            //     console.log('Data Mata Kuliah:', data); // Debugging log


                            //     // Pastikan hasilnya array
                            //     this.mataKuliahList = Array.isArray(data) ? data : data.data || [];
                            // } catch (err) {
                            //     console.error(err);
                            //     this.mataKuliahList = [];
                            // }
                        }
                    }))
                });
            </script>

        </div>


    </div>
@endsection
