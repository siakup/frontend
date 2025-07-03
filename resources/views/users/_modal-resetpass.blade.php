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
        max-width: 600px;
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

    .modal-divider {
        width: calc(100% + 32px); 
        height: 1px;
        background: #E5E6E8;
        margin: 24px 0 18px 0;
        border: none;
        position: relative;
        left: -20px;
    }

    #btnBatalReset.button,
    #btnReset.button {
        flex: 1; 
        min-width: 0; 
    }
</style>

<div id="modalResetPassword" class="modal-custom" style="display:block;">
    <div class="modal-custom-backdrop"></div>
    <div class="modal-custom-content">
        <div class="modal-custom-header">
            <span class="text-lg-bd">Reset Password Pengguna</span>
            <button type="button" class="modal-close-btn" onclick="document.getElementById('modalResetPassword').style.display='none'">
                &times;
            </button>
        </div>
        <div class="modal-custom-body">
            <div id="section-detail">
                <div class="expandable-header" onclick="toggleSection('detail')">
                    <span class="text-md-bd">Informasi Detail Pengguna</span>
                </div>
                <div class="expandable-content" id="content-detail" style="display:block;">
                    <input type="hidden" id="user_id" value="{{ $response->data->user->id }}">
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
            <div><span class="text-md-bd">Reset Password</span></div>
            <div style="display: flex; justify-content: center; ">
                <button type="button" class="button button-clean" id="btnBatalReset">Batal</button>
                <button type="button" class="button button-outline" id="btnReset">Reset Password</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('click', function (e) {
        const btnBatal = e.target.closest('#btnBatalReset');
        if (btnBatal) {
            e.preventDefault();
            window.location.href = "{{ route('users.index') }}";
        }
    });

    document.getElementById('btnReset').addEventListener('click', function() {
        document.getElementById('modalResetPassword').style.display = 'none';
        const userId = document.getElementById('user_id').value;

        $.ajax({
            url: "/users/" + userId + "/update-password",
            type: 'POST',
            data: {},
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                window.location.href = "{{ route('users.index') }}?success=" + encodeURIComponent(response.message);
            },
            error: function(xhr) {
                errorToast(errorMessage);
            }
        });
    });
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">