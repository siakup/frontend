@extends('layouts.main')

@section('title', 'Akademik')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Akademik</div>
@endsection

@section('javascript')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>
    function onClickDetailPeriodeAcademic(element, route) {
      const idPeriode = element.getAttribute('data-periode-akademik');
      if (idPeriode) {
        $.ajax({
          url: route,
          method: 'GET',
          data: { id: idPeriode },
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
          success: function(html) {
            $('#periodeDetailModalContainer').html(html);
            $('#modalPeriodeAkademik').removeClass('hidden').addClass('flex');
          }
        });
      }
    }

    function onClickDeletePeriodeAcademic(element, redirectRoute) {
      const id = document.getElementById('modalKonfirmasiHapus').getAttribute('data-id');
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      $.ajax({
        url: "/academics/periode/delete/" + id,
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
          const modalKonfirmasiHapus = document.getElementById('modalKonfirmasiHapus');
          modalKonfirmasiHapus.removeAttribute('data-id');
          modalKonfirmasiHapus.style.add('hidden');
          modalKonfirmasiHapus.style.remove('flex');
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
        <div class="self-end gap-5 m-5 w-max">
          <x-button.primary
            :href="route('academics-periode.create')"
          >
            Tambah Periode Akademik
          </x-button.primary>
        </div>
        <x-white-box :class="''">
          <div class="flex justify-between items-center p-4">
            <x-form.search-v2 
              class="w-80"
              :inputParentClass="'w-max'"
              :routes="route('academics-periode.index')"
              :fieldKey="['tahun', 'semester', 'status']"
              :placeholder="'Tahun/Semester/Tahun Akademik/Status'"
              :search="$search"
            />
            <x-filter-button />
          </div>
        </x-white-box>
        <x-table :variant="'old'">
          <x-table-head :variant="'old'">
            <x-table-row :variant="'old'">
              <x-table-header :variant="'old'">Tahun</x-table-header>
              <x-table-header :variant="'old'">Semester</x-table-header>
              <x-table-header :variant="'old'">Tahun Akademik</x-table-header>
              <x-table-header :variant="'old'">Status</x-table-header>
              <x-table-header :variant="'old'">Aksi</x-table-header>
            </x-table-row>
          </x-table-head>
          <tbody>
            @if (empty($data->data) || count($data->data) === 0)
              @include('academics.periode.error-filter')
            @else
              @foreach ($data->data as $periode)
                <x-table-row :variant="'old'">
                  <x-table-cell :variant="'old'">{{ $periode->tahun }}</x-table-cell>
                  <x-table-cell :variant="'old'">{{ $namaSemester[$periode->semester] ?? 'Tidak Diketahui' }}</x-table-cell>
                  <x-table-cell :variant="'old'">{{ $periode->tahun }}/{{ $periode->tahun + 1 }}</x-table-cell>
                  <x-table-cell :variant="'old'">
                      @if ($periode->status === 'active')
                        <x-badge class="bg-[#D0DE68]">Aktif</x-badge>
                      @else
                        <x-badge class="bg-[#FAFBEE] text-[#98A725] leading-5 border-[1px] border-[#D0DE68]">Tidak Aktif</x-badge>
                      @endif
                  </x-table-cell>
                  <x-table-cell :variant="'old'" class="flex items-center justify-center gap-6 center">
                    <x-button.base
                      :icon="asset('assets/icon-search.svg')"
                      class="scale-75"
                      onclick="onClickDetailPeriodeAcademic(this, '{{ route('academics-periode.detail') }}')" 
                      data-periode-akademik="{{ $periode->id }}"
                    >
                      Lihat
                    </x-button.base>
                    <x-button.base
                      :icon="asset('assets/icon-edit.svg')"
                      class="scale-75 text-[#E62129]"
                      href="{{ route('academics-periode.edit', ['id' => $periode->id]) }}"
                    >
                      Ubah
                    </x-button.base>
                    <x-button.base
                      :icon="asset('assets/icon-delete-gray-600.svg')"
                      class="scale-75 text-[#8C8C8C] btn-delete-periode-academic"
                      onclick="
                        document.getElementById('modalKonfirmasiHapus').setAttribute('data-id', {{$periode->id}});
                        document.getElementById('modalKonfirmasiHapus').classList.add('flex');
                        document.getElementById('modalKonfirmasiHapus').classList.remove('hidden');
                      "
                      data-id="{{ $periode->id }}"
                    >
                      Hapus
                    </x-button.base>
                  </x-table-cell>
                </x-table-row>
              @endforeach
            @endif
          </tbody>
        </x-table>
      </x-white-box>
      @include('partials.pagination', [
        'currentPage' => $data->pagination->current_page ?? 1,
        'lastPage' => $data->pagination->last_page ?? 1,
        'limit' => $limit,
        'routes' => route('academics-periode.index'),
        'showSearch' => false,
      ])
  </div>
  <div id="periodeDetailModalContainer"></div>

  <x-modal.container-pure-js id="modalKonfirmasiHapus">
    <x-slot name="header">
      <span class="text-lg-bd">Tunggu Sebentar</span>
      <img src="{{asset('assets/icon-delete-gray-800.svg')}}" alt="ikon-hapus" />
    </x-slot>
    <x-slot name="body">
      Apakah Anda yakin ingin menghapus periode akademik ini?
    </x-slot>
    <x-slot name="footer">
      <x-button.secondary 
        onclick="
          document.getElementById('modalKonfirmasiHapus').classList.add('hidden');
          document.getElementById('modalKonfirmasiHapus').classList.remove('flex');
          document.getElementById('modalKonfirmasiHapus').removeAttribute('data-id')
        "
      >
        Batal
      </x-button.secondary>
      <x-button.primary onclick="onClickDeletePeriodeAcademic(this, '{{ route('academics-periode.index') }}')">
        Hapus
      </x-button.primary>
    </x-slot>
  </x-modal.container-pure-js>
  @include('partials.success-modal')
@endsection
