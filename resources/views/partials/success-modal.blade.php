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

    .modal-divider {
        width: calc(100% + 32px); 
        height: 1px;
        background: #E5E6E8;
        margin: 24px 0 18px 0;
        border: none;
        position: relative;
        left: -20px;
    }

    #successModalMessage {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        gap: 20px;
        width: 100%;
        margin: 20px 0;
    }

    #btnOke.button {
        flex: 1; 
        max-width: 30%; 
        align-items: center;
        justify-content: center;
    }

</style>

<div id="successModal" class="modal-custom" style="display:none;">
    <div class="modal-custom-backdrop"></div>
    <div class="modal-custom-content">
        <div class="modal-custom-header">
            <span class="text-lg-bd">Berhasil</span>
            <button type="button" class="modal-close-btn">
                &times;
            </button>
        </div>
        <div class="modal-custom-body">
            <div id="successModalMessage">Email untuk mereset kata sandi telah berhasil dikirim.</div>
            <div style="display: flex; justify-content: center; ">
                <button id="btnOke" type="button" class="button button-outline" onclick="document.getElementById('successModal').style.display='none'">Oke</button>
            </div>
        </div>
    </div>
</div>
