<script>
  window.modalData = @json($response->data)
</script>

<div 
  x-data="{ show: false, close() { show = false } }" 
  x-init="$nextTick(() =>  show = true)" 
  x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-show="show" 
  x-cloak>
  <x-modal.container :show="true" x-model="show">
    <x-slot name="header">
      <x-container.wrapper :cols="14" :justify="'center'" :align="'center'">
  
        <x-container.container :background="'transparent'" class="col-start-1 col-end-15 row-start-1 row-end-2">
          <x-typography :variant="'heading-h5'" :class="'flex-1 text-center'">Lihat Informasi Detail Pengguna</x-typography>
        </x-container.container>
  
        <x-container.container :background="'transparent'" class="col-start-14 col-end-15 row-start-1 row-end-2 justify-end">
          <button 
            type="button" 
            class="text-[#888] cursor-pointer transition-all duration-200 hover:text-[#E74C3C] flex items-center" 
            x-on:click="close()"
          >
            <x-typography :variant="'heading-h3'" :class="'!font-medium'">&times;</x-typography>
          </button>
        </x-container.container>
  
      </x-container.wrapper>
    </x-slot>
    <x-container.wrapper
      :rows="2"
      :class="'!px-0'"
      :gapY="4"
      x-data='Object.assign(window.modalData)'
    >

      <x-accordion :label="'Informasi Detail Pengguna'" :isDefaultOpen="true" :variant="'white-background'" class="row-start-1 row-end-2">
        <x-container.wrapper :rows="4" :gapY="4">

          <x-container.container :background="'transparent'" class="row-start-1 row-end-2">
            <x-form.input-container>
              <x-slot name="label">NIP</x-slot>
              <x-slot name="input">
                <x-form.input 
                  :placeholder="''" 
                  :name="''" 
                  readonly
                  x-model="user.nomor_induk"
                />
              </x-slot>
            </x-form.input-container>
          </x-container.container>

          <x-container.container :background="'transparent'" class="row-start-2 row-end-3">
            <x-form.input-container>
              <x-slot name="label">Nama Lengkap</x-slot>
              <x-slot name="input">
                <x-form.input 
                  :placeholder="''" 
                  :name="''" 
                  readonly
                  x-model="user.nama"
                />
              </x-slot>
            </x-form.input-container>
          </x-container.container>

          <x-container.container :background="'transparent'" class="row-start-3 row-end-4">
            <x-form.input-container>
              <x-slot name="label">Username</x-slot>
              <x-slot name="input">
                <x-form.input 
                  :placeholder="''" 
                  :name="''" 
                  readonly
                  x-model="user.username"
                />
              </x-slot>
            </x-form.input-container>
          </x-container.container>

          <x-container.container :background="'transparent'" class="row-start-4 row-end-5">
            <x-form.input-container>
              <x-slot name="label">Email</x-slot>
              <x-slot name="input">
                <x-form.input 
                  :placeholder="''" 
                  :name="''" 
                  readonly
                  x-model="user.email"
                />
              </x-slot>
            </x-form.input-container>
          </x-container.container>

        </x-container.wrapper>
      </x-accordion>

      <x-accordion :label="'Peran Pengguna'" :variant="'white-background'" class="row-start-2 row-end-3">
        <x-container.wrapper :rows="1">

          <x-container.container :background="'transparent'" class="row-start-1 row-end-2">
            <x-table.index :variant="'old'">
              <x-table.head :variant="'old'">
                  <x-table.row :variant="'old'">
                    <x-table.header-cell :variant="'old'">Nama Peran</x-table.header-cell>
                    <x-table.header-cell :variant="'old'">Nama Institusi</x-table.header-cell>
                  </x-table.row>
              </x-table.head>
              <tbody>
                <template x-if="roles && roles.length > 0">
                  <template x-for="role in roles">
                    <x-table.row :variant="'old'">
                      <x-table.cell :variant="'old'" x-text="role.role.nama_role"></x-table.cell>
                      <x-table.cell :variant="'old'" x-text="role.institusi.nama_institusi"></x-table.cell>
                    </x-table.row>
                  </template>
                </template>
              </tbody>
            </x-table.index>
          </x-container.container>

        </x-container.wrapper>
      </x-accordion>

    </x-container.wrapper>
  </x-modal.container>
</div>