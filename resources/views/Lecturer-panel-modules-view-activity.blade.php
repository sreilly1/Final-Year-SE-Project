
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
            <li class="active"><a href="#">Activity: {{$activity->title}}</a></li>
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

                        
                        <legend class="legend">
                            <ul class="inline-list">
                              <li>Activity Details</li>
                              <li><a href="/Lecturer/{{$user->id}}/Modules/mod{{$module->id}}/Act{{$activity->id}}/Modify"><label>Edit</label></a></li>
                              @if(Session::has('no_delete'))
                              @else
                                <li><a href="/Lecturer/{{$user->id}}/Modules/mod{{$module->id}}/Act{{$activity->id}}/Delete"><label class="error">Delete</label></a></li>
                              @endif
                            </ul>
                        </legend>

                            <div class="row">
                                <div class="large-3 columns">
                                    <small>Activity Title:</small>
                                    <h6>{{$activity->title}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    <small>Role Type:</small>
                                    <h6>{{$activity->role_type}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    <small>Nom of Applicants Needed</small>
                                    <h6>{{$activity->quant_ppl_needed}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    <small>Module Name:</small>
                                    <h6>{{$activity->module->module_name}}</h6>
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


                @if(Session::has('no_sessions'))
                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">
                            <ul class="inline-list">
                              <li>Support Activity Sessions</li>
                              <li><a href="/Lecturer/{{$user->id}}/Modules/mod{{$module->id}}/Act{{$activity->id}}/AddSession"><label>Add</label></a></li>
                            </ul>
                        </legend>
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <div data-alert class="alert-box alert" align="center">
                                    {{ Session::get('no_sessions') }}                                    
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
                              <li><a href="/Lecturer/{{$user->id}}/Modules/mod{{$module->id}}/Act{{$activity->id}}/AddSession"><label>Add</label></a></li>
                            </ul>
                        </legend>
                        
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
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
                                        <td><a href="/Lecturer/{{$user->id}}/Modules/mod{{$module->id}}/Act{{$activity->id}}/Ses{{$session->id}}">View</a>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </fieldset>
                </div>

                    @if(Session::has('no_applicants'))
                        <div class="large-12 medium-12 small-12 columns">
                            <fieldset class="bio">

                                <legend class="legend">Current Operated Students</legend>
                                <div class="row">
                                    <div class="large-12 medium-12 small-12 columns">
                                        <div data-alert class="alert-box alert" align="center">
                                            {{ Session::get('no_applicants') }}                                            
                                        </div>
                                    </div>
                                </div>                        
                            </fieldset>
                        </div>
                    @else
                        <div class="large-12 medium-12 small-12 columns">
                            <fieldset class="bio">
                                <legend class="legend">Current Operated Students</legend>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                <th>Student ID</th>
                                                <th>Supervisor</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($phds as $student)
                                            <tr>
                                                <td>{{$student->user->title}}. {{$student->user->name}}</td>
                                                <td>{{$student->phd->student_id}}</td>      
                                                <td>{{$student->phd->supervisor->title}}. {{$student->phd->supervisor->name}}</td>
                                                <td><a href="#">View</a>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </fieldset>
                        </div>
                    @endif
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
