@props([
    'name' => 'search',
    'value' => '',
    'placeholder' => 'Cari...',
    'storeName' => '',
    'storeKey' => '',
    'requestRoute' => '',
    'responseKeyData' => '',
    'responseKeyPaginationData' => 'pagination'
])
<script src="{{ asset('js/component-helpers/api.js')}}"></script>
<div 
  class="relative w-full"
  x-data="{
    key: '',
    storeName: @js($storeName),
    storeKey: @js($storeKey),
    responseKeyData: @js($responseKeyData),
    responseKeyPaginationData: @js($responseKeyPaginationData),
    async onSearch() {
      await requestGetData(
        '{{ $requestRoute }}', {
          search: this.key,
          display: 'false'
        }, (response) => {
          if ($store[this.storeName][this.storeKey]) {
            $store[this.storeName][this.storeKey] = response.data[this.responseKeyData];
            $store[this.storeName].paginationData = response.data[this.responseKeyPaginationData];
          }
      });
    }
  }"
  x-effect="onSearch()"
>
    <input
        type="text"
        name="{{ $name }}"
        value=""
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'w-full pl-10 pr-4 py-2 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none'
        ]) }}
        x-model="key"
    >

    {{-- Icon search --}}
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-5 w-5"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
        </svg>
    </div>
</div>
