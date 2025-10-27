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