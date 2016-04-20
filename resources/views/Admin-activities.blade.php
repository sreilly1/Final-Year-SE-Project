
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
            <li class="active has-dropdown">
                <a>Support Activities</a>
                <ul class="dropdown">
                  <li><a href="/Admin/{{$user->id}}/Modules">Modules</a></li>
                  <li><a href="/Admin/{{$user->id}}/Activities/Sessions">Session</a></li>
                </ul>
            </li>
        </ul>

      </section>
    </nav>




    <header>

        <h2 class="welcome_text">Current Support Activities</h2>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">

        <div style="width:100%;"> <!-- Main Div -->
            

            @if(Session::has('failed'))
                <div class="large-12 medium-12 small-12 columns">
                    <div data-alert class="alert-box alert" align="center">
                        {{ Session::get('failed') }}
                        <a href="#" class="close">&times;</a>
                    </div>
                </div>
            @endif
            
            <div class="row">
                <div class="large-12 columns">
                    <dl class="sub-nav">
                      <dd class="active"><a href="/Admin/{{$user->id}}/Activities/Add">Add Activity</a></dd>
                      <dd class="active"><a href="/Admin/{{$user->id}}/Activities/Sessions">Manage Sessions</a></dd>
                    </dl>

                    @if(Session::has('module_success'))
                        <div data-alert class="alert-box success" align="center">
                            {{ Session::get('module_success') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif
                    @if(Session::has('no_leader'))
                        <div data-alert class="alert-box alert" align="center">
                            {{ Session::get('no_leader') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif
                    @if(Session::has('activity_deleted'))
                        <div data-alert class="alert-box success" align="center">
                            {{ Session::get('activity_deleted') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif



                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns scroll">
                                    @if(Session::has('no_activities'))
                                        <div class="row">
                                            <div class="large-12 medium-12 small-12 columns">
                                                <div data-alert class="alert-box alert" align="center">
                                                    {{ Session::get('no_activities') }}
                                                    <a href="#" class="close">&times;</a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Role Type</th>
                                                    <th>Module Name</th>
                                                    <th># Applicants Needed</th>                                                    
                                                    <th>Choose Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($activities as $activity)
                                                <tr>
                                                    <td>{{$activity->title}}</td>
                                                    <td>{{$activity->role_type}}</td>
                                                    @if($activity->module_id === null)
                                                        <td class="alert label">This activity is not assigned with module</td>
                                                    @else
                                                        <td>{{$activity->module->module_name}}</td>
                                                    @endif  
                                                    <td>{{$activity->quant_ppl_needed}}</td>
                                                    <td><a href="/Admin/{{$user->id}}/Activities/{{$activity->id}}" >View</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
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
