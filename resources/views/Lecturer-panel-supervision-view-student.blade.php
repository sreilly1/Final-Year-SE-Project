
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
            <li><a href="/Lecturer/{{$user->id}}/Sup">Supervision</a></li>
            <li class="active"><a href="#">{{$student->user->name}}</a></li>
        </ul>

      </section>
    </nav>

    <header>

        <h2 class="welcome_text">{{$student->user->title}}. {{$student->user->name}}</h2>
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

                        <legend class="legend">User Details</legend>
                            <div class="row">
                                <div class="large-3 columns">
                                    <small>User Full Name:</small>
                                    <h6>{{$student->user->title}}. {{$student->user->name}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    <small>Email Address:</small>
                                    <h6>{{$student->user->email}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    <small>Phone Number</small>
                                    <h6>{{$student->user->phone_number}}</h6>
                                </div>
                                <div class="large-3 columns">
                                    <small>Room number:</small>
                                    <h6>{{$student->user->room_number}}</h6>
                                </div>
                            </div>
                    </fieldset>
                </div>


                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">PhD Details Details</legend>

                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <div class="large-6 columns">
                                    <small>Student Number:</small>
                                    <h6>{{$student->user->username}}</h6>
                                </div>
                                <div class="large-6 columns">
                                    <small>Year of Study:</small>
                                    <h6>{{$student->year_of_study}}</h6>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                </div>


                @if(Session::has('no_confirmed_applications'))

                @else
                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Current Operated Support Activities</legend>
                        <div class="row">                        
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
                        </div> 
                        
                    </fieldset>
                </div>
                @endif 


                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Student Awaiting Requested Application Forms</legend>


                        <div class="row">
                            @if(Session::has('no_requests'))
                                <div class="large-12 medium-12 small-12 columns">
                                    
                                        <div data-alert class="alert-box secondary" align="center">
                                            {{ Session::get('no_requests') }}
                                        </div>
                                </div>
                            @else
                                <div class="large-12 medium-12 small-12 columns">
                                    <form>                                            
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Ref#</th>
                                                    <th>Module</th>
                                                    <th>Support Activity</th>
                                                    <th>Please Choose</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($requests as $application)
                                                <tr>
                                                    <td>{{$application->id}}</td>
                                                    <td>{{$application->activity->module->module_name}}</td>
                                                    <td>{{$application->activity->title}}</td>
                                                    <td>
                                                        <ul class="inline-list">
                                                          <li><a href="#" data-reveal-id="Accept{{$application->id}}"><label class="green">Accept</label></a></li>
                                                          <li><a href="#" data-reveal-id="Reject{{$application->id}}"><label class="error">Reject</label></a></li> 
                                                        </ul>
                                                    </td>                                                    
                                                </tr>

                                                <div id="" class="reveal-modal large" data-reveal>
                                                    <div class="row">
                                                        <div class="large-12 columns">
                                                            <form action="" role="form" method="post">
                                                            </form>  
                                                        </div>
                                                    </div>
                                                    <a class="close-reveal-modal">&#215;</a>
                                                </div>

                                                <div id="Reject{{$application->id}}" class="reveal-modal large" data-reveal>
                                                    <div class="row">
                                                        <h3>Rejecting Application</h3>
                                                        <h6><label class="error">Please provide comment specifying reasons of rejection then click on the "Confirm" button</label></h6>

                                                        <div class="large-12 columns">
                                                            <form action="/Lecturer/{{$user->id}}/Sup/Stu{{$student->user_id}}/rejectReq{{$application->id}}" role="form" method="post" id="rejecting{{$application->id}}">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <div class="row">
                                                                    <div class="large-4 columns">
                                                                        <label>Module Name</label>
                                                                        <h6>{{$application->activity->module->module_name}}</h6>
                                                                    </div>
                                                                    <div class="large-4 columns">
                                                                        <label>Support Activity Title</label>
                                                                        <h6>{{$application->activity->title}}</h6>
                                                                    </div>
                                                                    <div class="large-4 columns">
                                                                        <label>Student Name</label>
                                                                        <h6>{{$application->user->title}}. {{$application->user->name}}</h6>
                                                                    </div>
                                                                    <div class="large-12 columns">
                                                                        <label>Please provide reasons or comments
                                                                            <textarea name="supervisor_comment" form="rejecting{{$application->id}}"></textarea>
                                                                        </label>
                                                                    </div>
                                                            </div>
                                                            <input type="submit" value="Confirm" class="button postfix">
                                                        </form>  
                                                    </div>
                                                </div>
                                                <a class="close-reveal-modal">&#215;</a>
                                            </div>


                                            <div id="Accept{{$application->id}}" class="reveal-modal xlarge" data-reveal>
                                                <h3>Accepting Application</h3>
                                                <h6><label class="green">Please provide comment if possible then click on the "Confirm" button</label></h6>
                                                <!-- Social Dialogue Section -->
                                                <div class="row">
                                                    <div class="large-12 columns">
                                                        <form action="/Lecturer/{{$user->id}}/Sup/Stu{{$student->user_id}}/confirmReq{{$application->id}}" role="form" method="post" id="accepting{{$application->id}}">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <div class="row">
                                                                <div class="large-4 columns">
                                                                    <label>Module Name</label>
                                                                    <h6>{{$application->activity->module->module_name}}</h6>
                                                                </div>
                                                                <div class="large-4 columns">
                                                                    <label>Support Activity Title</label>
                                                                    <h6>{{$application->activity->title}}</h6>
                                                                </div>
                                                                <div class="large-4 columns">
                                                                    <label>Student Name</label>
                                                                    <h6>{{$application->user->title}}. {{$application->user->name}}</h6>
                                                                </div>
                                                                <div class="large-12 columns">
                                                                  <label>Please provide note or comment if possible
                                                                    <textarea name="supervisor_comment" form="accepting{{$application->id}}"></textarea>
                                                                  </label>
                                                                </div>
                                                            </div>
                                                            <input type="submit" value="Confirm" class="button postfix">
                                                        </form>    
                                                    </div>
                                                </div>
                                                <a class="close-reveal-modal">&#215;</a>
                                            </div>
                                            @endforeach                                            
                                        </tbody>
                                        </table>                                            
                                    </form>
                                </div>
                            @endif 
                        </div>                       
                    </fieldset>
                </div>


                @if(Session::has('no_ongoing'))

                @else
                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Ongoing Confirmations or Rejections</legend>


                        <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    <form>                                            
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Ref#</th>
                                                    <th>Support Activity</th>
                                                    <th>Comment</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($confirmed as $application)
                                                <tr>
                                                    <td>{{$application->id}}</td>
                                                    <td>{{$application->activity->title}}</td>
                                                    <td>{{$application->supervisor_comment}}</td>
                                                    <td><label class="green">Accepted</label></td>
                                                    <td>                                                
                                                        <ul class="inline-list">
                                                        <li><a href="#" data-reveal-id="edit{{$application->id}}"><label class="error">Edit</label></a></li>                                                          
                                                      </ul>
                                                    </td>
                                                </tr>

                                                  <div id="" class="reveal-modal large" data-reveal>
                                                    <div class="row">
                                                        <div class="large-12 columns">
                                                            <form action="" role="form" method="post">
                                                            </form>  
                                                        </div>
                                                    </div>
                                                    <a class="close-reveal-modal">&#215;</a>
                                                </div>

                                                <div id="edit{{$application->id}}" class="reveal-modal large" data-reveal>
                                                    <div class="row">
                                                        <h4>Editing Accepted Confirmation of Requested Application Form</h4>                                                        
                                                        <div class="large-12 columns">
                                                            <form action="/Lecturer/{{$user->id}}/Sup/Stu{{$student->user_id}}/editAcceptedReq{{$application->id}}" role="form" method="post" id="editingAccepted{{$application->id}}">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <div class="row">
                                                                    <div class="large-6 columns">
                                                                        <label>Title</label>
                                                                        <h6>{{$application->activity->title}}</h6>
                                                                    </div>
                                                                    <div class="large-6 columns">
                                                                        <label>Your Current Confirmation Status</label>
                                                                        <select name="supervisor_confirmation">
                                                                            <option name="supervisor_confirmation" value="Confirmed" selected="Confirmed">Accepted</option>
                                                                            <option name="supervisor_confirmation" value="Declined">Change to: Rejected</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="large-12 columns">
                                                                        <hr>
                                                                        <h6><label class="error">Please provide reason if you make changes</label></h6>
                                                                        <input type="text" name="reason" placeholder="<= Reason =>">
                                                                        <label>You'r latest given comment:
                                                                            <textarea name="supervisor_comment" form="editingAccepted{{$application->id}}" placeholder="{{$application->supervisor_comment}}"></textarea>
                                                                        </label>
                                                                    </div>
                                                            </div>
                                                            <input type="submit" value="Update" class="button alert postfix">
                                                        </form>
                                                    </div>
                                                    </div>
                                                    <a class="close-reveal-modal">&#215;</a>
                                                </div>

                                            @endforeach
                                                
                                            @foreach($declined as $application)
                                                <tr>
                                                    <td>{{$application->id}}</td>
                                                    <td>{{$application->activity->title}}</td>
                                                    <td>{{$application->supervisor_comment}}</td>
                                                    <td><label class="error">Rejected</label></td>
                                                    <td>
                                                        <ul class="inline-list">
                                                        <li><a href="#" data-reveal-id="edit{{$application->id}}"><label class="error">Edit</label></a></li>                                                          
                                                      </ul>
                                                    </td>
                                                </tr>

                                                  <div id="" class="reveal-modal large" data-reveal>
                                                    <div class="row">
                                                        <div class="large-12 columns">
                                                            <form action="" role="form" method="post">
                                                            </form>  
                                                        </div>
                                                    </div>
                                                    <a class="close-reveal-modal">&#215;</a>
                                                </div>

                                                <div id="edit{{$application->id}}" class="reveal-modal large" data-reveal>
                                                    <div class="row">
                                                        <h4>Editing Rejected Confirmation of Requested Application Form</h4>                                                        
                                                        <div class="large-12 columns">
                                                            <form action="/Lecturer/{{$user->id}}/Sup/Stu{{$student->user_id}}/editRejectReq{{$application->id}}" role="form" method="post" id="editingRejected{{$application->id}}">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <div class="row">
                                                                    <div class="large-6 columns">
                                                                        <label>Title</label>
                                                                        <h6>{{$application->activity->title}}</h6>
                                                                    </div>
                                                                    <div class="large-6 columns">
                                                                        <label>Your Current Confirmation Status</label>
                                                                        <select name="supervisor_confirmation">
                                                                            <option name="supervisor_confirmation" value="Declined" selected="Declined">Rejected</option>
                                                                            <option name="supervisor_confirmation" value="Confirmed">Change to: Accepted</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="large-12 columns">
                                                                        <hr>
                                                                        <h6><label class="error">Please provide reason if you make changes</label></h6>
                                                                        <input type="text" name="reason" placeholder="<= Reason =>">
                                                                        <label>You'r latest given comment:
                                                                            <textarea name="supervisor_comment" form="editingRejected{{$application->id}}" placeholder="{{$application->supervisor_comment}}"></textarea>
                                                                        </label>
                                                                    </div>
                                                            </div>
                                                            <input type="submit" value="Update" class="button alert postfix">
                                                        </form>
                                                    </div>
                                                    </div>
                                                    <a class="close-reveal-modal">&#215;</a>
                                                </div>                                                
                                            @endforeach                                                
                                        </tbody>
                                        </table>                                            
                                    </form>
                                </div>
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
        <script src="{{ asset('js/foundation/foundation.alert.js') }}"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>
