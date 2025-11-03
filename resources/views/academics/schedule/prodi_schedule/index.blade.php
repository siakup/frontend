@extends('layouts.main')

@section('title', 'Jadwal Kuliah Program Studi')

@section('breadcrumbs')
  <div class="breadcrumb-item">Beranda</div>
@endsection

@section('content')
  <x-container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Jadwal Kuliah</x-typography>
    <x-container :variant="'content-wrapper'" :class="'flex flex-col !gap-0 !px-0'">
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
      <x-container :class="'flex flex-col gap-4 rounded-tl-none items-stretch my-0 border-t-[1pborder-t-[#F39194] relative !z-0'">
        <x-typography variant="body-medium-bold">Jadwal Kuliah Program Studi</x-typography>
        <x-container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center !gap-3'">
          <x-container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center !gap-2'">
            <x-typography :variant="'body-medium-bold'">Program Perkuliahan</x-typography>
            <x-form.dropdown 
              :buttonId="'sortButtonCampus'"
              :dropdownId="'sortCampus'"
              :label="
                count(
                  array_filter(
                    $programPerkuliahanList, 
                    function($item) use($params) { 
                      return $item['name'] == urldecode($params['program_perkuliahan']); 
                    }
                  )
                ) > 0 
                  ? array_values(
                      array_filter(
                        $programPerkuliahanList, 
                        function($item) use($params) { 
                          return $item['name'] == urldecode($params['program_perkuliahan']); 
                        }
                      )
                    )[0]['name']
                  : 'Semua'
              "
              :imgSrc="asset('assets/active/icon-arrow-down.svg')"
              :isIconCanRotate="true"
              :isOptionRedirectableToURLQueryParameter="true"
              :queryParameter="'program_perkuliahan'"
              :url="route('academics.schedule.prodi-schedule.index')"
              :dropdownItem="array_column($programPerkuliahanList, 'name', 'name')"
            />
          </x-container>
          <x-container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center !gap-2'">
            <x-typography :variant="'body-medium-bold'">Program Studi</x-typography>
            <x-form.dropdown 
              :buttonId="'sortButtonStudyProgram'"
              :dropdownId="'sortStudyProgram'"
              :label="
              count(
                array_filter(
                  $programStudiList, 
                  function($item) use($params) { 
                    return $item->id === $params['program_studi']; 
                  }
                )
              ) > 0 
                ? array_values(
                  array_filter(
                    $programStudiList, 
                    function($item) use($params) { 
                      return $item->id === $params['program_studi']; 
                    }
                  )
                )[0]->nama 
                : 'Semua'
              "
              :imgSrc="asset('assets/active/icon-arrow-down.svg')"
              :isIconCanRotate="true"
              :isOptionRedirectableToURLQueryParameter="true"
              :queryParameter="'program_studi'"
              :url="route('academics.schedule.prodi-schedule.index')"
              :dropdownItem="array_column($programStudiList, 'id', 'nama')"
            />
          </x-container>
        </x-container>
        <x-container :class="'flex flex-row items-center justify-between'">
          <div class="w-64">
            {{-- ToDo: Sesuaikan route backend dan fieldkey nya --}}
            <x-form.search-v2 
              class="w-64"
              :routes="route('users.index')"
              :fieldKey="'username'"
              :placeholder="'Username / Nama / Status'"
              :search="$params['q']"
            />
          </div>
          <x-form.dropdown 
              :buttonId="'sortFilterButton'"
              :dropdownId="'sortFilterDropdown'"
              :label="
                empty($_GET) 
                  ? 'Urutkan' 
                  : ($params['sort'] === 'active' 
                      ? 'Aktif' 
                      : ($params['sort'] === 'inactive' 
                          ? 'Tidak Aktif' 
                          : ($params['sort'] === 'nama,asc' 
                              ? 'A-Z' 
                              : ($params['sort'] === 'nama,desc' 
                                  ? 'Z-A' 
                                  : ($params['sort'] === 'created_at,desc' 
                                      ? 'Terbaru' 
                                      : 'Terlama'
                                    )
                                ) 
                            )
                        )
                    )
              "
              :imgSrc="asset('assets/icon-filter.svg')"
              :isIconCanRotate="false"
              :isOptionRedirectableToURLQueryParameter="true"
              :queryParameter="'sort'"
              :url="route('academics.schedule.prodi-schedule.index')"
              :dropdownItem="[
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
            />
        </x-container>
        <x-table>
          <x-table-head>
            <x-table-row>
                <x-table-header>Semester</x-table-header>
                <x-table-header>Mata Kuliah</x-table-header>
                <x-table-header>Nama Kelas</x-table-header>
                <x-table-header>Kapasitas</x-table-header>
                <x-table-header>Jadwal</x-table-header>
                <x-table-header>Pengajar</x-table-header>
                <x-table-header>Aksi</x-table-header>
            </x-table-row>
          </x-table-head>
          <tbody x-data="{ schedules: {{ json_encode($dataSchedule) }} }">
            <template x-if="schedules.length > 0">  
              <template x-for="schedule in schedules" :key="schedule.id_kelas">
                <x-table-row>
                    <x-table-cell x-text="schedule.id_periode_akademik ?? '-'"></x-table-cell>
                    <x-table-cell>
                      <x-typography :variant="'body-small-regular'" x-text="schedule.id_mata_kuliah ?? '-'"></x-typography>
                    </x-table-cell>
                    <x-table-cell x-text="schedule.nama_jadwal ?? '-'"></x-table-cell>
                    <x-table-cell x-text="schedule.jumlah_peserta ?? '-'"></x-table-cell>
                    <x-table-cell>
                      <ul class="list-disc text-left w-max">
                        <template x-for="jadwal in schedule.classSchedule ?? []" :key="jadwal.id ?? Math.random()">
                          <li class="text-left">
                              <x-typography :variant="'body-small-regular'" x-text="jadwal.hari ?? '-'"></x-typography>,
                              <x-typography :variant="'body-small-regular'" x-text="jadwal.mulai_kelas + '-' + jadwal.selesai_kelas"></x-typography>
                              <br>
                              <x-typography :variant="'body-small-regular'" class="text-gray-500" x-text="'['+(jadwal.nama_ruangan ?? '-')+']'"></x-typography>
                          </li>
                        </template>
                      </ul>
                    </x-table-cell>
                    <x-table-cell>
                      <template x-for="(pengajar, index) in schedule.nama_pengajar ?? []" :key="index">
                        <x-typography :variant="'body-small-regular'" x-text="pengajar + (index !== (schedule.nama_pengajar.length - 1) ? ', ' : '')"></x-typography>
                      </template>
                    </x-table-cell>
                    <x-table-cell>
                        <x-container :variant="'content-wrapper'" class="flex flex-row items-center justify-center">
                          <x-button.base
                            :icon="asset('assets/icon-search.svg')"
                            class="scale-75"
                            x-on:click="openViewModal('{{ route('academics.schedule.prodi-schedule.show', ['id', ':id']) }}'.replace(':id', schedule.id_kelas))" 
                          >
                            Lihat
                          </x-button.base>
                          <x-button.base
                            :icon="asset('assets/icon-edit.svg')"
                            class="text-[#E62129] scale-75"
                            x-on:click="window.location.href = '{{ route('academics.schedule.prodi-schedule.edit', ['id' => ':id']) }}'.replace(':id', schedule.id_kelas)"
                          >
                            Ubah
                          </x-button.base>
                          <x-button.base
                            :icon="asset('assets/icon-delete-gray-600.svg')"
                            class="text-[#8C8C8C] scale-75"
                            x-on:click=""
                          >
                            Hapus
                          </x-button.base>
                        </x-container>
                    </x-table-cell>
                </x-table-row>
              </template>
            </template>
            <template x-if="schedules.length == 0">
              @include('academics.periode.error-filter')
            </template>
          </tbody>
        </x-table>
        <x-container :variant="'content-wrapper'" :class="'flex flex-row items-center justify-end !px-0'">
          <x-button.secondary 
            :icon="asset('assets/icon-upload-red-500.svg')"
            :iconPosition="'right'"
            :href="route('academics.schedule.prodi-schedule.import-fet1')"
          >
            Impor File FET
          </x-button.secondary>
          <x-button.primary :href="route('academics.schedule.prodi-schedule.create')">Tambah Jadwal Baru</x-button.primary>
        </x-container>
      </x-container>
    </x-container>

    @include('partials.pagination', [
        'currentPage' => 1,
        'lastPage' => 10,
        'limit' => 3,
        'routes' => '',
    ])
    {{-- @if (isset($data['data']))
    @endif --}}
  </x-container>

  @include('academics.schedule.prodi_schedule.delete')
  @include('academics.schedule.prodi_schedule.view')
@endsection
