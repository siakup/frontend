@extends('layouts.main')

@section('title', 'Daftar Kelas')

@section('javascript')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('daftarKelas', () => ({
                async deleteData(id) {
                    try {
                        // const response = await fetch(`/api/ekuivalensi/${id}`, {
                        //     method: 'DELETE'
                        // });
                        // if (!response.ok) throw new Error("Gagal hapus");

                        console.log('Berhasil menghapus data dengan id:', id);

                        // akses komponen blade & trigger
                        this.$store.flashMessage.trigger();

                    } catch (err) {
                        console.error(err);
                        this.$store.flashMessage.type = 'error';
                        this.$store.flashMessage.message = 'Gagal menghapus data';
                        this.$store.flashMessage.trigger();
                    }
                }
            }))
        })
    </script>
@endsection

@section('content')
    <x-container.container variant="content-wrapper" x-data="daftarKelas">
        <x-typography variant="heading-h6" bold class="">
            Daftar Kelas
        </x-typography>

        <x-button.back href="{{ route('academics.auto-assign.index') }}">
            Auto Assign
        </x-button.back>

        <x-container.container class="gap-5 flex flex-col">
            <x-typography variant="heading-h6" class="mb-2">
                Daftar Kelas Hasil Auto Assign
            </x-typography>

            <x-container.container class="flex justify-between">
                <x-form.search
                    name="keyword"
                    placeholder="Cari mata kuliah..."
                    class="max-w-md"
                />

                <x-button.secondary iconPosition="right" icon="{{asset('assets/chat-bubble.svg')}}">Urutkan</x-button.secondary>
            </x-container>

            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell>Nama</x-table.header-cell>
                        <x-table.header-cell>Kode Mata Ajar</x-table.header-cell>
                        <x-table.header-cell>Nama Mata Ajar</x-table.header-cell>
                        <x-table.header-cell>Peserta/Disetujui/Kapasitas</x-table.header-cell>
                        <x-table.header-cell colspan="2">Operasi</x-table.header-cell>
                        <x-table.header-cell>Hapus Peserta</x-table.header-cell>
                    </x-table.row>
                </x-table.head>

                <x-table.body>
                    @foreach($data as $idx => $row)
                        <x-table.row
                            :odd="$idx % 2 === 1"
                            :last="$idx === count($data) - 1"
                        >
                            <x-table.cell>{{ $row['nama'] }}</x-table.cell>
                            <x-table.cell>{{ $row['kode_mata_ajar'] }}</x-table.cell>
                            <x-table.cell>{{ $row['nama_mata_ajar'] }}</x-table.cell>

                            {{-- gabungkan peserta/disetujui/kapasitas jadi satu cell seperti header --}}
                            <x-table.cell>
                                {{ $row['peserta'] }}/{{ $row['disetujui'] }}/{{ $row['kapasitas'] }}
                            </x-table.cell>

                            <x-table.cell>
                                <a class="text-blue-400" href="{{ route('academics.auto-assign.filled-member') }}">
                                    Peserta Diisi
                                </a>
                            </x-table.cell>

                            <x-table.cell>
                                <a class="text-blue-400" href="{{ route('academics.auto-assign.approved-member') }}">
                                    Peserta Disetujui
                                </a>
                            </x-table.cell>

                            <x-table.cell class="flex justify-center" x-data="{ showModalDeleteConfirmation: false }">
                                <x-button.action type="delete" label="Hapus" x-on:click="$dispatch('open-modal', {id: 'delete-confirmation'})" />
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-table.body>
            </x-table.index>

        </x-container>

        {{-- TODO: Id nya jan lupa nnti yak --}}
        <div @on-submit="await deleteData(1);">
            <!-- Modal Konfirmasi Hapus -->
            <x-modal.confirmation iconUrl="{{ asset('assets/icon-delete-gray-800.svg') }}" id="delete-confirmation"
                                  title="Hapus Peserta" confirmText="Ya, Hapus" cancelText="Batal">

                <div class="text-center">
                    <x-typography>Apakah Anda yakin ingin menghapus peserta ini?</x-typography>
                </div>

            </x-modal.confirmation>
        </div>

        <x-flash-message type="success" message="Peserta berhasil dihapus"
                         redirect="{{ route('curriculum.equivalence') }}" />
    </x-container>
@endsection
