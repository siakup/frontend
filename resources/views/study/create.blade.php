@extends('layouts.main')

@section('title', 'Mata Kuliah')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Tambah Mata Kuliah</div>
@endsection

@section('css')

@endsection

@section('javascript')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('mataKuliahForm', () => ({
                courses: [], // Untuk menyimpan data mata kuliah
                selectedPrerequisites: [],
                isLoading: false,
                errorMessage: null,

                // Fungsi untuk mengambil data mata kuliah
                async fetchCourses() {
                    this.isLoading = true;
                    this.errorMessage = null;

                    try {
                        const url = `{{route('study.prerequisite-course')}}`;
                        const res = await fetch(url, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json'
                            }
                        });

                        if (!res.ok) throw new Error('Gagal memuat data');

                        const data = await res.json();
                        console.log('API Response:', data);

                        // Handle both array and object responses
                        if (Array.isArray(data)) {
                            this.courses = data;
                        } else if (data.data) {
                            this.courses = Array.isArray(data.data) ? data.data : [data.data];
                        } else {
                            this.courses = [];
                        }

                    } catch (err) {
                        console.error('Fetch error:', err);
                        this.errorMessage = 'Gagal memuat data: ' + err.message;
                        this.courses = [];
                    } finally {
                        this.isLoading = false;
                    }
                },

                // Fungsi submit form yang sudah ada
                async submitForm() {
                    if (window.event) {
                        window.event.stopImmediatePropagation();
                        window.event.preventDefault();
                    }

                    console.log('SubmitForm dijalankan');
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');

                    const payload = {
                        kode: document.querySelector('[name="code"]').value,
                        nama_id: document.querySelector('[name="name"]').value,
                        nama_en: document.querySelector('[name="english_name"]').value,
                        short_name: document.querySelector('[name="short_name"]').value,
                        sks: parseInt(document.querySelector('[name="credits"]').value || 0),
                        semester: parseInt(document.querySelector('[name="semester"]').value || 0),
                        id_prodi: document.querySelector('[name="study_program"]').value,
                        course_type: document.querySelector('[name="course_type"]').value,
                        coordinator: document.querySelector('[name="coordinator"]').value,
                        special_course: document.querySelector('[name="special_course"]').value,
                        open_for_other: document.querySelector('[name="open_for_other"]').value,
                        mandatory: document.querySelector('[name="mandatory"]').value,
                        merdeka_campus: document.querySelector('[name="merdeka_campus"]').value,
                        capstone: document.querySelector('[name="capstone"]').value,
                        internship: document.querySelector('[name="internship"]').value,
                        final_assignment: document.querySelector('[name="final_assignment"]').value,
                        minor: document.querySelector('[name="minor"]').value,
                        tujuan: document.querySelector('[name="objective"]').value,
                        deskripsi: document.querySelector('[name="description"]').value,
                        daftar_pustaka: document.querySelector('[name="bibliography"]').value,
                        status: document.querySelector('[name="user_active"]').checked ? 1 : 0,
                        created_by: 1,
                        updated_by: 1,
                        selected_prerequisites: this.selectedPrerequisites.map(selected => this.courses.find(course => course.kode == selected)),
                    };

                    console.log('Payload:', payload);

                    await new Promise(resolve => setTimeout(resolve, 1000));
                    console.log('Simulasi proses simpan selesai');
                    console.log(this.selectedPrerequisites);

                    try {
                        const res = await fetch('/mata-kuliah/tambah', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify(payload)
                        });
                    
                        if (!res.ok) throw new Error('Gagal menyimpan');
                    
                        const data = await res.json();
                        console.log('Berhasil:', data);
                        if(data.success) {
                          alert('Mata kuliah berhasil ditambahkan!');
                          window.location.href = "{{ route('study.index') }}";
                        } else {
                          throw new Error(data.message || "Gagal menambahkan mata kuliah")
                        }
                    } catch (error) {
                        console.error(error);
                        alert('Terjadi kesalahan: ' + error.message);
                    }
                },

                // Init function yang akan dijalankan ketika komponen dimuat
                init() {
                    this.fetchCourses(); // Otomatis fetch data saat komponen dimuat
                }
            }));
        });

        document.addEventListener('DOMContentLoaded', () => {
          const inputJenisMK = document.querySelector('select[name="course_type"]')
          
          inputJenisMK.addEventListener('input', () => {
            const inputProgramStudi = document.querySelector('select[name="study_program"]');
            if(inputJenisMK.value != "Mata Kuliah Program Studi") {
              const fixOption = new Option("Universitas Pertamina", "1");
              inputProgramStudi.add(fixOption);
              inputProgramStudi.disabled = true;
              inputProgramStudi.value = 1;
            } else {
              inputProgramStudi.disabled = false;
              inputProgramStudi.value = "";
              const deletedOption = inputProgramStudi.querySelectorAll('option[value="1"]');
              if(deletedOption) {
                Array.from(deletedOption).map(value => value.remove());
              }
            }
          })
        })
    </script>
