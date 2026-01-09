@extends('layouts.main')

@section('title', 'Manajemen Pengguna')

@section('javascript')
    <script>
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
                isOptionListOpen: false,
                users: []
            });

            Alpine.data('editUser', window.UserController.editUser);
            Alpine.data('createPeran', window.UserController.createPeran);
        });
    </script>
@endsection

@section('content')
    <x-container.wrapper :rows="7" :padding="'p-0'" :gapY="4" x-data="editUser()">

        <x-container.container :background="'transparent'" class="row-start-1 row-end-2 items-center">
            <x-typography :variant="'body-large-semibold'">Ubah Informasi</x-typography>
        </x-container.container>

        <x-container.container :background="'transparent'" :width="'full'" class="row-start-2 row-end-3 items-center">
            <x-button :variant="'tertiary'" :icon="'arrow-left/red-20'" :href="route('users.index')">Manajemen Pengguna</x-button>
        </x-container.container>

        <x-container.container :background="'content-white'" class="row-start-3 row-end-10 items-center justify-between">
            <x-container.wrapper :rows="7" :gapY="4">

                <x-container.container :background="'transparent'" :width="'full'" class="row-start-1 row-end-2">
                    <x-typography :variant="'body-medium-bold'">Ubah Informasi Data Pengguna</x-typography>
                </x-container.container>

                <x-container.container :background="'transparent'" :width="'full'" class="row-start-2 row-end-3">
                    <x-form.input-container>
                        <x-slot name="label">NIP</x-slot>
                        <x-slot name="input">
                            <x-container.container :background="'transparent'" :width="'full'" :height="'max'" class="relative">
                                <x-form.search :placeholder="'Username / Nama / Status'" :storeName="'editPage'" :storeKey="'users'" :requestRoute="route('users.search-nip')"
                                    :responseKeyData="'users'" x-model="$store.editPage.nomor_induk" />
                                <template
                                    x-if="$store.editPage.users && $store.editPage.users.length > 0 && $store.editPage.nomor_induk !== '' && $store.editPage.isOptionListOpen">
                                    <x-container.container :width="'full'" :height="'max'" :background="'content-white'"
                                        :class="'flex-col overflow-scroll absolute top-full left-0 right-0'">
                                        <template x-for="user in $store.editPage.users">
                                            <x-container.container :background="'content-white'" :padding="'py-3 px-4'" :gap="'gap-2'"
                                                :radius="'none'" :class="'flex-col justify-start cursor-pointer transition-[background] duration-150 hover:bg-red-500 group text-black hover:text-white border-none'"
                                                x-text="user.nomor_induk+' - '+user.nama"
                                                x-on:click="getUser('{{ route('users.index') }}', user)"
                                                :width="'full'"></x-container.container>
                                        </template>
                                    </x-container.container>
                                </template>
                            </x-container.container>
                        </x-slot>
                    </x-form.input-container>
                </x-container.container>

                <x-container.container :background="'transparent'" :width="'full'" class="row-start-3 row-end-4">
                    <x-form.input-container>
                        <x-slot name="label">Nama Lengkap</x-slot>
                        <x-slot name="input">
                            <x-form.input :placeholder="'Auto Generate'" :name="'nama'" readonly x-model="$store.editPage.nama" />
                        </x-slot>
                    </x-form.input-container>
                </x-container.container>

                <x-container.container :background="'transparent'" :width="'full'" class="row-start-4 row-end-5">
                    <x-form.input-container>
                        <x-slot name="label">Username</x-slot>
                        <x-slot name="input">
                            <x-form.input :placeholder="'Auto Generate'" :name="'username'" readonly
                                x-model="$store.editPage.username" />
                        </x-slot>
                    </x-form.input-container>
                </x-container.container>

                <x-container.container :background="'transparent'" :width="'full'" class="row-start-5 row-end-6">
                    <x-form.input-container>
                        <x-slot name="label">Email</x-slot>
                        <x-slot name="input">
                            <x-form.input :placeholder="'Auto Generate'" :name="'email'" readonly x-model="$store.editPage.email" />
                        </x-slot>
                    </x-form.input-container>
                </x-container.container>

                <x-container.container :background="'transparent'" :width="'full'" class="row-start-6 row-end-7">
                    <x-form.input-container>
                        <x-slot name="label">Status</x-slot>
                        <x-slot name="input">
                            <x-form.switch name="status" x-model="$store.editPage.status" externalOnLabel="Aktif"
                                externalOffLabel="Tidak Aktif" />
                        </x-slot>
                    </x-form.input-container>
                </x-container.container>

                <x-container.container :background="'transparent'" :width="'full'"
                    class="flex-row items-center justify-end row-start-7 row-end-8">
                    <x-button :variant="'primary'" x-on:click="$store.editPage.isModalTambahPeranOpen = true;"
                        x-bind:disabled="checkValidity()">Tambah Peran</x-button>
                </x-container.container>

            </x-container.wrapper>
        </x-container.container>

        <x-container.container :background="'content-white'" :height="'max'"
            class="row-start-10 row-end-13 items-center justify-between">
            <x-container.wrapper :rows="11">

                <x-container.container :background="'transparent'" :width="'full'" class="row-start-1 row-end-2">
                    <x-typography :variant="'body-medium-bold'">Daftar Peran</x-typography>
                </x-container.container>

                <x-container.container :background="'transparent'" :width="'full'" :height="'max'"
                    class="row-start-3 row-end-12 flex-col gap-4">
                    <x-table.index id="list-role" class="table" :variant="'old'">
                        <x-table.head :variant="'old'">
                            <x-table.row :variant="'old'">
                                <x-table.header-cell :variant="'old'">Nama Peran</x-table.header-cell>
                                <x-table.header-cell :variant="'old'">Institusi</x-table.header-cell>
                                <x-table.header-cell :variant="'old'">Dibuat Pada</x-table.header-cell>
                                <x-table.header-cell :variant="'old'">Aksi</x-table.header-cell>
                            </x-table.row>
                        </x-table.head>
                        <x-table.body>
                            <template x-if="$store.editPage.peran && $store.editPage.peran.length > 0">
                                <template x-for="(peran, index) in $store.editPage.peran">
                                    <x-table.row :variant="'old'">
                                        <x-table.cell :variant="'old'" x-text="peran.peranName"></x-table.cell>
                                        <x-table.cell :variant="'old'" x-text="peran.institutionName"></x-table.cell>
                                        <x-table.cell :variant="'old'"
                                            x-text="window.formatter.formatDateTime(peran.createdAt)"></x-table.cell>
                                        <x-table.cell :variant="'old'">
                                            <x-container.container :background="'transparent'" class="justify-center items-center">
                                                <x-button :variant="'text-link'" :size="'sm'" :icon="'delete/grey-20'"
                                                    class="!text-gray-600"
                                                    x-on:click="selectedId = index; isModalKonfirmasiHapusOpen = true;">
                                                    Hapus
                                                </x-button>
                                                </x-container>
                                        </x-table.cell>
                                    </x-table.row>
                                </template>
                            </template>
                        </x-table.body>
                    </x-table.index>
                    <x-container.container :background="'transparent'" :class="'gap-3 justify-end'">
                        <x-button :variant="'secondary'" :href="route('users.index')">Batal</x-button>
                        <x-button :variant="'primary'" x-on:click="isModalKonfirmasiSimpanOpen = true">Simpan</x-button>
                    </x-container.container>
                </x-container.container>


            </x-container.wrapper>
        </x-container.container>

        <div x-data="createPeran('{{ route('institutions.role') }}', @js($roles->data))" x-effect="getData();">
            <x-modal.container x-model="$store.editPage.isModalTambahPeranOpen">
                <x-slot name="header">
                    <x-container.wrapper :cols="14" :justify="'center'" :align="'center'">

                        <x-container.container :background="'transparent'" class="col-start-1 col-end-15 row-start-1 row-end-2">
                            <x-typography :variant="'heading-h5'" :class="'flex-1 text-center'">Tambah Peran Pengguna</x-typography>
                        </x-container.container>

                        <x-container.container :background="'transparent'"
                            class="col-start-14 col-end-15 justify-end row-start-1 row-end-2">
                            <x-icon :name="'caution/outline-black-32'" />
                        </x-container.container>

                    </x-container.wrapper>
                </x-slot name="header">
                <x-container.wrapper :rows="2" :gapY="4">

                    <x-container.container :background="'transparent'" class="row-start-1 row-end-2">
                        <x-form.input-container>
                            <x-slot name="label">Nama Peran</x-slot>
                            <x-slot name="input">
                                <x-form.dropdown :buttonId="'sortPeran'" :dropdownId="'peranList'" :label="'Pilih Peran'" :variant="'gray'"
                                    :dropdownItem="array_column(
                                        array_merge([['id' => '', 'nama' => 'Pilih Peran']], $roles->data),
                                        'id',
                                        'nama',
                                    )" :dropdownContainerClass="'!w-full'" :isUsedForInputField="true" :inputFieldName="'peran'"
                                    x-model="peran" />
                            </x-slot>
                        </x-form.input-container>
                    </x-container.container>

                    <x-container.container :background="'transparent'" class="row-start-2 row-end-3">
                        <x-form.input-container>
                            <x-slot name="label">Nama Institusi</x-slot>
                            <x-slot name="input">
                                <x-form.dropdown :buttonId="'sortInstitusi'" :dropdownId="'institusiList'" :label="'Pilih Institusi'"
                                    :variant="'gray'" :dropdownContainerClass="'!w-full'" :isUsedForInputField="true" :inputFieldName="'namaInstitusi'"
                                    x-model="namaInstitusi" x-init="$watch('institusiList', value => options = { ...institusiList })" />
                            </x-slot>
                        </x-form.input-container>
                    </x-container.container>

                </x-container.wrapper>
                <x-slot name="footer">
                    <x-container.wrapper :cols="2" :gapX="4">

                        <x-container.container :background="'transparent'" class="col-start-1 col-end-2">
                            <x-button :variant="'secondary'" x-on:click="$store.editPage.isModalTambahPeranOpen = false"
                                class="!w-full">Cek Kembali</x-button>
                        </x-container.container>

                        <x-container.container :background="'transparent'" class="col-start-2 col-end-3">
                            <x-button :variant="'primary'" class="!w-full" x-on:click="onSavePeran('editPage')"
                                x-bind:disabled="peran == '' || namaInstitusi == ''">
                                Ya, Simpan Sekarang
                            </x-button>
                        </x-container.container>

                    </x-container.wrapper>
                </x-slot>
                </x-modal.container-pure-js>
        </div>

        <div @on-submit="await saveData('{{ route('users.update', ['id' => ':id']) }}'.replace(':id', $store.editPage.user_id), '{{ route('users.index') }}')"
            @close-modal="isModalKonfirmasiSimpanOpen = false">
            <x-modal.confirmation x-model="isModalKonfirmasiSimpanOpen" :title="'Tunggu Sebentar'" :confirmText="'Ya, Simpan Sekarang'"
                :cancelText="'Cek Kembali'" :iconUrl="'caution/outline-black-24'">
                <x-typography>Apakah anda yakin informasi anda sudah benar?</x-typography>
            </x-modal.confirmation>
        </div>

        <div @on-submit="onDeletePeran()" @close-modal="isModalKonfirmasiHapusOpen = false; selectedId = null">
            <x-modal.confirmation x-model="isModalKonfirmasiHapusOpen" :title="'Hapus Peran Pengguna'" :confirmText="'Ya, Hapus Sekarang'"
                :cancelText="'Cek Kembali'" :iconUrl="'delete/grey-24'">
                Apakah anda yakin ingin menghapus?
            </x-modal.confirmation>
        </div>

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </x-container.wrapper>
@endsection
