    <div class="header h-[136px] flex justify-between items-center bg-white w-full overflow-hidden">
        <div class="flex flex-col justify-center items-center gap-2.5 bg-white w-[721px] p-5 pt-7.5">
            <div class="flex justify-between items-center w-full p-5">
                <div class="flex flex-col gap-1">
                    <div class="text-[#262626] text-2xl font-bold leading-8">Selamat Datang, {{ explode(' ', session('nama'))[0] }}!</div>
                    <div class="text-[#595959] text-sm leading-5.5"> {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</div>
                    <div class="text-[#595959] text-[10px] leading-3">{{ \Carbon\Carbon::now()->format('H:i') }} WIB</div>
                </div>
                <div class="ml-5">
                    <div class="relative flex items-center">
                        <img src="{{ asset('assets/search-left.svg') }}" alt="search" class="absolute left-3 w-5 h-5 pointer-events-none">
                        <input type="text" placeholder="Cari" class="py-2 pe-3 ps-10 border-[1px] border-[#D9D9D9] rounded-lg w-[250px] text-sm">
                    </div>
                </div>
            </div>
        </div>

        <div class="header-right">
        <div class="header-right-bg"></div>
        <div class="header-right-content">
            <div class="profile-container">
                <div class="profile-header">
                    <div class="name-section">
                        <img src="{{ asset('assets/women.svg') }}" alt="Profile" width="40">
                        <div class="text-black-16">{{ session('nama') }}</div>
                    </div>
                    <div class="profile-info">
                        <div class="text-gray-12">Periode Akademik 2024–2025</div>
                        <div class="text-gray-10">(Admin – Universitas Pertamina)</div>
                    </div>
                </div>
                <div class="profile-icons">
                    <img src="{{ asset('assets/bell.svg') }}" alt="Notifikasi" width="20">
                    <img src="{{ asset('assets/settings.svg') }}" alt="Pengaturan" width="20">
                </div>
            </div>
        </div>
    </div>
    </div>