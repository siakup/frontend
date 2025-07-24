<style>
    .modal-custom {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.25);
    }

    .modal-custom-backdrop {
        position: fixed;
        inset: 0;
        z-index: 1;
        display: none;
    }

    .modal-custom-body {
        padding: 20px 12px 12px 20px;
        width: 100%;
        box-sizing: border-box;
    }

    .modal-custom-content {
        position: relative;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.12);
        width: 45vw;
        min-width: 340px;
        /* max-width: 600px; */
        margin: 0 auto;
        margin-top: 10%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        align-self: stretch;
    }

    .modal-custom-header {
        border-radius: 12px 12px 0px 0px;
        border: 1px solid var(--Surface-Border-Primary, #D9D9D9);
        background: var(--Neutral-gray-50, #FFF);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        align-self: stretch;
    }

    .modal-close-btn {
        position: absolute;
        top: 16px;
        right: 20px;
        background: none;
        border: none;
        font-size: 2rem;
        color: #888;
        cursor: pointer;
        z-index: 10;
        transition: color 0.2s;
    }

    .modal-close-btn:hover {
        color: #e74c3c;
    }

    .modal-custom-header {
        position: relative;
    }

    .form-group {
        margin-bottom: 12px;
    }

    .form-group label {
        font-weight: 600;
        font-size: 14px;
        margin-right: 45px;
    }

    .form-group input[readonly],
    .form-group textarea[readonly] {
        background: var(--Background-Disable-White, #F5F5F5);
        color: var(--Neutral-Gray-600, #8C8C8C);
        cursor: not-allowed;
        opacity: 1;
    }

    .modal-divider {
        width: calc(100% + 32px);
        height: 1px;
        background: #E5E6E8;
        margin: 24px 0 18px 0;
        border: none;
        position: relative;
        left: -20px;
    }

    .checkbox-group {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        column-gap: 32px;
        justify-items: flex-start;
        padding-top: 12px;
        padding-bottom: 12px;

    }

    .checkbox-group .checkbox-form {
        display: flex;
        gap: 8px;
    }

    .checkbox-group .checkbox-form label {
        font-weight: 400;
        font-size: 14px;
        color: #8C8C8C;
        width: max-content;
    }

    .toggle-info {
        font-weight: 600;
        font-size: 14px;
        color: #8C8C8C;
    }
</style>

<div id="modalPeriodeAkademik" class="modal-custom" style="display:block;">
    <div class="modal-custom-backdrop"></div>
    <div class="modal-custom-content">
        <div class="modal-custom-header">
            <span class="text-lg-bd">Lihat Periode Akademik</span>
            <button type="button" class="modal-close-btn"
                onclick="document.getElementById('modalPeriodeAkademik').style.display='none'">
                &times;
            </button>
        </div>
        <div class="modal-custom-body">
            <div class="expandable-section" id="section-detail">
                <div onclick="toggleSection('detail')">
                    <span class="text-md-bd">Periode Akademik</span>
                </div>
                <div class="expandable-content" id="content-detail" style="display:block;">
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="text" class="form-control" value="{{ $response->data->periode->tahun ?? '-' }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <div class="form-control checkbox-group">
                            <div class="checkbox-form">
                                <input type="checkbox" class="form-control" value="Ganjil" disabled
                                    {{ $data->semester == 1 ? 'checked' : '' }}>
                                <label>Ganjil</label>
                            </div>
                            <div class="checkbox-form">
                                <input type="checkbox" class="form-control" value="Pendek" disabled
                                    {{ $data->semester == 3 ? 'checked' : '' }}>
                                <label>Pendek</label>
                            </div>
                            <div class="checkbox-form">
                                <input type="checkbox" class="form-control" value="Genap" disabled
                                    {{ $data->semester == 2 ? 'checked' : '' }}>
                                <label>Genap</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tahun Akademik</label>
                        <input type="text" class="form-control"
                            value="{{ $data->tahun ?? '-' }}/{{ ($data->tahun ?? 0) + 1 }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai / Tanggal Berakhir</label>
                        <input type="text" class="form-control"
                            value="{{ \Carbon\Carbon::parse($data->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($data->tanggal_akhir)->format('d M Y') }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" class="form-control" value="{{ $data->deskripsi ?? '-' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="toggle-row"></div>
                        <button id="toggleButton" class="btn-toggle" disabled>
                            @if ($data->status == 'active')
                                <img src="{{ asset('components/toggle-on-disabled-true.svg') }}" alt="Toggle Icon"
                                    id="toggleIcon">
                                <span class="toggle-info text-sm-bd">Aktif</span>
                            @else
                                <img src="{{ asset('components/toggle-off-disabled-true.svg') }}" alt="Toggle Icon"
                                    id="toggleIcon">
                                <span class="toggle-info text-sm-bd">Tidak Aktif</span>
                            @endif
                        </button>
                        <input type="hidden" name="status" id="statusValue"
                            value="{{ $data->status == 'active' ? 'true' : 'false' }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
