function handleCreateData(route) {
  document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
  const data = collectData();

  $.ajax({
    url: route,
    type: 'POST',
    data: JSON.stringify(data),
    contentType: 'application/json',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
      console.log('AJAX Response:', response);
      localStorage.setItem('flash_type', response.success ? 'success' : 'error');
      localStorage.setItem('flash_message', response.message || 'Pengguna berhasil dibuat');
      window.location.href = response.redirect_uri;
    },
    error: function(xhr, status, error) {
      let errorMessage = 'Gagal menyimpan data. Silakan coba lagi.';
      if (xhr.responseJSON && xhr.responseJSON.message) {
          errorMessage = xhr.responseJSON.message;
      }

      errorToast(errorMessage);
      console.error('AJAX Error:', error);
    }
  });
}

function handleUpdateData() {
    document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
    const data = collectData();
    const userId = document.getElementById('user_id').value;

    $.ajax({
      url: "/users/" + userId,
      type: 'PUT',
      data: JSON.stringify(data),
      contentType: 'application/json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      },
      success: function(response) {
        console.log('AJAX Response:', response);
        localStorage.setItem('flash_type', response.success ? 'success' : 'error');
        localStorage.setItem('flash_message', response.message || 'Pengguna berhasil diubah');
        window.location.href = response.redirect_uri;
      },
      error: function(xhr, status, error) {
        let errorMessage = 'Gagal menyimpan data. Silakan coba lagi.';
        if (xhr.responseJSON && xhr.responseJSON.message) {
          errorMessage = xhr.responseJSON.message;
        }
        errorToast(errorMessage);
        console.error('AJAX Error:', error);
      }
    });
  }

function updateTambahPeranButtonState() {
  const allFilled =
      document.querySelector('input[name="nip"]').value.trim() &&
      document.getElementById('nama_lengkap').value.trim() &&
      document.getElementById('username').value.trim() &&
      document.getElementById('email').value.trim();
  
  const btnShowModal = document.getElementById('btnShowModal');

  if (allFilled) {
      btnShowModal.disabled = false;
      btnShowModal.classList.remove('button-radius');
      btnShowModal.classList.add('button-outline');
      
  } else {
      btnShowModal.disabled = true;
      btnShowModal.classList.remove('button-outline');
      btnShowModal.classList.add('button-radius');
  }
}

function handleChooseUser(element) {
  const namaInput = document.getElementById('nama_lengkap');
  const usernameInput = document.getElementById('username');
  const nipInput = document.querySelector('input[name="nip"]');
  const nipSelect = document.getElementById('nip-search');
  const emailInput = document.getElementById('email');
  
  fetch(`/users/generate-username?name=${encodeURIComponent(element.getAttribute('data-nama'))}`, {
    headers: {
      'X-Requested-With': 'XMLHttpRequest', 
      'Accept': 'application/json'
    }
  }).then(res => res.json())
    .then(data => {
      if (data && data.data) {
        setTimeout(() => {
          namaInput.value = element.getAttribute('data-nama');
          usernameInput.value = data.data;
          nipInput.value = element.getAttribute('data-nip');
          nipSelect.value = element.getAttribute('data-nip');
          emailInput.value = element.getAttribute('data-email');
          updateTambahPeranButtonState();
        }, 0)
                  
        element.parentElement.style.display = 'none';
      } else {
        usernameInput.value = '';
      }
    }).catch(() => {
      usernameInput.value = '';
    });
}

