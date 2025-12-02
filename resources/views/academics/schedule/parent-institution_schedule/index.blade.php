@extends('layouts.main')

@section('title', 'Jadwal Kuliah Institusi Parent')

<script type="module">
  import ParentInstitutionSchedule from "{{ asset('js/controllers/parentInstitutionSchedule.js') }}";
  document.addEventListener('alpine:init', () => {
    Alpine.store('listPage', { 
      data: @js($data),
      paginationData: @js($pagination),
      peran: @js($peran),
      program_studi: @js($program_studi),
      sort: @js($sort),
      search: @js($search)
    });

    Alpine.data('listParentInstitutionScheduleComponents', ParentInstitutionSchedule.listParentInstitutionScheduleComponents);
  });
</script>

@include('partials.success-notification-modal', ['route' => route('academics.schedule.parent-institution-schedule.index')])


@section('content')
  <x-container.container
    x-data="listParentInstitutionScheduleComponents({{ json_encode(route('academics.schedule.parent-institution-schedule.index')) }})"
    :variant="'content-wrapper'"
  >
    <x-typography :variant="'body-large-semibold'">Jadwal Kuliah</x-typography>
    <x-container.container :variant="'content-wrapper'" :class="'flex flex-col !gap-0 !px-0'">
      <x-tab 
        :tabItems="[
          (object)[
            'routeName' => 'academics.schedule.prodi-schedule.index',
            'routeQuery' => 'academics.schedule.prodi-schedule.index',
            'title' => 'Jadwal Kuliah Program Studi'
          ],
          (object)[
            'routeName' => 'academics.schedule.parent-institution-schedule.index',
            'routeQuery' => 'academics.schedule.parent-institution-schedule.index',
            'title' => 'Jadwal Kuliah Institusi Parent'
          ],
        ]"
      />
      <x-container.container :class="'flex flex-col gap-4 rounded-tl-none items-stretch my-0 border-t-[1] border-t-[#F39194] relative !z-0'">
          <x-typography variant="body-medium-bold">Jadwal Kuliah Institusi Parent</x-typography>
          <x-container.container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center !gap-3'">
              <x-container.container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center !gap-2'">
                  <x-typography :variant="'body-medium-bold'">Peran</x-typography>
                  <x-form.dropdown 
                    :buttonId="'sortRole'"
                    :dropdownId="'roleList'"
                    :label="'Pilih Peran'"
                    :imgSrc="asset('assets/active/icon-arrow-down.svg')"
                    :isIconCanRotate="true"
                    :isUsedForInputField="true"
                    :dropdownItem="array_merge(['Pilih Peran' => ''], array_column($peranList, 'id', 'nama'))"
                    x-model="$store.listPage.peran"
                  />
              </x-container>
               <x-container.container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center !gap-2'">
                <x-typography :variant="'body-medium-bold'">Program Studi</x-typography>
                <x-form.dropdown 
                  :buttonId="'sortButtonStudyProgram'"
                  :dropdownId="'sortStudyProgram'"
                  :label="'Pilih Program Studi'"
                  :imgSrc="asset('assets/active/icon-arrow-down.svg')"
                  :isIconCanRotate="true"
                  :isUsedForInputField="true"
                  :dropdownItem="array_merge(['Pilih Program Studi' => ''],array_column($programStudiList, 'id', 'nama'))"
                  x-model="$store.listPage.program_studi"
                />
              </x-container>
          </x-container>
          <x-container.container :class="'flex flex-row items-center justify-between'">
            <div class="w-1/3">
              <x-form.search
                :value="$search"
                :placeholder="'Ketik Mata Kuliah/Kode Mata Kuliah/Nama Kelas'"
                :storeName="'listPage'"
                :storeKey="'data'"
                :requestRoute="route('academics.schedule.parent-institution-schedule.index')"
                :responseKeyData="'schedules'"
                x-model="$store.listPage.search"
              />
            </div>
            <x-form.dropdown 
              :buttonId="'sortFilterButton'"
              :dropdownId="'sortFilterDropdown'"
              :label="'Urutkan'"
              :imgSrc="asset('assets/icon-filter.svg')"
              :isIconCanRotate="false"
              :dropdownItem="[
                'Urutkan' => '',
                'Semester 1' => 'semester_1',
                'Semester 2' => 'semester_2',
                'Semester 3' => 'semester_3',
                'Semester 4' => 'semester_4',
                'Semester 5' => 'semester_5',
                'Semester 6' => 'semester_6',
                'Semester 7' => 'semester_7',
                'Semester 8' => 'semester_8',
                'A-Z' => 'nama, asc',
                'Z-A' => 'nama, desc',
                'Terbaru' => 'created_at,desc',
                'Terlama' => 'created_at,asc'
              ]"
              x-model="$store.listPage.sort"
            />
          </x-container>
          <x-table.index>
              <x-table.head>
                  <x-table.row>
                      <x-table.header-cell>Mata Kuliah</x-table.header-cell>
                      <x-table.header-cell>Nama Kelas</x-table.header-cell>
                      <x-table.header-cell>Kapasitas</x-table.header-cell>
                      <x-table.header-cell>Jadwal</x-table.header-cell>
                      <x-table.header-cell>Pengajar</x-table.header-cell>
                      <x-table.header-cell>Aksi</x-table.header-cell>
                  </x-table.row>
              </x-table.head>
              <x-table.body>
                <template x-if="$store.listPage.data.length > 0">  
                  <template x-for="schedule in $store.listPage.data">
                    <x-table.row>
                        <x-table.cell x-text="schedule.mata_kuliah ?? '-'"></x-table.cell>
                        <x-table.cell>
                          <x-typography :variant="'body-small-regular'" x-text="schedule.nama_kelas"></x-typography>
                        </x-table.cell>
                        <x-table.cell x-text="schedule.kapasitas ?? '-'"></x-table.cell>
                        <x-table.cell>
                          <ul class="list-disc text-left w-max">
                            <template x-for="jadwal in schedule.jadwal ?? []">
                              <li class="text-left">
                                  <x-typography :variant="'body-small-regular'" x-text="jadwal.hari ?? '-'"></x-typography>,
                                  <x-typography :variant="'body-small-regular'" x-text="jadwal.jam_mulai + '-' + jadwal.jam_selesai"></x-typography>
                                  <br>
                                  <x-typography :variant="'body-small-bold'" x-text="'['+(jadwal.ruangan ?? '-')+']'"></x-typography>
                              </li>
                            </template>
                          </ul>
                        </x-table.cell>
                        <x-table.cell>
                          <template x-for="(pengajar, index) in schedule.pengajar ?? []" :key="index">
                            <x-typography :variant="'body-small-regular'" x-text="pengajar + (index !== (schedule.pengajar.length - 1) ? ', ' : '')"></x-typography>
                          </template>
                        </x-table.cell>
                        <x-table.cell>
                            <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center justify-center">
                              <x-button.base
                                :icon="asset('assets/icon-search.svg')"
                                class="scale-75"
                                x-on:click="idSelectedProdiSchedule = schedule.id; showView()" 
                              >
                                Lihat
                              </x-button.base>
                              <x-button.base
                                :icon="asset('assets/icon-edit.svg')"
                                class="text-[#E62129] scale-75"
                                x-on:click="window.location.href = '{{ route('academics.schedule.parent-institution-schedule.edit', ['id' => ':id']) }}'.replace(':id', schedule.id)"
                              >
                                Ubah
                              </x-button.base>
                              <x-button.base
                                :icon="asset('assets/icon-delete-gray-600.svg')"
                                class="text-[#8C8C8C] scale-75"
                                x-on:click="idSelectedProdiSchedule = schedule.id; modalConfirmationDeleteOpen = true;"
                              >
                                Hapus
                              </x-button.base>
                            </x-container>
                        </x-table.cell>
                    </x-table.row>
                  </template>
                </template>
                <template x-if="$store.listPage.data.length == 0">
                  @include('academics.periode.error-filter')
                </template>
              </x-table.body>
          </x-table.index>
          <x-container.container :variant="'content-wrapper'" :class="'flex flex-row items-center justify-end !px-0'">
            <x-button.secondary 
              :icon="asset('assets/icon-upload-red-500.svg')"
              :iconPosition="'right'"
              :href="route('academics.schedule.parent-institution-schedule.upload')"
            >
              Impor File FET
            </x-button.secondary>
            <x-button.primary :href="route('academics.schedule.parent-institution-schedule.create')">Tambah Jadwal Baru +</x-button.primary>
          </x-container>
      </x-container>
    </x-container>
    <template x-if="$store.listPage.data.length !== 0">
      <x-pagination 
        x-data="{ 
          pagination: null,
          requestData: null
        }"
        x-effect="(() => {
          pagination = $store.listPage.paginationData;
          requestData = {
            program_perkuliahan: $store.listPage.program_perkuliahan,
            program_studi: $store.listPage.program_studi,
            sort: $store.listPage.sort,
            search: $store.listPage.search
          }
        })"
        :storeName="'listPage'"
        :storeKey="'data'"
        :requestRoute="route('academics.schedule.parent-institution-schedule.index')"
        :responseKeyData="'schedules'"
        :defaultPerPageOptions="[5, 10, 15, 20, 25]"
      />
    </template>
    <x-modal.container-pure-js x-bind:class="{'hidden': !modalConfirmationDeleteOpen, 'flex': modalConfirmationDeleteOpen}">
      <x-slot name="header">
        <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
          <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
          <x-icon :iconUrl="asset('assets/icon-delete-gray-800.svg')" :class="'w-8 h-8'" />
        </x-container>
      </x-slot>
      <x-slot name="body">Apakah Anda yakin ingin menghapus jadwal ini?</x-slot>
      <x-slot name="footer">
        <x-button.secondary x-on:click="idSelectedProdiSchedule = null; modalConfirmationDeleteOpen = false">Batal</x-button.secondary>
        <x-button.primary x-on:click="">Hapus</x-button.primary>
      </x-slot>
    </x-modal.container-pure-js>
  </x-container>
  <div id="view-parent-institution-schedule"></div>
@endsection
