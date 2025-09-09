<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
  /* ===== Modal ===== */
  .mk-modal{position:fixed;inset:0;display:none;align-items:center;justify-content:center;z-index:60}
  .mk-modal.show{display:flex}
  .mk-backdrop{position:absolute;inset:0;background:rgba(15,23,42,.45)}
  .mk-dialog{position:relative;background:#fff;border-radius:14px;box-shadow:0 10px 25px rgba(0,0,0,.15);width:480px;max-width:92%}
  .mk-header{display:flex;align-items:center;justify-content:center;justify-self: center ;padding:16px 20px;border-bottom:1px solid #E5E7EB}
  .mk-title{width: 100%; align-content: center;text-align: center;font-weight:700;font-size:22px;color:#111827}
  .mk-icon{width:30px;height:30px;opacity:.9;justify-content: self-end;}
  .mk-body{padding:22px 24px;text-align:center;color:#111827}
  .mk-body .lead{margin:0 0 6px 0;line-height:1.5}
  .mk-body .name{margin:0;font-weight:700;font-size:18px}
  .mk-footer{display:flex;justify-content:center;gap:16px;padding:18px 20px 22px;border-top:1px solid #E5E7EB}
  .btn-red{min-width:190px;height:46px;border-radius:12px;background:#EB474D;color:#fff;border:1px solid #EB474D;cursor:pointer}
  .btn-red:hover{background:#d53e44}
  .btn-outline-red{min-width:190px;height:46px;border-radius:12px;background:#fff;color:#EB474D;border:1px solid #EB474D;cursor:pointer}
  .btn-outline-red:hover{background:#fff5f5}

  /* ===== Toast hitam top-center ===== */
  .mk-toast{position:fixed;top:14px;left:50%;transform:translateX(-50%);z-index:70;display:flex;flex-direction:column;gap:8px}
  .mk-toast .item{display:flex;align-items:center;justify-content:space-between;min-width:340px;max-width:720px;background:#111827;color:#fff;border:none;border-radius:10px;padding:10px 14px;box-shadow:0 8px 20px rgba(0,0,0,.25)}
  .mk-toast .msg{margin-right:16px}
  .mk-toast .ok{border:1px solid rgba(255,255,255,.9);background:transparent;color:#fff;border-radius:8px;padding:4px 12px;cursor:pointer}
  .fade-out{opacity:0;transition:opacity .25s ease}
</style>

<div id="mkToast" class="mk-toast" aria-live="polite"></div>

<div id="mkDeleteModal" class="mk-modal" role="dialog" aria-modal="true" aria-labelledby="mkDeleteTitle">
  <div class="mk-backdrop" data-close></div>
  <div class="mk-dialog">
    <!-- Header -->
    <div class="modal-custom-header">
      <p class="mk-title" id="mkDeleteTitle">Tunggu Sebentar</p>
      <img class="mk-icon" src="{{ asset('assets/icon-caution.svg') }}" alt="info">
    </div>

    <!-- Body -->
    <div class="mk-body modal-custom-body">
      <p class="lead">Apakah Anda yakin ingin menghapus jadwal kuliah</p>
      <p class="name"><span id="mkDeleteName">(namaMataKuliah)</span>?</p>
    </div>

    <!-- Footer -->
    <div class="mk-footer modal-custom-footer">
      <button class="btn-outline-red" data-close> Batal </button>
      <button class="btn-red" id="mkDoDeleteBtn"> Ya, Hapus Sekarang </button>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
  // Elemen & state
  const csrf   = document.querySelector('meta[name="csrf-token"]')?.content;
  const toast  = document.getElementById('mkToast');
  const modal  = document.getElementById('mkDeleteModal');
  const btnDo  = document.getElementById('mkDoDeleteBtn');
  const nameEl = document.getElementById('mkDeleteName');

  let ctx = { url:null, rowEl:null, name:'item' };

  // Toast hitam: seperti desain (pesan + tombol Oke)
  function showToast(message, timeout=4000){
    const item = document.createElement('div');
    item.className = 'item';
    item.innerHTML = `<span class="msg">${message}</span><button class="ok">Oke</button>`;
    toast.appendChild(item);

    const close = () => { item.classList.add('fade-out'); setTimeout(()=>item.remove(), 250); };
    item.querySelector('.ok').addEventListener('click', close);
    setTimeout(close, timeout);
  }

  // Modal helpers
  function openModal(nextCtx){
    ctx = nextCtx;
    nameEl.textContent = ctx.name || 'item';
    modal.classList.add('show');
    document.body.style.overflow='hidden';
  }
  function closeModal(){
    modal.classList.remove('show');
    btnDo.disabled = false;
    btnDo.textContent = 'Ya, Hapus Sekarang';
    document.body.style.overflow='';
  }

  // Close via backdrop / Esc
  modal?.addEventListener('click', (e)=>{ if(e.target.matches('[data-close]')) closeModal(); });
  window.addEventListener('keydown', (e)=>{ if(e.key === 'Escape' && modal.classList.contains('show')) closeModal(); });

  // Buka modal saat klik tombol dengan data-delete-url (event delegation)
  document.addEventListener('click', (e)=>{
    const btn = e.target.closest('[data-delete-url]');
    if(!btn) return;
    e.preventDefault();

    const row = btn.closest('tr') || btn.closest('[data-row-id]');
    openModal({
      url: btn.dataset.deleteUrl,
      rowEl: row || null,
      name: btn.dataset.deleteName || row?.getAttribute('data-row-name') || 'item'
    });
  });

  // Konfirmasi hapus
  btnDo?.addEventListener('click', async ()=>{
    if(!ctx.url) return;

    btnDo.disabled = true;
    btnDo.textContent = 'Menghapus...';

    try{
      const res = await fetch(ctx.url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
        },
        body: new URLSearchParams({ _method:'DELETE' })
      });

      let data = null; try{ data = await res.json(); }catch(_){}
      if(!res.ok) throw new Error(data?.message || `Gagal menghapus (status ${res.status})`);

      // Hapus row di UI
      if(ctx.rowEl){ ctx.rowEl.classList.add('fade-out'); setTimeout(()=>ctx.rowEl.remove(), 250); }

      closeModal();
      showToast(`Berhasil menghapus jadwal kuliah (${ctx.name})!`);
    }catch(err){
      btnDo.disabled = false;
      btnDo.textContent = 'Ya, Hapus Sekarang';
      showToast(err.message || 'Terjadi kesalahan.');
    }
  });
});

</script>
