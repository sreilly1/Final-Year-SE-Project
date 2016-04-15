
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
            <li class="active"><a href="#">{{$activity->title}}</a></li>
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
                            <div class="row">
                                <div class="large-3 columns">
                                    <small>Activity Title:</small>
                                    <h6>{{$activity->title}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Role Type:</small>
                                    <h6>{{$activity->role_type}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Nom of Applicants Needed</small>
                                    <h6>{{$activity->quant_ppl_needed}}</h6>
                                </div>
                                @if($activity->module_id === null)
                                    <div class="large-3 columns">
                                        <small>No Module assigned:</small>
                                        <h6>This Support Activity has no module that it belongs to</h6>
                                    </div>
                                @else
                                <div class="large-3 columns">
                                    <small>Module Name:</small>
                                    <h6>{{$activity->module->module_name}}</h6>
                                </div>
                                @endif
                                <div class="large-2 columns">
                                    <small>Edit Support Activity</small>
                                    <h6><a href="/Admin/{{$user->id}}/Activities/Modify/{{$activity->id}}">Edit</a></h6>
                                </div>
                            </div>
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
                                @if($activity->module->module_leader === null)
                                    <div class="large-3 columns">
                                        <small>Module Leader:</small>
                                        <h6><label class="error">This module has no "Module Leader"</label></h6>
                                    </div>
                                @else
                                    <div class="large-3 columns">
                                        <small>Module Leader Name:</small>
                                        <h6>{{$activity->module->user->title}}. {{$activity->module->user->name}}</h6>
                                    </div>
                                @endif
                                <div class="large-3 columns">
                                    <small>View Module's Details</small>
                                    <h6><a href="/Admin/{{$user->id}}/Modules/{{$activity->module->id}}" target="_blank">View</a></h6>
                                </div>
                            </div>
                        @endif        
                    </fieldset>
                </div>

                @if(Session::has('no_sessions'))
                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Support Activity Sessions</legend>
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <div data-alert class="alert-box alert" align="center">
                                    {{ Session::get('no_sessions') }}
                                    <a href="#" class="close">&times;</a>
                                </div>
                            </div>
                        </div>                        
                    </fieldset>
                </div>

                @else
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

                <div class="large-12 medium-12 small-12 columns">
                    <fieldset class="bio">
                        <legend class="legend">Current Operated Students</legend>                        
                        @if(Session::has('no_students'))
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <div data-alert class="alert-box secondary" align="center">
                                    <label class="error">{{ Session::get('no_students') }}</label>
                                </div>
                            </div>
                        </div> 
                        @else
                            <table>
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Student ID</th>
                                        <th>Student Supervisor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($phds as $student)
                                    <tr>
                                        <td><a href="#" data-reveal-id="phd-{{$student->user->id}}"><label>{{$student->user->title}}. {{$student->user->name}}</label></a></td>
                                        <div id="phd-{{$student->user->id}}" class="reveal-modal xlarge" data-reveal>
                                            <h3>Student Details</h3>
                                            <div class="row">
                                                <div class="large-6 columns">
                                                    <small>User Full Name:</small>
                                                    <h5>{{$student->user->title}}. {{$student->user->name}}</h5>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Username:</small>
                                                    <h5>{{$student->user->username}}</h5>
                                                </div>
                                                <div class="large-4 columns">
                                                    <small>Room number:</small>
                                                    <h5>{{$student->user->room_number}}</h5>
                                                </div>
                                                <div class="large-4 columns">
                                                    <small>Email Address:</small>
                                                    <h5>{{$student->user->email}}</h5>
                                                </div>
                                                <div class="large-4 columns">
                                                    <small>Phone Number</small>
                                                    <h5>{{$student->user->phone_number}}</h5>
                                                </div>
                                            </div>
                                            <a class="close-reveal-modal">&#215;</a>
                                        </div>
                                        <td>{{$student->phd->student_id}}</td>      
                                        <td><a href="#" data-reveal-id="sup-{{$student->phd->supervisor->id}}"><label>{{$student->phd->supervisor->title}}. {{$student->phd->supervisor->name}}</label></a></td>
                                        <div id="sup-{{$student->phd->supervisor->id}}" class="reveal-modal xlarge" data-reveal>
                                            <h3>Supervisor Details</h3>
                                            <div class="row">
                                                <div class="large-6 columns">
                                                    <small>User Full Name:</small>
                                                    <h5>{{$student->phd->supervisor->title}}. {{$student->phd->supervisor->name}}</h5>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Username:</small>
                                                    <h5>{{$student->phd->supervisor->username}}</h5>
                                                </div>
                                                <div class="large-4 columns">
                                                    <small>Room number:</small>
                                                    <h5>{{$student->phd->supervisor->room_number}}</h5>
                                                </div>
                                                <div class="large-4 columns">
                                                    <small>Email Address:</small>
                                                    <h5>{{$student->phd->supervisor->email}}</h5>
                                                </div>
                                                <div class="large-4 columns">
                                                    <small>Phone Number</small>
                                                    <h5>{{$student->phd->supervisor->phone_number}}</h5>
                                                </div>
                                            </div>
                                            <a class="close-reveal-modal">&#215;</a>
                                        </div>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
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
<script>
    $(document).foundation();
</script>

</body>
</html>
