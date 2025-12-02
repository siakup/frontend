@extends('layouts.main')

@section('title', 'Daftar Kurikulum')

@section('javascript')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{ asset('js/custom/curriculum.js')}}"></script>
  @include('partials.success-notification-modal', ['route' => 'curriculum.list'])
@endsection

@section('content')
  <x-container.container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Kurikulum</x-typography>
    <x-container.container :variant="'content-wrapper'" class="flex flex-col !gap-0 !px-0">
      <x-tab 
        :tabItems="[
          (object)[
            'routeName' => 'curriculum.list',
            'routeQuery' => 'curriculum.list',
            'title' => 'Daftar Kurikulum'
          ],
          (object)[
            'routeName' => 'curriculum.required-structure',
            'routeQuery' => 'curriculum.required-structure',
            'title' => 'Struktur Kurikulum'
          ],
          (object)[
            'routeName' => 'curriculum.equivalence',
            'routeQuery' => 'curriculum.equivalence',
            'title' => 'Ekuivalensi Kurikulum'
          ],
        ]"
      />
      <x-container.container :class="'flex flex-col !gap-8 rounded-tl-none items-stretch my-0 border-t-[1px] border-t-[#F39194] relative !z-0'">
        <x-typography variant="body-large-semibold">
          Daftar Kurikulum - {{array_values(array_filter($programStudiList, function($item) use($id_prodi) { return $item->id == $id_prodi; }))[0]->nama}}
        </x-typography>
        <x-container.container :variant="'content-wrapper'" :class="'flex flex-row items-center !mx-0 !justify-start z-10 !px-0'">
          <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center !mx-0 !px-0 !w-max" id="CampusProgramSection">
            <x-typography :variant="'body-medium-bold'">Program Perkuliahan</x-typography>
            <x-form.dropdown 
              :buttonId="'sortButtonCampus'"
              :dropdownId="'sortCampus'"
              :label="
                count(
                  array_filter(
                    $programPerkuliahanList, 
                    function($item) use($id_program) { 
                      return $item['name'] == urldecode($id_program); 
                    }
                  )
                ) > 0 
                  ? array_values(
                      array_filter(
                        $programPerkuliahanList, 
                        function($item) use($id_program) { 
                          return $item['name'] == urldecode($id_program); 
                        }
                      )
                    )[0]['name']
                  : ''
              "
              :imgSrc="asset('assets/active/icon-arrow-down.svg')"
              :isIconCanRotate="true"
              :isOptionRedirectableToURLQueryParameter="true"
              :queryParameter="'program_perkuliahan'"
              :url="route('curriculum.list')"
              :dropdownItem="array_column($programPerkuliahanList, 'name', 'name')"
            />
          </x-container>
          <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center !mx-0 !w-max !px-0" id="StudyProgramSection">
            <x-typography :variant="'body-medium-bold'">Program Studi</x-typography>
            <x-form.dropdown 
              :buttonId="'sortButtonStudyProgram'"
              :dropdownId="'sortStudyProgram'"
              :label="
              count(
                array_filter(
                  $programStudiList, 
                  function($item) use($id_prodi) { 
                    return $item->id == $id_prodi; 
                  }
                )
              ) > 0 
                ? array_values(
                  array_filter(
                    $programStudiList, 
                    function($item) use($id_prodi) { 
                      return $item->id == $id_prodi; 
                    }
                  )
                )[0]->nama 
                : ''
              "
              :imgSrc="asset('assets/active/icon-arrow-down.svg')"
              :isIconCanRotate="true"
              :isOptionRedirectableToURLQueryParameter="true"
              :queryParameter="'program_studi'"
              :url="route('curriculum.list')"
              :dropdownItem="array_column($programStudiList, 'id', 'nama')"
            />
          </x-container>
        </x-container>
        <x-container.container :variant="'content-wrapper'" :class="'!px-0'">
          <x-table.index>
              <x-table.head>
                  <x-table.row>
                      <x-table.header-cell>Nama</x-table.header-cell>
                      <x-table.header-cell>Program Perkuliahan</x-table.header-cell>
                      <x-table.header-cell>Deskripsi</x-table.header-cell>
                      <x-table.header-cell>Total SKS</x-table.header-cell>
                      <x-table.header-cell>Status</x-table.header-cell>
                      <x-table.header-cell>Aksi</x-table.header-cell>
                  </x-table.row>
              </x-table.head>
              <tbody>
                  @forelse ($data as $d)
                      <x-table.row>
                          <x-table.cell>{{ $d->nama_kurikulum }}</x-table.cell>
                          <x-table.cell class="{{
                            $d->perkuliahan == 'Double Degree' ? 'bg-[#E5EDAB]' :
                            ($d->perkuliahan == 'International Class' ? 'bg-[#99D8FF]' :
                            ($d->perkuliahan == 'Reguler' ? 'bg-[#FBDADB]' : 'bg-[#FEF3C0]'))
                          }}"
                          >
                            {{ $d->perkuliahan }}
                          </x-table.cell>
                          <x-table.cell>{{ $d->deskripsi }}</x-table.cell>
                          <x-table.cell>{{ $d->sks_total }}</x-table.cell>
                          <x-table.cell>
                            <x-container.container :variant="'content-wrapper'" :class="'!px-0 !w-max'">
                              @if ($d->status_aktif === 'active')
                                <x-badge variant="green-filled">Aktif</x-badge>
                              @else
                                <x-badge variant="green-bordered"></x-badge>
                              @endif
                            </x-container>
                          </x-table.cell>
                          <x-table.cell>
                            <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center justify-center w-max">
                              <x-button.base :icon="asset('assets/icon-search.svg')" class=" scale-75" :href="route('curriculum.list.view', ['id' => $d->id])">Lihat</x-button.base>
                              <x-button.base :icon="asset('assets/icon-edit.svg')" :href="route('curriculum.list.edit', ['id' => $d->id])" class="text-[#E62129] scale-75">Ubah</x-button.base>
                              <x-button.base 
                                :icon="asset('assets/icon-delete-gray-600.svg')" 
                                class="text-[#8C8C8C] scale-75"
                                onclick="
                                  document.getElementById('modalKonfirmasiHapus').classList.add('flex')
                                  document.getElementById('modalKonfirmasiHapus').classList.remove('hidden')
                                "
                              >
                                Hapus
                              </x-button.base>
                            </x-container>
                          </x-table.cell>
                      </x-table.row>
                  @empty
                      <x-table.row>
                        <x-table.cell colspan="6" class="text-center py-4">
                          Tidak ada data ditemukan
                        </x-table.cell>
                      </x-table.row>
                  @endforelse
              </tbody>
          </x-table.index>
        </x-container>
        <x-container.container :variant="'content-wrapper'" class="flex items-end justify-end !px-0">
          <x-button.primary :href="route('curriculum.list.create', ['program_studi' => $id_prodi])">Tambah Kurikulum</x-button.primary>
        </x-container>
      </x-container>
    </x-container>
  </x-container>
  <x-modal.container-pure-js id="modalKonfirmasiHapus">
    <x-slot name="header">
      <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Hapus Daftar kurikulum</x-typography>
        <x-icon :iconUrl="asset('assets/icon-delete-gray-800.svg')" :class="'w-8 h-8'" />
      </x-container>
    </x-slot>
    <x-slot name="body">Apakah Anda yakin ingin menghapus kurikulum ini?</x-slot>
    <x-slot name="footer">
      <x-button.secondary 
        onclick="
          this.parentElement.parentElement.parentElement.removeAttribute('data-id')
          this.parentElement.parentElement.parentElement.classList.add('hidden');
          this.parentElement.parentElement.parentElement.classList.remove('flex');
        "
      >
        Batal
      </x-button.secondary>
      <x-button.primary 
        onclick="
          const id = this.parentElement.parentElement.parentElement.getAttribute('data-id');
          onClickDeleteCurriculum(this, '{{ route('curriculum.list') }}', ''.replace(':id', id))
        "
      >
        Hapus
      </x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
  </div>
@endsection
