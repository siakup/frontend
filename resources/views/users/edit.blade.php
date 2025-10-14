@extends('layouts.main')

@section('title', 'Manajemen Pengguna')

@section('javascript')
<script src="{{asset('js/custom/user.js')}}"></script>
<script>
  function handleSaveData() {
    document.getElementById('modalKonfirmasiSimpan').style.display = 'none';
    const data = collectData();
    const userId = document.getElementById('user_id').value;

    $.ajax({
      url: "/users/" + userId,
      type: 'PUT',
      data: JSON.stringify(data),
      contentType: 'application/json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
</script>
@endsection

@section('content')
  <x-title-page :title="'Ubah Informasi'" />
  <x-button.back
    :href="route('users.index')"
    :class="'ml-4'"
  >
    Manajemen Pengguna
  </x-button.back>

  <x-white-box :class="''">
    <x-title-page :title="'Ubah Informasi Data Pengguna'" />
    <div class="flex flex-col gap-4 py-2.5 px-5">
      <input type="hidden" id="user_id" value="{{ $response->data->user->id }}">
      <x-form.input-container id="nip-search">
        <x-slot name="label">NIP</x-slot>
        <x-slot name="input">
          <div class="w-full flex-1">
            <x-form.search-v2 
              class="w-full"
              :routes="route('users.index')"
              :fieldKey="'username'"
              :placeholder="'Nomor Induk Pegawai (NIP)'"
              :search="''"
              id="nip-search"
              value="{{ $response->data->user->nomor_induk ?? '' }}"
              readonly
            />
            <input type="hidden" id="nip" name="nip" value="{{ $response->data->user->nomor_induk ?? '' }}">
          </div>
        </x-slot>
      </x-form.input-container>

      <x-form.input-container id="nama_lengkap">
        <x-slot name="label">Nama Lengkap</x-slot>
        <x-slot name="input">
          <input 
            type="text" 
            id="nama_lengkap" 
            class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" 
            placeholder="Auto Generate" 
            value="{{ $response->data->user->nama ?? '' }}"
            readonly 
          />
        </x-slot>
      </x-form.input-container>

      <x-form.input-container id="username">
        <x-slot name="label">Username</x-slot>
        <x-slot name="input">
          <input 
            type="text" 
            id="username" 
            class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" 
            placeholder="Auto Generate"
            value="{{ $response->data->user->username ?? '' }}" 
            readonly 
          />
        </x-slot>
      </x-form.input-container>

      <x-form.input-container id="email">
        <x-slot name="label">Email</x-slot>
        <x-slot name="input">
          <input 
            type="text" 
            id="email" 
            class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" 
            placeholder="Auto Generate" 
            value="{{ $response->data->user->email }}"
            readonly />
        </x-slot>
      </x-form.input-container>

      <x-form.toggle :id="'user-status'" :value="($response->data->user->status ?? 'inactive') === 'active'" />

      <div class="flex items-center justify-end w-full px-8 py-4">
        <x-button.primary 
          onclick="
            document.getElementById('modalTambahPeran').classList.add('flex');
            document.getElementById('modalTambahPeran').classList.remove('hidden');
          "
          :class="''"
          id="btnShowModal"
        >
          Tambah Peran
        </x-button.primary>
      </div>
    </div>
  </x-white-box>

  <x-white-box :class="'mx-4'">
    <x-title-page :title="'Daftar Peran'" />
    <x-table id="list-role" :variant="'old'">
      <x-table-head :variant="'old'">
        <x-table-row :variant="'old'">
          <x-table-header :variant="'old'">Nama Peran</x-table-header>
          <x-table-header :variant="'old'">Institusi</x-table-header>
          <x-table-header :variant="'old'">Dibuat Pada</x-table-header>
          <x-table-header :variant="'old'">Aksi</x-table-header>
        </x-table-row>
      </x-table-head>
      <tbody>
        @foreach($response->data->roles as $role)
          <x-table-row 
            data-role-id="{{ $role->id_role }}" 
            data-institusi-id="{{ $role->id_institusi }}" 
            :variant="'old'"
          >
            <x-table-cell :variant="'old'">{{ $role->role?->nama_role ?? '-' }}</x-table-cell>
            <x-table-cell :variant="'old'">{{ $role->institusi?->nama_institusi ?? '-' }}</x-table-cell>
            <x-table-cell :variant="'old'">{{ formatDateTime($role->created_at) }}</x-table-cell>
            <x-table-cell :variant="'old'" class="flex items-center justify-center">
              <x-button.secondary 
                onclick="handleClickConfirmationDeleteRole(this)"
                class="border-none"
                :icon="asset('/assets/active/icon-delete.svg')"
                :iconPosition="'left'"
              >
                <span>Hapus</span>
              </x-button.secondary>
            </x-table-cell>
          </x-table-row>
        @endforeach
      </tbody>
    </x-table>
    <div class="gap-2 mt-4.5 justify-end items-center pb-4 px-4 flex" id="daftarPeranActions">
      <x-button.secondary :href="route('users.index')">Batal</x-button.secondary>
      <x-button.primary 
        onclick="
          document.getElementById('modalKonfirmasiSimpan').classList.add('flex');
          document.getElementById('modalKonfirmasiSimpan').classList.remove('hidden');
        ">Simpan</x-button.primary>
    </div>
  </x-white-box>

  <x-modal.container-pure-js id="modalTambahPeran">
    <x-slot name="header">
      <span class="text-lg-bd">Tambah Peran Pengguna</span>
    </x-slot name="header">
    <x-slot name="body">
      <x-form.input-container id="">
        <x-slot name="label">Nama Peran</x-slot>
        <x-slot name="input">
          <select 
            id="roleSelect" 
            class="w-full ps-3 pe-10 box-border border-[1px] border-[#D9D9D9] rounded-lg h-10" 
            onchange="handleChangeRole(this)"
          >
            <option value="" selected disabled hidden>Pilih Peran</option>
            @foreach($roles->data as $role)
              <option value="{{ $role->id }}">{{ $role->nama }}</option>
            @endforeach
          </select>
        </x-slot>
      </x-form.input-container>
      <x-form.input-container id="">
        <x-slot name="label">Nama Institusi</x-slot>
        <x-slot name="input">
          <select 
            id="institusiSelect" 
            class="w-full ps-3 pe-10 box-border border-[1px] border-[#D9D9D9] rounded-lg h-10" 
            onchange="updateTambahButtonState(document.getElementById('roleSelect'), this)" 
            disabled
          >
            <option value="" selected disabled hidden>Pilih Institusi</option>
          </select>
        </x-slot>
      </x-form.input-container>
    </x-slot>
    <x-slot name="footer">
      <x-button.secondary 
        onclick="
          document.getElementById('modalTambahPeran').classList.add('hidden');
          document.getElementById('modalTambahPeran').classList.remove('flex');
        "
      >
        Cek Kembali
      </x-button.secondary>
      <x-button.primary id="btnTambahModal" onclick="handleClickAddRole(this)" disabled>Ya, Simpan Sekarang</x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>

  <x-modal.container-pure-js id="modalKonfirmasiSimpan">
    <x-slot name="header">
      <span class="text-lg-bd">Tunggu Sebentar</span>
    </x-slot name="header">
    <x-slot name="body">
      <div>Apakah anda yakin informasi anda sudah benar?</div>
    </x-slot>
    <x-slot name="footer">
      <x-button.secondary 
        onclick="
          document.getElementById('modalKonfirmasiSimpan').classList.add('hidden');
          document.getElementById('modalKonfirmasiSimpan').classList.remove('flex');
        ">
          Cek Kembali
        </x-button.secondary>
      <x-button.primary id="btnYaSimpan" onclick="handleSaveData()">Ya, Simpan Sekarang</x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>

  <x-modal.container-pure-js id="modalKonfirmasiHapus">
    <x-slot name="header">
      <span class="text-lg-bd">Hapus Peran Pengguna</span>
    </x-slot name="header">
    <x-slot name="body">
      <div>Apakah anda yakin ingin menghapus?</div>
    </x-slot>
    <x-slot name="footer">
      <x-button.secondary 
        onclick="
          document.getElementById('modalKonfirmasiHapus').classList.add('hidden');
          document.getElementById('modalKonfirmasiHapus').classList.remove('flex');
        ">
          Cek Kembali
        </x-button.secondary>
      <x-button.primary id="btnYaHapus" onclick="handleClickDeleteRole(this)">Ya, Hapus Sekarang</x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>

  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection