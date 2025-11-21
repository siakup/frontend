<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
</head>

<body class="bg-gray-200">
  <div x-data="{}">
    <x-header />
    <main class="grid grid-cols-12">
      <x-menu />
      <x-container 
        :variant="'content-wrapper'" 
        :class="'!p-0'"
        x-bind:class="$store.mainLayout.isOpen ? 'col-span-9 col-start-4' : 'col-span-12 col-start-1'"
      >
        <x-breadcrumb />
        @yield('content')
      </x-container>
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

  @stack('scripts')
  @yield('javascript')
  @yield('modals')
  @fluxScripts
</body>

</html>
