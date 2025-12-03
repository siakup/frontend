@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

<script type="module">
  document.addEventListener('alpine:init', () => {
    Alpine.store('listPage', { 
      periode: @js($periode),
      year: @js($year),
      sort: @js($sort),
      filter: @js($filter),
      datas: @js($students),
      paginationData: @js($pagination)
    });

    Alpine.data('listPerwalianKRS', window.PerwalianKRSController.listPerwalianKRS);
  });
</script>

@section('content')
  <x-container.container
    :variant="'content-wrapper'"
    class="pb-4"
    x-data="listPerwalianKRS({{ json_encode(route('tutelage-group.list-student')) }})"
  >
    <x-typography variant="body-large-semibold">Kelompok Perwalian - dosen</x-typography>
    <x-container.container :variant="'content-wrapper'" :class="'!gap-0 !px-0'">
      <x-tab 
        :tabItems="[
          (object)[
            'routeName' => 'tutelage-group.list-student',
            'routeQuery' => 'tutelage-group.list-student',
            'title' => 'Daftar Mahasiswa'
          ],
        ]"
      />
      <x-container.container :class="'flex flex-col gap-4 !rounded-tl-none items-stretch my-0 border-t-[1] border-t-[#F39194] relative !z-0'">
          <x-typography variant="body-medium-bold">Daftar Mahasiswa</x-typography>
          <x-container.container :class="'flex flex-row items-center justify-between'">
            <x-container.container :variant="'content-wrapper'" :class="'!flex-row items-center justify-start !px-0'">
              <x-container.container :variant="'content-wrapper'" :class="'!px-0 !flex-row items-center !gap-2'">
                  <x-typography :variant="'body-medium-bold'">Periode Akademik</x-typography>
                  <x-form.dropdown 
                    :buttonId="'sortPeriode'"
                    :dropdownId="'periodeList'"
                    :label="'Pilih Periode'"
                    :imgSrc="asset('assets/icons/arrow-down/red-16.svg')"
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
              <x-container.container :variant="'content-wrapper'" :class="'!px-0 !flex-row items-center !gap-2'">
                <x-typography :variant="'body-medium-bold'">Tahun Masuk</x-typography>
                <x-form.dropdown 
                  :buttonId="'sortButtonYear'"
                  :dropdownId="'sortYear'"
                  :label="'Pilih Tahun Masuk'"
                  :imgSrc="asset('assets/icons/arrow-down/red-16.svg')"
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
            <x-container.container :variant="'content-wrapper'" :class="'!px-0 !flex-row items-center justify-end'">
              <x-form.dropdown 
                :buttonId="'sortFilterButton'"
                :dropdownId="'sortFilterDropdown'"
                :label="'Filter'"
                :imgSrc="asset('assets/icons/filter/red-16.svg')"
                :isIconCanRotate="false"
                :dropdownItem="[
                  'Filter' => '',
                  'SKS Lulus < 138 SKS' => 'sks_lulus_<_138',
                  'SKS Lulus >= 138 SKS' => 'sks_lulus_<=_138',
                  'SKS Lulus MK Wajib < 100 SKS' => 'sks_mk_wajib_<_100',
                  'SKS Lulus MK Wajib >= 100 SKS' => 'sks_mk_wajib_>=_100',
                  'IPK < 1.75' => 'ipk_<_1.75',
                  'IPK >= 1.75' => 'ipk_>=_1.75',
                  'IPS < 1.75' => 'ips_<_1.75',
                  'IPS >= 1.75' => 'ips_>=_1.75',
                  'Nilai PEM < 3000' => 'pem_<_3000',
                  'Nilai PEM >= 3000' => 'pem_>=_3000',
                ]"
                x-model="$store.listPage.filter"
              />
              <x-form.dropdown 
                :buttonId="'sortFilterButton'"
                :dropdownId="'sortFilterDropdown'"
                :label="'Urutkan'"
                :imgSrc="asset('assets/icons/sort/red-16.svg')"
                :isIconCanRotate="false"
                :dropdownItem="[
                  'Urutkan' => '',
                  'SKS Lulus Terendah' => 'sks_lulus, asc',
                  'SKS Lulus Tertinggi' => 'sks_lulus, desc',
                  'SKS Lulus MK Wajib Terendah' => 'sks_lulus_mk_wajib, asc',
                  'SKS Lulus MK Wajib Tertinggi' => 'sks_lulus_mk_wajib, desc',
                  'IPK Terendah' => 'ipk, asc',
                  'IPK Tertinggi' => 'ipk, desc',
                  'IPS Terendah' => 'ips, asc',
                  'IPS Tertinggi' => 'ips, desc',
                  'Nilai PEM Terendah' => 'pem, asc',
                  'Nilai PEM Tertinggi' => 'pem, desc',
                ]"
                x-model="$store.listPage.sort"
              />
            </x-container>
          </x-container>
          <x-container.container class="flex flex-col gap-2.5 !bg-gray-100">
            <x-typography variant="caption-bold">Keterangan Status Persetujuan:</x-typography>
            <x-container.container :variant="'flat'" class="grid grid-cols-2 gap-[10px]">
              <template x-for="[key, status] in Object.entries(statusList)">
                <x-container.container :variant="'content-wrapper'" class="!flex-row items-center !gap-1.5">
                  <x-typography :variant="'caption-bold'" class="px-4 py-0.5 rounded-sm" x-bind:style="{color: `${status.textColor}`, backgroundColor: `${status.color}` }">
                      x
                  </x-typography>
                  <x-typography variant="caption-regular" x-html="': '+status.text"></x-typography>
                </x-container>
              </template>
            </x-container>
          </x-container>
          <x-table.index>
              <x-table.head>
                  <x-table.row>
                      <x-table.header-cell>No</x-table.header-cell>
                      <x-table.header-cell>NIM</x-table.header-cell>
                      <x-table.header-cell>Angkatan</x-table.header-cell>
                      <x-table.header-cell>Nama</x-table.header-cell>
                      <x-table.header-cell>IPS</x-table.header-cell>
                      <x-table.header-cell>IPK</x-table.header-cell>
                      <x-table.header-cell>SKS Lulus</x-table.header-cell>
                      <x-table.header-cell>SKS Lulus MK Wajib</x-table.header-cell>
                      <x-table.header-cell>Nilai PEM</x-table.header-cell>
                      <x-table.header-cell>Status Akademik</x-table.header-cell>
                      <x-table.header-cell>Status Persetujuan</x-table.header-cell>
                      <x-table.header-cell>Aksi</x-table.header-cell>
                  </x-table.row>
              </x-table.head>

              <x-table.body>
                  <template x-if="$store.listPage.datas && $store.listPage.datas.length > 0">
                    <template x-for="data in $store.listPage.datas">
                      <x-table.row>
                        <x-table.cell x-text="data.id"></x-table.cell>
                        <x-table.cell x-text="data.nim"></x-table.cell>
                        <x-table.cell x-text="data.angkatan"></x-table.cell>
                        <x-table.cell x-text="data.nama"></x-table.cell>
                        <x-table.cell x-text="data.ips.toFixed(2)"></x-table.cell>
                        <x-table.cell x-text="data.ipk.toFixed(2)"></x-table.cell>
                        <x-table.cell x-text="data.sks_lulus"></x-table.cell>
                        <x-table.cell x-text="data.sks_lulus_wajib"></x-table.cell>
                        <x-table.cell x-text="data.nilai_pem"></x-table.cell>
                        <x-table.cell x-text="data.status_akademik"></x-table.cell>
                        <x-table.cell>
                            <x-container.container :variant="'content-wrapper'" class="!flex-row justify-center gap-2">
                                <template x-for="persetujuan in data.status_persetujuan">
                                  <span 
                                    class="flex items-center justify-center px-4 py-0.5 rounded-sm text-xs" 
                                    x-bind:style="{color: `${statusList[persetujuan.status].textColor}`, backgroundColor: `${statusList[persetujuan.status].color}` }"
                                    x-text="persetujuan.nilai"
                                  ></span>
                                </template>
                            </x-container>
                        </x-table.cell>
                        <x-table.cell>
                            <x-button
                              :variant="'primary'"
                              :size="'md'"
                              x-on:click="window.location.href='{{route('tutelage-group.student-list.detail-krs', ['id' => ':id'])}}'.replace(':id', data.id)"
                              style="min-width: 0;"
                            >
                                Detail
                            </x-button>
                        </x-table.cell>
                      </x-table.row>
                    </template>
                  </template>
              </x-table.body>
          </x-table.index>
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
