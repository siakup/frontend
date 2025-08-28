<style>
  #modalAddEvent .mk-search{display:flex;gap:10px;align-items:center;margin-bottom:10px}
  #modalAddEvent .mk-search .label{font-size:12px;color:#6B7280;margin-right:8px;white-space:nowrap}
  #modalAddEvent .mk-search .input{flex:1;height:38px;border:1px solid #E5E7EB;border-radius:8px;padding:0 12px}
  #modalAddEvent .mk-search .btn{height:38px;border-radius:8px;padding:0 14px;border:1px solid #E5E7EB;background:#E8E8E8;cursor:pointer}
  #modalAddEvent .mk-search .btn:hover{background:#F9FAFB}


  #modalAddEvent table{width:100%;border-collapse:separate;border-spacing:0}
  #modalAddEvent thead th{
    position:sticky;top:0;background:#F8FAFC;text-align:left;font-weight:600;font-size:13px;color:#374151;
    padding:10px 12px;border-bottom:1px solid #E5E7EB;z-index:1
  }
  #modalAddEvent tbody td{font-size:14px;padding:10px 12px;border-bottom:1px solid #F1F5F9;vertical-align:middle}
  #modalAddEvent .btn-red{
    background:#EB474D;color:#fff;border:1px solid #EB474D;border-radius:8px;padding:6px 10px;cursor:pointer;font-size:12px;
  }
  #modalAddEvent .btn-red:hover{background:#d93e44;border-color:#d93e44}
  #modalAddEvent .mk-footer{display:flex;justify-content:space-between;align-items:center;padding:10px 16px 16px}
  #modalAddEvent .mk-meta{font-size:12px;color:#6B7280}
  #modalAddEvent .pager{display:flex;gap:6px;align-items:center}
  #modalAddEvent .page-btn{min-width:34px;height:34px;border-radius:8px;border:1px solid #E5E7EB;background:#fff;cursor:pointer}
  #modalAddEvent .page-btn[disabled]{opacity:.45;cursor:not-allowed}
  #modalAddEvent .page-btn.is-active{background:#EB474D;color:#fff;border-color:#EB474D}
  #modalAddEvent .actions{display:flex;gap:8px;}
  #modalAddEvent .btn{border-radius:8px;border:1px solid #EB474D;background:#fff;border-color:#EB474D;padding:8px 14px;cursor:pointer}
  #modalAddEvent .btn:hover{background:#F9FAFB}

#modalAddEvent.modal-custom {
  position: fixed;
  inset: 0;
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}

#modalAddEvent .modal-custom-backdrop {
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,.45);
  backdrop-filter: blur(1px);
}

#modalAddEvent .modal-custom-content {
  position: relative;
  width: min(1000px, 92vw);
  max-height: 70vh;
  border-radius: 14px;
  background: #fff;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0,0,0,.2);
  margin-top: 65px;  /* naik 40px, bisa atur sesuai selera */

}

#modalAddEvent .mk-header {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 14px 20px;
  border-bottom: 1px solid #EEF2F7;
  position: relative;
}
#modalAddEvent .mk-title {
  font-weight: 700;
  font-size: 16px;
}
#modalAddEvent .mk-close {
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

#modalAddEvent .mk-body {
  padding: 14px 20px;
  overflow-y: auto;
  max-height: calc(70vh - 110px);
}

#modalAddEvent .mk-body::-webkit-scrollbar,
#modalAddEvent .mk-table-wrap::-webkit-scrollbar {
  width: 0px;
  height: 0px;
}

#modalAddEvent .mk-body,
#modalAddEvent .mk-table-wrap {
    max-height:52vh;
    overflow:auto;
    border:1px solid #EEF2F7;
    border-radius:10px;
    text-align: center;
    -ms-overflow-style: none;
    scrollbar-width: none;
}
#modalAddEvent .mk-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 20px;
  border-top: 1px solid #EEF2F7;
}

#modalAddEvent #mk-pager{display:flex;gap:10px;align-items:center}
#modalAddEvent .page-num{
  min-width:34px;height:34px;border-radius:8px;border:1px solid #E5E7EB;background:#fff;cursor:pointer
}
#modalAddEvent .page-num.is-active{background:#EB474D;color:#fff;border-color:#EB474D}
#modalAddEvent tbody tr:nth-child(even){background:#F5F5F5}
#modalAddEvent tbody tr:hover{background:#F9FAFB}
#modalAddEvent thead th:first-child,
#modalAddEvent tbody td:first-child{padding-left:16px}
#modalAddEvent thead th:last-child,
#modalAddEvent tbody td:last-child{padding-right:16px}

