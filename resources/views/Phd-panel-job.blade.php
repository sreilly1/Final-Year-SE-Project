
<html>
<head>
    <meta charset="utf-8">
    <title>foundation on laravel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <script src="{{ asset('js/modernizr.js') }}"> </script>
    <link href="http://addtocalendar.com/atc/1.5/atc-style-blue.css" rel="stylesheet" type="text/css">
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
            <a href="#">Notification</a>
            <ul class="dropdown">
              <li><a href="/Phd">Main Page</a></li>
            </ul>
          </li>
        </ul>

        <ul class="left">
            <li><a href="/Phd/{{$user->id}}">Main</a></li>
            <li class="active"><a href="#">Support Activity Sessions Page: All Sessions</a></li>
        </ul>

      </section>
    </nav>

    <header>
        <h2 class="welcome_text">All Sessions</h2>
    </header>



    
    <section class="section_light">

        <div style="width:100%;">

            <div class="row">
                <div class="large-12 medium-12 small-12 columns">

                    <ul class="breadcrumbs">
                        <li class="current"><a href="#">All Sessions</a></li>
                        <li><a href="/Phd/{{$user->id}}/JobSessions/ByAct">Search by Activity Title</a></li>
                    </ul>

                    @if(Session::has('failed'))
                    <div class="row">
                        <div class="large-12 medium-12 small-12 columns">
                            <div data-alert class="alert-box alert" align="center">
                                {{ Session::get('failed') }}
                                <a href="#" class="close">&times;</a>
                            </div>
                        </div>
                    </div>
                    @endif



                    <!-- For large screens -->
                    <div class="show-for-large-up">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Time</th>                                                    
                                <th>Location</th>
                                <th>Activity Title</th>
                                <th>Instructor/s</th>
                                <th>Add to Calendar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                @foreach($request->sessions as $session)
                                <tr>
                                    <td>{{$session->title}}</td>
                                    <td>{{date("d-m-Y", strtotime($session->date_of_session))}}</td>
                                    <td>{{date("H:i", strtotime($session->start_time))}} - {{date("H:i", strtotime($session->end_time))}}</td>
                                    <td>{{$session->location}}</td>
                                    <td><a data-reveal-id="act-{{$session->activity->id}}"><label style="color:#5F9EA0; font-size: 90%;">{{$session->activity->title}}</label></a></td>
                                    <div id="act-{{$session->activity->id}}" class="reveal-modal large" data-reveal>
                                        <div class="row">
                                            <div class="large-12 columns">
                                                <small>Activity Title:</small>
                                                <h5>{{$session->activity->title}}</h5>
                                            </div>
                                            <div class="large-12 columns">
                                                <small>Module Code & Name:</small>
                                                <h5>{{$session->activity->module->module_code}} <strong>{{$session->activity->module->module_name}}</strong></h5>
                                            </div>
                                        </div>
                                        <a class="close-reveal-modal">&#215;</a>
                                    </div>
                                    <td><a data-reveal-id="usr-{{$session->activity->module->user->id}}"><label style="color:#5F9EA0; font-size: 90%;">{{$session->activity->module->user->title}}. {{$session->activity->module->user->name}}</label></a>
                                        <div id="usr-{{$session->activity->module->user->id}}" class="reveal-modal large" data-reveal>
                                            <h3>Supervisor Details</h3>
                                            <div class="row">
                                                <div class="large-6 columns">
                                                    <small>User Full Name:</small>
                                                    <h5>{{$session->activity->module->user->title}}. {{$session->activity->module->user->name}}</h5>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Username:</small>
                                                    <h5>{{$session->activity->module->user->username}}</h5>
                                                </div>
                                                <div class="large-4 columns">
                                                    <small>Room number:</small>
                                                    <h5>{{$session->activity->module->user->room_number}}</h5>
                                                </div>
                                                <div class="large-4 columns">
                                                    <small>Email Address:</small>
                                                    <a href="mailto:{{$session->activity->module->user->email}}"><h5 style="color:#5F9EA0;">{{$session->activity->module->user->email}}</h5></a>
                                                </div>
                                                <div class="large-4 columns">
                                                    <small>Phone Number</small>
                                                    <h5>{{$session->activity->module->user->phone_number}}</h5>
                                                </div>
                                            </div>
                                            <a class="close-reveal-modal">&#215;</a>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="addtocalendar atc-style-blue">
                                            <a class="atcb-link" style="font-size: 9px; padding: 1px 10px; color: black; background: none;">Add to Calendar</a> <!-- You can change button title by adding this line -->
                                            <var class="atc_event">
                                                <var class="atc_date_start">{{$session->date_of_session}} {{$session->start_time}}</var>
                                                <var class="atc_date_end">{{$session->date_of_session}} {{$session->end_time}}</var>
                                                <var class="atc_timezone">Europe/London</var>
                                                <var class="atc_title">{{$session->activity->module->module_code}} {{$session->activity->module->module_name}}</var>
                                                <var class="atc_description">Activity: {{$session->activity->title}}, Instructor: {{$session->activity->module->user->title}}. {{$session->activity->module->user->name}}</var>
                                                <var class="atc_location">{{$session->location}}</var>
                                                <var class="atc_organizer">Helen Phillips</var>
                                                <var class="atc_organizer_email">fahood.kh1@gmail.com</var>
                                            </var>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    </div>


                    <!-- for mdedium screens : Tablets -->

                    <div class="show-for-medium-only hide-for-large-up">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Full Details</th>
                                <th>Add to Calendar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                @foreach($request->sessions as $session)
                                <tr>
                                    <td style="font-size: 82%;">{{$session->title}}</td>
                                    <td style="font-size: 82%;">{{date("d-m-Y", strtotime($session->date_of_session))}}</td>
                                    <td><a data-reveal-id="act-med-{{$session->id}}"><label style="color:#5F9EA0; font-size: 82%;">View</label></a></td>                                    
                                        <div id="act-med-{{$session->id}}" class="reveal-modal large" data-reveal>
                                            <h4>Session Details</h4>
                                            <div class="row">
                                                <div class="large-12 columns">
                                                    <small>Session Title</small>
                                                    <h5>{{$session->title}}</h5>
                                                </div>
                                                <div class="large-12 columns">
                                                    <small>Session Date</small>
                                                    <h5>{{date("d-m-Y", strtotime($session->date_of_session))}}</h5>
                                                </div>
                                                <div class="large-12 columns">
                                                    <small>Session Time</small>
                                                    <h5>{{date("H:i", strtotime($session->start_time))}} - {{date("H:i", strtotime($session->end_time))}}</h5>
                                                </div>    
                                                <div class="large-12 columns">
                                                    <small>Session Location</small>
                                                    <h5>{{$session->location}}</h5>
                                                </div>                                                
                                            </div>
                                            <hr>
                                            <h4>Activity Details</h4>
                                            <div class="row">
                                                <div class="large-6 columns">
                                                    <small>Activity Title</small>
                                                    <h5>{{$session->activity->title}}</h5>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Activity Role Type</small>
                                                    <h5>{{$session->activity->role_type}}</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <h4>Module Details</h4>
                                            <div class="row">
                                                <div class="large-6 columns">
                                                    <small>Module Code</small>
                                                    <h5>{{$session->activity->module->module_code}}</h5>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Module Name</small>
                                                    <h5>{{$session->activity->module->module_name}}</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <h4>Instructor Details</h4>
                                            <div class="row">
                                                <div class="large-5 columns">
                                                    <small>User Full Name:</small>
                                                    <h5>{{$session->activity->module->user->title}}. {{$session->activity->module->user->name}}</h5>
                                                </div>
                                                <div class="large-5 columns">
                                                    <small>Username:</small>
                                                    <h5>{{$session->activity->module->user->username}}</h5>
                                                </div>
                                                <div class="large-2 columns">
                                                    <small>Room number:</small>
                                                    <h5>{{$session->activity->module->user->room_number}}</h5>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Email Address:</small>
                                                    <a href="mailto:{{$session->activity->module->user->email}}"><h5 style="color:#5F9EA0;">{{$session->activity->module->user->email}}</h5></a>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Phone Number</small>
                                                    <h5>{{$session->activity->module->user->phone_number}}</h5>
                                                </div>
                                            </div>
                                            <a class="close-reveal-modal">&#215;</a>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="addtocalendar atc-style-blue">
                                            <a class="atcb-link" style="font-size: 9px; padding: 1px 10px; color: black; background: none;">Add to Calendar</a> <!-- You can change button title by adding this line -->
                                            <var class="atc_event">
                                                <var class="atc_date_start">{{$session->date_of_session}} {{$session->start_time}}</var>
                                                <var class="atc_date_end">{{$session->date_of_session}} {{$session->end_time}}</var>
                                                <var class="atc_timezone">Europe/London</var>
                                                <var class="atc_title">{{$session->title}}</var>
                                                <var class="atc_description">Activity: {{$session->activity->title}}, Instructor: {{$session->activity->module->user->title}}. {{$session->activity->module->user->name}}</var>
                                                <var class="atc_location">{{$session->location}}</var>
                                                <var class="atc_organizer">Helen Phillips</var>
                                                <var class="atc_organizer_email">fahood.kh1@gmail.com</var>
                                            </var>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    </div>



                    <!-- For Smart phones -->
                    <div class="show-for-small-only hide-for-medium-up">
                    <table>
                        <thead>
                            <tr>
                                <th>Session Title</th>
                                <th>Add to Calendar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                @foreach($request->sessions as $session)
                                <tr>
                                    <td><a data-reveal-id="sess-{{$session->id}}"><label style="color:#5F9EA0; font-size: 82%;">
                                        @if($session->title === '')
                                            No Title
                                        @else    
                                            <strong>{{$session->title}}</strong>
                                        @endif
                                    </label></a></td>                                    
                                        <div id="sess-{{$session->id}}" class="reveal-modal large" data-reveal>
                                            <h4>Session Details</h4>
                                            <div class="row">
                                                <div class="large-4 columns">
                                                    <small>Date</small>
                                                    <h5>{{date("d-m-Y", strtotime($session->date_of_session))}}</h5>
                                                </div>
                                                <div class="large-4 columns">
                                                    <small>Time</small>
                                                    <h5>{{date("H:i", strtotime($session->start_time))}} - {{date("H:i", strtotime($session->end_time))}}</h5>
                                                </div>
                                                <div class="large-4 columns">
                                                    <small>Location</small>
                                                    <h5>{{$session->location}}</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <h4>Activity Details</h4>
                                            <div class="row">
                                                <div class="large-6 columns">
                                                    <small>Activity Title</small>
                                                    <h5>{{$session->activity->title}}</h5>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Activity Role Type</small>
                                                    <h5>{{$session->activity->role_type}}</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <h4>Module Details</h4>
                                            <div class="row">
                                                <div class="large-6 columns">
                                                    <small>Module Code</small>
                                                    <h5>{{$session->activity->module->module_code}}</h5>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Module Name</small>
                                                    <h5>{{$session->activity->module->module_name}}</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <h4>Instructor Details</h4>
                                            <div class="row">
                                                <div class="large-5 columns">
                                                    <small>User Full Name:</small>
                                                    <h5>{{$session->activity->module->user->title}}. {{$session->activity->module->user->name}}</h5>
                                                </div>
                                                <div class="large-5 columns">
                                                    <small>Username:</small>
                                                    <h5>{{$session->activity->module->user->username}}</h5>
                                                </div>
                                                <div class="large-2 columns">
                                                    <small>Room number:</small>
                                                    <h5>{{$session->activity->module->user->room_number}}</h5>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Email Address:</small>
                                                    <a href="mailto:{{$session->activity->module->user->email}}"><h5 style="color:#5F9EA0;">{{$session->activity->module->user->email}}</h5></a>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Phone Number</small>
                                                    <h5>{{$session->activity->module->user->phone_number}}</h5>
                                                </div>
                                            </div>
                                            <a class="close-reveal-modal">&#215;</a>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="addtocalendar atc-style-blue">
                                            <a class="atcb-link" style="font-size: 9px; padding: 1px 10px; color: black; background: none;">Add to Calendar</a> <!-- You can change button title by adding this line -->
                                            <var class="atc_event">
                                                <var class="atc_date_start">{{$session->date_of_session}} {{$session->start_time}}</var>
                                                <var class="atc_date_end">{{$session->date_of_session}} {{$session->end_time}}</var>
                                                <var class="atc_timezone">Europe/London</var>
                                                <var class="atc_title">{{$session->activity->module->module_code}} {{$session->activity->module->module_name}}</var>
                                                <var class="atc_description">Activity: {{$session->activity->title}}, Instructor: {{$session->activity->module->user->title}}. {{$session->activity->module->user->name}}</var>
                                                <var class="atc_location">{{$session->location}}</var>
                                                <var class="atc_organizer">Helen Phillips</var>
                                                <var class="atc_organizer_email">fahood.kh1@gmail.com</var>
                                            </var>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    </div>

                </div>                              
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


        <!-- Add to calendar feature: -->

        <script type="text/javascript">(function () {
                if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
                if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
                    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                    s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
                    s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
                    var h = d[g]('body')[0];h.appendChild(s); }})();
        </script>

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