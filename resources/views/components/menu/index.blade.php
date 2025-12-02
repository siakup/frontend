<x-container.container :variant="'flat'" class="w-full min-h-[calc(100vh-9rem)] h-full bg-white z-1000 border-r border-r-gray-400">
  <x-container.wrapper :padding="'p-0'" :rows="12">

    <x-container.container :variant="'flat'" class="row-span-11">
      <x-menu.container :variant="'main'">
        <x-menu.item
          :label="'Beranda'"
          :haveIcon="true"
          :iconInactive="asset('assets/icons/home/black-24.svg')"
          :iconActive="asset('assets/icons/home/red-24.svg')"
          :routeName="'home'"
          :routeQuery="'home'"
          :variant="'parent'"
        />
        {{-- <x-menu.item
          :label="'Profil'"
          :haveIcon="true"
          :icon="asset('assets/base/icon-profile.svg')"
          :routeName="'home'"
          :routeQuery="'home'"
          :variant="'parent'"
        />
        <x-menu.item
          :label="'Pesan'"
          :haveIcon="true"
          :icon="asset('assets/base/icon-pesan.svg')"
          :routeName="'home'"
          :routeQuery="'home'"
          :variant="'parent'"
        />
        <x-menu.item
          :label="'Pengumuman'"
          :haveIcon="true"
          :icon="asset('assets/base/icon-pengumuman.svg')"
          :routeName="'home'"
          :routeQuery="'home'"
          :variant="'parent'"
        /> --}}
        <x-menu.item
          :label="'Konfigurasi'"
          :haveIcon="true"
          :iconInactive="asset('assets/icons/admin/black-24.svg')"
          :iconActive="asset('assets/icons/admin/red-24.svg')"
          :routeName="''"
          :variant="'parent'"
          :routeChild="['users*', 'roles*', 'academics*']"
        >
          <x-menu.container 
            :variant="'submenu'"
            :routeChild="['users*', 'roles*', 'academics*']"
          >
            <x-menu.item 
              :label="'Manajemen Pengguna'"
              :routeName="'users.index'"
              :routeQuery="'users*'"
              :variant="'child'"
            />
            {{-- <x-menu.item 
              :label="'Manajemen Peran'"
              :routeName="'roles.index'"
              :routeQuery="'roles*'"
              :variant="'child'"
            /> --}}
            <x-menu.item 
              :label="'Akademik'"
              :routeName="'academics-periode.index'"
              :routeQuery="'academics*'"
              :variant="'child'"
            />
          </x-menu.container>
        </x-menu.item>
        <x-menu.item
          :label="'Kalender Akademik'"
          :haveIcon="true"
          :iconInactive="asset('assets/icons/admin/black-24.svg')"
          :iconActive="asset('assets/icons/admin/red-24.svg')"
          :routeName="'calendar.index'"
          :routeQuery="'calendar*'"
          :variant="'parent'"
        />
        <x-menu.item
          :label="'Kurikulum'"
          :haveIcon="true"
          :iconInactive="asset('assets/icons/curriculum/outline-black-24.svg')"
          :iconActive="asset('assets/icons/curriculum/outline-red-24.svg')"
          :routeName="'curriculum.list'"
          :routeQuery="'curriculums*'"
          :variant="'parent'"
        />
        <x-menu.item
          :label="'Persiapan Perkuliahan'"
          :haveIcon="true"
          :iconInactive="asset('assets/icons/admin/black-24.svg')"
          :iconActive="asset('assets/icons/admin/red-24.svg')"
          :routeName="''"
          :variant="'parent'"
          :routeChild="['lecture-preparation*']"
        >
          <x-menu.container 
            :variant="'submenu'"
            :routeChild="['lecture-preparation*']"
          >
            <x-menu.item
              :label="'Jadwal Kuliah'"
              :routeName="'academics.schedule.prodi-schedule.index'"
              :routeQuery="'lecture-preparation/schedule*'"
              :variant="'child'"
            />
            <x-menu.item
              :label="'Auto Assign Peserta Kelas'"
              :routeName="'academics.auto-assign.index'"
              :routeQuery="'lecture-preparation/auto-assign*'"
              :variant="'child'"
            />
            <x-menu.item
              :label="'Pemetaan CPL'"
              :routeName="'cpl-mapping.index'"
              :routeQuery="'lecture-preparation/cpl-mapping*'"
              :variant="'child'"
            />
          </x-menu.container>
        </x-menu.item>
        <x-menu.item
          :label="'Mata Kuliah'"
          :haveIcon="true"
          :iconInactive="asset('assets/icons/course/outline-black-24.svg')"
          :iconActive="asset('assets/icons/course/outline-red-24.svg')"
          :routeName="'study.index'"
          :routeQuery="'courses*'"
          :variant="'parent'"
        />
        {{-- <x-menu.item
          :label="'Manajemen Staf Pengajar'"
          :haveIcon="true"
          :icon="asset('assets/base/icon-prodi.svg')"
          :routeName="'lectures.index'"
          :routeQuery="'lectures*'"
          :variant="'parent'"
        /> --}}
        <x-menu.item
          :label="'Kelompok Perwalian'"
          :haveIcon="true"
          :iconInactive="asset('assets/icons/advisory/black-24.svg')"
          :iconActive="asset('assets/icons/advisory/red-24.svg')"
          :routeName="'tutelage-group.list-student'"
          :routeQuery="'tutelage-group*'"
          :variant="'parent'"
        />
        <x-menu.item
          :label="'RPS (Rencana Pembelajaran Semester)'"
          :haveIcon="true"
          :iconInactive="asset('assets/base/icon-kurikulum.svg')"
          :iconActive="asset('assets/base/icon-kurikulum.svg')"
          :routeName="'rps.index'"
          :routeQuery="'rps*'"
          :variant="'parent'"
        />
        {{-- <x-menu.item
          :label="'Penelitian'"
          :haveIcon="true"
          :icon="asset('assets/base/icon-masukan-komplain.svg')"
          :routeName="'home'"
          :routeQuery="'home'"
          :variant="'parent'"
        />
        <x-menu.item
          :label="'Pembayaran (Mahasiswa)'"
          :haveIcon="true"
          :icon="asset('assets/base/icon-pembayaran.svg')"
          :routeName="'home'"
          :routeQuery="'home'"
          :variant="'parent'"
        />
        <x-menu.item
          :label="'Laporan'"
          :haveIcon="true"
          :icon="asset('assets/base/icon-file.svg')"
          :routeName="'home'"
          :routeQuery="'home'"
          :variant="'parent'"
        />
        <x-menu.item
          :label="'Manajemen Survei'"
          :haveIcon="true"
          :icon="asset('assets/base/icon-ekuivalensi.svg')"
          :routeName="'home'"
          :routeQuery="'home'"
          :variant="'parent'"
        />
        <x-menu.item
          :label="'Manajemen FAQ'"
          :haveIcon="true"
          :icon="asset('assets/base/icon-pesan.svg')"
          :routeName="'home'"
          :routeQuery="'home'"
          :variant="'parent'"
        />
        <x-menu.item
          :label="'Petunjuk Penggunaan'"
          :haveIcon="true"
          :icon="asset('assets/base/icon-document-book.svg')"
          :routeName="'home'"
          :routeQuery="'home'"
          :variant="'parent'"
        />
        <x-menu.item
          :label="'Ganti Password'"
          :haveIcon="true"
          :icon="asset('assets/base/icon-lock.svg')"
          :routeName="'home'"
          :routeQuery="'home'"
          :variant="'parent'"
        /> --}}
      </x-menu.container>
    </x-container>
    <x-container.container :variant="'flat'" class="row-span-1 text-gray-800">
      <x-container.wrapper :rows="2">
        <x-container.container :variant="'flat'" class="row-span-1">
          <x-typography :variant="'caption-regular'">Copyright © 2025 Universitas Pertamina.</x-typography>
        </x-container>
        <x-container.container :variant="'flat'" class="row-span-1">
          <x-typography :variant="'caption-regular'">All Rights Reserved.</x-typography>
        </x-container>
      </x-wrapper>
    </x-container>

  </x-wrapper>
</x-container>
