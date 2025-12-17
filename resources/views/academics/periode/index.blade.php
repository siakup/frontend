@extends('layouts.main')

@section('title', 'Akademik')

@section('javascript')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('listPage', {
                periode: @js($data->data),
                paginationData: @js($pagination),
                search: @js($search),
                sort: @js($sort),
                namaSemester: @js($namaSemester)
            });

            Alpine.data('listPeriode', window.PeriodeController.listPeriode);
        });
    </script>
@endsection

@section('content')
    <x-container.wrapper :padding="'p-0'" :rows="6" x-data="listPeriode({{ json_encode(route('academics-periode.index')) }})">

        <x-container.container :background="'transparent'" class="row-start-1 row-end-2">
            <x-tab :tabItems="[
                (object) [
                    'routeName' => 'academics-periode.index',
                    'routeQuery' => 'academics-periode.index',
                    'title' => 'Periode Akademik',
                ],
                (object) [
                    'routeName' => 'academics-event.index',
                    'routeQuery' => 'academics-event.index',
                    'title' => 'Event Akademik',
                ],
            ]" />
        </x-container.container>

        <x-container.container :background="'transparent'" :height="'max'" class="row-start-2 row-end-6">
            <x-container.container :background="'bg-white'" :class="'rounded-tl-none border-t border-t-red-500'">
                <x-container.wrapper :rows="5" :gapY="4">

                    <x-container.container :background="'transparent'" :height="'max'" class="row-start-1 row-end-2 justify-end">
                        <x-button.primary :href="route('academics-periode.create')" class="self-end">Tambah Periode Akademik</x-button.primary>
                    </x-container.container>

                    <x-container.container :background="'content-white'" :padding="'p-4'" :class="'row-start-2 row-end-3 justify-between items-center'">
                        <x-container.wrapper :cols="2">

                            <x-container.container :background="'transparent'" class="col-start-1 col-end-2">
                                <x-form.search :value="''" :placeholder="'Tahun/Semester/Tahun Akademik/Status'" :storeName="'listPage'" :storeKey="'periode'"
                                    :requestRoute="route('academics-periode.index')" :responseKeyData="'periode'" x-model="$store.listPage.search" />
                            </x-container.container>

                            <x-container.container :background="'transparent'" class="col-start-2 col-end-3 justify-end">
                                <x-filter-button />
                            </x-container.container>

                        </x-container.wrapper>
                    </x-container.container>

                    <x-container.container :background="'transparent'" :height="'max'" class="row-start-3 row-end-8">

                        <x-table.index :variant="'old'">
                            <x-table.head :variant="'old'">
                                <x-table.row :variant="'old'">
                                    <x-table.header-cell :variant="'old'">Tahun</x-table.header-cell>
                                    <x-table.header-cell :variant="'old'">Semester</x-table.header-cell>
                                    <x-table.header-cell :variant="'old'">Tahun Akademik</x-table.header-cell>
                                    <x-table.header-cell :variant="'old'">Status</x-table.header-cell>
                                    <x-table.header-cell :variant="'old'">Aksi</x-table.header-cell>
                                </x-table.row>
                            </x-table.head>
                            <x-table.body>
                                <template x-if="!$store.listPage.periode || $store.listPage.periode.length == 0">
                                    @include('academics.periode.error-filter')
                                </template>
                                <template x-if="$store.listPage.periode && $store.listPage.periode.length > 0">
                                    <template x-for="periode in $store.listPage.periode">
                                        <x-table.row :variant="'old'">
                                            <x-table.cell :variant="'old'" x-text="periode.tahun"></x-table.cell>
                                            <x-table.cell :variant="'old'"
                                                x-text="$store.listPage.namaSemester[periode.semester] ?? 'Tidak Diketahui'"></x-table.cell>
                                            <x-table.cell :variant="'old'"
                                                x-text="periode.tahun+'/'+(periode.tahun+1)"></x-table.cell>
                                            <x-table.cell :variant="'old'">
                                                <template x-if="periode.status == 'active'">
                                                    <x-badge variant="green-filled">Aktif</x-badge>
                                                </template>
                                                <template x-if="periode.status != 'active'">
                                                    <x-badge variant="green-bordered">Tidak Aktif</x-badge>
                                                </template>
                                            </x-table.cell>
                                            <x-table.cell :variant="'old'"
                                                class="flex items-center justify-center gap-6 center">
                                                <x-button :variant="'text-link'" :icon="'search/black-16'" :size="'sm'"
                                                    class="!text-black" {{-- onclick="onClickDetailPeriodeAcademic(this, '{{ route('academics-periode.detail') }}')" 
                          data-periode-akademik="{{ $periode->id }}" --}}>
                                                    Lihat
                                                </x-button>
                                                <x-button :variant="'text-link'" :icon="'edit/red-16'" :size="'sm'"
                                                    class="text-red-500" {{-- href="{{ route('academics-periode.edit', ['id' => $periode->id]) }}" --}}>
                                                    Ubah
                                                </x-button>
                                                <x-button.base :icon="'delete/grey-16'" class="text-gray-600" :size="'sm'"
                                                    {{-- onclick="
                            document.getElementById('modalKonfirmasiHapus').setAttribute('data-id', {{$periode->id}});
                            document.getElementById('modalKonfirmasiHapus').classList.add('flex');
                            document.getElementById('modalKonfirmasiHapus').classList.remove('hidden');
                          "
                          data-id="{{ $periode->id }}" --}}>
                                                    Hapus
                                                </x-button.base>
                                            </x-table.cell>
                                        </x-table.row>
                                    </template>
                                </template>
                            </x-table.body>
                        </x-table.index>
                    </x-container.container>

                </x-container.wrapper>
            </x-container.container>
        </x-container.container>

        <x-container.container :background="'transparent'" class="row-start-6 row-end-7 items-center">
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
                :storeName="'listPage'" :storeKey="'periode'" :requestRoute="route('academics-periode.index')" :responseKeyData="'periode'" :defaultPerPageOptions="[5, 10, 15, 20, 25]" />
        </x-container.container>

    </x-container.wrapper>
    <div id="periodeDetailModalContainer"></div>

    <x-modal.container-pure-js id="modalKonfirmasiHapus">
        <x-slot name="header">
            <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
                <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
                <x-icon :iconUrl="asset('assets/icon-delete-gray-800.svg')" :class="'w-8 h-8'" />
                </x-container>
        </x-slot>
        <x-slot name="body">Apakah Anda yakin ingin menghapus periode akademik ini?</x-slot>
        <x-slot name="footer">
            <x-button.secondary
                onclick="
          document.getElementById('modalKonfirmasiHapus').classList.add('hidden');
          document.getElementById('modalKonfirmasiHapus').classList.remove('flex');
          document.getElementById('modalKonfirmasiHapus').removeAttribute('data-id')
        ">
                Batal
            </x-button.secondary>
            <x-button.primary
                onclick="onClickDeletePeriodeAcademic(this, '{{ route('academics-periode.index') }}')">Hapus</x-button.primary>
        </x-slot>
    </x-modal.container-pure-js>
    @include('partials.success-notification-modal', [
        'route' => route('academics-periode.index'),
    ])
@endsection