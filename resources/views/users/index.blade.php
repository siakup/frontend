@extends('layouts.main')

@section('title', 'Manajemen Pengguna')

@section('javascript')
  <script src="{{asset('js/custom/user.js')}}"></script>
  <script>
    function showSuccessModal(message) {
      document.getElementById('successModalMessage').textContent = message;
      document.getElementById('successModal').style.display = 'block';
    }

    function closeSuccessModal() {
      document.getElementById('successModal').style.display = 'none';
    }
    @if (request('success'))
      showSuccessModal(@json(request('success')));
      window.history.replaceState(null, '', window.location.pathname);
    @endif
  </script>
@endsection

@section('content')
    <x-title-page :title="'Manajemen Pengguna'" />

    <div class="flex items-center justify-end w-full px-4">
      <x-button.primary :href="route('users.create')">Tambah Pengguna Baru</x-button.primary>
    </div>
    <x-white-box :class="''">
      <div class="flex justify-between items-center p-4">
        <div class="w-64">
          <x-form.search-v2 
            class="w-64"
            :routes="route('users.index')"
            :fieldKey="'username'"
            :placeholder="'Username / Nama / Status'"
            :search="$search"
          />
        </div>
        <x-filter-button />
      </div>
    </x-white-box>
    <x-table :variant="'old'">
      <x-table-head :variant="'old'">
          <x-table-row :variant="'old'">
              <x-table-header :variant="'old'">NIP/NIM</x-table-header>
              <x-table-header :variant="'old'">Nama</x-table-header>
              <x-table-header :variant="'old'">Username</x-table-header>
              <x-table-header :variant="'old'">Dibuat Pada</x-table-header>
              <x-table-header :variant="'old'">Status</x-table-header>
              <x-table-header :variant="'old'">Reset</x-table-header>
              <x-table-header :variant="'old'">Aksi</x-table-header>
          </x-table-row>
      </x-table-head>
      <tbody>
          @foreach($response->data ?? [] as $user)
            <x-table-row :variant="'old'">
                <x-table-cell :variant="'old'">{{ $user->nomor_induk }}</x-table-cell>
                <x-table-cell :variant="'old'">{{ $user->nama }}</x-table-cell>
                <x-table-cell :variant="'old'">{{ $user->username }}</x-table-cell>
                <x-table-cell 
                  :variant="'old'" 
                  class=" text-gray-12"
                >
                  {{ formatDateTime($user->created_at) }}
                </x-table-cell>
                <x-table-cell :variant="'old'">
                    @if ($user->status === 'active')
                      <x-badge class="bg-[#D0DE68]">Aktif</x-badge>
                    @else
                      <x-badge class="bg-[#FAFBEE] text-[#98A725] leading-5 border-[1px] border-[#D0DE68]">Tidak Aktif</x-badge>
                    @endif
                </x-table-cell>
                <x-table-cell :variant="'old'">
                    <a href="#" onclick="handleResetUserPassButtonClick(this, '{{ route('users.resetPassword') }}')" class="link-blue text-[#0076BE] text-center text-xs leading-5 text-none no-underline"
                        data-nomor-induk="{{ $user->nomor_induk }}">Reset Password</a>
                </x-table-cell>
                <x-table-cell :variant="'old'">
                    <div class="flex gap-2 items-center justify-center">
                      <x-button.base
                          :icon="asset('assets/button-view.svg')"
                          class="scale-250"
                          onclick="handleViewUserButtonClick(this, '{{ route('users.detail') }}')" 
                          data-nomor-induk="{{ $user->nomor_induk }}"
                      />
                      <x-button.base
                          :icon="asset('assets/button-edit.svg')"
                          :href="route('users.edit', ['nomor_induk' => $user->nomor_induk])"
                          class="scale-210"
                          data-nomor-induk="{{ $user->nomor_induk }}"
                      />
                    </div>
                </x-table-cell>
              </x-table-row>
          @endforeach
      </tbody>
    </x-table>
    @if(isset($data['data']))
      @include('partials.pagination', [
          'currentPage' => $data['pagination']['current_page'],
          'lastPage' => $data['pagination']['last_page'],
          'limit' => $limit,
          'routes' => route('users.index'),
      ])
    @endif
    <div id="userDetailModalContainer"></div>
    @include('partials.success-modal')
@endsection