var nipTimeout = null;
function handleSearchNIP(element) {
  const nipDropdown = element.nextElementSibling.nextElementSibling;
  const val = element.value.trim();

  if (nipTimeout) clearTimeout(nipTimeout);
  if (val.length < 3) {
    nipDropdown.style.display = 'none';
    return;
  }
  nipTimeout = setTimeout(() => {
    fetch(`/users/search-by-nip?search=${encodeURIComponent(val)}`, {
      headers: {
        'X-Requested-With' : 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    }).then(res => res.json())
      .then(data => {
        if (data && data.data && data.data.length > 0) {
          nipDropdown.innerHTML = data.data.map(item =>
            `<div 
              class="py-3 px-4 flex justify-start items-center gap-2 cursor-pointer transition-[background] duration-150 text-center hover:bg-[#E62129] group text-black hover:text-white" 
              data-nip="${item.nomor_induk}" 
              data-nama="${item.nama}" 
              data-email="${item.email}" 
              onmousedown="handleChooseUser(this)"
            >
                <strong class="me-2 font-semibold text-black group-hover:text-white">${item.nomor_induk}</strong> - ${item.nama}
            </div>`
          ).join('');
          nipDropdown.style.display = 'block';
        } else {
          nipDropdown.innerHTML = '<div style="padding:8px 16px; color:#888;">Tidak ditemukan</div>';
          nipDropdown.style.display = 'block';
        }
      }).catch(() => {
        nipDropdown.innerHTML = '<div style="padding:8px 16px; color:#888;">Gagal mencari</div>';
        nipDropdown.style.display = 'block';
      });
  }, 300);
}

function updateTambahButtonState(roleSelect, institusiSelect) {
  const btnTambahModal = document.getElementById('btnTambahModal');
  if (roleSelect.value && institusiSelect.value) {
    btnTambahModal.disabled = false;
  } else {
    btnTambahModal.disabled = true;
  }
}

function updateDaftarPeranActionsVisibility() {
  const tbody = document.querySelector('.table tbody');
  const actions = document.getElementById('daftarPeranActions');
  
  const hasData = Array.from(tbody.querySelectorAll('tr')).some(tr =>
      Array.from(tr.children).some(td => td.textContent.trim() !== '')
  );
  if(hasData) {
    actions.classList.add('flex')
    actions.classList.remove('hidden')
  } else {
    actions.classList.add('hidden')
    actions.classList.remove('flex')
  }
}

function handleChangeRole(element) {
  const institusiSelect = element.parentElement.nextElementSibling.querySelector('select');
  
  updateTambahButtonState(this, institusiSelect);
  const roleId = element.value;

  institusiSelect.innerHTML = '<option value="" selected disabled hidden>Pilih Institusi</option>';
  institusiSelect.disabled = true;
  if (roleId) {
    fetch(`/institutions/role?role=${roleId}`, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest', 
        'Accept': 'application/json'
      }
    }).then(response => response.json())
      .then(data => {
        if (data && data.data && data.data.length > 0) {
          data.data.forEach(function(inst) {
            const opt = document.createElement('option');
            opt.value = inst.id;
            opt.textContent = inst.nama;
            institusiSelect.appendChild(opt);
          });
          institusiSelect.disabled = false;
        } else {
          institusiSelect.disabled = true;
        }
      }).catch(() => {
        institusiSelect.disabled = true;
      });
  }
}

function handleClickConfirmationDeleteRole(element) {
  const tr = element.parentElement.parentElement;
  const roleId = tr.getAttribute('data-role-id');
  const institusiId = tr.getAttribute('data-institusi-id');
  const modalKonfirmasiHapus = document.getElementById('modalKonfirmasiHapus');

  modalKonfirmasiHapus.classList.add('flex');
  modalKonfirmasiHapus.setAttribute('deleted-role-id', roleId);
  modalKonfirmasiHapus.setAttribute('deleted-institusi-id', institusiId);
  modalKonfirmasiHapus.classList.remove('hidden');
}

function handleClickDeleteRole(element) {
  const modal = element.parentElement.parentElement.parentElement;
  const roleId = modal.getAttribute('deleted-role-id');
  const institusiId = modal.getAttribute('deleted-institusi-id');
  
  const tr = document.querySelector(`tr[data-role-id="${roleId}"][data-institusi-id="${institusiId}"]`);
  tr.remove();
  successToast('Berhasil dihapus');

  modal.classList.remove('flex');
  modal.classList.add('hidden');
}

