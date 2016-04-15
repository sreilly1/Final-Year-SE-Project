
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
            <li><a href="/Phd/{{$user->id}}/JobSessions">Support Activity Sessions Page - All Sessions</a></li>
            <li class="active"><a href="#">Sessions by Support Activity Title</a></li>
        </ul>

      </section>
    </nav>

    <header>
        <h2 class="welcome_text">Sessions by Support Activity Title</h2>
    </header>



    
    <section class="section_light">

        <div style="width:100%;">

            <div class="row">
                <div class="large-12 medium-12 small-12 columns">

                    <ul class="breadcrumbs">
                        <li><a href="/Phd/{{$user->id}}/JobSessions">All Sessions</a></li>
                        <li class="current"><a>Search by Activity Title</a></li>
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

                    
                    <dl class="accordion" data-accordion>
                      <dd class="accordion-navigation">
                        @foreach($requests as $request)
                            <a href="#act-{{$request->activity->id}}"><label>Support Activity Title:</label> <h5>{{$request->activity->title}}</h5></a>
                            <div id="act-{{$request->activity->id}}" class="content">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Time</th>                                                    
                                                <th>Location</th>
                                                <th>Module Name</th>
                                                <th>Instructor/s</th>
                                                <th>Add to Calendar</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            @foreach($request->activity->events as $session)
                                                <tr>
                                                    <td>{{date("d-m-Y", strtotime($session->date_of_session))}}</td>
                                                    <td>{{date("H:i", strtotime($session->start_time))}} - {{date("H:i", strtotime($session->end_time))}}</td>
                                                    <td>{{$session->location}}</td>
                                                    <td>{{$session->activity->module->module_code}} {{$session->activity->module->module_name}}</td>
                                                    <td><a data-reveal-id="usr-{{$session->activity->module->user->id}}"><label style="color:#5F9EA0;">{{$session->activity->module->user->title}}. {{$session->activity->module->user->name}}</label></a>
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
                                        </tbody>
                                    </table>                                
                            </div>
                            <hr>
                        @endforeach
                      </dd>
                    </dl>
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

        <script src="{{ asset('js/vendor/jquery.js') }}"></script>
        <script src="{{ asset('js/foundation/foundation.js') }}"></script>
        <script src="{{ asset('js/foundation/foundation.reveal.js') }}"></script>
        <script src="{{ asset('js/foundation/foundation.topbar.js') }}"></script>
        <script src="{{ asset('js/foundation/foundation.accordion.js') }}"></script>
<script>
    $(document).foundation();
    $(document).foundation('accordion', 'reflow');
</script>

</body>
</html>