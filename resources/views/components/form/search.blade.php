@props([
    'name' => 'search',
    'value' => '',
    'placeholder' => 'Cari...',
    'storeName' => '',
    'storeKey' => '',
    'requestRoute' => '',
    'responseKeyData' => '',
    'responseKeyPaginationData' => 'pagination',
])

<x-container.container 
  :background="'content-white'"
  :radius="'md'"
  :width="'full'"
  :height="'maxContent'"
  :padding="'p-2'"
  class="gap-2"
  x-data="{
    key: '',
    storeName: '{{$storeName}}',
    storeKey: '{{$storeKey}}',
    responseKeyData: '{{$responseKeyData}}',
    responseKeyPaginationData: '{{$responseKeyPaginationData}}',
    async onSearch() {
      if($store[this.storeName].isOptionListOpen || $store[this.storeName].isOptionListOpen === undefined) {
        await window.api.requestGetData(
          '{{ $requestRoute }}', {
            search: this.key,
            display: 'false'
          }, (response) => {
            if ($store[this.storeName][this.storeKey]) {
              $store[this.storeName][this.storeKey] = response.data[this.responseKeyData];
              if(response.data[this.responseKeyPaginationData]) {
                $store[this.storeName].paginationData = response.data[this.responseKeyPaginationData];
              }
            }
        });
      } else {
        $store[this.storeName].isOptionListOpen = true;
      }
    }
  }"
  x-modelable="key"
  x-model="{{$attributes->whereStartsWith('x-model')->first()}}"
  x-init="$watch('key', value => onSearch())"
>
    <div class="flex items-center pointer-events-none text-gray-400">
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
    <input
        type="text"
        name="{{ $name }}"
        value=""
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'w-full focus:outline-none'
        ]) }}
        x-model="key"
        autocomplete="off"
    />
</x-container.container>
