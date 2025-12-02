@extends('layouts.main')

@section('title', 'Jadwal Kuliah Program Studi')

@section('breadcrumbs')
  <div class="breadcrumb-item">Beranda</div>
@endsection

<script type="module">
  import ProdiSchedule from "{{ asset('js/controllers/prodiSchedule.js') }}";
  document.addEventListener('alpine:init', () => {
    Alpine.store('listPage', { 
      schedules: @js($dataSchedule),
      paginationData: @js($pagination),
      program_perkuliahan: @js($program_perkuliahan),
      program_studi: @js($program_studi),
      sort: @js($sort),
      search: @js($search)
    });

    Alpine.data('listProdiScheduleComponents', ProdiSchedule.listProdiScheduleComponents);
  });
</script>

@section('content')
  <x-container.container
    x-data="listProdiScheduleComponents({{ json_encode(route('academics.schedule.prodi-schedule.index')) }})"
    :variant="'content-wrapper'">
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
        <x-typography variant="body-medium-bold">Jadwal Kuliah Program Studi</x-typography>
        <x-container.container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center !gap-3'">
          <x-container.container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center !gap-2'">
            <x-typography :variant="'body-medium-bold'">Program Perkuliahan</x-typography>
            <x-form.dropdown 
              :buttonId="'sortButtonCampus'"
              :dropdownId="'sortCampus'"
              :label="'Pilih Program Perkuliahan'"
              :imgSrc="asset('assets/icons/arrow-down/red-20.svg')"
              :isIconCanRotate="true"
              :isUsedForInputField="true"
              :dropdownItem="array_merge(['Pilih Program Perkuliahan' => ''], array_column($programPerkuliahanList, 'name', 'name'))"
              x-model="$store.listPage.program_perkuliahan"
            />
          </x-container>
          <x-container.container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center !gap-2'">
            <x-typography :variant="'body-medium-bold'">Program Studi</x-typography>
            <x-form.dropdown 
              :buttonId="'sortButtonStudyProgram'"
              :dropdownId="'sortStudyProgram'"
              :label="'Pilih Program Studi'"
              :imgSrc="asset('assets/icons/arrow-down/red-20.svg')"
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
              :storeKey="'schedules'"
              :requestRoute="route('academics.schedule.prodi-schedule.index')"
              :responseKeyData="'schedules'"
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
                <x-table.header-cell>Semester</x-table.header-cell>
                <x-table.header-cell>Mata Kuliah</x-table.header-cell>
                <x-table.header-cell>Nama Kelas</x-table.header-cell>
                <x-table.header-cell>Kapasitas</x-table.header-cell>
                <x-table.header-cell>Jadwal</x-table.header-cell>
                <x-table.header-cell>Pengajar</x-table.header-cell>
                <x-table.header-cell>Aksi</x-table.header-cell>
            </x-table.row>
          </x-table.head>
          <tbody>
            <template x-if="$store.listPage.schedules.length > 0">  
              <template x-for="schedule in $store.listPage.schedules">
                <x-table.row>
                    <x-table.cell x-text="schedule.periode ?? '-'"></x-table.cell>
                    <x-table.cell>
                      <x-typography :variant="'body-small-regular'" x-text="schedule.nama_matakuliah.nama_matakuliah_id ?? '-'"></x-typography>
                    </x-table.cell>
                    <x-table.cell x-text="schedule.nama_kelas ?? '-'"></x-table.cell>
                    <x-table.cell x-text="schedule.kapasitas_peserta ?? '-'"></x-table.cell>
                    <x-table.cell>
                      <ul class="list-disc text-left w-max">
                        <template x-for="jadwal in schedule.scheduleList ?? []" :key="jadwal.id ?? Math.random()">
                          <li class="text-left">
                              <x-typography :variant="'body-small-regular'" x-text="jadwal.hari ?? '-'"></x-typography>,
                              <x-typography :variant="'body-small-regular'" x-text="jadwal.jam_mulai + '-' + jadwal.jam_akhir"></x-typography>
                              <br>
                              <x-typography :variant="'body-small-bold'" x-text="'['+(jadwal.ruangan ?? '-')+']'"></x-typography>
                          </li>
                        </template>
                      </ul>
                    </x-table.cell>
                    <x-table.cell>
                      <template x-for="(pengajar, index) in schedule.lectureList ?? []" :key="index">
                        <x-typography :variant="'body-small-regular'" x-text="pengajar.nama + (index !== (schedule.lectureList.length - 1) ? ', ' : '')"></x-typography>
                      </template>
                    </x-table.cell>
                    <x-table.cell>
                        <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center justify-center">
                          <x-button
                            :variant="'tertiary'"
                            :size="'sm'"
                            :icon="asset('assets/icons/search/black-16.svg')"
                            class="!text-black"
                            x-on:click="idSelectedProdiSchedule = schedule.id_kelas; showView()" 
                          >
                            Lihat
                          </x-button>
                          <x-button
                            :variant="'tertiary'"
                            :size="'sm'"
                            :icon="asset('assets/icons/edit/red-16, property=default.svg')"
                            class="!text-[#E62129]"
                            x-on:click="window.location.href = '{{ route('academics.schedule.prodi-schedule.edit', ['id' => ':id']) }}'.replace(':id', schedule.id_kelas)"
                          >
                            Ubah
                          </x-button>
                          <x-button
                            :variant="'tertiary'"
                            :size="'sm'"
                            :icon="asset('assets/icons/delete/grey-16.svg')"
                            class="!text-[#8C8C8C]"
                            x-on:click="idSelectedProdiSchedule = schedule.id_kelas; modalConfirmationDeleteOpen = true;"
                          >
                            Hapus
                          </x-button>
                        </x-container>
                    </x-table.cell>
                </x-table.row>
              </template>
            </template>
            <template x-if="$store.listPage.schedules.length == 0">
              @include('academics.periode.error-filter')
            </template>
          </tbody>
        </x-table.index>
        <x-container.container :variant="'content-wrapper'" :class="'flex flex-row items-center justify-end !px-0'">
          <x-button 
            :variant="'secondary'"
            :icon="asset('assets/icons/upload/red-20.svg')"
            :iconPosition="'right'"
            :href="route('academics.schedule.prodi-schedule.import-fet1')"
          >
            Impor File FET
          </x-button>
          <x-button :variant="'primary'" :href="route('academics.schedule.prodi-schedule.create')">Tambah Jadwal Baru</x-button>
        </x-container>
      </x-container>
    </x-container>
    <template x-if="$store.listPage.schedules != 0">
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
        :storeKey="'schedules'"
        :requestRoute="route('academics.schedule.prodi-schedule.index')"
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
      <x-slot name="body">Apakah Anda yakin ingin menghapus jadwal program studi ini?</x-slot>
      <x-slot name="footer">
        <x-button.secondary x-on:click="idSelectedProdiSchedule = null; modalConfirmationDeleteOpen = false">Batal</x-button.secondary>
        <x-button.primary x-on:click="">Hapus</x-button.primary>
      </x-slot>
    </x-modal.container-pure-js>
  </x-container>

  <div id="view-prodi-schedule"></div>
@endsection
