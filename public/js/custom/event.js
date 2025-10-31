function onClickViewDetailEventAcademic(element, route) {
  const id = element.getAttribute('data-id');
  if (id) {
    $.ajax({
      url: route,
      method: 'GET',
      data: {
        id: id
      },
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(html) {
        $('#eventDetailModalContainer').html(html);
        $('#modalDetailEvent').removeClass('hidden').addClass('flex');
      }
    });
  }
}
  
function onClickDeleteEventAcademic(element, redirectRoute, requestRoute) {
  const modalKonfirmasiHapus = element.parentElement.parentElement.parentElement;
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  $.ajax({
    url: requestRoute,
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': csrfToken,
      'X-Requested-With': 'XMLHttpRequest'
    },
    success: function(response) {
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

function onClickCreateEventAcademic(requestedRoute, redirectedRoute) {
  const nama = $('#name').val();
  const flags = [];
  $('input[name="flag[]"]:checked').each(function() {
    flags.push($(this).val());
  });
  const status = $('#statusValue').val();

  $.ajax({
      url: requestedRoute,
      method: "POST",
      data: {
        _token: "{{ csrf_token() }}",
        name: nama,
        flag: flags,
        status: status
      },
      success: function(response) {
        $('#modalKonfirmasiSimpan').addClass('hidden').removeClass('flex');
        successToast('Berhasil disimpan');
        setTimeout(function() {
            window.location.href = redirectedRoute;
        }, 1200);
      },
      error: function(xhr) {
        $('#modalKonfirmasiSimpan').addClass('hidden').removeClass('flex');
        let msg = 'Gagal menyimpan data';
        if (xhr.responseJSON && xhr.responseJSON.message) {
          msg = xhr.responseJSON.message;
        }
        errorToast(msg);
      }
  });
}

function updateSaveButtonState() {
  const btnSave = document.getElementById('btnSave');
  const eventFilled = document.getElementById('name').value.trim() !== '';

  if (eventFilled) {
    btnSave.disabled = false;
  } else {
    btnSave.disabled = true;
  }
}