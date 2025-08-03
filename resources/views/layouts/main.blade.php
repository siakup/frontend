<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    @fluxAppearance

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

    <!-- Modals section -->
    @yield('modals')

    @fluxScripts
</body>

</html>
