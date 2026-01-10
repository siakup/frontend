@extends('layouts.main')

@section('title', 'Manajemen Pengguna')

@section('javascript')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('listPage', {
                datas: @js($response->data ?? []),
                paginationData: @js($pagination ?? []),
                search: @js($search ?? ''),
                sort: @js($sort ?? 'nama,asc')
            });

            Alpine.data('listUser', window.UserController.listUser);
        });
    </script>
@endsection

@section('content')
    <div class="w-full p-4" x-data="listUser({{ json_encode(route('users.index')) }})">
        <div class="flex flex-col gap-4 w-full">
            <div class="w-full">
                <x-typography :variant="'body-large-semibold'">Manajemen Pengguna</x-typography>
            </div>

            <div class="w-full bg-white rounded-tl-none border-t border-t-red-500">
                <div class="flex flex-col gap-4 p-4 w-full">
                    <div class="flex justify-end w-full">
                        <x-button :variant="'primary'" :size="'lg'" :href="route('users.create')">Tambah Pengguna Baru</x-button>
                    </div>

                    <div class="flex justify-between items-center gap-4 w-full">
                        <div class="flex-1 min-w-0">
                            <x-form.search :value="$search ?? ''" :placeholder="'Username / Nama / Status'" :storeName="'listPage'" :storeKey="'datas'"
                                :requestRoute="route('users.index')" :responseKeyData="'users'" x-model="$store.listPage.search" />
                        </div>
                        <div class="flex-shrink-0">
                            <x-form.dropdown :buttonId="'sortFilterButton'" :dropdownId="'sortFilterDropdown'" :label="'Urutkan'" :imgSrc="asset('assets/icons/sort/red-20.svg')"
                                :isIconCanRotate="false" :dropdownItem="[
                                    'Urutkan' => '',
                                    'Aktif' => 'active',
                                    'Tidak Aktif' => 'inactive',
                                    'A-Z' => 'nama,asc',
                                    'Z-A' => 'nama,desc',
                                    'Terbaru' => 'created_at,desc',
                                    'Terlama' => 'created_at,asc',
                                ]" x-model="$store.listPage.sort" />
                        </div>
                    </div>

                    <div class="w-full border border-solid border-gray-400 rounded-md">
                        <table class="w-full border-collapse" style="width: 100%;">
                            <thead class="bg-gradient-to-r from-white to-disable-red border-b border-b-solid border-b-gray-400">
                                <tr>
                                    <th class="text-center align-middle text-sm py-4 px-2 border-r border-gray-400 last:border-r-0">NIP/NIM</th>
                                    <th class="text-center align-middle text-sm py-4 px-2 border-r border-gray-400 last:border-r-0">Nama</th>
                                    <th class="text-center align-middle text-sm py-4 px-2 border-r border-gray-400 last:border-r-0">Username</th>
                                    <th class="text-center align-middle text-sm py-4 px-2 border-r border-gray-400 last:border-r-0">Dibuat Pada</th>
                                    <th class="text-center align-middle text-sm py-4 px-2 border-r border-gray-400 last:border-r-0">Status</th>
                                    <th class="text-center align-middle text-sm py-4 px-2 border-r border-gray-400 last:border-r-0">Reset</th>
                                    <th class="text-center align-middle text-sm py-4 px-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <template x-if="!$store.listPage.datas || $store.listPage.datas.length === 0">
                                    <tr>
                                        <td colspan="7" class="text-center py-8 align-middle border-b border-gray-400">
                                            <div class="flex flex-col items-center justify-center gap-4">
                                                <img src="{{ asset('images/ilustrasi-kosong.svg') }}" alt="Tidak ditemukan" class="w-64 h-auto">
                                                <div class="text-center">
                                                    <h2 class="text-2xl font-bold text-red-500 mb-2">
                                                        Oops, pengguna tidak ditemukan.
                                                    </h2>
                                                    <p class="text-lg text-gray-500">
                                                        Coba kata kunci lain dan pastikan username, nama, atau status sudah benar!
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <template x-if="$store.listPage.datas && $store.listPage.datas.length > 0">
                                    <template x-for="user in $store.listPage.datas" :key="user.nomor_induk">
                                        <tr class="border-b border-gray-400">
                                            <td class="text-center align-middle text-xs py-4 px-2 border-r border-gray-400 last:border-r-0" x-text="user.nomor_induk ?? '-'"></td>
                                            <td class="text-center align-middle text-xs py-4 px-2 border-r border-gray-400 last:border-r-0" x-text="user.nama ?? '-'"></td>
                                            <td class="text-center align-middle text-xs py-4 px-2 border-r border-gray-400 last:border-r-0" x-text="user.username ?? '-'"></td>
                                            <td class="text-center align-middle text-xs py-4 px-2 border-r border-gray-400 last:border-r-0 text-gray-600"
                                                x-text="user.created_at ? window.formatter.formatDateTime(user.created_at) : '-'"></td>
                                            <td class="text-center align-middle text-xs py-4 px-2 border-r border-gray-400 last:border-r-0">
                                                <template x-if="user.status === 'active'">
                                                    <x-badge :variant="'green-filled'" x-text="'Aktif'"></x-badge>
                                                </template>
                                                <template x-if="user.status !== 'active'">
                                                    <x-badge :variant="'green-bordered'" x-text="'Tidak Aktif'"></x-badge>
                                                </template>
                                            </td>
                                            <td class="text-center align-middle text-xs py-4 px-2 border-r border-gray-400 last:border-r-0">
                                                <x-container.container :class="'items-center justify-center'" :background="'transparent'">
                                                    <x-button
                                                        x-on:click="window.api.requestDisplayTemplate(
                                                            '{{ route('users.resetPassword') }}',
                                                            '#userDetailModalContainer',
                                                            '#modalResetPassword',
                                                            { nomor_induk: user.nomor_induk }
                                                        )"
                                                        :variant="'text-link'" :size="'sm'" class="!text-blue-500 text-center">
                                                        Reset Password
                                                    </x-button>
                                                </x-container.container>
                                            </td>
                                            <td class="text-center align-middle text-xs py-4 px-2">
                                                <x-container.container :background="'transparent'" :class="'gap-10 items-center justify-center'">
                                                    <x-button :variant="'text-link'" :size="'sm'" :icon="'search/black-16'"
                                                        class="!text-black"
                                                        x-on:click="window.api.requestDisplayTemplate(
                                                            '{{ route('users.detail') }}', 
                                                            '#userDetailModalContainer', 
                                                            '#modalDetailPengguna', 
                                                            { nomor_induk: user.nomor_induk }
                                                        )">
                                                        Lihat
                                                    </x-button>
                                                    <x-button :icon="'edit/red-16'" :variant="'text-link'" :size="'sm'"
                                                        x-on:click="window.location.href='{{ route('users.edit', ['nomor_induk' => ':nomor_induk']) }}'.replace(':nomor_induk', user.nomor_induk)">
                                                        Ubah
                                                    </x-button>
                                                </x-container.container>
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <template x-if="$store.listPage.datas && $store.listPage.datas.length > 0 && $store.listPage.paginationData">
                <div class="w-full">
                    <x-pagination x-data="{
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
                        :storeName="'listPage'" :storeKey="'datas'" :requestRoute="route('users.index')" :responseKeyData="'users'" :defaultPerPageOptions="[5, 10, 15, 20, 25]" />
                </div>
            </template>
        </div>
    </div>
    <div id="userDetailModalContainer"></div>
    @include('partials.success-modal')
@endsection
