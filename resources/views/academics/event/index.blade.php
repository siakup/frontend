<x-layouts.main>
  <x-layouts.content>    
    @section('javascript')
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <script src="{{ asset('js/custom/event.js')}}"></script>
      @include('partials.success-notification-modal', ['route' => route('academics-event.index')])
    @endsection
    <x-container.wrapper cols="1" class="grid-rows-[auto_1fr]" height="full" width="full">

      <x-container.container padding="pt-4" height="full" width="full">
        <x-tab :tabItems="[
            (object) [
                'routeName' => 'academics-periode.index',
                'routeQuery' => 'academics-periode.index',
                'title' => 'Periode Akademik',
            ],
            (object) [
                'routeName' => 'academics-event.index',
                'routeQuery' => 'academics-event.index',
                'title' => 'Event Akademik',
            ],
        ]" />
      </x-container.container>

      <x-container.container height="full" width="full">
        <x-container.container width="full" background="bg-white" padding="p-4" class="rounded-tl-none border-t border-t-red-500">
          <x-container.wrapper gapY="4" cols="1" class="grid grid-rows-[auto_1fr]" height="fit" width="full">

            <x-container.container height="full" width="full" padding="" class="justify-end self-center">
                <x-container.wrapper cols="2" rows="1" gapX="4" justify="end" width="max">

                    <x-container.container width="full">
                      <x-button.secondary icon="upload/red-20" iconPosition="right" :href="route('academics-event.upload')">Unggah Event Akademik</x-button.primary>
                    </x-container.container>

                    <x-container.container width="full">
                      <x-button.primary :href="route('academics-event.create')">Tambah Event Akademik</x-button.primary>
                    </x-container.container>

                </x-container.wrapper>
            </x-container.container>

            <x-container.container padding="p-4" width="full" background="content-white" class="justify-between items-center">
              <x-container.wrapper cols="2" rows="1" width="full">
                  
              <x-container.container width="full">
                <x-form.search-v2 
                  class="w-full"
                  :inputParentClass="'w-max'"
                  :routes="route('academics-event.index')"
                  :fieldKey="'nama_event'"
                  :placeholder="'Nama Event'"
                  :search="$search"
                />
              </x-container.container>

              <x-container.container width="full" class="justify-end">
                <x-filter-button /> 
              </x-container.container>

              </x-container.wrapper>
            </x-container.container>

            <x-container.container width="full" height="max">
              <x-table.index variant="old">
                <x-table.head variant="old">
                  <x-table.row variant="old">
                    <x-table.header-cell variant="old">Nama Event</x-table.header-cell>
                    <x-table.header-cell variant="old">Event <br> Nilai</x-table.header-cell>
                    <x-table.header-cell variant="old">Event <br> IRS</x-table.header-cell>
                    <x-table.header-cell variant="old">Event <br> Lulus</x-table.header-cell>
                    <x-table.header-cell variant="old">Event <br> Registrasi</x-table.header-cell>
                    <x-table.header-cell variant="old">Event <br> Yudisium</x-table.header-cell>
                    <x-table.header-cell variant="old">Event <br> Survei</x-table.header-cell>
                    <x-table.header-cell variant="old">Event <br> Dosen</x-table.header-cell>
                    <x-table.header-cell variant="old">Status</x-table.header-cell>
                    <x-table.header-cell variant="old">Aksi</x-table.header-cell>
                  </x-table.row>
                </x-table.head>
                <tbody>
                  @foreach ($data['data'] ?? [] as $event)
                    <x-table.row variant="old">
                        <x-table.cell variant="old">{{ $event['nama_event'] }}</x-table.cell>
                        <x-table.cell variant="old">{{ $event['nilai_on'] ? 'Ya' : 'Tidak' }}</x-table.cell>
                        <x-table.cell variant="old">{{ $event['irs_on'] ? 'Ya' : 'Tidak' }}</x-table.cell>
                        <x-table.cell variant="old">{{ $event['lulus_on'] ? 'Ya' : 'Tidak' }}</x-table.cell>
                        <x-table.cell variant="old">{{ $event['registrasi_on'] ? 'Ya' : 'Tidak' }}</x-table.cell>
                        <x-table.cell variant="old">{{ $event['yudisium_on'] ? 'Ya' : 'Tidak' }}</x-table.cell>
                        <x-table.cell variant="old">{{ $event['survei_on'] ? 'Ya' : 'Tidak' }}</x-table.cell>
                        <x-table.cell variant="old">{{ $event['dosen_on'] ? 'Ya' : 'Tidak' }}</x-table.cell>
                        <x-table.cell variant="old">
                          @if ($event['status'] === 'active')
                            <x-badge variant="green-filled">Aktif</x-badge>
                          @else
                            <x-badge variant="green-bordered">Tidak Aktif</x-badge>
                          @endif
                        </x-table.cell>
                        <x-table.cell variant="old">
                            <x-container.container class="flex flex-row items-center justify-center">
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
                        </x-table.cell>
                    </x-table.row>
                  @endforeach
                </tbody>
              </x-table.index>
            </x-container.container>

          </x-container.wrapper>
        </x-container.container>
      </x-container.container>
    </x-container.wrapper>
    
    <div id="eventDetailModalContainer"></div>

    <x-modal.container-pure-js id="modalKonfirmasiHapus">
      <x-slot name="header">
        <x-container.container width="full" class="flex flex-row justify-between items-center !px-0 !ps-5 !gap-0">
          <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Tunggu Sebentar</x-typography>
          <x-icon name="delete/grey-20" class="w-8 h-8" />
        </x-container>
      </x-slot>
      <x-slot name="body">Apakah Anda yakin ingin menghapus event akademik ini?</x-slot>
      <x-slot name="footer">
        <x-button.secondary 
          onclick="
            this.parentElement.parentElement.parentElement.classList.add('hidden');
            this.parentElement.parentElement.parentElement.classList.remove('flex');
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
  </x-layouts.content>
</x-layouts.main>
