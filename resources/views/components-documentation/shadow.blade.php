<x-layouts.main>
    <x-layouts.content title="Shadow Documentation">

        @php
            $shadows = [
                'high' => [
                    'y' => 16,
                    'blur' => 36,
                    'opacity' => '10%',
                    'usage' => ['Toast'],
                ],
                'medium' => [
                    'y' => 8,
                    'blur' => 16,
                    'opacity' => '15%',
                    'usage' => ['Tooltip', 'Dropdown'],
                ],
                'low' => [
                    'y' => 4,
                    'blur' => 8,
                    'opacity' => '20%',
                    'usage' => ['Product Card', 'Side Card'],
                ],
            ];
        @endphp

        <x-container.wrapper rows="3" gap="6">
            @foreach ($shadows as $variant => $current)
                <x-container.container row="1">
                    <x-container.wrapper cols="2" gapX="6">
                        {{-- Left --}}
                        <x-container.container col="1" class="flex-col" gapY="2">

                            {{-- Header --}}
                            <x-typography variant="body-medium-bold">
                                $shadow-{{ $variant }}
                            </x-typography>

                            {{-- Preview --}}
                            <x-container.container shadow="{{ $variant }}" radius="md" padding="12" />

                            {{-- Meta --}}
                            <x-container.container class="flex-col gap-1">
                                <x-typography variant="body-small-bold">
                                    X: 0
                                    Y: {{ $current['y'] }}
                                    Blur: {{ $current['blur'] }}
                                    Spread: 0
                                </x-typography>

                                <x-typography variant="body-small-regular">
                                    #3D4151 {{ $current['opacity'] }}
                                </x-typography>
                            </x-container.container>

                            {{-- Code --}}
                            <pre class="bg-gray-900 text-gray-300 p-3 rounded-lg text-xs overflow-x-auto">
&lt;x-container.container
    shadow="{{ $variant }}"
    radius="md"
/&gt;
                            </pre>

                            {{-- Usage --}}
                            <x-container.container class="flex-col gap-1">
                                <x-typography variant="body-small-bold">
                                    Usage
                                </x-typography>

                                <ul class="list-disc list-inside text-sm text-gray-500">
                                    @foreach ($current['usage'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </x-container.container>

                        </x-container.container>

                        {{-- Right --}}
                        <x-container.container col="1" class="flex-col" gapY="2">

                            {{-- Header --}}
                            <x-typography variant="body-medium-bold">
                                $shadow-{{ $variant }}-inverse
                            </x-typography>

                            {{-- Preview --}}
                            <x-container.container shadow="{{ $variant }}-inverse" radius="md" padding="12" />

                            {{-- Meta --}}
                            <x-container.container class="flex-col gap-1">
                                <x-typography variant="body-small-bold">
                                    X: 0
                                    Y: -{{ $current['y'] }}
                                    Blur: {{ $current['blur'] }}
                                    Spread: 0
                                </x-typography>

                                <x-typography variant="body-small-regular">
                                    #3D4151 {{ $current['opacity'] }}
                                </x-typography>
                            </x-container.container>

                            {{-- Code --}}
                            <pre class="bg-gray-900 text-gray-300 p-3 rounded-lg text-xs overflow-x-auto">
&lt;x-container.container
    shadow="{{ $variant }}-inverse"
    radius="md"
/&gt;
                            </pre>

                        </x-container.container>
                    </x-container.wrapper>
                </x-container.container>
            @endforeach
        </x-container.wrapper>

    </x-layouts.content>
</x-layouts.main>
