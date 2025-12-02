@extends('layouts.main')

@section('title', 'Tambah Ekuivalensi')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Tambah Ekuivalensi</div>
@endsection

@section('javascript')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('mataKuliahForm', () => ({
                // state
                courses: [], // visible page items
                allCourses: [], // semua data (untuk client-side filter/paginasi)
                isLoading: false,
                errorMessage: null,

                selectedOldCourses: [],
                selectedNewCourses: [],
                modalTarget: null,

                searchQuery: '',
                jenisFilter: '',
                jenisOptions: [],
                perPage: 10,
                currentPage: 1,
                totalPages: 1,

                // Ambil data (pakai API jika window.LECTURER_API_URL terdefinisi; kalau tidak, pakai dummy 25)
                async fetchCourses() {
                    this.isLoading = true;
                    this.errorMessage = null;

                    try {
                        let data;
                        const useDummy = !window
                            .LECTURER_API_URL; // jika undefined maka pakai dummy

                        if (useDummy) {
                            // ===== dummy 25 item =====
                            const items = Array.from({
                                length: 25
                            }).map((_, i) => ({
                                id: i + 1,
                                kode: `IF${100 + i}`,
                                nama_id: `Mata Kuliah ${i + 1}`,
                                sks: (i % 4) + 2,
                                semester: (i % 8) + 1,
                                jenis: [
                                    "Mata Kuliah Wajib",
                                    "Mata Kuliah Program Studi",
                                    "Mata Kuliah Pilihan",
                                    null
                                ][i % 4],
                            }));

                            data = {
                                data: items,
                                pagination: {
                                    total: items.length,
                                    per_page: this.perPage,
                                    current_page: this.currentPage,
                                    last_page: Math.ceil(items.length / this.perPage)
                                }
                            };
                        } else {
                            // ===== real API =====
                            const url = new URL(`${window.LECTURER_API_URL}/courses`);
                            // NOTE: bila API mendukung server-side pagination/filtering, kamu bisa pakai params sesuai API.
                            // Untuk testing client-side, kita minta halaman 1 dengan perPage besar (atau biarkan API handle)
                            url.searchParams.set('page', 1);
                            url.searchParams.set('perPage',
                                1000); // minta banyak supaya client dapat mem-paginate (opsional)
                            const res = await fetch(url, {
                                headers: {
                                    Accept: 'application/json'
                                }
                            });
                            if (!res.ok) throw new Error(`HTTP ${res.status}`);
                            data = await res.json();
                        }

                        // simpan "semua" data untuk client-side processing
                        this.allCourses = data.data || [];

                        // ambil opsi jenis unik (buang null/empty)
                        this.jenisOptions = [...new Set(this.allCourses.map(c => c.jenis).filter(
                            Boolean))];

                        // setup pagination dasar (jika API memberikan meta/pagination gunakan itu, kalau tidak hitung client-side)
                        if (data.pagination) {
                            this.totalPages = data.pagination.last_page ?? Math.max(1, Math.ceil((
                                data.pagination.total ?? this.allCourses.length) / (data
                                .pagination.per_page ?? this.perPage)));
                            this.currentPage = Math.min(this.currentPage, this.totalPages);
                        } else if (data.meta) {
                            this.totalPages = data.meta.last_page ?? 1;
                            this.currentPage = data.meta.current_page ?? this.currentPage;
                        } else {
                            this.totalPages = Math.max(1, Math.ceil(this.allCourses.length / this
                                .perPage));
                            this.currentPage = Math.min(this.currentPage, this.totalPages);
                        }

                        // apply filter & pagination client-side
                        this.applyFiltersAndPagination();
                        console.log('FetchCourses done (useDummy=', useDummy, ')', {
                            totalAll: this.allCourses.length,
                            totalPages: this.totalPages
                        });
                    } catch (err) {
                        console.error('Fetch error:', err);
                        this.errorMessage = 'Gagal memuat data: ' + err.message;
                        this.courses = [];
                        this.allCourses = [];
                        this.jenisOptions = [];
                        this.totalPages = 1;
                    } finally {
                        this.isLoading = false;
                    }
                },

                // Terapkan filter pencarian + filter jenis + pagination (client-side)
                applyFiltersAndPagination() {
                    let list = (this.allCourses || []).slice();

                    // filter jenis
                    if (this.jenisFilter) {
                        list = list.filter(c => (c.jenis || '') === this.jenisFilter);
                    }

                    // filter search (kode atau nama_id)
                    if (this.searchQuery && this.searchQuery.trim() !== '') {
                        const q = this.searchQuery.trim().toLowerCase();
                        list = list.filter(c =>
                            (c.kode || '').toString().toLowerCase().includes(q) ||
                            (c.nama_id || '').toString().toLowerCase().includes(q)
                        );
                    }

                    const total = list.length;
                    this.totalPages = Math.max(1, Math.ceil(total / this.perPage));
                    if (this.currentPage > this.totalPages) this.currentPage = this.totalPages;
                    if (this.currentPage < 1) this.currentPage = 1;

                    const start = (this.currentPage - 1) * this.perPage;
                    this.courses = list.slice(start, start + this.perPage);

                    // perbarui jenisOptions (opsional — tetap dari allCourses)
                    this.jenisOptions = [...new Set((this.allCourses || []).map(c => c.jenis).filter(
                        Boolean))];

                    // update checkbox status di DOM jika perlu
                    setTimeout(() => this.updateCheckboxStatus(), 100);
                },

                // helper untuk deretan page (menghasilkan array berisi number dan '...' string)
                pageRange() {
                    const pages = [];
                    if (this.totalPages <= 7) {
                        for (let i = 1; i <= this.totalPages; i++) pages.push(i);
                        return pages;
                    }
                    pages.push(1);
                    if (this.currentPage > 3) pages.push('...');
                    const start = Math.max(2, this.currentPage - 1);
                    const end = Math.min(this.totalPages - 1, this.currentPage + 1);
                    for (let i = start; i <= end; i++) pages.push(i);
                    if (this.currentPage < this.totalPages - 2) pages.push('...');
                    pages.push(this.totalPages);
                    return pages;
                },

                // ========== fungsi existing (checkbox, pilih, hapus, submit) ==========
                updateCheckboxStatus() {
                    setTimeout(() => {
                        const allCheckboxes = document.querySelectorAll(
                            'input[name="selected[]"]');
                        allCheckboxes.forEach(checkbox => {
                            try {
                                const courseData = JSON.parse(checkbox.value);
                                const isSelected = this.isCourseSelected(courseData.id);
                                checkbox.checked = isSelected;
                            } catch (e) {
                                console.error('Error parsing checkbox value:', e);
                            }
                        });
                    }, 100);
                },

                isCourseSelected(courseId) {
                    if (this.modalTarget === 'old') {
                        return this.selectedOldCourses.some(c => c.id === courseId);
                    } else if (this.modalTarget === 'new') {
                        return this.selectedNewCourses.some(c => c.id === courseId);
                    }
                    return false;
                },

                saveSelectedCourses() {
                    const checked = [...document.querySelectorAll('input[name="selected[]"]:checked')]
                        .map(el => {
                            try {
                                return JSON.parse(el.value);
                            } catch (e) {
                                console.error(e);
                                return null;
                            }
                        })
                        .filter(Boolean);

                    if (this.modalTarget === 'old') this.selectedOldCourses = checked;
                    else this.selectedNewCourses = checked;

                    this.$dispatch('close-modal', {
                        id: 'modal-tambah-matakuliah'
                    });
                },

                removeCourse(target, id) {
                    if (target === 'old') this.selectedOldCourses = this.selectedOldCourses.filter(c =>
                        c.id !== id);
                    else this.selectedNewCourses = this.selectedNewCourses.filter(c => c.id !== id);
                    this.updateCheckboxStatus();
                },

                async submitForm() {
                    const oldCourses = JSON.parse(JSON.stringify(this.selectedOldCourses));
                    const newCourses = JSON.parse(JSON.stringify(this.selectedNewCourses));
                    const payload = {
                        prodi: "{{ $prodi }}",
                        program_perkuliahan: "{{ $programPerkuliahan }}",
                        mata_kuliah_lama: oldCourses.map(c => c.id),
                        mata_kuliah_baru: newCourses.map(c => c.id),
                    };
                    console.log('Final Payload:', payload);
                    // kirim ke server sesuai kebutuhan...
                },

                // Init
                init() {
                    // fetch initial dataset (dummy atau API)
                    this.fetchCourses();

                    // watchers: bila perPage atau jenisFilter berubah langsung terapkan
                    this.$watch('perPage', () => {
                        this.currentPage = 1;
                        this.applyFiltersAndPagination();
                    });
                    this.$watch('jenisFilter', () => {
                        this.currentPage = 1;
                        this.applyFiltersAndPagination();
                    });

                    // event pagination
                    window.addEventListener('page-change', (e) => {
                        const p = parseInt(e.detail?.page, 10);
                        if (!Number.isNaN(p)) {
                            this.currentPage = Math.max(1, p);
                            this.applyFiltersAndPagination();
                        }
                    });
                    window.addEventListener('page-prev', () => {
                        if (this.currentPage > 1) {
                            this.currentPage -= 1;
                            this.applyFiltersAndPagination();
                        }
                    });
                    window.addEventListener('page-next', () => {
                        if (this.currentPage < this.totalPages) {
                            this.currentPage += 1;
                            this.applyFiltersAndPagination();
                        }
                    });
                    window.addEventListener('per-page-change', (e) => {
                        const v = parseInt(e.detail?.value, 10);
                        if (!Number.isNaN(v) && v > 0) {
                            this.perPage = v;
                            this.currentPage = 1;
                            this.applyFiltersAndPagination();
                        }
                    });

                    // when modal opens -> sync checkboxes (already handled in fetch)
                    this.$watch('modalTarget', (v) => {
                        if (v) setTimeout(() => this.updateCheckboxStatus(), 300);
                    });
                },
            }));
        });
    </script>

