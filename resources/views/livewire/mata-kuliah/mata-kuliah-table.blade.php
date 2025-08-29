<div class="flex flex-col gap-5" x-data="mataKuliahTable">
    <x-container variant="content" class="flex flex-col gap-5">
        <x-typography variant="heading-h6" class="mb-2">
            Daftar Mata Kuliah
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
                        <select wire:model="programStudi" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">Semua Program Studi</option>
                            @foreach ($programStudiList as $prodi)
                                <option value="{{ $prodi->id_institusi }}">{{ $prodi->nama_institusi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort By Dropdown -->
                    <div class="w-full md:w-auto">
                        <select wire:model.live="sortBy" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            <option value="nama">A-Z</option>
                            <option value="kode">Z-A</option>
                            <option value="semester">Terbaru</option>
                            <option value="sks">Terlama</option>
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
                        <x-table-header>Jumlah SKS</x-table-header>
                        <x-table-header>Semester</x-table-header>
                        <x-table-header>Jenis Mata Kuliah</x-table-header>
                        <x-table-header>Aksi</x-table-header>
                    </x-table-row>
                </x-table-head>

                <x-table-body>
                    <template x-if="mataKuliahList.length > 0">
                        <template x-for="(matkul, idx) in mataKuliahList" :key="matkul.kode">
                            <x-table-row x-bind:odd="idx % 2 === 1" x-bind:last="idx === mataKuliahList.length - 1">
                                <x-table-cell x-text="matkul.kode"></x-table-cell>
                                <x-table-cell x-text="matkul.nama_id"></x-table-cell>
                                <x-table-cell x-text="matkul.sks"></x-table-cell>
                                <x-table-cell x-text="matkul.semester"></x-table-cell>
                                <x-table-cell>
                                    <span class="px-2 py-1 rounded-full text-xs"
                                        :class="matkul.jenis === 'Wajib' ?
                                            'bg-blue-100 text-blue-800' :
                                            'bg-purple-100 text-purple-800'">
                                        <span x-text="matkul.id_jenis"></span>
                                    </span>
                                </x-table-cell>
                                <x-table-cell>
                                    <div class="flex gap-3 justify-center">
                                        <a :href="`{{ route('study.view', ':id') }}`.replace(':id', matkul.id)">
                                            <x-button.action type="view" label="Lihat" />
                                        </a>
                                        <a :href="`{{ route('study.edit', ':id') }}`.replace(':id', matkul.id)">
                                            <x-button.action type="edit" label="Edit" />
                                        </a>
                                        <x-button.action type="delete" label="Hapus"
                                            @click="$dispatch('open-modal', {
                        id: 'delete-confirmation',
                        detail: { id: matkul.kode, name: matkul.nama }
                    })" />
                                    </div>
                                </x-table-cell>
                            </x-table-row>
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
                <a href="{{ route('study.upload') }}">
                    <x-button.secondary type="button" label="Unggah Mata Kuliah"
                        icon="{{ asset('assets/icon-upload-red-500.svg') }}" iconPosition="right" />
                </a>
                <a href="{{ route('study.create') }}">
                    <x-button.primary type="button" label="Tambah Mata Kuliah"
                        icon="{{ asset('assets/icon-plus-white.svg') }}" iconPosition="right" />
                </a>
            </div>

        </div>
    </x-container>

    {{-- !!! TODO: Benerin --}}
    <!-- Pagination and Per Page Selector -->
    @if (isset($data['data']))
        @include('partials.pagination', [
            'currentPage' => $data['pagination']['current_page'],
            'lastPage' => $data['pagination']['last_page'],
            'limit' => $limit,
            'routes' => route('academics-event.index'),
        ])
    @endif
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('mataKuliahTable', () => ({
                mataKuliahList: @json($mataKuliahList),
                programStudi: '',
                sortBy: 'nama',
                sortDirection: 'asc',
                page: 1,
                perPage: 10
            }));
        });
    </script>



</div>

@section('modals')
    <div x-data class="text-gray-800">
        <!-- Modal Konfirmasi Hapus -->
        <x-modal.confirmation iconUrl="{{ asset('assets/icon-delete-gray-800.svg') }}" id="delete-confirmation"
            title="Hapus Daftar Mata Kuliah" confirmText="Ya, Hapus" cancelText="Batal"
            x-on:open-modal.window="if ($event.detail.id === 'delete-confirmation') {
            item = $event.detail.detail;
            show = true;
        }">
            <p class="text-gray-800">Apakah Anda yakin ingin menghapus mata kuliah ini?</p>

            <div
                x-on:confirmed.window="
            @this.call('deleteMataKuliah', item.id)
                .then(() => {
                    $dispatch('show-notification', {
                        type: 'success',
                        message: 'Mata kuliah berhasil dihapus'
                    });
                });
        ">
            </div>
        </x-modal.confirmation>
    </div>
@endsection
