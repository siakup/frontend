@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('breadcrumbs')
    <div class="breadcrumb-item">Beranda</div>
    <div class="breadcrumb-item active">Kelompok Perwalian</div>
@endsection

<script type="module">
  import PerwalianKRS from "{{ asset('js/controllers/perwalianKrs.js') }}";
  document.addEventListener('alpine:init', () => {
    Alpine.store('detailPage', { 
      data: @js($data),
      tbl: @js($tbl)
    });

    Alpine.data('detailKRSPerwalianKRS', PerwalianKRS.detailKRSPerwalianKRS);
  });
</script>

@section('content')
  <x-container
    :variant="'content-wrapper'"
    x-data="detailKRSPerwalianKRS()"
  >
    <x-typography variant="body-large-semibold">Detail Kartu Studi Mahasiswa</x-typography>
    <x-container :variant="'content-wrapper'" :class="'flex flex-col !gap-0 !px-0'">
      <x-tab 
        :tabItems="[
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-krs',
            'routeQuery' => 'tutelage-group.student-list.detail-krs',
            'title' => 'KRS',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-student-data',
            'routeQuery' => 'tutelage-group.student-list.detail-student-data',
            'title' => 'Data Mahasiswa',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-transkrip-resmi',
            'routeQuery' => 'tutelage-group.student-list.detail-transkrip-resmi',
            'title' => 'Transk. Resmi',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-transkrip-historis',
            'routeQuery' => 'tutelage-group.student-list.detail-transkrip-historis',
            'title' => 'Transk. Historis',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-transkrip-kurikulum',
            'routeQuery' => 'tutelage-group.student-list.detail-transkrip-kurikulum',
            'title' => 'Transk. Kurikulum',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-transkrip-pem',
            'routeQuery' => 'tutelage-group.student-list.detail-transkrip-pem',
            'title' => 'Transk. PEM',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'home',
            'routeQuery' => 'home',
            'title' => 'Pesan untuk Mahasiswa',
            'param' => ['id' => $id]
          ],
        ]"
      />
        <x-container :class="'flex flex-col gap-4 rounded-tl-none items-stretch my-0 border-t-[1] border-t-[#F39194] relative !z-0'">
            <x-typography variant="body-medium-bold">Kartu Rencana Studi Mahasiswa</x-typography>
            <x-container :class="'!p-0 !overflow-hidden'">
              <table class="min-w-full table-fixed text-sm text-[#262626]">
                  <tbody>
                    <x-table-row class="text-[#262626]">
                        <x-table-cell class="bg-[#E8E8E8] text-start w-[30%]">Nama Mahasiswa</x-table-cell>
                        <x-table-cell class="text-start bg-[#F5F5F5] font-bold w-[70%]" x-text="$store.detailPage.data.student.nama"></x-table-cell>
                    </x-table-row>
                    <x-table-row class="text-[#262626]">
                        <x-table-cell class="bg-[#F5F5F5] text-start w-[30%]">Nomor Induk Mahasiswa</x-table-cell>
                        <x-table-cell class="text-start bg-[#FFFFFF] font-bold w-[70%]" x-text="$store.detailPage.data.student.nim"></x-table-cell>
                    </x-table-row>
                    <x-table-row class="text-[#262626]">
                        <x-table-cell class="bg-[#E8E8E8] text-start w-[30%]">Status Pembayaran</x-table-cell>
                        <x-table-cell class="text-start bg-[#F5F5F5] font-bold w-[70%]">
                          <span 
                            x-bind:class="{
                              'text-green-600': $store.detailPage.data.student.status_bayar === 'Sudah Membayar', 
                              'text-red-600': $store.detailPage.data.student.status_bayar === 'Belum Membayar'
                            }" 
                            x-text="$store.detailPage.data.student.status_bayar"></span>
                        </x-table-cell>
                    </x-table-row>
                    <x-table-row class="text-[#262626]">
                        <x-table-cell class="bg-[#F5F5F5] text-start w-[30%]">Indeks Prestasi Kumulatif</x-table-cell>
                        <x-table-cell class="text-start bg-[#FFFFFF] font-bold w-[70%]" x-text="$store.detailPage.data.student.ipk"></x-table-cell>
                    </x-table-row>
                    <x-table-row class="text-[#262626]">
                        <x-table-cell class="bg-[#E8E8E8] text-start w-[30%]">SKS yang diperbolehkan</x-table-cell>
                        <x-table-cell class="text-start bg-[#F5F5F5] font-bold w-[70%]" x-text="$store.detailPage.data.student.sks_boleh+' SKS'"></x-table-cell>
                    </x-table-row>
                  </tbody>
              </table>
            </x-container>
            <x-container :variant="'content-wrapper'" :class="'!px-0'">
                <x-container class="!border-yellow-300 !bg-yellow-50 text-sm leading-relaxed flex flex-row items-center gap-3">
                    <x-icon :iconUrl="asset('assets/icon-caution-warning.svg')" :iconAlt="'caution'" />
                    <x-container :variant="'content-wrapper'" class="!flex-1 !p-0 !gap-0">
                        <x-typography variant="body-medium-bold">Perhatian!</x-typography>
                        <x-typography>
                            Mahasiswa kurang
                            <b x-text="$store.detailPage.data.krsInfo.sisa_sks_kelulusan"></b> SKS untuk lulus
                            <span x-text="$store.detailPage.data.krsInfo.total_sks_kelulusan"></span> SKS.
                        </x-typography>
                        <x-typography variant="body-medium-bold" :class="'!mt-3'">Rekomendasi wajib:</x-typography>
                        <ul class="list-disc pl-5">
                          <template x-for="rekomendasi_wajib in $store.detailPage.data.krsInfo.rekom_wajib">
                            <li x-text="rekomendasi_wajib"></li>
                          </template>
                        </ul>
                        <x-typography variant="body-medium-bold" :class="'!mt-3'">Rekomendasi ulang:</x-typography>
                        <ul class="list-disc pl-5">
                          <template x-for="rekomendasi_ulang in $store.detailPage.data.krsInfo.rekom_ulang">
                            <li x-text="rekomendasi_ulang"></li>
                          </template>
                        </ul>
                    </x-container>
                </x-container>
            </x-container>
            <template x-for="([key, section]) in Object.entries(sections)">
                <x-container :class="'!p-0 overflow-hidden'">
                    <x-container :variant="'content-wrapper'" class="h-20 rounded-none flex flex-row justify-between items-center !py-2.5 !px-3" x-bind:class="{[section.grad]: section.grad}">
                        <x-typography :variant="'body-small-bold'" class="w-full" x-text="'Mata Kuliah '+section.title"></x-typography>
                        <x-container :variant="'content-wrapper'" class="flex flex-row justify-end gap-2">
                            <template x-for="([action, label]) in Object.entries(section.btns)">
                                <template x-if="action.includes('approve')">
                                    <x-button.primary
                                        {{-- data-action="{{ $action }}"
                                        data-table="tbl{{ ucfirst($key) }}" --}}
                                        x-text="label"
                                    ></x-button.primary>
                                </template>
                                <template x-if="action.includes('reject')">
                                    <x-button.secondary
                                        {{-- data-action="{{ $action }}"
                                        data-table="tbl{{ ucfirst($key) }}" --}}
                                        x-text="label"
                                    ></x-button.secondary>
                                </template>
                                <template x-if="!action.includes('approve') && !action.includes('reject')">
                                    <x-button.secondary
                                        {{-- data-action="{{ $action }}" --}}
                                        {{-- data-table="tbl{{ ucfirst($key) }}" --}}
                                        x-text="label"
                                    ></x-button.secondary>
                                </template>
                            </template>
                        </x-container>
                    </x-container>
                    <x-table :isRoundedTop="false" :isBordered="false">
                        <x-table-head>
                            <x-table-row>
                              {{-- data-select-all="tbl{{ ucfirst($key) }}" --}}
                                <x-table-header class="w-[40px]"><input type="checkbox" class="chk"></x-table-header>
                                <template x-for="col in cols">
                                  <x-table-header x-text="col"></x-table-header>
                                </template>
                            </x-table-row>
                        </x-table-head>
                        <x-table-body>
                          <template x-if="$store.detailPage.tbl[key] && $store.detailPage.tbl[key].length > 0">
                            <template x-for="table in $store.detailPage.tbl[key]">
                              <x-table-row>
                                <x-table-cell><input type="checkbox" class="chk"></x-table-cell>
                                <x-table-cell x-text="table.no"></x-table-cell>
                                <x-table-cell x-text="table.kelas"></x-table-cell>
                                <x-table-cell x-text="table.mk"></x-table-cell>
                                <x-table-cell x-text="table.sks"></x-table-cell>
                                <x-table-cell x-text="table.nilai"></x-table-cell>
                                <x-table-cell x-text="table.prodi"></x-table-cell>
                                <x-table-cell x-text="table.presensi"></x-table-cell>
                                <x-table-cell x-text="table.uas"></x-table-cell>
                                <x-table-cell x-html="table.status_label"></x-table-cell>
                              </x-table-row>
                            </template>
                          </template>
                          <template x-if="!$store.detailPage.tbl[key] || $store.detailPage.tbl[key].length == 0">
                            <x-table-row><x-table-cell colspan="10" class="text-center text-gray-500">Belum Ada Data</x-table-cell></x-table-row>
                          </template>
                        </x-table-body>
                    </x-table>
                </x-container>
            </template>
            <x-container>
              <x-button.primary
                  href="{{ route('tutelage-group.student-list.detail-krs.add-course',['id'=>1]) }}"
                  class="w-full"
                  iconPosition="right"
                  icon="{{ asset('assets/icon-plus-white.svg') }}"
              >
                Tambah Kelas Mata Kuliah
              </x-button.primary>
            </x-container>

            {{-- TODO: Tambah Kalender--}}
            <x-container class="!p-0 box-border overflow-clip">
              <x-full-calendar :events="$events" />
            </x-container>

            <x-container :variant="'content-wrapper'" class="flex flex-row justify-end !px-0">
              <x-button.secondary href="{{route('tutelage-group.list-student')}}">Kembali</x-button.secondary>
            </x-container>
        </x-container>
    </x-container>
  </x-container>
@endsection