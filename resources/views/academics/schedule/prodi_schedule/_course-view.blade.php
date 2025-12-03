<div  
  x-data="courseViewComponents({{ json_encode($mata_kuliah_list) }}, {{ json_encode($pagination)}})"
  x-effect="
    if($store.courseModal) {
      mataKuliahList = $store.courseModal.mataKuliahList;
      paginationData = $store.courseModal.paginationData;
    }
  "
>
  <x-modal.container-pure-js id="modalListCourse">
    <x-slot name="header">
      <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Daftar Mata Kuliah - Semester {{$periodeData->semester == 1 ? 'Ganjil' : ($periodeData->semester == 2 ? 'Genap' : 'Pendek')}}</x-typography>
        <x-button.base
          onclick="document.getElementById('modalListCourse').remove();
          document.getElementById('list-course').innerHTML=''"
          :class="'scale-150'"
        >
            &times;
        </x-button.base>
      </x-container>
    </x-slot>
    <x-slot name="body">
      <x-container.container :variant="'content-wrapper'" :class="'flex flex-row items-center justify-between !px-0 mb-4'">
        <x-typography :variant="'body-small-regular'" :class="'w-max flex-1/6'">Cari Mata Kuliah</x-typography>
        <x-form.search
          :value="$search"
          :placeholder="'Ketik Mata Kuliah/Kode Mata Kuliah'"
          :storeName="'courseModal'"
          :storeKey="'mataKuliahList'"
          :requestRoute="route('academics.schedule.prodi-schedule.add-course', ['periode' => $periode]).'?program_perkuliahan='.urlencode($program_perkuliahan).'&program_studi='.$program_studi"
          :responseKeyData="'matakuliah'"
        />
      </x-container>  
      <x-table.index id="Lecture-List">
        <x-table.head>
          <x-table.row>
            <x-table.header-cell>Kode Mata Kuliah</x-table.header-cell>
            <x-table.header-cell>Nama Mata Kuliah</x-table.header-cell>
            <x-table.header-cell>Jenis Mata Kuliah</x-table.header-cell>
            <x-table.header-cell>SKS</x-table.header-cell>
            <x-table.header-cell>Kurikulum</x-table.header-cell>
            <x-table.header-cell>Aksi</x-table.header-cell>
          </x-table.row>
        </x-table.head>
        <x-table.body>
          <template x-if="mataKuliahList.length > 0">
            <template x-for="(course, index) in mataKuliahList">
              <x-table.row>
                <x-table.cell x-text="course.kode_matakuliah"></x-table.cell>
                <x-table.cell x-text="course.nama_matakuliah_id"></x-table.cell>
                <x-table.cell x-text="course.id_jenis ?? ''"></x-table.cell>
                <x-table.cell x-text="course.sks ?? ''"></x-table.cell>
                <x-table.cell x-text="course.nama_kurikulum ?? ''"></x-table.cell>
                <x-table.cell>
                  <x-button.primary x-on:click="chooseCourse(index)">Pilih Mata Kuliah Ini</x-button.primary>
                </x-table.cell>
              </x-table.row>
            </template>
          </template>
          <template x-if="mataKuliahList.length == 0">
            @include('academics.periode.error-filter')
          </template>
        </x-table.body>
      </x-table.index>
    </x-slot>
    <x-slot name="footer">
      <div class="self-start text-black w-full" id="Pagination">
        @if(isset($mata_kuliah_list) && count($mata_kuliah_list) > 0)
          <x-pagination 
            x-data="{ pagination: null }"
            x-effect="
              if ($store.courseModal?.paginationData) {
                pagination = { ...$store.courseModal.paginationData };
              }
            "
            :storeName="'courseModal'"
            :storeKey="'mataKuliahList'"
            :requestRoute="route('academics.schedule.prodi-schedule.add-course', ['periode' => $periode]).'?program_perkuliahan='.urlencode($program_perkuliahan).'&program_studi='.$program_studi"
            :responseKeyData="'matakuliah'"
            :defaultPerPageOptions="[5, 10, 15, 20, 25]"
          />
        @endif
      </div>
    </x-slot>
  </x-modal.container-pure-js>
</div>

