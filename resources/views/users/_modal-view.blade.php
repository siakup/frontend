<x-modal.container-pure-js id="modalDetailPengguna">
  <x-slot name="header">
    <span class="text-lg-bd w-3/4 text-center">Lihat Informasi Detail Pengguna</span>
    <button 
      type="button" 
      class="absolute top-4 right-5 bg-none border-none text-[2rem] text-[#888] cursor-pointer z-10 transition-all duration-200 hover:text-[#E74C3C]" 
      onclick="
        document.getElementById('modalDetailPengguna').classList.remove('flex');
        document.getElementById('modalDetailPengguna').classList.add('hidden');
      "
    >
        &times;
    </button>
  </x-slot>
  <x-slot name="body">
    <div class="expandable-section" id="section-detail">
      <div class="expandable-header" onclick="toggleSection('detail')">
          <span class="text-md-bd">Informasi Detail Pengguna</span>
          <img id="icon-detail" class="float-right transition-transform duration-200" src="{{ asset('assets/icon-arrow-up-black-16.svg') }}"  />
      </div>
      <div class="expandable-content block" id="content-detail">
        <x-form.input-container class="min-w-[120px]" id="nip">
          <x-slot name="label">NIP</x-slot>
          <x-slot name="input">
            <input type="text" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm rounded-lg leading-5 bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed" value="{{ $response->data->user->nomor_induk }}" readonly>
          </x-slot>
        </x-form.input-container>
        <x-form.input-container class="min-w-[120px]" id="nama_lengkap">
          <x-slot name="label">Nama Lengkap</x-slot>
          <x-slot name="input">
            <input type="text" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm rounded-lg leading-5 bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed" value="{{ $response->data->user->nama }}" readonly>
          </x-slot>
        </x-form.input-container>
        <x-form.input-container class="min-w-[120px]" id="username">
          <x-slot name="label">Username</x-slot>
          <x-slot name="input">
            <input type="text" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm rounded-lg leading-5 bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed" value="{{ $response->data->user->username }}" readonly>
          </x-slot>
        </x-form.input-container>
        <x-form.input-container class="min-w-[120px]" id="email">
          <x-slot name="label">Email</x-slot>
          <x-slot name="input">
            <input type="text" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm rounded-lg leading-5 bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed" value="{{ $response->data->user->email }}" readonly>
          </x-slot>
        </x-form.input-container>
      </div>
    </div>
    <div class="modal-divider"></div>
    <div class="expandable-section" id="section-role" style="margin-top:18px;">
        <div class="expandable-header" onclick="toggleSection('role')">
            <span class="text-md-bd">Peran Pengguna</span>
            <img id="icon-role" class="expand-icon float-right transition-transform duration-200" src="{{ asset('assets/icon-arrow-up-black-16.svg') }}"/>
        </div>
        <div class="expandable-content block" id="content-role">
          <x-table :variant="'old'">
            <x-table-head :variant="'old'">
                <x-table-row :variant="'old'">
                  <x-table-header :variant="'old'">Nama Peran</x-table-header>
                  <x-table-header :variant="'old'">Nama Institusi</x-table-header>
                </x-table-row>
            </x-table-head>
            <tbody>
              @foreach($response->data->roles as $role)
                <x-table-row :variant="'old'">
                  <x-table-cell :variant="'old'">{{ $role->role->nama_role }}</x-table-cell>
                  <x-table-cell :variant="'old'">{{ $role->institusi->nama_institusi }}</x-table-cell>
                </x-table-row>
              @endforeach
            </tbody>
          </x-table>
        </div>
    </div>
  </x-slot>
  <x-slot name="footer"></x-slot>
</x-modal.container-pure-js>

<script>
function toggleSection(section) {
    const content = document.getElementById('content-' + section);
    const icon = document.getElementById('icon-' + section);
    if (content.classList.contains('hidden')) {
        content.classList.add('block');
        content.classList.remove('hidden');
        icon.src = "{{ asset('assets/icon-arrow-up-black-16.svg') }}";
    } else {
        content.classList.add('hidden');
        content.classList.remove('block');
        icon.src = "{{ asset('assets/icon-arrow-down-black-16.svg') }}";
    }
}
</script>