<style>
  #modalAddPengajar .mk-search{display:flex;gap:10px;align-items:center;margin-bottom:10px}
  #modalAddPengajar .mk-search .label{font-size:12px;color:#6B7280;margin-right:8px;white-space:nowrap}
  #modalAddPengajar .mk-search .input{flex:1;height:38px;border:1px solid #E5E7EB;border-radius:8px;padding:0 12px}
  #modalAddPengajar .mk-search .btn{height:38px;border-radius:8px;padding:0 14px;border:1px solid #E5E7EB;background:#E8E8E8;cursor:pointer}
  #modalAddPengajar .mk-search .btn:hover{background:#F9FAFB}
  #modalAddPengajar .btn{border-radius:8px;border:1px solid #EB474D;background:#fff;padding:8px 14px;cursor:pointer}
  #modalAddPengajar .btn:hover{background:#F9FAFB}
  #modalAddPengajar .btn-red{background:#EB474D;color:#fff;border:1px solid #EB474D;border-radius:8px;padding:6px 10px;cursor:pointer;font-size:12px}
  #modalAddPengajar .btn-red:hover{background:#d93e44;border-color:#d93e44}

  #modalAddPengajar.modal-custom{position:fixed;inset:0;display:none;align-items:center;justify-content:center;z-index:9999}
  #modalAddPengajar .modal-custom-backdrop{position:absolute;inset:0;background:rgba(0,0,0,.45);backdrop-filter:blur(1px)}
  #modalAddPengajar .modal-custom-content{position:relative;width:min(1000px,92vw);max-height:70vh;border-radius:14px;background:#fff;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.2);margin-top:80px}

  #modalAddPengajar .mk-header{display:flex;align-items:center;justify-content:center;padding:14px 20px;border-bottom:1px solid #EEF2F7;position:relative}
  #modalAddPengajar .mk-title{font-weight:700;font-size:16px}
  #modalAddPengajar .mk-close{position:absolute;right:20px;top:50%;transform:translateY(-50%);width:32px;height:32px;border:1px solid #E5E7EB;border-radius:8px;background:#fff;cursor:pointer;font-size:20px;line-height:28px}

  #modalAddPengajar .mk-body{padding:14px 20px;overflow:visible;max-height:none;border:0;border-radius:0}
  #modalAddPengajar .mk-table-wrap{max-height:min(52vh,calc(100dvh - 240px));overflow:auto;border:1px solid #EEF2F7;border-radius:10px;text-align:center;-ms-overflow-style:none;scrollbar-width:none}
  #modalAddPengajar .mk-table-wrap::-webkit-scrollbar{width:0;height:0}

  #modalAddPengajar thead th{height:68px;vertical-align:middle}
  #modalAddPengajar tbody tr{height:100px}
  #modalAddPengajar tbody td{padding:0 12px;line-height:1.2;vertical-align:middle}
  #modalAddPengajar tbody tr:nth-child(even){background:#F5F5F5}
  #modalAddPengajar tbody tr:hover{background:#F9FAFB}

  #modalAddPengajar .mk-footer{display:flex;justify-content:space-between;align-items:center;padding:12px 20px;border-top:1px solid #EEF2F7}
  #modalAddPengajar .mk-footer-left{display:flex;align-items:center;gap:20px}
  #modalAddPengajar .mk-meta{font-size:14px;color:#6B7280;white-space:nowrap}

  #modalAddPengajar #pg-pager{display:flex;align-items:center;gap:6px}
  #modalAddPengajar .page-num{min-width:34px;height:34px;border-radius:8px;border:1px solid #E5E7EB;background:#fff;color:#374151;font-size:14px;cursor:pointer}
  #modalAddPengajar .page-num.is-active{background:#EB474D;border-color:#EB474D;color:#fff;font-weight:600}
  #modalAddPengajar .page-ellipsis{color:#9CA3AF;font-size:14px;padding:0 4px}
  #modalAddPengajar .page-prev,#modalAddPengajar .page-next{display:inline-flex;align-items:center;justify-content:center;gap:6px;border:1px solid #EB474D;color:#EB474D;background:#fff;border-radius:8px;padding:8px 20px;min-width:120px;font-size:14px;font-weight:500;cursor:pointer}
  #modalAddPengajar .page-prev[disabled],#modalAddPengajar .page-next[disabled]{opacity:.45;cursor:not-allowed}

  .toast-root{position:fixed;inset:0;pointer-events:none;z-index:10000}
  .toast{position:absolute;left:50%;top:80px;transform:translateX(-50%);background:#1F2937;color:#fff;border-radius:10px;padding:10px 14px;display:flex;gap:14px;align-items:center;box-shadow:0 8px 20px rgba(0,0,0,.25);pointer-events:auto;opacity:0;translate:0 -8px;transition:opacity .2s ease,translate .2s ease}
  .toast.show{opacity:1;translate:0 0}
  .toast .msg{font-size:14px;white-space:nowrap}
  .toast .btn-ok{border:1px solid rgba(255,255,255,.35);background:transparent;color:#fff;border-radius:8px;padding:6px 10px;cursor:pointer}
  .toast.success{background:#059669}
  .toast.error{background:#DC2626}
</style>

<div id="modalAddPengajar" class="modal-custom">
  <div class="modal-custom-backdrop"></div>
  <div class="modal-custom-content">
    <div class="mk-header">
      <div class="mk-title">Daftar Pengajar</div>
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
              <x-table-header style="width:150px;text-align:center;">NIP</x-table-header>
              <x-table-header style="width:300px;text-align:center;">Nama Pengajar</x-table-header>
              <x-table-header style="width:238px;text-align:center;">Program Studi</x-table-header>
              <x-table-header style="width:220px;text-align:center;">Aksi</x-table-header>
            </x-table-row>
          </x-table-head>
          <x-table-body id="pg-tbody"></x-table-body>
        </x-table>
      </div>
    </div>
    <div class="mk-footer">
      <div class="mk-footer-left">
        <div class="mk-meta" id="pg-info">Hasil: 1 dari 1</div>
        <div class="pager" id="pg-pager"></div>
      </div>
      <div class="actions">
        <button type="button" class="btn" id="pg-btn-batal">Batal</button>
      </div>
    </div>
  </div>
</div>

<div id="toast-root" class="toast-root" aria-live="polite"></div>

<script>
(function(){
  window.showToast=function(message,type){const r=document.getElementById('toast-root');const el=document.createElement('div');el.className='toast'+(type==='success'?' success':type==='error'?' error':'');el.innerHTML='<div class="msg">'+message+'</div><button class="btn-ok" type="button">Oke</button>';r.appendChild(el);requestAnimationFrame(()=>el.classList.add('show'));const c=()=>{el.classList.remove('show');setTimeout(()=>el.remove(),220)};el.querySelector('.btn-ok').addEventListener('click',c);setTimeout(c,3000)}

  const modal=document.getElementById('modalAddPengajar');
  const backdrop=modal.querySelector('.modal-custom-backdrop');
  const btnX=document.getElementById('pg-btn-x');
  const btnBtl=document.getElementById('pg-btn-batal');
  const input=document.getElementById('pg-search');
  const btnCari=document.getElementById('pg-btn-search');
  const tbody=document.getElementById('pg-tbody');
  const info=document.getElementById('pg-info');

  const dummy=[
    {id:1,nip:'19800101',nama:'Ade Irawan, Ph.D',prodi:'Ilmu Komputer'},
    {id:2,nip:'19850505',nama:'Tasmi, S.Si, M.Si',prodi:'Ilmu Komputer'},
    {id:3,nip:'19771212',nama:'Rangga G. Neagraha, Ph.D',prodi:'Ilmu Komputer'},
    {id:4,nip:'19881111',nama:'Meredita Susanty, M.Sc',prodi:'Ilmu Komputer'},
    {id:5,nip:'19900123',nama:'Randi F. Putra, M.Si',prodi:'Ilmu Komputer'},
    {id:6,nip:'19920202',nama:'Andhika Pratama, M.Kom',prodi:'Informatika'},
    {id:7,nip:'19930303',nama:'Siti Aisyah, M.Kom',prodi:'Informatika'},
    {id:8,nip:'19940404',nama:'Bambang Pamungkas, M.T',prodi:'Teknik Geofisika'},
    {id:9,nip:'19950505',nama:'Citra Dewi, M.Sc',prodi:'Teknik Geofisika'},
    {id:10,nip:'19960606',nama:'Dwi Putri, M.Si',prodi:'Kimia'},
    {id:11,nip:'19970707',nama:'Eko Prasetyo, M.Kom',prodi:'Informatika'}
  ];

  let q='',page=1,perPage=10,total=0,lastTotalPages=1;

  function close(){modal.style.display='none';document.body.style.overflow=''}
  [btnX,btnBtl,backdrop].forEach(el=>el&&el.addEventListener('click',close));
  document.addEventListener('keydown',e=>{if(e.key==='Escape'&&modal.style.display!=='none')close()});

  function filtered(){
    const qq=(q||'').toLowerCase();
    return dummy.filter(d=>!qq||d.nama.toLowerCase().includes(qq)||d.nip.includes(qq)||d.prodi.toLowerCase().includes(qq));
  }

  function buildPager(tp){
    lastTotalPages=tp;
    const pager=document.getElementById('pg-pager');
    let html='<button class="page-prev" data-goto="prev" '+(page<=1?'disabled':'')+'><span class="icon">‹</span><span class="label">Sebelumnya</span></button>';
    const add=i=>html+='<button class="page-num '+(i===page?'is-active':'')+'" data-page="'+i+'">'+i+'</button>';
    if(tp<=7){for(let i=1;i<=tp;i++)add(i)}else{add(1);if(page>3)html+='<span class="page-ellipsis">…</span>';const s=Math.max(2,page-1),e=Math.min(tp-1,page+1);for(let i=s;i<=e;i++)add(i);if(page<tp-2)html+='<span class="page-ellipsis">…</span>';add(tp)}
    html+='<button class="page-next" data-goto="next" '+(page>=tp?'disabled':'')+'><span class="label">Selanjutnya</span><span class="icon">›</span></button>';
    pager.innerHTML=html;
  }

  document.getElementById('pg-pager').addEventListener('click',e=>{
    const n=e.target.closest('.page-num');if(n){page=Number(n.dataset.page);render();return}
    const nx=e.target.closest('[data-goto="next"]');if(nx&&page<lastTotalPages){page++;render()}
    const pv=e.target.closest('[data-goto="prev"]');if(pv&&page>1){page--;render()}
  });

  function render(){
    const rows=filtered();total=rows.length;
    const totalPages=Math.max(1,Math.ceil(total/perPage));
    if(page>totalPages)page=totalPages;if(page<1)page=1;
    const start=(page-1)*perPage;const slice=rows.slice(start,start+perPage);

    if(!slice.length){
      tbody.innerHTML='<tr><td colspan="4" class="text-center text-gray-400">Tidak ada data</td></tr>';
    }else{
      tbody.innerHTML=slice.map(it=>
        '<tr>'+
          '<td>'+it.nip+'</td>'+
          '<td>'+it.nama+'</td>'+
          '<td>'+it.prodi+'</td>'+
          '<td><button class="btn-red" data-pilih=\''+JSON.stringify({id:it.id,nama:it.nama}).replace(/'/g,"&apos;")+'\'>Pilih Pengajar Ini</button></td>'+
        '</tr>'
      ).join('');
    }

    info.textContent='Hasil: '+page+' dari '+totalPages;
    buildPager(totalPages);
  }

  function doSearch(){q=(input.value||'').trim();page=1;render()}
  btnCari.addEventListener('click',doSearch);
  input.addEventListener('keydown',e=>{if(e.key==='Enter')doSearch()});

  tbody.addEventListener('click',e=>{
    const b=e.target.closest('[data-pilih]');if(!b)return;
    const payload=JSON.parse(b.getAttribute('data-pilih').replace(/&apos;/g,"'"));
    document.dispatchEvent(new CustomEvent('pengajarDipilih',{detail:payload}));
    showToast('Berhasil menambah pengajar!','success');
    close();
  });

  render();

  document.addEventListener('mataKuliahDihapus',()=>showToast('Berhasil menghapus mata kuliah','success'));
})();
</script>
