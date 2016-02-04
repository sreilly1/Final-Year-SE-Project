<html>
    <head>
        <!-- Core CSS for Zurb Foundatiopn should go here -->
        <title>'Teaching Support Activies Management Portal'</title>
        @yield('css')
    </head>
    <body>
        @include('navbar')
            <!-- The navbar should go here -->

        <div class="container">
            @yield('content')
        </div>

        <!-- Place Javascript file references here -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        @yield('javascript')

    </body>
</html>