<div
  x-data="lectureViewComponents({{ json_encode($pengajar) }}, {{ json_encode($pagination) }})"
  x-effect="
    if($store.lectureModal) {
      pengajar = $store.lectureModal.pengajar;
      paginationData = $store.lectureModal.paginationData;
    }
  "
>
  <x-modal.container-pure-js id="modalListLecture">
    <x-slot name="header">
      <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tambah Pengajar</x-typography>
        <x-button.base
          onclick="document.getElementById('modalListLecture').remove();
          document.getElementById('list-lecture').innerHTML=''"
          :class="'scale-150'"
        >
            &times;
        </x-button.base>
      </x-container>
    </x-slot>
    <x-slot name="body">
      <x-container :variant="'content-wrapper'" :class="'flex flex-row items-center justify-between !px-0 mb-4'">
        <x-typography :variant="'body-small-regular'" :class="'w-max flex-1/6'">Cari Pengajar</x-typography>
        <x-form.search
          :value="$search"
          :placeholder="'Ketik NIP / Nama Pengajar / Pengajar Program Studi'"
          :storeName="'lectureModal'"
          :storeKey="'pengajar'"
          :requestRoute="route('academics.schedule.prodi-schedule.add-lecture')"
          :responseKeyData="'pengajar'"
        />
      </x-container>  
      <x-table id="Lecture-List">
        <x-table-head>
          <x-table-row>
            <x-table-header>NIP</x-table-header>
            <x-table-header>Nama Pengajar</x-table-header>
            <x-table-header>Pengajar Program Studi</x-table-header>
            <x-table-header>Aksi</x-table-header>
          </x-table-row>
        </x-table-head>
        <x-table-body>
          <template x-if="pengajar.length > 0">
            <template x-for="(lecture, index) in pengajar">
              <x-table-row>
                <x-table-cell x-text="lecture.nomor_induk"></x-table-cell>
                <x-table-cell x-text="lecture.nama"></x-table-cell>
                <x-table-cell x-text="lecture.pengajar_program_studi ?? ''"></x-table-cell>
                <x-table-cell>
                  <x-button.primary x-on:click="chooseLecture(index)">Pilih Pengajar Ini</x-button.primary>
                </x-table-cell>
              </x-table-row>
            </template>
          </template>
          <template x-if="pengajar.length == 0">
            @include('academics.periode.error-filter')
          </template>
        </x-table-body>
      </x-table>
    </x-slot>
    <x-slot name="footer">
      <div class="self-start text-black w-full" id="Pagination">
        @if(isset($pengajar) && count($pengajar) > 0)
          <x-pagination 
            x-data="{ pagination: null }"
            x-effect="
              if ($store.lectureModal?.paginationData) {
                pagination = { ...$store.lectureModal.paginationData };
              }
            "
            :storeName="'lectureModal'"
            :storeKey="'pengajar'"
            :requestRoute="route('academics.schedule.prodi-schedule.add-lecture')"
            :responseKeyData="'pengajar'"
            :defaultPerPageOptions="[5, 10, 15, 20, 25]"
          />
        @endif
      </div>
    </x-slot>
  </x-modal.container-pure-js>
</div>