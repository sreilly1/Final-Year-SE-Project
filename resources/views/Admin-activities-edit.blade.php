
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
            <li><a href="/Admin/{{$user->id}}/Activities">Activities</a></li>
            <li><a href="/Admin/{{$user->id}}/Activities/{{$activity->id}}">{{$activity->title}}</a></li>
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
                </div>
                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Activity Details</legend>
                            <form action="/Admin/{{$user->id}}/Activities/{{$activity->id}}/Update" role="form" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="large-3 columns">
                                    <label>Support Activity Title</label>
                                    <input type="text" name="title" value="{{$activity->title}}" />
                                </div>
                                <div class="large-3 columns">
                                    <label>Role Type</label>
                                    <select name="role_type">
                                        <option name="role_type" value="{{$activity->role_type}}" selected="{{$activity->role_type}}">{{$activity->role_type}}</option>
                                        <option name="role_type" value="Demonstrator">Demonstrator</option>
                                        <option name="role_type" value="Teaching">Teaching</option>
                                    </select>
                                </div>
                                <div class="large-2 columns">
                                    <label>Nom of Applicants</label>
                                    <input type="text" name="quant_ppl_needed" value="{{$activity->quant_ppl_needed}}" />
                                </div>
                                <div class="large-4 columns">                                
                                    @if($activity->module_id === null)
                                        <label class="error">This activity is not assigned with module</label>
                                        <select name="module_id">                                                
                                                <option name="module_id" value="null">- Assign Module -</option>
                                            @foreach($module as $mod)                                               
                                                <option name="module_id" value="{{$mod->id}}">{{$mod->module_name}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <label>Module</label>
                                        <select name="module_id">
                                                <option name="module_id" value="{{$activity->module_id}}" selected="{{$activity->module_id}}">{{$activity->module->module_name}}</option>
                                                <option name="module_id" value="null">- NULL -</option>
                                            @foreach($module as $mod)                                               
                                                <option name="module_id" value="{{$mod->id}}">{{$mod->module_name}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <div class="large-2 columns">
                                    <input type="submit" value="update" class="nice tiny blue radius button">
                                </div>                
                            
                                <div class="large-2 columns">
                                    <a href="/Admin/{{$user->id}}/Activity/Delete/{{$activity->id}}" class="nice tiny alert radius button">Delete</a>
                                </div> 
                            </form>
                    </fieldset>
                </div>

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Module Details</legend>
                        
                        @if($activity->module_id === null)
                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    <div data-alert class="alert-box alert" align="center">
                                        {{ Session::get('no_module') }}
                                        <a href="#" class="close">&times;</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="large-3 columns">
                                    <small>Module Name:</small>
                                    <h6>{{$activity->module->module_name}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    <small>Module Code:</small>
                                    <h6>{{$activity->module->module_code}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    @if($activity->module->user === null)
                                    <small>Module Leader Name:</small>
                                    <h6><label class="error">This Module has no module leader!</label></h6>
                                    @else
                                    <small>Module Leader Name:</small>
                                    <h6>{{$activity->module->user->title}}. {{$activity->module->user->name}}</h6>
                                    @endif
                                </div>
                                <div class="large-3 columns">
                                    <small>View Module</small>
                                    <h6><a href="/Admin/{{$user->id}}/Modules/{{$activity->module->id}}" target="_blank">View</a></h6>
                                </div>
                            </div>
                        @endif        
                    </fieldset>
                </div>

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">
                        <legend class="legend">Support Activity Sessions</legend>
                        <table>
                            <thead>
                                <tr>
                                    <th>Session #</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Location</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sessions as $session)
                                    <tr>
                                        <td>{{$session->id}}</td>
                                        <td>{{date("d-m-Y", strtotime($session->date_of_session))}}</td>      
                                        <td>{{date("H:i", strtotime($session->start_time))}} - {{date("H:i", strtotime($session->end_time))}}</td>
                                        <td>{{$session->location}}</td>                                                                                                
                                        <td><a href="/Admin/{{$user->id}}/Activities/Sessions/{{$session->id}}" target="_blank">View</a>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
