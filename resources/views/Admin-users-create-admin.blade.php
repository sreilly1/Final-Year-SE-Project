
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
            <li><a href="/Admin/{{$user->id}}/Users">Users</a></li>
            <li><a href="/Admin/{{$user->id}}/Users/Create">Create</a></li>
            <li class="active"><a href="#">Administrator</a></li>
        </ul>

      </section>
    </nav>


    <header>

        <h2 class="welcome_text">Create user as "Administrator"</h2>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">

        <div style="width:100%;"> <!-- Main Div -->
            <div class="row">
                <div class="large-12 medium-8 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Title</legend>

                            <div class="row">

                                <div class="large-12 medium-12 small-12 columns">
                                    @if(Session::has('success'))
                                        <div data-alert class="alert-box success" align="center">
                                          {{ Session::get('success') }}
                                          <a href="#" class="close">&times;</a>
                                        </div>
                                    @endif

                                    @if (Session::has('failed'))
                                        <div data-alert class="alert-box alert">
                                          {{ Session::get('failed') }}
                                          <a href="#" class="close">&times;</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="large-12 columns">
                                    <form data-abide action="/Admin/{{$user->id}}/Users/Create/Admin/addUser" role="form" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="row">
                                            <div class="large-2 columns">
                                                <label>Title <small>required</small>

                                                <select name="title">
                                                    <option name="title" value="Professor">Professor</option>
                                                    <option name="title" value="Dr">Dr</option>
                                                    <option name="title" value="Mr">Mr</option>
                                                    <option name="title" value="Mrs">Mrs</option>
                                                    <option name="title" value="Miss">Miss</option>
                                                    <option name="title" value="Ms">Ms</option>
                                                </select></label>
                                            </div>
                                            <div class="large-4 columns">
                                                <label>Full Name
                                                <input type="text"  name="name" placeholder="E.g John Stuart"/></label>
                                            </div>
                                            <div class="large-2 columns">
                                                <label>Username <small>required</small>
                                                <input type="text" name="username" placeholder="C12*****" /></label>
                                            </div>
                                            <div class="large-4 columns">
                                                <label>E-mail Address <small>required</small>
                                                <input type="text" name="email" placeholder="Enter E-mail Address" /></label>
                                            </div>
                                            <div class="large-6 columns">
                                                <div class="password-field">
                                                    <label>Password <small>required</small>
                                                        <input name="password" type="password" id="PhdPass" required pattern="[a-zA-Z]+">
                                                    </label>
                                                    <small class="error">Your password must match the requirements</small>
                                                </div>
                                            </div>
                                            <div class="large-6 columns">
                                                <div class="password-confirmation-field">
                                                    <label>Confirm Password <small>required</small>
                                                    <input type="password" required pattern="[a-zA-Z]+" data-equalto="PhdPass">
                                                    </label>
                                                    <small class="error">The password did not match</small>
                                                </div>
                                            </div>
                                            <div class="large-4 columns">
                                                <label>Phone Number</label>
                                                <input type="text" name="phone_number" placeholder="07*********" />
                                            </div>
                                            <div class="large-4 columns">
                                                <label>Room</label>
                                                <input type="text" name="room_number" placeholder="N2.**" />
                                                <input type="hidden" name="role" value="Administrator" />

                                            </div>
                                            <div class="large-4 columns">
                                                <label>Confirm & Create User</label>
                                                <input type="submit" value="Create" class="nice tiny blue radius button postfix">
                                            </div>
                                        </div>
                                    </form>  
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
