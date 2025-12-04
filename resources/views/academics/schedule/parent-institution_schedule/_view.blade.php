<script>
  window.modalData = @json($data);
</script>

<x-modal.container-pure-js id="modalViewParentInstitution">
  <x-slot name="header">
    <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
      <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Lihat Jadwal Kuliah Institusi Parent</x-typography>
      <x-button.base
        onclick="document.getElementById('modalViewParentInstitution').remove();
        document.getElementById('view-prodi-schedule').innerHTML=''"
        :class="'scale-150'"
      >
          &times;
      </x-button.base>
    </x-container>
  </x-slot>
  <x-slot name="body">
    <x-container.container 
      :variant="'content-wrapper'" 
      :class="'px-0 max-h-[70vh] !overflow-scroll'" 
      x-data='Object.assign({
        toggleLectureSection: false,
        toggleScheduleSection: false,
        toggleClassInformationSection: true,
      }, window.modalData)'
    >
      <x-container.container :class="'flex flex-col !gap-5'">
        <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'" x-on:click="toggleClassInformationSection = ! toggleClassInformationSection">
          <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Informasi Kelas</x-typography>
          <x-icon :id="'icon-detail'" :iconUrl="asset('assets/icon-arrow-up-black-16.svg')" :class="'!w-5 !h-5 transition-transform duration-200'" x-bind:class="{'rotate-180': !toggleClassInformationSection}" />
        </x-container>
        <x-container.container :variant="'content-wrapper'" class="flex flex-col gap-4" x-bind:class="{'hidden': !toggleClassInformationSection, 'flex': toggleClassInformationSection}">
          <x-container.container :variant="'content-wrapper'" class="flex flex-row justify-between !px-0">
              <x-form.input-container :class="'min-w-[170px]'">
                <x-slot name="label">Program Perkuliahan</x-slot>
                <x-slot name="input">
                  <x-form.input 
                    :placeholder="'Pilih Mata Kuliah'" 
                    :name="'nama_matakuliah'" 
                    readonly
                    x-model="program_perkuliahan"
                  />
                </x-slot>
              </x-form.input-container>
              <x-form.input-container :class="'min-w-[170px]'">
                <x-slot name="label">Program Studi</x-slot>
                <x-slot name="input">
                  <x-form.input 
                    :placeholder="'Pilih Mata Kuliah'" 
                    :name="'nama_matakuliah'" 
                    readonly
                    x-model="program_studi"
                  />
                </x-slot>
              </x-form.input-container>
          </x-container>
          <x-form.input-container :class="'min-w-[170px]'">
            <x-slot name="label">Periode</x-slot>
            <x-slot name="input">
              <x-form.input 
                :placeholder="'Pilih Mata Kuliah'" 
                :name="'nama_matakuliah'" 
                readonly
                x-model="periode"
              />
            </x-slot>
          </x-form.input-container>
          <x-container.container :variant="'content-wrapper'" :class="'!flex flex-row !p-0 justify-between items-center'">
            <x-form.input-container :containerClass="'w-full'" class="min-w-[170px]">
              <x-slot name="label">Nama Mata Kuliah</x-slot>
              <x-slot name="input">
                <x-form.input 
                  :placeholder="'Pilih Mata Kuliah'" 
                  :name="'nama_matakuliah'" 
                  readonly
                  x-model="course.nama_matakuliah_id"
                />
              </x-slot>
            </x-form.input-container>
          </x-container>
          <x-form.input-container :class="'min-w-[170px]'">
            <x-slot name="label">Nama Kelas</x-slot>
            <x-slot name="input">
              <x-form.input 
                :name="'nama_kelas'"
                readonly
                :placeholder="'Masukan Nama Kelas. Contoh: Makroekonomi-EC2'"
                x-model="nama_kelas"
              />
            </x-slot>
          </x-form.input-container>
          <x-form.input-container :class="'min-w-[170px]'">
            <x-slot name="label">Nama Singkat</x-slot>
            <x-slot name="input">
              <x-form.input 
                :name="'nama_singkat'" 
                readonly
                :placeholder="'Masukan Nama Singkat. Contoh: EC2'"
                x-model="nama_singkat"
              />
            </x-slot>
          </x-form.input-container>
          <x-container.container :variant="'content-wrapper'" :class="'flex flex-row items-center !px-0 justify-between'">
            <x-form.input-container :class="'min-w-[170px]'">
              <x-slot name="label">Kapasitas Peserta</x-slot>
              <x-slot name="input">
                <x-form.input 
                  :type="'number'"
                  :name="'kapasitas_peserta'" 
                  readonly
                  :placeholder="'Masukkan Kapasitas. Contoh: 50'"
                  x-model="kapasitas_peserta"
                />
              </x-slot>
            </x-form.input-container>
            <x-form.input-container :class="'min-w-[170px]'">
              <x-slot name="label">Kelas MBKM</x-slot>
              <x-slot name="input">
                <x-form.input 
                  :placeholder="'Pilih Mata Kuliah'" 
                  :name="'nama_matakuliah'" 
                  readonly
                  x-model="kelas_mbkm"
                />
              </x-slot>
            </x-form.input-container>
          </x-container>
          <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between !p-0'">
            <x-form.input-container class="min-w-[170px]" id="tanggal_mulai">
              <x-slot name="label">Tanggal Mulai</x-slot>
              <x-slot name="input">
                <x-form.input 
                  :placeholder="'Pilih Mata Kuliah'" 
                  :name="'nama_matakuliah'" 
                  readonly
                  x-model="tanggal_mulai"
                />
              </x-slot>
            </x-form.input-container>
            <x-form.input-container class="min-w-[170px]" id="tanggal_selesai">
              <x-slot name="label">Tanggal Berakhir</x-slot>
              <x-slot name="input">
                <x-form.input 
                  :placeholder="'Pilih Mata Kuliah'" 
                  :name="'nama_matakuliah'" 
                  readonly
                  x-model="tanggal_akhir"
                />
              </x-slot>
            </x-form.input-container>
          </x-container>
        </x-container>
      </x-container>
  
      <x-container.container :class="'flex flex-col !gap-5'">
        <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'" x-on:click="toggleLectureSection = ! toggleLectureSection">
          <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Daftar Pengajar</x-typography>
          <x-icon :id="'icon-detail'" :iconUrl="asset('assets/icon-arrow-up-black-16.svg')" :class="'!w-5 !h-5 transition-transform duration-200'" x-bind:class="{'rotate-180': !toggleLectureSection}" />
        </x-container>
        <x-container.container :variant="'content-wrapper'" class="flex flex-col gap-4 !p-0" x-bind:class="{'hidden': !toggleLectureSection, 'flex': toggleLectureSection}">
          <x-table.index id="selected-lecture">
            <x-table.head>
              <x-table.row>
                <x-table.header-cell>Nama Pengajar</x-table.header-cell>
                <x-table.header-cell>Status Pengajar</x-table.header-cell>
              </x-table.row>
            </x-table.head>
            <x-table.body>
              <template x-for="(lecture, index) in lectureList">
                <x-table.row>
                  <x-table.cell x-text="lecture.nama"></x-table.cell>
                  <x-table.cell x-text="lecture.status_pengajar"></x-table.cell>
                </x-table.row>
              </template>
            </x-table.body>
          </x-table.index>
        </x-container>
      </x-container>
  
      <x-container.container :class="'flex flex-col !gap-5'">
        <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'" x-on:click="toggleScheduleSection = ! toggleScheduleSection">
          <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Daftar Jadwal Kelas</x-typography>
          <x-icon :id="'icon-detail'" :iconUrl="asset('assets/icon-arrow-up-black-16.svg')" :class="'!w-5 !h-5 transition-transform duration-200'" x-bind:class="{'rotate-180': !toggleScheduleSection}" />
        </x-container>
        <x-container.container :variant="'content-wrapper'" class="flex flex-col gap-4 !p-0" x-bind:class="{'hidden': !toggleScheduleSection, 'flex': toggleScheduleSection}">
          <x-table.index id="class-schedule">
            <x-table.head>
              <x-table.row>
                <x-table.header-cell>Hari</x-table.header-cell>
                <x-table.header-cell>Waktu Mulai Kelas</x-table.header-cell>
                <x-table.header-cell>Waktu Selesai Kelas</x-table.header-cell>
                <x-table.header-cell>Ruangan</x-table.header-cell>
              </x-table.row>
            </x-table.head>
            <x-table.body>
              <template x-for="(schedule, index) in scheduleList">
                <x-table.row>
                  <x-table.cell x-text="schedule.hari"></x-table.cell>
                  <x-table.cell x-text="schedule.jam_mulai"></x-table.cell>
                  <x-table.cell x-text="schedule.jam_akhir"></x-table.cell>
                  <x-table.cell x-text="schedule.ruangan"></x-table.cell>
                </x-table.row>
              </template>
            </x-table.body>
          </x-table.index>
        </x-container>
      </x-container>
    </x-container>
  </x-slot>
  <x-slot name="footer"></x-slot>
</x-modal.container-pure-js>