@extends('layouts.main')

@section('title', 'Tambah Periode Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/plugins/flatpckr.css')}}" />
<style>
    .form-section {
        display: flex;
        flex-direction: column;
        align-content: stretch;
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
        justify-items: center;
        box-sizing: border-box;
    }

    .checkbox-form {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .toggle-row,
    .btn-toggle {
        width: 100%;
        margin: 0;
        padding: 0;
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

    .info-group {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .info-text {
      font-size: 12px;
      font-weight: 400;
      color: #8C8C8C;
    }

    .info-section {
      width: 100%;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
    }

    textarea {
      font-family: Poppins;
      border: 1px solid #D9D9D9;
      font-size: 14px;
      border-radius: 4px;
      padding: 10px 12px;
    }

    textarea:focus {
      border: 1px solid #D9D9D9;
      outline: none;
    }

    .form-inline {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
    }

    /* Custom tanggal terpilih */
    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange {
      background-color: #dc2626 !important; /* merah */
      color: #fff !important;
      border-radius: 12px !important;
    }

    /* Hover efek */
    .flatpickr-day:hover {
      background-color: #fecaca !important; /* merah muda */
      color: #dc2626 !important;
    }

    /* Styling jam & menit */
    .flatpickr-time input {
      border-radius: 8px !important;
      color: #dc2626 !important;
      padding: 4px;
      font-weight: bold;
    }

    .flatpickr-time-separator {
      text-align: center;
    }

    /* Style dropdown jam & menit fokus */
    .flatpickr-time input:focus {
      outline: none;
      box-shadow: 0 0 3px #dc2626;
    }

    /* Style container jam & menit */
    .flatpickr-time {
      border-top: 1px solid #eee;
    }

    .form-group input[readonly]#year,
    .form-group input[readonly]#tanggal-mulai,
    .form-group input[readonly]#tanggal-akhir {
      background: transparent !important;
      outline: none;
      border: none;
      width: 200px;
      color: #262626;
    }

    .form-group input[readonly] {
      background: white;
    }

    .form-group input[readonly]#year {
      cursor: pointer;
    }

    .form-group input[readonly]:focus {
      outline: none;
    }

    .year-wrapper {
      display: flex;
      flex-direction: column;
      position: relative;
    }

    .year-input {
      border: 1px solid #BFBFBF !important;
      display: flex !important;
      align-items: stretch !important;
      color: #262626;
      border-radius: 16px;
    }

    .year-input-right-label {
      background-color: #E8E8E8;
      border-top-right-radius: 16px;
      border-bottom-right-radius: 16px;
      padding: 9px 12px;
      color: #8C8C8C;
      border-left: 1px solid #D9D9D9;
      margin-left: 12px;
    }

    #Year-dropdown {
      height: 236px;
      width: 240px;
      overflow: scroll;
      border: 1px solid #D9D9D9;
      border-radius: 8px;
      align-self: flex-end;
      position: absolute;
      top: 45px;
      background-color: white;
      display: none;
      flex-direction: column;
    }

    #Year-dropdown div {
      width: 100%;
      padding: 12px 8px;
    }

    #Year-dropdown div.selected,
    #Year-dropdown div:hover {
      color: #FFFFFF;
      background-color: #EB474D;
    }

    .calendar-input {
      border: 1px solid #BFBFBF !important;
      display: flex !important;
      align-items: center !important;
      padding: 5px;
      padding-right: 10px;
      border-radius: 16px;
      color: #262626;
    }

    #toggleButton {
      width: max-content !important;
    }

</style>
@endsection

