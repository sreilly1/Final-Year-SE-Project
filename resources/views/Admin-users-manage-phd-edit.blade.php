
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
            <li><a href="/Admin/{{$user->id}}/Users/Modify">Manage</a></li>
            <li><a href="/Admin/{{$user->id}}/Users/Modify/PhdStudent/">PhD Students</a></li>
            <li class="active"><a href="#">Edit: {{$phd->name}}</a></li>
        </ul>

      </section>
    </nav>

    <header>

        <h2 class="welcome_text">Edit {{$phd->name}}'s details</h2>
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

                        <legend class="legend">User's Information</legend>

                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                        <form action="/Admin/{{$user->id}}/Users/Modify/PhdStudent/{{$phd->id}}/updateUsr" role="form" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="large-6 columns">
                                                <label>Role Type</label>
                                                <select name="role">
                                                    <option name="role" value="{{$phd->role}}" selected="{{$phd->role}}">{{$phd->role}}</option>
                                                    <option name="role" value="Administrator">Administrator</option>
                                                    <option name="role" value="Lecturer">Lecturer</option>
                                                    <option name="role" value="PHD Student">PHD Student</option>
                                                </select>
                                            </div>
                                            <div class="large-6 columns">
                                                <label>User Title</label>
                                                <select name="title">
                                                    <option name="title" value="{{$phd->title}}" selected="{{$phd->title}}">{{$phd->title}}</option>
                                                    <option name="title" value="Professor">Professor</option>
                                                    <option name="title" value="Dr">Dr</option>
                                                    <option name="title" value="Mr">Mr</option>
                                                    <option name="title" value="Mrs">Mrs</option>
                                                    <option name="title" value="Miss">Miss</option>
                                                    <option name="title" value="Ms">Ms</option>
                                                </select>
                                            </div>
                                            <div class="large-4 columns">
                                                <label>User's Full Name</label>
                                                <input type="text" name="name" value="{{$phd->name}}" />
                                            </div>
                                            <div class="large-4 columns">
                                                <label>Username</label>
                                                <input type="text" name="username" value="{{$phd->username}}" />
                                            </div>
                                            <div class="large-2 columns">
                                                <label>Phone Number</label>
                                                <input type="text" name="phone_number" value="{{$phd->phone_number}}" />
                                            </div>
                                            <div class="large-2 columns">
                                                <label>Room Number</label>
                                                <input type="text" name="room_number" value="{{$phd->room_number}}" />
                                            </div>

                                            <div class="large-6 columns">
                                                <label>Email Address</label>
                                                <input type="text" name="email" value="{{$phd->email}}" />
                                            </div>
                                            <div class="large-6 columns">
                                                <label>Account Password</label>
                                                <input type="text" name="password" value="{{$phd->password}}" />
                                            </div>
                                            
                                            <div class="large-2 large-offset-8 columns">
                                                <a href="/Admin/{{$user->id}}/Users/PhdStudent/{{$phd->id}}/Delete" class="nice tiny alert radius button">Delete</a>
                                            </div>
                                      
                                            <div class="large-2 columns">
                                                <input type="submit" value="update" class="nice tiny blue radius button">
                                            </div>               
                                        </form>
                                        
                                </div> 
                            </div>
                    </fieldset>
                </div>

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">PhD Details</legend>

                            
                                
                                @if(Session::has('no_supervisor'))
                                    <div class="row">
                                        <div class="large-12 medium-12 small-12 columns">
                                            <div data-alert class="alert-box alert" align="center">
                                                {{ Session::get('no_supervisor') }}
                                                <a href="#" class="close">&times;</a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="large-12 medium-12 small-12 columns">
                                            <form action="/Admin/{{$user->id}}/Users/Modify/PhdStudent/{{$phd->id}}/updatePhDInf" role="form" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                @if($phdInfo->supervisor_id === null)                                                        
                                                    <div class="large-4 medium-12 small-12 columns">
                                                        <label class="error">This user has no "supervisor"!</label>
                                                        <select name="supervisor_id">
                                                            <option name="supervisor_id" value="null" selected="-- Please Select --">-- Please Select --</option>
                                                            @foreach($lecturer as $staff)
                                                            <option name="module_leader" value="{{$staff->id}}">{{$staff->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @else
                                                    <div class="large-4 medium-12 small-12 columns">
                                                        <label>Current Supervisor</label>
                                                        <select name="supervisor_id">
                                                            <option name="title" value="{{$phdInfo->supervisor_id}}" selected="{{$phdInfo->supervisor->name}}">{{$phdInfo->supervisor->name}}</option>
                                                            <option name="supervisor_id" value="null">- No Supervisor -</option>
                                                            @foreach($lecturer as $staff)
                                                            <option name="module_leader" value="{{$staff->id}}">{{$staff->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif

                                                <div class="large-4 medium-12 small-12 columns">
                                                    <label>Student ID / Number</label>
                                                    <input type="text" name="student_id" value="{{$phdInfo->student_id}}" />
                                                </div>
                                                <div class="large-4 medium-12 small-12 columns">
                                                    <label>Year of Study</label>
                                                    <input type="text" name="year_of_study" value="{{$phdInfo->year_of_study}}" />
                                                </div>
                                                <div class="large-2 columns">
                                                    <input type="submit" value="update" class="nice tiny blue radius button">
                                                </div>
                                            </form>
                                            <div class="large-2 large-offset-8 columns">
                                                <form action="deletePhdUsr/{{$phd->id}}" role="form" method="post">
                                                    <input type="submit" value="delete" class="nice tiny alert radius button">
                                                </form>
                                            </div> 
                                        </div>
                                    </div>
                                @endif
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
