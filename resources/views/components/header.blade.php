<script>
  document.addEventListener('alpine:init', () => {
    Alpine.store('headerComponents', {
      datas: null,
      paginationData: null,
      search: null,
      sort: null
    })
    Alpine.data('headerTime', window.HeaderController.headerTime);
  });
</script>

<x-container.container :background="'red-gradient'" :radius="'none'" class="h-fit" x-data="headerTime">
  <x-container.wrapper :cols="12" :padding="'p-0'" :radius="'none'">
      
      <x-container.container :background="'transparent'" :radius="'none'" class="col-span-3 h-full" x-bind:class="$store.mainLayout.isOpen ? '' : 'border-b border-b-gray-400'">
        <x-container.wrapper :cols="6" :rows="3">

          <x-button 
            x-on:click="$store.mainLayout.isOpen = !$store.mainLayout.isOpen" 
            :variant="'text-link'" 
            :icon="'arrow-left/black-32'"
            class="row-start-2 row-end-3 col-start-1 col-end-2"
          />

          <x-container.container :background="'transparent'"  class="shrink-0 col-start-2 col-end-6 row-start-1 row-end-4">
            <x-container.wrapper :padding="'p-0'" :rows="12" :align="'center'" :justify="'center'">

              <x-container.container :background="'transparent'" class="row-start-1 row-end-11 justify-center">
                <img src="{{ asset('images/uper.png') }}" alt="Logo" class="w-fit h-auto block my-0">
              </x-container.container>

              <x-container.container :class="'row-start-11 row-end-13'">
                <x-container.container :background="'transparent'" :gap="'gap-1'" class="items-center justify-center">
                  <x-container.container :radius="'none'" :width="'maxContent'" class="justify-center border-t-5 border-blue-500">
                    <x-typography :variant="'caption-regular'" class="text-blue-500">Sistem</x-typography>
                  </x-container.container>
                  <x-container.container :radius="'none'" :width="'maxContent'" class="justify-center border-t-5 border-red-500">
                    <x-typography :variant="'caption-regular'" class="text-red-500">Informasi</x-typography>
                  </x-container.container>
                  <x-container.container :radius="'none'" :width="'maxContent'" class="justify-center border-t-5 border-green-700">
                    <x-typography :variant="'caption-regular'" class="text-green-700">Akademik</x-typography>
                  </x-container.container>
                </x-container.container>
              </x-container.container>

            </x-container.wrapper>
          </x-container.container>

          <x-container.container :background="'transparent'" class="col-start-6 col-end-7 row-start-1 row-end-4"></x-container.container>

        </x-container.wrapper>
      </x-container.container>

      <x-container.container :background="'transparent'" :radius="'none'" class="col-span-9 w-full h-full border-b border-gray-400">
        <x-container.wrapper :cols="12" :gap="3" :rows="6" :padding="'p-0'" :gapX="2">

          <x-container.container :background="'transparent'" class="col-start-1 col-end-4 row-start-2 row-span-4 self-center">
            <x-container.wrapper :rows="3" :padding="'p-0'" class="justify-start items-start">

              <x-container.container :width="'auto'" :height="'auto'" :background="'transparent'" class="row-start-1 self-end">
                  <x-typography :variant="'heading-h6'" tag="h6">Selamat Datang, {{ explode(' ', session('nama'))[0] }}!</x-typography>
              </x-container.container>

              <x-container.container :width="'auto'" :height="'auto'" :background="'transparent'" class="row-start-2 self-end">
                  <x-typography :variant="'body-small-regular'" x-text="getDate()"></x-typography>
              </x-.container.container>

              <x-container.container :width="'auto'" :height="'auto'" :background="'transparent'" class="row-start-3">
                  <x-typography :variant="'pixie-regular'" x-text="getTime()+' WIB'"></x-typography>
              </x-.container.container>

            </x-container.wrapper>
          </x-container.container>

          <x-container.container :background="'transparent'" class="col-start-5 col-end-9 row-start-2 row-end-4 items-center">
            <x-form.search
              :value="''"
              :placeholder="'Cari'"
              :storeName="'headerComponents'"
              :storeKey="'datas'"
              :requestRoute="route('home')"
              :responseKeyData="''"
              x-model="$store.headerComponents.search"
            />
          </x-container.container>

          <x-container.container :background="'transparent'" class="col-start-9 col-end-11 row-start-2 row-span-4 gap-1 self-center">
            <x-profile-header>
              <x-slot name="imageSlot">
                <x-icon :name="'human/women'" alt="Women"></x-icon>
              </x-slot>
              <x-slot name="nameSlot">
                <x-typography :variant="'body-medium-bold'">{{ session('nama') }}</x-typography>
              </x-slot>
              <x-slot name="footerSlot">
                <x-container.container :background="'transparent'" class="flex-col">
                  <x-typography :variant="'caption-regular'">Periode Akademik 2024–2025</x-typography>
                  <x-typography :variant="'pixie-regular'">(Admin – Universitas Pertamina)</x-typography>
                </x-container.container>
              </x-slot>
            </x-profile-header>
          </x-container.container>

          <x-container.container :width="'auto'" :height="'auto'" :background="'transparent'" class="col-start-11 col-end-12 row-start-2 row-span-4 self-center justify-self-center">
            <x-icon :name="'notification/grey-32'" alt="Notification"></x-icon>
          </x-container.container>

          <x-container.container :width="'auto'" :height="'auto'" :background="'transparent'" class="col-start-12 col-end-13 row-start-2 row-span-4 self-center justify-self-start">
            <x-icon :name="'setting/grey-32'" alt="Setting"></x-icon>
          </x-container.container>

        </x-container.wrapper>
      </x-container.container>

  </x-container.wrapper>
</x-container.container>
