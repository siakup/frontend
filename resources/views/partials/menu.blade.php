<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('images/uper.png') }}" alt="Logo" class="logo-image">
        <div class="logo-lines">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="5" viewBox="0 0 40 5" fill="none">
                <path d="M0.5 2.5H39.5" stroke="#0076BE" stroke-width="8"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="5" viewBox="0 0 56 5" fill="none">
                <path d="M0.5 2.5H55.5" stroke="#E62129" stroke-width="8"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="5" viewBox="0 0 60 5" fill="none">
                <path d="M0.5 2.5H59.5" stroke="#98A725" stroke-width="8"/>
            </svg>
        </div>
        <!-- <img src="{{ asset('images/siakad-.svg') }}" alt="Logo Text" class="logo-text"> -->
        <div class="logo-text-container">
            <span class="sistem">Sistem</span>
            <span class="informasi">Informasi</span>
            <span class="akademik">Akademik</span>
        </div>
    </div>
    <nav class="menu">
        <ul class="menu-list">
            <li class="menu-item">
                <a href="{{ route('home') }}" class="menu-link {{ Request::is('home') ? 'active' : '' }}">
                    <div class="menu-content">
                        <img src="{{ asset('assets/base/icon-home.svg') }}" 
                            alt="Home Icon" 
                            class="menu-icon">
                        <span>Beranda</span>
                    </div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home" class="menu-link">
                    <div class="menu-content">
                        <img src="{{ asset('assets/base/icon-profile.svg') }}" alt="Profile Icon" class="menu-icon">
                        <span>Profil</span>
                    </div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home" class="menu-link">
                    <div class="menu-content">
                        <img src="{{ asset('assets/base/icon-pesan.svg') }}" alt="Message Icon" class="menu-icon">
                        <span>Pesan</span>
                    </div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home" class="menu-link">
                    <div class="menu-content">
                        <img src="{{ asset('assets/base/icon-pengumuman.svg') }}" alt="News Icon" class="menu-icon">
                        <span>Pengumuman</span>
                    </div>
                </a>
            </li>
            <li class="menu-item has-submenu">
                <a href="/home" class="menu-link">
                    <div class="menu-content">
                        <img src="{{ asset('assets/base/icon-admin.svg') }}" alt="Settings Icon" class="menu-icon">
                        <span>Konfigurasi</span>
                    </div>
                    <img src="{{ asset('assets/base/icon-arrow-down.svg') }}" alt="Expand" class="arrow-icon">
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="{{ route('users.index') }}" class="{{ Request::is('users*') ? 'active' : '' }}">
                            <span>Manajemen Pengguna</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ route('roles.index') }}" class="{{ Request::is('roles*') ? 'active' : '' }}">
                            <span>Manajemen Peran</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ route('academics-periode.index') }}" class="{{ Request::is('academics*') ? 'active' : '' }}">
                            <span>Akademik</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="{{ route('calendar-academic.index') }}" class="menu-link {{ Request::is('calendar-academic*') ? 'active' : '' }}">
                    <div class="menu-content">
                        <img src="{{ asset('assets/base/icon-admin.svg') }}" 
                            alt="Kalender Akademik Icon" 
                            class="menu-icon">
                        <span>Kalender Akademik</span>
                    </div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('lectures.index') }}" class="menu-link {{ Request::is('lectures*') ? 'active' : '' }}">
                    <div class="menu-content">
                        <img src="{{ asset('assets/base/icon-prodi.svg') }}" alt="Staff Icon" class="menu-icon">
                        <span>Manajemen Staf Pengajar</span>
                    </div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home" class="menu-link">
                    <div class="menu-content">
                    <img src="{{ asset('assets/base/icon-masukan-komplain.svg') }}" alt="Research Icon" class="menu-icon">
                    <span>Penelitian</span>
                    </div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home" class="menu-link">
                    <div class="menu-content">
                        <img src="{{ asset('assets/base/icon-pembayaran.svg') }}" alt="Payment Icon" class="menu-icon">
                        <span>Pembayaran (Mahasiswa)</span>
                    </div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home" class="menu-link">
                    <div class="menu-content">
                        <img src="{{ asset('assets/base/icon-file.svg') }}" alt="Report Icon" class="menu-icon">
                        <span>Laporan</span>
                    </div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home" class="menu-link">
                    <div class="menu-content">
                        <img src="{{ asset('assets/base/icon-ekuivalensi.svg') }}" alt="Survey Icon" class="menu-icon">
                        <span>Manajemen Survei</span>
                    </div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home" class="menu-link">
                    <div class="menu-content">
                        <img src="{{ asset('assets/base/icon-pesan.svg') }}" alt="Faq Icon" class="menu-icon">
                        <span>Manajemen FAQ</span>
                    </div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home" class="menu-link">
                    <div class="menu-content">
                        <img src="{{ asset('assets/base/icon-document-book.svg') }}" alt="Guide Icon" class="menu-icon">
                        <span>Petunjuk Penggunaan</span>
                    </div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home" class="menu-link">
                    <div class="menu-content">
                        <img src="{{ asset('assets/base/icon-lock.svg') }}" alt="Password Icon" class="menu-icon">
                        <span>Ganti Password</span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <div class="footer">
            <span>Copyright © 2025 Universitas Pertamina.</span>
            <span>All Rights Reserved.</span>
        </div>
    </div>
</div>