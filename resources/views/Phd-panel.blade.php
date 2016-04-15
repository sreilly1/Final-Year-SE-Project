
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
            <a href="#">Notification</a>
            <ul class="dropdown">
              <li><a href="/Phd">Main Page</a></li>
            </ul>
          </li>
        </ul>
      </section>
    </nav>






    
    <section class="section_light">

        <div style="width:100%;"> <!-- Main Div -->
            <div class="row">
                <div class="large-12 medium-12 small-12 columns">
                    @if(Session::has('ErrMessage'))
                        <div data-alert class="alert-box alert">
                            {{ Session::get('ErrMessage') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif

                    <label><h2 class="welcome_text"><label>Dear</label>{{$user->title}}. {{$user->name}} <label>Welcome to your panel!</label></h2></label>
                    <hr>
                </div>
                
                <div class="large-6 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">View User Details</legend>

                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <a href="#" data-reveal-id="MangUsrInf"  class="Small button alert round disabled">Manage</a>
                            </div>                              
                        </div>

                        <div id="MangUsrInf" class="reveal-modal medium" data-reveal>
                            <div class="row">
                                <div class="large-12 small-12 columns">
                                <fieldset class="bio">
                                    <legend class="legend">
                                        <ul class="inline-list">
                                            <li><strong>Your Current Details</strong></li>
                                            <li><a href="#" data-reveal-id="EditInf">Edit</a></li>
                                        </ul>
                                    </legend>
                                    
                                    
                                    <div class="row">
                                        <div class="large-1 small-6 columns">
                                            <small>Title:</small>
                                            <h6>{{$user->title}}</h6>
                                        </div>
                                        <div class="large-5 small-6 columns">
                                            <small>Full Name:</small>
                                            <h6>{{$user->name}}</h6>
                                        </div>
                                        <div class="large-6 small-6 columns">
                                            <small>Email Address:</small>
                                            <h6>{{$user->email}}</h6>
                                        </div>                                
                                        <div class="large-5 small-6 columns">
                                            <small>Username:</small>
                                            <h6>{{$user->username}}</h6>
                                        </div>
                                        
                                        <div class="large-5 small-6 columns">
                                            <small>Phone Number</small>
                                            <h6>{{$user->phone_number}}</h6>
                                        </div>
                                        <div class="large-2 small-6 columns">
                                            <small>Room number:</small>
                                            <h6>{{$user->room_number}}</h6>
                                        </div>
                                    </div>
                                </fieldset>
                                @if(Session::has('no_supervisor'))
                                <fieldset class="bio">
                                    <legend class="legend">
                                        <ul class="inline-list">
                                            <li><strong>Supervisor Details</strong></li>
                                        </ul>
                                    </legend>
                                    
                                    
                                    <div class="row">
                                        <div class="large-12 columns">
                                            <div data-alert class="alert-box alert">
                                                You have no supervisor details in our record, please inform support team if you do have a supervisor!
                                            </div>
                                        </div>
                                    </div>                                    
                                </fieldset>
                                @else
                                <fieldset class="bio">
                                    <legend class="legend">
                                        <ul class="inline-list">
                                            <li><strong>Supervisor Details</strong></li>
                                        </ul>
                                    </legend>
                                    
                                    
                                    <div class="row">
                                        <div class="large-3 small-6 columns">
                                            <small>Title:</small>
                                            <h6>{{$phd_supervisor->supervisor->title}}</h6>
                                        </div>
                                        <div class="large-4 small-6 columns">
                                            <small>Full Name:</small>
                                            <h6>{{$phd_supervisor->supervisor->name}}</h6>
                                        </div>
                                        <div class="large-5 small-6 columns">
                                            <small>Email Address:</small>
                                            <a href="mailto:{{$phd_supervisor->supervisor->email}}"><h6>{{$phd_supervisor->supervisor->email}}</h6></a>
                                        </div>                                
                                        <div class="large-5 small-6 columns">
                                            <small>Username:</small>
                                            <h6>{{$phd_supervisor->supervisor->username}}</h6>
                                        </div>
                                        
                                        <div class="large-5 small-6 columns">
                                            <small>Phone Number</small>
                                            <h6>{{$phd_supervisor->supervisor->phone_number}}</h6>
                                        </div>
                                        <div class="large-2 small-6 columns">
                                            <small>Room number:</small>
                                            <h6>{{$phd_supervisor->supervisor->room_number}}</h6>
                                        </div>
                                    </div>                                    
                                </fieldset>
                                @endif
                                </div>
                            </div>
                            <a class="close-reveal-modal">&#215;</a>
                        </div>

                        <div id="EditInf" class="reveal-modal large" data-reveal>
                            <h3>Editing Details</h3>                                
                            <form action="/Phd/{{$user->id}}/updateInfo" role="form" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="large-2 columns">
                                    <label>Title</label>
                                    <select name="title">
                                        <option name="title" value="{{$user->title}}" selected="{{$user->title}}">{{$user->title}}</option>
                                        <option name="title" value="Professor">Professor</option>
                                        <option name="title" value="Dr">Dr</option>
                                        <option name="title" value="Mr">Mr</option>
                                        <option name="title" value="Mrs">Mrs</option>
                                        <option name="title" value="Miss">Miss</option>
                                        <option name="title" value="Ms">Ms</option>
                                    </select>
                                </div>
                                <div class="large-3 columns">
                                    <label>Full Name</label>
                                    <input type="text" name="name" value="{{$user->name}}" />
                                </div>
                                <div class="large-3 columns">
                                    <label>Username</label>
                                    <input type="text" name="username" value="{{$user->username}}" />
                                </div>
                                <div class="large-2 columns">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_number" value="{{$user->phone_number}}" />
                                </div>
                                <div class="large-2 columns">
                                    <label>Room Number</label>
                                    <input type="text" name="room_number" value="{{$user->room_number}}" />
                                </div>

                                <div class="large-6 columns">
                                    <label>Email Address</label>
                                    <input type="text" name="email" value="{{$user->email}}" />
                                </div>
                                <div class="large-6 columns">
                                    <label>Account Password</label>
                                    <input type="text" name="password" value="{{$user->password}}" />
                                </div>

                                <div class="large-12 columns">
                                    <input type="submit" value="Update Details" class="nice tiny blue radius button">
                                    <a href="#" data-reveal-id="MangUsrInf" class="nice tiny blue radius button">Beck</a>
                                </div>                
                            </form>

                            <a class="close-reveal-modal">&#215;</a>
                        </div>
                </div>

                <div class="large-6 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Make Connection</legend>

                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">

                                <a href="#" data-reveal-id="ContUsr"  class="Small button alert round disabled">Email now</a>

                                <div id="ContUsr" class="reveal-modal xlarge" data-reveal>
                                    <h3>Contacting Existed User</h3>
                                    <!-- Social Dialogue Section -->
                                    <div class="row">
                                        <div class="small-12 medium-12 large-12 columns" id="listScroll">
                                            <h5><strong>List of users:</strong></h5>
                                            <div class="panel">
                                                <ul class="no-bullet">
                                                    @if(Session::has('no_admins'))
                                                    @else                                                
                                                        <li><strong>Administrators and Support Team:</strong></li>
                                                        <ul class="no-bullet">
                                                        @foreach($admins as $admin)
                                                          <li>- <a href="mailto:{{$admin->email}}">{{$admin->name}}</a></li>
                                                        @endforeach
                                                        </ul>
                                                    @endif
                                                    <hr>
                                                    @if(Session::has('no_supervisor'))
                                                    @else
                                                        <li><strong>Supervisor</strong></li>
                                                        <ul class="no-bullet">
                                                          <li>- <a href="mailto:{{$phd_supervisor->supervisor->email}}">{{$phd_supervisor->supervisor->title}}. {{$phd_supervisor->supervisor->name}}</a></li>
                                                        </ul>
                                                    @endif
                                                </ul>
                                            </div>                                                
                                        </div>
                                    </div>
                                    <a class="close-reveal-modal">&#215;</a>
                                </div>
                            </div>                              
                        </div>
                    </fieldset>
                </div>

                <div class="large-6 medium-12 small-12 columns">

                    <fieldset class="bio">
                        <legend class="legend">Apply for Job Application</legend>
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <a href="/Phd/{{$user->id}}/Engagement-Form" class="Small button alert round disabled">View & Edit</a>

                            </div>                              
                        </div>                    
                    </fieldset>
                </div>


                <div class="large-6 medium-12 small-12 columns">

                    <fieldset class="bio">
                        @if (App\AddRequest::where('user_id', $user->id)->where('status', '=', 'Accepted')->exists())
                            <legend>View Work Sessions</legend>
                        @else
                            <legend style="color:red;">View Work Sessions</legend>
                        @endif
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                @if (App\AddRequest::where('user_id', $user->id)->where('status', '=', 'Accepted')->exists())
                                    <a href="/Phd/{{$user->id}}/JobSessions" class="Small button alert round disabled">View & Edit</a>
                                @else
                                    <button class="Small button secondary round disabled"><a style="color: red;" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="You have currently no job, once you have been accepted with any, this button should works!">Not Available</a></button>
                                @endif
                            </div>                              
                        </div>                    
                    </fieldset>
                </div>

                @if (App\AddRequest::where('user_id', $user->id)->exists())
                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">
                            <ul class="inline-list">
                                <li><label>Ongoing Application Requested</label></li>
                                @if (App\AddRequest::where('user_id', $user->id)->where('status', '=', 'Pending')->exists())
                                    @if ($pending == 1)
                                    <li><label style="color:#778899;" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="You have {{$pending}} 'Job Application' requested that is still pending">Pending(<strong style="color:black;">{{$pending}}</strong>)</label></li>
                                    @else
                                    <li><label style="color:#778899;" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="You have {{$pending}} 'Job Application' requested that are still pending">Pending(<strong style="color:black;">{{$pending}}</strong>)</label></li>
                                    @endif
                                @endif
                                @if (App\AddRequest::where('user_id', $user->id)->where('status', '=', 'Accepted')->exists())
                                <li><label style="color:green;" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="You have {{$accepted}} accepted 'Job Application/s'. You should be able to view your sessions by accessing 'View Work Sessions' page">Accepted(<strong style="color:black;">{{$accepted}}</strong>)</label></li>
                                @endif
                                @if (App\AddRequest::where('user_id', $user->id)->where('status', '=', 'Declined')->exists())
                                <li><label style="color:red;" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="You have {{$rejected}} rejected 'Job Application/s'.">Rejected(<strong style="color:black;">{{$rejected}}</strong>)</label></li>
                                @endif
                            </ul>
                        </legend>

                        <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    <a href="/Phd/{{$user->id}}/Requests" class="button alert disabled postfix">Monitor Ongoing Applications Requested</a>
                                </div>
                        </div>
                    </fieldset>
                </div>
                @else
                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Ongoing Application Requested</legend>

                        <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    <button class="button secondary disabled postfix"><a style="color: red;" data-tooltip aria-haspopup="true" class="has-tip tip-top" title="You have not requested any 'Job Application' yet">You have no applications requested at the moment</a></button>
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

        <script>
            $(document).foundation();
        </script>

</body>
</html>
