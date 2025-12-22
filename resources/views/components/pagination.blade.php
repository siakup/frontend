@props([
    'defaultPerPageOptions' => [10, 25, 50, 100],
    'storeName' => '',
    'storeKey' => '',
    'responseKeyData' => '',
    'responseKeyPaginationData' => 'pagination',
    'requestRoute' => '',
    'showLimit' => true,
    'showInfo' => true,
    'showNav' => true,
    'showSearch' => true,
    'containerClass' => '',
    'buttonSize' => 'default',
])

@php
    $containerClasses = "pagination-container {$containerClass}";
    $buttonClasses = "pagination-button";
    $navButtonClasses = "pagination-nav-button";
    
    // Extract x-data from attributes if exists
    $xDataAttr = $attributes->get('x-data', '{}');
    $attributes = $attributes->except('x-data');
@endphp

<div
  {{ $attributes->merge(['class' => $containerClasses]) }}
  x-data="Object.assign({{ $xDataAttr }}, { pageSearch: '' })"
  x-init="
    pagination = typeof pagination === 'undefined' ? null : pagination;
    key = '';
    storeName = @js($storeName);
    storeKey = @js($storeKey);
    responseKeyData = @js($responseKeyData);
    responseKeyPaginationData = @js($responseKeyPaginationData);
    defaultPerPageOptions = @js($defaultPerPageOptions);
    
    $data.startPage = () => Math.max(2, pagination?.currentPage - 1);
    $data.endPage = () => Math.min(pagination?.last - 1, pagination?.currentPage + 1);
    $data.pages = () => {
      const s = $data.startPage();
      const e = $data.endPage();
      const arr = [];
      for (let i = s; i <= e; i++) arr.push(i);
      return arr;
    };
    
    $data.onChangePage = async (page, limit) => {
      page = Number(page);
      limit = Number(limit ?? pagination?.limit);
      if (!page || page < 1) return;
      if (pagination?.last && page > pagination.last) page = pagination.last;

      if (!'{{ $requestRoute }}' || !storeName || !storeKey) {
        if (pagination) {
          // Force Alpine to detect the change by creating a new object reference
          pagination = { ...pagination, currentPage: page, limit: limit };
          // Trigger DOM update
          $nextTick(() => {});
        }
        return;
      }

      await window.api.requestGetData(
        '{{ $requestRoute }}', {
          page: page,
          limit: limit,
          display: 'false',
          ...(typeof requestData !== 'undefined' ? requestData : {})
        }, (response) => {
          if ($store[storeName] && $store[storeName][storeKey] !== undefined) {
            $store[storeName][storeKey] = response.data[responseKeyData];
            $store[storeName].paginationData = response.data[responseKeyPaginationData];
          }
      });
    };
    
    $data.onChangeLimit = async (limit) => {
      limit = Number(limit);
      if (!limit) return;
      
      if (!'{{ $requestRoute }}' || !storeName || !storeKey) {
        if (pagination) {
          // Force Alpine to detect the change by creating a new object reference
          pagination = { ...pagination, limit: limit, currentPage: 1 };
          // Trigger DOM update
          $nextTick(() => {});
        }
        return;
      }

      await window.api.requestGetData(
        '{{ $requestRoute }}', {
          limit: limit,
          display: 'false',
          ...(typeof requestData !== 'undefined' ? requestData : {})
        }, (response) => {
          if ($store[storeName] && $store[storeName][storeKey] !== undefined) {
            $store[storeName][storeKey] = response.data[responseKeyData];
            $store[storeName].paginationData = response.data[responseKeyPaginationData];
          }
      });
    };
    
    $data.goToSearchedPage = () => {
      const p = Number(pageSearch);
      if (!p || !pagination?.last) return;
      if (p < 1 || p > pagination.last) {
        pageSearch = '';
        return;
      }
      $data.onChangePage(p, pagination?.limit);
      pageSearch = '';
    };
  "
  role="navigation"
  aria-label="Pagination Navigation"