#modalAddEvent .page-num {
  min-width: 34px;
  height: 34px;
  border-radius: 8px;
  border: 1px solid #E5E7EB;
  background: #fff;
  color: #374151;
  font-size: 14px;
  cursor: pointer;
}

#modalAddEvent .page-num.is-active {
  background: #EB474D;
  border-color: #EB474D;
  color: #fff;
  font-weight: 600;
}

#modalAddEvent .page-ellipsis {
  color: #9CA3AF;
  font-size: 14px;
  padding: 0 4px;
}

#modalAddEvent .page-prev[disabled],
#modalAddEvent .page-next[disabled] {
  opacity: 0.45;
  cursor: not-allowed;
}

#modalAddEvent .mk-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 20px;
  border-top: 1px solid #EEF2F7;
}

#modalAddEvent .mk-footer-left {
  display: flex;
  align-items: center;
  gap: 20px;
}

#modalAddEvent .mk-meta {
  font-size: 14px;
  color: #6B7280;
  white-space: nowrap;
}

#modalAddEvent #mk-pager {
  display: flex;
  align-items: center;
  gap: 6px;
}

#modalAddEvent .page-prev,
#modalAddEvent .page-next {
  border: 1px solid #EB474D;
  color: #EB474D;
  background: #fff;
  border-radius: 8px;
  padding: 8px 20px;
  min-width: 110px;
  text-align: center;
  cursor: pointer;
}

</style>

<div id="modalAddEvent" class="modal-custom">
  <div class="modal-custom-backdrop"></div>

  <div class="modal-custom-content">
    <div class="mk-header">
      <div class="mk-title ml-70">Daftar Mata Kuliah – Semester Ganjil</div>
      <button type="button" class="mk-close" id="mk-btn-x" aria-label="Tutup">×</button>
    </div>

    <div class="mk-body">
      <div class="mk-search">
        <div class="label">Cari Mata Kuliah</div>
        <input id="mk-search" class="input" placeholder="Ketik Mata Kuliah / Kode Mata Kuliah">
        <button type="button" class="btn" id="mk-btn-search">Cari</button>
      </div>

      <div class="mk-table-wrap">
        <table>
          <thead style="text-align: center">
            <tr>
              <th style="width:200px;text-align: center">Kode Mata Kuliah</th>
              <th style="width:250px;text-align: center">Nama Mata Kuliah</th>
              <th style="width:200px;text-align: center">Jenis Mata Kuliah</th>
              <th style="width:60px;text-align: center">SKS</th>
              <th style="width:240px;text-align: center">Kurikulum</th>
              <th style="width:220px;text-align: center">Aksi</th>
            </tr>
          </thead>
          <tbody id="mk-tbody">
            <!-- diisi dummy data JS -->
          </tbody>
        </table>
      </div>
    </div>
        <div class="mk-footer">
        <div class="mk-footer-left">
            <div class="mk-meta" id="mk-info">Hasil: 1 dari 2</div>
            <div class="pager" id="mk-pager"></div>
        </div>
        <div class="actions">
            <button type="button" class="btn ml-160" id="mk-btn-batal">Batal</button>
        </div>
        </div>
  </div>
</div>

