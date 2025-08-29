<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    @fluxAppearance
    @stack('styles')
    <!-- CSS Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    

</head>

<body class="screen" style="margin: 0px;">
    @include('partials.header')

    <div class="flex flex-1 text-black">
        @include('partials.menu')

        <main class="flex-1 p-6">
            @include('partials.breadcrumbs')
            @yield('content')
        </main>
    </div>

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
