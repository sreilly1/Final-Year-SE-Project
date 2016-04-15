
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
            <li><a href="/Admin/{{$user->id}}/Modules/{{$module->id}}">{{$module->module_name}}</a></li>
            <li class="active"><a href="#">Edit</a></li>
        </ul>

      </section>
    </nav>

    <header>

        <h2 class="welcome_text">Editing: {{$module->module_name}}</h2>
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

                        <legend class="legend">Module Information</legend>
                            <form action="/Admin/{{$user->id}}/Modules/{{$module->id}}/updateMod" role="form" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="large-4 columns">
                                    <label>Module Name</label>
                                    <input type="text" name="module_name" value="{{$module->module_name}}" />
                                </div>
                                <div class="large-4 columns">
                                    <label>Module Code</label>
                                    <input type="text" name="module_code" value="{{$module->module_code}}" />
                                </div>
                                <div class="large-4 columns">
                                @if($module->module_leader === null)                                    
                                    <label class="error">This module has no "Module Leader"!</label>
                                    <select name="module_leader">
                                        <option name="module_leader" value="null" selected="NULL">- Please Select -</option>
                                        @foreach($lecturers as $staff)
                                        <option name="module_leader" value="{{$staff->id}}">{{$staff->name}}</option>
                                        @endforeach
                                    </select>
                                    

                                @else
                                    <label>Module Leader</label>
                                    <select name="module_leader">
                                        <option name="module_leader" value="{{$module->module_leader}}" selected="{{$module->module_leader}}">{{$module->user->name}}</option>
                                        <option name="module_leader" value="null">- No Leader -</option>
                                        @foreach($lecturers as $staff)
                                        <option name="module_leader" value="{{$staff->id}}">{{$staff->name}}</option>
                                        @endforeach
                                    </select>
                                @endif
                                </div>
                                <div class="large-2 columns">
                                    <input type="submit" value="update" class="nice tiny blue radius button">
                                </div>                
                            
                                <div class="large-2 columns">
                                    <a href="/Admin/{{$user->id}}/Modules/Delete/{{$module->id}}" class="nice tiny alert radius button">Delete</a>
                                </div> 
                            </form>
                    </fieldset>
                </div>

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Module Leader Details</legend>

                            
                                
                                @if($module->module_leader === null)
                                    <div class="row">
                                        <div class="large-12 medium-12 small-12 columns">
                                            <div data-alert class="alert-box alert" align="center">
                                                {{ Session::get('no_module_leader_information') }}
                                                <a href="#" class="close">&times;</a>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $activities)
                                <tr>
                                    <td>{{$activities->title}}</td>
                                    <td>{{$activities->role_type}}</td>
                                    <td><a href="/Admin/{{$user->id}}/Activities/{{$activities->id}}" target="_blank">View</a></td>
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
