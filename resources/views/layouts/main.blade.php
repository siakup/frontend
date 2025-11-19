<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    @fluxAppearance
    <!-- CSS Select2 -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
</head>

<body style="margin: 0px; background: #F5F5F5">
  <div x-data="{ }">
    <x-header />
    <main class="grid grid-cols-12">
      <x-menu />
      <x-container 
        :variant="'content-wrapper'" 
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
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- JS Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  @stack('scripts')
  @yield('javascript')


  <!-- Modals section -->
  @yield('modals')

  {{-- url --}}
  <script>
      window.LECTURER_API_URL = "{{ config('app.lecturer_api_url') }}";
  </script>


  @fluxScripts
</body>

</html>
