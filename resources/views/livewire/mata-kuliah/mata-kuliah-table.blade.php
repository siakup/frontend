<div class="flex flex-col gap-5">
    <x-container variant="content" class="flex flex-col gap-5">
        <x-typography variant="heading-h6" class="mb-2">
            Daftar Mata Kuliah
        </x-typography>

        <div class="flex flex-col gap-5" x-data="{ itemToDelete: null }" x-cloak>
            <!-- Search and Filters -->
            <div
                class="p-5 flex flex-col md:flex-row justify-between items-center gap-4 border border-gray-200 rounded-3xl">
                <!-- Search Input -->
                <div class="w-full md:w-1/3">
                    <input type="text" wire:model.live.debounce.300ms="search"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Cari mata kuliah...">
                </div>

                <!-- Filter and Sort Buttons -->
                <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                    <!-- Program Studi Dropdown -->
                    <div class="w-full md:w-auto">
                        <select wire:model.live="programStudi"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">Semua Program Studi</option>
                            @foreach ($prodiOptions as $prodi)
                                <option value="{{ $prodi }}">{{ $prodi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort By Dropdown -->
                    <div class="w-full md:w-auto">
                        <select wire:model.live="sortBy" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            <option value="nama">Sort by: Nama</option>
                            <option value="kode">Sort by: Kode</option>
                            <option value="semester">Sort by: Semester</option>
                            <option value="sks">Sort by: SKS</option>
                        </select>
                    </div>

                    <!-- Sort Direction Toggle -->
                    <button wire:click="$toggle('sortDirection')"
                        class="px-4 py-2 border border-gray-300 rounded-lg flex items-center gap-2">
                        @if ($sortDirection === 'asc')
                            <x-icon name="arrow-up" class="h-4 w-4" />
                        @else
                            <x-icon name="arrow-down" class="h-4 w-4" />
                        @endif
                        {{ $sortDirection === 'asc' ? 'A-Z' : 'Z-A' }}
                    </button>
                </div>
            </div>

            <!-- Table -->
            <x-table>
                <x-table-head>
                    <x-table-row>
                        <x-table-header wire:click="sort('kode')" class="cursor-pointer">
                            Kode @if ($sortBy === 'kode')
                                ({{ $sortDirection === 'asc' ? '↑' : '↓' }})
                            @endif
                        </x-table-header>
                        <x-table-header wire:click="sort('nama')" class="cursor-pointer">
                            Nama @if ($sortBy === 'nama')
                                ({{ $sortDirection === 'asc' ? '↑' : '↓' }})
                            @endif
                        </x-table-header>
                        <x-table-header wire:click="sort('sks')" class="cursor-pointer">
                            SKS @if ($sortBy === 'sks')
                                ({{ $sortDirection === 'asc' ? '↑' : '↓' }})
                            @endif
                        </x-table-header>
                        <x-table-header wire:click="sort('semester')" class="cursor-pointer">
                            Semester @if ($sortBy === 'semester')
                                ({{ $sortDirection === 'asc' ? '↑' : '↓' }})
                            @endif
                        </x-table-header>
                        <x-table-header>Jenis</x-table-header>
                        <x-table-header>Aksi</x-table-header>
                    </x-table-row>
                </x-table-head>

                <x-table-body>
                    @forelse ($mataKuliahList as $matkul)
                        <x-table-row :odd="$loop->odd" :last="$loop->last">
                            <x-table-cell>{{ $matkul['kode'] }}</x-table-cell>
                            <x-table-cell>{{ $matkul['nama'] }}</x-table-cell>
                            <x-table-cell>{{ $matkul['sks'] }}</x-table-cell>
                            <x-table-cell>{{ $matkul['semester'] }}</x-table-cell>
                            <x-table-cell>
                                <span
                                    class="px-2 py-1 rounded-full text-xs
                            {{ $matkul['jenis'] === 'Wajib' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ $matkul['jenis'] }}
                                </span>
                            </x-table-cell>
                            <x-table-cell>
                                <div class="flex gap-3 justify-center">
                                    <a href="{{ route('subject.view') }}" class="">
                                        <x-button.action type="view" label="Lihat" />
                                    </a>
                                    <a href="{{ route('subject.edit') }}" class="">
                                        <x-button.action type="edit" label="Edit" />
                                    </a>
                                    <!-- Tombol Delete -->
                                    <x-button.action type="delete" label="Hapus"
                                        x-on:click="
                                    $dispatch('open-modal', {
                                        id: 'delete-confirmation',
                                        detail: {
                                            id: '{{ $matkul['kode'] }}',
                                            name: '{{ $matkul['nama'] }}'
                                        }
                                    });
                                " />
                                </div>

                            </x-table-cell>
                        </x-table-row>
                    @empty
                        <x-table-row>
                            <x-table-cell colspan="6" class="text-center py-4">
                                Tidak ada data ditemukan
                            </x-table-cell>
                        </x-table-row>
                    @endforelse
                </x-table-body>
            </x-table>

            <!-- Action Buttons -->
            <div class="flex justify-end items-center gap-5">
                <x-button.secondary type="button" label="Unggah Mata Kuliah"
                    icon="{{ asset('assets/icon-upload-red-500.svg') }}" iconPosition="right" />
                <a href="{{ route('subject.create') }}">
                    <x-button.primary type="button" label="Tambah Mata Kuliah"
                        icon="{{ asset('assets/icon-plus-white.svg') }}" iconPosition="right" />
                </a>
            </div>

        </div>
    </x-container>

    <!-- Pagination and Per Page Selector -->
    <livewire:custom-pagination :paginator="$mataKuliahList" />
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
            <p class="text-gray-800">Apakah anda yakin ingin menghapus?</p>

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
