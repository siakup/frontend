@extends('layouts.main')

@section('title', 'Event Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('javascript')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>
    function onClickViewDetailEventAcademic(element, route) {
      const id = element.getAttribute('data-id');
      if (id) {
        $.ajax({
          url: route,
          method: 'GET',
          data: {
              id: id
          },
          headers: {
              'X-Requested-With': 'XMLHttpRequest'
          },
          success: function(html) {
              $('#eventDetailModalContainer').html(html);
              $('#modalDetailEvent').removeClass('hidden').addClass('flex');
          }
        });
      }
    }
    
    function onClickDeleteEventAcademic(element, redirectRoute, requestRoute) {
      const modalKonfirmasiHapus = element.parentElement.parentElement.parentElement;
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      $.ajax({
          url: requestRoute,
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
          },
          success: function(response) {
            modalKonfirmasiHapus.removeAttribute('data-id');
            modalKonfirmasiHapus.classList.add('hidden');
            modalKonfirmasiHapus.classList.remove('flex');
            successToast('Berhasil dihapus');
            setTimeout(() => {
                window.location.href = redirectRoute;
            }, 5000);
          },
          error: function() {
            $('tbody').html(
              '<tr><td colspan="7" class="text-center text-danger">Terjadi kesalahan saat memuat data</td></tr>'
            );
          }
      });
    }
  </script>
  @include('partials.success-notification-modal', ['route' => route('academics-event.index')])
@endsection

@section('content')
  <div class="flex flex-col gap-0">
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
    <x-white-box :class="'flex flex-col rounded-tl-none items-stretch my-0 mx-4 border-t-[1px] border-t-[#F39194] relative !z-0'">
      <div class="self-end flex gap-5 m-5 w-max">
        <x-button.primary :icon="asset('assets/icon-upload-red-500.svg')" :iconPosition="'right'" :href="route('academics-event.upload')">Unggah Event Akademik</x-button.primary>
        <x-button.primary :href="route('academics-event.create')">Tambah Event Akademik</x-button.primary>
      </div>
      <x-white-box :class="''">
        <div class="flex justify-between items-center p-4">
          <x-form.search-v2 
            class="w-80"
            :inputParentClass="'w-max'"
            :routes="route('academics-event.index')"
            :fieldKey="'nama_event'"
            :placeholder="'Nama Event'"
            :search="$search"
          />
          <x-filter-button />
        </div>
      </x-white-box>
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
                    <div class="flex items-center justify-center">
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
                    </div>
                </x-table-cell>
            </x-table-row>
          @endforeach
        </tbody>
      </x-table>
    </x-white-box>

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
      <x-slot name="header"><span class="text-lg-bd">Tunggu Sebentar</span></x-slot>
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
            const id = element.parentElement.parentElement.parentElement.getAttribute('data-id');
            onClickDeleteEventAcademic(this, '{{ route('academics-event.index') }}', '{{ route('academics-event.delete', ['id' => ':id']) }}'.replace(':id', id))
          "
        >
          Hapus
        </x-button.primary>
      </x-slot>
    </x-modal.container-pure-js>
  </div>
@endsection
