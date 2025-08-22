<script>
  document.addEventListener('DOMContentLoaded', function () {
    const listData = @json($data);
    const modalEditEvent = document.querySelector('#modalEditEvent');
    const sortEditBtnEventName = modalEditEvent.querySelector('#sortEvent');
    const sortEditDropdownEventName  = modalEditEvent.querySelector('#eventList');
    const eventNameData = modalEditEvent.querySelector('input[name="name_event"]');
    const eventStatusData = modalEditEvent.querySelector('input[name="status"]');
    const idCalendar = modalEditEvent.querySelector('input[name="id_calendar"]');
    const eventAkademik = @json($eventAkademik);
    let editTanggalMulaiInput, editTanggalSelesaiInput;

    modalEditEvent.querySelectorAll('#eventList .dropdown-item').forEach((dropdownItem) => {
      dropdownItem.addEventListener('click', () => {
        const value = dropdownItem.getAttribute('data-event');
        const span = sortEditBtnEventName.querySelector('span');

        span.innerHTML = dropdownItem.innerHTML;
        span.style.color = "black";
        eventNameData.value = value;
        updateSaveEditButtonState();
      });
    });

    sortEditBtnEventName.addEventListener('click', function (e) {
        e.stopPropagation();
        sortEditDropdownEventName.style.display = (sortEditDropdownEventName.style.display === 'block') ? 'none' : 'block';
        sortEditBtnEventName.querySelector('img').src = (sortEditBtnEventName.querySelector('img').src === "{{ asset('assets/icon-arrow-up-black-20.svg') }}") ? "{{ asset('assets/icon-arrow-down-grey-20.svg') }}" : "{{ asset('assets/icon-arrow-up-black-20.svg') }}";
    });

    document.addEventListener('click', (e) => {
      const dropdownStudy = e.target.closest('#eventNameList');
      if(dropdownStudy == null){
        sortEditDropdownEventName.style.display = 'none'
        sortEditBtnEventName.querySelector('img').src = "{{ asset('assets/icon-arrow-down-grey-20.svg') }}";
      }
    });
    
    document.querySelectorAll('.btn-edit-event-academic').forEach((btn) => {
      btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-id');
        const data = listData.find(list => list.id == id);
        const span = modalEditEvent.querySelector('#sortEvent span');
        modalEditEvent.querySelector('input[name="name_event"]').value = data.id_event;
        modalEditEvent.querySelector('input[name="status"]').value = data.status;
        modalEditEvent.querySelector('input[name="id_calendar"]').value = data.id;
      
        span.innerHTML = data.nama_event;
        span.style.color = "black";
        modalEditEvent.style.display = 'block';

        editTanggalMulaiInput = flatpickr("#modalEditEvent #tanggal-mulai", {
            locale: 'id',
            enableTime: true,
            dateFormat: "d-m-Y, H:i",
            time_24hr: true,
            onChange: function (selectedDates) {
                if (selectedDates.length > 0 && editTanggalSelesaiInput) {
                    editTanggalSelesaiInput.set('minDate', selectedDates[0]);
                }
            },
            onReady: function (selectedDates, dateStr, instance) {
                if (data?.tanggal_awal) {
                    instance.setDate(new Date(data.tanggal_awal), false); // false: jangan trigger onChange
                }
            }
        });

        editTanggalSelesaiInput = flatpickr("#modalEditEvent #tanggal-akhir", {
            locale: 'id',
            enableTime: true,
            dateFormat: "d-m-Y, H:i",
            time_24hr: true,
            onChange: function (selectedDates) {
                if (selectedDates.length > 0 && editTanggalMulaiInput) {
                    editTanggalMulaiInput.set('maxDate', selectedDates[0]);
                }
            },
            onReady: function (selectedDates, dateStr, instance) {
                if (data?.tanggal_akhir) {
                    instance.setDate(new Date(data.tanggal_akhir), false);
                }
            }
        });

        editTanggalSelesaiInput.set('minDate', new Date(data.tanggal_awal));
        editTanggalMulaiInput.set('maxDate', new Date(data.tanggal_akhir));

        updateSaveEditButtonState();
      })
    });
    

    modalEditEvent.querySelector('#btnBatal').addEventListener('click', () => {
      modalEditEvent.style.display = 'none';
    });

    function updateSaveEditButtonState() {
      const eventNameFilled = modalEditEvent.querySelector('input[name="name_event"]').value.trim() !== '';
      const startDateFilled = modalEditEvent.querySelector('input[name="tanggal_mulai"]').value !== '' && (editTanggalMulaiInput.selectedDates[0] < editTanggalSelesaiInput.selectedDates[0]);
      const endDateFilled = modalEditEvent.querySelector('input[name="tanggal_selesai"]').value !== '' && (editTanggalSelesaiInput.selectedDates[0] > editTanggalMulaiInput.selectedDates[0]);
      if (eventNameFilled && startDateFilled && endDateFilled) {
          modalEditEvent.querySelector('#btnSimpan').disabled = false;
      } else {
          modalEditEvent.querySelector('#btnSimpan').disabled = true;
      }
    }
  });
