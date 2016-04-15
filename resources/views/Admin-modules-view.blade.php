
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
            <li class="active"><a href="#">{{$module->module_name}}</a></li>
        </ul>

      </section>
    </nav>

    <header>

        <h2 class="welcome_text">{{$module->module_name}}</h2>
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

                        <legend class="legend">Module Details</legend>
                            <div class="row">
                                <div class="large-3 columns">
                                    <small>Module Name:</small>
                                    <h6>{{$module->module_name}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Module Code:</small>
                                    <h6>{{$module->module_code}}</h6>
                                </div>
                                @if($module->module_leader === null)
                                    <div class="large-4 columns">
                                        <small>Module Leader:</small>
                                        <h6><label class="error">No module leader</label></h6>
                                    </div>
                                @else
                                    <div class="large-4 columns">
                                        <small>Module Leader:</small>
                                        <h6>{{$module->user->title}}. {{$module->user->name}}</h6>
                                    </div>
                                @endif
                                <div class="large-3 columns">
                                    <small>Edit Module</small>
                                    <h6><a href="/Admin/{{$user->id}}/Modules/Modify/{{$module->id}}">Edit</a></h6>
                                </div>
                            </div>
                    </fieldset>
                </div>

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Module Leader Details</legend>
                        
                        @if($module->module_leader === null)
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <div data-alert class="alert-box alert" align="center">
                                    This Module has no leader, please assign one                                    
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="large-3 columns">
                                <small>Module Leader Name:</small>
                                <h6>{{$module->user->title}}. {{$module->user->name}}</h6>
                            </div>
                            <div class="large-3 columns">
                                <small>Module Leader E-mail address:</small>
                                <h6>{{$module->user->email}}</h6>
                            </div>
                            <div class="large-3 columns">
                                <small>Module Leader phone number:</small>
                                <h6>{{$module->user->phone_number}}</h6>
                            </div>
                            <div class="large-3 columns">
                                <small>Module Leader room number:</small>
                                <h6>{{$module->user->room_number}}</h6>
                            </div>
                        </div>
                        @endif      
                    </fieldset>
                </div>

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Support Activities Details</legend>

                        @if(Session::has('no_activities'))
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <div data-alert class="alert-box alert" align="center">
                                    {{ Session::get('no_activities') }}
                                    <a href="#" class="close">&times;</a>
                                </div>
                            </div>
                        </div>
                        @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Role Type</th>
                                    <th>Choose Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $activity)
                                <tr>
                                    <td>{{$activity->title}}</td>
                                    <td>{{$activity->role_type}}</td>                                                                                                
                                    <td><a href="/Admin/{{$user->id}}/Activities/{{$activity->id}}">View</a>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
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
