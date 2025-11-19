<script>
  window.modalData = @json($response->data)
</script>

<x-modal.container-pure-js id="modalDetailPengguna">
  <x-slot name="header">
    <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
      <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Lihat Informasi Detail Pengguna</x-typography>
      <button 
        type="button" 
        class="text-[#888] cursor-pointer transition-all duration-200 hover:text-[#E74C3C] flex items-center" 
        onclick="
          document.getElementById('modalDetailPengguna').classList.remove('flex');
          document.getElementById('modalDetailPengguna').classList.add('hidden');
        "
      >
        <x-typography :variant="'heading-h3'" :class="'!font-medium'">&times;</x-typography>
      </button>
    </x-container>
  </x-slot>
  <x-slot name="body">
    <x-container 
      :variant="'content-wrapper'" 
      :class="'!px-0'"
      x-data='Object.assign(window.modalData)'
    >
      <x-accordion :label="'Informasi Detail Pengguna'" :isDefaultOpen="true" :variant="'white-background'">
        <x-container :variant="'content-wrapper'" :class="'!p-4'">
          <x-form.input-container class="min-w-[120px]" id="nip">
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
          <x-form.input-container class="min-w-[120px]" id="nama_lengkap">
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
          <x-form.input-container class="min-w-[120px]" id="username">
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
          <x-form.input-container class="min-w-[120px]" id="email">
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
        </x-container>
      </x-accordion>

      <x-accordion :label="'Peran Pengguna'" :variant="'white-background'">
        <x-container :variant="'content-wrapper'" :class="'!p-4'">
          <x-table :variant="'old'">
            <x-table-head :variant="'old'">
                <x-table-row :variant="'old'">
                  <x-table-header :variant="'old'">Nama Peran</x-table-header>
                  <x-table-header :variant="'old'">Nama Institusi</x-table-header>
                </x-table-row>
            </x-table-head>
            <tbody>
              <template x-if="roles && roles.length > 0">
                <template x-for="role in roles">
                  <x-table-row :variant="'old'">
                    <x-table-cell :variant="'old'" x-text="role.role.nama_role"></x-table-cell>
                    <x-table-cell :variant="'old'" x-text="role.institusi.nama_institusi"></x-table-cell>
                  </x-table-row>
                </template>
              </template>
            </tbody>
          </x-table>
        </x-container>
      </x-accordion>
    </x-container>
  </x-slot>
  <x-slot name="footer"></x-slot>
</x-modal.container-pure-js>