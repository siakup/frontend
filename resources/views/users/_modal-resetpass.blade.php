<x-modal.container-pure-js id="modalResetPassword">
  <x-slot name="header">
  <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
    <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Reset Password Pengguna</x-typography>
    <button 
      type="button" 
      class="text-[#888] cursor-pointer transition-all duration-200 hover:text-[#E74C3C] flex items-center" 
      onclick="
        document.getElementById('modalResetPassword').classList.remove('flex');
        document.getElementById('modalResetPassword').classList.add('hidden');
      "
    >
      <x-typography :variant="'heading-h3'" :class="'!font-medium'">&times;</x-typography>
    </button>
  </x-container>
  </x-slot>
  <x-slot name="body">
    <x-container id="section-detail" :class="'w-[40vw] !border-none !px-0 !py-0 flex flex-col'">
      <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Informasi Detail Pengguna</x-typography>
      <x-container :class="'block w-full !border-none !px-0'" id="content-detail">
        <input type="hidden" id="user_id" value="{{ $response->data->user->id }}">
        <x-form.input-container id="nip" class="min-w-[110px]">
          <x-slot name="label">NIP</x-slot>
          <x-slot name="input">
            <input type="text" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" value="{{ $response->data->user->nomor_induk }}" readonly>
          </x-slot>
        </x-form.input-container>
          <x-form.input-container id="nama" class="min-w-[110px]">
            <x-slot name="label">Nama Lengkap</x-slot>
            <x-slot name="input">
              <input type="text" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" value="{{ $response->data->user->nama }}" readonly>
            </x-slot>
          </x-form.input-container>
          <x-form.input-container id="username" class="min-w-[110px]">
            <x-slot name="label">Username</x-slot>
            <x-slot name="input">
              <input type="text" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" value="{{ $response->data->user->username }}" readonly>
            </x-slot>
          </x-form.input-container>
          <x-form.input-container id="email" class="min-w-[110px]">
            <x-slot name="label">Email</x-slot>
            <x-slot name="input">
              <input type="text" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm leading-5 read-only:bg-[#F5F5F5] read-only:text-[#8C8C8C] read-only:cursor-not-allowed flex-1 rounded-lg" value="{{ $response->data->user->email }}" readonly>
            </x-slot>
          </x-form.input-container>
        </x-container>
    </x-container>
  </x-slot>
  <x-slot name="footer">
    <x-container :variant="'content-wrapper'" class="flex flex-col gap-3 w-full items-center !p-0">
      <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Reset Password</x-typography>
      <x-container :variant="'content-wrapper'" class="flex flex-row items-center justify-center gap-3">
        <x-button.secondary :href="route('users.index')">Batal</x-button.secondary>
        <x-button.primary onclick="handleReset('{{ route('users.index') }}')">Reset Password</x-button.primary>
      </x-container>
    </x-container>
  </x-slot>
</x-modal.container-pure-js>

<script src="{{asset('js/custom/user.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">