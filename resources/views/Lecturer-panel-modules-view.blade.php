
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
            <li class="active"><a href="#">View: {{$module->module_name}}</a></li>
        </ul>

      </section>
    </nav>

    <header>

        <h2 class="welcome_text">{{$module->module_name}}</h2>
    </header>

    <!-- ######################## Section ######################## -->





    
    <section class="section_light">


            <div class="row">
               
               
               @if(Session::has('activity_deleted'))
               <div class="row">
                    <div class="large-12 medium-12 small-12 columns">
                        <div data-alert class="alert-box success" align="center">
                            {{ Session::get('activity_deleted') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    </div>
                </div>
                @endif

               @if(Session::has('error_page'))
               <div class="row">
                    <div class="large-12 medium-12 small-12 columns">
                        <div data-alert class="alert-box alert" align="center">
                            {{ Session::get('error_page') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    </div>
                </div>
                @endif

                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                    
                        <legend class="legend">
                            <ul class="inline-list">
                                <li>Module Details</li>
                                <li><a href="/Lecturer/{{$user->id}}/Modules/mod{{$module->id}}/Modify"><label>Edit</label></a></li>
                                @if(Session::has('can_delete'))
                                    <li><a href="#"><label class="error">Delete</label></a></li>
                                @endif
                            </ul>
                        </legend>
                            <div class="row">
                                <div class="large-6 columns">
                                    <small>Module Name:</small>
                                    <h6>{{$module->module_name}}</h6>
                                </div>
                                <div class="large-6 columns">
                                    <small>Module Code:</small>
                                    <h6>{{$module->module_code}}</h6>
                                </div>
                            </div>
                    </fieldset>
                </div>


                <div class="large-12 medium-12 small-12 columns">

                    <fieldset class="bio">

                        
                        <legend class="legend">
                            <ul class="inline-list">
                                <li>Support Activities Details</li>
                                <li><a href="/Lecturer/{{$user->id}}/Modules/mod{{$module->id}}/Modify/addAct"><label>Add</label></a></li>
                            </ul>
                        </legend>

                        @if(Session::has('no_activities'))
                        <div class="row">
                            <div class="large-12 medium-12 small-12 columns">
                                <div data-alert class="alert-box alert" align="center">
                                    {{ Session::get('no_activities') }}
                                    
                                </div>
                            </div>
                        </div>
                        @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Role Type</th>
                                    <th># of Sessions</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $activity)
                                    <tr>
                                        <td>{{$activity->title}}</td>
                                        <td>{{$activity->role_type}}</td>
                                        <td>{{count($activity->events)}}</td>                                                                                                
                                        <td><a href="/Lecturer/{{$user->id}}/Modules/mod{{$module->id}}/Act{{$activity->id}}">View</a>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
