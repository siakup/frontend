@extends('layouts.main')

@section('title', 'Manajemen Pengguna')

@section('javascript')
  <script src="{{ asset('js/component-helpers/api.js')}}"></script>
  <script src="{{ asset('js/component-helpers/formatter.js')}}"></script>
  <script type="module">
    import User from "{{ asset('js/controllers/user.js') }}";
    document.addEventListener('alpine:init', () => {
      Alpine.store('listPage', { 
        datas: @js($response->data),
        paginationData: @js($pagination),
        search: @js($search),
        sort: @js($sort)
      });

      Alpine.data('listUser', User.listUser);
    });
</script>
@endsection

@section('content')
  <x-container :variant="'content-wrapper'" x-data="listUser({{ json_encode(route('users.index')) }})">
    <x-typography :variant="'body-large-semibold'">Manajemen Pengguna</x-typography>

    <div class="flex items-center justify-end w-full px-4">
      <x-button :variant="'primary'" :size="'lg'" :href="route('users.create')">Tambah Pengguna Baru</x-button.primary>
    </div>
    <x-container :class="'flex justify-between'">
      <div class="w-64">
        <x-form.search
          :value="$search"
          :placeholder="'Username / Nama / Status'"
          :storeName="'listPage'"
          :storeKey="'datas'"
          :requestRoute="route('users.index')"
          :responseKeyData="'users'"
          x-model="$store.listPage.search"
        />
      </div>
      <x-form.dropdown 
        :buttonId="'sortFilterButton'"
        :dropdownId="'sortFilterDropdown'"
        :label="'Urutkan'"
        :imgSrc="asset('assets/icons/sort/red-20.svg')"
        :isIconCanRotate="false"
        :dropdownItem="[
          'Urutkan' => '',
          'Aktif' => 'active',
          'Tidak Aktif' => 'inactive',
          'A-Z' => 'nama,asc',
          'Z-A' => 'nama,desc',
          'Terbaru' => 'created_at,desc',
          'Terlama' => 'created_at,asc'
        ]"
        x-model="$store.listPage.sort"
      />
    </x-container>
    <x-table :variant="'old'">
      <x-table-head :variant="'old'">
          <x-table-row :variant="'old'">
              <x-table-header :variant="'old'">NIP/NIM</x-table-header>
              <x-table-header :variant="'old'">Nama</x-table-header>
              <x-table-header :variant="'old'">Username</x-table-header>
              <x-table-header :variant="'old'">Dibuat Pada</x-table-header>
              <x-table-header :variant="'old'">Status</x-table-header>
              <x-table-header :variant="'old'">Reset</x-table-header>
              <x-table-header :variant="'old'">Aksi</x-table-header>
          </x-table-row>
      </x-table-head>
      <tbody>
        <template x-if="$store.listPage.datas && $store.listPage.datas.length > 0">
          <template x-for="user in $store.listPage.datas">
            <x-table-row :variant="'old'">
                <x-table-cell :variant="'old'" x-text="user.nomor_induk"></x-table-cell>
                <x-table-cell :variant="'old'" x-text="user.nama"></x-table-cell>
                <x-table-cell :variant="'old'" x-text="user.username"></x-table-cell>
                <x-table-cell 
                  :variant="'old'" 
                  class=" text-gray-12"
                  x-text="formatDateTime(user.created_at)"
                ></x-table-cell>
                <x-table-cell :variant="'old'">
                  
                  <template x-if="user.status === 'active'"><x-badge :variant="'green-filled'" x-text="'Aktif'"></x-badge></template>
                  <template x-if="user.status !== 'active'"><x-badge :variant="'green-bordered'"  x-text="'Tidak Aktif'"></x-badge></template>
                </x-table-cell>
                <x-table-cell :variant="'old'">
                  <x-container :class="'!px-0 w-full items-center'" :variant="'content-wrapper'">
                    <x-button x-on:click="requestDisplayTemplate(
                      '{{ route('users.resetPassword') }}',
                      '#userDetailModalContainer',
                      '#modalResetPassword',
                      { nomor_induk: user.nomor_induk }
                    )" :variant="'tertiary'" :size="'sm'" class="!text-[#0076BE] text-center">Reset Password</x-button>
                  </x-container>
                </x-table-cell>
                <x-table-cell :variant="'old'">
                    <x-container :variant="'content-wrapper'" :class="'flex flex-row gap-10 items-center justify-center'">
                      <x-button
                          :variant="'tertiary'"
                          :size="'sm'"
                          :icon="asset('assets/icons/search/black-16.svg')"
                          class="!text-black"
                          x-on:click="requestDisplayTemplate(
                            '{{ route('users.detail') }}', 
                            '#userDetailModalContainer', 
                            '#modalDetailPengguna', 
                            { nomor_induk: user.nomor_induk }
                          )"
                      >Lihat</x-button.base>
                      <x-button
                          :icon="asset('assets/icons/edit/red-16, property=default.svg')"
                          :variant="'tertiary'"
                          :size="'sm'"
                          x-on:click="window.location.href='{{ route('users.edit', ['nomor_induk' => ':nomor_induk']) }}'.replace(':nomor_induk', user.nomor_induk)"
                      >Ubah</x-button.base>
                    </x-container>
                </x-table-cell>
            </x-table-row>
          </template>
        </template>
      </tbody>
    </x-table>
    <template x-if="$store.listPage.datas && $store.listPage.datas.length > 0">
      <x-pagination 
        x-data="{ 
          pagination: null,
          requestData: null
        }"
        x-effect="(() => {
          pagination = $store.listPage.paginationData;
          requestData = {
            sort: $store.listPage.sort,
            search: $store.listPage.search
          }
        })"
        :storeName="'listPage'"
        :storeKey="'datas'"
        :requestRoute="route('users.index')"
        :responseKeyData="'users'"
        :defaultPerPageOptions="[5, 10, 15, 20, 25]"
      />
    </template>
  </x-container>
  <div id="userDetailModalContainer"></div>
  @include('partials.success-modal')
@endsection
