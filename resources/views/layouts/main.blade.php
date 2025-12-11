<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
</head>

<body>
  <x-container.wrapper
    :padding="'p-0'"
    rows="12"
    class="h-full w-full"
    x-data="{}"
  >

    <x-container.container :rounded="'none'" :width="'full'" :height="'full'" :background="'transparent'"
    class="row-span-2"
    >
      <x-header />
    </x-container.container>

    <x-container.container :rounded="'none'" :width="'full'" :height="'full'" :background="'transparent'" 
    class="row-span-10"
    >
        <x-container.wrapper :cols="12" :padding="'p-0'">

          <template x-if="$store.mainLayout.isOpen">
            <x-container.container :width="'full'" :height="'full'" :rounded="'none'" :background="'transparent'" x-bind:class="$store.mainLayout.isOpen ? 'col-start-1 col-span-3' : 'opacity-0 max-w-0'">
              <x-menu />
            </x-container.container>
          </template>
          
          <x-container.container :width="'full'" :height="'full'" :rounded="'none'" :rounded="'none'" :background="'transparent'" class="overflow-scroll" x-bind:class="$store.mainLayout.isOpen ? 'col-start-4 col-span-9' : 'col-start-1 col-span-12'">
              <x-container.wrapper :rows="16">

                <x-container.container :width="'full'" :height="'maxContent'" :background="'transparent'" :rounded="'none'" class="row-start-1 row-span-1">
                  <x-breadcrumb />
                </x-container.container>

                <x-container.container :width="'full'" :height="'full'" :background="'transparent'" :rounded="'none'" class="row-start-2 row-span-15">
                  @yield('content')
                </x-container.container>

              </x-container.wrapper>
          </x-container.container>

        </x-container.wrapper>
    </x-container.container>

  </x-container.wrapper>
  
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
