var tanggalMulaiInput, tanggalSelesaiInput;
var editTanggalMulaiInput, editTanggalSelesaiInput;

function initCalendar() {
  tanggalSelesaiInput = flatpickr("#create-tanggal-akhir", {
      locale: 'id',
      enableTime: true,
      dateFormat: "d-m-Y, H:i",
      time_24hr: true,
      onChange: (selectedDates) => {
          if (selectedDates.length > 0 && tanggalMulaiInput) {
              tanggalMulaiInput.set('maxDate', selectedDates[0]);
          } else if (tanggalMulaiInput) {
              tanggalMulaiInput.set('maxDate', null);
          }
      },
  });

  tanggalMulaiInput = flatpickr("#create-tanggal-mulai", {
      locale: 'id',
      enableTime: true,
      dateFormat: "d-m-Y, H:i",
      time_24hr: true,
      onChange: (selectedDates) => {
          if (selectedDates.length > 0 && tanggalSelesaiInput) {
              tanggalSelesaiInput.set('minDate', selectedDates[0]);
          } else if (tanggalSelesaiInput) {
              tanggalSelesaiInput.set('minDate', null);
          }
      },
  });
}

function updateSaveButtonState(element = document, startInput, endInput) {
  const eventName = element.querySelector('input[name="name_event"]');
  const tanggalMulai = element.querySelector('input[name="tanggal_mulai"]');
  const tanggalSelesai = element.querySelector('input[name="tanggal_selesai"]');
  const btnSave = element.querySelector('#btnSimpan');

  
  const eventNameFilled = eventName.value.trim() !== '';
  const startDateFilled = tanggalMulai.value !== '' && (startInput.selectedDates[0] <= endInput.selectedDates[0]);
  const endDateFilled = tanggalSelesai.value !== '' && (endInput.selectedDates[0] >= startInput.selectedDates[0]);

  if (eventNameFilled && startDateFilled && endDateFilled) {
      btnSave.disabled = false;
  } else {
      btnSave.disabled = true;
  }
}
  
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

  setTimeout(() => { updateSaveButtonState(modalEditEvent, editTanggalMulaiInput, editTanggalSelesaiInput) }, 0);
}

function onClickShowConfirmationDeleteEvent(element) {
  const modalKonfirmasiHapus = document.getElementById('modalKonfirmasiHapus');
  modalKonfirmasiHapus.setAttribute('data-id', element.getAttribute('data-id'));
  modalKonfirmasiHapus.classList.add('flex');
  modalKonfirmasiHapus.classList.remove('hidden');
}

function onDeleteEvent(requestRoute, redirectedRoute) {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  $.ajax({
    url: requestRoute,
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': csrfToken,
      'X-Requested-With': 'XMLHttpRequest'
    },
    success: function(response) {
      document.getElementById('modalKonfirmasiHapus').removeAttribute('data-id');
      document.getElementById('modalKonfirmasiHapus').classList.add('hidden');
      document.getElementById('modalKonfirmasiHapus').classList.remove('flex');
      successToast('Berhasil dihapus');
      setTimeout(() => {
        window.location.href = redirectedRoute;
      }, 5000);
    },
    error: function() {
      $('tbody').html(
        '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
      );
    }
  });
}