@extends('layouts.main')

@section('title', 'Tambah Kurikulum')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Kurikulum</div>
@endsection

@section('css')
<style>
  .table {
    color: black;
  }
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

    #toggleButton {
        width: max-content !important;
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

    .checkbox-form input[type="checkbox"]:not(:checked) {
        accent-color: #BFBFBF;
    }

    .checkbox-form input[type="checkbox"]:not(:checked) + label {
        color: #8C8C8C;
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

    button.input {
        border: 1px solid #D9D9D9;
        color: #D9D9D9;
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
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

    .sort-dropdown {
      top: 29% !important;
      left: 15.8% !important;
    }
</style>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnToggle   = document.getElementById('toggleButton');
        const icon        = document.getElementById('toggleIcon');
        const text        = btnToggle.querySelector('.toggle-info');
        const hiddenInput = document.getElementById('statusValue');
        const btnSave     = document.getElementById('btnSimpan');
        const btnConfirm  = document.getElementById('btnYaSimpan');
        const clearButton = document.querySelectorAll('.clear');

        const nama = document.querySelector('input[name="curriculum_nama"]');
        const deskripsi = document.querySelector('input[name="deskripsi"]');
        const sksWajib = document.querySelector('input[name="sks_wajib"]');
        const sksPilihan = document.querySelector('input[name="sks_pilihan"]');
        const totalSKS = document.querySelector('input[name="total_sks"]');
        const programPerkuliahan = document.querySelector('input[name="program_perkuliahan"]');

        function updateSaveButtonState() {
          const programPerkuliahanFilled = programPerkuliahan.value.trim() !== '';
          const namaFilled = nama.value.trim() !== '';
          const deskripsiFilled = deskripsi.value.trim() !== '';
          const sksWajibFilled = sksWajib.value.trim() !== '';
          const sksPilihanFilled = sksPilihan.value.trim() !== '';
          const totalSKSFilled = totalSKS.value.trim() !== '';
          const statusFilled = hiddenInput.value === 'active' || hiddenInput.value === 'inactive' ? true : false;
          if (programPerkuliahanFilled && namaFilled && deskripsiFilled && sksWajibFilled && sksPilihanFilled && totalSKSFilled && statusFilled) {
              btnSave.disabled = false;
          } else {
              btnSave.disabled = true;
          }
        }

        nama.addEventListener('input', () => {
          updateSaveButtonState();
          if(nama.value != '') {
            nama.parentElement.querySelector('.clear').classList.remove('hidden');
          } else {
            nama.parentElement.querySelector('.clear').classList.add('hidden');
          }
        });

        deskripsi.addEventListener('input', () => {
          updateSaveButtonState();
          if(deskripsi.value != '') {
            deskripsi.parentElement.querySelector('.clear').classList.remove('hidden');
          } else {
            deskripsi.parentElement.querySelector('.clear').classList.add('hidden');
          }
        });
        
        sksWajib.addEventListener('input', () => {
          updateSaveButtonState();
          sksWajib.value = sksWajib.value.replace(/[^0-9]/g, '');
          if(sksWajib.value != '') {
            sksWajib.parentElement.querySelector('.clear').classList.remove('hidden');
          } else {
            sksWajib.parentElement.querySelector('.clear').classList.add('hidden');
          }
        });
        
        sksPilihan.addEventListener('input', () => {
          updateSaveButtonState();
          sksPilihan.value = sksPilihan.value.replace(/[^0-9]/g, '');
          if(sksPilihan.value != '') {
            sksPilihan.parentElement.querySelector('.clear').classList.remove('hidden');
          } else {
            sksPilihan.parentElement.querySelector('.clear').classList.add('hidden');
          }
        });
        
        totalSKS.addEventListener('input', () => {
          updateSaveButtonState();
          totalSks.value = totalSKS.value.replace(/[^0-9]/g, '');
          if(totalSKS.value != '') {
            totalSKS.parentElement.querySelector('.clear').classList.remove('hidden');
          } else {
            totalSKS.parentElement.querySelector('.clear').classList.add('hidden');
          }
        });

        Array.from(clearButton).map(btn => {
          btn.addEventListener('click', () => {
            btn.parentElement.querySelector('input').value = '';
            btn.classList.add('hidden');
          })
        })

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
        updateSaveButtonState();

        const eventName = document.querySelector('input[name="program_perkuliahan"]');
        const sortBtnEventName = document.querySelector('#sortEvent');
        const sortDropdownEventName = document.querySelector('#Option-Program-Perkuliahan');

        sortBtnEventName.addEventListener('click', function(e) {
            e.stopPropagation();
            sortDropdownEventName.style.display = (sortDropdownEventName.style.display === 'block') ?
                'none' : 'block';
            sortBtnEventName.querySelector('img').src = (sortBtnEventName.querySelector('img').src ===
                    "{{ asset('assets/icon-arrow-up-black-20.svg') }}") ?
                "{{ asset('assets/icon-arrow-down-grey-20.svg') }}" :
                "{{ asset('assets/icon-arrow-up-black-20.svg') }}";
        });

        document.addEventListener('click', (e) => {
            const dropdownStudy = e.target.closest('#program_perkuliahan');
            if (dropdownStudy == null) {
                sortDropdownEventName.style.display = 'none'
                sortBtnEventName.querySelector('img').src =
                    "{{ asset('assets/icon-arrow-down-grey-20.svg') }}";
            }
        });

        document.querySelectorAll('#Option-Program-Perkuliahan .dropdown-item').forEach((dropdownItem) => {
            dropdownItem.addEventListener('click', () => {
                const value = dropdownItem.getAttribute('data-event');
                const span = sortBtnEventName.querySelector('span');

                span.innerHTML = dropdownItem.innerHTML;
                span.style.color = "black";
                eventName.value = value;
                updateSaveButtonState();
            });
        });
    });
