@extends('layouts.main')

@section('title', 'Manajemen Pengguna')

@section('css')

@endsection

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('searchInput');
            const dropdown = document.getElementById('searchDropdown');

            // Create loading indicator
            const loadingIndicator = document.createElement('div');
            loadingIndicator.className = 'dropdown-item text-center';
            loadingIndicator.innerHTML = 'Sedang mencari...';

            input.addEventListener('input', function() {
                const keyword = this.value.trim();
                if (keyword.length < 1) {
                    dropdown.style.display = 'none';
                    return;
                }
                dropdown.innerHTML = '';
                dropdown.appendChild(loadingIndicator);
                dropdown.style.display = 'block';
                $.ajax({
                    url: `{{ route('users.index') }}`,
                    method: 'GET',
                    data: {
                        search: keyword
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (!data.success || !Array.isArray(data.data) || data.data.length ===
                            0) {
                            dropdown.innerHTML =
                                '<div class="dropdown-item text-center">Tidak ada hasil ditemukan</div>';
                            return;
                        }
                        dropdown.innerHTML = '';
                        data.data.forEach(user => {
                            const item = document.createElement('div');
                            item.className = 'dropdown-item';
                            item.textContent = user.username;
                            item.onclick = () => {
                                dropdown.querySelectorAll('.dropdown-item').forEach(
                                    i => i.classList.remove('active'));
                                item.classList.add('active');
                                input.value = user.username;
                                dropdown.style.display = 'none';
                                refreshTable(user.username);
                            };
                            dropdown.appendChild(item);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        dropdown.innerHTML =
                            '<div class="dropdown-item text-center text-danger">Terjadi kesalahan, silakan coba lagi</div>';
                    }
                });
            });

            function refreshTable(username) {
                $.ajax({
                    url: '{{ route('users.index') }}',
                    method: 'GET',
                    data: {
                        search: username
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        window.location.href = '{{ route('users.index') }}' + '?search=' +
                            encodeURIComponent(username);
                    },
                    error: function() {
                        $('tbody').html(
                            '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
                        );
                    }
                });
            }

            document.querySelectorAll('#sortDropdown .dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    sortDropdown.querySelectorAll('.dropdown-item').forEach(i => i.classList.remove(
                        'active'));
                    const sortKey = this.getAttribute('data-sort');
                    this.classList.add('active');
                    sortDropdown.style.display = 'none';
                    sortTable(sortKey); // Panggil AJAX sortTable
                });
            });

            function sortTable(value) {
                $.ajax({
                    url: '{{ route('users.index') }}',
                    method: 'GET',
                    data: {
                        sort: value
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        window.location.href = '{{ route('users.index') }}' + '?sort=' +
                            encodeURIComponent(value);
                    },
                    error: function() {
                        $('tbody').html(
                            '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
                        );
                    }
                });
            }

            // Close dropdown if click outside
            document.addEventListener('click', function(e) {
                if (!dropdown.contains(e.target) && !input.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });

            // sort dropdown
            const sortBtn = document.getElementById('sortButton');
            const sortDropdown = document.getElementById('sortDropdown');

            // Toggle dropdown on button click
            sortBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                sortDropdown.style.display = (sortDropdown.style.display === 'block') ? 'none' : 'block';
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!sortDropdown.contains(e.target) && e.target !== sortBtn) {
                    sortDropdown.style.display = 'none';
                }
            });

            // Optional: Add sorting functionality
            document.querySelectorAll('#sortDropdown .dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    sortDropdown.querySelectorAll('.dropdown-item').forEach(i => i.classList.remove(
                        'active'));
                    const sortKey = this.getAttribute('data-sort');
                    console.log('Sort by:', sortKey); // Replace with your logic
                    this.classList.add('active');
                    sortDropdown.style.display = 'none';
                });
            });

            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-view-user');
                if (btn) {
                    const nomorInduk = btn.getAttribute('data-nomor-induk');
                    if (nomorInduk) {
                        $.get("{{ route('users.detail') }}", {
                            nomor_induk: nomorInduk
                        }, function(html) {
                            $('#userDetailModalContainer').html(html);
                            $('#modalDetailPengguna').show();
                        });
                    }
                }
            });

            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-reset-pass');
                if (btn) {
                    e.preventDefault();
                    const nomorInduk = btn.getAttribute('data-nomor-induk');
                    if (nomorInduk) {
                        $.get("{{ route('users.resetPassword') }}", {
                            nomor_induk: nomorInduk
                        }, function(html) {
                            $('#userDetailModalContainer').html(html);
                            $('#modalResetPassword').show();
                        });
                    }
                }
            });

            function showSuccessModal(message) {
                document.getElementById('successModalMessage').textContent = message;
                document.getElementById('successModal').style.display = 'block';
            }

            function closeSuccessModal() {
                document.getElementById('successModal').style.display = 'none';
            }

            @if (request('success'))
                showSuccessModal(@json(request('success')));
                window.history.replaceState(null, '', window.location.pathname);
            @endif
        });
    </script>
