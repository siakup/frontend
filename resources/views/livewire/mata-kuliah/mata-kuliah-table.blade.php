<div class="flex flex-col gap-5" x-data="mataKuliahTable">
    <x-container variant="content" class="flex flex-col gap-5">
        <x-typography variant="heading-h6" class="mb-2">
            Daftar Mata Kuliah
        </x-typography>

        <div class="flex flex-col gap-5" x-data="{ itemToDelete: null }" x-cloak>
            <div class="flex flex-col gap-5" x-data="{ itemToDelete: null }" x-cloak>
                <form action="{{ route('study.index') }}" method="GET"
                    class="flex flex-col md:flex-row justify-between items-center gap-4 border border-gray-300 rounded-3xl p-5 w-full">

                    <div class="flex-1 relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Kode Mata Kuliah / Nama Mata Kuliah / Jenis Mata Kuliah"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 pl-10"
                            onkeypress="if(event.key === 'Enter') this.form.submit();" />
                        <button type="submit" class="absolute right-2 top-2">
                            <img src="{{ asset('assets/icon-search.svg') }}" class="h-4 w-4" />
                        </button>
                    </div>

                    <div class="flex gap-3 justify-end flex-wrap md:flex-nowrap mt-2 md:mt-0">
                        <!-- Program Studi Dropdown -->
                        <select name="programStudi" class="border border-gray-300 rounded-lg px-4 py-2"
                            onchange="this.form.submit();">
                            <option value="">Semua Program Studi</option>
                            @foreach ($programStudiList as $prodi)
                                <option value="{{ $prodi->id_institusi }}"
                                    {{ request('programStudi') == $prodi->id_institusi ? 'selected' : '' }}>
                                    {{ $prodi->nama_institusi }}
                                </option>
                            @endforeach
                        </select>

                        <select name="sortBy" class="border border-gray-300 rounded-lg px-4 py-2"
                            onchange="this.form.submit();">
                            <option value="nama_asc" {{ request('sortBy') == 'nama_asc' ? 'selected' : '' }}>A-Z
                            </option>
                            <option value="nama_desc" {{ request('sortBy') == 'nama_desc' ? 'selected' : '' }}>Z-A
                            </option>
                            <option value="created_desc" {{ request('sortBy') == 'created_desc' ? 'selected' : '' }}>
                                Terbaru</option>
                            <option value="created_asc" {{ request('sortBy') == 'created_asc' ? 'selected' : '' }}>
                                Terlama</option>
                        </select>
                    </div>
                </form>
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