</script>
@section('content')
    <div class="page-header">
        <div class="page-title-text">Tambah Kurikulum</div>
    </div>
    
    <a href="{{ route('curriculum.list') }}" class="button-no-outline-left">
        <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Daftar Kurikulum
    </a>
    <form action="{{route('curriculum.list.store')}}" method="POST">
      @csrf
      <div class="content-card">
          <div class="form-title-text" style="padding: 20px;">Detail Kurikulum 2025 - Teknik Kimia</div>
          <div class="form-section">
              <div class="form-group">
                  <label for="program_studi">Program Studi</label>
                  <div>
                      <input placeholder="Nama Kurikulum" name="program_studi" type="text" id="program_studi" class="form-control" value="Teknik Kimia" readonly>
                  </div>
              </div>
              <div class="form-group">
                  <label for="name">Program Perkuliahan</label>
                  <div class="filter-box" id="program_perkuliahan">
                      <button type="button" class="button-clean input" id="sortEvent">
                          <span id="selectedEventLabel">Program Perkuliahan</span>
                          <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
                      </button>
                      <div id="Option-Program-Perkuliahan" class="sort-dropdown select" style="display: none;">
                          @foreach ($programPerkuliahanList as $programPerkuliahan)
                            <div class="dropdown-item" data-event="{{$programPerkuliahan->id}}">{{$programPerkuliahan->nama}}</div>
                          @endforeach
                      </div>
                      <input type="hidden" value="" name="program_perkuliahan">
                  </div>
              </div>
              <div class="form-group">
                  <label for="Curriculum-Name">Nama Kurikulum</label>
                  <div class="flex items-center border-[1px] border-[#D9D9D9] rounded-lg px-[12px]">
                      <input placeholder="Nama Kurikulum" name="curriculum_nama" type="text" id="Curriculum-Name" class="!border-transparent focus:outline-none" value="">
                      <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                  </div>
              </div>
              <div class="form-group">
                  <label for="Deskripsi">Deskripsi</label>
                  <div class="flex items-center border-[1px] border-[#D9D9D9] rounded-lg px-[12px]">
                      <input placeholder="Deskripsi" name="deskripsi" type="text" id="Deskripsi" class="!border-transparent focus:outline-none" value="">
                      <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                  </div>
              </div>
              <div class="form-group">
                  <label for="Wajib">SKS Mata Kuliah Wajib</label>
                  <div class="flex items-center border-[1px] border-[#D9D9D9] rounded-lg px-[12px]">
                      <input placeholder="SKS Mata Kuliah Wajib" name="sks_wajib" type="text" id="Wajib" class="!border-transparent focus:outline-none" value="">
                      <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                  </div>
              </div>
              <div class="form-group">
                  <label for="Pilihan">SKS Mata Kuliah Pilihan</label>
                  <div class="flex items-center border-[1px] border-[#D9D9D9] rounded-lg px-[12px]">
                      <input placeholder="SKS Mata Kuliah Pilihan" name="sks_pilihan" type="text" id="Pilihan" class="!border-transparent focus:outline-none" value="">
                      <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                  </div>
              </div>
              <div class="form-group">
                  <label for="Total">Total SKS</label>
                  <div class="flex items-center border-[1px] border-[#D9D9D9] rounded-lg px-[12px]">
                      <input placeholder="Total SKS" name="total_sks" type="text" id="Total" class="!border-transparent focus:outline-none" value="">
                      <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                  </div>
              </div>
              <div class="form-group !mb-[20px]">
                <label>Status</label>
                  <button id="toggleButton" type="button" class="btn-toggle">
                      <img src="{{ asset('components/toggle-off-disabled-true.svg') }}" alt="Toggle Icon" id="toggleIcon">
                      <span class="toggle-info text-sm-bd" style="color: var(--Neutral-Gray-600, #8C8C8C)">Tidak Aktif</span>
                  </button>
                <input type="hidden" name="status" id="statusValue" value="inactive">
              </div>
          </div>
      </div>
      <div class="content-card">
          <div class="form-title-text" style="padding: 20px;">Jenis Mata Kuliah - Minimum SKS</div>
          <div class="table-responsive">
              <table class="table" id="list-matkul" style="--table-cols:2">
                  <thead>
                      <tr>
                          <th class="!w-[50%]">Jenis Mata Kuliah</th>
                          <th class="!w-[25%]"></th>
                          <th class="!w-[25%]">Minimum SKS</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($jenis_mata_kuliah as $jenis)
                      <tr class="bg-[#FAFAFA] border-1 border-[#D9D9D9]">
                          <td class="!text-[14px] !w-[50%] !py-[20px]">{{$jenis['nama']}}</td>
                          <td class="py-[12px] !w-[25%]"></td>
                          <td class="py-[12px] !w-[25%]">
                            <div class="border-[1px] border-[#BFBFBF] rounded-lg py-[9px] ps-[39.5px] pe-[12px] flex">
                              <input class="w-full bg-white !border-transparent focus:outline-none text-[14px]" placeholder="Minimum SKS" type="number" value="" name="{{str_replace(' ', '_', strtolower($jenis['nama']))}}" />
                              <img class="clear hidden" src="{{asset('assets/icon-remove-text-input.svg')}}" alt="">
                            </div>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
      <div class="content-card">
        <div class="button-group">
            <button type="button" class="button button-clean disabled:!bg-white disabled:!border-[#D9D9D9] disabled:!border-1" id="btnBatal" disabled>Batal</button>
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
              <div>Apakah Anda yakin informasi yang ditambah sudah benar?</div>
            </div>
            <div class="modal-custom-footer">
              <button type="button" class="button button-clean" id="btnCekKembali">Cek Kembali</button>
              <button type="submit" class="button button-outline" id="btnYaSimpan">Ya, Simpan Sekarang</button>
            </div>
        </div>
      </div>
    </form>
@endsection