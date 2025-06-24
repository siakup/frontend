@extends('layouts.main')

@section('title', 'Manajemen Pengguna')

@section('breadcrumbs')
    <div class="breadcrumb-item"><a href="{{ url('/users/') }}">Manajemen Pengguna</a></div>
    <div class="breadcrumb-item active">Edit Informasi</div>
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

    /* .modal-custom-title {
        font-size: 24px;
        font-weight: 700;
        color: #222;
        display: block;
        text-align: center;
        width: 100%;
    } */

    /* .modal-custom-body {
        margin-bottom: 24px;
    } */

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
    .modal-custom-content select.form-control option:hover {
        background: var(--Red-Red-500, #E62129) !important;
        color: #fff !important;
    }

    input.form-control[readonly] {
        background: var(--Neutral-Gray-200, #F5F5F5);
        color: var(--Neutral-Gray-600, #8C8C8C);
        border-color: var(--Neutral-Gray-300, #E8E8E8);
        cursor: not-allowed;
        opacity: 1;
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
    let isActive = {{ $response->data->status ?? 'false' }} === 'true';

    // Set initial state based on server value
    toggleIcon.src = isActive ? "{{ asset('components/toggle-on-disabled-false.svg') }}" : "{{ asset('components/toggle-off-disabled-true.svg') }}";
    toggleInfo.textContent = isActive ? "Aktif" : "Tidak Aktif";
    document.getElementById('statusValue').value = isActive ? "true" : "false";

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
    if (btnShowModal && modal) {
        btnShowModal.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default action if inside a form
            modal.style.display = 'flex'; // Show modal
        });
    }

    const btnBatalModal = document.getElementById('btnBatalModal');
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
});
</script>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-title-text">Edit Informasi</div>
    </div>
    
    <a href="{{ route('users.index') }}" class="button-no-outline-left">
        <img src="{{ asset('icons/active/icon-arrow-left.svg') }}" alt="Kembali"> Manajemen Pengguna
    </a>
    <div class="content-card">
        <div class="form-title-text">Edit Informasi Data Pengguna</div>
        <div class="form-section">
            <div class="form-group">
                <label for="nip">NIP</label>
                <div class="input-by-search">
                    <input type="text" id="nip" class="form-control" value="{{ $response->data->nomor_induk ?? '' }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" class="form-control" value="{{ $response->data->nama ?? '' }}"readonly>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" class="form-control" value="{{ $response->data->username ?? '' }}" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" class="form-control" value="{{ 'email@universitaspertamina.ac.id' }}" readonly>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <div class="toggle-row"></div>
                    <button id="toggleButton" class="btn-toggle">
                        <img src="{{ asset(($response->data->status ?? false) ? 'components/toggle-on-disabled-false.svg' : 'components/toggle-off-disabled-true.svg') }}" alt="Toggle Icon" id="toggleIcon">
                        <span class="toggle-info text-sm-bd">{{ ($response->data->status ?? false) ? 'Aktif' : 'Tidak Aktif' }}</span>
                    </button>
                    <input type="hidden" name="status" id="statusValue" value="{{ ($response->data->status ?? false) ? 'true' : 'false' }}">
                </div>
            </div>
            <div class="right">
                <button type="button" class="button button-outline" style="margin-top: 16px;" id="btnShowModal">Tambah Peran</button>
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
                        <td>Admin Sistem</td>
                        <td>Universitas Pertamina</td>
                        <td>Jigeum</td>
                        <td>fddfdf</td>
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
        <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 24px;">
            <button type="button" class="button button-clean">Batal</button>
            <button type="button" class="button button-outline">Simpan</button>
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
                        <option value="admin">Admin Sistem</option>
                        <option value="admin-fakultas">Admin Fakultas</option>
                        <option value="admin-prodi">Admin Program Studi</option>
                        <option value="admin-dirdik">Admin Direktorat Pendidikan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="institusiSelect">Nama Institusi</label>
                    <select id="institusiSelect" class="form-control">
                        <option value="" selected disabled hidden>Pilih Institusi</option>
                        <option value="universitas">Universitas Pertamina</option>
                        <option value="fsk">Fakultas Sains dan Ilmu Komputer</option>
                        <option value="kimia">Kimia</option>
                        <option value="ilkom">Ilmu Komputer</option>
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
@endsection