</script>
<div id="modalEditEvent" class="modal-custom" style="display:none;">
  <div class="modal-custom-backdrop"></div>
  <form action="{{route('calendar.update', ['id' => $id])}}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-custom-content">
      <span class="text-lg-bd">Ubah Event Akademik</span>
      <div class="modal-custom-body">
        <div class="form-group">
            <label for="name">Nama Event</label>
            <div class="filter-box" id="eventNameList">
              <button type="button" class="button-clean input" id="sortEvent">
                  <span>Pilih Event</span>
                  <img src="{{ asset('assets/icon-arrow-down-grey-20.svg') }}" alt="Filter">
              </button>
              <div id="eventList" class="sort-dropdown select" style="display: none;">
                  @foreach ($eventAkademik as $event)
                      <div class="dropdown-item" data-event="{{ $event->id }}">
                          {{ $event->nama_event }}
                      </div>
                  @endforeach
              </div>
              <input type="hidden" value="" name="name_event">
              <input type="hidden" value="" name="status">
              <input type="hidden" value="" name="id_calendar">
            </div>
        </div>
        <div class="form-group">
            <label for="tanggal-mulai">Tanggal Mulai</label>
            <div class="calendar-input">
                <input type="text" id="tanggal-mulai" class="form-control" name="tanggal_mulai"
                    value="" placeholder="dd-mm-yyyy, hh:mm">
                <img src="{{ asset('assets/base/icon-calendar.svg') }}" alt="Icon Calendar">
            </div>
        </div>
        <div class="form-group">
            <label for="tanggal-akhir">Tanggal Selesai</label>
            <div class="calendar-input">
                <input type="text" id="tanggal-akhir" class="form-control" name="tanggal_selesai"
                    value="" placeholder="dd-mm-yyyy, hh:mm">
                <img src="{{ asset('assets/base/icon-calendar.svg') }}" alt="Icon Calendar">
            </div>
        </div>
      </div>
      <div class="modal-custom-footer create-form">
        <button type="button" class="button button-clean" id="btnBatal">Batal</button>
        <button type="submit" class="button button-outline" id="btnSimpan" disabled>Simpan</button>
      </div>
    </div>
  </form>
</div>
<div id="modalKonfirmasiSimpan" class="modal-custom" style="display:none;">
    <div class="modal-custom-backdrop"></div>
    <div class="modal-custom-content">
        <div class="modal-custom-header">
            <span class="text-lg-bd">Tunggu Sebentar</span>
            <img src="{{ asset('assets/base/icon-caution.svg') }}" alt="ikon peringatan">
        </div>
        <div class="modal-custom-body">
            <div>Apakah Anda yakin informasi yang ditambah sudah benar?</div>
        </div>
        <div class="modal-custom-footer">
            <button type="button" class="button button-clean" id="btnCekKembali">Cek Kembali</button>
            <button type="button" class="button button-outline" id="btnYaSimpan">Ya, Simpan Sekarang</button>
        </div>
    </div>
</div>