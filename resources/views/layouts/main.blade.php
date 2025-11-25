<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
</head>

<body>
  <div x-data="{}">
    <x-header />
    <main>
      <div class="overflow-y-scroll scroll-thin">
        <div class="grid grid-cols-12">
          <div x-bind:class="$store.mainLayout.isOpen ? 'col-span-3 col-start-1' : 'hidden'">
            <x-menu />
          </div>
          <div x-bind:class="$store.mainLayout.isOpen ? 'col-span-9 col-start-4' : 'col-span-12 col-start-1'">
            <x-container 
              :variant="'content-wrapper'" 
              :class="'!p-0 bg-gray-200 !rounded-none'"
            >
              <x-breadcrumb />
              @yield('content')
            </x-container>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script type="module">
      document.addEventListener('alpine:init', () => {
        Alpine.store('mainLayout', { 
          isOpen: true
        });
      });
  </script>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js')}}"></script>

  @stack('scripts')
  @yield('javascript')
  @yield('modals')
  @fluxScripts
</body>

</html>
