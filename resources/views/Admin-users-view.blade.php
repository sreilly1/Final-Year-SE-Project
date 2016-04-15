
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
            <li><a href="/Admin/{{$user->id}}/Users">Users</a></li>
            <li class="active"><a href="#">View: {{$viewed_user->name}}</a></li>
        </ul>

      </section>
    </nav>

    <header>

        <h2 class="welcome_text">{{$viewed_user->role}}::  {{$viewed_user->name}}</h2>
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

                @if($viewed_user->role === 'Administrator')

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">User Details</legend>
                            <div class="row">
                                <div class="large-4 columns">
                                    <small>User Full Name:</small>
                                    <h6>{{$viewed_user->title}}. {{$viewed_user->name}}</h6>
                                </div>
                                <div class="large-4 columns">
                                    <small>Username:</small>
                                    <h6>{{$viewed_user->username}}</h6>
                                </div>
                                <div class="large-4 columns">
                                    <small>Room number:</small>
                                    <h6>{{$viewed_user->room_number}}</h6>
                                </div>
                                <div class="large-5 columns">
                                    <small>Email Address:</small>
                                    <h6>{{$viewed_user->email}}</h6>
                                </div>
                                <div class="large-5 columns">
                                    <small>Phone Number</small>
                                    <h6>{{$viewed_user->phone_number}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Edit</small>
                                    <h6><a href="/Admin/Users/Modify/Admin/{{$viewed_user->id}}">Edit</a></h6>
                                </div>

                            </div>
                    </fieldset>
                </div>

                @elseif($viewed_user->role === 'Lecturer')

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">User Details</legend>
                            <div class="row">
                                <div class="large-3 columns">
                                    <small>User Full Name:</small>
                                    <h6>{{$viewed_user->title}}. {{$viewed_user->name}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Username:</small>
                                    <h6>{{$viewed_user->username}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Email Address:</small>
                                    <h6>{{$viewed_user->email}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Phone Number</small>
                                    <h6>{{$viewed_user->phone_number}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    <small>Room number:</small>
                                    <h6>{{$viewed_user->room_number}}</h6>
                                </div>
                            </div>
                    </fieldset>
                </div>


                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Modules Details</legend>

                        <div class="row">
                            @if(Session::has('no_modules'))
                                <div class="large-12 medium-12 small-12 columns">
                                    
                                        <div data-alert class="alert-box secondary" align="center">
                                            {{ Session::get('no_modules') }}
                                            <a href="#" class="close">&times;</a>
                                        </div>
                                    
                                </div>
                            @else
                                <div class="large-12 medium-12 small-12 columns">
                                    <form>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Module Name</th>
                                                    <th>Module Code</th>
                                                    <th></th>
                                                </tr>
                                            </thead>                                                                                          
                                            <tbody>
                                                @foreach($module as $modules)  
                                                <tr>
                                                    <td>{{$modules->module_name}}</td>
                                                    <td>{{$modules->module_code}}</td>
                                                    <td><a href="/Admin/Modules/{{$modules->id}}" align="center">View Module</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>                                            
                                    </form>
                                </div>
                            @endif
                            </div>                                                
                    </fieldset>
                </div>

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Supervision Details</legend>

                        <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    @if(Session::has('no_phd'))
                                        <div data-alert class="alert-box secondary" align="center">
                                            {{ Session::get('no_phd') }}
                                            <a href="#" class="close">&times;</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="large-12 medium-12 small-12 columns">
                                    <form>                                            
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>PhD Student Name</th>
                                                    <th>PhD Student ID Number</th>
                                                    <th>Year of Study</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($phd as $phd)
                                                <tr>
                                                    <td>{{$phd->user->name}}</td>
                                                    <td>{{$phd->student_id}}</td>
                                                    <td>{{$phd->year_of_study}}</td>
                                                    <td><a href="/Admin/Users/{{$phd->user->id}}" align="center">View & Manage PhD Student</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>                                            
                                    </form>
                                </div>
                            </div>
                    </fieldset>
                </div>

                @else

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">User Details</legend>
                            <div class="row">
                                <div class="large-3 columns">
                                    <small>User Full Name:</small>
                                    <h6>{{$viewed_user->title}}. {{$viewed_user->name}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Username:</small>
                                    <h6>{{$viewed_user->username}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Email Address:</small>
                                    <h6>{{$viewed_user->email}}</h6>
                                </div>
                                <div class="large-2 columns">
                                    <small>Phone Number</small>
                                    <h6>{{$viewed_user->phone_number}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    <small>Room number:</small>
                                    <h6>{{$viewed_user->room_number}}</h6>
                                </div>
                            </div>
                    </fieldset>
                </div>


                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">PhD Details Details</legend>

                        <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    @if(Session::has('no_phd_info'))
                                        <div data-alert class="alert-box secondary" align="center">
                                            {{ Session::get('no_phd_info') }}
                                            <a href="#" class="close">&times;</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="large-12 medium-12 small-12 columns">
                                    <div class="row">
                                        @if($phdInfo->supervisor_id === null)
                                        <div class="row">
                                            <div class="large-12 medium-12 small-12 columns">
                                                <div class="large-6 columns">
                                                    <small>Student Number:</small>
                                                    <h6>{{$phdInfo->student_id}}</h6>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Year of Study:</small>
                                                    <h6>{{$phdInfo->year_of_study}}</h6>
                                                </div>
                                            </div>
                                            <div class="large-12 medium-12 small-12 columns">
                                                <div data-alert class="alert-box alert" align="center">
                                                    {{ Session::get('no_module_leader_information') }}
                                                    <a href="#" class="close">&times;</a>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="large-12 medium-12 small-12 columns">
                                                <div class="large-6 columns">
                                                    <small>Student Number:</small>
                                                    <h6>{{$phdInfo->student_id}}</h6>
                                                </div>
                                                <div class="large-6 columns">
                                                    <small>Year of Study:</small>
                                                    <h6>{{$phdInfo->year_of_study}}</h6>
                                                </div>
                                                <div class="large-3 columns">
                                                    <small>Supervisor Name:</small>
                                                    <h6>{{$phdInfo->supervisor->title}}. {{$phdInfo->supervisor->name}}</h6>
                                                </div>
                                                <div class="large-3 columns">
                                                    <small>Supervisor E-mail address:</small>
                                                    <h6>{{$phdInfo->supervisor->email}}</h6>
                                                </div>
                                                <div class="large-3 columns">
                                                    <small>Supervisor phone number:</small>
                                                    <h6>{{$phdInfo->supervisor->phone_number}}</h6>
                                                </div>
                                                <div class="large-3 columns">
                                                    <small>Supervisor room number:</small>
                                                    <h6>{{$phdInfo->supervisor->room_number}}</h6>
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

                        <legend class="legend">Current Operated Support Activities</legend>
                        <div class="row">
                            @if(Session::has('no_confirmed_applications'))
                                <div class="large-12 medium-12 small-12 columns">
                                    
                                        <div data-alert class="alert-box secondary" align="center">
                                            {{ Session::get('no_confirmed_applications') }}
                                            <a href="#" class="close">&times;</a>
                                        </div>
                                </div>
                            @else
                                <div class="large-12 medium-12 small-12 columns">
                                    <form>                                            
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Support Activity Title</th>
                                                    <th>Support Activity Module</th>
                                                    <th># of Sessions</th>
                                                    <th>View Full Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($confirmed_sa as $confirmed_sa)
                                                <tr>
                                                    <td>{{$confirmed_sa->activity->title}}</td>
                                                    <td>{{$confirmed_sa->activity->module->module_name}}</td>
                                                    <td>
                                                        @foreach($confirmed_sa->sessions as $sessions)
                                                            {{$sessions->count()}}
                                                        @endforeach
                                                    </td>
                                                    <td><a href="/Admin/Activities/{{$confirmed_sa->activity->id}}" align="center">View</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>                                            
                                    </form>
                                </div>
                            @endif 
                        </div> 
                        
                    </fieldset>
                </div>


                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Applications Requested</legend>


                        <div class="row">
                            @if(Session::has('no_applications'))
                                <div class="large-12 medium-12 small-12 columns">
                                    
                                        <div data-alert class="alert-box secondary" align="center">
                                            {{ Session::get('no_applications') }}
                                            <a href="#" class="close">&times;</a>
                                        </div>
                                </div>
                            @else
                                <div class="large-12 medium-12 small-12 columns">
                                    <form>                                            
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Application Ref Number</th>
                                                    <th>Supervisor Confirmation</th>
                                                    <th>Application Current Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($applications as $application)
                                                <tr>
                                                    <td>{{$application->id}}</td>

                                                    @if($application->supervisor_confirmation === 'Pending') 
                                                        <td><label class="error">No confirmation received</label></td>
                                                    @elseif($application->supervisor_confirmation === 'Declined')  
                                                        <td><strong><label class="error">{{$application->supervisor_confirmation}}</label></strong></td>
                                                    @else
                                                        <td><strong><label><font color="green">{{$application->supervisor_confirmation}}</font></label></strong></td>
                                                    @endif


                                                    @if($application->status === 'Pending') 
                                                        <td><label class="error">{{$application->status}}</label></td>
                                                    @elseif($application->status === 'Declined')  
                                                        <td><strong><label class="error">{{$application->status}}</label></strong></td>
                                                    @else
                                                        <td><strong><label><font color="green">{{$application->status}}</font></label></strong></td>
                                                    @endif
                                                    <td><a href="#" align="center">View</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>                                            
                                    </form>
                                </div>
                            @endif 
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
<script>
    $(document).foundation();
</script>

</body>
</html>
