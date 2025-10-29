function updateSaveButtonState() {
  const programPerkuliahanFilled = document.querySelector('input[name="program_perkuliahan"]').value.trim() !== '';
  const namaFilled = document.querySelector('input[name="curriculum_nama"]').value.trim() !== '';
  const deskripsiFilled = document.querySelector('input[name="deskripsi"]').value.trim() !== '';
  const sksWajibFilled = document.querySelector('input[name="sks_wajib"]').value.trim() !== '';
  const sksPilihanFilled = document.querySelector('input[name="sks_pilihan"]').value.trim() !== '';
  const totalSKSFilled = document.querySelector('input[name="total_sks"]').value.trim() !== '';

  if (programPerkuliahanFilled && namaFilled && deskripsiFilled && sksWajibFilled && sksPilihanFilled && totalSKSFilled) {
    document.querySelector('#btnSimpan').disabled = false;
    document.querySelector('#btnBatal').disabled = false;
  } else {
    document.querySelector('#btnSimpan').disabled = true;
    document.querySelector('#btnBatal').disabled = true;
  }
}

function onClickDeleteCurriculum(element, redirectedRoute, requestRoute) {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  document.getElementById('modalKonfirmasiHapus').removeAttribute('data-id');
  document.getElementById('modalKonfirmasiHapus').classList.add('hidden');
  document.getElementById('modalKonfirmasiHapus').classList.remove('flex');
  successToast('Berhasil dihapus');
  setTimeout(() => {
    window.location.href = redirectedRoute
  }, 5000);
  // $.ajax({
  //     url: requestRoute,
  //     method: 'DELETE',
  //     headers: {
  //         'X-CSRF-TOKEN': csrfToken,
  //         'X-Requested-With': 'XMLHttpRequest'
  //     },
  //     success: function(response) {
  //         document.getElementById('modalKonfirmasiHapus').classList.add('hidden');
  //         document.getElementById('modalKonfirmasiHapus').classList.remove('flex');
  //         successToast('Berhasil dihapus');
  //         setTimeout(() => {
  //             window.location.href =
  //                redirectedRoute;
  //         }, 5000);
  //     },
  //     error: function() {
  //         $('tbody').html(
  //             '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
  //         );
  //     }
  // });
}

function updateSearchFormState() {
  const courseTypeFilled = document.querySelector('input[name="jenis_mata_kuliah"]').value.trim() !== '';
  const inputNamaFilled = document.querySelector('input#courseName[name="nama"]').value.trim() !== '';

  if(courseTypeFilled || inputNamaFilled) {
    document.querySelector('#btnCari').disabled = false;
  } else {
    document.querySelector('#btnCari').disabled = true;
  }
}

function onDeleteCourse(redirectedLink, requestRoute) {
  const dataId = document.getElementById('modalKonfirmasiHapus').getAttribute('data-id');
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  document.getElementById('modalKonfirmasiHapus').removeAttribute('data-id');
  document.getElementById('modalKonfirmasiHapus').style.display = 'none';
  successToast('Berhasil dihapus');
  setTimeout(() => {
    window.location.href = redirectedLink
  }, 5000);
//  $.ajax({
//      url: requestRoute,
//      method: 'DELETE',
//      headers: {
//          'X-CSRF-TOKEN': csrfToken,
//          'X-Requested-With': 'XMLHttpRequest'
//      },
//      success: function(response) {
//          document.getElementById('modalKonfirmasiSimpan').removeAttribute(
//              'data-id');
//          document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
//          successToast('Berhasil dihapus');
//          setTimeout(() => {
//              window.location.href = redirectedLink;
//          }, 5000);
//      },
//      error: function() {
//          $('tbody').html(
//              '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
//          );
//      }
//  });
}

function updateStateChangeCourse() {
  const semesterFilled = document.getElementById('semester').value.trim() !== '';
  if(semesterFilled) {
    document.querySelector('#btnSimpan').disabled = false;
  } else {
    document.querySelector('#btnSimpan').disabled = true;
  }
}

function onInputSemester (element) {
  updateStateChangeCourse();
  element.value = element.value.replace(/[^0-9]/g, '');
  const val = parseInt(element.value, 10);
  if (isNaN(val)) {
    element.value = '';
  } else if (val < 1) {
    element.value = '1';
  } else if (val > 8) {
    element.value = '8';
  } else {
    element.value = val;
  }
}

function onClickSelectAll(e, inputName = 'input[name="cpl[]"]') {
  const data = document.querySelectorAll(inputName);
  Array.from(data).forEach(value => {
    value.checked = e.target.checked
  });
}