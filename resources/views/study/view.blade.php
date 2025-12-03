@extends('layouts.main')

@section('title', 'Mata Kuliah')

@section('javascript')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('mataKuliahDetail', () => ({
                subject: {
                    id_matakuliah: '',
                    kode_matakuliah: '',
                    nama_matakuliah_id: '',
                    nama_matakuliah_en: '',
                    nama_singkat: '',
                    id_prodi: '',
                    sks: '',
                    semester: '',
                    tujuan: '',
                    deskripsi: '',
                    daftar_pustaka: '',
                    id_jenis: '',
                    id_koordinator: '',
                    matakuliah_spesial: false,
                    prodi_lain: false,
                    matakuliah_wajib: false,
                    kampus_merdeka: false,
                    matakuliah_capstone: false,
                    matakuliah_kerja_praktik: false,
                    matakuliah_tugas_akhir: false,
                    matakuliah_minor: false,
                    status: false,
                    prasyarat: []
                },
                async fetchDetail() {
                    try {
                        const id = window.location.pathname.split('/').pop();
                        const url = `${window.LECTURER_API_URL}/courses/${id}`;
                        const res = await fetch(url, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json'
                            }
                        });

                        if (!res.ok) throw new Error('Gagal memuat data');
                        const result = await res.json();

                        console.log('Full Response:', result);

                        // Handle null values for boolean fields
                        const data = result.data ?? {};
                        this.subject = {
                            ...data,
                            matakuliah_spesial: data.matakuliah_spesial ?? false,
                            prodi_lain: data.prodi_lain ?? false,
                            matakuliah_wajib: data.matakuliah_wajib ?? false,
                            kampus_merdeka: data.kampus_merdeka ?? false,
                            matakuliah_capstone: data.matakuliah_capstone ?? false,
                            matakuliah_kerja_praktik: data.matakuliah_kerja_praktik ?? false,
                            matakuliah_tugas_akhir: data.matakuliah_tugas_akhir ?? false,
                            matakuliah_minor: data.matakuliah_minor ?? false,
                            status: data.status === 'active',
                        };

                        console.table(this.subject);
                    } catch (err) {
                        console.error('Fetch error:', err);
                    }
                }
            }))
        });
    </script>


@endsection

{{-- END --}}


