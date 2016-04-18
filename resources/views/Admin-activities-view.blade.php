
<html>
<head>
    <meta charset="utf-8">
    <title>foundation on laravel</title>
    <link rel="stylesheet" href="{{ asset('css/foundation-datepicker.min.css') }}">
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

        @if($activity->module_id === null)
        <ul class="left">
            <li><a href="/Admin/{{$user->id}}">Main</a></li>
            <li><a href="/Admin/{{$user->id}}/Activities">Activities</a></li>
            <li class="active"><a href="#">{{$activity->title}}</a></li>
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
            <li><a href="/Admin/{{$user->id}}/Modules/{{$activity->module->id}}">{{$activity->module->module_name}}</a></li>
            <li class="active"><a href="#">{{$activity->title}}</a></li>
        </ul>
        @endif

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
                    @if(Session::has('session_success'))
                        <div class="large-12 medium-12 small-12 columns">
                            <div data-alert class="alert-box success" align="center">
                                {{ Session::get('session_success') }}
                                <a href="#" class="close">&times;</a>
                            </div>
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
                                <div class="large-12 columns">
                                    <small>Activity Description</small>
                                    @if($activity->description === '')
                                        <label class="error" align="center">This Activity has no description, please add description!</label>
                                    @else
                                        <textarea readonly="readonly" style="resize: none; min-height:100px;">{{$activity->description}}</textarea>
                                    @endif
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
                                    <h6><a href="/Admin/{{$user->id}}/Modules/{{$activity->module->id}}" >View</a></h6>
                                </div>
                                <div class="large-12 columns">
                                    <small>Module Description</small>
                                    <div class="panel">
                                        <h5><small>
                                        @if($activity->module->description === '')
                                            <label class="error" align="center">This module has no description, please add description!</label>
                                        @else
                                            <label>{{$activity->module->description}}</label>
                                        @endif
                                        </small></h5>
                                    </div>
                                </div>
                            </div>
                        @endif        
                    </fieldset>
                </div>

                @if(Session::has('no_sessions'))
                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">
                            <ul class="inline-list">
                              <li>Support Activity Sessions</li>
                              <li><a data-reveal-id="AddSession"><label>Add</label></a></li>
                            </ul>
                        </legend>
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
                        <legend class="legend">
                            <ul class="inline-list">
                              <li>Support Activity Sessions</li>
                              <li><a data-reveal-id="AddSession"><label>Add</label></a></li>
                            </ul>
                        </legend>
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
                                        <td>{{$session->title}}</td>
                                        <td>{{date("d-m-Y", strtotime($session->date_of_session))}}</td>      
                                        <td>{{date("H:i", strtotime($session->start_time))}} - {{date("H:i", strtotime($session->end_time))}}</td>
                                        <td>{{$session->location}}</td>                                                                                                
                                        <td><a href="/Admin/{{$user->id}}/Activities/Sessions/{{$session->id}}" >View</a>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </fieldset>
                </div>


                <!-- Add session pop up window -->
                <div id="AddSession" class="reveal-modal xlarge" data-reveal>
                    <h3>Add Session</h3>                    
                    <div class="row">
                        <div class="large-12 columns">
                            <form action="/Admin/{{$user->id}}/Activities/Sessions/Add/Action" role="form" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="activity_id" value="{{$activity->id}}">
                                <div class="row">
                                    <div class="large-6 columns">
                                        <label>Date</label>
                                        <input type="text" name="date_of_session" id="dp">
                                    </div>
                                    <div class="large-6 columns">
                                        <label>Session Location</label>
                                        <input type="text" name="location" placeholder="E.g T2.09"/>
                                    </div>
                                    <div class="large-4 columns">
                                        <label>Session Starting Time</label>
                                        <input type="text" name="start_time" placeholder="hh:mm"/>
                                    </div>
                                    <div class="large-4 columns">
                                        <label>Session Ending Time</label>
                                        <input type="text" name="end_time" placeholder="hh:mm"/>
                                    </div>
                                    <div class="large-4 columns">
                                        <label class="green">Confirm & Add</label>
                                        <input type="submit" value="add" class="button postfix">
                                    </div>
                                </div>
                            </form> 
                        </div>
                    </div>
                    <a class="close-reveal-modal">&#215;</a>
                </div>
                <!-- Add session pop up window ends -->


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
        <script src="{{ asset('js/foundation/foundation.alert.js') }}"></script>
        <script src="{{ asset('js/foundation-datepicker.js') }}"></script>
        <script src="{{ asset('js/locales/foundation-datepicker.vi.js') }}"></script>
        <script>
            $(function () {

                $('#dp1').fdatepicker({
                    format: 'mm-dd-yyyy hh:ii',
                    disableDblClickSelection: true,
                    language: 'vi',
                    pickTime: true
                });

                $('#dp').fdatepicker({
                    initialDate: '????-??-??',
                    format: 'dd-mm-yyyy',
                    disableDblClickSelection: true
                });

                $('#dpE').fdatepicker({
                    format: 'yyyy-mm-dd',
                    disableDblClickSelection: true
                });

                



                // implementation of disabled form fields
                var nowTemp = new Date();
                var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
                var checkin = $('#dpd1').fdatepicker({
                    onRender: function (date) {
                        return date.valueOf() < now.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function (ev) {
                    if (ev.date.valueOf() > checkout.date.valueOf()) {
                        var newDate = new Date(ev.date)
                        newDate.setDate(newDate.getDate() + 1);
                        checkout.update(newDate);
                    }
                    checkin.hide();
                    $('#dpd2')[0].focus();
                }).data('datepicker');
                var checkout = $('#dpd2').fdatepicker({
                    onRender: function (date) {
                        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function (ev) {
                    checkout.hide();
                }).data('datepicker');
            });
        </script>
        <script>
            $(document).foundation();
        </script>

</body>
</html>