@endsection
@section('content')
    <div class="page-header">
        <div class="page-title-text">Manajemen Pengguna</div>
    </div>

    <div class="right">
        <a href="{{ route('users.create') }}" class="button button-outline">Tambah Pengguna Baru</a>
    </div>
    <div class="content-card content-card-search">
        <div class="card-header">
            <div class="search-section">
                <div class="search-container">
                    <input type="text" placeholder="Username / Nama / Status" class="search-filter" id="searchInput"
                        autocomplete="off" value="{{ $search }}">
                    <img src="{{ asset('assets/search-left.svg') }}" alt="search" class="search-icon-right">
                    <div class="search-dropdown" id="searchDropdown"></div>
                </div>
            </div>
            <div class="filter-box">
                <button class="button-clean" id="sortButton">
                    Urutkan
                    <img src="{{ asset('assets/icon-filter.svg') }}" alt="Filter">
                </button>
                <div id="sortDropdown" class="sort-dropdown" style="display: none;">
                    <div class="dropdown-item" data-sort="active">Aktif</div>
                    <div class="dropdown-item" data-sort="inactive">Tidak Aktif</div>
                    <div class="dropdown-item" data-sort="nama,asc">A-Z</div>
                    <div class="dropdown-item" data-sort="nama,desc">Z-A</div>
                    <div class="dropdown-item" data-sort="created_at,desc">Terbaru</div>
                    <div class="dropdown-item" data-sort="created_at,asc">Terlama</div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="content-card"> -->
    <div class="table-responsive">
        <table class="table" id="list-user" style="--table-cols:7">
            <thead>
                <tr>
                    <th>NIP/NIM</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Dibuat Pada</th>
                    <th>Status</th>
                    <th>Reset</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($response->data ?? [] as $user): ?>
                <tr>
                    <td>{{ $user->nomor_induk }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->username }}</td>
                    <td class="text-gray-12">{{ formatDateTime($user->created_at) }}</td>
                    <td>
                        @if ($user->status === 'active')
                            <span class="badge badge-active">Aktif</span>
                        @else
                            <span class="badge badge-inactive">Tidak Aktif</span>
                        @endif
                    </td>
                    <td>
                        <a href="#" class="link-blue btn-reset-pass"
                            data-nomor-induk="{{ $user->nomor_induk }}">Reset Password</a>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-icon btn-view-user" data-nomor-induk="{{ $user->nomor_induk }}"
                                title="View" type="button">
                                <img src="{{ asset('assets/button-view.svg') }}" alt="View">
                            </button>
                            <a class="btn-icon" title="Edit"
                                href="{{ route('users.edit', ['nomor_induk' => $user->nomor_induk]) }}">
                                <img src="{{ asset('assets/button-edit.svg') }}" alt="Edit">
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- </div> -->
    @if(isset($data['data']))
    @include('partials.pagination', [
        'currentPage' => $data['pagination']['current_page'],
        'lastPage' => $data['pagination']['last_page'],
        // "lastPage" => 10,
        'limit' => $limit,
        'routes' => route('users.index'),
    ])
    <div id="userDetailModalContainer"></div>

    @include('partials.success-modal')
    @endif;
@endsection
