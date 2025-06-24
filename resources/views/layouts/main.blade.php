<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="screen" style="margin: 0px;">
    @include('partials.header')

    <div class="flex flex-1">
        @include('partials.menu')

        <main class="flex-1 p-6">
            @include('partials.breadcrumbs')
            @yield('content')
        </main>
    </div>
</body>
</html>
