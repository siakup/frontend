@extends('layouts.main')

@section('title', 'Manajemen Pengguna')

@section('javascript')
  <script src="{{ asset('js/component-helpers/api.js')}}"></script>
  <script src="{{ asset('js/component-helpers/formatter.js')}}"></script>
  <script type="module">
    import User from "{{ asset('js/controllers/user.js') }}";

    document.addEventListener('alpine:init', () => {
      Alpine.store('editPage', {
        user_id: @js($response->data->user->id),
        nomor_induk: @js($response->data->user->nomor_induk),
        nama: @js($response->data->user->nama),
        username: @js($response->data->user->username),
        email: @js($response->data->user->email),
        status: @js($response->data->user->status) === 'active',
        peran: @json($peran),
        isModalTambahPeranOpen: false,
      });

      Alpine.data('editUser', User.editUser);
      Alpine.data('createPeran', User.createPeran);
    });
  </script>
@endsection

@section('content')
  <x-container :variant="'content-wrapper'" x-data="editUser()">
    <x-typography :variant="'body-large-semibold'">Ubah Informasi</x-typography>
    <x-button.back :href="route('users.index')">Manajemen Pengguna</x-button.back>
    <x-container :class="'flex flex-col gap-4'">
      <x-typography :variant="'body-medium-bold'">Ubah Informasi Data Pengguna</x-typography>
      <x-form.input-container class="min-w-[120px]" id="nip-search">
        <x-slot name="label">NIP</x-slot>
        <x-slot name="input">
          <div class="w-full flex-1">
            <x-form.search
              :placeholder="'Username / Nama / Status'"
              :storeName="'editPage'"
              :storeKey="'users'"
              :requestRoute="route('users.search-nip')"
              :responseKeyData="'users'"
              x-model="$store.editPage.nomor_induk"
              readonly
            />
          </div>
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[120px]" id="nama_lengkap">
        <x-slot name="label">Nama Lengkap</x-slot>
        <x-slot name="input">
          <x-form.input 
            :placeholder="'Auto Generate'" 
            :name="'nama'" 
            readonly
            x-model="$store.editPage.nama"
          />
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[120px]" id="username">
        <x-slot name="label">Username</x-slot>
        <x-slot name="input">
          <x-form.input 
            :placeholder="'Auto Generate'" 
            :name="'username'" 
            readonly
            x-model="$store.editPage.username"
          />
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[120px]" id="email">
        <x-slot name="label">Email</x-slot>
        <x-slot name="input">
          <x-form.input 
            :placeholder="'Auto Generate'" 
            :name="'email'" 
            readonly
            x-model="$store.editPage.email"
          />
        </x-slot>
      </x-form.input-container>
      <x-form.toggle x-model="$store.editPage.status" />
      <x-container class="flex flex-row items-center justify-end w-full px-8 py-4 border-none">
        <x-button.primary x-on:click="$store.editPage.isModalTambahPeranOpen = true;">Tambah Peran</x-button.primary>
      </x-container>
    </x-container>
    <x-container :class="'flex flex-col gap-4'">
      <x-typography :variant="'body-medium-bold'">Daftar Peran</x-typography>
      <x-table id="list-role" class="table" :variant="'old'">
        <x-table-head :variant="'old'">
          <x-table-row :variant="'old'">
            <x-table-header :variant="'old'">Nama Peran</x-table-header>
            <x-table-header :variant="'old'">Institusi</x-table-header>
            <x-table-header :variant="'old'">Dibuat Pada</x-table-header>
            <x-table-header :variant="'old'">Aksi</x-table-header>
          </x-table-row>
        </x-table-head>
        <tbody>
          <template x-if="$store.editPage.peran && $store.editPage.peran.length > 0">
            <template x-for="(peran, index) in $store.editPage.peran">
              <x-table-row :variant="'old'">
                <x-table-cell :variant="'old'" x-text="peran.peranName"></x-table-cell>
                <x-table-cell :variant="'old'" x-text="peran.institutionName"></x-table-cell>
                <x-table-cell :variant="'old'" x-text="formatDateTime(peran.createdAt)"></x-table-cell>
                <x-table-cell :variant="'old'">
                  <x-button.base
                    :icon="asset('assets/icon-delete-gray-600.svg')"
                    class="text-[#8C8C8C] scale-75"
                    x-on:click="selectedId = index; isModalKonfirmasiHapusOpen = true;"
                  >
                    Hapus
                  </x-button.base>
                </x-table-cell>
              </x-table-row>
            </template>
          </template>
        </tbody>
      </x-table>
      <x-container :variant="'content-wrapper'" :class="'flex flex-row !px-0 gap-3 justify-end'">
        <x-button.secondary :href="route('users.index')">Batal</x-button.secondary>
        <x-button.primary x-on:click="isModalKonfirmasiSimpanOpen = true">Simpan</x-button.primary>
      </x-container>
    </x-container>

    <div x-data="createPeran('{{ route('institutions.role') }}', @js($roles->data))" x-effect="getData();">
      <x-modal.container-pure-js x-bind:class="{'hidden': !$store.editPage.isModalTambahPeranOpen, 'flex': $store.editPage.isModalTambahPeranOpen}">
        <x-slot name="header">
          <span class="text-lg-bd">Tambah Peran Pengguna</span>
        </x-slot name="header">
        <x-slot name="body">
          <x-form.input-container class="min-w-[120px]" id="">
            <x-slot name="label">Nama Peran</x-slot>
            <x-slot name="input">
              <x-form.dropdown 
                :buttonId="'sortPeran'"
                :dropdownId="'peranList'"
                :label="'Pilih Peran'"
                :imgSrc="asset('assets/base/icon-arrow-down.svg')"
                :isIconCanRotate="true"
                :dropdownItem="(array_column(array_merge([['id' => '', 'nama' => 'Pilih Peran']], $roles->data), 'id', 'nama'))"
                :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9] !text-black !w-full flex items-center justify-between flex-1'"
                :dropdownContainerClass="'!w-full'"
                :isUsedForInputField="true"
                :inputFieldName="'peran'"
                x-model="peran"
              />
            </x-slot>
          </x-form.input-container>
          <x-form.input-container class="min-w-[120px]" id="">
            <x-slot name="label">Nama Institusi</x-slot>
            <x-slot name="input">
              <x-form.dropdown 
                :buttonId="'sortInstitusi'"
                :dropdownId="'institusiList'"
                :label="'Pilih Institusi'"
                :imgSrc="asset('assets/base/icon-arrow-down.svg')"
                :isIconCanRotate="true"
                :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9] !text-black !w-full flex items-center justify-between flex-1'"
                :dropdownContainerClass="'!w-full'"
                :isUsedForInputField="true"
                :inputFieldName="'namaInstitusi'"
                x-model="namaInstitusi"
                x-init="$watch('institusiList', value => options = {...institusiList})"
              />
            </x-slot>
          </x-form.input-container>
        </x-slot>
        <x-slot name="footer">
          <x-button.secondary x-on:click="$store.editPage.isModalTambahPeranOpen = false">Cek Kembali</x-button.secondary>
          <x-button.primary 
            x-on:click="onSavePeran('editPage')" 
            x-bind:disabled="peran == '' || namaInstitusi == ''"
          >
            Ya, Simpan Sekarang
          </x-button.primary>
        </x-slot>
      </x-modal.container-pure-js>
    </div>
  
    <x-modal.container-pure-js x-bind:class="{'hidden': !isModalKonfirmasiSimpanOpen, 'flex': isModalKonfirmasiSimpanOpen}">
      <x-slot name="header">
        <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
          <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
          <x-icon :iconUrl="asset('assets/base/icon-caution.svg')" :class="'w-8 h-8'" />
        </x-container>
      </x-slot name="header">
      <x-slot name="body">
        <div>Apakah anda yakin informasi anda sudah benar?</div>
      </x-slot>
      <x-slot name="footer">
        <x-button.secondary x-on:click="isModalKonfirmasiSimpanOpen = false">Cek Kembali</x-button.secondary>
        <x-button.primary x-on:click="saveData('{{route('users.update', ['id' => ':id'])}}'.replace(':id', $store.editPage.user_id), '{{ route('users.index') }}')">Ya, Simpan Sekarang</x-button.primary>
      </x-slot>
    </x-modal.container-pure-js>
  
    <x-modal.container-pure-js x-bind:class="{'hidden': !isModalKonfirmasiHapusOpen, 'flex': isModalKonfirmasiHapusOpen}">
      <x-slot name="header">
        <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
          <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Hapus Peran Pengguna</x-typography>
          <x-icon :iconUrl="asset('assets/icon-delete-gray-800.svg')" :class="'w-8 h-8'" />
        </x-container>
      </x-slot name="header">
      <x-slot name="body">
        <div>Apakah anda yakin ingin menghapus?</div>
      </x-slot>
      <x-slot name="footer">
        <x-button.secondary x-on:click="isModalKonfirmasiHapusOpen = false; selectedId = null">Cek Kembali</x-button.secondary>
        <x-button.primary x-on:click="onDeletePeran()">Ya, Hapus Sekarang</x-button.primary>
      </x-slot>
    </x-modal.container-pure-js>
  
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </x-container>
@endsection