@section('content')
    <div class="px-5 flex flex-col gap-5" x-data="mataKuliahDetail" x-init="fetchDetail()">
        <x-typography variant="heading-h6" bold class="">
            Lihat Mata Kuliah
        </x-typography>
        <x-container.container variant="content" class="gap-5 flex flex-col">
            <x-typography variant="body-medium-bold" class="">Detail Mata Kuliah</x-typography>

            <div class="space-y-5">
                <!-- Single column fields (2:10 ratio) -->
                <div class="grid grid-cols-12 gap-5 items-center">
                    {{-- TODO: get data prodi --}}
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Program Studi
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input disabled name="study_program" type="select" placeholder="Pilih Program Studi"
                            x-model="subject.study_program" :options="[
                                '' => 'Pilih Program Studi',
                                'ti' => 'Teknik Informatika',
                                'si' => 'Sistem Informasi',
                                'mi' => 'Manajemen Informatika',
                                'tk' => 'Teknik Komputer',
                                'if' => 'Informatika',
                                'ti' => 'Teknik Industri',
                            ]" />

                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Kode MK
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input disabled name="kode_matakuliah" type="text" placeholder="Contoh: IF184101"
                            x-model="subject.kode_matakuliah" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Nama MK
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input disabled name="nama_matakuliah_id" type="text" placeholder="Nama Mata Kuliah"
                            x-model="subject.nama_matakuliah_id" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Nama MK (English)
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input disabled name="nama_matakuliah_en" type="text" placeholder="Course Name (English)"
                            x-model="subject.nama_matakuliah_en" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Nama Singkat
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input disabled name="nama_singkat" type="text" placeholder="Singkatan resmi MK"
                            x-model="subject.nama_singkat" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Jumlah SKS
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input disabled name="sks" type="number" placeholder="1-6 SKS" min="1"
                            max="6" x-model="subject.sks" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Semester
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input disabled name="semester" type="number" placeholder="1-8" min="1"
                            max="8" x-model="subject.semester" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Tujuan MK
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input disabled name="tujuan" type="textarea" placeholder="Tujuan pembelajaran mata kuliah"
                            x-model="subject.tujuan" rows="3" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Deskripsi
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input disabled name="deskripsi" type="textarea" placeholder="Deskripsi singkat mata kuliah"
                            x-model="subject.deskripsi" rows="3" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Daftar Pustaka
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input disabled name="daftar_pustaka" type="textarea"
                            placeholder="Referensi utama dan pendukung" x-model="subject.daftar_pustaka"
                            rows="3" />
                    </div>
                </div>

                <!-- Double column fields (2:4:2:4 ratio) -->
                {{-- TODO: get jenis mata kuliah from API --}}
                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Jenis MK
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input disabled name="id_jenis" type="select" x-model="subject.id_jenis"
                            :options="[
                                '' => 'Pilih Jenis MK',
                                'wajib' => 'Wajib Program Studi',
                                'pilihan' => 'Pilihan Program Studi',
                                'konsentrasi' => 'Wajib Konsentrasi',
                                'umum' => 'Mata Kuliah Umum',
                            ]" />
                    </div>
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Koordinator
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input disabled name="id_koordinator" type="select" x-model="subject.id_koordinator"
                            :options="[
                                '' => 'Pilih Koordinator',
                                'D001' => 'Prof. Dr. Ahmad Fauzi, M.Kom.',
                                'D002' => 'Dr. Budi Santoso, S.Kom., M.T.',
                                'D003' => 'Dr. Citra Dewi, S.Si., M.Sc.',
                                'D004' => 'Diana Putri, S.Kom., M.Kom.',
                            ]" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Spesial
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.boolean-select name="matakuliah_spesial" alpineModel="subject.matakuliah_spesial" disabled
                            trueLabel="Ya (MK Khusus)" falseLabel="Tidak (MK Reguler)" />
                    </div>
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Untuk Prodi Lain
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.boolean-select name="prodi_lain" alpineModel="subject.prodi_lain" disabled
                            trueLabel="Ya (Terbuka)" falseLabel="Tidak (Eksklusif)" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Wajib
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.boolean-select name="matakuliah_wajib" alpineModel="subject.matakuliah_wajib" disabled
                            trueLabel="Ya (Harus Diambil)" falseLabel="Tidak (Opsional)" />
                    </div>
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Merdeka
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.boolean-select name="kampus_merdeka" alpineModel="subject.kampus_merdeka" disabled
                            trueLabel="Ya (Program Merdeka)" falseLabel="Tidak (Reguler)" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Capstone
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.boolean-select name="matakuliah_capstone" alpineModel="subject.matakuliah_capstone"
                            disabled trueLabel="Ya (Proyek Akhir)" falseLabel="Tidak (MK Biasa)" />
                    </div>
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Kerja Praktik
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.boolean-select name="matakuliah_kerja_praktik"
                            alpineModel="subject.matakuliah_kerja_praktik" disabled trueLabel="Ya (Program Magang)"
                            falseLabel="Tidak (Non-Magang)" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Tugas Akhir
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.boolean-select name="matakuliah_tugas_akhir" alpineModel="subject.matakuliah_tugas_akhir"
                            disabled trueLabel="Ya (Skripsi/Tesis)" falseLabel="Tidak (Non-TA)" />
                    </div>
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Minor
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.boolean-select name="matakuliah_minor" alpineModel="subject.matakuliah_minor" disabled
                            trueLabel="Ya (Program Minor)" falseLabel="Tidak (Non-Minor)" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Status
                        </x-typography>
                    </div>
                    {{-- TODO: masih error untuk tombol switch nya --}}
                    <div class="col-span-4">
                        <x-button.switch name="status" alpineModel="subject.status" externalOnLabel="Aktif"
                            externalOffLabel="Tidak Aktif" disabled />
                    </div>
                    <div class="col-span-2">
                    </div>
                    <div class="col-span-4">
                    </div>
                </div>
            </div>


        </x-container>

        <x-container.container variant="content">
            <div class="flex justify-between mb-5" x-data="{ showTambahPrasyaratModal: false }">
                <x-typography variant="body-medium-bold" class="mb-5">Mata Kuliah Prasyarat</x-typography>
                <x-button.primary label="Tambah Mata Kuliah Prasyarat"
                    x-on:click="$dispatch('open-modal', {id: 'tambah-prasyarat-modal'})" />
            </div>

            <!-- Table -->
            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell>
                            Kode Mata Kuliah
                        </x-table.header-cell>
                        <x-table.header-cell>
                            Nama Mata Kuliah Prasyarat
                        </x-table.header-cell>
                        <x-table.header-cell>
                            Tipe Prasyarat
                        </x-table.header-cell>
                        <x-table.header-cell>Aksi</x-table.header-cell>
                    </x-table.row>
                </x-table.head>

                <x-table.body x-data="{
                    getRowClass(idx, length) {
                        let classes = idx % 2 === 1 ? 'bg-[#f5f5f5]' : 'bg-white';
                        if (idx === length - 1) classes += ' border-b-0';
                        return classes;
                    }
                }">
                    <template x-if="subject.prasyarat && subject.prasyarat.length > 0">
                        <template x-for="(matkul, idx) in subject.prasyarat" :key="matkul.kode_matakuliah">
                            <tr :class="getRowClass(idx, subject.prasyarat.length)">
                                <x-table.cell x-text="matkul.kode_matakuliah"></x-table.cell>
                                <x-table.cell x-text="matkul.nama_matakuliah_id"></x-table.cell>
                                <x-table.cell x-text="matkul.tipe_prasyarat"></x-table.cell>
                                <x-table.cell>
                                    <div class="flex gap-3 justify-center">
                                        <a href="#" class="">
                                            <x-button.action type="edit" label="Edit" />
                                        </a>
                                        <x-button.action type="delete" label="Hapus"
                                            x-on:click="
                                $dispatch('open-modal', {
                                    id: 'delete-confirmation',
                                    detail: {
                                        id: matkul.kode_matakuliah,
                                        name: matkul.nama_matakuliah_id
                                    }
                                });
                            " />
                                    </div>
                                </x-table.cell>
                            </tr>
                        </template>
                    </template>

                    <template x-if="!subject.prasyarat || subject.prasyarat.length === 0">
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                Tidak ada data prasyarat yang ditambahkan
                            </td>
                        </tr>
                    </template>
                </x-table.body>
            </x-table.index>
        </x-container>

        <div x-data="{ showCancelConfirm: false, showSaveConfirm: false }">
            <!-- Container Tombol -->
            <x-container.container>
                <div class="flex justify-end gap-5">
                    <!-- Tombol Batal -->
                    <x-button.secondary label="Batal"
                        x-on:click="$dispatch('open-modal', {id: 'cancel-confirmation'})" />

                    <!-- Tombol Simpan -->
                    <x-button.primary label="Simpan" x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})" />
                </div>
            </x-container>
        </div>

    </div>
