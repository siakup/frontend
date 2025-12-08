@props([
    'defaultPerPageOptions' => [10, 25, 50, 100],
    'storeName' => '',
    'storeKey' => '',
    'responseKeyData' => '',
    'responseKeyPaginationData' => 'pagination',
    'requestRoute' => '',
])
  <div
    x-data="{{ $attributes->get('x-data') }}"
    x-effect="{{ $attributes->get('x-effect') }}"
    x-init="{{ $attributes->get('x-init') }}"
    class="w-full"
  >
    <template x-if="pagination !== null">
      <div 
        x-data="{
          key: '',
          storeName: @js($storeName),
          storeKey: @js($storeKey),
          responseKeyData: @js($responseKeyData),
          responseKeyPaginationData: @js($responseKeyPaginationData),
          defaultPerPageOptions: @js($defaultPerPageOptions),
          startPage: Math.max(2, pagination.currentPage - 1),
          endPage: Math.min(pagination.last - 1, pagination.currentPage + 1),
          async onChangePage(page, limit) {
            await window.api.requestGetData(
              '{{ $requestRoute }}', {
                page: page,
                limit: limit,
                display: 'false',
                ...requestData
              }, (response) => {
                if ($store[this.storeName][this.storeKey]) {
                  $store[this.storeName][this.storeKey] = response.data[this.responseKeyData];
                  $store[this.storeName].paginationData = response.data[this.responseKeyPaginationData];
                }
            });
          },
          async onChangeLimit(limit) {
            await window.api.requestGetData(
              '{{ $requestRoute }}', {
                limit: limit,
                display: 'false',
                ...requestData
              }, (response) => {
                if ($store[this.storeName][this.storeKey]) {
                  $store[this.storeName][this.storeKey] = response.data[this.responseKeyData];
                  $store[this.storeName].paginationData = response.data[this.responseKeyPaginationData];
                }
            });
          },
        }"
        class="flex flex-col md:flex-row items-center justify-between gap-10 w-full"
      >
          <div class="flex items-center gap-3">
              <span class="text-sm text-gray-600">Tampilkan</span>
              <div class="relative group">
                  <select 
                    class="w-24 border bg-white border-[#bfbfbf] rounded-lg px-3 py-1 text-sm text-center" 
                    x-model="pagination.limit"
                    x-on:change="onChangeLimit($event.target.value)"
                  >
                    <template x-for="option in defaultPerPageOptions">
                      <option x-bind:value="Number(option)" x-text="Number(option)"></option>
                    </template>
                  </select>
              </div>
              <span class="text-sm text-gray-600">Per Halaman</span>
          </div>
          <div class="flex flex-col sm:flex-row items-center gap-5">
              <div class="text-sm text-gray-600">
                  <template x-if="pagination.totalItems">
                      <span x-text="'Menampilkan halaman '+pagination.currentPage+' dari '+pagination.last+'(Total: '+pagination.totalItems+' data)'"></span>
                  </template>
                  <template x-if="!pagination.totalItems">
                    <span x-text="'Halaman '+pagination.currentPage+' dari '+pagination.last"></span>
                  </template>
              </div>
              <div class="flex items-center gap-1">
                  <x-button.secondary 
                    x-show="pagination.currentPage > 1" 
                    x-on:click="onChangePage(pagination.currentPage - 1, pagination.limit)" 
                    label="Sebelumnya"
                    iconPosition="left" 
                    icon="{{ asset('assets/icon-arrow-left-red.svg') }}" 
                    class="!py-1 !px-3" 
                  />
                  <x-button.base
                    class="py-1 px-4 rounded-lg text-sm cursor-pointer"
                    x-on:click="onChangePage(1, pagination.limit)"
                    x-bind:class="{
                      'bg-[#FBDADB]': pagination.currentPage == 1,
                      'text-[#E62129]': pagination.currentPage == 1,
                      'text-[#8C8C8C]': pagination.currentPage != 1,
                    }"
                  >
                    1
                  </x-button.base>
                  <template x-if="pagination.currentPage > 3 && pagination.last > 5">
                    <span class="px-2 text-[#8C8C8C] text-sm">...</span>
                  </template>
                  <template x-for="i in endPage - startPage">
                    <template x-if="i > 1 && i < pagination.last">
                      <x-button.base
                        x-on:click="onChangePage(i, pagination.limit)"
                        x-bind:class="{
                          'bg-[#FBDADB]': pagination.currentPage == i,
                          'text-[#E62129]': pagination.currentPage == i,
                          'text-[#8C8C8C]': pagination.currentPage != i,
                        }"
                        x-text="i"
                      ></x-button.base>
                    </template>
                  </template>
                  <template x-if="pagination.currentPage < pagination.last - 2 && last > 5">
                    <span class="px-2 text-[#8C8C8C] text-sm">...</span>
                  </template>
                  <template x-if="pagination.last > 1">
                    <x-button.base 
                      class="py-1 px-4 rounded-lg text-sm"
                      x-on:click="onChangePage(pagination.last, pagination.limit)"
                      x-bind:class="{
                        'bg-[#FBDADB]': pagination.currentPage == pagination.last,
                        'text-[#E62129]': pagination.currentPage == pagination.last,
                        'text-[#8C8C8C]': pagination.currentPage != pagination.last,
                      }"
                      x-text="pagination.last"
                    ></x-button.base>
                  </template>
                  <x-button.secondary 
                    x-show="pagination.currentPage < pagination.totalPages" 
                    x-on:click="onChangePage(pagination.currentPage + 1, pagination.limit)" 
                    label="Selanjutnya"
                    iconPosition="right" 
                    icon="{{ asset('assets/icon-arrow-right-red.svg') }}" 
                    class="!py-1 !px-3" 
                  />
              </div>
          </div>
      </div>
    </template>
  </div>