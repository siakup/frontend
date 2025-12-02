@extends('layouts.main')

@section('title', 'Mata Kuliah')

@section('javascript')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

{{-- END --}}


@section('content')
    <div class="px-5 flex flex-col gap-5">
        <x-typography variant="heading-h6" bold class="">
            Edit Mata Kuliah
        </x-typography>
        <x-container.container variant="content" class="gap-5 flex flex-col">
            <x-typography variant="body-medium-bold" class="">Detail Mata Kuliah</x-typography>

            <div class="space-y-5">
                <!-- Single column fields (2:10 ratio) -->
                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Program Studi
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        {{-- Program Studi --}}
                        @php
                            $options = ['' => 'Pilih Program Studi']
                                + collect($programStudiList)->pluck('nama_institusi', 'id_institusi')->toArray();
                        @endphp
                        <x-form.input
                            name="study_program"
                            type="select"
                            :value="old('study_program', $mataKuliah->id_prodi)"
                            :options="$options"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Kode MK
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        {{-- Kode MK --}}
                        <x-form.input
                            name="code"
                            type="text"
                            placeholder="Contoh: IF184101"
                            :value="old('code', $mataKuliah->kode_matakuliah)"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Nama MK
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        {{-- Nama MK --}}
                        <x-form.input
                            name="name"
                            type="text"
                            placeholder="Nama Mata Kuliah"
                            :value="old('name', $mataKuliah->nama_matakuliah_id)"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Nama MK (English)
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        {{-- Nama MK (English) --}}
                        <x-form.input
                            name="english_name"
                            type="text"
                            placeholder="Course Name (English)"
                            :value="old('english_name', $mataKuliah->nama_matakuliah_en)"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Nama Singkat
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input
                            name="short_name"
                            type="text"
                            placeholder="Singkatan resmi MK"
                            :value="old('short_name', $mataKuliah->nama_singkat)"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Jumlah SKS
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input
                            name="credits"
                            type="number"
                            placeholder="1-6 SKS"
                            min="1"
                            max="6"
                            :value="old('credits', $mataKuliah->sks)"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Semester
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input
                            name="semester"
                            type="number"
                            placeholder="1-8"
                            min="1"
                            max="8"
                            :value="old('semester', $mataKuliah->semester)"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Tujuan MK
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input
                            name="objective"
                            type="textarea"
                            placeholder="Tujuan pembelajaran mata kuliah"
                            rows="3"
                            :value="old('objective', $mataKuliah->tujuan)"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Deskripsi
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input
                            name="description"
                            type="textarea"
                            placeholder="Deskripsi singkat mata kuliah"
                            rows="3"
                            :value="old('description', $mataKuliah->deskripsi)"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Daftar Pustaka
                        </x-typography>
                    </div>
                    <div class="col-span-10">
                        <x-form.input
                            name="bibliography"
                            type="textarea"
                            placeholder="Referensi utama dan pendukung"
                            rows="3"
                            :value="old('bibliography', $mataKuliah->daftar_pustaka)"
                        />
                    </div>
                </div>

                <!-- Double column fields (2:4:2:4 ratio) -->
                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Jenis MK
                        </x-typography>
                    </div>

                    @php
                        $optionsJenis = ['' => 'Pilih Jenis MK'] +
                            collect($jenisMataKuliah)
                                ->mapWithKeys(fn($item) => [$item => $item])
                                ->toArray();

                        $optionsKoordinator = ['' => 'Pilih Koordinator'] +
                            collect($dosenList)->pluck('nama','id_dosen')->toArray();
                    @endphp

                    <div class="col-span-4">
                        <x-form.input
                            name="course_type"
                            type="select"
                            :options="$optionsJenis"
                            :value="$mataKuliah->id_jenis"
                        />
                    </div>

                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Koordinator
                        </x-typography>
                    </div>

