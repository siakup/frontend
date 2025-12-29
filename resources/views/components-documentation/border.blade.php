<x-layouts.main>
    <x-layouts.content title="Border Documentation">

        <x-container.wrapper :height="'fit'" :width="'full'" class="mb-3">
            <x-typography :variant="'heading-h6'">
                Border Radius
            </x-typography>
            {{-- Radius LG --}}
            <x-container.container radius="lg" :border="'solid'" borderWidth="2" borderColor="gray-500" padding="8"
                background="bg-red-100" gapY="4" :width="'fit'" :height="'fit'">
                <x-container.wrapper rows="2" :height="'full'" :width="'full'" :justify="'center'">
                    <x-container.wrapper cols="2">
                        <x-typography :variant="'body-medium-semibold'">
                            radius-lg
                        </x-typography>
                        <x-typography :variant="'body-medium-regular'" class="text-end">
                            20px
                        </x-typography>
                    </x-container.wrapper>
                    <x-typography :variant="'body-small-semibold'" class="text-gray-600">
                        Digunakan untuk bottom sheet (mobile)
                    </x-typography>
                </x-container.wrapper>

                {{-- Radius MD --}}
                <x-container.container radius="md" border="solid" borderWidth="2" borderColor="gray-500"
                    padding="4" background="bg-red-50">

                    <x-container.wrapper rows="2" :height="'full'" :width="'full'" :justify="'center'">
                        <x-container.wrapper cols="2">
                            <x-typography :variant="'body-medium-semibold'">
                                radius-md
                            </x-typography>
                            <x-typography :variant="'body-medium-regular'" class="text-end">
                                12px
                            </x-typography>
                        </x-container.wrapper>
                        <x-typography :variant="'body-small-semibold'" class="text-gray-600">
                            Digunakan untuk card section (website)
                        </x-typography>
                    </x-container.wrapper>

                    {{-- Radius SM --}}
                    <x-container.container radius="sm" border="solid" borderWidth="2" borderColor="gray-500"
                        padding="4" background="bg-red-50">
                        <x-container.wrapper :height="'full'" :width="'full'" :justify="'center'">
                            <x-container.wrapper cols="2">
                                <x-typography :variant="'body-medium-semibold'">
                                    radius-sm
                                </x-typography>
                                <x-typography :variant="'body-medium-regular'" class="text-end">
                                    8px
                                </x-typography>
                            </x-container.wrapper>
                            <x-typography :variant="'body-small-semibold'" class="text-gray-600">
                                Digunakan untuk card section (mobile),
                            </x-typography>
                            <x-typography :variant="'body-small-semibold'" class="text-gray-600">
                                digunakan untuk component (website)
                            </x-typography>
                        </x-container.wrapper>
                    </x-container.container>

                </x-container.container>
            </x-container.container>
        </x-container.wrapper>

        <x-container.wrapper :height="'fit'" :width="'full'" gapY="3">
            <x-typography :variant="'heading-h6'">
                Border
            </x-typography>
            <x-container.container radius="md" border="solid" borderWidth="2" borderColor="gray-300" padding="12">
                <x-container.wrapper :height="'full'" :width="'full'">
                    <x-container.wrapper cols="2">
                        <x-typography :variant="'body-medium-semibold'">
                            border
                        </x-typography>
                        <x-typography :variant="'body-medium-regular'">
                            1px border-color(gray-300)
                        </x-typography>
                    </x-container.wrapper>
                </x-container.wrapper>
            </x-container.container>
            <x-typography :variant="'body-medium-regular'">
                Gunakan border dengan ukuran 1px solid dengan warna gray-300. Supaya lebih terlihat section/card maka perlu ditambahkan shadow.
            </x-typography>
                        {{-- Code --}}
            <pre class="bg-gray-900 text-gray-300 p-3 rounded-lg text-xs overflow-x-auto">
&lt;x-container.container
    border="solid" borderWidth="2" borderColor="gray-300"" radius="md" shadow="low"
/&gt;
            </pre>
        </x-container.wrapper>
    </x-layouts.content>
</x-layouts.main>