function handleClickAddRole(element) {
  if (element.disabled) return;
  const roleSelect = document.getElementById('roleSelect');
  const institusiSelect = document.getElementById('institusiSelect');

  const roleId = roleSelect.value;
  const roleText = roleSelect.options[roleSelect.selectedIndex].textContent;
  const institusiId = institusiSelect.value;
  const institusiText = institusiSelect.options[institusiSelect.selectedIndex].textContent;

  if (!roleId || !institusiId || institusiId === 'undefined') {
      alert('Pilih peran dan institusi yang valid.');
      return;
  }
  
  const now = new Date();
  const createdAt = formatDateTime(now);
  // const createdAt = now.toLocaleString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });

  const tbody = document.querySelector('tbody');
  tbody.querySelectorAll('tr').forEach(tr => {
      if ([...tr.children].every(td => td.textContent.trim() === '')) tr.remove();
  });
  
  const tr = document.createElement('tr');
  tr.setAttribute('data-role-id', roleId);
  tr.setAttribute('data-institusi-id', institusiId);
  tr.innerHTML = 
    `<td class="w-auto text-center text-sm py-4 px-2 align-middle border-b-[1px] border-b-solid border-b-[#D9D9D9]">${roleText}</td>
      <td class="w-auto text-center text-sm py-4 px-2 align-middle border-b-[1px] border-b-solid border-b-[#D9D9D9]">${institusiText}</td>
      <td class="w-auto text-center text-sm py-4 px-2 align-middle border-b-[1px] border-b-solid border-b-[#D9D9D9]">${createdAt}</td>
      <td class="w-auto text-center text-sm py-4 px-2 align-middle border-b-[1px] border-b-solid border-b-[#D9D9D9] flex items-center justify-center">
        <button 
          class="flex w-fit min-w-[151px] justify-center items-center gap-1 px-4 py-2 rounded-lg bg-white text-[#E62129] hover:bg-[#FBDADB] active:bg-[#F7B6B8] cursor-pointer" 
          title="Hapus"
          onclick="handleClickConfirmationDeleteRole(this)"
        >
          <img src="../../assets/active/icon-delete.svg" alt="Delete">
          <span class="font-poppins text-[16px] leading-[24px]">Hapus</span>
        </button>
      </td>`;  
  tbody.insertBefore(tr, tbody.firstChild); 
  
  document.getElementById('modalTambahPeran').classList.add('hidden');
  document.getElementById('modalTambahPeran').classList.remove('flex');
  
  roleSelect.value = '';
  institusiSelect.innerHTML = '<option value="" selected disabled hidden>Pilih Institusi</option>';
  institusiSelect.disabled = true;
  updateTambahButtonState(roleSelect, institusiSelect);
  updateDaftarPeranActionsVisibility()
}

window.handleSearchNIP = handleSearchNIP;

function collectData() {
  const nip = document.getElementById('nip').value.trim();
  const nama_lengkap = document.getElementById('nama_lengkap').value.trim();
  const username = document.getElementById('username').value.trim();
  const email = document.getElementById('email').value.trim();
  const status = document.getElementById('user-status').value;

  const peran = [];
  document.querySelectorAll('#list-role tbody tr').forEach(tr => {
    const tds = tr.querySelectorAll('td');
    if (tds.length >= 4 && tds[0].textContent.trim() && tds[1].textContent.trim()) {
      peran.push({
        role_id: tr.getAttribute('data-role-id'),
        institusi_id: tr.getAttribute('data-institusi-id'),
        role: tds[0].textContent.trim(),
        institusi: tds[1].textContent.trim(),
        created_at: tds[2].textContent.trim()
      });
    }
  });

  const data = {
    nip,
    nama_lengkap,
    username,
    email,
    status,
    peran
  };

  return data;
}

function handleViewUserButtonClick(element, route) {
  const nomorInduk = element.getAttribute('data-nomor-induk');
  if (nomorInduk) {
    $.ajax({
      url: route, 
      method: 'GET',
      data: { nomor_induk: nomorInduk }, 
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(html) {
        $('#userDetailModalContainer').html(html);
        $('#modalDetailPengguna').removeClass('hidden').addClass('flex');
      }
    });
  }
}

function handleResetUserPassButtonClick(element, route) {
  const nomorInduk = element.getAttribute('data-nomor-induk');
  if (nomorInduk) {
    $.ajax({
      url: route, 
      method: 'GET',
      data: { nomor_induk: nomorInduk }, 
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(html) {
        $('#userDetailModalContainer').html(html);
        $('#modalResetPassword').removeClass('hidden').addClass('flex');
      }
    });
  }
}

function handleReset(routeRedirected) {
  document.getElementById('modalResetPassword').style.display = 'none';
  const userId = document.getElementById('user_id').value;

  $.ajax({
    url: "/users/" + userId + "/update-password",
    type: 'POST',
    data: {},
    contentType: 'application/json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      'X-Requested-With': 'XMLHttpRequest'
    },
    success: function(response) {
      window.location.href = routeRedirected+"?success=" + encodeURIComponent(response.message);
    },
    error: function(xhr) {
      errorToast(errorMessage);
    }
  });
}