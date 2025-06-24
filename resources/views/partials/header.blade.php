    <div class="header">
        <div class="header-left">
            <div class="header-left-content">
                <div class="info-section">
                    <div class="text-black-24">Selamat Datang, {{ explode(' ', session('nama'))[0] }}!</div>
                    <div class="text-gray-14"> {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</div>
                    <div class="text-gray-10">{{ \Carbon\Carbon::now()->format('H:i') }} WIB</div>
                </div>
                <div class="search-section">
                    <div class="search-container">
                        <img src="{{ asset('icons/search-left.svg') }}" alt="search" class="search-icon-left">
                        <input type="text" placeholder="Cari" class="search-input">
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
                        <img src="{{ asset('icons/women.svg') }}" alt="Profile" width="40">
                        <div class="text-black-16">{{ session('nama') }}</div>
                    </div>
                    <div class="profile-info">
                        <div class="text-gray-12">Periode Akademik 2024–2025</div>
                        <div class="text-gray-10">(Admin – Universitas Pertamina)</div>
                    </div>
                </div>
                <div class="profile-icons">
                    <img src="{{ asset('icons/bell.svg') }}" alt="Notifikasi" width="20">
                    <img src="{{ asset('icons/settings.svg') }}" alt="Pengaturan" width="20">
                </div>
            </div>
        </div>
    </div>
    </div>