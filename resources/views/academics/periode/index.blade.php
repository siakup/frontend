<x-layouts.main>
  <x-layouts.content>
    <x-container.wrapper cols="1" rows="4" height="fit" width="full">

      <x-container.container row="1" padding="py-4">
        <x-breadcrumb/>
      </x-container.container>

      <x-container.container row="1" col="1" padding="pt-4" height="max">
        <x-tab 
          :tabItems="[
            (object)[
              'routeName' => 'academics-periode.index',
              'routeQuery' => 'academics-periode.index',
              'title' => 'Periode Akademik'
            ],
            (object)[
              'routeName' => 'academics-event.index',
              'routeQuery' => 'academics-event.index',
              'title' => 'Event Akademik'
            ],
          ]"
        />
      </x-container.container>

      <x-container.container row="1" padding="p-4" background="bg-white" height="max" radius="b-md">
        <x-container.wrapper rows="3" cols="1" gapY="4">

          <x-container.container row="1" height="max" class="justify-end">
            <x-button.primary :href="route('academics-periode.create')" class="self-end">Tambah Periode Akademik</x-button.primary>
          </x-container.container>

          <x-container.container row="1" col="1" height="max" padding="p-4" class="border border-gray-400">
            <x-container.wrapper cols="2" width="full">

              <x-container.container col="1">
                <x-form.search
                  :value="''"
                  :placeholder="'Tahun/Semester/Tahun Akademik/Status'"
                  :storeName="'listPage'"
                  :storeKey="'periode'"
                  :requestRoute="route('academics-periode.index')"
                  :responseKeyData="'periode'"
                  x-model="$store.listPage.search"
                />
              </x-container.container>

              <x-container.container col="1" class="justify-end">
                <x-filter-button />
              </x-container.container>

                        </x-container.wrapper>
                    </x-container.container>

          <x-container.container row="1" col="1" height="max">

            <x-table.index :variant="'old'">
              <x-table.head :variant="'old'">
                <x-table.row :variant="'old'" class="!bg-transparent">
                  <x-table.header-cell :variant="'old'">Tahun</x-table.header-cell>
                  <x-table.header-cell :variant="'old'">Semester</x-table.header-cell>
                  <x-table.header-cell :variant="'old'">Tahun Akademik</x-table.header-cell>
                  <x-table.header-cell :variant="'old'">Status</x-table.header-cell>
                  <x-table.header-cell :variant="'old'">Aksi</x-table.header-cell>
                </x-table.row>
              </x-table.head>
              <x-table.body>
                <template x-if="$store.listPage.isLoading">
                  <x-table.row :variant="'old'">
                    <x-table.cell colspan="5" :variant="'old'" class="text-center py-4">Sedang memuat data...</x-table.cell>
                  </x-table.row>
                </template>
                <template x-if="!$store.listPage.isLoading && (!$store.listPage.periode || $store.listPage.periode.length == 0)">
                  @include('academics.periode.error-filter')
                </template>
                <template x-if="!$store.listPage.isLoading && ($store.listPage.periode && $store.listPage.periode.length > 0)">
                  <template x-for="periode in $store.listPage.periode">
                    <x-table.row :variant="'old'">
                      <x-table.cell :variant="'old'" x-text="periode.tahun"></x-table.cell>
                      <x-table.cell :variant="'old'" x-text="$store.listPage.namaSemester[periode.semester] ?? 'Tidak Diketahui'"></x-table.cell>
                      <x-table.cell :variant="'old'" x-text="periode.tahun+'/'+(periode.tahun+1)"></x-table.cell>
                      <x-table.cell :variant="'old'">
                        <template x-if="periode.status == 'active'">
                          <x-badge variant="green-filled">Aktif</x-badge>
                        </template>
                        <template x-if="periode.status != 'active'">
                          <x-badge variant="green-bordered">Tidak Aktif</x-badge>
                        </template>
                      </x-table.cell>
                      <x-table.cell :variant="'old'" class="flex items-center justify-center gap-6 center">
                        <x-button
                          :variant="'text-link'"
                          :icon="'search/black-16'"
                          :size="'sm'"
                          class="!text-black"
                          {{-- onclick="onClickDetailPeriodeAcademic(this, '{{ route('academics-periode.detail') }}')" 
                          data-periode-akademik="{{ $periode->id }}" --}}
                        >
                          Lihat
                        </x-button>
                        <x-button
                          :variant="'text-link'"
                          :icon="'edit/red-16'"
                          :size="'sm'"
                          class="text-red-500"
                          {{-- href="{{ route('academics-periode.edit', ['id' => $periode->id]) }}" --}}
                        >
                          Ubah
                        </x-button>
                        <x-button.base
                          :icon="'delete/grey-16'"
                          class="text-gray-600"
                          :size="'sm'"
                          {{-- onclick="
                            document.getElementById('modalKonfirmasiHapus').setAttribute('data-id', {{$periode->id}});
                            document.getElementById('modalKonfirmasiHapus').classList.add('flex');
                            document.getElementById('modalKonfirmasiHapus').classList.remove('hidden');
                          "
                          data-id="{{ $periode->id }}" --}}
                        >
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
      <x-container.container row="1">
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
  </x-layouts.content>

  @section('javascript')
    <script src="{{ asset('js/custom/periode-index.js') }}"></script>
  @endsection
</x-layouts.main>