<script>
(function(){
  const modal   = document.getElementById('modalAddEvent');
  const backdrop= modal.querySelector('.modal-custom-backdrop');
  const btnX    = document.getElementById('mk-btn-x');
  const btnBtl  = document.getElementById('mk-btn-batal');

  const input   = document.getElementById('mk-search');
  const btnCari = document.getElementById('mk-btn-search');
  const tbody   = document.getElementById('mk-tbody');
  const info    = document.getElementById('mk-info');

  const dummy = [
    {id:1,kode:'12001',nama:'Akuisisi & Pengolahan Data Seismik Refleksi',jenis:'Mata Kuliah Program Studi',sks:2,kurikulum:'Kurikulum 2021 – Teknik Geofisika'},
    {id:2,kode:'12002',nama:'Analisis Sinyal Geofisika',jenis:'Mata Kuliah Program Studi',sks:2,kurikulum:'Kurikulum 2021 – Teknik Geofisika'},
    {id:3,kode:'12003',nama:'Elektronika dan Instrumentasi Geofisika',jenis:'Mata Kuliah Program Studi',sks:3,kurikulum:'Kurikulum 2021 – Teknik Geofisika'},
    {id:4,kode:'12004',nama:'Evaluasi Formasi',jenis:'Mata Kuliah Program Studi',sks:3,kurikulum:'Kurikulum 2021 – Teknik Geofisika'},
    {id:5,kode:'12005',nama:'Fisika Batuan',jenis:'MK Dasar Umum',sks:2,kurikulum:'Kurikulum 2021 – Teknik Geofisika'},
    {id:6,kode:'13001',nama:'Kalkulus Lanjut',jenis:'MK Dasar Umum',sks:3,kurikulum:'Kurikulum 2021'},
    {id:7,kode:'13002',nama:'Aljabar Linear',jenis:'MK Dasar Umum',sks:3,kurikulum:'Kurikulum 2021'},
    {id:8,kode:'14001',nama:'Pemrograman Dasar',jenis:'Mata Kuliah Program Studi',sks:3,kurikulum:'Kurikulum 2021 – Informatika'},
    {id:9,kode:'14002',nama:'Struktur Data',jenis:'Mata Kuliah Program Studi',sks:3,kurikulum:'Kurikulum 2021 – Informatika'},
    {id:10,kode:'14003',nama:'Basis Data',jenis:'Mata Kuliah Program Studi',sks:3,kurikulum:'Kurikulum 2021 – Informatika'},
    {id:11,kode:'14004',nama:'Jaringan Komputer',jenis:'Mata Kuliah Program Studi',sks:3,kurikulum:'Kurikulum 2021 – Informatika'},
    {id:12,kode:'15001',nama:'Kewirausahaan',jenis:'MK Umum',sks:2,kurikulum:'Kurikulum 2021 – Universitas'},
  ];

  let q='', page=1, perPage=10, total=0;

  function close(){ modal.style.display='none'; }
  [btnX, btnBtl, backdrop].forEach(el=> el?.addEventListener('click', close));
  document.addEventListener('keydown', e=>{ if(e.key==='Escape' && modal.style.display!=='none') close(); });

  function filtered(){ return dummy.filter(d=> !q || d.nama.toLowerCase().includes(q) || d.kode.includes(q)); }

  let lastTotalPages = 1;
  function buildPager(tp){
    lastTotalPages = tp;
    const pager = document.getElementById('mk-pager');
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
  document.getElementById('mk-pager').addEventListener('click', (e)=>{
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
      <tr>
        <td colspan="6" style="text-align:center;padding:14px;color:#6B7280">
          Tidak ada data
        </td>
      </tr>`;
  } else {
    tbody.innerHTML = slice.map(it => `
      <tr>
        <td>${it.kode}</td>
        <td>${it.nama}</td>
        <td>${it.jenis}</td>
        <td>${it.sks}</td>
        <td>${it.kurikulum}</td>
        <td>
          <button class="btn-red"
            data-pilih='${JSON.stringify({ id: it.id, nama: it.nama }).replace(/'/g, "&apos;")}'>
            Pilih Mata Kuliah Ini
          </button>
        </td>
      </tr>
    `).join('');
  }
  info.textContent = `Hasil: ${page} dari ${totalPages}`;

  if (typeof buildPager === 'function') {
    buildPager(totalPages);
  }
}


  btnCari.addEventListener('click', ()=>{ q=(input.value||'').trim().toLowerCase(); page=1; render(); });
  input.addEventListener('keydown', e=>{ if(e.key==='Enter'){ q=(input.value||'').trim().toLowerCase(); page=1; render(); } });

  tbody.addEventListener('click', (e)=>{
    const b=e.target.closest('[data-pilih]'); if(!b) return;
    const payload = JSON.parse(b.getAttribute('data-pilih').replace(/&apos;/g,"'"));
    const disp = document.getElementById('mk_display');
    const hid  = document.getElementById('mata_kuliah_id');
    if(disp) disp.value = payload.nama;
    if(hid)  hid.value  = payload.id;

    document.getElementById('nama_kelas')?.dispatchEvent(new Event('input',{bubbles:true}));
    close();
  });

  render();
})();
</script>
