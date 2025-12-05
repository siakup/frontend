<script>
  window.modalData = @js($response->data);
  window.requestRoute = @js(route('users.updatePassword', ['id' => ':id']));
  window.redirectRoute = @js(route('users.index'));
</script>

<div id="modalResetPassword" x-data="Object.assign({
  show: false, 
  close () {
    show = false;
  },
  async resetPassword() {
    await window.api.requestPostData(
      window.requestRoute.replace(':id', this.user.id), 
      {}, 
      (response) => {window.location.href = `${window.redirectRoute}?success=${encodeURIComponent(response.message)}`},
      (xhr, status, error) => {errorToast(errorMessage)}
    )
  }
}, window.modalData)" x-init="$nextTick(() => show = true)" 
  x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-show="show" 
  x-cloak>
  <x-modal.container :show="true" x-model="show">
    <x-slot name="header">
      <x-container.wrapper :cols="14" :justify="'center'" :align="'center'">
  
        <x-container.container :background="'transparent'" class="col-start-1 col-end-15 row-start-1 row-end-2">
          <x-typography :variant="'heading-h5'" :class="'flex-1 text-center'">Reset Password Pengguna</x-typography>
        </x-container.container>
  
        <x-container.container :background="'transparent'" class="col-start-14 col-end-15 row-start-1 row-end-2 justify-end">
          <button 
            type="button" 
            class="text-[#888] cursor-pointer transition-all duration-200 hover:text-[#E74C3C] flex items-center" 
            x-on:click="close()"
          >
            <x-typography :variant="'heading-h3'" :class="'!font-medium'">&times;</x-typography>
          </button>
        </x-container.container>
  
      </x-container.wrapper>
    </x-slot>
    <x-container.wrapper :rows="5" :gapY="4">

      <x-container.container :background="'transparent'" class="row-start-1 row-end-2">
        <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Informasi Detail Pengguna</x-typography>
      </x-container.container>

      <x-container.container :background="'transparent'" class="row-start-2 row-end-3">
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
      </x-container.container>

      <x-container.container :background="'transparent'" class="row-start-3 row-end-4">
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
      </x-container.container>

      <x-container.container :background="'transparent'" class="row-start-4 row-end-5">
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
      </x-container.container>

      <x-container.container :background="'transparent'" class="row-start-5 row-end-6">
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
      </x-container.container>

    </x-container.wrapper>
    <x-slot name="footer">
      <x-container.wrapper :rows="2">

        <x-container.container :background="'transparent'" class="row-start-1 row-end-2">
          <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Reset Password</x-typography>
        </x-container.container>

        <x-container.container :background="'transparent'" :width="'full'" class="justify-center gap-4">
          <x-button :variant="'secondary'" x-on:click="close()" class="!w-full">Batal</x-button>
          <x-button :variant="'primary'" x-on:click="resetPassword()" class="!w-full">Reset Password</x-button>
        </x-container.container>
      </x-container.wrapper>
    </x-slot>
  </x-modal.container-pure-js>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">