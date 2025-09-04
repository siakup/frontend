<style>
  #modalAddPengajar .mk-search{display:flex;gap:10px;align-items:center;margin-bottom:10px}
  #modalAddPengajar .mk-search .label{font-size:12px;color:#6B7280;margin-right:8px;white-space:nowrap}
  #modalAddPengajar .mk-search .input{flex:1;height:38px;border:1px solid #E5E7EB;border-radius:8px;padding:0 12px}
  #modalAddPengajar .mk-search .btn{height:38px;border-radius:8px;padding:0 14px;border:1px solid #E5E7EB;background:#E8E8E8;cursor:pointer}
  #modalAddPengajar .mk-search .btn:hover{background:#F9FAFB}
  #modalAddPengajar .btn{border-radius:8px;border:1px solid #EB474D;background:#fff;border-color:#EB474D;padding:8px 14px;cursor:pointer}


  #modalAddPengajar .btn-red{
    background:#EB474D;color:#fff;border:1px solid #EB474D;border-radius:8px;padding:6px 10px;cursor:pointer;font-size:12px;
  }
  #modalAddPengajar .btn-red:hover{background:#d93e44;border-color:#d93e44}

#modalAddPengajar.modal-custom {
  position: fixed;
  inset: 0;
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}

#modalAddPengajar .modal-custom-backdrop {
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,.45);
  backdrop-filter: blur(1px);
}

#modalAddPengajar .modal-custom-content {
  position: relative;
  width: min(1000px, 92vw);
  max-height: 70vh;
  border-radius: 14px;
  background: #fff;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0,0,0,.2);
  margin-top: 80px;
}

#modalAddEvent .mk-body::-webkit-scrollbar,

  #modalAddPengajar .mk-header {
    display: flex; align-items: center; justify-content: center;
    padding: 14px 20px; border-bottom: 1px solid #EEF2F7; position: relative;
  }
  #modalAddPengajar .mk-title { font-weight: 700; font-size: 16px; }

  #modalAddPengajar .mk-close {
  position: absolute;
  left: 25.3cm;
  top: 50%;
  transform: translateY(-50%);
  width: 32px; height: 32px;
  border: 1px solid #E5E7EB;
  border-radius: 8px;
  background: #fff;
  cursor: pointer;
  font-size: 20px;
  line-height: 28px;
}

  #modalAddPengajar .mk-body { padding: 14px 20px; overflow-y: auto; max-height: calc(70vh - 110px); }

  #modalAddPengajar .mk-body::-webkit-scrollbar,
  #modalAddPengajar .mk-table-wrap::-webkit-scrollbar { width: 0; height: 0; }

  #modalAddPengajar .mk-body,
  #modalAddPengajar .mk-table-wrap {
    max-height:52vh; overflow:auto; border:1px solid #EEF2F7; border-radius:10px; text-align: center;
    -ms-overflow-style: none; scrollbar-width: none;
  }

  #modalAddPengajar .mk-footer {
    display: flex; justify-content: space-between; align-items: center;
    padding: 12px 20px; border-top: 1px solid #EEF2F7;
  }

  #modalAddPengajar #pg-pager{display:flex;gap:10px;align-items:center}
  #modalAddPengajar .page-num{
    min-width:34px;height:34px;border-radius:8px;border:1px solid #E5E7EB;background:#fff;cursor:pointer
  }
  #modalAddPengajar .page-num.is-active{background:#EB474D;color:#fff;border-color:#EB474D}

  #modalAddPengajar .mk-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 20px;
  border-top: 1px solid #EEF2F7;
}

#modalAddPengajar .mk-footer-left {
  display: flex;
  align-items: center;
  gap: 20px;
}

#modalAddPengajar .mk-meta {
  font-size: 14px;
  color: #6B7280;
  white-space: nowrap;
}

#modalAddPengajar #pg-pager {
  display: flex;
  align-items: center;
  gap: 6px;
}

#modalAddPengajar .page-prev,
#modalAddPengajar .page-next {
  /* display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px; */
  border: 1px solid #EB474D;
  color: #EB474D;
  background: #fff;
  border-radius: 8px;
  padding: 6px 9px;
  /* min-width: 120px;
  font-size: 14px;
  font-weight: 500; */
  cursor: pointer;
}

