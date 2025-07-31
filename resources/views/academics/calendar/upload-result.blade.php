@extends('layouts.main')

@section('title', 'Kalender Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Lihat Event Kalender Akademik</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/plugins/flatpckr.css') }}" />
<style>
  .center {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 24px;
  }

  .center .btn-icon {
    display: flex; 
    align-items: center;
    justify-items: center;
    text-decoration: none;
    gap: 2px;
    font-size: 12px;
  }

  .center .btn-delete-event-academic {
    color: #8C8C8C;
  }

  .center .btn-view-event-academic {
    color: #262626;
  }

  .center .btn-edit-event-academic {
    color: #E62129;
  }

  .page-title-text.sub-title {
    font-size: 16px;
  }
  .card-header {
    padding-left: 0px;
    justify-content: start;
    justify-items: center;
    align-items: center;
  }
  .sort-dropdown.study {
      top: 11%;
      left: 25%;
      z-index: 999;
  }
  #StudyProgramSection {
    display: flex;
    flex-direction: row;
    gap: 8px;
    padding: 20px;
  }
  .sub-title {
    font-size: 14px;
    font-weight: 400;
  }
  .sub-title-value {
    font-weight: bold;
    font-size: 14px;
  }
  .table-title {
    background-color: #E9EDF4;
    border-bottom: 1px solid #D9D9D9;
    display: flex;
    justify-content: center;
    text-align: center;
    font-weight: bold;
    font-size: 16px;
    padding: 16px;
  }
  .button-outline {
    text-decoration: none;
  }

  .right {
    gap: 20px;
  }

  .left {
    gap: 20px;
    margin-left: 20px;
  }

  .modal-custom-content {
      max-width: 600px;
      z-index: 2;
      align-items: center;
      gap: 16px;
      align-self: auto;
      top: 100px;
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
  .modal-custom {
    align-items: start;
  }
  .modal-custom-footer.create-form {
    align-self: end;
    gap: 20px;
    padding: 20px;
  }

  .modal-custom-footer {
    gap: 20px;
    padding: 20px;
  }

  .modal-custom-body {
    align-self: start;
  }
  button.button {
    padding: 8px 54.5px !important;
    margin: 0px;
  }
  .text-lg-bd {
    padding: 20px;
    text-align: left;
    align-self: start;
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
  .form-group .filter-box {
    width: 100%;
    z-index: 999;
  }
  .sort-dropdown.select {
    position: absolute;
    top: 43%;
    left: 29.3%;
    width: 67.5%;
  }
  /* Custom tanggal terpilih */
  .flatpickr-day.selected,
  .flatpickr-day.startRange,
  .flatpickr-day.endRange {
      background-color: #dc2626 !important;
      /* merah */
      color: #fff !important;
      border-radius: 12px !important;
  }
  /* Hover efek */
  .flatpickr-day:hover {
      background-color: #fecaca !important;
      /* merah muda */
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
  .calendar-input {
      border: 1px solid #BFBFBF !important;
      display: flex !important;
      align-items: center !important;
      border-radius: 8px;
      width: 100%;
      color: #262626;
  }
  .calendar-input img {
    margin-right: 10px;
  }
  .calendar-input input {
    background-color: white !important;
    outline: none !important;
    border: none !important;
  }
</style>
@endsection

@section('javascript')
<script src="{{ asset('js/plugins/flatpckr.js') }}"></script>
<script src="{{ asset('js/plugins/flatpckr-id.js') }}"></script>
<script>
  function sortTable(value) {
      $.ajax({
          url: "{{ route('calendar.index') }}",
          method: 'GET',
          data: { 
              sort: value 
          },
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
          success: function(response) {
              window.location.href = "{{ route('academics-event.index') }}" + '?sort=' + encodeURIComponent(value);
          },
          error: function() {
              $('tbody').html('<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>');
          }
      });
  }

  document.addEventListener('DOMContentLoaded', function () {

    document.addEventListener('click', function(e) {
      const addBtn = e.target.closest('.btn-add-event');
      if (addBtn) {
        document.getElementById('modalKonfirmasiUpload').style.display = 'flex';
      }
    });

    document.getElementById('btnSimpan').addEventListener('click', function() {
      const id = document.getElementById('modalKonfirmasiUpload').getAttribute('data-id');
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      $.ajax({
          url: "{{ route('academics-event.delete', ['id' => ':id']) }}".replace(':id', id),
          method: 'DELETE',
          headers: { 
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
          },
          success: function(response) {
            document.getElementById('modalKonfirmasiUpload').removeAttribute('data-id');
            document.getElementById('modalKonfirmasiUpload').style.display = 'none';
            successToast('Berhasil dihapus');
            setTimeout(() => {
              window.location.href = "{{ route('academics-event.index') }}";
            }, 5000);
          },
          error: function() {
              $('tbody').html('<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>');
          }
      });
    });
  
    document.getElementById('btnCekKembaliSebelumHapus').addEventListener('click', function() {
      document.getElementById('modalKonfirmasiUpload').removeAttribute('data-id');
      document.getElementById('modalKonfirmasiUpload').style.display = 'none';
    });
  });

</script>
@endsection

@if(session('success'))
<script>
  document.addEventListener('DOMContentLoaded', function () {
    successToast("{{ session('success') ?? 'Berhasil disimpan' }}");
    setTimeout(() => {
      window.location.href = "{{ route('calendar.show', ['id' => $id]) }}";
    }, 3000);
  })
</script>
@endif

@section('content')
    <div class="page-header">
        <div class="page-title-text">Unggah Event Kalender Akademik</div>
    </div>
    <a href="{{ route('calendar.upload', ['id' => $id]) }}" class="button-no-outline-left">
        <img src="{{ asset('assets/active/icon-arrow-left.svg') }}" alt="Kembali"> Unggah Event
    </a>
    <div class="content-card">
      <div class="card-header">
        <h1 class="page-title-text">Impor Event Kalender Akademik</h1>
        <img src="{{ asset('assets/icon-caution.svg')}}" alt="icon-caution">
      </div>
      <div class="table-responsive">
        <div class="table-title">Event Kalender Akademik</div>
          <table class="table" id="list-user" style="--table-cols:7;">
              <thead>
                  <tr>
                      <th>Nama Event</th>
                      <th>Tanggal Mulai</th>
                      <th>Tanggal Selesai</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($data as $d)
                  <tr>
                      <td>{{$d['name_event']}}</td>
                      <td>{{(new DateTime($d['tanggal_mulai']))->format('d')." ".$month[(int)(new DateTime($d['tanggal_mulai']))->format('m')]." ".(new DateTime($d['tanggal_mulai']))->format('Y, H:i')}}</td>
                      <td>{{(new DateTime($d['tanggal_selesai']))->format('d')." ".$month[(int)(new DateTime($d['tanggal_selesai']))->format('m')]." ".(new DateTime($d['tanggal_selesai']))->format('Y, H:i')}}</td>
                  </tr>
                 @endforeach
              </tbody>
          </table>
      </div>
      <div class="card-header">
        <div class="right">
          <a href="{{route('calendar.upload', ['id' => $id])}}" class="button-clean" id="">
              <span>Batal</span>
          </a>
          <button class="button-outline btn-add-event">Simpan</a>
        </div>
      </div>

      <form action="{{route('calendar.save', ['id' => $id])}}" method="POST">
        @csrf
        @foreach($data as $index => $event)
          <input type="hidden" name="data[{{$index}}][name_event]" value="{{$event['name_event']}}">
          <input type="hidden" name="data[{{$index}}][tanggal_mulai]" value="{{$event['tanggal_mulai']}}">
          <input type="hidden" name="data[{{$index}}][tanggal_selesai]" value="{{$event['tanggal_selesai']}}">
        @endforeach
        <div id="modalKonfirmasiUpload" class="modal-custom" style="display:none;">
          <div class="modal-custom-backdrop"></div>
          <div class="modal-custom-content">
            <div class="modal-custom-header">
              <span class="text-lg-bd">Tunggu Sebentar</span>
              <img src="{{ asset('assets/icon-caution.svg')}}" alt="icon-caution">
            </div>
            <div class="modal-custom-body">
              <div>Apakah anda yakin untuk menyimpan Event Kalender Akademik dari (csv/xlsx)?</div>
            </div>
            <div class="modal-custom-footer">
              <button type="button" class="button button-clean" id="btnCekKembaliSebelumHapus">Tidak</button>
              <button type="submit" class="button button-outline" id="btnSimpan">Ya, Simpan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
@endsection
