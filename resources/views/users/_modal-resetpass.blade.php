<x-modal.container-pure-js id="modalResetPassword">
  <x-slot name="header">
    <span class="text-lg-bd">Reset Password Pengguna</span>
    <button 
      type="button" 
      class="absolute top-4 right-5 bg-none border-none text-[2rem] text-[#888] cursor-pointer z-10 transition-all duration-200 hover:text-[#E74C3C]" 
      onclick="
        document.getElementById('modalResetPassword').classList.add('hidden');
        document.getElementById('modalResetPassword').classList.remove('flex');
      "
    >
      &times;
    </button>
  </x-slot name="header">
  <x-slot name="body">
    <div id="section-detail" class="w-[40vw]">
      <span class="text-md-bd">Informasi Detail Pengguna</span>
      <div class="expandable-content w-full" id="content-detail" style="display:block;">
          <input type="hidden" id="user_id" value="{{ $response->data->user->id }}">
          <x-form.input-container id="nip">
            <x-slot name="label">NIP</x-slot>
            <x-slot name="input">
              <input type="text" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" value="{{ $response->data->user->nomor_induk }}" readonly>
            </x-slot>
          </x-form.input-container>
          <x-form.input-container id="nama">
            <x-slot name="label">Nama Lengkap</x-slot>
            <x-slot name="input">
              <input type="text" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" value="{{ $response->data->user->nama }}" readonly>
            </x-slot>
          </x-form.input-container>
          <x-form.input-container id="username">
            <x-slot name="label">Username</x-slot>
            <x-slot name="input">
              <input type="text" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" value="{{ $response->data->user->username }}" readonly>
            </x-slot>
          </x-form.input-container>
          <x-form.input-container id="email">
            <x-slot name="label">Email</x-slot>
            <x-slot name="input">
              <input type="text" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" value="{{ $response->data->user->email }}" readonly>
            </x-slot>
          </x-form.input-container>
      </div>
    </div>
  </x-slot>
  <x-slot name="footer">
    <div class="flex flex-col gap-3 w-full items-center">
      <span class="text-md-bd">Reset Password</span>
      <div class="flex items-center justify-center gap-3">
          <x-button.secondary :href="route('users.index')">Batal</x-button.secondary>
          <x-button.primary onclick="handleReset('{{ route('users.index') }}')">Reset Password</x-button.primary>
      </div>
    </div>
  </x-slot>
</x-modal.container-pure-js>

<script src="{{asset('js/custom/user.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">