@endsection
{{-- END --}}


@section('content')
    <div x-data="mataKuliahForm" class="px-5 flex flex-col gap-5">
        <x-typography variant="heading-h6" bold class="">
            Tambah Mata Kuliah
        </x-typography>
        <x-container.container variant="content" class="gap-5 flex flex-col">
            <x-typography variant="body-medium-bold" class="">Detail Mata Kuliah</x-typography>

            <div class="space-y-5">
                <!-- Single column fields (2:10 ratio) -->

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Kode MK
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input name="code" type="text" placeholder="Contoh: IF184101" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Nama MK
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input name="name" type="text" placeholder="Nama Mata Kuliah" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Nama MK (English)
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input name="english_name" type="text" placeholder="Course Name (English)" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Nama Singkat
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input name="short_name" type="text" placeholder="Singkatan resmi MK" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Jumlah SKS
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input name="credits" type="number" placeholder="1-6 SKS" min="1" max="6" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Semester
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input name="semester" type="number" placeholder="1-8" min="1" max="8" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Tujuan MK
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input name="objective" type="textarea" placeholder="Tujuan pembelajaran mata kuliah"
                            rows="3" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Deskripsi
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input name="description" type="textarea" placeholder="Deskripsi singkat mata kuliah"
                            rows="3" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Daftar Pustaka
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input name="bibliography" type="textarea" placeholder="Referensi utama dan pendukung"
                            rows="3" />
                    </div>
                </div>

                <!-- Double column fields (2:4:2:4 ratio) -->
                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Jenis MK
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input name="course_type" type="select" :options="[
                            '' => 'Pilih Jenis MK',
                            
                        ] + array_merge(...array_map(function ($jenis) {
                              return [$jenis => $jenis];
                            }, $jenis_mata_kuliah))" />
                    </div>
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Koordinator
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input name="coordinator" type="select" :options="[
                            '' => 'Pilih Koordinator',
                        ] + $pengajar" />
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-5 items-center">
                  <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Program Studi
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input name="study_program" type="select" placeholder="Pilih Program Studi"
                            :options="[
                                '' => 'Pilih Program Studi',
                            ] + $programStudiList" />

                    </div>
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Spesial
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input name="special_course" type="select" :options="[
                            '' => 'Pilih Status',
                            'ya' => 'Ya (MK Khusus)',
                            'tidak' => 'Tidak (MK Reguler)',
                        ]" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Wajib
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input name="mandatory" type="select" :options="[
                            '' => 'Pilih Status',
                            'ya' => 'Ya (Harus Diambil)',
                            'tidak' => 'Tidak (Opsional)',
                        ]" />
                    </div>
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Merdeka
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input name="merdeka_campus" type="select" :options="[
                            '' => 'Pilih Status',
                            'ya' => 'Ya (Program Merdeka)',
                            'tidak' => 'Tidak (Reguler)',
                        ]" />
                    </div>
                    
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Capstone
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input name="capstone" type="select" :options="[
                            '' => 'Pilih Status',
                            'ya' => 'Ya (Proyek Akhir)',
                            'tidak' => 'Tidak (MK Biasa)',
                        ]" />
                    </div>
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Kerja Praktik
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input name="internship" type="select" :options="[
                            '' => 'Pilih Status',
                            'ya' => 'Ya (Program Magang)',
                            'tidak' => 'Tidak (Non-Magang)',
                        ]" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Tugas Akhir
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input name="final_assignment" type="select" :options="[
                            '' => 'Pilih Status',
                            'ya' => 'Ya (Skripsi/Tesis)',
                            'tidak' => 'Tidak (Non-TA)',
                        ]" />
                    </div>
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Minor
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input name="minor" type="select" :options="[
                            '' => 'Pilih Status',
                            'ya' => 'Ya (Program Minor)',
                            'tidak' => 'Tidak (Non-Minor)',
                        ]" />
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-5 items-center">
                  <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Untuk Prodi Lain
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input name="open_for_other" type="select" :options="[
                            '' => 'Pilih Status',
                            'ya' => 'Ya (Terbuka)',
                            'tidak' => 'Tidak (Eksklusif)',
                        ]" />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Status
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-button.switch name="user_active" :value="true" externalOnLabel="Aktif"
                            externalOffLabel="Tidak Aktif" />
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

            {{-- TODO: Table prasyarat --}}
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
      
                <x-table.body>
                  <template x-if="!isLoading && selectedPrerequisites.length > 0">
                    <template x-for="(item, index) in selectedPrerequisites" :key="index">
                        <x-table.row x-data="{ course: courses.find(value => value.kode == item) }">
                            <x-table.cell x-text="course.kode"></x-table.cell>
                            <x-table.cell x-text="course.nama_id"></x-table.cell>
                            <x-table.cell x-text="course.type"></x-table.cell>
                            <x-table.cell>
                              <div class="flex items-center justify-center gap-3">
                                <button class="btn-icon btn-edit-periode-academic flex items-center" title="Ubah"
                                    style="text-decoration: none; color: inherit;" x-on:click="$dispatch('open-modal', {id: 'edit-prasyarat-modal', kode: course.kode})">
                                    <img src="{{ asset('assets/icon-edit.svg') }}" alt="Edit">
                                    <span style="color: #E62129">Ubah</span>
                                </button>
                                <button type="button" class="btn-icon btn-delete flex items-center" title="Hapus" @click="selectedPrerequisites.splice(index, 1)">
                                    <img src="{{ asset('assets/icon-delete-gray-600.svg') }}" alt="Hapus">
                                    <span class="text-[#8C8C8C]">Hapus</span>
                                </button>
                              </div>
                            </x-table.cell>
                        </x-table.row>
                    </template>
                </template>

                <template x-if="!isLoading && selectedPrerequisites.length === 0">
                    <x-table.row>
                        <x-table.cell colspan="7" class="text-center py-4">
                            Tidak ada data prasyarat yang ditambahkan
                        </x-table.cell>
                    </x-table.row>
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
                    <x-button.primary label="Simpan" x-data
                        x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})" />
                </div>
            </x-container>
        </div>
