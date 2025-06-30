<style>
    .modal-custom {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.25); 
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
        box-shadow: 0 4px 24px rgba(0,0,0,0.12);
        width: 40vw;
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

    .form-group input[readonly],
    .form-group textarea[readonly] {
        background: var(--Background-Disable-White, #F5F5F5);
        color: var(--Neutral-Gray-600, #8C8C8C);
        cursor: not-allowed;
        opacity: 1;
    }
    .expand-icon{
        float:right;
        transition:transform 0.2s;
        width:18px;
        height:18px;"
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
</style>

<div id="modalDetailPengguna" class="modal-custom" style="display:block;">
    <div class="modal-custom-backdrop"></div>
    <div class="modal-custom-content">
        <div class="modal-custom-header">
            <span class="text-lg-bd">Lihat Informasi Detail Pengguna</span>
            <button type="button" class="modal-close-btn" onclick="document.getElementById('modalDetailPengguna').style.display='none'">
                &times;
            </button>
        </div>
        <div class="modal-custom-body">
            <div class="expandable-section" id="section-detail">
                <div class="expandable-header" onclick="toggleSection('detail')">
                    <span class="text-md-bd">Informasi Detail Pengguna</span>
                    <img id="icon-detail" class="expand-icon" src="{{ asset('icons/icon-arrow-up-black-16.svg') }}"  />
                </div>
                <div class="expandable-content" id="content-detail" style="display:block;">
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" value="{{ $response->data->user->nomor_induk }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" value="{{ $response->data->user->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" value="{{ $response->data->user->username }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" value="{{ $response->data->user->email }}" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-divider"></div>
            <div class="expandable-section" id="section-role" style="margin-top:18px;">
                <div class="expandable-header" onclick="toggleSection('role')">
                    <span class="text-md-bd">Peran Pengguna</span>
                    <img id="icon-role" class="expand-icon" src="{{ asset('icons/icon-arrow-up-black-16.svg') }}"/>
                </div>
                <div class="expandable-content" id="content-role" style="display:block;">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align:left;padding:12px 16px;">Nama Peran</th>
                                    <th style="text-align:left;padding:12px 16px;">Nama Institusi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($response->data->roles as $role)
                                    <tr>
                                        <td>{{ $role->role->nama_role }}</td>
                                        <td>{{ $role->institusi->nama_institusi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSection(section) {
    const content = document.getElementById('content-' + section);
    const icon = document.getElementById('icon-' + section);
    if (content.style.display === 'none') {
        content.style.display = 'block';
        icon.src = "{{ asset('icons/icon-arrow-down-black-16.svg') }}";
    } else {
        content.style.display = 'none';
        icon.src = "{{ asset('icons/icon-arrow-down-black-16.svg') }}";
    }
}
</script>