@extends('layouts.main')

@section('title', 'Edit Ekuivalensi')

@section('javascript')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('mataKuliahForm', () => ({
                courses: [], // Untuk menyimpan data mata kuliah
                isLoading: false,
                errorMessage: null,

                selectedOldCourses: @json($selectedOldCourses), // list MK lama dari controller
                selectedNewCourses: @json($selectedNewCourses), // list MK baru dari controller
                modalTarget: null, // "old" atau "new" untuk tau simpan ke mana
                equivalenceId: @json($id), // ID ekuivalensi yang sedang diedit

                // Fungsi untuk mengambil data mata kuliah
                async fetchCourses() {
                    this.isLoading = true;
                    this.errorMessage = null;

                    try {
                        const url = `${window.LECTURER_API_URL}/courses`;
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

                // Fungsi untuk mengupdate status checkbox berdasarkan mata kuliah yang sudah dipilih
                updateCheckboxStatus() {
                    // Tunggu sampai DOM di-render ulang
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

                // Cek apakah course sudah dipilih (TERISOLASI berdasarkan modalTarget)
                isCourseSelected(courseId) {
                    // Hanya cek berdasarkan target modal yang sedang aktif
                    if (this.modalTarget === 'old') {
                        return this.selectedOldCourses.some(c => c.id === courseId);
                    } else if (this.modalTarget === 'new') {
                        return this.selectedNewCourses.some(c => c.id === courseId);
                    }
                    return false;
                },

                // Simpan dari modal
                saveSelectedCourses() {
                    const checked = [...document.querySelectorAll('input[name="selected[]"]:checked')]
                        .map(el => {
                            try {
                                return JSON.parse(el.value);
                            } catch (e) {
                                console.error('Error parsing selected value:', e);
                                return null;
                            }
                        })
                        .filter(item => item !== null);

                    if (this.modalTarget === 'old') {
                        this.selectedOldCourses = checked;
                    } else if (this.modalTarget === 'new') {
                        this.selectedNewCourses = checked;
                    }

                    this.$dispatch('close-modal', {
                        id: 'modal-tambah-matakuliah'
                    });
                },

                removeCourse(target, id) {
                    if (target === 'old') {
                        this.selectedOldCourses = this.selectedOldCourses.filter(c => c.id !== id);
                    } else {
                        this.selectedNewCourses = this.selectedNewCourses.filter(c => c.id !== id);
                    }

                    // Update checkbox status setelah menghapus
                    this.updateCheckboxStatus();
                },

                // Submit form untuk EDIT
                async submitForm() {
                    console.log('Submit form edit dipanggil untuk ID:', this.equivalenceId);

                    // Extract nilai sebenarnya dari Proxy array
                    const oldCourses = JSON.parse(JSON.stringify(this.selectedOldCourses));
                    const newCourses = JSON.parse(JSON.stringify(this.selectedNewCourses));

                    const payload = {
                        id: this.equivalenceId,
                        prodi: "{{ $prodi }}",
                        program_perkuliahan: "{{ $programPerkuliahan }}",
                        mata_kuliah_lama: oldCourses.map(c => c.id),
                        mata_kuliah_baru: newCourses.map(c => c.id),
                    };

                    console.log('Final Payload:', payload);
                    console.log('Mata kuliah lama IDs:', oldCourses.map(c => c.id));
                    console.log('Mata kuliah baru IDs:', newCourses.map(c => c.id));

                    // Simulasi update API
                    try {
                        // const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        // const res = await fetch(`http://localhost:8005/api/equivalence/${this.equivalenceId}`, {
                        //     method: 'PUT',
                        //     headers: {
                        //         'Content-Type': 'application/json',
                        //         'Accept': 'application/json',
                        //         'X-CSRF-TOKEN': token
                        //     },
                        //     body: JSON.stringify(payload)
                        // });
                        //
                        // if (!res.ok) throw new Error('Gagal mengupdate');
                        //
                        // const data = await res.json();
                        // console.log('Berhasil:', data);
                        // alert('Ekuivalensi berhasil diupdate!');
                        // window.location.href = '/curriculum/equivalence';

                        // Simulasi sukses
                        setTimeout(() => {
                            alert('Ekuivalensi berhasil diupdate!');
                            window.location.href = '{{ route('curriculum.equivalence') }}';
                        }, 1000);

                    } catch (error) {
                        console.error(error);
                        alert('Terjadi kesalahan: ' + error.message);
                    }
                },

                // Init function yang akan dijalankan ketika komponen dimuat
                init() {
                    this.fetchCourses(); // Otomatis fetch data saat komponen dimuat

                    // Event listener untuk submit form
                    this.$watch('modalTarget', (value) => {
                        if (value) {
                            setTimeout(() => this.updateCheckboxStatus(), 300);
                        }
                    });
                }
            }));
        });

        // Global event listener untuk submit form
        document.addEventListener('submit-form-event', function(e) {
            const component = Alpine.$data(document.querySelector('[x-data]'));
            if (component && component.submitForm) {
                component.submitForm();
            }
        });
    </script>
@endsection

@section('content')
    <x-container.container :variant="'content-wrapper'" class="px-5 flex flex-col gap-5 box-border" x-data="mataKuliahForm">
      <x-typography :variant="'body-large-semibold'">Edit Ekuivalensi</x-typography>
      <x-button.back href="{{ route('curriculum.equivalence') }}">Ekuivalensi Kurikulum</x-button.back>
        <x-container.container class="flex flex-col gap-5">
          <x-typography :variant="'body-medium-bold'">Edit Ekuivalensi</x-typography>

          <!-- Informasi Ekuivalensi -->
            <x-container.container :class="'!px-0 !py-0 overflow-hidden'">
              <table class="w-full">
                <tbody>
                  <x-table.row class="text-[#262626]">
                    <x-table.cell class="bg-[#E8E8E8] text-start w-[30%]">ID Ekuivalensi</x-table.cell>
                    <x-table.cell class="text-start bg-[#F5F5F5] font-bold w-[70%]">#{{ $id }}</x-table.cell>
                  </x-table.row>
                  <x-table.row class="text-[#262626]">
                    <x-table.cell class="bg-[#F5F5F5] text-start w-[30%]">Program Studi</x-table.cell>
                    <x-table.cell class="text-start bg-[#FFFFFF] font-bold w-[70%]">{{ $programPerkuliahan }}</x-table.cell>
                  </x-table.row>
                  <x-table.row class="text-[#262626]">
                    <x-table.cell class="bg-[#E8E8E8] text-start w-[30%]">Program Perkuliahan</x-table.cell>
                    <x-table.cell class="text-start bg-[#F5F5F5] font-bold w-[70%]">{{ $prodi }}</x-table.cell>
                  </x-table.row>
                </tbody>
              </table>
            </x-container>

            <!-- Mata Kuliah Kurikulum Lama -->
            <x-container.container :variant="'content-wrapper'" class="grid grid-cols-12 gap-5 items-center !px-0">
                <x-typography :variant="'body-small-semibold'" class="col-span-2">Mata Kuliah Kurikulum Lama</x-typography>
                <x-container.container :variant="'content-wrapper'" class="col-span-10 flex flex-col !gap-2 !px-0">
                    <input type="text" x-show="selectedOldCourses.length === 0" disabled placeholder="MK Kurikulum Lama"
                        class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-500" />

                    <template x-for="course in selectedOldCourses" :key="course.id">
                        <x-container.container class="flex items-center justify-between !px-3 !py-2">
                            <x-typography x-text="course.kode + ' - ' + course.nama_id"></x-typography>
                            <button type="button" class="cursor-pointer" x-on:click="removeCourse('old', course.id)">
                                <img src="{{ asset('assets/icon-cleardata.svg') }}" alt="icon remove">
                            </button>
                        </x-container>
                    </template>
                </x-container>
            </x-container>
            <x-button.primary label="Tambah Mata Kuliah" class="self-end"
                x-on:click="modalTarget = 'old'; $dispatch('open-modal', {id: 'modal-tambah-matakuliah'})" />

            <!-- Mata Kuliah Kurikulum Baru -->
            <x-container.container :variant="'content-wrapper'" class="grid grid-cols-12 !gap-5 items-center !px-0">
                <x-typography :variant="'body-small-semibold'" class="col-span-2">Mata Kuliah Kurikulum Baru</x-typography>
                <x-container.container :variant="'content-wrapper'" class="col-span-10 flex flex-col !gap-2 !px-0">
                    <input type="text" x-show="selectedNewCourses.length === 0" disabled placeholder="MK Kurikulum Baru"
                        class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-500" />

                    <template x-for="course in selectedNewCourses" :key="course.id">
                        <x-container.container
                            class="flex items-center justify-between !px-3 !py-2">
                            <x-typography x-text="course.kode + ' - ' + course.nama_id"></x-typography>
                            <button type="button" class="cursor-pointer" x-on:click="removeCourse('new', course.id)">
                                <img src="{{ asset('assets/icon-cleardata.svg') }}" alt="icon remove">
                            </button>
                        </x-container>
                    </template>
                </x-container>
            </x-container>
            <x-button.primary label="Tambah Mata Kuliah" class="self-end"
                x-on:click="modalTarget = 'new'; $dispatch('open-modal', {id: 'modal-tambah-matakuliah'})" />

            <x-container.container :variant="'content-wrapper'" class="flex flex-row gap-5 justify-end !px-0 mt-5">
                <x-button.secondary label="Batal"
                    x-on:click="window.location.href='{{ route('curriculum.equivalence') }}'" />
                <x-button.primary label="Update"
                    x-on:click="
                    $dispatch('open-modal', {id: 'save-confirmation'});
                    console.log('Selected Old:', JSON.parse(JSON.stringify(selectedOldCourses)));
                    console.log('Selected New:', JSON.parse(JSON.stringify(selectedNewCourses)));
                " />
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
                <x-container.container :variant="'content-wrapper'" class="!px-0 relative">
                    <x-typography variant="heading-h5" class="w-full inline-block text-center text-gray-800">
                        Daftar Mata Kuliah
                    </x-typography>
                    <button x-on:click.stop="close()" class="text-gray-400 hover:text-gray-500 focus:outline-none absolute right-0 cursor-pointer">
                        <x-icon iconUrl="{{ asset('assets/base/icon-close-cancel.svg') }}" class="w-[32px] h-[32px] cursor-pointer" />
                    </button>
                </x-container>
            </x-slot>

            <x-container.container :variant="'content-wrapper'" class="!p-4 text-gray-800 flex flex-col !gap-5">
                <!-- Konten modal -->
                <x-container.container :variant="'content-wrapper'" class="!px-0 grid grid-cols-12 !gap-5 items-center">
                    <x-typography :variant="'body-small-semibold'" class="col-span-2">Jenis Mata Kuliah</x-typography>
                    <x-container.container :variant="'content-wrapper'" class="!px-0 col-span-10">
                        <x-form.input name="jenis_matakuliah" type="select" placeholder="Pilih Jenis Mata Kuliah"
                            :options="[
                                '' => 'Pilih Jenis Mata Kuliah',
                                'du' => 'Mata Kuliah Dasar Umum',
                                'ps' => 'Mata Kuliah Program Studi',
                            ]" 
                        />
                    </x-container>
                </x-container>

                <x-container.container :variant="'content-wrapper'" class="!px-0 grid grid-cols-12 gap-5 items-center">
                    <x-typography :variant="'body-small-semibold'" class="col-span-2">Mata Kuliah</x-typography>
                    <x-container.container :variant="'content-wrapper'" class="col-span-10 !px-0">
                        <x-form.input name="matakuliah" type="text" placeholder="Ketik Mata Kuliah" />
                    </x-container>
                </x-container>

                <x-container.container :variant="'content-wrapper'" class="flex flex-row justify-end !gap-5 !px-0">
                    <x-button.secondary label="Batal" x-on:click="" />
                    <x-button.primary label="Cari" x-on:click="" />
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
                <x-container.container :variant="'content-wrapper'" class="!px-0 flex justify-between !gap-4 w-full">
                    {{-- TODO: Pagination --}}
                    <x-button.primary label="Simpan" x-on:click="saveSelectedCourses()" />
                </x-container>
            </x-slot>
        </x-modal.container>

        <!-- Modal Konfirmasi Update -->
        <div class="" @on-submit.window="await submitForm()">
            <x-modal.confirmation id="save-confirmation" title="Tunggu Sebentar" confirmText="Ya, Simpan Sekarang" cancelText="Cek Kembali">
                <x-typography :variant="'body-small-regular'" :class="'text-center flex items-center w-full justify-center'">Apakah Anda yakin informasi yang ditambahkan sudah benar?</x-typography>
            </x-modal.confirmation>
        </div>
    </x-container>
@endsection
