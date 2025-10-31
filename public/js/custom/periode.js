function onClickDetailPeriodeAcademic(element, route) {
  const idPeriode = element.getAttribute('data-periode-akademik');
  if (idPeriode) {
    $.ajax({
      url: route,
      method: 'GET',
      data: { id: idPeriode },
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
      success: function(html) {
        $('#periodeDetailModalContainer').html(html);
        $('#modalPeriodeAkademik').removeClass('hidden').addClass('flex');
      }
    });
  }
}

function onClickDeletePeriodeAcademic(element, redirectRoute) {
  const id = document.getElementById('modalKonfirmasiHapus').getAttribute('data-id');
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  $.ajax({
    url: "/academics/periode/delete/" + id,
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': csrfToken,
      'X-Requested-With': 'XMLHttpRequest'
    },
    success: function(response) {
      console.log(response);
      const modalKonfirmasiHapus = document.getElementById('modalKonfirmasiHapus');
      modalKonfirmasiHapus.removeAttribute('data-id');
      modalKonfirmasiHapus.classList.add('hidden');
      modalKonfirmasiHapus.classList.remove('flex');
      successToast('Berhasil dihapus');
      setTimeout(() => {
        window.location.href = redirectRoute;
      }, 5000);
    },
    error: function() {
      $('tbody').html(
        '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
      );
    }
  });
}

const tahun = document.querySelector('#Year-Input #year');
const deskripsi = document.getElementById('deskripsi');
const tanggalMulai = document.getElementById('tanggal-mulai');
const tanggalAkhir = document.getElementById('tanggal-akhir');

let tanggalMulaiInput, tanggalAkhirInput;

function updateNewStateButton() {
  const btnSave = document.getElementById('btnSimpan');

  const descriptionFilled = (deskripsi.value !== null && deskripsi.value.trim() !== '') && deskripsi.value.length <= 280;
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

function initCalendar() {
  tanggalMulaiInput = flatpickr("#tanggal-mulai", {
    locale: 'id',
    enableTime: true,
    dateFormat: "d-m-Y, H:i",
    time_24hr: true,
    onChange: (selectedDates) => {
      if (selectedDates.length > 0) {
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
      if (selectedDates.length > 0) {
        tanggalMulaiInput.set('maxDate', selectedDates[0]);
      } else {
        tanggalMulaiInput.set('maxDate', null);
      }
    }
  });
}

function initMaxAndMinCalendar() {
  const startVal = document.querySelector("#tanggal-mulai").value;
  const endVal = document.querySelector("#tanggal-akhir").value;

  if (startVal) {
    const parsedStart = tanggalMulaiInput.parseDate(startVal, "d-m-Y, H:i");
    tanggalAkhirInput.set('minDate', parsedStart);
  }

  if (endVal) {
    const parsedEnd = tanggalAkhirInput.parseDate(endVal, "d-m-Y, H:i");
    tanggalMulaiInput.set('maxDate', parsedEnd);
  }
}