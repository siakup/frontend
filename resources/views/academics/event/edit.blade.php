@extends('layouts.main')

@section('title', 'Edit Event Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik Event</div>
@endsection

@section('css')
<style>
  .checkbox-group {
    display: flex;
    gap: 60px;
  }

  .checkbox-form {
    display: flex;
    gap: 8px;
  }

  .checkbox-form label {
    width: max-content;
    font-weight: 400;
    font-size: 14px;
  }

  .checkbox-form input {
    accent-color: #E62129;
    border-radius: 3px;
  }
  .modal-custom {
      position: fixed;
      inset: 0;
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
  }
  .modal-custom-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.25); 
      z-index: 1;
  }
  .modal-custom-content {
      position: relative;
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.12);
      /* padding: 32px 32px 24px 32px; */
      width: 40vw; 
      min-width: 340px;
      max-width: 600px;
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 16px;
  }
  .modal-custom-header {
      border-radius: 12px 12px 0px 0px;
      border: 1px solid var(--Surface-Border-Primary, #D9D9D9);
      background: var(--Background-Disable-White, #F5F5F5);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      align-self: stretch;
  }
  .modal-custom-header span {
    margin-right: auto;
    text-align: center;
    width: 100%;
  }
  .modal-custom-header img {
    margin-left: auto;
  }
  .modal-custom-footer {
      display: flex;
      justify-content: flex-start;
  }
  /* Custom dropdown style for modal select */
  .modal-custom-content select.form-control {
      width: 100%;
      padding: 10px 36px 10px 16px;
      border: 1px solid var(--Surface-Border-Secondary, #BFBFBF);
      border-radius: 8px;
      font-family: Poppins;
      font-size: 14px;
      font-weight: 400;
      color: var(--Surface-Border-Secondary, #BFBFBF); /* grey for placeholder */
      background: var(--Neutral-Gray-50, #FFF) url('/icons/icon-arrow-down-grey-24.svg') no-repeat right 16px center/18px 18px;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      box-sizing: border-box;
      outline: none;
      transition: border 0.2s;
      height: 40px;
  }
  .modal-custom-content select.form-control:focus {
      border-color: var(--Red-Red-500, #E62129);
  }
  .modal-custom-content select.form-control option {
      color: #222;
  }
  .modal-custom-content select.form-control option[value=""] {
      color: var(--Surface-Border-Secondary, #BFBFBF) !important;
  }
  .modal-custom-content select.form-control option[disabled][hidden] {
      color: var(--Surface-Border-Secondary, #BFBFBF) !important;
  }
  .modal-custom-content select.form-control:not(:focus):not([value=""]):not(:invalid) {
      color: #222;
  }
  .modal-custom-content select.form-control:focus:not([value=""]):not(:invalid) {
      color: #222;
  }
  /* Highlight selected option in dropdown with red background */
  .modal-custom-content select.form-control option:checked {
      background: var(--Red-Red-500, #E62129) !important;
      color: #fff !important;
  }
  /* Highlight hovered option in dropdown with red background */
  .modal-custom-content select.form-control option:hover {
      background: var(--Red-Red-500, #E62129) !important;
      color: #fff !important;
  }
  input.form-control[readonly] {
      background: var(--Neutral-Gray-200, #F5F5F5);
      color: var(--Neutral-Gray-600, #8C8C8C);
      border-color: var(--Neutral-Gray-300, #E8E8E8);
      cursor: not-allowed;
      opacity: 1;
  }
  @media (max-width: 900px) {
      .modal-custom-content {
          width: 90vw;
          min-width: unset;
          max-width: 98vw;
          padding: 16px;
      }
      .modal-custom-title { font-size: 18px; }
  }
</style>
@endsection

@section('javascript')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('toggleButton');
    const toggleIcon = document.getElementById('toggleIcon');
    const toggleInfo = document.querySelector('.toggle-info');
    let isActive = @json((bool) $data['status']); 
  
    if (isActive) {
        toggleIcon.src = "{{ asset('components/toggle-on-disabled-false.svg') }}";
        toggleInfo.textContent = "Aktif";
    } else {
        toggleIcon.src = "{{ asset('components/toggle-off-disabled-true.svg') }}";
        toggleInfo.textContent = "Tidak Aktif";
    }

    toggleButton.addEventListener('click', function(e) {
      e.preventDefault();
      isActive = !isActive;
      if (isActive) {
          toggleIcon.src = "{{ asset('components/toggle-on-disabled-false.svg') }}";
          toggleInfo.textContent = "Aktif";
      } else {
          toggleIcon.src = "{{ asset('components/toggle-off-disabled-true.svg') }}";
          toggleInfo.textContent = "Tidak Aktif";
      }
    });

    const btnBatalUbahEvent = document.getElementById('btnBatalUbahEvent');
    btnBatalUbahEvent.addEventListener("click", () => {
      window.location.href = "{{ route('academics-event.index') }}"
    });

    document.getElementById('btnSimpan').addEventListener('click', function() {
        document.getElementById('modalKonfirmasiSimpan').style.display = 'flex';
    });

    document.getElementById('btnCekKembali').addEventListener('click', function() {
        document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
    });
  })
</script>
@endsection

@section('content')
<form action="" method="POST">
  @csrf
  <div class="page-header">
      <div class="page-title-text">Edit Event Akademik</div>
  </div>

  <a href="{{ route('academics-event.index') }}" class="button-no-outline-left">
      <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Event Akademik
  </a>
  
  <div class="content-card">
    <div class="form-title-text" style="padding: 20px;">Edit Event Akademik</div>
      <div class="form-section">
        <input type="hidden" id="user_id" value="">
        <div class="form-group">
            <label for="name">Nama Event</label>
            <div class="input-by-search">
                <input type="text" id="name" class="form-control" value="{{$data['name']}}">
            </div>
        </div>
        <div class="form-group">
          <label>Flag</label>
          <div class="checkbox-group">
            <div class="checkbox-form">
              <input type="checkbox" class="form-control" value="true" @if($data['flag']['nilai']) checked @endif>
              <label>Nilai</label>
            </div>
            <div class="checkbox-form">
              <input type="checkbox" class="form-control" value="true" @if($data['flag']['irs']) checked @endif>
              <label>IRS</label>
            </div>
            <div class="checkbox-form">
              <input type="checkbox" class="form-control" value="true" @if($data['flag']['lulus']) checked @endif>
              <label>Lulus</label>
            </div>
            <div class="checkbox-form">
              <input type="checkbox" class="form-control" value="true" @if($data['flag']['registrasi']) checked @endif>
              <label>Registrasi</label>
            </div>
            <div class="checkbox-form">
              <input type="checkbox" class="form-control" value="true" @if($data['flag']['yudisium']) checked @endif>
              <label>Yudisium</label>
            </div>
            <div class="checkbox-form">
              <input type="checkbox" class="form-control" value="true" @if($data['flag']['survei']) checked @endif>
              <label>Survei</label>
            </div>
            <div class="checkbox-form">
              <input type="checkbox" class="form-control" value="true" @if($data['flag']['dosen']) checked @endif>
              <label>Dosen</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Status</label>
          <div class="toggle-row"></div>
          <button id="toggleButton" class="btn-toggle">
              <img src="{{ asset('components/toggle-off-disabled-true.svg') }}" alt="Toggle Icon" id="toggleIcon">
              <span class="toggle-info text-sm-bd">Tidak Aktif</span>
          </button>
          <input type="hidden" name="status" id="statusValue" value="false">
        </div>
      </div>
      <div style="display: flex; gap: 20px; justify-content: flex-end; margin: 20px;">
        <button type="button" class="button button-clean" id="btnBatalUbahEvent" style="padding: 8px 54.5px; margin: 0px;">Batal</button>
        <button type="button" class="button button-outline" id="btnSimpan" style="padding: 8px 54.5px; margin: 0px;">Simpan</button>
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
          <div>Apakah anda yakin informasi anda sudah benar?</div>
        </div>
        <div class="modal-custom-footer">
          <button type="button" class="button button-clean" id="btnCekKembali">Cek Kembali</button>
          <button type="submit" class="button button-outline" id="btnYaSimpan">Ya, Simpan Sekarang</button>
        </div>
      </div>
    </div>
</form>
@endsection