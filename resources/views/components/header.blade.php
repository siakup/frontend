<script type="module">
  import Header from "{{ asset('js/controllers/header.js') }}";
  document.addEventListener('alpine:init', () => {
    Alpine.store('headerComponents', {
      datas: null,
      paginationData: null,
      search: null,
      sort: null
    })
    Alpine.data('headerTime', Header.headerTime);
  });
</script>

<x-container.container :variant="'flat'" class="bg-gradient-to-r from-white via-white to-red-50 h-fit" x-data="headerTime">
  <x-container.wrapper :cols="12" :padding="'p-0'">
      
      <x-container.container :variant="'flat'" class="col-span-3" x-bind:class="$store.mainLayout.isOpen ? '' : 'border-b border-b-gray-400'">
        <x-container.wrapper :cols="6" :rows="3">

          <x-button 
            x-on:click="$store.mainLayout.isOpen = !$store.mainLayout.isOpen" 
            :variant="'tertiary'" 
            :icon="'arrow-left/black-32'"
            class="row-start-2 row-end-3 col-start-1 col-end-2" 
          />

          <x-container.container :variant="'flat'" class="shrink-0 col-start-2 col-end-6 row-start-1 row-end-4">
              <img src="{{ asset('images/uper.png') }}" alt="Logo" class=" w-45 h-auto block my-0 mx-auto">
              <x-container.container :variant="'flat'" class="flex items-center justify-center gap-1 mb-1 w-39 mx-auto">
                  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="5" viewBox="0 0 40 5" fill="none">
                      <path d="M0.5 2.5H39.5" stroke="#0076BE" stroke-width="8" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="56" height="5" viewBox="0 0 56 5" fill="none">
                      <path d="M0.5 2.5H55.5" stroke="#E62129" stroke-width="8" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="60" height="5" viewBox="0 0 60 5" fill="none">
                      <path d="M0.5 2.5H59.5" stroke="#98A725" stroke-width="8" />
                  </svg>
              </x-container>
              <x-container.container :variant="'flat'" class="flex items-center justify-center gap-1 mb-1 w-39 mx-auto text-center">
                  <x-typography :variant="'caption-regular'" class="text-blue-500">Sistem</x-typography>
                  <x-typography :variant="'caption-regular'" class="text-red-500">Informasi</x-typography>
                  <x-typography :variant="'caption-regular'" class="text-green-700">Akademik</x-typography>
              </x-container>
          </x-container>

          <x-container.container :variant="'flat'" class="col-start-6 col-end-7 row-start-1 row-end-4"></x-container>

        </x-wrapper>
      </x-container>

      <x-container.container :variant="'flat'" class="col-span-9 border-b border-gray-400">
        <x-container.wrapper :cols="12" :gap="3" :rows="6" :padding="'p-0'">

          <x-container.container :variant="'flat'" class="col-start-1 col-end-4 row-start-2 row-span-4 self-center">
            <x-container.wrapper :rows="3" :padding="'p-0'" class="justify-start items-start">

              <x-container.container :variant="'flat'" class="row-start-1 self-end">
                  <x-typography :variant="'heading-h6'" tag="h6">Selamat Datang, {{ explode(' ', session('nama'))[0] }}!</x-typography>
              </x-container>

              <x-container.container :variant="'flat'" class="row-start-2 self-end">
                  <x-typography :variant="'body-small-regular'" x-text="getDate()"></x-typography>
              </x-container>

              <x-container.container :variant="'flat'" class="row-start-3">
                  <x-typography :variant="'pixie-regular'" x-text="getTime()+' WIB'"></x-typography>
              </x-container>

            </x-wrapper>
          </x-container>

          <x-container.container :variant="'flat'" class="col-start-5 col-end-9 row-start-2 row-end-4 self-center">
            <x-form.search
              :value="''"
              :placeholder="'Cari'"
              :storeName="'headerComponents'"
              :storeKey="'datas'"
              :requestRoute="route('home')"
              :responseKeyData="''"
              x-model="$store.headerComponents.search"
            />
          </x-container>

          <x-container.container :variant="'flat'" class="col-start-9 col-end-11 row-start-2 row-span-4 gap-1 self-center">
            <x-container.wrapper :rows="3" :padding="'p-0'" class="justify-start items-start">

              <x-container.container :variant="'flat'" class="row-start-1 self-end flex gap-2">
                  <x-icon :name="'human/women'" alt="Women"></x-icon>
                  <x-typography :variant="'body-medium-bold'">{{ session('nama') }}</x-typography>
              </x-container>

              <x-container.container :variant="'flat'" class="row-start-2 self-end">
                <x-typography :variant="'caption-regular'">Periode Akademik 2024–2025</x-typography>
              </x-container>

              <x-container.container :variant="'flat'" class="row-start-3">
                <x-typography :variant="'pixie-regular'">(Admin – Universitas Pertamina)</x-typography>
              </x-container>

            </x-wrapper>
          </x-container>

          <x-container.container :variant="'flat'" class="col-start-11 col-end-12 row-start-2 row-span-4 self-center justify-self-center">
            <x-icon :name="'notification/grey-32'" alt="Notification"></x-icon>
          </x-container>

          <x-container.container :variant="'flat'" class="col-start-12 col-end-13 row-start-2 row-span-4 self-center justify-self-start">
            <x-icon :name="'setting/grey-32'" alt="Setting"></x-icon>
          </x-container>

        </x-wrapper>
      </x-container>

  </x-wrapper>
</x-container>
