@extends('layouts.main')

@section('title', 'Daftar Peserta Kelas')

@section('javascript')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('daftarPeserta', () => ({
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
    <x-container.container variant="content-wrapper" x-data="daftarPeserta">
{{--        TODO: ambil nama kelas dr db--}}
        <x-typography variant="heading-h6" bold class="">
            Daftar Peserta Kelas - {{$makul}}
        </x-typography>

        <x-button.back href="{{ route('academics.auto-assign.view') }}">
            Daftar Kelas
        </x-button.back>

        <x-container.container class="gap-5 flex flex-col">
            {{--        TODO: ambil nama kelas dr db--}}
            <x-typography variant="heading-h6" class="mb-2">
                Daftar Peserta Kelas - {{$makul}}
            </x-typography>

            <x-table.index>
                <x-table.head>
                    <x-table.row>
                        <x-table.header-cell>No</x-table.header-cell>
                        <x-table.header-cell>Nomor Induk Mahasiswa</x-table.header-cell>
                        <x-table.header-cell>Nama Mahasiswa</x-table.header-cell>
                        <x-table.header-cell>Status</x-table.header-cell>
                        <x-table.header-cell>Status Akademik</x-table.header-cell>
                        <x-table.header-cell>Aksi</x-table.header-cell>
                    </x-table.row>
                </x-table.head>

                <x-table.body>
                    @foreach($data as $idx => $row)
                        <x-table.row
                            :odd="$idx % 2 === 1"
                            :last="$idx === count($data) - 1"
                        >
                            <x-table.cell>{{ $idx + 1 }}</x-table.cell>
                            <x-table.cell>{{ $row['nim'] }}</x-table.cell>
                            <x-table.cell>{{ $row['nama'] }}</x-table.cell>
                            <x-table.cell>{{ $row['status'] }}</x-table.cell>
                            <x-table.cell>{{ $row['status_akademik'] }}</x-table.cell>

                            <x-table.cell class="flex justify-center">
                                <x-button.action type="delete" label="Hapus"
                                                 x-on:click="$dispatch('open-modal', {id: 'delete-confirmation'})" />
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
