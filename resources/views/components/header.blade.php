<div class="grid grid-cols-12 grid-rows-3 w-full h-36 bg-gradient-to-r from-white via-white to-[#FFECED]">
    <div class="col-start-1 col-end-4 row-span-3 grid grid-cols-6 grid-rows-3 items-center">
        <x-button x-on:click="$store.mainLayout.isOpen = !$store.mainLayout.isOpen" :variant="'tertiary'" :icon="'arrow-left/black-32'"
            class="row-start-2 row-end-3 col-start-1 col-end-2" />
        <div class="shrink-0 col-start-2 col-end-6 row-start-1 row-end-4">
            <img src="{{ asset('images/uper.png') }}" alt="Logo" class=" w-[180px] h-auto block my-0 mx-auto">
            <div class="flex items-center justify-center gap-1 mb-1 w-[156px] mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="5" viewBox="0 0 40 5" fill="none">
                    <path d="M0.5 2.5H39.5" stroke="#0076BE" stroke-width="8" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="5" viewBox="0 0 56 5" fill="none">
                    <path d="M0.5 2.5H55.5" stroke="#E62129" stroke-width="8" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="5" viewBox="0 0 60 5" fill="none">
                    <path d="M0.5 2.5H59.5" stroke="#98A725" stroke-width="8" />
                </svg>
            </div>
            <div class="flex items-center justify-center gap-1 mb-1 w-[156px] mx-auto text-center text-xs leading-5">
                <span class="text-[#0076BE]">Sistem</span>
                <span class="text-[#E62129]">Informasi</span>
                <span class="text-[#98A725]">Akademik</span>
            </div>
        </div>
        <div class="col-start-6 col-end-7 row-start-1 row-end-4"></div>
    </div>
    <div
        class="col-start-4 col-end-7 row-span-3 grid grid-rows-3 justify-start items-start p-5 border-b-[1px] border-b-[#d9d9d9]">
        <div class="row-start-1 self-end">
            <x-typography :variant="'heading-h6'">Selamat Datang, {{ explode(' ', session('nama'))[0] }}!</x-typography>
        </div>
        <div class="row-start-2 self-end">
            <x-typography
                :variant="'body-small-regular'">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</x-typography>
        </div>
        <div class="row-start-3">
            <x-typography :variant="'pixie-regular'">{{ \Carbon\Carbon::now()->format('H:i') }} WIB</x-typography>
        </div>
    </div>
    <div class="col-start-7 col-end-10 row-span-3 px-10 py-7 border-b-[1px] border-b-[#d9d9d9]">
        <div class="flex items-start gap-2 p-2 border-[1px] border-[#D9D9D9] rounded-lg">
            <x-icon :name="'search/grey-20'" alt="Search"></x-icon>
            <input type="text" placeholder="Cari" class="w-full text-sm focus:outline-none focus:border-none">
        </div>
    </div>
    <div
        class="col-start-10 col-end-12 row-span-3 grid grid-rows-2 w-full h-full gap-1 border-b-[1px] border-b-[#d9d9d9]">
        <div class="row-start-1 row-end-2 self-end flex items-center gap-3">
            <x-icon :name="'human/women'" alt="Women"></x-icon>
            <x-typography :variant="'body-medium-bold'">{{ session('nama') }}</x-typography>
        </div>
        <div class="row-start-2 row-end-3 self-start flex flex-col gap-1">
            <x-typography :variant="'caption-regular'">Periode Akademik 2024–2025</x-typography>
            <x-typography :variant="'pixie-regular'">(Admin – Universitas Pertamina)</x-typography>
        </div>
    </div>
    <div class="col-start-12 col-end-13 row-span-3 flex items-center gap-6 border-b-[1px] border-b-[#d9d9d9]">
        <x-icon :name="'notification/grey-32'" alt="Notification"></x-icon>
        <x-icon :name="'setting/grey-32'" alt="Setting"></x-icon>
    </div>
</div>
