<script>
  let editTanggalMulaiInput, editTanggalSelesaiInput;
  
  function onClickShowEditModal(element, listData) {
    const modalEditEvent = document.getElementById('modalEditEvent');
    const button = modalEditEvent.querySelector('#sortEvent');

    const id = element.getAttribute('data-id');
    const data = listData.find(list => list.id == id);
    
    modalEditEvent.querySelector('input[name="name_event"]').value = data.id_event;
    modalEditEvent.querySelector('input[name="status"]').value = data.status;
    modalEditEvent.querySelector('input[name="id_calendar"]').value = data.id;
  
    button.innerHTML = button.innerHTML.replace('Pilih Event', data.nama_event);
    button.classList.add('text-black');
    modalEditEvent.classList.add('flex');
    modalEditEvent.classList.remove('hidden');

    editTanggalMulaiInput = flatpickr("#tanggal-mulai", {
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

    editTanggalSelesaiInput = flatpickr("#tanggal-akhir", {
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
  }

  function updateSaveEditButtonState() {
    const modalEditEvent = document.getElementById('modalEditEvent');

    const eventNameFilled = modalEditEvent.querySelector('input[name="name_event"]').value.trim() !== '';
    const startDateFilled = modalEditEvent.querySelector('input[name="tanggal_mulai"]').value !== '' && (editTanggalMulaiInput.selectedDates[0] < editTanggalSelesaiInput.selectedDates[0]);
    const endDateFilled = modalEditEvent.querySelector('input[name="tanggal_selesai"]').value !== '' && (editTanggalSelesaiInput.selectedDates[0] > editTanggalMulaiInput.selectedDates[0]);

    if (eventNameFilled && startDateFilled && endDateFilled) {
        modalEditEvent.querySelector('#btnSimpan').disabled = false;
    } else {
        modalEditEvent.querySelector('#btnSimpan').disabled = true;
    }
  }
</script>

<form action="{{route('calendar.update', ['id' => $id])}}" method="POST">
  @csrf
  @method('PUT')
  <x-modal.container-pure-js id="modalEditEvent">
    <x-slot name="header">
      <span class="text-lg-bd">Ubah Event Akademik</span>
    </x-slot>
    <x-slot name="body">
      <x-form.input-container class="min-w-[120px]">
        <x-slot name="label">Nama Event</x-slot>
        <x-slot name="input">
          <x-form.dropdown 
            :buttonId="'sortEvent'"
            :dropdownId="'eventList'"
            :label="'Pilih Event'"
            :imgSrc="asset('assets/base/icon-arrow-down.svg')"
            :isIconCanRotate="true"
            :dropdownItem="array_column($eventAkademik, 'id', 'nama_event')"
            :buttonStyleClass="'!border-[#D9D9D9] hover:!bg-[#D9D9D9]'"
            :isUsedForInputField="true"
            :inputFieldName="'name_event'"
          />
          <input type="hidden" value="" name="name_event">
          <input type="hidden" value="" name="status">
          <input type="hidden" value="" name="id_calendar">
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[120px]">
        <x-slot name="label">Tanggal Mulai</x-slot>
        <x-slot name="input">
          <x-form.calendar id="tanggal-mulai" name="tanggal_mulai" oninput="updateSaveEditButtonState()" />
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[120px]">
        <x-slot name="label">Tanggal Selesai</x-slot>
        <x-slot name="input">
          <x-form.calendar id="tanggal-akhir" name="tanggal_selesai" oninput="updateSaveEditButtonState()" />
        </x-slot>
      </x-form.input-container>
    </x-slot>
    <x-slot name="footer">
      <x-button.secondary 
        onclick="
          document.getElementById('modalEditEvent').classList.add('hidden');
          document.getElementById('modalEditEvent').classList.remove('flex');
        "
      >
        Batal
      </x-button.secondary>
      <x-button.primary 
        onclick="
          document.querySelector('#modalKonfirmasiEdit').classList.add('flex');
          document.querySelector('#modalKonfirmasiEdit').classList.remove('hidden');
          document.querySelector('#modalEditEvent').classList.add('hidden');
          document.querySelector('#modalEditEvent').classList.remove('flex');
        " 
        disabled 
        id="btnSimpan"
      >
        Simpan
      </x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
  <x-modal.container-pure-js id="modalKonfirmasiEdit">
    <x-slot name="header">
      <span class="text-lg-bd">Tunggu Sebentar</span>
      <img src="{{ asset('assets/base/icon-caution.svg') }}" alt="ikon peringatan">
    </x-slot>
    <x-slot name="body">
      <div>Apakah Anda yakin informasi yang ditambah sudah benar?</div>
    </x-slot>
    <x-slot name="footer">
      <x-button.secondary 
        onclick="
          document.querySelector('#modalEditEvent').classList.add('flex');
          document.querySelector('#modalEditEvent').classList.remove('hidden');
          document.querySelector('#modalKonfirmasiEdit').classList.add('hidden');
          document.querySelector('#modalKonfirmasiEdit').classList.remove('flex');
        "
      >
        Cek Kembali
      </x-button.secondary>
      <x-button.primary type="submit">Ya, Simpan Sekarang</x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
</form>