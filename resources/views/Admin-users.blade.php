
<html>
<head>
    <meta charset="utf-8">
    <title>foundation on laravel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <script src="{{ asset('js/modernizr.js') }}"> </script>
</head>
<body>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="#">{{$user->name}}</a></h1>
        </li>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
          <li class="has-dropdown">
            <a href="#">Redirect</a>
            <ul class="dropdown">
              <li><a href="/Admin">Main Page</a></li>
              <li><a href="/Admin/Requests">View Requests</a></li>
            </ul>
          </li>
        </ul>

        <ul class="left">
            <li><a href="/Admin/{{$user->id}}">Main</a></li>
            <li class="active"><a href="#">Users</a></li>
        </ul>

      </section>
    </nav>


    <header>

        <h2 class="welcome_text">Users Page</h2>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">

        <div style="width:100%;"> <!-- Main Div -->

            @if(Session::has('failed'))
                <div class="large-12 medium-12 small-12 columns">
                    <div data-alert class="alert-box alert" align="center">
                        {{ Session::get('failed') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                </div>
            @endif

            
            <div class="row">
                <div class="large-12 medium-12 small-12 columns">
                    @if(Session::has('no_user'))
                    <div data-alert class="alert-box alert" align="center">
                        {{ Session::get('no_user') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                    @endif
                </div>
                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Please Choose</legend>

                            <div class="row">
                                <div class="large-12 columns">

                                    <div class="large-12 medium-12 small-12 columns">
                                        <div class="panel"> 
                                            <a href="/Admin/{{$user->id}}/Users/Create" class="alert round disabled">Create A New User</a>
                                        </div>
                                    </div>

                                    <div class="large-12 medium-12 small-12 columns">
                                        <div class="panel">
                                            <a href="/Admin/{{$user->id}}/Users/Modify" class="alert round disabled">Manage Existed Users</a>
                                        </div>
                                    </div>
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
        <script src="{{ asset('js/foundation/foundation.alert.js') }}"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>
