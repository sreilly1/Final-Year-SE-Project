
<html>
<head>
    <meta charset="utf-8">
    <title>foundation on laravel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <script src="{{ asset('js/modernizr.js') }}"> </script>
</head>
<body>


    <header>

        <h2 class="welcome_text">Please choose Administrator to begin</h2>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">

        <div style="width:100%;"> <!-- Main Div -->
            <div class="row">
                @if(Session::has('error_page'))
                <div class="large-12 medium-12 small-12 columns">
                    <div data-alert class="alert-box alert" align="center">
                        {{ Session::get('error_page') }}
                    </div>
                </div>
                @endif
                <div class="large-12 medium-8 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Current Lecturers:</legend>

                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                @foreach($admins as $admin)
                                    <li><a href="/Admin/{{$admin->id}}"><p>{{$admin->name}}</p></li>
                                @endforeach
                            </div>                              
                        </div>
                    </fieldset>

                </div>

            </div>
        </section>








        <footer>

            <div class="row">

                <div class="twelve columns footer">
                    <div class="small-12 medium-12 large-12 columns">
                        <p style="text-align: center;">
                            Support Activity System
                            <br>Designed and Supported by <a href="#"> Support Activity Team</a> 
                        </p>
                    </div>
                </div>

            </div>

        </footer>



        <script src="{{ asset('js/f5_components.js') }}"> </script>
        <script src="{{ asset('js/vendor/jquery.js') }}"></script>
        <script src="{{ asset('js/foundation/foundation.js') }}"></script>
        <script src="{{ asset('js/foundation/foundation.reveal.js') }}"></script>
        <script src="{{ asset('js/foundation/foundation.topbar.js') }}"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>
