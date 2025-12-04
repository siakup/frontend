@extends('layouts.main')

@section('title', 'Ekuivalensi Kurikulum')

@section('javascript')

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('ekuivalensiKurikulum', () => ({
                async deleteEkuivalensi(id) {
                    try {
                        // const response = await fetch(`/api/ekuivalensi/${id}`, {
                        //     method: 'DELETE'
                        // });
                        // if (!response.ok) throw new Error("Gagal hapus");

                        console.log('Berhasil menghapus data dengan id:', id);

                        // akses komponen blade & trigger
                        this.$store.flashMessage.trigger();

                    } catch (err) {
                        console.error(err);
                        this.$store.flashMessage.type = 'error';
                        this.$store.flashMessage.message = 'Gagal menghapus data';
                        this.$store.flashMessage.trigger();
                    }
                }
            }))
        })
    </script>

@endsection

@section('content')
  <x-container.container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Kurikulum</x-typography>
    <x-container.container :variant="'content-wrapper'" :class="'flex flex-col !gap-0 !px-0'" x-data="ekuivalensiKurikulum">
        <x-tab 
          :tabItems="[
            (object)[
              'routeName' => 'curriculum.list',
              'routeQuery' => 'curriculum.list',
              'title' => 'Daftar Kurikulum'
            ],
            (object)[
              'routeName' => Request::routeIs('curriculum.optional-structure') ? 'curriculum.optional-structure' : 'curriculum.required-structure',
              'routeQuery' => Request::routeIs('curriculum.optional-structure') ? 'curriculum.optional-structure' : 'curriculum.required-structure',
              'title' => 'Struktur Kurikulum'
            ],
            (object)[
              'routeName' => 'curriculum.equivalence',
              'routeQuery' => 'curriculum.equivalence',
              'title' => 'Ekuivalensi Kurikulum'
            ],
          ]"
        />
        <x-container.container :class="'flex flex-col !gap-8 items-stretch my-0 border-t-[1px] border-t-[#F39194] relative !z-0'">
            <x-typography variant="body-large-semibold">Ekuivalensi Mata Kuliah</x-typography>
            <x-container.container :variant="'content-wrapper'" :class="'flex flex-row items-center !mx-0 !justify-start z-10 !px-0'">
              <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center !mx-0 !px-0 !w-max" id="CampusProgramSection">
                <x-typography :variant="'body-medium-bold'">Program Perkuliahan</x-typography>
                <x-form.dropdown 
                  :buttonId="'sortButtonCampus'"
                  :dropdownId="'sortCampus'"
                  :label="
                    $id_program
                      ? array_values(array_filter($programPerkuliahanList, function ($item) use ($id_program) {
                          return $item->name == $id_program;
                        }))[0]->name
                      : 'Semua'
                  "
                  :imgSrc="asset('assets/active/icon-arrow-down.svg')"
                  :isIconCanRotate="true"
                  :isOptionRedirectableToURLQueryParameter="true"
                  :queryParameter="'program_perkuliahan'"
                  :url="route('curriculum.equivalence')"
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
                  :url="route('curriculum.equivalence')"
                  :dropdownItem="array_column($programStudiList, 'id', 'nama')"
                />
              </x-container>
            </x-container>
            <x-container.container :variant="'content-wrapper'" :class="'!px-0'">
              <x-table.index>
                  <x-table.head>
                      <x-table.row>
                          <x-table.header-cell class="cursor-pointer">Kode Lama</x-table.header-cell>
                          <x-table.header-cell class="cursor-pointer">Matkul Kurikulum Lama</x-table.header-cell>
                          <x-table.header-cell class="cursor-pointer">SKS Lama</x-table.header-cell>
                          <x-table.header-cell class="cursor-pointer">Kode Baru</x-table.header-cell>
                          <x-table.header-cell class="cursor-pointer">Matkul Kurikulum Baru</x-table.header-cell>
                          <x-table.header-cell class="cursor-pointer">SKS Baru</x-table.header-cell>
                          <x-table.header-cell class="cursor-pointer">Program Studi</x-table.header-cell>
                          <x-table.header-cell class="cursor-pointer">Aksi</x-table.header-cell>
                      </x-table.row>
                  </x-table.head>
                  <x-table.body>
                      @forelse ($data as $i => $d)
                          <x-table.row :odd="$i % 2 === 1" :last="$loop->last">
                              <x-table.cell>{{ $d['kode_lama'] }}</x-table.cell>
                              <x-table.cell>{{ $d['matkul_kurikulum_lama'] }}</x-table.cell>
                              <x-table.cell>{{ $d['sks_lama'] }}</x-table.cell>
                              <x-table.cell>{{ $d['kode_baru'] !== null ? $d['kode_baru'] : '-' }}</x-table.cell>
                              <x-table.cell>{{ $d['matkul_kurikulum_baru'] !== null ? $d['matkul_kurikulum_baru'] : '-' }}</x-table.cell>
                              <x-table.cell>{{ $d['sks_baru'] !== null ? $d['sks_baru'] : '-' }}</x-table.cell>
                              <x-table.cell>{{ $d['program_studi'] }}</x-table.cell>
                              <x-table.cell x-data="{ showModalDeleteConfirmation: false }">
                                <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center justify-center w-max">
                                  <x-button.base  :icon="asset('assets/icon-edit.svg')" :class="'scale-75 text-[#E62129]'" :href="route('curriculum.equivalence.edit', ['id' => 1])">Ubah</x-button.base>
                                  <x-button.action type="delete" label="Hapus" x-on:click="$dispatch('open-modal', {id: 'delete-confirmation'})" />
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
                  </x-table.body>
              </x-table.index>
            </x-container>
            <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center justify-end !px-0 !py-0">       
              <x-button.secondary :href="route('curriculum.equivalence.upload')" label="Upload Ekuivalensi" icon="{{ asset('assets/icon-upload-red-500.svg') }}" iconPosition="right" />
              <x-button.primary :href="route('curriculum.equivalence.create', ['prodi' => 'Ilmu Komputer', 'programPerkuliahan' => 'Regular'])">Tambah Ekuivalensi</x-button.primary>  
            </x-container>
        </x-container>
        @if (isset($data))
            @include('partials.pagination', [
                'currentPage' => 1,
                'lastPage' => 3,
                'limit' => 10,
                'routes' => route('curriculum.equivalence'),
            ])
        @endif
        {{-- TODO: Id nya jan lupa nnti yak --}}
        <div @on-submit.window="await deleteEkuivalensi(1)">
            <!-- Modal Konfirmasi Hapus -->
            <x-modal.confirmation iconUrl="{{ asset('assets/icon-delete-gray-800.svg') }}" id="delete-confirmation"
                title="Hapus Ekuivalensi Kurikulum" confirmText="Ya, Hapus" cancelText="Batal">
                <x-typography>Apakah Anda yakin ingin menghapus ekuivalensi kurikulum ini?</x-typography>
            </x-modal.confirmation>
        </div>
        <x-flash-message type="success" message="Ekuivalensi kurikulum berhasil dihapus" redirect="{{ route('curriculum.equivalence') }}" />
    </x-container>
  </x-container>
@endsection