#modalAddPengajar .page-prev[disabled],
#modalAddPengajar .page-next[disabled] {
  opacity: 0.45;
  cursor: not-allowed;
}

#modalAddPengajar .mk-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 20px;
  border-top: 1px solid #EEF2F7;
}

#modalAddPengajar .mk-footer-left {
  display: flex;
  align-items: center;
  gap: 20px;
}
</style>

<div id="modalAddPengajar" class="modal-custom">
  <div class="modal-custom-backdrop"></div>
  <div class="modal-custom-content">
    <div class="mk-header">
      <div class="mk-title  ml-70">Daftar Pengajar</div>
      <button type="button" class="mk-close" id="pg-btn-x" aria-label="Tutup">×</button>
    </div>

    <div class="mk-body">
      <div class="mk-search">
        <div class="label">Cari Pengajar</div>
        <input id="pg-search" class="input" placeholder="Ketik NIP / Nama Pengajar / Prodi">
        <button type="button" class="btn-red" id="pg-btn-search">Cari</button>
      </div>

      <div class="mk-table-wrap">
        <x-table>
            <x-table-head>
                <x-table-row>
                <x-table-header style="width:150px; text-align:center;">NIP</x-table-header>
                <x-table-header style="width:504px; text-align:center;">Nama Pengajar</x-table-header>
                <x-table-header style="width:250px; text-align:center;">Program Studi</x-table-header>
                <x-table-header style="width:220px; text-align:center;">Aksi</x-table-header>
                </x-table-row>
            </x-table-head>

            <x-table-body id="pg-tbody">
                {{-- diisi via JS (dummy data) --}}
                {{-- contoh row kosong --}}
                <x-table-row>
                <x-table-cell colspan="4" class="text-center text-gray-400">
                    Tidak ada data
                </x-table-cell>
                </x-table-row>
            </x-table-body>
        </x-table>
      </div>
    </div>

    <div class="mk-footer">
    <div class="mk-footer-left">
        <div class="mk-meta" id="pg-info">Hasil: 1 dari 1</div>
        <div class="pager" id="pg-pager"></div>
    </div>
    <div class="actions">
        <button type="button" class="btn ml-110" id="pg-btn-batal">Batal</button>
    </div>
    </div>
  </div>
</div>

