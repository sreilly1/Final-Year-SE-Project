
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
          <h1><a href="#">{{$user->title}}. {{$user->name}}</a></h1>
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
              <li><a href="/Lecturer/{{$user->id}}">Main Page</a></li>              
            </ul>
          </li>
        </ul>

        <ul class="left">
            <li><a href="/Lecturer/{{$user->id}}">Main</a></li>
            <li><a href="/Lecturer/{{$user->id}}/Modules">Modules</a></li>
            <li><a href="/Lecturer/{{$user->id}}/Modules/mod{{$module->id}}">{{$module->module_name}}</a></li>
            <li><a href="/Lecturer/{{$user->id}}/Modules/mod{{$module->id}}/Act{{$activity->id}}">{{$activity->title}}</a></li>
            <li class="active"><a href="#">Edit</a></li>
        </ul>

      </section>
    </nav>

    <header>

        <h2 class="welcome_text">{{$activity->title}}</h2>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">


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
                    @if(Session::has('error_page'))
                        <div data-alert class="alert-box alert" align="center">
                            {{ Session::get('error_page') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif
                </div>
                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Activity Details</legend>
                            <form action="/Lecturer/{{$user->id}}/Modules/mod{{$module->id}}/Act{{$activity->id}}/Modify/Action" role="form" method="post" id="editAct">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="large-4 columns">
                                    <label>Support Activity Title</label>
                                    <input type="text" name="title" value="{{$activity->title}}" />
                                </div>
                                <div class="large-4 columns">
                                    <label>Role Type</label>
                                    <select name="role_type">
                                        <option name="role_type" value="{{$activity->role_type}}" selected="{{$activity->role_type}}">{{$activity->role_type}}</option>
                                        <option name="role_type" value="Demonstrator">Demonstrator</option>
                                        <option name="role_type" value="Teaching">Teaching</option>
                                    </select>
                                </div>
                                <div class="large-4 columns">
                                    <label>Nom of Applicants Needed</label>
                                    <input type="text" name="quant_ppl_needed" value="{{$activity->quant_ppl_needed}}" />
                                </div>
                                <div class="large-12 columns">
                                    <label>Activity Description
                                        <textarea name="description" value="{{$activity->description}}" form="editAct" style="resize: none; min-height:100px;">{{$activity->description}}</textarea>
                                    </label>
                                </div>
                                <div class="large-2 columns">
                                    <input type="submit" value="update" class="nice tiny blue radius button">
                                </div>                
                            
                                <div class="large-2 columns">
                                    <a href="#" class="nice tiny alert radius button">Delete</a>
                                </div> 
                            </form>
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
