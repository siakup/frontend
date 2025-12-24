<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
</head>

<body>
    <div class="grid grid-rows-[auto,1fr] w-screen h-auto" x-data="{}">

        {{-- --- NAVBAR --- --}}
        <x-container.container row="1" height="auto" width="full" background="red-gradient" radius="none">
            <x-header />
        </x-container.container>

        {{-- --- SIDEBAR & CONTENT --- --}}
        <x-container.container height="full" width="full" radius="none">

            <template x-if="$store.mainLayout.isOpen">
                <x-container.wrapper cols="2" height="full">

                    <x-container.container col="1" radius="none" height="fit" width="fit"
                        background="bg-white" class="border-r border-r-gray-400">
                        <x-menu />
                    </x-container.container>

                    <x-container.container col="1">
                        {{-- {{ $slot }} --}}
                        @yield('content')
                    </x-container.container>

                </x-container.wrapper>
            </template>

            <template x-if="!$store.mainLayout.isOpen">

                <x-container.wrapper height="full">

                    <x-container.container col="1">
                        {{-- {{ $slot }} --}}
                        @yield('content')
                    </x-container.container>

                </x-container.wrapper>
            </template>
        </x-container.container>
    </div>



    {{-- <x-container.container col="1">

            <x-container.wrapper row="">
                <x-container.container>

                    </x-container>

                    </x-container>

                </x-container.container> --}}

    {{-- --- SIDEBAR --- --}}
    {{-- <template x-if="$store.mainLayout.isOpen">
                  <x-container.container col="1" background="bg-white" radius="none" width="auto"
                  class="border-r border-r-gray-400"
                  x-bind:class="$store.mainLayout.isOpen ? 'col-span-3 h-auto' : 'col-span-0 opacity-0 max-w-0'">
                  <x-menu />
                </x-container.container>
              </template> --}}

    {{-- --- CONTENT --- --}}
    {{-- <x-container.container col="1" width="full" rounded="none" background="transparent"
                    class="overflow-y-auto" x-bind:class="$store.mainLayout.isOpen ? 'col-span-9' : 'col-span-12'">
                    <x-container.wrapper rows="2">

                        <x-container.container row="1" width="full" height="fit" background="transparent"
                            rounded="none">
                            <x-breadcrumb />
                        </x-container.container>

                        <x-container.container row="1" width="full" height="full" background="transparent"
                            rounded="none">
                            @yield('content')
                        </x-container.container>
                    </x-container.wrapper>
                </x-container.container>

            </x-container.wrapper>
        </x-container.container> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js') }}"></script>

    @stack('scripts')
    @yield('javascript')
    @yield('modals')
    @fluxScripts
    @vite(['resources/js/app.js'])
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('mainLayout', {
                isOpen: true
            });
        });
    </script>
</body>

</html>
