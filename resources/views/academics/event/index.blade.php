@extends('layouts.main')

@section('title', 'Event Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('javascript')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{ asset('js/custom/event.js')}}"></script>
  @include('partials.success-notification-modal', ['route' => route('academics-event.index')])
@endsection

@section('content')
  <x-container :variant="'content-wrapper'" class="flex flex-col !gap-0">
    <x-tab 
      :tabItems="[
        (object)[
          'routeName' => 'academics-periode.index',
          'routeQuery' => 'academics-periode.index',
          'title' => 'Periode Akademik'
        ],
        (object)[
          'routeName' => 'academics-event.index',
          'routeQuery' => 'academics-event.index',
          'title' => 'Event Akademik'
        ],
      ]"
    />
    <x-container :class="'flex flex-col gap-4 rounded-tl-none items-stretch my-0 border-t-[1px] border-t-[#F39194] relative !z-0'">
      <x-container :variant="'content-wrapper'" class="self-end flex flex-row items-end justify-end w-full gap-5 m-5 !px-0">
        <x-button.primary :icon="asset('assets/icon-upload-red-500.svg')" :iconPosition="'right'" :href="route('academics-event.upload')">Unggah Event Akademik</x-button.primary>
        <x-button.primary :href="route('academics-event.create')">Tambah Event Akademik</x-button.primary>
      </x-container>
      <x-container :class="'flex justify-between items-center p-4'">
        <x-form.search-v2 
          class="w-80"
          :inputParentClass="'w-max'"
          :routes="route('academics-event.index')"
          :fieldKey="'nama_event'"
          :placeholder="'Nama Event'"
          :search="$search"
        />
        <x-filter-button />
      </x-container>
      <x-table :variant="'old'">
        <x-table-head :variant="'old'">
          <x-table-row :variant="'old'">
            <x-table-header :variant="'old'">Nama Event</x-table-header>
            <x-table-header :variant="'old'">Event <br> Nilai</x-table-header>
            <x-table-header :variant="'old'">Event <br> IRS</x-table-header>
            <x-table-header :variant="'old'">Event <br> Lulus</x-table-header>
            <x-table-header :variant="'old'">Event <br> Registrasi</x-table-header>
            <x-table-header :variant="'old'">Event <br> Yudisium</x-table-header>
            <x-table-header :variant="'old'">Event <br> Survei</x-table-header>
            <x-table-header :variant="'old'">Event <br> Dosen</x-table-header>
            <x-table-header :variant="'old'">Status</x-table-header>
            <x-table-header :variant="'old'">Aksi</x-table-header>
          </x-table-row>
        </x-table-head>
        <tbody>
          @foreach ($data['data'] ?? [] as $event)
            <x-table-row :variant="'old'">
                <x-table-cell :variant="'old'">{{ $event['nama_event'] }}</x-table-cell>
                <x-table-cell :variant="'old'">{{ $event['nilai_on'] ? 'Ya' : 'Tidak' }}</x-table-cell>
                <x-table-cell :variant="'old'">{{ $event['irs_on'] ? 'Ya' : 'Tidak' }}</x-table-cell>
                <x-table-cell :variant="'old'">{{ $event['lulus_on'] ? 'Ya' : 'Tidak' }}</x-table-cell>
                <x-table-cell :variant="'old'">{{ $event['registrasi_on'] ? 'Ya' : 'Tidak' }}</x-table-cell>
                <x-table-cell :variant="'old'">{{ $event['yudisium_on'] ? 'Ya' : 'Tidak' }}</x-table-cell>
                <x-table-cell :variant="'old'">{{ $event['survei_on'] ? 'Ya' : 'Tidak' }}</x-table-cell>
                <x-table-cell :variant="'old'">{{ $event['dosen_on'] ? 'Ya' : 'Tidak' }}</x-table-cell>
                <x-table-cell :variant="'old'">
                  @if ($event['status'] === 'active')
                    <x-badge class="bg-[#D0DE68]">Aktif</x-badge>
                  @else
                    <x-badge class="bg-[#FAFBEE] text-[#98A725] leading-5 border-[1px] border-[#D0DE68]">Tidak Aktif</x-badge>
                  @endif
                </x-table-cell>
                <x-table-cell :variant="'old'">
                    <x-container :variant="'content-wrapper'" class="flex flex-row items-center justify-center">
                      <x-button.base
                          :icon="asset('assets/icon-search.svg')"
                          class=" scale-75"
                          onclick="onClickViewDetailEventAcademic(this, '{{ route('academics-event.detail') }}')" 
                          data-id="{{ $event['id'] }}"
                      >
                        Lihat
                      </x-button.base>
                      <x-button.base
                          :icon="asset('assets/icon-edit.svg')"
                          :href="route('academics-event.edit', ['id' => $event['id']])"
                          class="text-[#E62129] scale-75"
                      >
                        Ubah
                      </x-button.base>
                      <x-button.base
                          :icon="asset('assets/icon-delete-gray-600.svg')"
                          class="text-[#8C8C8C] scale-75 btn-delete-event-academic"
                          onclick="
                            document.getElementById('modalKonfirmasiHapus').setAttribute('data-id', {{ $event['id'] }});
                            document.getElementById('modalKonfirmasiHapus').classList.add('flex');
                            document.getElementById('modalKonfirmasiHapus').classList.remove('hidden');
                          "
                      >
                        Hapus
                      </x-button.base>
                    </x-container>
                </x-table-cell>
            </x-table-row>
          @endforeach
        </tbody>
      </x-table>
    </x-container>

    @if (isset($data['data']))
      @include('partials.pagination', [
        'currentPage' => $data['pagination']['current_page'],
        'lastPage' => $data['pagination']['last_page'],
        'limit' => $limit,
        'routes' => route('academics-event.index'),
      ])
    @endif

    <div id="eventDetailModalContainer"></div>

    <x-modal.container-pure-js id="modalKonfirmasiHapus">
      <x-slot name="header">
        <x-container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
          <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
          <x-icon :iconUrl="asset('assets/icon-delete-gray-800.svg')" :class="'w-8 h-8'" />
        </x-container>
      </x-slot>
      <x-slot name="body">Apakah Anda yakin ingin menghapus event akademik ini?</x-slot>
      <x-slot name="footer">
        <x-button.secondary 
          onclick="
            document.getElementById('modalKonfirmasiHapus').classList.add('hidden');
            document.getElementById('modalKonfirmasiHapus').classList.remove('flex');
          "
        >
          Batal
        </x-button.secondary>
        <x-button.primary 
          onclick="
            const id = this.parentElement.parentElement.parentElement.getAttribute('data-id');
            onClickDeleteEventAcademic(this, '{{ route('academics-event.index') }}', '{{ route('academics-event.delete', ['id' => ':id']) }}'.replace(':id', id))
          "
        >
          Hapus
        </x-button.primary>
      </x-slot>
    </x-modal.container-pure-js>
  </x-container>
@endsection