@endsection

@section('modals')
    <div x-data class="text-gray-800">
        <!-- Modal Konfirmasi Batal -->
        <x-modal.confirmation id="cancel-confirmation" title="Tunggu Sebentar" confirmText="Ya, Batalkan"
            cancelText="Kembali">
            <p>Apakah Anda yakin ingin membatalkan tambah mata kuliah?</p>

            <div
                x-on:confirmed.window="
            // Aksi ketika konfirmasi batal diklik
            console.log('Perubahan dibatalkan');
            // Redirect atau reset form bisa dilakukan di sini
            window.location.href = '/'; // Contoh redirect ke home
        ">
            </div>
        </x-modal.confirmation>

        <!-- Modal Konfirmasi Simpan -->
        <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
            cancelText="Cek Kembali">
            <p>Apakah Anda yakin informasi yang ditambahkan sudah benar?</p>

            <div
                x-on:confirmed.window="
            // Aksi ketika konfirmasi simpan diklik
            console.log('Data disimpan');
            // Submit form atau AJAX request bisa dilakukan di sini
            document.getElementById('form-id').submit(); // Contoh submit form
        ">
            </div>
        </x-modal.confirmation>

        <!-- Modal Konfirmasi Hapus Prasyarat Mata Kuliah -->
        <x-modal.confirmation iconUrl="{{ asset('assets/icon-delete-gray-800.svg') }}" id="delete-confirmation"
            title="Hapus Daftar Mata Kuliah" confirmText="Ya, Hapus" cancelText="Batal"
            x-on:open-modal.window="if ($event.detail.id === 'delete-confirmation') {
            item = $event.detail.detail;
            show = true;
        }">
            <p class="text-gray-800">Apakah anda yakin ingin menghapus prasyarat mata kuliah ini?</p>

            <div
                x-on:confirmed.window="
            // Aksi ketika konfirmasi batal diklik
            console.log('Prasyarat mata kuliah dihapus');
            // Redirect atau reset form bisa dilakukan di sini
            window.location.href = '/subject/create';
        ">
            </div>

        </x-modal.confirmation>

        {{-- MODAL TAMBAH PRASYARAT --}}
        <x-modal.container id="prasyarat-modal" maxWidth="7xl"
            x-on:open-modal.window="if ($event.detail.id === 'tambah-prasyarat-modal') { show = true }">
            <x-slot name="header">
                <div class="w-full relative">
                    <x-typography variant="heading-h5" class="w-full inline-block text-center text-gray-800">
                        Daftar Mata Kuliah Prasyarat
                    </x-typography>
                    <button x-on:click.stop="close()"
                        class="text-gray-400 hover:text-gray-500 focus:outline-none absolute right-0">
                        <x-icon iconUrl="{{ asset('assets/base/icon-close-cancel.svg') }}" class="w-[32px] h-[32px]" />
                    </button>
                </div>
            </x-slot>

            <div class="p-4">
                <!-- Konten modal -->
                <div>
                    <x-table.index>
                        <x-table.head>
                            <x-table.row>
                                <x-table.header-cell></x-table.header-cell>
                                <x-table.header-cell>Kode Mata Kuliah</x-table.header-cell>
                                <x-table.header-cell>Nama Mata Kuliah</x-table.header-cell>
                                <x-table.header-cell>SKS</x-table.header-cell>
                                <x-table.header-cell>Semester</x-table.header-cell>
                                <x-table.header-cell>Jenis Mata Kuliah</x-table.header-cell>
                                <x-table.header-cell>Tipe Prasyarat</x-table.header-cell>
                            </x-table.row>
                        </x-table.head>
                        <x-table.body>
                            {{-- @foreach ($prasyaratMataKuliahList as $index => $item)
                                <x-table.row :odd="$loop->odd" :last="$loop->last">
                                    <x-table.cell>
                                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                            name="selected[]" value="{{ $item['kode'] }}">
                                    </x-table.cell>
                                    <x-table.cell>{{ $item['kode'] }}</x-table.cell>
                                    <x-table.cell>{{ $item['nama'] }}</x-table.cell>
                                    <x-table.cell>{{ $item['sks'] }}</x-table.cell>
                                    <x-table.cell>{{ $item['semester'] }}</x-table.cell>
                                    <x-table.cell>{{ $item['jenis'] }}</x-table.cell>
                                    <x-table.cell>{{ $item['tipe'] }}</x-table.cell>
                                </x-table.row>
                            @endforeach --}}

                        </x-table.body>
                    </x-table.index>
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex justify-center gap-4 w-full">
                    {{-- <x-pagination :currentPage="$currentPage" :totalPages="$totalPages" :perPageInput="$perPage" />
                    <x-button.secondary label="Batal" x-on:click.stop="close()" />
                    <x-button.primary label="Simpan" x-on:click.stop="close()" /> --}}
                </div>
            </x-slot>
        </x-modal.container>
    </div>
@endsection
