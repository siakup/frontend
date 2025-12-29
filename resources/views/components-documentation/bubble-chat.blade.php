<x-layouts.main>
    <x-layouts.content title="Bubble Chat Documentation">
        <x-container.wrapper :cols="1" :gapY="4">
            <x-container.container padding="6" border="solid" borderWidth="1" borderColor="gray-200" radius="lg"
                gap="10" class="flex-col">
                <x-container.container class="flex-col">
                    <x-typography variant="body-large-semibold">
                        Komponen Bubble Chat
                    </x-typography>

                    <x-typography variant="body-small-regular" class="text-gray-600 mt-1">
                        Komponen <strong>Bubble Chat</strong> digunakan untuk menampilkan
                        percakapan berbentuk balon chat antara <em>sender</em> dan
                        <em>receiver</em>, lengkap dengan avatar, nama, role, pesan,
                        dan timestamp.
                    </x-typography>
                </x-container.container>

                <x-container.container class="flex-col">
                    <x-typography variant="body-medium-semibold" class="mb-3">
                        Props & State
                    </x-typography>
                    <x-container.container spaceY="3" class="text-gray-700 text-sm leading-relaxed flex-col">
                        <x-container.container gapX="2">
                            <x-typography :variant="'body-medium-semibold'">
                                type
                            </x-typography>
                            <x-typography :variant="'body-medium-regular'">
                                - Tipe chat.
                                Nilai: <code>sender</code> | <code>receiver</code>
                            </x-typography>
                        </x-container.container>
                        <x-container.container gapX="2">
                            <x-typography :variant="'body-medium-semibold'">
                                role
                            </x-typography>
                            <x-typography :variant="'body-medium-regular'">
                                - Role/label user (contoh: Admin, User).
                            </x-typography>
                        </x-container.container>
                        <x-container.container gapX="2">
                            <x-typography :variant="'body-medium-semibold'">
                                message
                            </x-typography>
                            <x-typography :variant="'body-medium-regular'">
                                - Isi pesan chat
                            </x-typography>
                        </x-container.container>
                        <x-container.container gapX="2">
                            <x-typography :variant="'body-medium-semibold'">
                                timestamp
                            </x-typography>
                            <x-typography :variant="'body-medium-regular'">
                                - Waktu pesan (diformat menggunakan)
                                <code>window.formatter.formatDateTime()</code>
                            </x-typography>
                        </x-container.container>
                        <x-container.container gapX="2">
                            <x-typography :variant="'body-medium-semibold'">
                                imgProfile
                            </x-typography>
                            <x-typography :variant="'body-medium-regular'">
                                - URL foto profil
                            </x-typography>
                        </x-container.container>
                        <x-container.container gapX="2">
                            <x-typography :variant="'body-medium-semibold'">
                                x-data
                            </x-typography>
                            <x-typography :variant="'body-medium-regular'">
                                - Alpine state untuk binding data chat
                            </x-typography>
                        </x-container.container>
                        <x-container.container gapX="2">
                            <x-typography :variant="'body-medium-semibold'">
                                slot
                            </x-typography>
                            <x-typography :variant="'body-medium-regular'">
                                - Konten tambahan (opsional), misalnya action atau status
                            </x-typography>
                        </x-container.container>
                    </x-container.container>
                </x-container.container>

                <x-container.wrapper :cols="1" gapY="2">
                    <x-typography :variant="'body-medium-semibold'">
                        Preview Bubble Chat
                    </x-typography>

                    <x-container.container radius="md" background="bg-gray-50" padding="4">
                        <x-bubble-chat x-data="{
                            type: 'receiver',
                            name: 'Albert Einsten',
                            role: 'Mahasiswa',
                            message: 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Consectetur adipiscing elit quisque faucibus ex sapien vitae. Ex sapien vitae pellentesque sem placerat in id. Placerat in id cursus mi pretium tellus duis. Pretium tellus duis convallis tempus leo eu aenean.',
                            timestamp: new Date(),
                            imgProfile: '{{ asset('assets/icons/human/women.svg') }}'
                        }" />
                    </x-container.container>

                    <x-container.container radius="md" background="bg-gray-50" padding="4">
                        <x-bubble-chat x-data="{
                            type: 'sender',
                            name: 'Meredita Susanty, M.Sc',
                            role: 'Dosen',
                            message: 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Elit quisque faucibus ex sapien vitae pellentesque sem. Sem placerat in id cursus mi pretium tellus. Tellus duis convallis tempus leo eu aenean sed. Sed diam urna tempor pulvinar vivamus fringilla lacus. Lacus nec metus bibendum egestas iaculis massa nisl. Nisl malesuada lacinia integer nunc posuere ut hendrerit.',
                            timestamp: new Date(),
                            imgProfile: '{{ asset('assets/icons/human/women.svg') }}'
                        }">
                            <x-slot:status>
                                <x-typography variant="caption-regular" class="text-blue-500">
                                    Delivered
                                </x-typography>
                            </x-slot:status>

                            <x-slot:actions>
                                <x-button :variant="'text-link'" :size="'sm'">
                                    Edit
                                </x-button>
                            </x-slot:actions>
                        </x-bubble-chat>
                    </x-container.container>
                </x-container.wrapper>

                <x-container.container class="flex-col">
                    <x-typography :variant="'body-medium-semibold'">
                        Contoh Penggunaan
                    </x-typography>
                    <pre class="bg-gray-900 text-gray-100 p-4 rounded-lg text-sm overflow-x-auto">
&lt;x-bubble-chat
    x-data="{
        type: 'sender',
        name: 'Admin Testing',
        role: 'Admin',
        message: 'Ini Pesan Pengirim.',
        timestamp: new Date(),
        imgProfile: '/images/avatar.png'
    }"&gt;
    &lt;x-slot:status&gt;
        &lt;x-typography variant="caption-regular" class="text-blue-500">
            Delivered
        &lt;/x-typography&gt;
    &lt;/x-slot:status&gt;

    &lt;x-slot:actions&gt;
        &lt;x-button :variant="'text-link'" :size="'sm'"&gt;
            Edit
        &lt;/x-button&gt;
    &lt;/x-slot:actions&gt;
&lt;/x-bubble-chat&gt;

&lt;x-bubble-chat
    x-data="{
        type: 'receiver',
        name: 'User Testing',
        role: 'User',
        message: 'Ini Pesan Penerima.',
        timestamp: new Date(),
        imgProfile: '/images/avatar.png'
    }"
/&gt;
            </pre>
                </x-container.container>
            </x-container.container>
        </x-container.wrapper>
    </x-layouts.content>
</x-layouts.main>
