
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
            <li class="active"><a href="#">Modules</a></li>
        </ul>

      </section>
    </nav>




    <header>

        <h2 class="welcome_text">Current Modules {{$user->title}}. {{$user->name}}'s leading</h2>
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
                    @if(Session::has('can_not_add'))
                    @else
                    <dl class="sub-nav">
                      <dd class="active"><a href="/Lecturer/{{$user->id}}/Modules/Add">Add Module</a></dd>
                    </dl>
                    @endif

                    @if(Session::has('module_success'))
                        <div data-alert class="alert-box success" align="center">
                            {{ Session::get('module_success') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif

                    @if(Session::has('module_deleted'))
                        <div data-alert class="alert-box success" align="center">
                            {{ Session::get('module_deleted') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif

                    @if(Session::has('error_page'))
                        <div data-alert class="alert-box alert" align="center">
                            {{ Session::get('error_page') }}
                            <a href="#" class="close">&times;</a>
                        </div>
                    @endif



                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    @if(Session::has('no_modules'))
                                        <div class="row">
                                            <div class="large-12 medium-12 small-12 columns">
                                                <div data-alert class="alert-box alert" align="center">
                                                    {{ Session::get('no_modules') }}                                                    
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Module Name</th>
                                                    <th>Module Code</th>
                                                    <th># of Support Activities</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($modules as $module)
                                                <tr>
                                                    <td>{{$module->module_name}}</td>
                                                    <td>{{$module->module_code}}</td>
                                                    <td>{{count($module->activities)}}</td>
                                                    <td><a href="/Lecturer/{{$user->id}}/Modules/mod{{$module->id}}">View</a></td>
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