>
  <template x-if="pagination">
    <div class="flex flex-col md:flex-row md:flex-nowrap flex-wrap items-center justify-between gap-4 w-full">
          @if($showLimit)
          <div class="pagination-per-page-wrapper">
              <label class="sr-only" for="per-page-select">Tampilkan per halaman</label>
              <span class="pagination-info-text">Tampilkan</span>
              <div class="relative z-10 overflow-visible">
                  <select 
                    id="per-page-select"
                    class="pagination-select" 
                    x-model="pagination.limit"
                    x-on:change="onChangeLimit($event.target.value)"
                  >
                    <template x-for="option in defaultPerPageOptions" :key="option">
                      <option x-bind:value="Number(option)" x-text="Number(option)"></option>
                    </template>
                  </select>
              </div>
              <span class="pagination-info-text">Per Halaman</span>
          </div>
          @endif

          <div class="pagination-info-wrapper">
              @if($showInfo)
              <div class="pagination-info-text" aria-live="polite">
                  <template x-if="pagination.totalItems">
                      <span x-text="'Hasil : '+pagination.currentPage+' dari '+pagination.last"></span>
                  </template>
                  <template x-if="!pagination.totalItems">
                    <span x-text="'Halaman '+pagination.currentPage+' dari '+pagination.last"></span>
                  </template>
              </div>
              @endif

              @if($showNav)
              <div class="pagination-nav-wrapper">
                  <x-button.secondary 
                    x-show="pagination.currentPage > 1" 
                    x-on:click="onChangePage(pagination.currentPage - 1, pagination.limit)" 
                    label="Sebelumnya"
                    iconPosition="left" 
                    icon="arrow-left/red-24" 
                    :class="$navButtonClasses"
                    aria-label="Previous page"
                  />

                  <button
                    type="button"
                    class="{{ $buttonClasses }}"
                    x-on:click="onChangePage(1, pagination.limit)"
                    x-bind:class="{
                      'pagination-button-active': pagination.currentPage == 1,
                      'pagination-button-inactive': pagination.currentPage != 1,
                    }"
                    aria-current="page"
                    aria-label="Page 1"
                  >
                    1
                  </button>

                  <template x-if="pagination.currentPage > 3 && pagination.last > 5">
                    <span class="pagination-ellipsis">...</span>
                  </template>

                  <template x-for="page in pages()" :key="page">
                    <template x-if="page > 1 && page < pagination.last">
                      <button
                        type="button"
                        class="{{ $buttonClasses }}"
                        x-on:click="onChangePage(page, pagination.limit)"
                        x-bind:class="{
                          'pagination-button-active': pagination.currentPage == page,
                          'pagination-button-inactive': pagination.currentPage != page,
                        }"
                        x-text="page"
                        x-bind:aria-label="'Page '+page"
                      ></button>
                    </template>
                  </template>

                  <template x-if="pagination.currentPage < pagination.last - 2 && pagination.last > 5">
                    <span class="pagination-ellipsis">...</span>
                  </template>

                  <template x-if="pagination.last > 1">
                    <button
                      type="button"
                      class="{{ $buttonClasses }}"
                      x-on:click="onChangePage(pagination.last, pagination.limit)"
                      x-bind:class="{
                        'pagination-button-active': pagination.currentPage == pagination.last,
                        'pagination-button-inactive': pagination.currentPage != pagination.last,
                      }"
                      x-text="pagination.last"
                      x-bind:aria-label="'Page '+pagination.last"
                    ></button>
                  </template>

                  <x-button.secondary 
                    x-show="pagination.currentPage < pagination.totalPages" 
                    x-on:click="onChangePage(pagination.currentPage + 1, pagination.limit)" 
                    label="Selanjutnya"
                    iconPosition="right" 
                    icon="arrow-right/red-24" 
                    :class="$navButtonClasses"
                    aria-label="Next page"
                  />
              </div>
              @endif

              @if($showSearch)
              <div class="pagination-search-wrapper">
                <div class="pagination-search-container" style="width: 320px; height: 40px;">
                  <button type="button" class="pagination-search-button" x-on:click="pageSearch ? goToSearchedPage() : $refs.pageInput.focus()" aria-label="Cari Halaman">
                    <x-icon name="search/red-16" class="w-4 h-4" />
                    <span class="text-sm">Cari Halaman</span>
                  </button>

                  <input 
                    x-ref="pageInput" 
                    type="text" 
                    inputmode="numeric" 
                    placeholder="Mulai ketik angka " 
                    aria-label="Page number" 
                    x-model="pageSearch" 
                    x-on:keydown="if (!/[0-9]/.test($event.key) && !['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'].includes($event.key)) $event.preventDefault()"
                    x-on:paste.prevent="pageSearch = ($event.clipboardData.getData('text') || '').replace(/[^0-9]/g, '')"
                    spellcheck="false" 
                    class="pagination-search-input" 
                  />

                  <button 
                    type="button" 
                    class="pagination-search-clear" 
                    aria-label="Clear page" 
                    x-show="pageSearch && pageSearch.length > 0" 
                    x-on:click.stop="pageSearch = ''; $refs.pageInput.focus()"
                    style="display: none;"
                    x-bind:style="pageSearch && pageSearch.length > 0 ? 'display: flex;' : 'display: none;'"
                  >
                    <x-icon name="close-cancel/grey-16" class="w-4 h-4" />
                  </button>
                </div>
              </div>
               @endif

          </div>
    </div>
  </template>
</div>