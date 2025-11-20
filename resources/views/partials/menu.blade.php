<div class="fixed left-0 top-0 w-80 h-[100vh] bg-white z-1000 flex flex-col">
    <div class="shrink-0 py-5 px-2.5">
        <img src="{{ asset('images/uper.png') }}" alt="Logo" class=" w-[180px] h-auto block my-0 mx-auto">
        <div class="flex items-center justify-center gap-1 mb-1 w-[156px] mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="5" viewBox="0 0 40 5" fill="none">
                <path d="M0.5 2.5H39.5" stroke="#0076BE" stroke-width="8" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="5" viewBox="0 0 56 5" fill="none">
                <path d="M0.5 2.5H55.5" stroke="#E62129" stroke-width="8" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="5" viewBox="0 0 60 5" fill="none">
                <path d="M0.5 2.5H59.5" stroke="#98A725" stroke-width="8" />
            </svg>
        </div>
        <div class="flex items-center justify-center gap-1 mb-1 w-[156px] mx-auto text-center text-xs leading-5">
            <span class="text-[#0076BE]">Sistem</span>
            <span class="text-[#E62129]">Informasi</span>
            <span class="text-[#98A725]">Akademik</span>
        </div>
    </div>
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
