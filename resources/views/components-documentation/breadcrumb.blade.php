@extends('layouts.main')

@section('title', 'Breadcrumb Documentation')

@section('content')
    <x-container.container variant="content-wrapper">
        <x-typography variant="body-large-semibold">Komponen Breadcrumb</x-typography>

        <div class="mb-8">
            <x-typography variant="body-medium-regular">
                Komponen navigasi jejak (breadcrumbs) dinamis yang mendukung penyingkatan otomatis (*truncation*) 
                jika kedalaman halaman melebihi 4 level. Menggunakan Alpine.js untuk interaktivitas *dropdown*.
            </x-typography>
        </div>

        <div class="p-6 border border-gray-200 rounded-lg bg-white mb-6">
            <x-typography variant="body-small-semibold" class="mb-2 text-gray-500">Kasus 1: Level Pendek (<= 4)</x-typography>
            
            <nav aria-label="breadcrumb">
                <ol class="flex items-center gap-2 m-0 p-0 list-none text-sm">
                    <li class="flex items-center gap-2 text-[#E62129]">
                        <a href="#">Home</a> <span>/</span>
                    </li>
                    <li class="flex items-center gap-2 text-[#E62129]">
                        <a href="#">Settings</a> <span>/</span>
                    </li>
                    <li class="flex items-center gap-2 text-[#333333]">
                        <span>Profile</span>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="p-6 border border-gray-200 rounded-lg bg-white mb-6 min-h-[150px]">
            <x-typography variant="body-small-semibold" class="mb-2 text-gray-500">Kasus 2: Deep Nesting (> 4 Level)</x-typography>
            <x-typography variant="body-small-regular" class="mb-4 text-gray-400">Klik ikon (...) untuk melihat level yang disembunyikan.</x-typography>

            <div class="relative"
                 x-data="{
                    mode: 'compact',
                    openDropdown: false,
                    full: [
                        { name: 'Home', url: '#', active: false },
                        { name: 'Level 1', url: '#', active: false },
                        { name: 'Level 2', url: '#', active: false }, // Hidden
                        { name: 'Level 3', url: '#', active: false }, // Hidden
                        { name: 'Sub-Category', url: '#', active: false },
                        { name: 'Current Page', url: '#', active: true }
                    ],
                    compact: [
                        { name: 'Home', url: '#', active: false },
                        { name: '…', url: '#', active: false }, // Ellipsis
                        { name: 'Sub-Category', url: '#', active: false },
                        { name: 'Current Page', url: '#', active: true }
                    ],
                    get breadcrumbs() {
                        return this.mode === 'compact' ? this.compact : this.full;
                    }
                 }"
                 @click.outside="openDropdown = false">

                <nav aria-label="breadcrumb">
                    <ol class="flex items-center gap-2 m-0 p-0 list-none text-sm">
                        <template x-for="(breadcrumb, index) in breadcrumbs" :key="index">
                            <li class="flex items-center gap-2"
                                :class="breadcrumb.active ? 'text-[#333333]' : 'text-[#E62129]'">
                                
                                <template x-if="breadcrumb.name.trim() === '…'">
                                    <span class="cursor-pointer p-1 rounded hover:bg-gray-100"
                                          @click="openDropdown = !openDropdown">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5 12H5.01M12 12H12.01M19 12H19.01M6 12C6 12.5523 5.55228 13 5 13C4.44772 13 4 12.5523 4 12C4 11.4477 4.44772 11 5 11C5.55228 11 6 11.4477 6 12ZM13 12C13 12.5523 12.5523 13 12 13C11.4477 13 11 12.5523 11 12C11 11.4477 11.4477 11 12 11C12.5523 11 13 11.4477 13 12ZM20 12C20 12.5523 19.5523 13 19 13C18.4477 13 18 12.5523 18 12C18 11.4477 18.4477 11 19 11C19.5523 11 20 11.4477 20 12Z" stroke="#E62129" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </template>

                                <template x-if="breadcrumb.name.trim() !== '…'">
                                    <a :href="breadcrumb.url"
                                       x-text="breadcrumb.name"
                                       class="hover:underline">
                                    </a>
                                </template>

                                <span x-show="index < breadcrumbs.length - 1" class="text-gray-400">/</span>
                            </li>
                        </template>
                    </ol>
                </nav>

                <div x-show="openDropdown"
                     x-transition
                     class="absolute top-8 left-10 mt-1 bg-white border border-gray-200 shadow-lg rounded-xl p-2 z-50 w-48 text-sm">
                    <div class="px-3 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Hidden Pages</div>
                    <template x-for="item in full.slice(1, full.length - 2)" :key="item.name">
                        <a :href="item.url"
                           class="block px-3 py-2 text-gray-700 hover:bg-red-50 hover:text-[#E62129] rounded-md transition-colors"
                           x-text="item.name">
                        </a>
                    </template>
                </div>
            </div>
        </div>

    </x-container>
@endsection