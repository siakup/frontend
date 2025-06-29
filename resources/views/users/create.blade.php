@extends('layouts.main')

@section('title', 'Manajemen Pengguna')

@section('breadcrumbs')
    <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Manajemen Pengguna</a></div>
    <div class="breadcrumb-item active">Tambah Pengguna Baru</div>
@endsection

@section('css')
<style>
    .modal-custom {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-custom-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.25); 
        z-index: 1;
    }

    .modal-custom-content {
        position: relative;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.12);
        /* padding: 32px 32px 24px 32px; */
        width: 40vw; 
        min-width: 340px;
        max-width: 600px;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
    }

    .modal-custom-header {
        border-radius: 12px 12px 0px 0px;
        border: 1px solid var(--Surface-Border-Primary, #D9D9D9);
        background: var(--Background-Disable-White, #F5F5F5);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        /* gap: 10px; */
        align-self: stretch;
    }

    .modal-custom-footer {
        display: flex;
        justify-content: flex-start;
    }

    /* Custom dropdown style for modal select */
    .modal-custom-content select.form-control {
        width: 100%;
        padding: 10px 36px 10px 16px;
        border: 1px solid var(--Surface-Border-Secondary, #BFBFBF);
        border-radius: 8px;
        font-family: Poppins;
        font-size: 14px;
        font-weight: 400;
        color: var(--Surface-Border-Secondary, #BFBFBF); /* grey for placeholder */
        background: var(--Neutral-Gray-50, #FFF) url('/icons/icon-arrow-down-grey-24.svg') no-repeat right 16px center/18px 18px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        box-sizing: border-box;
        outline: none;
        transition: border 0.2s;
        height: 40px;
    }

    .modal-custom-content select.form-control:focus {
        border-color: var(--Red-Red-500, #E62129);
    }

    .modal-custom-content select.form-control option {
        color: #222;
    }

    .modal-custom-content select.form-control option[value=""] {
        color: var(--Surface-Border-Secondary, #BFBFBF) !important;
    }

    .modal-custom-content select.form-control option[disabled][hidden] {
        color: var(--Surface-Border-Secondary, #BFBFBF) !important;
    }

    .modal-custom-content select.form-control:not(:focus):not([value=""]):not(:invalid) {
        color: #222;
    }

    .modal-custom-content select.form-control:focus:not([value=""]):not(:invalid) {
        color: #222;
    }

    /* Highlight selected option in dropdown with red background */
    .modal-custom-content select.form-control option:checked {
        background: var(--Red-Red-500, #E62129) !important;
        color: #fff !important;
    }

    /* Highlight hovered option in dropdown with red background */
    .modal-custom-content select.form-control option:hover,
    .modal-custom-content select.form-control option:focus,
    .modal-custom-content select.form-control option:active {
        background: var(--Red-Red-500, #E62129) !important;
        color: #fff !important;
    }

    .dropdown-item{
        padding: 12px 16px;
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-family: Poppins;
        font-size: 14px;
        font-weight: 400;
        transition: background 0.15s;
    }
    .dropdown-item strong {
        margin-right: 8px;
        font-weight: 600;
    }
    .dropdown-item:hover {
        background: var(--Red-Red-500, #E62129);
        color: #fff;
    }
    .dropdown-item:hover strong {
        color: #fff;
    }

    @media (max-width: 900px) {
        .modal-custom-content {
            width: 90vw;
            min-width: unset;
            max-width: 98vw;
            padding: 16px;
        }

        .modal-custom-title { font-size: 18px; }
    }
</style>
@endsection

@section('javascript')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('toggleButton');
    const toggleIcon = document.getElementById('toggleIcon');
    const toggleInfo = document.querySelector('.toggle-info');
    let isActive = false;

    toggleButton.addEventListener('click', function (e) {
        e.preventDefault();
        isActive = !isActive;
        if (isActive) {
            toggleIcon.src = "{{ asset('components/toggle-on-disabled-false.svg') }}";
            toggleInfo.textContent = "Aktif";
            statusValue.value = "true";
        } else {
            toggleIcon.src = "{{ asset('components/toggle-off-disabled-true.svg') }}";
            toggleInfo.textContent = "Tidak Aktif";
            statusValue.value = "false";
        }
    });

    const modal = document.getElementById('modalTambahPeran');
    const btnShowModal = document.getElementById('btnShowModal');
    const btnBatalModal = document.getElementById('btnBatalModal');
    // Show modal
    btnShowModal.addEventListener('click', function() {
        modal.style.display = 'flex'; // Use flex to keep centering
    });
    // Hide modal
    btnBatalModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    // Hide modal when click outside modal-custom-content only
    modal.addEventListener('mousedown', function(e) {
        // Only close if click is on the backdrop, not on modal-custom-content or its children
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    document.querySelectorAll('.modal-custom-content select.form-control').forEach(function(select) {
        function updateColor() {
            if (select.value === "") {
                select.style.color = 'var(--Surface-Border-Secondary, #BFBFBF)';
            } else {
                select.style.color = '#222';
            }
        }
        select.addEventListener('change', updateColor);
        updateColor();
    });

    // Enable/disable Tambah button based on select values
    const roleSelect = document.getElementById('roleSelect');
    const institusiSelect = document.getElementById('institusiSelect');
    const btnTambahModal = document.getElementById('btnTambahModal');

    function updateTambahButtonState() {
        if (roleSelect.value && institusiSelect.value) {
            btnTambahModal.disabled = false;
            btnTambahModal.classList.remove('button-radius');
            btnTambahModal.classList.add('button-outline');
        } else {
            btnTambahModal.disabled = true;
            btnTambahModal.classList.remove('button-outline');
            btnTambahModal.classList.add('button-radius');
        }
    }
    roleSelect.addEventListener('change', updateTambahButtonState);
    institusiSelect.addEventListener('change', updateTambahButtonState);
    updateTambahButtonState();

    // Chained dropdown for institusi by role
    roleSelect.addEventListener('change', function() {
        const roleId = this.value;
        institusiSelect.innerHTML = '<option value="" selected disabled hidden>Pilih Institusi</option>';
        institusiSelect.disabled = true;
        if (roleId) {
            fetch(`/institutions/by-role?role=${roleId}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.data && data.data.length > 0) {
                        data.data.forEach(function(inst) {
                            const opt = document.createElement('option');
                            opt.value = inst.id;
                            opt.textContent = inst.nama;
                            institusiSelect.appendChild(opt);
                        });
                        institusiSelect.disabled = false;
                    } else {
                        institusiSelect.disabled = true;
                    }
                })
                .catch(() => {
                    institusiSelect.disabled = true;
                });
        }
    });

    const nipInput = document.getElementById('nip');
    const nipDropdown = document.getElementById('nip-dropdown');
    const namaInput = document.getElementById('nama_lengkap');
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    let nipTimeout = null;

    nipInput.addEventListener('input', function() {
        const val = this.value.trim();
        if (nipTimeout) clearTimeout(nipTimeout);
        if (val.length < 3) {
            nipDropdown.style.display = 'none';
            return;
        }
        nipTimeout = setTimeout(() => {
            fetch(`/users/search-by-nip?search=${encodeURIComponent(val)}`)
                .then(res => res.json())
                .then(data => {
                    if (data && data.data && data.data.length > 0) {
                        nipDropdown.innerHTML = data.data.map(item =>
                            `<div class="dropdown-item text-center" data-nip="${item.nomor_induk}" data-nama="${item.nama}" data-email="${item.email}">
                                <strong>${item.nomor_induk}</strong> - ${item.nama}
                            </div>`
                        ).join('');
                        nipDropdown.style.display = 'block';
                    } else {
                        nipDropdown.innerHTML = '<div style="padding:8px 16px; color:#888;">Tidak ditemukan</div>';
                        nipDropdown.style.display = 'block';
                    }
                })
                .catch(() => {
                    nipDropdown.innerHTML = '<div style="padding:8px 16px; color:#888;">Gagal mencari</div>';
                    nipDropdown.style.display = 'block';
                });
        }, 300);
    });

    nipDropdown.addEventListener('mousedown', function(e) {
        if (e.target.classList.contains('dropdown-item')) {
            nipInput.value = e.target.getAttribute('data-nip');
            namaInput.value = e.target.getAttribute('data-nama');
            emailInput.value = e.target.getAttribute('data-email');
            nipDropdown.style.display = 'none';
            // Call backend to generate username
            fetch(`/users/generate-username?name=${encodeURIComponent(e.target.getAttribute('data-nama'))}`)
                .then(res => res.json())
                .then(data => {
                    if (data && data.data) {
                        usernameInput.value = data.data;
                    } else {
                        usernameInput.value = '';
                    }
                    updateTambahPeranButtonState(); 
                })
                .catch(() => {
                    usernameInput.value = '';
                    updateTambahPeranButtonState(); 
                });
        }
    });

    document.addEventListener('click', function(e) {
        if (!nipDropdown.contains(e.target) && e.target !== nipInput) {
            nipDropdown.style.display = 'none';
        }
    });

    function updateTambahPeranButtonState() {
        const allFilled =
            nipInput.value.trim() &&
            namaInput.value.trim() &&
            usernameInput.value.trim() &&
            emailInput.value.trim();
        if (allFilled) {
            btnShowModal.disabled = false;
            btnShowModal.classList.remove('button-radius');
            btnShowModal.classList.add('button-outline');
            // Auto activate toggle if not already active
            if (!isActive) {
                isActive = true;
                toggleIcon.src = "{{ asset('components/toggle-on-disabled-false.svg') }}";
                toggleInfo.textContent = "Aktif";
                statusValue.value = "true";
            }
        } else {
            btnShowModal.disabled = true;
            btnShowModal.classList.remove('button-outline');
            btnShowModal.classList.add('button-radius');
            // Optionally, auto deactivate toggle if you want
            isActive = false;
            toggleIcon.src = "{{ asset('components/toggle-off-disabled-true.svg') }}";
            toggleInfo.textContent = "Tidak Aktif";
            statusValue.value = "false";
        }
    }
    nipInput.addEventListener('input', updateTambahPeranButtonState);
    namaInput.addEventListener('input', updateTambahPeranButtonState);
    usernameInput.addEventListener('input', updateTambahPeranButtonState);
    emailInput.addEventListener('input', updateTambahPeranButtonState);
    updateTambahPeranButtonState();

    // btnTambahModal.addEventListener('click', function() {
    //     if (!btnTambahModal.disabled) {
    //         window.location.href = "{{ route('users.edit', ['username' => 'lmawati']) }}";
    //     }
    // });

    // Add role and institusi to Daftar Peran table when Tambah clicked
    btnTambahModal.addEventListener('click', function() {
        if (btnTambahModal.disabled) return;
        const roleId = roleSelect.value;
        const roleText = roleSelect.options[roleSelect.selectedIndex].textContent;
        const institusiId = institusiSelect.value;
        const institusiText = institusiSelect.options[institusiSelect.selectedIndex].textContent;
        if (!roleId || !institusiId || institusiId === 'undefined') {
            alert('Pilih peran dan institusi yang valid.');
            return;
        }
        const now = new Date();
        const createdAt = now.toLocaleString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
        const tbody = document.querySelector('.table tbody');
        // Remove empty rows if present
        tbody.querySelectorAll('tr').forEach(tr => {
            if ([...tr.children].every(td => td.textContent.trim() === '')) tr.remove();
        });
        // Insert new row with data attributes for IDs
        const tr = document.createElement('tr');
        tr.setAttribute('data-role-id', roleId);
        tr.setAttribute('data-institusi-id', institusiId);
        tr.innerHTML = `<td>${roleText}</td>
                        <td>${institusiText}</td>
                        <td>${createdAt}</td>
                        <td style="display: flex; justify-content: center; align-items: center;">
                                <button class=" btnHapusPeran btn-icon btn-hapus" title="Hapus">
                                    <img src="{{ asset('icons/active/icon-delete.svg') }}" alt="Delete">
                                    <span>Hapus</span>
                                </button>
                        </td>`;
        tbody.appendChild(tr);
        
        modal.style.display = 'none';
        
        roleSelect.value = '';
        institusiSelect.innerHTML = '<option value="" selected disabled hidden>Pilih Institusi</option>';
        institusiSelect.disabled = true;
        updateTambahButtonState();
    });
    
    document.querySelector('.table tbody').addEventListener('click', function(e) {
        if (e.target.classList.contains('btnHapusPeran')) {
            e.target.closest('tr').remove();
            // If table is empty, add back empty rows
            const tbody = this;
            if (tbody.querySelectorAll('tr').length === 0) {
                tbody.innerHTML = `<tr><td></td><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td><td></td></tr>`;
            }
        }
    });

    function updateDaftarPeranActionsVisibility() {
        const tbody = document.querySelector('.table tbody');
        const actions = document.getElementById('daftarPeranActions');
        // Show if there is at least one non-empty row
        const hasData = Array.from(tbody.querySelectorAll('tr')).some(tr =>
            Array.from(tr.children).some(td => td.textContent.trim() !== '')
        );
        actions.style.display = hasData ? 'flex' : 'none';
    }
    // Call after adding/removing peran
    const origAddPeran = btnTambahModal.onclick;
    btnTambahModal.addEventListener('click', function() {
        setTimeout(updateDaftarPeranActionsVisibility, 10);
    });
    document.querySelector('.table tbody').addEventListener('click', function(e) {
        if (e.target.classList.contains('btnHapusPeran')) {
            setTimeout(updateDaftarPeranActionsVisibility, 10);
        }
    });

    document.getElementById('btnBatalDaftarPeran').addEventListener('click', function() {
        window.location.href = "{{ route('users.index') }}";
    });
    
    document.getElementById('btnSimpanDaftarPeran').addEventListener('click', function() {
        document.getElementById('modalKonfirmasiSimpan').style.display = 'flex';
    });

    document.getElementById('btnCekKembali').addEventListener('click', function() {
        document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
    });

    document.getElementById('btnYaSimpan').addEventListener('click', function() {
        document.getElementById('modalKonfirmasiSimpan').style.display = 'none';

        // Collect form data
        const nip = document.getElementById('nip').value.trim();
        const nama_lengkap = document.getElementById('nama_lengkap').value.trim();
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();
        const status = document.getElementById('statusValue').value;

        // Collect Daftar Peran table data
        const peran = [];
        document.querySelectorAll('.table tbody tr').forEach(tr => {
            const tds = tr.querySelectorAll('td');
            if (tds.length >= 4 && tds[0].textContent.trim() && tds[1].textContent.trim()) {
                peran.push({
                    role_id: tr.getAttribute('data-role-id'),
                    institusi_id: tr.getAttribute('data-institusi-id'),
                    role: tds[0].textContent.trim(),
                    institusi: tds[1].textContent.trim(),
                    created_at: tds[2].textContent.trim()
                });
            }
        });

        const data = {
            nip,
            nama_lengkap,
            username,
            email,
            status,
            peran
        };

        $.ajax({
            url: "{{ route('users.store') }}",
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('AJAX Response:', response);
                localStorage.setItem('flash_type', response.success ? 'success' : 'error');
                localStorage.setItem('flash_message', response.message || 'Pengguna berhasil dibuat');
                window.location.href = response.redirect_uri;
            },
            error: function(xhr, status, error) {
                let errorMessage = 'Gagal menyimpan data. Silakan coba lagi.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                errorToast(errorMessage);
                console.error('AJAX Error:', error);
            }
        });
    });
});
</script>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-title-text">Pengguna Baru</div>
    </div>
    
    <a href="{{ route('users.index') }}" class="button-no-outline-left">
        <img src="{{ asset('icons/active/icon-arrow-left.svg') }}" alt="Kembali"> Manajemen Pengguna
    </a>
    <div class="content-card">
        <div class="form-title-text">Pengguna Baru</div>
        <div class="form-section">
            <div class="form-group">
                <label for="nip">NIP</label>
                <div class="input-by-search" style="position: relative;">
                    <input type="text" id="nip" class="form-control" placeholder="Pilih NIP dari daftar Staf/Pengajar" autocomplete="off">
                    <img src="{{ asset('icons/search-left.svg') }}" alt="search" class="input-search-icon">
                    <div id="nip-dropdown" class="dropdown-menu" style="display:none; position:absolute; left:0; right:0; top:100%; z-index:10; background:#fff; border:1px solid #ddd; border-radius:0 0 8px 8px; max-height:220px; overflow-y:auto;"></div>
                </div>
                <div id="nip-error" class="form-error-message" style="display:none;">error</div>
            </div>

            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" class="form-control" placeholder="Auto Generate" readonly>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" class="form-control" placeholder="Auto Generate" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" class="form-control" placeholder="Auto Generate" readonly>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <div class="toggle-row"></div>
                    <button id="toggleButton" class="btn-toggle">
                        <img src="{{ asset('components/toggle-off-disabled-true.svg') }}" alt="Toggle Icon" id="toggleIcon">
                        <span class="toggle-info text-sm-bd">Tidak Aktif</span>
                    </button>
                    <input type="hidden" name="status" id="statusValue" value="false">
                </div>
            </div>
            <div class="right">
                <button class="button button-radius" style="margin-top: 16px;" id="btnShowModal" disabled>Tambah Peran</button>
            </div>
        </div>
    </div>
    <div class="content-card">
        <div class="form-title-text">Daftar Peran</div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Peran</th>
                        <th>Institusi</th>
                        <th>Dibuat Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="daftar-peran-actions" id="daftarPeranActions" style="display:none; flex; gap: 12px; margin-top: 18px; justify-content: flex-end;">
            <button type="button" class="button button-clean" id="btnBatalDaftarPeran">Batal</button>
            <button type="button" class="button button-outline" id="btnSimpanDaftarPeran">Simpan</button>
        </div>
    </div>

    <div id="modalTambahPeran" class="modal-custom" style="display:none;">
        <div class="modal-custom-backdrop"></div>
        <div class="modal-custom-content">
            <div class="modal-custom-header">
                <span class="text-lg-bd">Tambah Peran Pengguna</span>
            </div>
            <div class="modal-custom-body">
                <div class="form-group">
                    <label for="roleSelect">Nama Peran</label>
                    <select id="roleSelect" class="form-control">
                        <option value="" selected disabled hidden>Pilih Peran</option>
                        @foreach($roles->data as $role)
                            <option value="{{ $role->id }}">{{ $role->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="institusiSelect">Nama Institusi</label>
                    <select id="institusiSelect" class="form-control" disabled>
                        <option value="" selected disabled hidden>Pilih Institusi</option>
                    </select>
                </div>
            </div>
            <div class="divider"></div>
            <div class="modal-custom-footer">
                <button type="button" class="button button-clean" id="btnBatalModal">Batal</button>
                <button type="button" class="button button-radius" id="btnTambahModal" disabled>Tambah</button>
            </div>
        </div>
    </div>

    <div id="modalKonfirmasiSimpan" class="modal-custom" style="display:none;">
        <div class="modal-custom-backdrop"></div>
        <div class="modal-custom-content">
            <div class="modal-custom-header">
                <span class="text-lg-bd">Tunggu Sebentar</span>
            </div>
            <div class="modal-custom-body">
                <div>Apakah anda yakin informasi anda sudah benar?</div>
            </div>
            <div class="modal-custom-footer">
                <button type="button" class="button button-clean" id="btnCekKembali">Cek Kembali</button>
                <button type="button" class="button button-outline" id="btnYaSimpan">Ya, Simpan Sekarang</button>
            </div>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection