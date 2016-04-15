
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
            <li><a href="/Admin/{{$user->id}}/Activities">Support Activities</a></li>
            <li class="active"><a href="#">Add</a></li>
        </ul>

      </section>
    </nav>


    <header>

        <h2 class="welcome_text">Add Support Activity</h2>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">

        <div style="width:100%;"> <!-- Main Div -->
            <div class="row">
                @if(Session::has('activity_success'))
                    <div class="large-12 medium-12 small-12 columns">
                        <div data-alert class="alert-box success" align="center">
                            {{ Session::get('activity_success') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    </div>
                @endif

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Title</legend>

                            <div class="row">
                                
                                <div class="large-12 columns">
                                    <form action="/Admin/{{$user->id}}/Activities/Add/Action" role="form" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="row">
                                            <div class="large-4 columns">
                                                <label>Activity Title</label>
                                                <input type="text" name="title" placeholder="Enter Activity Title"/>
                                            </div>
                                            <div class="large-4 columns">
                                                <label>Role Type</label>
                                                <select name="role_type">
                                                    <option name="role_type" value="Demonstrator">Demonstrator</option>
                                                    <option name="role_type" value="Teaching">Teaching</option>
                                                </select>
                                            </div>
                                            <div class="large-4 columns">
                                                <label>Module</label>
                                                <select name="module_id">
                                                    <option name="module_id" value="null" selected="NULL">- Please Select -</option>
                                                    @foreach($modules as $module)
                                                    <option name="module_id" value="{{$module->id}}">{{$module->module_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="large-6 columns">
                                                <input type="text" name="quant_ppl_needed" placeholder="How many applicants?"/>
                                            </div>
                                            <div class="large-6 columns">
                                                <input type="submit" value="add" class="button postfix">
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
