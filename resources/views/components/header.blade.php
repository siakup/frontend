<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('headerComponents', {
            datas: null,
            paginationData: null,
            search: null,
            sort: null
        })
        Alpine.data('headerTime', window.HeaderController.headerTime);
    });
</script>

<x-container.wrapper cols="12" width="full" x-data="headerTime" class="border-b border-b-gray-400">

    {{-- LEFT SECTION --}}
    <x-container.container col="3" radius="none" {{-- x-bind:class="$store.mainLayout.isOpen ? '' : 'border-b border-b-gray-400'" --}}>
        <x-container.wrapper cols="6" items="center" class="px-5">
            <x-container.container col="1">
                <x-button x-on:click="$store.mainLayout.isOpen = !$store.mainLayout.isOpen" variant="text-link"
                    icon="arrow-left/black-32" />
            </x-container.container>

            <x-container.container col="4" class="justify-center">
                <x-container.wrapper>

                    <x-container.container class="!h-22 justify-center">
                        <img src="{{ asset('images/uper.png') }}" alt="Logo">
                    </x-container.container>

                    <x-container.container>
                        <x-container.container gap="gap-1" class="items-center justify-center">
                            <x-container.container radius="none" width="max"
                                class="justify-center border-t-5 border-blue-500">
                                <x-typography variant="caption-regular" class="text-blue-500">Sistem</x-typography>
                            </x-container.container>
                            <x-container.container radius="none" width="max"
                                class="justify-center border-t-5 border-red-500">
                                <x-typography variant="caption-regular" class="text-red-500">Informasi</x-typography>
                            </x-container.container>
                            <x-container.container radius="none" width="max"
                                class="justify-center border-t-5 border-green-700">
                                <x-typography variant="caption-regular" class="text-green-700">Akademik</x-typography>
                            </x-container.container>
                        </x-container.container>
                    </x-container.container>

                </x-container.wrapper>
            </x-container.container>

            <x-container.container col="1">
            </x-container.container>

        </x-container.wrapper>
    </x-container.container>

    {{-- MIDDLE & RIGHT SECTION --}}
    <x-container.container col="9" radius="none" {{-- class="border-b border-b-gray-400" --}}>
        <x-container.wrapper cols="12" width="full" radius="none" class="pt-3 px-5">

            <x-container.container col="4" radius="none">

                <x-container.wrapper class="py-2">

                    <x-container.container width="full" height="max" radius="none" class="self-end">
                        <x-typography variant="heading-h6" tag="h6">
                            Selamat Datang,
                            {{ explode(' ', session('nama'))[0] }}!
                        </x-typography>
                    </x-container.container>

                    <x-container.container width="full" height="max" radius="none" class="self-end">
                        <x-typography variant="body-small-regular" x-text="getDate()">

                        </x-typography>
                    </x-container.container>

                    <x-container.container width="full" height="max" radius="none" class="self-start">
                        <x-typography variant="pixie-regular" x-text="getTime()+' WIB'">

                        </x-typography>
                    </x-container.container>

                </x-container.wrapper>

            </x-container.container>

            <x-container.container col="4" radius="none" radius="none" class="p-5 items-start">
                <x-form.search value="" placeholder="Cari" :storeName="'headerComponents'" :storeKey="'datas'" :requestRoute="route('home')"
                    :responseKeyData="''" x-model="$store.headerComponents.search" />
            </x-container.container>

            {{-- IMAGE SECTION --}}
            <x-container.container col="3" radius="none">
                <x-container.wrapper class="py-2">
                    <x-container.container width="auto" height="auto" radius="none"
                        class="items-center self-end
                            ">
                        <x-icon name="human/women" alt="Women" class="pe-2"></x-icon>
                        <x-typography variant="body-medium-bold">{{ session('nama') }}</x-typography>

                    </x-container.container>
                    <x-container.container width="auto" height="auto" class="self-end">
                        <x-typography variant="caption-regular">Periode Akademik 2024–2025</x-typography>
                    </x-container.container>
                    <x-container.container width="auto" height="auto">
                        <x-typography variant="pixie-regular">(Admin – Universitas Pertamina)</x-typography>
                    </x-container.container>
                </x-container.wrapper>
            </x-container.container>

            <x-container.container col="1" height="max" class="items-start justify-between py-4 self-start">
                <x-icon name="notification/grey-32" alt="Notification"></x-icon>
                <x-icon name="setting/grey-32" alt="Setting" class="items-end"></x-icon>
            </x-container.container>

        </x-container.wrapper>
    </x-container.container>

</x-container.wrapper>
