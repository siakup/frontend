@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('breadcrumbs')
    <div class="breadcrumb-item">Beranda</div>
    <div class="breadcrumb-item active">Kelompok Perwalian</div>
@endsection

<script src="{{ asset('js/component-helpers/api.js')}}"></script>
<script type="module">
  import PerwalianKRS from "{{ asset('js/controllers/perwalianKrs.js') }}";
  document.addEventListener('alpine:init', () => {
    Alpine.store('listPage', { 
      periode: @js($periode),
      year: @js($year),
      sort: @js($sort),
      filter: @js($filter),
      datas: @js($students),
      paginationData: @js($pagination)
    });

    Alpine.data('listPerwalianKRS', PerwalianKRS.listPerwalianKRS);
  });
</script>

@section('content')
  <x-container
    :variant="'content-wrapper'"
    x-data="listPerwalianKRS({{ json_encode(route('tutelage-group.list-student')) }})"
  >
    <x-typography variant="body-large-semibold">Kelompok Perwalian - dosen</x-typography>
    <x-container :variant="'content-wrapper'" :class="'flex flex-col !gap-0 !px-0'">
      <x-tab 
        :tabItems="[
          (object)[
            'routeName' => 'tutelage-group.list-student',
            'routeQuery' => 'tutelage-group.list-student',
            'title' => 'Daftar Mahasiswa'
          ],
        ]"
      />
      <x-container :class="'flex flex-col gap-4 rounded-tl-none items-stretch my-0 border-t-[1] border-t-[#F39194] relative !z-0'">
          <x-typography variant="body-medium-bold">Daftar Mahasiswa</x-typography>
          <x-container :class="'flex flex-row items-center justify-between'">
            <x-container :variant="'content-wrapper'" :class="'flex flex-row items-center justify-start !px-0'">
              <x-container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center !gap-2'">
                  <x-typography :variant="'body-medium-bold'">Periode Akademik</x-typography>
                  <x-form.dropdown 
                    :buttonId="'sortPeriode'"
                    :dropdownId="'periodeList'"
                    :label="'Pilih Periode'"
                    :imgSrc="asset('assets/active/icon-arrow-down.svg')"
                    :isIconCanRotate="true"
                    :isUsedForInputField="true"
                    :dropdownItem="array_merge(
                      ['Pilih Periode' => ''], 
                      array_column(array_map(function ($item) {
                        $data = [
                          'nama' => $item->tahun . ' - ' . ($item->semester == 1 ? 'Ganjil' : ($item->semester == 2 ? 'Genap' : 'Pendek')),
                          'id' => $item->id
                        ];
                        return $data;
                      }, $periodeList), 'id', 'nama')
                    )"
                    x-model="$store.listPage.periode"
                  />
              </x-container>
              <x-container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center !gap-2'">
                <x-typography :variant="'body-medium-bold'">Tahun Masuk</x-typography>
                <x-form.dropdown 
                  :buttonId="'sortButtonYear'"
                  :dropdownId="'sortYear'"
                  :label="'Pilih Tahun Masuk'"
                  :imgSrc="asset('assets/active/icon-arrow-down.svg')"
                  :isIconCanRotate="true"
                  :isUsedForInputField="true"
                  :dropdownItem="array_merge(['Pilih Tahun' => ''], 
                    array_combine(
                      array_map(fn($y) => 'Tahun '.$y, array_reverse(range(date('Y') - 4, date('Y')))),
                      array_map('strval', array_reverse(range(date('Y') - 4, date('Y'))))
                    )
                  )"
                  x-model="$store.listPage.year"
                />
              </x-container>
            </x-container>
            <x-container :variant="'content-wrapper'" :class="'!px-0 flex flex-row items-center justify-end'">
              <x-form.dropdown 
                :buttonId="'sortFilterButton'"
                :dropdownId="'sortFilterDropdown'"
                :label="'Filter'"
                :imgSrc="asset('assets/icon-filter-v2.svg')"
                :isIconCanRotate="false"
                :dropdownItem="[
                  'Filter' => '',
                  'SKS Lulus < 138 SKS' => 'semester_1',
                  'SKS Lulus >= 138 SKS' => 'semester_2',
                  'SKS Lulus MK Wajib < 100 SKS' => 'semester_3',
                  'SKS Lulus MK Wajib >= 100 SKS' => 'semester_4',
                  'IPK < 1.75' => 'semester_5',
                  'IPK >= 1.75' => 'semester_6',
                  'IPS < 1.75' => 'semester_7',
                  'IPS >= 1.75' => 'semester_8',
                  'Nilai PEM < 3000' => 'nama, asc',
                  'Nilai PEM >= 3000' => 'nama, desc',
                ]"
                x-model="$store.listPage.filter"
              />
              <x-form.dropdown 
                :buttonId="'sortFilterButton'"
                :dropdownId="'sortFilterDropdown'"
                :label="'Urutkan'"
                :imgSrc="asset('assets/icon-filter.svg')"
                :isIconCanRotate="false"
                :dropdownItem="[
                  'Urutkan' => '',
                  'SKS Lulus Terendah' => 'semester_1',
                  'SKS Lulus Tertinggi' => 'semester_2',
                  'SKS Lulus MK Wajib Terendah' => 'semester_3',
                  'SKS Lulus MK Wajib Tertinggi' => 'semester_4',
                  'IPK Terendah' => 'semester_5',
                  'IPK Tertinggi' => 'semester_6',
                  'IPS Terendah' => 'semester_7',
                  'IPS Tertinggi' => 'semester_8',
                  'Nilai PEM Terendah' => 'nama, asc',
                  'Nilai PEM Tertinggi' => 'nama, desc',
                ]"
                x-model="$store.listPage.sort"
              />
            </x-container>
          </x-container>
          <x-container class="flex flex-col gap-[10px] !bg-[#FAFAFA]">
            <x-typography variant="caption-bold">Keterangan Status Persetujuan:</x-typography>
            <x-container :variant="'content-wrapper'" class="grid grid-cols-2 gap-[10px]">
              <template x-for="[key, status] in Object.entries(statusList)">
                <x-container :variant="'content-wrapper'" class="flex flex-row items-center gap-[6px]">
                  <x-typography :variant="'caption-bold'" class="px-4 py-[2px] rounded-[4px]" x-bind:style="{color: `${status.textColor}`, backgroundColor: `${status.color}` }">
                      x
                  </x-typography>
                  <x-typography variant="caption-regular" x-html="': '+status.text"></x-typography>
                </x-container>
              </template>
            </x-container>
          </x-container>
          <x-table>
              <x-table-head>
                  <x-table-row>
                      <x-table-header>No</x-table-header>
                      <x-table-header>NIM</x-table-header>
                      <x-table-header>Angkatan</x-table-header>
                      <x-table-header>Nama</x-table-header>
                      <x-table-header>IPS</x-table-header>
                      <x-table-header>IPK</x-table-header>
                      <x-table-header>SKS Lulus</x-table-header>
                      <x-table-header>SKS Lulus MK Wajib</x-table-header>
                      <x-table-header>Nilai PEM</x-table-header>
                      <x-table-header>Status Akademik</x-table-header>
                      <x-table-header>Status Persetujuan</x-table-header>
                      <x-table-header>Aksi</x-table-header>
                  </x-table-row>
              </x-table-head>

              <x-table-body>
                  <template x-if="$store.listPage.datas && $store.listPage.datas.length > 0">
                    <template x-for="data in $store.listPage.datas">
                      <x-table-row>
                        <x-table-cell x-text="data.id"></x-table-cell>
                        <x-table-cell x-text="data.nim"></x-table-cell>
                        <x-table-cell x-text="data.angkatan"></x-table-cell>
                        <x-table-cell x-text="data.nama"></x-table-cell>
                        <x-table-cell x-text="data.ips.toFixed(2)"></x-table-cell>
                        <x-table-cell x-text="data.ipk.toFixed(2)"></x-table-cell>
                        <x-table-cell x-text="data.sks_lulus"></x-table-cell>
                        <x-table-cell x-text="data.sks_lulus_wajib"></x-table-cell>
                        <x-table-cell x-text="data.nilai_pem"></x-table-cell>
                        <x-table-cell x-text="data.status_akademik"></x-table-cell>
                        <x-table-cell>
                            <x-container :variant="'content-wrapper'" class="flex flex-row justify-center gap-2">
                                <template x-for="persetujuan in data.status_persetujuan">
                                  <span 
                                    class="flex items-center justify-center px-4 py-[2px] rounded-[4px] text-xs" 
                                    x-bind:style="{color: `${statusList[persetujuan.status].textColor}`, backgroundColor: `${statusList[persetujuan.status].color}` }"
                                    x-text="persetujuan.nilai"
                                  ></span>
                                </template>
                            </x-container>
                        </x-table-cell>
                        <x-table-cell>
                            <x-button.primary
                                {{-- href="{{ route('tutelage-group.student-list.detail-krs', ['id' => $student['id']]) }}" --}}
                                class="px-0"
                                style="min-width: 0;"
                            >
                                Detail
                            </x-button.primary>
                        </x-table-cell>
                      </x-table-row>
                    </template>
                  </template>
              </x-table-body>
          </x-table>
      </x-container>
    </x-container>
    <template x-if="$store.listPage.datas.length !== 0">
      <x-pagination 
        x-data="{ 
          pagination: null,
          requestData: null
        }"
        x-effect="(() => {
          pagination = $store.listPage.paginationData;
          requestData = {
            periode: $store.listPage.periode,
            year: $store.listPage.year,
            sort: $store.listPage.sort,
            filter: $store.listPage.filter
          }
        })"
        :storeName="'listPage'"
        :storeKey="'datas'"
        :requestRoute="route('tutelage-group.list-student')"
        :responseKeyData="'students'"
        :defaultPerPageOptions="[5, 10, 15, 20, 25]"
      />
    </template>
  </x-container>
@endsection
