
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
            <li><a href="/Admin/{{$user->id}}/Users/Modify/Lecturer">Lecturers</a></li>
            <li class="active"><a href="#">Edit: {{$lecturer->name}}</a></li>
        </ul>

      </section>
    </nav>



    <header>
        <h2 class="welcome_text">Edit {{$lecturer->name}}'s details</h2>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">

        <div style="width:100%;"> <!-- Main Div -->

             
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
                <div class="large-12 medium-8 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">User's Information</legend>

                            <div class="row">
                                <div class="large-11 medium-12 small-12 columns">
                                    <div class="row">
                                        <form action="/Admin/{{$user->id}}/Users/Modify/Lecturer/{{$lecturer->id}}/updateUsr" role="form" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="large-6 columns">
                                                <label>Role Type</label>
                                                <select name="role">
                                                    <option name="role" value="{{$lecturer->role}}" selected="{{$lecturer->role}}">{{$lecturer->role}}</option>
                                                    <option name="role" value="Administrator">Administrator</option>
                                                    <option name="role" value="Lecturer">Lecturer</option>
                                                    <option name="role" value="PHD Student">PHD Student</option>
                                                </select>
                                            </div>
                                            <div class="large-6 columns">
                                                <label>User Title</label>
                                                <select name="title">
                                                    <option name="title" value="{{$lecturer->title}}" selected="{{$lecturer->title}}">{{$lecturer->title}}</option>
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
                                                <input type="text" name="name" value="{{$lecturer->name}}" />
                                            </div>
                                            <div class="large-4 columns">
                                                <label>Username</label>
                                                <input type="text" name="username" value="{{$lecturer->username}}" />
                                            </div>
                                            <div class="large-2 columns">
                                                <label>Phone Number</label>
                                                <input type="text" name="phone_number" value="{{$lecturer->phone_number}}" />
                                            </div>
                                            <div class="large-2 columns">
                                                <label>Room Number</label>
                                                <input type="text" name="room_number" value="{{$lecturer->room_number}}" />
                                            </div>

                                            <div class="large-6 columns">
                                                <label>Email Address</label>
                                                <input type="text" name="email" value="{{$lecturer->email}}" />
                                            </div>
                                            <div class="large-6 columns">
                                                <label>Account Password</label>
                                                <input type="text" name="password" value="{{$lecturer->password}}" />
                                            </div>
                                            <div class="large-2 large-offset-8 columns">
                                                <a href="/Admin/{{$user->id}}/Users/Lecturer/{{$lecturer->id}}/Delete" class="nice tiny alert radius button">Delete</a>
                                            </div>
                                            <div class="large-2 columns">
                                                <input type="submit" value="update" class="nice tiny blue radius button">
                                            </div>              
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </fieldset>
                </div>

                <div class="large-12 medium-8 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Modules that {{$lecturer->name}} is currently leading</legend>

                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    @if(Session::has('no_modules'))
                                        <div data-alert class="alert-box secondary" align="center">
                                            {{ Session::get('no_modules') }}
                                            <a href="#" class="close">&times;</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="large-12 medium-12 small-12 columns">
                                        <form>
                                            @foreach($module as $modules)
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>Module Code</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{$modules->module_name}}</td>
                                                        <td>{{$modules->module_code}}</td>
                                                        <td><a href="/Admin/Modules/{{$modules->id}}" align="center">View Module</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            @endforeach
                                        </form>
                                </div>
                            </div>
                    </fieldset>
                </div>

                <div class="large-12 medium-8 small-12 columns">

                    <fieldset class="bio">

                        <legend class="legend">Supervision details</legend>

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
                                            @foreach($phd as $phd)
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
                                                    <tr>
                                                        <td>{{$phd->user->name}}</td>
                                                        <td>{{$phd->student_id}}</td>
                                                        <td>{{$phd->year_of_study}}</td>
                                                        <td><a href="#" align="center">View & Manage PhD Student</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            @endforeach
                                        </form>
                                </div>
                            </div>
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
