@extends('layouts.main')

@section('title', 'Manajemen Pengguna')

@section('javascript')
<script src="{{asset('js/custom/helper.js')}}"></script>
<script src="{{asset('js/custom/user.js')}}"></script>
@endsection

@section('content')
  <x-container :variant="'content-wrapper'">
    <x-typography :variant="'body-large-semibold'">Pengguna Baru</x-typography>
    <x-button.back :href="route('users.index')">Manajemen Pengguna</x-button.back>
    <x-container :class="'flex flex-col gap-4'">
      <x-typography :variant="'body-medium-bold'">Pengguna Baru</x-typography>
      <x-form.input-container class="min-w-[120px]" for="nip-search">
        <x-slot name="label">NIP</x-slot>
        <x-slot name="input">
          <div class="w-full flex-1">
            <x-form.search-v2 
              class="w-full"
              :routes="route('users.index')"
              :fieldKey="'username'"
              :placeholder="'Nomor Induk Pegawai (NIP)'"
              :search="''"
              oninput="handleSearchNIP(this)"
              id="nip-search"
            />
            <input type="hidden" id="nip" name="nip" value="">
          </div>
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[120px]" for="nama_lengkap">
        <x-slot name="label">Nama Lengkap</x-slot>
        <x-slot name="input">
          <input type="text" id="nama_lengkap" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" placeholder="Auto Generate" readonly />
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[120px]" for="username">
        <x-slot name="label">Username</x-slot>
        <x-slot name="input">
          <input type="text" id="username" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" placeholder="Auto Generate" readonly />
        </x-slot>
      </x-form.input-container>
      <x-form.input-container class="min-w-[120px]" for="email">
        <x-slot name="label">Email</x-slot>
        <x-slot name="input">
          <input type="text" id="email" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" placeholder="Auto Generate" readonly />
        </x-slot>
      </x-form.input-container>
      <x-form.toggle :id="'user-status'" />
      <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-end !px-0'">
        <x-button.primary 
          onclick="
            document.getElementById('modalTambahPeran').classList.add('flex');
            document.getElementById('modalTambahPeran').classList.remove('hidden');
          " 
          disabled
          :class="''"
          id="btnShowModal"
        >
          Tambah Peran
        </x-button.primary>
      </x-container>
    </x-container>

    <x-container :class="'flex flex-col gap-4'">
      <x-typography :variant="'body-medium-bold'">Daftar Peran</x-typography>
      <x-table id="list-role" class="table" :variant="'old'">
        <x-table-head :variant="'old'">
          <x-table-row :variant="'old'">
            <x-table-header :variant="'old'">Nama Peran</x-table-header>
            <x-table-header :variant="'old'">Institusi</x-table-header>
            <x-table-header :variant="'old'">Dibuat Pada</x-table-header>
            <x-table-header :variant="'old'">Aksi</x-table-header>
          </x-table-row>
        </x-table-head>
        <tbody>
          <x-table-row :variant="'old'">
            <x-table-cell :variant="'old'"></x-table-cell>
            <x-table-cell :variant="'old'"></x-table-cell>
            <x-table-cell :variant="'old'"></x-table-cell>
            <x-table-cell :variant="'old'"></x-table-cell>
          </x-table-row>
        </tbody>
      </x-table>
      <x-container :variant="'content-wrapper'" :class="'hidden flex-row justify-end gap-4 !px-0'" id="daftarPeranActions">
        <x-button.secondary :href="route('users.index')">Batal</x-button.secondary>
        <x-button.primary 
          onclick="
            document.getElementById('modalKonfirmasiSimpan').classList.add('flex');
            document.getElementById('modalKonfirmasiSimpan').classList.remove('hidden');
          "

        >
          Simpan
        </x-button.primary>
      </x-container>
    </x-container>
  </x-container>

  <x-modal.container-pure-js id="modalTambahPeran">
    <x-slot name="header">
      <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tambah Peran Pengguna</x-typography>
        <x-icon :iconUrl="asset('assets/base/icon-caution.svg')" :class="'w-8 h-8'" />
      </x-container>
    </x-slot name="header">
    <x-slot name="body">
      <x-form.input-container class="min-w-[120px]" id="">
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
      <x-form.input-container class="min-w-[120px]" id="">
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
        Batal
      </x-button.secondary>
      <x-button.primary id="btnTambahModal" onclick="handleClickAddRole(this)" disabled>Tambah</x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>

  <x-modal.container-pure-js id="modalKonfirmasiSimpan">
    <x-slot name="header">
      <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
        <x-icon :iconUrl="asset('assets/base/icon-caution.svg')" :class="'w-8 h-8'" />
      </x-container>
    </x-slot>
    <x-slot name="body">
      <div>Apakah anda yakin informasi anda sudah benar?</div>
    </x-slot>
    <x-slot name="footer">
      <x-button.secondary onclick="document.getElementById('modalKonfirmasiSimpan').style.display = 'none';">Cek Kembali</x-button.secondary>
      <x-button.primary id="btnYaSimpan" onclick="handleCreateData('{{route('users.store')}}')">Ya, Simpan Sekarang</x-button.primary>
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