<div class="text-gray-800">
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
        <div class="" @on-submit.window="await submitForm()">
            <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang"
                cancelText="Cek Kembali">
                <p>Apakah Anda yakin informasi yang ditambahkan sudah benar?</p>
            </x-modal.confirmation>
        </div>

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
                                            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                x-bind:name="'selected[' + index + ']'"
                                                x-bind:value="item.kode" 
                                                x-model="selectedPrerequisites">
                                        </x-table.cell>
                                        <x-table.cell x-text="item.kode"></x-table.cell>
                                        <x-table.cell x-text="item.nama_id"></x-table.cell>
                                        <x-table.cell x-text="item.sks"></x-table.cell>
                                        <x-table.cell x-text="item.semester"></x-table.cell>
                                        <x-table.cell x-text="item.id_jenis"></x-table.cell>
                                        <x-table.cell>
                                            <x-form.input 
                                              name="" 
                                              type="select" 
                                              :options="[
                                                '' => 'Pilih Status',
                                                'Pre-Requisite' => 'Pre-Requisite',
                                                'Co-Requisite' => 'Co-Requisite',
                                              ]" 
                                              x-model="courses[index].type"
                                            />
                                        </x-table.cell>
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
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex justify-center gap-4 w-full">
                    {{-- TODO: Pagination --}}
                    <x-button.secondary label="Batal" x-on:click.stop="close()" />
                    <x-button.primary label="Simpan" x-on:click.stop="close()" />
                </div>
            </x-slot>
        </x-modal.container>

        {{-- MODAL EDIT PRASYARAT --}}
        <x-modal.container id="edit-prasyarat-modal" maxWidth="7xl"
            x-data="{ show: false, kode: null }"
            x-on:open-modal.window="if ($event.detail.id === 'edit-prasyarat-modal' && $event.detail.kode) { show = true; kode = $event.detail.kode }">
            <x-slot name="header">
                <div class="w-full relative">
                    <x-typography variant="heading-h5" class="w-full inline-block text-center text-gray-800">
                        Edit Mata Kuliah Prasyarat
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
                                  <template x-if="item.kode == kode">
                                    <x-table.row>
                                        <x-table.cell>
                                            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                x-bind:name="'selected[' + index + ']'"
                                                x-bind:value="item.kode" 
                                                x-model="selectedPrerequisites">
                                        </x-table.cell>
                                        <x-table.cell x-text="item.kode"></x-table.cell>
                                        <x-table.cell x-text="item.nama_id"></x-table.cell>
                                        <x-table.cell x-text="item.sks"></x-table.cell>
                                        <x-table.cell x-text="item.semester"></x-table.cell>
                                        <x-table.cell x-text="item.id_jenis"></x-table.cell>
                                        <x-table.cell>
                                            <x-form.input 
                                              name="" 
                                              type="select" 
                                              :options="[
                                                '' => 'Pilih Status',
                                                'Pre-Requisite' => 'Pre-Requisite',
                                                'Co-Requisite' => 'Co-Requisite',
                                              ]" 
                                              x-model="courses[index].type"
                                            />
                                        </x-table.cell>
                                    </x-table.row>
                                  </template>
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
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex justify-center gap-4 w-full">
                    {{-- TODO: Pagination --}}
                    <x-button.secondary label="Batal" x-on:click.stop="close()" />
                    <x-button.primary label="Simpan" x-on:click.stop="close()" />
                </div>
            </x-slot>
        </x-modal.container>
    </div>
    </div>
@endsection