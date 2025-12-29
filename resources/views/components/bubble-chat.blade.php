<x-container.container :variant="'content-wrapper'" gap="1" x-data="{{ $attributes->get('x-data') }}" class="flex"
    x-bind:class="{
        'justify-end': type === 'sender',
        'justify-start': type === 'receiver'
    }">

    {{-- Row --}}
    <x-container.container :variant="'content-wrapper'" gap="3"
        x-bind:class="{
            'flex-row-reverse': type === 'sender',
            'flex-row': type === 'receiver'
        }"
        width="auto" height="auto">

        {{-- Avatar --}}
        <img x-bind:src="imgProfile" class="w-8 h-8 rounded-full shrink-0" />

        {{-- Content --}}
        <x-container.container width="auto" height="auto" class="flex-col !w-1/2" gap="1"
            x-bind:class="{
                'items-end': type === 'sender',
                'items-start': type === 'receiver'
            }">

            {{-- Name + Role --}}
            <x-container.container variant="flat" gap="1" width="auto">
                <x-typography variant="body-small-bold" x-text="name" />
                <x-typography variant="body-small-regular" x-text="'- ' + role" />
            </x-container.container>

            {{-- Bubble --}}
            <x-container.container px="3" py="2" radius="md"
                x-bind:class="{
                    'content-sender': type === 'sender',
                    'content-receiver': type === 'receiver'
                }">
                <x-typography variant="body-small-regular" x-text="message" />
            </x-container.container>

            {{-- Timestamp --}}
            <x-container.container variant="flat" width="auto" class="text-gray-600">
                <x-typography variant="caption-regular" x-text="window.formatter.formatDateTime(timestamp)" />
            </x-container.container>
            {{-- Status + Actions --}}
            <x-container.container variant="flat" gapX="3" width="auto" items="center" class="flex"
                x-bind:class="{
                    'justify-end': type === 'sender',
                    'justify-start': type === 'receiver'
                }">
                @isset($status)
                    <x-container.wrapper items="center">
                        {{ $status }}
                    </x-container.wrapper>
                @endisset

                @isset($actions)
                    <x-container.container items="center">
                        {{ $actions }}
                    </x-container.container>
                @endisset
            </x-container.container>
        </x-container.container>
    </x-container.container>
</x-container.container>
