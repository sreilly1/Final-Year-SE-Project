
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

        @if($session->activity->module->module_leader === null)
        <ul class="left">
            <li><a href="/Admin/{{$user->id}}">Main</a></li>
            <li><a href="/Admin/{{$user->id}}/Activities">Activities</a></li>
            <li><a href="/Admin/{{$user->id}}/Activities/{{$session->activity->id}}">{{$session->activity->title}}</a></li>
            <li>
                <a href="#">
                @if($session->title === '')
                    Title missing for Session# {{$session->id}} - {{date("d-m-Y", strtotime($session->date_of_session))}}
                @else
                    {{$session->title}} - {{date("d-m-Y", strtotime($session->date_of_session))}}
                @endif
                </a>
            </li>
        </ul>
        @else
        <ul class="left">
            <li><a href="/Admin/{{$user->id}}">Main</a></li>
            <li class="has-dropdown">
                <a>- Take to -</a>
                <ul class="dropdown">
                  <li><a href="/Admin/{{$user->id}}/Modules">Modules</a></li>
                  <li><a href="/Admin/{{$user->id}}/Activities">Activities</a></li>
                  <li><a href="/Admin/{{$user->id}}/Activities/Sessions">Session</a></li>
                </ul>
            </li>
            <li><a href="/Admin/{{$user->id}}/Modules/{{$session->activity->module->id}}">{{$session->activity->module->module_name}}</a></li>
            <li><a href="/Admin/{{$user->id}}/Activities/{{$session->activity->id}}">{{$session->activity->title}}</a></li>
            <li class="active">
                <a href="#">
                @if($session->title === '')
                    Title missing for Session# {{$session->id}} - {{date("d-m-Y", strtotime($session->date_of_session))}}
                @else
                    {{$session->title}} - {{date("d-m-Y", strtotime($session->date_of_session))}}
                @endif
                </a>
            </li>
        </ul>
        @endif

      </section>
    </nav>

    <header>

        <h2 class="welcome_text">{{$session->title}} <small>{{date("d-m-Y", strtotime($session->date_of_session))}}</small></h2>
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
                </div>
                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">
                            <ul class="inline-list">
                              <li><label>Session Details</label></li>
                              <li><a href="/Admin/{{$user->id}}/Activities/Sessions/{{$session->id}}/Modify"><label class="error">Edit</label></a></li>
                            </ul>
                        </legend>
                            <div class="row">
                                <div class="large-3 columns">
                                    <small>Session Title:</small>
                                    @if($session->title === '')
                                    <label><h6 style="color:red;">No title, please add title</h6></label>
                                    @else
                                    <h6>{{$session->title}}</h6>
                                    @endif
                                </div>
                                <div class="large-3 columns">
                                    <small>Session Date:</small>
                                    <h6>{{date("d-m-Y", strtotime($session->date_of_session))}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    <small>Session Time:</small>
                                    <h6>{{date("H:i", strtotime($session->start_time))}} - {{date("H:i", strtotime($session->end_time))}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    <small>Location</small>
                                    <h6>{{$session->location}}</h6>
                                </div>
                            </div>
                    </fieldset>
                </div>

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Activity Details</legend>
                        
                            <div class="row">
                                <div class="large-5 columns">
                                    <small>Activity Title:</small>
                                    <h6>{{$session->activity->title}}</h6>
                                </div>
                                <div class="large-5 columns">
                                    <small>Activity Role Type:</small>
                                    <h6>{{$session->activity->role_type}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>View Activity Page</small>
                                    <h6><a href="/Admin/{{$user->id}}/Activities/{{$session->activity->id}}" >View</a></h6>
                                </div>
                                <div class="large-12 columns">
                                    <small>Activity Description</small>
                                    @if($session->activity->description === '')
                                        <label class="error" align="center">This Activity has no description, please add description!</label>
                                    @else
                                        <textarea readonly="readonly" style="resize: none; min-height:100px;">{{$session->activity->description}}</textarea>
                                    @endif
                                </div>
                            </div>
                    </fieldset>
                </div>

                @if($session->activity->module->module_leader === null)

                @else
                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Module Details Details</legend>
                        
                            <div class="row">
                                <div class="large-3 columns">
                                    <small>Module Name:</small>
                                    <h6>{{$session->activity->module->module_name}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Module Code:</small>
                                    <h6>{{$session->activity->module->module_code}}</h6>
                                </div>
                                @if($session->activity->module->module_leader === null)
                                    <div class="large-4 columns">
                                        <small>Module Leader:</small>
                                        <h6><label class="error">This module has no "Module Leader"</label></h6>
                                    </div>
                                @else
                                    <div class="large-4 columns">
                                        <small>Module Leader Name:</small>
                                        <h6>{{$session->activity->module->user->title}}. {{$session->activity->module->user->name}}</h6>
                                    </div>
                                @endif
                                <div class="large-3 columns">
                                    <small>View Module's Details</small>
                                    <h6><a href="/Admin/{{$user->id}}/Modules/{{$session->activity->module->id}}" >View</a></h6>
                                </div>
                                <div class="large-12 columns">
                                    <small>Module Description</small>
                                    <div class="panel">
                                        <h5><small>
                                        @if($session->activity->module->description === '')
                                            <label class="error" align="center">This module has no description, please add description!</label>
                                        @else
                                            <label>{{$session->activity->module->description}}</label>
                                        @endif
                                        </small></h5>
                                    </div>
                                </div>
                            </div>
                    </fieldset>
                </div>
                @endif

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
