@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('css')
<style>
    .form-section {
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    .form-group {
        display: grid;
        grid-template-columns: 180px 1fr;
        align-items: center;
        margin-bottom: 0;
    }

    .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 40px 32px; /* row-gap column-gap */
        width: 100%;
        margin: 0;
        padding: 0;
        align-items: center;
        box-sizing: border-box;
    }

    .checkbox-form {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .toggle-row,
    .btn-toggle {
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .button-group {
        display: flex;
        gap: 20px;
        justify-content: flex-end;
        margin: 20px;
    }

    .checkbox-form label {
        width: max-content;
        font-weight: 400;
    }

    .checkbox-form input {
        accent-color: #E62129;
        border-radius: 3px;
    }

    .button-group{
        display: flex;
        gap: 20px;
        justify-content: flex-end;
        margin: 20px;
    }

    .button{
        padding: 8px 54.5px;
        margin: 0px;"
    }

    .btn-toggle {
        display: flex;
        align-items: center;
        gap: 12px;
        background: none;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 0;
        width: auto; 
    }

    .modal-custom-footer {
        display: flex;
        justify-content: center;
        gap: 24px;
        width: 100%;
        padding: 0 20px 24px 20px;
        box-sizing: border-box;
    }

    .modal-custom-footer .button {
        min-width: 220px;
        padding: 14px 0;
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-title-text">Tambah Event Akademik</div>
    </div>
    
    <a href="{{ route('academics-event.index') }}" class="button-no-outline-left">
        <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Event Akademik
    </a>
    <div class="content-card">
        <div class="form-title-text" style="padding: 20px;">Tambah Event Akademik</div>
        <div class="form-section">
            <input type="hidden" id="user_id" value="">
            <div class="form-group">
                <label for="name">Nama Event</label>
                <div>
                    <input type="text" id="name" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
            <label>Flag</label>
            <div class="checkbox-group">
                @php
                    $flags = [
                        'nilai_on' => 'Nilai',
                        'irs_on' => 'IRS',
                        'lulus_on' => 'Lulus',
                        'registrasi_on' => 'Registrasi',
                        'yudisium_on' => 'Yudisium',
                        'survei_on' => 'Survei',
                        'dosen_on' => 'Dosen',
                    ];
                @endphp
                @foreach($flags as $value => $label)
                    <div class="checkbox-form">
                        <input type="checkbox" name="flag[]" value="{{ $value }}" class="form-check-input" id="flag_{{ $value }}">
                        <label for="flag_{{ $value }}" style="margin-left: 4px;">{{ $label }}</label>
                    </div>
                @endforeach
            </div>
            </div>
            <div class="form-group">
            <label>Status</label>
            <button id="toggleButton" class="btn-toggle">
                <img src="{{ asset('components/toggle-off-disabled-true.svg') }}" alt="Toggle Icon" id="toggleIcon">
                <span class="toggle-info text-sm-bd" style="color: var(--Neutral-Gray-600, #8C8C8C)">Tidak Aktif</span>
            </button>
            <input type="hidden" name="status" id="statusValue" value="false">
        </div>
        <div class="button-group">
            <button type="button" class="button button-clean" id="btnBatal">Batal</button>
            <button type="button" class="button button-outline" id="btnSimpan" disabled>Simpan</button>
        </div>
        </div>
        
        <div id="modalKonfirmasiSimpan" class="modal-custom" style="display:none;">
        <div class="modal-custom-backdrop"></div>
        <div class="modal-custom-content">
            <div class="modal-custom-header">
            <span class="text-lg-bd">Tunggu Sebentar</span>
            <img src="{{ asset('assets/base/icon-caution.svg')}}" alt="ikon peringatan">
            </div>
            <div class="modal-custom-body">
            <div>Apakah anda yakin informasi yang ditambah sudah benar?</div>
            </div>
            <div class="modal-custom-footer">
            <button type="button" class="button button-clean" id="btnCekKembali">Cek Kembali</button>
            <button type="submit" class="button button-outline" id="btnYaSimpan">Ya, Simpan Sekarang</button>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnToggle   = document.getElementById('toggleButton');
        const icon        = document.getElementById('toggleIcon');
        const text        = btnToggle.querySelector('.toggle-info');
        const hiddenInput = document.getElementById('statusValue');
        const namaEvent   = document.getElementById('name');
        const btnSave     = document.getElementById('btnSimpan');
        const btnConfirm  = document.getElementById('btnYaSimpan');
        const flagChecks  = document.querySelectorAll('input[name="flag[]"]');

        function updateSaveButtonState() {
            const eventFilled = namaEvent.value.trim() !== '';
            // const flagChecked = Array.from(flagChecks).some(chk => chk.checked);
            const statusFilled = hiddenInput.value === 'active' || hiddenInput.value === 'inactive';
            if (eventFilled && statusFilled) {
                btnSave.disabled = false;
            } else {
                btnSave.disabled = true;
            }
        }

        btnSave.addEventListener('click', function() {
            document.getElementById('modalKonfirmasiSimpan').style.display = 'block';
        });

        document.getElementById('btnBatal').addEventListener('click', function() {
            window.location.href = "{{ route('academics-event.index') }}";
        });

        document.getElementById('btnCekKembali').addEventListener('click', function() {
            document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
        });

        btnToggle.addEventListener('click', () => {
            const isActive = hiddenInput.value === 'active';
            hiddenInput.value = isActive ? 'inactive' : 'active';
            icon.src  = isActive
                ? "{{ asset('components/toggle-off-disabled-true.svg') }}"
                : "{{ asset('components/toggle-on-disabled-false.svg') }}";
            text.textContent = isActive ? 'Tidak Aktif' : 'Aktif';
            text.style.color = isActive ? '#8C8C8C' : '#262626'; 
            updateSaveButtonState();
        });
        namaEvent.addEventListener('input', updateSaveButtonState);
        flagChecks.forEach(chk => chk.addEventListener('change', updateSaveButtonState));
        updateSaveButtonState();

        document.getElementById('btnBatal').addEventListener('click', function() {
            window.location.href = "{{ route('academics-event.index') }}";
        });

        btnConfirm.addEventListener('click', function(e) {
            e.preventDefault();
            const nama = $('#name').val();
            const flags = [];
            $('input[name="flag[]"]:checked').each(function() {
                flags.push($(this).val());
            });
            const status = $('#statusValue').val(); 

            $.ajax({
                url: "{{ route('academics-event.store') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: nama,
                    flag: flags,
                    status: status
                },
                success: function(response) {
                    $('#modalKonfirmasiSimpan').hide();
                    successToast('Berhasil disimpan');
                    setTimeout(function() {
                        window.location.href = "{{ route('academics-event.index') }}";
                    }, 1200);
                },
                error: function(xhr) {
                    $('#modalKonfirmasiSimpan').hide();
                    let msg = 'Gagal menyimpan data';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    errorToast(msg);
                }
            });
        });
    });
</script>