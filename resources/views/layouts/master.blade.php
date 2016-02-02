<html>
    <head>
        <!-- Core CSS for Zurb Foundatiopn should go here -->
        <title>'Teaching Support Activies Management Portal'</title>
        @yield('css')
    </head>
    <body>
        @include('navbar')
            {{-- The navbar should go here --}}

        <div class="container">
            @yield('content')
        </div>

        <!-- Place Javascript file references here -->
        @yield('javascript')

    </body>
</html>