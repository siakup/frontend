<x-layouts.main>
    <x-layouts.content title="Spacing Documentation">

        @php
            /**
             * Base spacing
             * 1x = 4px
             */
            $spacings = [
                ['label' => '1x', 'value' => '1'],
                ['label' => '2x', 'value' => '2'],
                ['label' => '2.5x', 'value' => '2.5'],
                ['label' => '3x', 'value' => '3'],
                ['label' => '4x', 'value' => '4'],
                ['label' => '5x', 'value' => '5'],
                ['label' => '6x', 'value' => '6'],
                ['label' => '7x', 'value' => '7'],
            ];
        @endphp

        <x-container.wrapper rows="3" width="fit" :height="'fit'">
            {{-- Base --}}
            <x-container.container row="1">
                <x-container.container px="2" py="1" radius="md" background="content-red">
                    <x-container.container padding="2">
                        <x-typography variant="body-small-bold" class="text-white">
                            X = 4px
                        </x-typography>
                    </x-container.container>
                </x-container.container>
            </x-container.container>

            {{-- Other Spacing --}}
            <x-container.container row="1" gapX="4">
                @foreach ($spacings as $space)
                    <x-container.wrapper rows="2" gapY="1">
                        {{-- Bar --}}
                        <x-container.container px="{{ $space['value'] }}" py="1" radius="sm"
                            background="content-red">
                            <x-container.container padding="2"/>
                        </x-container.container>
                        {{-- Label --}}
                        <x-typography variant="body-small-bold" class="text-center">
                            {{ $space['label'] }}
                        </x-typography>
                    </x-container.wrapper>
                @endforeach
            </x-container.container>

            {{-- Code --}}
            <pre class="bg-gray-900 text-gray-300 p-3 rounded-lg text-xs overflow-x-auto">
&lt;x-container.container
    px="2.5"
    py="1"
/&gt;

&lt;x-container.container
    padding="4"
/&gt;
            </pre>

        </x-container.wrapper>

    </x-layouts.content>
</x-layouts.main>