<script>
(function(){
  const modal   = document.getElementById('modalAddPengajar');
  const backdrop= modal.querySelector('.modal-custom-backdrop');
  const btnX    = document.getElementById('pg-btn-x');
  const btnBtl  = document.getElementById('pg-btn-batal');

  const input   = document.getElementById('pg-search');
  const btnCari = document.getElementById('pg-btn-search');
  const tbody   = document.getElementById('pg-tbody');
  const info    = document.getElementById('pg-info');

  const dummy = [
    {id:1,nip:'19800101',nama:'Ade Irawan, Ph.D',prodi:'Ilmu Komputer'},
    {id:2,nip:'19850505',nama:'Tasmi, S.Si, M.Si',prodi:'Ilmu Komputer'},
    {id:3,nip:'19771212',nama:'Rangga G. Neagraha, Ph.D',prodi:'Ilmu Komputer'},
    {id:4,nip:'19881111',nama:'Meredita Susanty, M.Sc',prodi:'Ilmu Komputer'},
    {id:5,nip:'19900123',nama:'Randi F. Putra, M.Si',prodi:'Ilmu Komputer'},
    {id:6,nip:'19900123',nama:'Randi F. Putra, M.Si',prodi:'Ilmu Komputer'},
    {id:7,nip:'19900123',nama:'Randi F. Putra, M.Si',prodi:'Ilmu Komputer'},
    {id:8,nip:'19900123',nama:'Randi F. Putra, M.Si',prodi:'Ilmu Komputer'},
    {id:9,nip:'19900123',nama:'Randi F. Putra, M.Si',prodi:'Ilmu Komputer'},
    {id:10,nip:'19900123',nama:'Randi F. Putra, M.Si',prodi:'Ilmu Komputer'},
    {id:10,nip:'19900123',nama:'Randi F. Putra, M.Si',prodi:'Ilmu Komputer'},
    {id:10,nip:'19900123',nama:'Randi F. Putra, M.Si',prodi:'Ilmu Komputer'},
  ];

  let q='', page=1, perPage=10, total=0;

  function close(){ modal.style.display='none'; }
  [btnX, btnBtl, backdrop].forEach(el=> el?.addEventListener('click', close));
  document.addEventListener('keydown', e=>{ if(e.key==='Escape' && modal.style.display!=='none') close(); });

  function filtered(){
    return dummy.filter(d=>
      !q || d.nama.toLowerCase().includes(q) || d.nip.includes(q) || d.prodi.toLowerCase().includes(q)
    );
  }

  let lastTotalPages = 1;
  function buildPager(tp){
    lastTotalPages = tp;
    const pager = document.getElementById('pg-pager');
    let html = '';

    html += `<button class="page-prev" data-goto="prev" ${page<=1?'disabled':''}>‹ Sebelumnya</button>`;

    const addNum = (i) => {
      html += `<button class="page-num ${i===page?'is-active':''}" data-page="${i}">${i}</button>`;
    };

    if(tp <= 7){
      for(let i=1;i<=tp;i++) addNum(i);
    }else{
      addNum(1);
      if(page > 3) html += `<span class="page-ellipsis">…</span>`;
      const start = Math.max(2, page-1);
      const end   = Math.min(tp-1, page+1);
      for(let i=start;i<=end;i++) addNum(i);
      if(page < tp-2) html += `<span class="page-ellipsis">…</span>`;
      addNum(tp);
    }

    html += `<button class="page-next" data-goto="next" ${page>=tp?'disabled':''}>Selanjutnya ›</button>`;

    pager.innerHTML = html;
  }

  // listener pager
  document.getElementById('pg-pager').addEventListener('click', (e)=>{
    const btnNum = e.target.closest('.page-num');
    if(btnNum){ page = Number(btnNum.dataset.page); render(); return; }

    const btnNext = e.target.closest('[data-goto="next"]');
    if(btnNext && page < lastTotalPages){ page++; render(); }

    const btnPrev = e.target.closest('[data-goto="prev"]');
    if(btnPrev && page > 1){ page--; render(); }
  });

  function render(){
  const rows = filtered();
  total = rows.length;
  const totalPages = Math.max(1, Math.ceil(total / perPage));
  if (page > totalPages) page = totalPages;
  if (page < 1) page = 1;

  const start = (page - 1) * perPage;
  const slice = rows.slice(start, start + perPage);

  if (!slice.length) {
    tbody.innerHTML = `
      <x-table-row>
        <x-table-cell colspan="4" class="text-center text-gray-400">
          Tidak ada data
        </x-table-cell>
      </x-table-row>`;
  } else {
    tbody.innerHTML = slice.map(it => `
      <x-table-row>
        <x-table-cell>${it.nip}</x-table-cell>
        <x-table-cell>${it.nama}</x-table-cell>
        <x-table-cell>${it.prodi}</x-table-cell>
        <x-table-cell>
          <button class="btn-red"
            data-pilih='${JSON.stringify({ id: it.id, nama: it.nama }).replace(/'/g,"&apos;")}'>
            Pilih Pengajar Ini
          </button>
        </x-table-cell>
      </x-table-row>
    `).join('');
  }
  info.textContent = `Hasil: ${page} dari ${totalPages}`;
  if (typeof buildPager === 'function') buildPager(totalPages);
}


  btnCari.addEventListener('click', ()=>{ q=(input.value||'').trim().toLowerCase(); page=1; render(); });
  input.addEventListener('keydown', e=>{ if(e.key==='Enter'){ q=(input.value||'').trim().toLowerCase(); page=1; render(); } });

  tbody.addEventListener('click', (e)=>{
    const b=e.target.closest('[data-pilih]'); if(!b) return;
    const payload = JSON.parse(b.getAttribute('data-pilih').replace(/&apos;/g,"'"));
    document.dispatchEvent(new CustomEvent('pengajarDipilih',{detail:payload}));
    close();
  });

  render();
})();
</script>
