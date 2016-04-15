
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
            <li><a href="/Admin/{{$user->id}}/Requests">Requests</a></li>
            <li><a href="/Admin/{{$user->id}}/Requests/Accepted">Accepted</a></li>
            <li class="active"><a href="#">Request #: {{$request->id}} - PhD Student: {{$Phd->user->name}}</a></li>
        </ul>

      </section>
    </nav>

    <header>

        <h2 class="welcome_text">Request Full Details</h2>
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

                        <legend class="legend">Request Details</legend>
                            <div class="row">
                                <div class="large-4 columns">
                                    <small>Request ID:</small>
                                    <h6>{{$request->id}}</h6>
                                </div>
                                <div class="large-4 columns">
                                    <small>Supervisor Confirmation:</small>
                                    <h6>{{$request->supervisor_confirmation}}</h6>
                                </div>
                                <div class="large-4 columns">
                                    <small>Supervisor Comment</small>
                                    @if($request->supervisor_comment === '')
                                    <h6>No Comment</h6>
                                    @else
                                    <a href="#" data-reveal-id="viewCmnt"><h6>View</h6></a>
                                    <div id="viewCmnt" class="reveal-modal xlarge" data-reveal>
                                        <h3>Comment from: {{$request->supervisor_comment}}</h3>
                                        <!-- Social Dialogue Section -->
                                        <div class="row">
                                            <blockquote>{{$request->supervisor_comment}}<cite>{{$request->phd->supervisor->name}}</cite></blockquote>
                                        </div>
                                        <a class="close-reveal-modal">&#215;</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                    </fieldset>
                </div>


                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Student Details</legend>
                            <div class="row">
                                <div class="large-3 columns">
                                    <small>User Full Name:</small>
                                    <h6>{{$Phd->user->title}}. {{$Phd->user->name}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Username:</small>
                                    <h6>{{$Phd->user->username}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Email Address:</small>
                                    <h6>{{$Phd->user->email}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Phone Number</small>
                                    <h6>{{$Phd->user->phone_number}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    <small>Room number:</small>
                                    <h6>{{$Phd->user->room_number}}</h6>
                                </div>
                            </div>
                    </fieldset>
                </div>


                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Student Study Details</legend>

                        <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    <div class="row">
                                        @if($Phd->supervisor_id === null)
                                        <div class="row">
                                            <div class="large-12 medium-12 small-12 columns">
                                                <div class="large-6 columns">
                                                    <small>Student Number:</small>
                                                    <h6>{{$Phd->student_id}}</h6>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Year of Study:</small>
                                                    <h6>{{$Phd->year_of_study}}</h6>
                                                </div>
                                            </div>
                                            <div class="large-12 medium-12 small-12 columns">
                                                <div data-alert class="alert-box alert" align="center">
                                                    This PhD Student has no "Supervisor"
                                                    <a href="#" class="close">&times;</a>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="large-12 medium-12 small-12 columns">
                                                <div class="large-6 columns">
                                                    <small>Student Number:</small>
                                                    <h6>{{$Phd->student_id}}</h6>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Year of Study:</small>
                                                    <h6>{{$Phd->year_of_study}}</h6>
                                                </div>
                                                <div class="large-3 columns">
                                                    <small>Supervisor Name:</small>
                                                    <h6>{{$Phd->supervisor->title}}. {{$Phd->supervisor->name}}</h6>
                                                </div>
                                                <div class="large-3 columns">
                                                    <small>Supervisor E-mail address:</small>
                                                    <h6>{{$Phd->supervisor->email}}</h6>
                                                </div>
                                                <div class="large-3 columns">
                                                    <small>Supervisor phone number:</small>
                                                    <h6>{{$Phd->supervisor->phone_number}}</h6>
                                                </div>
                                                <div class="large-3 columns">
                                                    <small>Supervisor room number:</small>
                                                    <h6>{{$Phd->supervisor->room_number}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        @endif    
                                    </div>
                                </div>
                            </div>
                              
                    </fieldset>
                </div>




                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Activity Details</legend>
                            <div class="row">
                                <div class="large-4 columns">
                                    <small>Activity Title:</small>
                                    <h6>{{$activity->title}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    <small>Role Type:</small>
                                    <h6>{{$activity->role_type}}</h6>
                                </div>
                                @if($activity->module_id === null)
                                    <div class="large-4 columns">
                                        <small>No Module assigned:</small>
                                        <h6>This Support Activity has no module that it belongs to</h6>
                                    </div>
                                @else
                                <div class="large-4 columns">
                                    <small>Module Name:</small>
                                    <h6>{{$activity->module->module_name}}</h6>
                                </div>
                                @endif
                                <div class="large-1 columns">
                                    <small></small>
                                    <h6><a href="/Admin/{{$user->id}}/Activities/{{$activity->id}}">View</a></h6>
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
                                <div class="large-5 columns">
                                    <small>Module Name:</small>
                                    <h6>{{$activity->module->module_name}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Module Code:</small>
                                    <h6>{{$activity->module->module_code}}</h6>
                                </div>
                                @if($activity->module->module_leader === null)
                                    <div class="large-4 columns">
                                        <small>Module Leader:</small>
                                        <h6><label class="error">This module has no "Module Leader"</label></h6>
                                    </div>
                                @else
                                    <div class="large-4 columns">
                                        <small>Module Leader Name:</small>
                                        <h6>{{$activity->module->user->title}}. {{$activity->module->user->name}}</h6>
                                    </div>
                                @endif
                                <div class="large-1 columns">
                                    <small></small>
                                    <h6><a href="/Admin/{{$user->id}}/Modules/{{$activity->module->id}}">View</a></h6>
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
                                        <td><a href="/Admin/{{$user->id}}/Activities/Sessions/{{$session->id}}">View</a>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