{{--                    TODO: Confirm that the id_koordinator of the selected mataKuliah is found in the list of lecturers--}}
                    <div class="col-span-4">
                        <x-form.input
                            name="coordinator"
                            type="select"
                            :options="$optionsKoordinator"
                            :value="$mataKuliah->id_koordinator"
                        />
                    </div>

                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Spesial
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input
                            name="special_course"
                            type="select"
                            :options="[
                '' => 'Pilih Status',
                'ya' => 'Ya (MK Khusus)',
                'tidak' => 'Tidak (MK Reguler)',
            ]"
                            :value="old('special_course', $mataKuliah->matakuliah_spesial ? 'ya' : 'tidak')"
                        />
                    </div>

                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Untuk Prodi Lain
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input
                            name="open_for_other"
                            type="select"
                            :options="[
                '' => 'Pilih Status',
                'ya' => 'Ya (Terbuka)',
                'tidak' => 'Tidak (Eksklusif)',
            ]"
                            :value="old('open_for_other', $mataKuliah->prodi_lain ? 'ya' : 'tidak')"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Wajib
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input
                            name="mandatory"
                            type="select"
                            :options="[
                '' => 'Pilih Status',
                'ya' => 'Ya (Harus Diambil)',
                'tidak' => 'Tidak (Opsional)',
            ]"
                            :value="old('mandatory', $mataKuliah->matakuliah_wajib ? 'ya' : 'tidak')"
                        />
                    </div>

                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Merdeka
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input
                            name="merdeka_campus"
                            type="select"
                            :options="[
                '' => 'Pilih Status',
                'ya' => 'Ya (Program Merdeka)',
                'tidak' => 'Tidak (Reguler)',
            ]"
                            :value="old('merdeka_campus', $mataKuliah->kampus_merdeka ? 'ya' : 'tidak')"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Capstone
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input
                            name="capstone"
                            type="select"
                            :options="[
                '' => 'Pilih Status',
                'ya' => 'Ya (Proyek Akhir)',
                'tidak' => 'Tidak (MK Biasa)',
            ]"
                            :value="old('capstone', $mataKuliah->matakuliah_capstone ? 'ya' : 'tidak')"
                        />
                    </div>

                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Kerja Praktik
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input
                            name="internship"
                            type="select"
                            :options="[
                '' => 'Pilih Status',
                'ya' => 'Ya (Program Magang)',
                'tidak' => 'Tidak (Non-Magang)',
            ]"
                            :value="old('internship', $mataKuliah->matakuliah_kerja_praktik ? 'ya' : 'tidak')"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Tugas Akhir
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input
                            name="final_assignment"
                            type="select"
                            :options="[
                '' => 'Pilih Status',
                'ya' => 'Ya (Skripsi/Tesis)',
                'tidak' => 'Tidak (Non-TA)',
            ]"
                            :value="old('final_assignment', $mataKuliah->matakuliah_tugas_akhir ? 'ya' : 'tidak')"
                        />
                    </div>

                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            MK Minor
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-form.input
                            name="minor"
                            type="select"
                            :options="[
                '' => 'Pilih Status',
                'ya' => 'Ya (Program Minor)',
                'tidak' => 'Tidak (Non-Minor)',
            ]"
                            :value="old('minor', $mataKuliah->matakuliah_minor ? 'ya' : 'tidak')"
                        />
                    </div>
                </div>


                <div class="grid grid-cols-12 gap-5 items-center">
                    <div class="col-span-2">
                        <x-typography variant="body-small-regular" class="font-semibold">
                            Status
                        </x-typography>
                    </div>
                    <div class="col-span-4">
                        <x-button.switch
                            name="user_active"
                            externalOnLabel="Aktif"
                            externalOffLabel="Tidak Aktif"
                            :value="old('user_active', $mataKuliah->status === 'active')"
                        />
                    </div>
                    <div class="col-span-2"></div>
                    <div class="col-span-4"></div>
                </div>

            </div>


        </x-container>

        <x-container.container variant="content">
            <div class="flex justify-between mb-5" x-data="{ showTambahPrasyaratModal: false }">
                <x-typography variant="body-medium-bold" class="mb-5">Mata Kuliah Prasyarat</x-typography>
                <x-button.primary label="Tambah Mata Kuliah Prasyarat"
                                  x-on:click="$dispatch('open-modal', {id: 'tambah-prasyarat-modal'})"/>
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
                        <x-table.header-cell>
                            Jumlah SKS
                        </x-table.header-cell>
                        <x-table.header-cell>Aksi</x-table.header-cell>
                    </x-table.row>
                </x-table.head>

                <x-table.body x-data="{ showDeleteConfirmation: false, item: null }">
                    @if (count($addedPrasyarat) > 0)
                        @foreach ($addedPrasyarat as $matkul)
                            <x-table.row :odd="$loop->odd" :last="$loop->last">
                                {{-- Kode Mata Kuliah --}}
                                <x-table.cell>{{ $matkul->kode_matakuliah }}</x-table.cell>

                                {{-- Nama Mata Kuliah (ID) --}}
                                <x-table.cell>{{ $matkul->nama_matakuliah_id }}</x-table.cell>

                                {{-- Jenis MK --}}
                                <x-table.cell>{{ $matkul->id_jenis }}</x-table.cell>

                                {{-- SKS --}}
                                <x-table.cell class="text-center">{{ $matkul->sks }}</x-table.cell>

                                {{-- Aksi --}}
                                <x-table.cell>
                                    <div class="flex gap-3 justify-center">
                                        <a href="{{ route('subject.edit', ['id' => $matkul->id_matakuliah]) }}">
                                            <x-button.action type="edit" label="Edit"/>
                                        </a>
                                        <x-button.action
                                            type="delete"
                                            label="Hapus"
                                            x-on:click="
                        $dispatch('open-modal', {
                            id: 'delete-confirmation',
                            detail: {
                                id: '{{ $matkul->id_matakuliah }}',
                                name: '{{ $matkul->nama_matakuliah_id }}'
                            }
                        });
                    "
                                        />
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @endforeach

                    @else
                        <x-table.row>
                            <x-table.cell colspan="5" class="text-center py-4">
                                Tidak ada data prasyarat yang ditambahkan
                            </x-table.cell>
                        </x-table.row>
                    @endif
                </x-table.body>

            </x-table.index>
        </x-container>

        <div x-data="{ showCancelConfirm: false, showSaveConfirm: false }">
            <!-- Container Tombol -->
            <x-container.container>
                <div class="flex justify-end gap-5">
                    <!-- Tombol Batal -->
                    <x-button.secondary label="Batal"
                                        x-on:click="$dispatch('open-modal', {id: 'cancel-confirmation'})"/>

                    <!-- Tombol Simpan -->
                    <x-button.primary label="Simpan" x-on:click="$dispatch('open-modal', {id: 'save-confirmation'})"/>
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
                        <x-icon iconUrl="{{ asset('assets/base/icon-close-cancel.svg') }}" class="w-[32px] h-[32px]"/>
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
                        @php
                            $addedCodes = collect($addedPrasyarat)->pluck('kode_matakuliah')->toArray();
                        @endphp

                        <x-table.body>
                            @foreach ($prasyaratMataKuliahList as $index => $item)
                                <x-table.row :odd="$loop->odd" :last="$loop->last">
                                    {{-- Checkbox --}}
                                    <x-table.cell>
                                        <input
                                            type="checkbox"
                                            class="form-checkbox h-5 w-5 text-blue-600"
                                            name="selected[]"
                                            value="{{ $item->kode }}"
                                            {{ in_array($item->kode, $addedCodes, true) ? 'checked' : '' }}>
                                    </x-table.cell>

                                    {{-- Kode Mata Kuliah --}}
                                    <x-table.cell>{{ $item->kode }}</x-table.cell>

                                    {{-- Nama Mata Kuliah --}}
                                    <x-table.cell>{{ $item->nama_id }}</x-table.cell>

                                    {{-- SKS --}}
                                    <x-table.cell>{{ $item->sks }}</x-table.cell>

                                    {{-- Semester --}}
                                    <x-table.cell>{{ $item->semester }}</x-table.cell>

                                    {{-- Jenis Mata Kuliah --}}
                                    <x-table.cell>{{ $item->id_jenis }}</x-table.cell>

                                    {{-- Tipe (opsional) --}}
                                    <x-table.cell>{{ $item->tipe ?? '' }}</x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-table.body>

                    </x-table.index>
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex justify-center gap-4 w-full">
                    <x-pagination :currentPage="$currentPage" :totalPages="$totalPages" :perPageInput="$perPage"/>
                    <x-button.secondary label="Batal" x-on:click.stop="close()"/>
                    <x-button.primary label="Simpan" x-on:click.stop="close()"/>
                </div>
            </x-slot>
        </x-modal.container>
    </div>
@endsection
