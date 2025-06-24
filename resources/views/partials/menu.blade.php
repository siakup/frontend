<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="logo-image">
        <div class="logo-lines">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="5" viewBox="0 0 41 5" fill="none">
                <path d="M0.5 2.5H40.5" stroke="#0076BE" stroke-width="4"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="5" viewBox="0 0 55 5" fill="none">
                <path d="M0.5 2.5H54.5" stroke="#E62129" stroke-width="4"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="5" viewBox="0 0 60 5" fill="none">
                <path d="M0.5 2.5H59.5" stroke="#98A725" stroke-width="4"/>
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
                        <img src="{{ asset('icons/base/icon-home.svg') }}" 
                            alt="Home Icon" 
                            class="menu-icon">
                        <span>Beranda</span>
                    </div>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home">
                    <img src="{{ asset('icons/base/icon-profile.svg') }}" alt="Profile Icon" class="menu-icon">
                    <span>Profil</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home">
                    <img src="{{ asset('icons/base/icon-pesan.svg') }}" alt="Message Icon" class="menu-icon">
                    <span>Pesan</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home">
                    <img src="{{ asset('icons/base/icon-pengumuman.svg') }}" alt="News Icon" class="menu-icon">
                    <span>Pengumuman</span>
                </a>
            </li>
            <li class="menu-item has-submenu">
                <a href="/home" class="menu-link">
                    <div class="menu-content">
                        <img src="{{ asset('icons/base/icon-admin.svg') }}" alt="Settings Icon" class="menu-icon">
                        <span>Konfigurasi</span>
                    </div>
                    <img src="{{ asset('icons/base/icon-arrow-down.svg') }}" alt="Expand" class="arrow-icon">
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="{{ route('users.index') }}" class="{{ Request::is('users*') ? 'active' : '' }}">
                            <span>Manajemen Pengguna</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="/config/academic" class="{{ Request::is('config/academic') ? 'active' : '' }}">
                            <span>Manajemen Peran</span>
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="/config/users" class="{{ Request::is('config/users') ? 'active' : '' }}">
                            <span>Akademik</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="/home">
                    <img src="{{ asset('icons/base/icon-prodi.svg') }}" alt="Staff Icon" class="menu-icon">
                    <span>Manajemen Staf Pengajar</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home">
                    <img src="{{ asset('icons/base/icon-masukan-komplain.svg') }}" alt="Research Icon" class="menu-icon">
                    <span>Penelitian</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home">
                    <img src="{{ asset('icons/base/icon-pembayaran.svg') }}" alt="Payment Icon" class="menu-icon">
                    <span>Pembayaran (Mahasiswa)</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home">
                    <img src="{{ asset('icons/base/icon-file.svg') }}" alt="Report Icon" class="menu-icon">
                    <span>Laporan</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home">
                    <img src="{{ asset('icons/base/icon-ekuivalensi.svg') }}" alt="Survey Icon" class="menu-icon">
                    <span>Manajemen Survei</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home">
                    <img src="{{ asset('icons/base/icon-pesan.svg') }}" alt="Faq Icon" class="menu-icon">
                    <span>Manajemen FAQ</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home">
                    <img src="{{ asset('icons/base/icon-document-book.svg') }}" alt="Guide Icon" class="menu-icon">
                    <span>Petunjuk Penggunaan</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="/home">
                    <img src="{{ asset('icons/base/icon-lock.svg') }}" alt="Password Icon" class="menu-icon">
                    <span>Ganti Password</span>
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