@endsection

@section('content')
    <div class="px-5 flex flex-col gap-5 box-border" x-data="mataKuliahForm">
        <x-typography variant="heading-h6" bold class="">Tambah Ekuivalensi</x-typography>
        <x-button.back href="{{ route('curriculum.equivalence') }}">Ekuivalensi Kurikulum</x-button.back>
        <x-container.container class="flex flex-col gap-5" x-data="{ showModalTambahMatakuliah: false }">
            <x-typography variant="heading-h6" bold class="">Tambah Ekuivalensi</x-typography>
            <x-container.container :class="'!px-0 !py-0 overflow-hidden'">
              <table class="w-full">
                <tbody>
                  <x-table.row class="text-[#262626]">
                    <x-table.cell class="bg-[#E8E8E8] text-start w-[30%]">Program Studi</x-table.cell>
                    <x-table.cell class="text-start bg-[#F5F5F5] font-bold w-[70%]">{{ $prodi }}</x-table.cell>
                  </x-table.row>
                  <x-table.row class="text-[#262626]">
                    <x-table.cell class="bg-[#F5F5F5] text-start w-[30%]">Program Perkuliahan</x-table.cell>
                    <x-table.cell class="text-start bg-[#FFFFFF] font-bold w-[70%]">{{ $programPerkuliahan }}</x-table.cell>
                  </x-table.row>
                </tbody>
              </table>
            </x-container>
            <!-- Mata Kuliah Kurikulum Lama -->
            <x-container.container :variant="'content-wrapper'" :class="'grid grid-cols-12 gap-5 items-center !px-0'">
              <x-typography :variant="'body-small-semibold'" class="col-span-2">Mata Kuliah Kurikulum Lama</x-typography>
                <x-container.container :variant="'content-wrapper'" :class="'col-span-10 flex flex-col !gap-2 !px-0'">
                    <input type="text" x-show="selectedOldCourses.length === 0" disabled placeholder="MK Kurikulum Lama" class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-500" />
                    <template x-for="course in selectedOldCourses" :key="course.id">
                        <x-container.container class="flex flex-row items-center justify-between">
                            <x-typography x-text="course.nama_id"></x-typography>
                            <button type="button" class="cursor-pointer" x-on:click="removeCourse('old', course.id)">
                              <img src="{{ asset('assets/icon-cleardata.svg') }}" alt="icon remove">
                            </button>
                        </x-container>
                    </template>
                </x-container>
            </x-container>
            <x-button.primary label="Tambah Mata Kuliah" class="self-end" x-on:click="modalTarget = 'old'; $dispatch('open-modal', {id: 'modal-tambah-matakuliah'})" />
            <!-- Mata Kuliah Kurikulum Baru -->
            <x-container.container :variant="'content-wrapper'" :class="'!px-0 grid grid-cols-12 gap-5 items-center'">
                <x-typography :variant="'body-small-semibold'" class="col-span-2">Mata Kuliah Kurikulum Baru</x-typography>
                <x-container.container :variant="'content-wrapper'" class="col-span-10 flex flex-col gap-2 !px-0">
                    <input type="text" x-show="selectedNewCourses.length === 0" disabled placeholder="MK Kurikulum Baru"
                        class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-500" />
                    <template x-for="course in selectedNewCourses" :key="course.id">
                        <x-container.container
                            class="flex flex-row items-center justify-between ">
                            <x-typography x-text="course.nama_id"></x-typography>
                            <button type="button" class="cursor-pointer" x-on:click="removeCourse('new', course.id)"><img
                                    src="{{ asset('assets/icon-cleardata.svg') }}" alt="icon remove"></button>
                        </x-container>
                    </template>
                </x-container>
            </x-container>
            <x-button.primary label="Tambah Mata Kuliah" class="self-end"
                x-on:click="modalTarget = 'new'; $dispatch('open-modal', {id: 'modal-tambah-matakuliah'})" />
            <x-container.container :variant="'content-wrapper'" :class="'flex flex-row gap-5 justify-end !px-0'">
                <x-button.secondary label="Batal" x-on:click="window.location.href='{{ route('curriculum.equivalence') }}'" />
                <x-button.primary label="Simpan" x-on:click="$dispatch('open-modal', {id: 'save-confirmation'});" />
            </x-container>
        </x-container>

        {{-- MODAL TAMBAH Mata Kuliah --}}
        <x-modal.container id="modal-tambah-matakuliah" maxWidth="7xl"
            x-on:open-modal.window="if ($event.detail.id === 'modal-tambah-matakuliah') {
                show = true;
                setTimeout(() => $root.updateCheckboxStatus(), 200);
            }"
            x-on:close-modal.window="if ($event.detail.id === 'modal-tambah-matakuliah') { show = false; }">
            <x-slot name="header">
                <x-container.container :variant="'content-wrapper'" :class="'relative !px-0 !py-0'">
                    <x-typography variant="heading-h5" class="w-full inline-block text-center text-gray-800">
                        Daftar Mata Kuliah
                    </x-typography>
                    <button x-on:click.stop="close()"
                        class="text-gray-400 hover:text-gray-500 focus:outline-none absolute right-0 cursor-pointer">
                        <x-icon iconUrl="{{ asset('assets/base/icon-close-cancel.svg') }}"
                            class="w-[32px] h-[32px] cursor-pointer" />
                    </button>
                </x-container>
            </x-slot>

            <x-container.container :variant="'content-wrapper'" class="text-gray-800 flex flex-col gap-5">
                <!-- Konten modal -->

                {{-- TODO: Filter belum jalan--}}
                <x-container.container :variant="'content-wrapper'" class="grid grid-cols-12 gap-5 items-center !px-0">
                    <x-typography :variant="'body-small-semibold'" class="col-span-2">Jenis Mata Kuliah</x-typography>
                    <x-container.container :variant="'content-wrapper'" class="!px-0 !py-0 col-span-10">
                        <x-form.input name="course_type" type="select" :options="[
                            '' => 'Pilih Jenis MK',

                        ] + array_merge(...array_map(function ($jenis) {
                              return [$jenis => $jenis];
                            }, $jenisMataKuliah))" />
                    </x-container>
                </x-container>

                <x-container.container :variant="'content-wrapper'" class="!px-0 grid grid-cols-12 gap-5 items-center">
                    <x-typography :variant="'body-small-semibold'" class="col-span-2">Mata Kuliah</x-typography>
                    <x-container.container :variant="'content-wrapper'" :class="'col-span-10 !px-0'">
                        <x-form.input name="matakuliah" type="text" placeholder="Ketik Mata Kuliah"
                            x-model="searchQuery" />
                    </x-container>
                </x-container>

                <x-container.container :variant="'content-wrapper'" :class="'flex flex-row !px-0 justify-end gap-5'">
                    <x-button.secondary label="Batal" x-on:click="" />
                    <x-button.primary type="submit" label="Cari" x-on:click="currentPage = 1; applyFiltersAndPagination()" />
                </x-container>

                <x-table.index>
                    <x-table.head>
                        <x-table.row>
                            <x-table.header-cell></x-table.header-cell>
                            <x-table.header-cell>Kode Mata Kuliah</x-table.header-cell>
                            <x-table.header-cell>Nama</x-table.header-cell>
                            <x-table.header-cell>Jumlah SKS</x-table.header-cell>
                            <x-table.header-cell>Program Studi</x-table.header-cell>
                            <x-table.header-cell>Jenis Mata Kuliah</x-table.header-cell>
                        </x-table.row>
                    </x-table.head>

                    <x-table.body>
                        <template x-if="isLoading">
                            <x-table.row>
                                <x-table.cell colspan="7" class="text-center py-4">
                                    Memuat data...
                                </x-table.cell>
                            </x-table.row>
                        </template>

                        <template x-if="errorMessage">
                            <x-table.row>
                                <x-table.cell colspan="7" class="text-center py-4 text-red-500"
                                    x-text="errorMessage">
                                </x-table.cell>
                            </x-table.row>
                        </template>

                        <template x-if="!isLoading && courses.length > 0">
                            <template x-for="(item, index) in courses" :key="item.id">
                                <x-table.row>
                                    <x-table.cell>
                                        <input type="checkbox" name="selected[]"
                                            class="form-checkbox h-5 w-5 text-blue-600" :value="JSON.stringify(item)">
                                    </x-table.cell>
                                    <x-table.cell x-text="item.kode"></x-table.cell>
                                    <x-table.cell x-text="item.nama_id"></x-table.cell>
                                    <x-table.cell x-text="item.sks"></x-table.cell>
                                    <x-table.cell x-text="item.semester"></x-table.cell>
                                    <x-table.cell x-text="item.jenis"></x-table.cell>
                                </x-table.row>
                            </template>
                        </template>

                        <template x-if="!isLoading && courses.length === 0">
                            <x-table.row>
                                <x-table.cell colspan="7" class="text-center py-4">
                                    Tidak ada data mata kuliah
                                </x-table.cell>
                            </x-table.row>
                        </template>
                    </x-table.body>
                </x-table.index>
            </x-container>

            <x-slot name="footer">
                <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between gap-4 !px-5'">
                    {{-- TODO: Pagination --}}
                    <x-pagination :currentPage="1" :totalPages="1" :perPageInput="10" :onPageChange="'window.dispatchEvent(new CustomEvent(`page-change`, { detail: { page: {page} } }))'" :onPrevious="'window.dispatchEvent(new CustomEvent(`page-prev`))'" :onNext="'window.dispatchEvent(new CustomEvent(`page-next`))'" :onPerPageChange="'window.dispatchEvent(new CustomEvent(`per-page-change`, { detail: { value: this.value } }))'" />
                    <x-button.primary label="Simpan" x-on:click="saveSelectedCourses()" />
                </x-container>
            </x-slot>
        </x-modal.container>

        <!-- Modal Konfirmasi Simpan -->
        <div class="" @on-submit.window="await submitForm()">
            <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang" cancelText="Cek Kembali">
                <x-typography>Apakah Anda yakin informasi yang ditambahkan sudah benar?</x-typography>
            </x-modal.confirmation>
        </div>
    </div>
@endsection
