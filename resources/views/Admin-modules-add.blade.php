
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
            <li><a href="/Admin/{{$user->id}}/Modules">Modules</a></li>
            <li class="active"><a href="#">Add</a></li>
        </ul>

      </section>
    </nav>


    <header>

        <h2 class="welcome_text">Users Page</h2>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">

        <div style="width:100%;"> <!-- Main Div -->
            <div class="row">
                <div class="large-12 medium-8 small-12 columns">

                
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


                    <fieldset class="bio">

                        <legend class="legend">Title</legend>

                            <div class="row">
                                
                                <div class="large-12 columns">
                                    <form action="/Admin/{{$user->id}}/Modules/addMod" role="form" method="post" id="addModule">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="row">
                                            <div class="large-4 columns">
                                                <label>Module Name</label>
                                                <input type="text" name="module_name" placeholder="Enter Module Name" />
                                            </div>
                                            <div class="large-4 columns">
                                                <label>Module Code</label>
                                                <input type="text" name="module_code" placeholder="Enter Module Code" />
                                            </div>
                                            <div class="large-4 columns">
                                                <label>Module Leader</label>
                                                <select name="module_leader">
                                                    <option name="module_leader" value="null" selected="NULL">- Please Select -</option>
                                                    @foreach($lecturers as $staff)
                                                    <option name="module_leader" value="{{$staff->id}}">{{$staff->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="large-12 columns">
                                                <label>Module Description
                                                    <textarea name="description" form="addModule"></textarea>
                                                </label>
                                            </div>
                                        </div>
                                        <input type="submit" value="add" class="button postfix">
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
        <script src="{{ asset('js/foundation/foundation.alert.js') }}"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>
