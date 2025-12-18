<x-container.container
    x-data="{{ $attributes->get('x-data') }}"
    class="flex"
    gap="gap-0"
    x-bind:class="{
        'justify-end': type === 'sender',
        'justify-start': type === 'receiver'
    }"
>

    {{-- Row --}}
    <x-container.container
        class="flex items-start"
        gap="gap-3"
        x-bind:class="{
            'flex-row-reverse': type === 'sender',
            'flex-row': type === 'receiver'
        }"
        width="auto"
        height="auto"
    >

        {{-- Avatar --}}
        <img
            x-bind:src="imgProfile"
            class="w-8 h-8 rounded-full shrink-0"
        />

        {{-- Content --}}
        <x-container.container
            width="auto"
            height="auto"
            class="flex flex-col max-w-[70%]"
            gap="gap-1"
            x-bind:class="{
                'items-end': type === 'sender',
                'items-start': type === 'receiver'
            }"
        >

            {{-- Name + Role --}}
            <x-container.container  
                variant="flat"
                class="flex"
                gap="gap-1"
                width="auto"
            >
                <x-typography
                    variant="body-small-bold"
                    x-text="name"
                />
                <x-typography
                    variant="body-small-regular"
                    x-text="'- ' + role"
                />
            </x-container.container>

            {{-- Bubble --}}
            <x-container.container
                padding="px-3 py-2"
                x-bind:class="{
                    'content-sender': type === 'sender',
                    'content-receiver': type === 'receiver'
                }"
            >
                <x-typography
                    variant="body-small-regular"
                    x-text="message"
                />
            </x-container.container>

            {{-- Timestamp --}}
            <x-container.container
                variant="flat"
                width="auto"
                class="text-gray-500"
            >
                <x-typography
                    variant="caption-regular"
                    x-text="window.formatter.formatDateTime(timestamp)"
                />
            </x-container.container>

            {{ $slot }}

        </x-container.container>
    </x-container.container>
</x-container.container>
