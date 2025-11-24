<div
  x-bind:class="$store.mainLayout.isOpen ? 'col-span-3 col-start-1' : 'hidden'"
  class="w-full min-h-[calc(100vh-9rem)] h-full bg-white z-1000 flex flex-col border-r-[1px] border-r-[#d9d9d9]"
>
    <nav class="flex-1 overflow-y-auto h-[calc(100vh-169px-56px)] scroll-thin">
        <x-menu.container :variant="'main'">
          <x-menu.item
            :label="'Beranda'"
            :haveIcon="true"
            :icon="asset('assets/icons/home/black-24.svg')"
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
            :icon="asset('assets/icons/admin/black-24.svg')"
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
            :icon="asset('assets/icons/admin/black-24.svg')"
            :routeName="'calendar.index'"
            :routeQuery="'calendar*'"
            :variant="'parent'"
          />
          <x-menu.item
            :label="'Kurikulum'"
            :haveIcon="true"
            :icon="asset('assets/icons/curriculum/outline-black-24.svg')"
            :routeName="'curriculum.list'"
            :routeQuery="'curriculums*'"
            :variant="'parent'"
          />
          <x-menu.item
            :label="'Persiapan Perkuliahan'"
            :haveIcon="true"
            :icon="asset('assets/icons/admin/black-24.svg')"
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
            :icon="asset('assets/icons/course/outline-black-24.svg')"
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
            :icon="asset('assets/icons/advisory/black-24.svg')"
            :routeName="'tutelage-group.list-student'"
            :routeQuery="'tutelage-group*'"
            :variant="'parent'"
          />
          <x-menu.item
            :label="'RPS (Rencana Pembelajaran Semester)'"
            :haveIcon="true"
            :icon="asset('assets/icons/curriculum/outline-black-24.svg')"
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
    </nav>

    <div class="shrink-0">
        <div class="text-[#262626] text-xs leading-5 py-4 px-6">
            <span>Copyright © 2025 Universitas Pertamina.</span>
            <span>All Rights Reserved.</span>
        </div>
    </div>
</div>
