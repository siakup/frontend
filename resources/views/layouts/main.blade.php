<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
    @vite(['resources/js/app.js'])
</head>

<body>
  <x-container.container :variant="'flat'" x-data="{}">
    <x-header />
    <main>
      <x-container.wrapper :cols="12" :padding="'p-0'">
        <x-container.container :variant="'flat'" x-bind:class="$store.mainLayout.isOpen ? 'col-span-3 col-start-1' : 'hidden'">
          <x-menu />
        </x-container>
        <x-container.container :variant="'flat'" x-bind:class="$store.mainLayout.isOpen ? 'col-span-9 col-start-4' : 'col-span-12 col-start-1'">
          <x-container.container :variant="'wide'">
            <x-container.wrapper :rows="12">
              <x-container.container :variant="'flat'" class="row-span-1">
                <x-breadcrumb />
              </x-container>
              <x-container.container :variant="'flat'" class="row-span-11">
                @yield('content')
              </x-container>
            </x-wrapper>
          </x-container>
        </x-container>
      </x-wrapper>
    </main>
  </x-container>

  <script type="module">
      document.addEventListener('alpine:init', () => {
        Alpine.store('mainLayout', { 
          isOpen: true
        });
      });
  </script>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js') }}"></script>

  @stack('scripts')
  @yield('javascript')
  @yield('modals')
  @fluxScripts
</body>

</html>
