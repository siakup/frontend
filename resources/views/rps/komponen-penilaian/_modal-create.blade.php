<script src="{{ asset('js/controllers/rpsKomponenPenilaian.js') }}" defer></script>

<div x-data="komponenPenilaian()">
    <x-modal.container id="create-komponen-penilaian" maxWidth="6xl">
        <x-slot name="header" class="items-center bg-[#F5F5F5]">
            <div class="w-full relative flex items-center justify-center">
                <x-typography variant="heading-h5">Tambah Komponen Nilai</x-typography>
                <button x-on:click.stop="close()"
                    class="absolute right-0">
                    <x-icon name="close-cancel/black-24"/>
                </button>
            </div>
        </x-slot>
        <div class="content-white flex-col rounded-md py-3 px-5 gap-5">
            <x-form.input-container >
                <x-slot name="label">Nama Komponen Nilai</x-slot>
                <x-slot  name="input">
                    <x-form.dropdown
                        variant="gray"
                        buttonId="dropdownKomponenButton"
                        dropdownId="dropdownKomponenList"
                        label="-Pilih Komponen Nilai-"
                        :dropdownItem="$komponenPenilaian"
                        dropdownContainerClass="w-full"
                        :imgSrc="asset('assets/icon-arrow-down-grey-20.svg')"
                        :isIconCanRotate="true"
                        x-model="nama"
                    />
                </x-slot>
            </x-form.input-container>
            <x-form.input-container >
                <x-slot name="label">Bobot Komponen</x-slot>
                <x-slot name="input">
                    <div class="flex w-full">
                        <x-form.input
                            name="bobot"
                            placeholder="Contoh: 30.00"
                            type="number"
                            x-model="bobot"
                        />
                        <div class="-ml-16 w-16 input-suffix">
                            %
                        </div>
                    </div>
                </x-slot>
            </x-form.input-container>
            <x-form.input-container  :labelWrap="true">
                <x-slot name="label">Capaian Pembelajaran MK</x-slot>
                <x-slot  name="input">
                    <div class="grid grid-rows-2 grid-flow-col gap-y-7 gap-x-9 w-full">
                    @foreach($cpmkList as $index => $cpmk)
                        <x-form.checklist id="{{ $index }}" value="{{ $index }}" label="{{ $cpmk }}" name="{{ $cpmk }}" x-model="cpmk"/>
                    @endforeach
                    </div>
                </x-slot>
            </x-form.input-container>
        </div>
        <x-slot name="footer" class="flex justify-end gap-3">
            <x-button.secondary x-bind:disabled="isDisabled" x-on:click="$dispatch('close-modal', { id: 'create-komponen-penilaian' })">Batal</x-button.secondary>
            <x-button.primary 
                x-bind:disabled="isDisabled"
                x-on:click="
                    $dispatch('close-modal', { id: 'create-komponen-penilaian' });
                    $dispatch('open-modal', { id: 'save-confirmation' });
                "
            >
                Simpan
            </x-button.primary>
        </x-slot>

    </x-modal.container>
</div>


<x-modal.confirmation 
        id="save-confirmation" 
        title="Tunggu Sebentar" 
        confirmText="Ya, Simpan Sekarang"
        cancelText="Cek Kembali"
    >
        <p>Apakah Anda yakin informasi yang ditambahkan sudah benar?</p>
</x-modal.confirmation>