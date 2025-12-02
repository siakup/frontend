<x-modal.container id="view-rencana-evaluasi" maxWidth="5xl">
    <x-slot name="header" class="items-center bg-gray-200">
        <div class="w-full relative flex items-center justify-center">
            <x-typography variant="heading-h5">Lihat Rencana Evaluasi Mahasiswa</x-typography>
            <button x-on:click.stop="close()"
                class="absolute right-0">
                <x-icon iconUrl="{{ asset('assets/base/icon-close-cancel.svg') }}" class="h-6 w-6"/>
            </button>
        </div>
    </x-slot>
    <x-container.container class="flex flex-col gap-3" borderRadius="rounded-xl">
        <x-form.input-container labelClass="w-50">
            <x-slot name="label">Bentuk Ujian</x-slot>
            <x-slot name="input">
                <x-form.dropdown
                    variant="gray"
                    buttonId="dropdownUjianButton"
                    dropdownId="dropdownUjianList"
                    label="-Pilih Bentuk Ujian-"
                    :dropdownItem="$bentukUjian"
                    dropdownContainerClass="w-full"
                    :imgSrc="asset('assets/icon-arrow-down-grey-20.svg')"
                    :isIconCanRotate="true"
                    disabled
                />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container labelClass="w-50">
            <x-slot name="label">Judul Evaluasi</x-slot>
            <x-slot name="input">
                <x-form.input
                    name="judul_evaluasi"
                    placeholder="Masukkan Judul Evaluasi"
                    disabled
                />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container labelClass="w-50">
            <x-slot name="label">Sub CPMK</x-slot>
            <x-slot name="input">
                <div class="flex flex-col gap-3">
                    @foreach($subCpmk as $value => $label)
                    <x-form.checklist 
                        id="{{ $value }}" 
                        value="{{ $value }}" 
                        label="{{ $label }}" 
                        name="{{ $value }}" 
                        disabled
                    />
                    @endforeach
                </div>
            </x-slot>
        </x-form.input-container>
        <x-form.input-container labelClass="w-50">
            <x-slot name="label">Deskripsi Evaluasi</x-slot>
            <x-slot name="input">
                <x-form.textarea
                    id="deskripsi_evaluasi"
                    maxChar="100"
                    rows="5"
                    placeholder="Masukkan Deskripsi Evaluasi"
                    disabled
                />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container labelClass="w-50">
            <x-slot name="label">Metode Pengerjaan Evaluasi</x-slot>
            <x-slot name="input">
                <x-form.textarea
                    id="metode_pengerjaan_evaluasi"
                    maxChar="100"
                    rows="5"
                    placeholder="Masukkan Metode Pengerjaan Evaluasi"
                    disabled
                />
            </x-slot>
        </x-form.input-container>
        <x-form.input-container labelClass="w-50">
            <x-slot name="label">Bentuk dan Format Luaran</x-slot>
            <x-slot name="input">
                <x-form.textarea
                    id="bentuk_format_luaran"
                    maxChar="100"
                    rows="5"
                    placeholder="Masukkan Bentuk dan Format Luaran"
                    disabled
                />
            </x-slot>
        </x-form.input-container>
    </x-container>
    <div class="flex flex-col gap-4 my-5">
        <x-typography variant="body-medium-bold">Indikator, Kriteria dan Bobot Penilaian</x-typography>
        <x-table.index>
            <x-table.head>
                <x-table.row>
                    <x-table.header-cell>Indikator dan Kriteria</x-table.header-cell>
                    <x-table.header-cell>Bobot</x-table.header-cell>
                </x-table.row>
            </x-table.head>
            <x-table.body>
                @foreach ($indikatorList as $index => $indikator)
                <x-table.row>
                    <x-table.cell class="text-xs">{{ $indikator['indikator'] }}</x-table.cell>
                    <x-table.cell class="text-xs">{{ $indikator['bobot'] }}</x-table.cell>
                </x-table.row>
                @endforeach
            </x-table.body>
        </x-table.index>
        <x-typography variant="body-medium-bold">Jadwal Pelaksanaan</x-typography>
        <x-table.index>
            <x-table.head>
                <x-table.row>
                    <x-table.header-cell>Nama Kegiatan</x-table.header-cell>
                    <x-table.header-cell>Minggu ke-</x-table.header-cell>
                </x-table.row>
            </x-table.head>
            <x-table.body>
                @foreach ($jadwalPelaksanaan as $index => $jadwal)
                <x-table.row>
                    <x-table.cell class="text-xs">{{ $jadwal['nama_kegiatan'] }}</x-table.cell>
                    <x-table.cell class="text-xs">{{ $jadwal['minggu_ke'] }}</x-table.cell>
                </x-table.row>
                @endforeach
            </x-table.body>
        </x-table.index>
    </div>
    <x-form.input-container labelClass="w-50">
        <x-slot name="label">Catatan dan Lainnya</x-slot>
        <x-slot name="input">
            <x-form.textarea
                id="catatan"
                maxChar="100"
                rows="5"
                disabled
            />
        </x-slot>
    </x-form.input-container>
</x-modal.container>