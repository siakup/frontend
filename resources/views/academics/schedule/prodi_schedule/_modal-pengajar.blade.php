<div id="modalPengajar" class="modal-custom" style="display:none;">
  <div class="modal-custom-backdrop"></div>

  <div class="modal-custom-content !bg-white !z-10">
    <div style="display:flex;justify-content:space-between;align-items:center">
      <span class="modal-custom-title text-lg-bd">Tambah Pengajar</span>
      <button class="button button-clean" id="pgClose">Tutup</button>
    </div>

    <div class="modal-custom-body">
      <div style="display:flex;gap:8px;margin:12px 0">
        <input id="pgSearch" class="input" placeholder="Ketik NIP / Nama Pengajar / Prodi">
        <button class="button" id="pgCari">Cari</button>
      </div>

      <div class="mk-table-wrap">
        <table class="table">
          <thead>
            <tr>
              <th style="width:120px;">NIP</th>
              <th>Nama Pengajar</th>
              <th>Pengajar Program Studi</th>
              <th style="width:140px;">Aksi</th>
            </tr>
          </thead>
          <tbody id="pgTbody">
            <tr><td colspan="4" style="text-align:center;padding:14px;color:#666">Silakan klik Cari…</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="modal-custom-footer create-form">
      <button type="button" class="button button-clean" id="pgBatal">Batal</button>
    </div>
  </div>
</div>

<script>
(function(){
  const modal=document.getElementById('modalPengajar');
  const closeEls=[modal.querySelector('.modal-custom-backdrop'), document.getElementById('pgClose'), document.getElementById('pgBatal')];
  closeEls.forEach(el=>el?.addEventListener('click', ()=> modal.style.display='none'));
  document.addEventListener('keydown',(e)=>{ if(e.key==='Escape' && modal.style.display!=='none') modal.style.display='none'; });

  const search=document.getElementById('pgSearch');
  const btn=document.getElementById('pgCari');
  const tbody=document.getElementById('pgTbody');

  function render(rows){
    if(!rows.length){ tbody.innerHTML = `<tr><td colspan="4" style="text-align:center;padding:14px;color:#666">Tidak ada data</td></tr>`; return; }
    tbody.innerHTML = rows.map(it => `
      <tr>
        <td>${it.nip}</td>
        <td>${it.nama}</td>
        <td>${it.prodi}</td>
        <td><button class="button button-outline" data-pilih='${JSON.stringify({id:it.id, nama:it.nama}).replace(/'/g,'&apos;')}'>Pilih Pengajar Ini</button></td>
      </tr>
    `).join('');
  }

  async function load(){
    const q=(search.value||'').trim().toLowerCase();
    // mock data; ganti ke API kalau sudah siap
    const all=[
      {id:11, nip:'1978xxx', nama:'Ada Lovelace, Ph.D', prodi:'Ilmu Komputer'},
      {id:12, nip:'1980xxx', nama:'Dr. Turing', prodi:'Ilmu Komputer'},
      {id:13, nip:'1985xxx', nama:'Grace Hopper, M.Sc', prodi:'Sistem Informasi'},
    ].filter(x=>!q || x.nama.toLowerCase().includes(q) || x.nip.includes(q) || x.prodi.toLowerCase().includes(q));
    render(all);
  }

  btn.addEventListener('click', load);
  search.addEventListener('keydown', (e)=>{ if(e.key==='Enter') load(); });

  tbody.addEventListener('click', (e)=>{
    const b=e.target.closest('[data-pilih]'); if(!b) return;
    const payload=JSON.parse(b.getAttribute('data-pilih').replace(/&apos;/g,"'"));
    window.dispatchEvent(new CustomEvent('pengajar:selected',{detail:payload}));
  });
})();
</script>
