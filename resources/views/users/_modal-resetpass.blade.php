<script>
  window.modalData = @js($response->data);
  window.requestRoute = @js(route('users.updatePassword', ['id' => ':id']));
  window.redirectRoute = @js(route('users.index'));
</script>

<div x-data="Object.assign({
  async resetPassword() {
    await requestPostData(
      window.requestRoute.replace(':id', this.user.id), 
      {}, 
      (response) => {window.location.href = `${window.redirectRoute}?success=${encodeURIComponent(response.message)}`},
      (xhr, status, error) => {errorToast(errorMessage)}
    )
  }
}, window.modalData)">
  <x-modal.container-pure-js id="modalResetPassword">
    <x-slot name="header">
    <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
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
      <x-container.container :class="'w-[40vw] !border-none !px-0 !py-0 flex flex-col'">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Informasi Detail Pengguna</x-typography>
        <x-container.container :class="'block w-full !border-none !px-0'">
          <input type="hidden" id="user_id" x-model="user.id">
          <x-form.input-container id="nip" class="min-w-[110px]">
            <x-slot name="label">NIP</x-slot>
            <x-slot name="input">
              <x-form.input 
                :placeholder="''" 
                :name="''" 
                readonly
                x-model="user.nomor_induk"
              />
            </x-slot>
          </x-form.input-container>
          <x-form.input-container id="nama" class="min-w-[110px]">
            <x-slot name="label">Nama Lengkap</x-slot>
            <x-slot name="input">
              <x-form.input 
                :placeholder="''" 
                :name="''" 
                readonly
                x-model="user.nama"
              />
            </x-slot>
          </x-form.input-container>
          <x-form.input-container id="username" class="min-w-[110px]">
            <x-slot name="label">Username</x-slot>
            <x-slot name="input">
              <x-form.input 
                :placeholder="''" 
                :name="''" 
                readonly
                x-model="user.username"
              />
            </x-slot>
          </x-form.input-container>
          <x-form.input-container id="email" class="min-w-[110px]">
            <x-slot name="label">Email</x-slot>
            <x-slot name="input">
              <x-form.input 
                :placeholder="''" 
                :name="''" 
                readonly
                x-model="user.email"
              />
            </x-slot>
          </x-form.input-container>
        </x-container>
      </x-container>
    </x-slot>
    <x-slot name="footer">
      <x-container.container :variant="'content-wrapper'" class="flex flex-col gap-3 w-full items-center !p-0">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Reset Password</x-typography>
        <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center justify-center gap-3">
          <x-button :variant="'secondary'" :href="route('users.index')">Batal</x-button>
          <x-button :variant="'primary'" x-on:click="resetPassword()">Reset Password</x-button>
        </x-container>
      </x-container>
    </x-slot>
  </x-modal.container-pure-js>
</div>

<script src="{{asset('js/custom/user.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">