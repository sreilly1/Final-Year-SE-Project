
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
            <li class="active"><a href="#">Lecturers</a></li>
        </ul>

      </section>
    </nav>


    <header>
        <h2 class="welcome_text">Manage Lecturer Users</h2>
    </header>

    <!-- ######################## Section ######################## -->



    
            <section class="section_light">

                <div style="width:100%;">
                    <div class="row">
                        <div class="large-12 medium-12 small-12 columns">
                            <a href="/Admin/{{$user->id}}/Users/Create/Lecturer" target="_blank"><span class="label_secondary" style="margin-bottom: 10px;">Add Lecturer</span></a>
                            <dl class="sub-nav">
                                <dd><a href="/Admin/{{$user->id}}/Users/Modify/">All Users</a></dd>
                                <dd><a href="/Admin/{{$user->id}}/Users/Modify/Admin">Manage Admin Users</a></dd>
                                <dd class="active"><a href="#">Manage Lecturers</a></dd>
                                <dd><a href="/Admin/{{$user->id}}/Users/Modify/PhdStudent">Manage PhD Students</a></dd>                                    
                            </dl>
                        </div>
                        <div class="large-12 medium-12 small-12 columns scroll">
                            <table>
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>User Email Address</th>
                                        <th>User Role</th>
                                        <th>Edit User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lecturer as $lecturer)
                                    <tr>
                                        <td><a data-reveal-id="view{{$lecturer->id}}" href="#">{{$lecturer->title}}. {{$lecturer->name}}</a></td>
                                        <td>{{$lecturer->email}}</td>
                                        <td>{{$lecturer->role}}</td>
                                        <td><a href="/Admin/{{$user->id}}/Users/Modify/Lecturer/{{$lecturer->id}}">Edit</td>
                                    </tr>
                                    <div id="view{{$lecturer->id}}" class="reveal-modal xlarge" data-reveal>
                                        <div class="row">
                                            <div class="large-4 columns">
                                                <small>User Full Name:</small>
                                                <h6>{{$lecturer->title}}. {{$lecturer->name}}</h6>
                                            </div>
                                            <div class="large-4 columns">
                                                <small>Username:</small>
                                                <h6>{{$lecturer->username}}</h6>
                                            </div>
                                            <div class="large-4 columns">
                                                <small>Room number:</small>
                                                <h6>{{$lecturer->room_number}}</h6>
                                            </div>
                                            <div class="large-6 columns">
                                                <small>Email Address:</small>
                                                <h6>{{$lecturer->email}}</h6>
                                            </div>
                                            <div class="large-6 columns">
                                                <small>Phone Number</small>
                                                <h6>{{$lecturer->phone_number}}</h6>
                                            </div>
                                        </div>
                                        <a class="close-reveal-modal">&#215;</a>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
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
