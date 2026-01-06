@props([
    'defaultPerPageOptions' => [5, 10, 25, 50],
    'storeName' => '',
    'storeKey' => '',
    'responseKeyPaginationData' => 'pagination',
    'requestRoute' => '',
    'part' => null, // optional: 'left' | 'center' | 'right'
])

@php
    $defaultLimit = $defaultPerPageOptions[0] ?? 10;
    $optionsJson = json_encode($defaultPerPageOptions);
    
    // Determine visibility based on 'part' prop
    $showLeft = !$part || $part === 'left';
    $showCenter = !$part || $part === 'center';
    $showRight = !$part || $part === 'right';
@endphp

<x-container.container class="pagination-container" gap="gap-4"
    x-data="paginationLogic({
        defaultLimit: {{ $defaultLimit }},
        initialTotal: 100 
    })" 
    data-request-route="{{ $requestRoute }}"
    data-store-name="{{ $storeName }}"
    data-store-key="{{ $storeKey }}"
    data-response-key-pagination="{{ $responseKeyPaginationData }}"
    data-default-per-page-options='{{ $optionsJson }}'
>
    <x-container.container class="pagination-main-wrapper" gap="gap-4">

        {{-- Left: per-page select --}}
        @if($showLeft)
        <x-container.container class="pagination-left">
            
            <x-form.input 
                name="per_page"
                type="number"
                inputClass="paginate-limit-select w-16 text-center"
                x-model.number="limit"
                min="1"
            />
            
        </x-container.container>
        @endif

        {{-- Center: result text + pages + navigation --}}
        @if($showCenter)
        <x-container.container class="pagination-center">
            {{-- Pages and Navigation --}}
            <x-container.container class="pagination-pages">
                {{-- Previous Button --}}
                <x-button 
                    variant="secondary" 
                    icon="arrow-left/red-20"
                    label="Sebelumnya"
                    buttonClass="pagination-nav-btn"
                    @click="setPage(page - 1)" 
                    x-bind:disabled="page === 1" 
                />

                {{-- Page Numbers --}}
                <template x-for="(p, index) in paginationRange" :key="index">
                    <x-button
                        type="button"
                        variant="tertiary"
                        @click="setPage(p)"
                        x-text="p"
                        x-bind:class="p === page 
                            ? 'pagination-page-btn pagination-page-btn-active' 
                            : 'pagination-page-btn pagination-page-btn-inactive'"
                    />
                </template>

                {{-- Next Button --}}
                <x-button 
                    variant="secondary" 
                    icon="arrow-right/red-20"
                    label="Selanjutnya"
                    buttonClass="pagination-nav-btn"
                    @click="setPage(page + 1)" 
                    x-bind:disabled="page === totalPages" 
                />
            </x-container.container>

        </x-container.container>
        @endif

        {{-- Right: search --}}
        @if($showRight)
        <x-container.container class="pagination-search">
            
            {{-- Search Label --}}
            <x-container.container class="pagination-search-label">
                <x-button  
                    variant="tertiary"
                    icon="search/red-16"
                    label="Cari Halaman"
                    buttonClass="pagination-search-btn"
                />
            </x-container.container>
            
            {{-- Search Input --}}
            <x-container.container class="pagination-search-input-wrapper">
                <x-form.input 
                    name="page_search"
                    type="number"
                    placeholder="Mulai ketik Angka"
                    class="mb-0"
                    :showRemoveIcon="true"
                    x-model="searchPage"
                    @keydown.enter="handleSearch()"
                />
            </x-container.container>

        </x-container.container>
        @endif

    </x-container.container>
</x-container.container>