@section('content')
  <div class="page-header">
    <div class="page-title-text">Tambah Periode Akademik</div>
  </div>
  
  <a href="{{ route('academics-periode.index') }}" class="button-no-outline-left">
    <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Periode Akademik
  </a>
  <form action="{{ route('academics-periode.store') }}" method="POST">
    @csrf
    <div class="content-card">
      <div class="form-title-text" style="padding: 20px;">Buat Periode Akademik</div>
      <div class="form-section">
        <input type="hidden" id="user_id" value="">
        <div class="form-group">
          <label for="year">Tahun</label>
          <div class="year-wrapper">
            <div class="year-input">
              <input type="text" id="year" class="form-control" name="year" value="" placeholder="Tahun" readonly />
              <img src="{{ asset('assets/base/icon-calendar.svg')}}" alt="Icon Calendar">
              <span class="year-input-right-label">Years</span>
            </div>
            <div id="Year-dropdown">
              @for($i = date('Y'); $i < date('Y') + 5; $i++)
                <div data-year="{{$i}}">{{$i}}</div>
              @endfor
            </div>
          </div>
        </div>
      <div class="form-group">
        <label for="">Semester</label>
        <div class="checkbox-group">
          <div class="checkbox-form">
            <input type="radio" id="ganjil" class="form-check-input" value="ganjil" name="semester">
            <label for="ganjil" style="margin-left: 4px;">Ganjil</label>
          </div>
          <div class="checkbox-form">
            <input type="radio" id="genap" class="form-check-input" value="genap" name="semester">
            <label for="genap" style="margin-left: 4px;">Genap</label>
          </div>
          <div class="checkbox-form">
            <input type="radio" id="pendek" class="form-check-input" value="pendek" name="semester">
            <label for="pendek" style="margin-left: 4px;">Pendek</label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="tahun_akademik">Tahun Akademik</label>
        <div class="form-inline">
            <input type="text" id="tahun_akademik" class="form-control" readonly name="tahun_akademik" value="" placeholder='Auto Fill (Tahun yang dipilih +"/"+ Tahun berikutnya)'>
        </div>
      </div>
      <div class="form-inline">
        <div class="form-group">
          <label for="tanggal-mulai">Tanggal Mulai</label>
          <div class="calendar-input">
            <input type="text" id="tanggal-mulai" class="form-control" name="tanggal_mulai" value="" placeholder="dd-mm-yyyy, hh:mm">
            <img src="{{ asset('assets/base/icon-calendar.svg')}}" alt="Icon Calendar">
          </div>
        </div>
        <div class="form-group">
          <label for="tanggal-akhir">Tanggal Berakhir</label>
          <div class="calendar-input">
            <input type="text" id="tanggal-akhir" class="form-control" name="tanggal_akhir" value="" placeholder="dd-mm-yyyy, hh:mm">
            <img src="{{ asset('assets/base/icon-calendar.svg')}}" alt="Icon Calendar">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <div class="info-group">
          <textarea id="deskripsi" cols="110" rows="10" class="form-control" name="deskripsi" value="" placeholder="Tulis deskripsi disini" id="deskripsi"></textarea>
          <div class="info-section">
            <span class="info-text">Maksimal 280 Karakter</span>
            <span class="info-text" id="Length-display">0/280</span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>Status</label>
        <button id="toggleButton" type="button" class="btn-toggle">
          <img src="{{ asset('components/toggle-off-disabled-true.svg') }}" alt="Toggle Icon" id="toggleIcon">
          <span class="toggle-info text-sm-bd" style="color: var(--Neutral-Gray-600, #8C8C8C)">Tidak Aktif</span>
        </button>
        <input type="hidden" name="status" id="statusValue" value="inactive">
      </div>
      <div class="button-group">
        <button type="button" class="button button-clean" id="btnBatal">Batal</button>
        <button type="button" class="button button-outline" id="btnSimpan" style="padding: 8px 54.5px; margin: 0px;" disabled>Simpan</button>
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
          <div>Apakah anda yakin informasi yang ditambah sudah benar?</div>
        </div>
        <div class="modal-custom-footer">
          <button type="button" class="button button-clean" id="btnCekKembali">Cek Kembali</button>
          <button type="submit" class="button button-outline" id="btnYaSimpan">Ya, Simpan Sekarang</button>
        </div>
      </div>
    </div>
  </form>
      
  <script src="{{asset('js/plugins/flatpckr.js')}}"></script>
  <script src="{{asset('js/plugins/flatpckr-id.js')}}"></script>
  <script>
      document.addEventListener('DOMContentLoaded', () => {
          const maxWord = 280;

          const btnToggle   = document.getElementById('toggleButton');
          const icon        = document.getElementById('toggleIcon');
          const text        = btnToggle.querySelector('.toggle-info');

          const hiddenInput = document.getElementById('statusValue');
          const tahun       = document.getElementById('year');
          const deskripsi   = document.getElementById('deskripsi');
          const tanggalMulai = document.getElementById('tanggal-mulai');
          const tanggalAkhir = document.getElementById('tanggal-akhir');
          let tanggalMulaiInput, tanggalAkhirInput;
          
          const btnSave     = document.getElementById('btnSimpan');
          
          function updateSaveButtonState() {
            const descriptionFilled = deskripsi.value.trim() !== '' && deskripsi.value.length <= maxWord;
            const tahunFilled = tahun.value !== '';
            const startDateFilled = tanggalMulai.value !== '' && (tanggalMulaiInput.selectedDates[0] < tanggalAkhirInput.selectedDates[0]);
            const endDateFilled = tanggalAkhir.value !== '' && (tanggalAkhirInput.selectedDates[0] > tanggalMulaiInput.selectedDates[0]);

            const semester = document.querySelector('input[name="semester"]:checked');
            const semesterOptionFilled = semester ? true : false;
            
            if (descriptionFilled && tahunFilled && semesterOptionFilled && startDateFilled && endDateFilled) {
              btnSave.disabled = false;
            } else {
              btnSave.disabled = true;
            }
          }
  
          btnSave.addEventListener('click', function() {
            document.getElementById('modalKonfirmasiSimpan').style.display = 'block';
          });
  
          document.getElementById('btnBatal').addEventListener('click', function() {
            window.location.href = "{{ route('academics-periode.index') }}";
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

          tahun.addEventListener('change', updateSaveButtonState);
  
          const option = ['ganjil', 'genap', 'pendek'];
          option.map((value) => {
            const label = document.querySelector(`label[for=${value}]`);
            const fieldForm = document.getElementById(value);
            
            label.style.color = "#8C8C8C";
  
            fieldForm.addEventListener('change', function () {
              const exceptionField = option.filter(value => value != fieldForm.value);
              exceptionField.map((field) => {
                const exceptionLabel = document.querySelector(`label[for=${field}]`);
                exceptionLabel.style.color = "#8C8C8C";
              });
              if(fieldForm.value == value) label.style.color = "#262626";
              else label.style.color = "#8C8C8C";
            });
          })
          
          deskripsi.addEventListener('input', function (e) {
            const lengthDisplay = document.getElementById('Length-display');
            const word = e.target.value;
            let splitWord = word.split('');
            
            if(splitWord.length >= maxWord) {
              lengthDisplay.style.color = "#E62129";
            } else {
              lengthDisplay.style.color = "#8C8C8C";
            }
            
            if(splitWord.length > maxWord) {
              splitWord = splitWord.slice(0, maxWord).join("");
              deskripsi.value = splitWord;
            }
  
            lengthDisplay.textContent = `${splitWord.length}/${maxWord}`;
            updateSaveButtonState();
          });
  
          tanggalMulaiInput = flatpickr("#tanggal-mulai", {
            locale: 'id',
            enableTime: true,
            dateFormat: "d-m-Y, H:i",
            time_24hr: true,
            onChange: (selectedDates) => {
              if(selectedDates.length > 0) {
                tanggalAkhirInput.set('minDate', selectedDates[0]);
              } else {
                tanggalAkhirInput.set('minDate', null);
              }
            } 
          }); 
  
          tanggalAkhirInput = flatpickr("#tanggal-akhir", {
            locale: 'id',
            enableTime: true,
            dateFormat: "d-m-Y, H:i",
            time_24hr: true,
            onChange: (selectedDates) => {
              if(selectedDates.length > 0) {
                tanggalMulaiInput.set('maxDate', selectedDates[0]);
              } else {
                tanggalMulaiInput.set('maxDate', null);
              }
            } 
          });

          tanggalMulai.addEventListener('change', () => {
            updateSaveButtonState();
          });

          tanggalAkhir.addEventListener('change', () => {
            updateSaveButtonState();
          });

          const listYear = Array.from(document.querySelectorAll('#Year-dropdown div'));
          listYear.map(year => {
            year.addEventListener('click', () => {
              const value = year.getAttribute('data-year');
              document.getElementById('year').value = value;
              document.getElementById('tahun_akademik').value = `${value}/${+value + 1}`;
            })
          });
          
          const yearInput = document.querySelector('.year-input');
          document.addEventListener('click', (e) => {
            const year = e.target.closest('.year-input');
            const yearDropdown = document.querySelector('#Year-dropdown');

            if(year !== null) {
              if(yearDropdown.style.display == "flex"){
                yearDropdown.style.display = "none";
                year.querySelector('img').src = "{{ asset('assets/base/icon-calendar.svg')}}"
              }else{
                yearDropdown.style.display = "flex";
                year.querySelector('img').src = "{{ asset('assets/active/icon-calendar.svg')}}"
              }
            } else {
              yearDropdown.style.display = "none";
              yearInput.querySelector('img').src = "{{ asset('assets/base/icon-calendar.svg')}}"
            }
          });
  
          const calendarInput = Array.from(document.getElementsByClassName('calendar-input'));
          calendarInput.map(value => {
            const img = value.querySelector('img');
            const input = value.querySelector('input');
            value.addEventListener('click', () => {
              input.focus();
            });
            input.addEventListener('focus', () => {
              img.src = "{{ asset('assets/active/icon-calendar.svg')}}";
            });
            input.addEventListener('blur', () => {
              img.src = "{{ asset('assets/base/icon-calendar.svg')}}";
            });
          });
        });
  </script>
@endsection
